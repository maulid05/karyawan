<?php

namespace App\Observers;

use App\Models\Timeline;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TimelineObserver
{
    public function created(Model $model): void
    {
        $this->createTimeline(
            model: $model,
            action: 'create'
        );
    }

    public function updated(Model $model): void
    {
        $changes = $model->getDirty();

        $this->createTimeline(
            model: $model,
            action: 'update',
            changes: $changes
        );
    }

    public function deleted(Model $model): void
    {
        $this->createTimeline(
            model: $model,
            action: 'delete'
        );
    }

    private function createTimeline(
        Model $model,
        string $action,
        array $changes = []
    ): void {
        if ($model instanceof Timeline) {
            return;
        }

        /*
         * ID DataPribadi pengirim.
         */
        $senderId = Auth::user()->dataPribadi?->id;

        if (!$senderId) {
            return;
        }

        /*
         * CREATE
         */
        if ($action === 'create') {
            $changes = $model->toArray();
        }

        /*
         * Bersihkan field sistem dari changes.
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

        if (empty($changes)) {
            return;
        }

        /*
         * Ambil semua admin sebagai tujuan.
         */
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        $pageUrl = $this->pageUrl($model);

        foreach ($admins as $admin) {

            Timeline::create([
                /*
                 * Tujuan / penerima.
                 */
                'user_id' => $admin->id,

                'log' => [
                    /*
                     * Jenis Timeline.
                     */
                    'type' => 'data_update',

                    /*
                     * create / update / delete.
                     */
                    'action' => $action,

                    /*
                     * Status notifikasi.
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
                     * Pengirim.
                     * ID DataPribadi user yang sedang login.
                     */
                    'send_id' => $senderId,

                    /*
                     * URL halaman tujuan.
                     */
                    'pageUrl' => $pageUrl,

                    /*
                     * Data perubahan.
                     */
                    'data' => [
                        'changes' => $changes,
                    ],
                ],
            ]);
        }
    }

    private function pageUrl(Model $model): string
    {
        return match (class_basename($model)) {

            'DataPribadi' =>
                'data_pribadi',

            'Kependudukan' =>
                'kependudukan',

            'Keluarga' =>
                'keluarga',

            'Kontak' =>
                'kontak',

            'Kepegawaian' =>
                'kepegawaian',

            'ProfilAkademik' =>
                'profil_akademik',

            'PasFoto' =>
                'pas_foto',

            'JabatanStruktural' =>
                'jabatan_struktural',

            'JabatanFungsional' =>
                'jabatan_fungsional',

            'ImpassingDanKepangkatan' =>
                'impassing_dan_kepangkatan',

            'Diklat' =>
                'diklat',

            'Penempatan' =>
                'penempatan',
            default =>
                url('/'),
        };
    }

    private function openedWith(Model $model): string
    {
        return match (class_basename($model)) {

            'DataPribadi' =>
                'data_pribadi',

            'Kependudukan' =>
                'kependudukan',

            'Keluarga' =>
                'keluarga',

            'Kontak' =>
                'kontak',

            'Kepegawaian' =>
                'kepegawaian',

            'ProfilAkademik' =>
                'profil_akademik',

            'PasFoto' =>
                'pas_foto',

            'JabatanStruktural' =>
                'jabatan_struktural',

            'JabatanFungsional' =>
                'jabatan_fungsional',

            'ImpassingDanKepangkatan' =>
                'impassing_dan_kepangkatan',

            'Diklat' =>
                'diklat',

            'Penempatan' =>
                'penempatan',

            default =>
                strtolower(
                    preg_replace(
                        '/(?<!^)[A-Z]/',
                        '_$0',
                        class_basename($model)
                    )
                ),
        };
    }
}