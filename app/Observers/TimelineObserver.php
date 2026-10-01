<?php

namespace App\Observers;

use App\Models\Timeline;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TimelineObserver
{
    /**
     * Event ketika model dibuat.
     */
    public function created(Model $model): void
    {
        $this->createTimeline(
            model: $model,
            action: 'create'
        );
    }

    /**
     * Event ketika model diperbarui.
     *
     * Alurnya:
     *
     * 1. Ambil data lama.
     * 2. Ambil data baru.
     * 3. Simpan Timeline untuk admin.
     * 4. Kembalikan database ke data lama.
     */
    public function updated(Model $model): void
    {
        /*
         * Data sebelum perubahan.
         */
        $oldData = $model->getOriginal();

        /*
         * Data yang benar-benar berubah.
         */
        $newData = $model->getChanges();

        /*
         * Field sistem yang tidak perlu
         * masuk approval.
         */
        $ignoredFields = [
            'id',
            'user_id',
            'created_at',
            'updated_at',
        ];

        /*
         * Buang field sistem.
         */
        $newData = collect($newData)
            ->except($ignoredFields)
            ->toArray();

        /*
         * Tidak ada perubahan yang perlu
         * mendapatkan approval.
         */
        if (empty($newData)) {
            return;
        }

        /*
         * Ambil data lama hanya untuk field
         * yang berubah.
         */
        $oldData = collect($oldData)
            ->only(array_keys($newData))
            ->toArray();

        /*
         * Buat Timeline approval.
         */
        $this->createTimeline(
            model: $model,
            action: 'update',
            changes: $newData,
            original: $oldData
        );

        /*
         * Kembalikan database ke data lama.
         *
         * Query langsung digunakan agar tidak
         * menjalankan event Eloquent lagi.
         */
        $model->newQuery()
            ->whereKey($model->getKey())
            ->update($oldData);

        /*
         * Sinkronkan instance model dengan database.
         */
        $model->setRawAttributes(
            array_merge(
                $model->getAttributes(),
                $oldData
            )
        );
    }

    /**
     * Event ketika model dihapus.
     */
    public function deleted(Model $model): void
    {
        $this->createTimeline(
            model: $model,
            action: 'delete'
        );
    }

    /**
     * Membuat Timeline.
     */
    private function createTimeline(
        Model $model,
        string $action,
        array $changes = [],
        array $original = []
    ): void {

        /*
         * Timeline sendiri tidak boleh
         * membuat Timeline.
         */
        if ($model instanceof Timeline) {
            return;
        }

        /*
         * User yang sedang login.
         */
        $user = Auth::user();

        if (!$user) {
            return;
        }

        /*
         * DataPribadi user yang melakukan perubahan.
         */
        $senderId = $user->dataPribadi?->id;

        if (!$senderId) {
            return;
        }

        /*
         * Untuk CREATE, ambil seluruh data model.
         */
        if ($action === 'create') {
            $changes = $model->toArray();
        }

        /*
         * Buang field sistem.
         */
        $changes = collect($changes)
            ->except([
                'id',
                'user_id',
                'created_at',
                'updated_at',
            ])
            ->filter(function ($value) use ($action) {

                if ($action === 'create') {
                    return !is_null($value)
                        && $value !== ''
                        && $value !== [];
                }

                return true;
            })
            ->toArray();

        /*
         * Tidak ada data perubahan.
         */
        if (empty($changes)) {
            return;
        }

        /*
         * Bersihkan data lama.
         */
        $original = collect($original)
            ->except([
                'id',
                'user_id',
                'created_at',
                'updated_at',
            ])
            ->toArray();

        /*
         * Ambil semua admin.
         */
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        /*
         * URL halaman data.
         */
        $pageUrl = $this->pageUrl($model);

        /*
         * Kirim Timeline ke semua admin.
         */
        foreach ($admins as $admin) {

            Timeline::create([
                /*
                 * Timeline milik admin.
                 */
                'user_id' => $admin->id,

                'log' => [

                    /*
                     * Jenis Timeline.
                     */
                    'type' => 'data_update',

                    /*
                     * create / update / delete
                     */
                    'action' => $action,

                    /*
                     * Notifikasi baru.
                     */
                    'status' => 'unread',

                    /*
                     * Belum ada keputusan.
                     */
                    'decision' => null,

                    /*
                     * Jenis data.
                     */
                    'opened_with' => $this->openedWith($model),

                    /*
                     * ID DataPribadi pengirim.
                     */
                    'send_id' => $senderId,

                    /*
                     * URL data.
                     */
                    'pageUrl' => $pageUrl,

                    /*
                     * Data untuk proses approval.
                     */
                    'data' => [

                        /*
                         * Class model.
                         *
                         * Contoh:
                         * App\Models\DataPribadi
                         */
                        'model' => get_class($model),

                        /*
                         * ID record.
                         */
                        'model_id' => $model->getKey(),

                        /*
                         * Data sebelum perubahan.
                         */
                        'old_data' => $original,

                        /*
                         * Data setelah perubahan.
                         */
                        'new_data' => $changes,

                        /*
                         * Alias untuk kebutuhan tampilan.
                         */
                        'changes' => $changes,
                    ],
                ],
            ]);
        }
    }

    /**
     * URL halaman berdasarkan model.
     */
    private function pageUrl(Model $model): string
    {
        return match (class_basename($model)) {

            'DataPribadi'
                => 'data_pribadi',

            'Kependudukan'
                => 'kependudukan',

            'Keluarga'
                => 'keluarga',

            'Kontak'
                => 'kontak',

            'Kepegawaian'
                => 'kepegawaian',

            'ProfilAkademik'
                => 'profil_akademik',

            'PasFoto'
                => 'pas_foto',

            'JabatanStruktural'
                => 'jabatan_struktural',

            'JabatanFungsional'
                => 'jabatan_fungsional',

            'ImpassingDanKepangkatan'
                => 'impassing_dan_kepangkatan',

            'Diklat'
                => 'diklat',

            'Penempatan'
                => 'penempatan',

            default
                => url('/'),
        };
    }

    /**
     * Nama jenis data.
     */
    private function openedWith(Model $model): string
    {
        return match (class_basename($model)) {

            'DataPribadi'
                => 'data_pribadi',

            'Kependudukan'
                => 'kependudukan',

            'Keluarga'
                => 'keluarga',

            'Kontak'
                => 'kontak',

            'Kepegawaian'
                => 'kepegawaian',

            'ProfilAkademik'
                => 'profil_akademik',

            'PasFoto'
                => 'pas_foto',

            'JabatanStruktural'
                => 'jabatan_struktural',

            'JabatanFungsional'
                => 'jabatan_fungsional',

            'ImpassingDanKepangkatan'
                => 'impassing_dan_kepangkatan',

            'Diklat'
                => 'diklat',

            'Penempatan'
                => 'penempatan',

            default
                => strtolower(
                    preg_replace(
                        '/(?<!^)[A-Z]/',
                        '_$0',
                        class_basename($model)
                    )
                ),
        };
    }
}