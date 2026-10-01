<?php

namespace App\Http\Controllers;

use App\Models\DataPribadi;
use App\Models\Timeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
    /**
     * Menampilkan semua Timeline milik user yang sedang login.
     */
    public function index()
    {
        $data = Auth::user()
            ->timeline()
            ->latest()
            ->get();

        return view('timeline.index', compact('data'));
    }

    /**
     * Menampilkan detail Timeline.
     *
     * unread -> done
     */
    public function show($id)
    {
        $timeline = Auth::user()
            ->timeline()
            ->findOrFail($id);

        $log = $timeline->log ?? [];

        if (($log['status'] ?? null) === 'unread') {
            $log['status'] = 'done';

            $timeline->log = $log;
            $timeline->saveQuietly();
        }

        return view('timeline.show', compact('timeline'));
    }

    /**
     * Menandai satu Timeline sebagai selesai.
     */
    public function read($id)
    {
        $timeline = Auth::user()
            ->timeline()
            ->findOrFail($id);

        $log = $timeline->log ?? [];

        $log['status'] = 'done';

        $timeline->log = $log;
        $timeline->saveQuietly();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi telah diselesaikan.',
        ]);
    }

    /**
     * Menandai semua Timeline sebagai selesai.
     */
    public function readAll()
    {
        $timelines = Auth::user()
            ->timeline()
            ->get();

        foreach ($timelines as $timeline) {
            $log = $timeline->log ?? [];

            if (($log['status'] ?? null) === 'unread') {
                $log['status'] = 'done';

                $timeline->log = $log;
                $timeline->saveQuietly();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Semua notifikasi telah diselesaikan.',
        ]);
    }

    /**
     * Admin memberikan keputusan terhadap Timeline.
     *
     * APPROVED
     *     -> Terapkan new_data ke database.
     *
     * REJECTED
     *     -> Database tetap menggunakan data lama.
     *
     * PENDING
     *     -> Database tetap menggunakan data lama.
     *
     * Setelah keputusan:
     *     -> Update Timeline admin.
     *     -> Buat Timeline keputusan untuk user.
     */
    public function decision($id, $decision)
    {
        /*
         * =====================================================
         * 1. VALIDASI DECISION
         * =====================================================
         */
        if (!in_array($decision, [
            'approved',
            'rejected',
            'pending',
        ], true)) {
            abort(404);
        }

        /*
         * =====================================================
         * 2. PASTIKAN USER ADALAH ADMIN
         * =====================================================
         *
         * Project menggunakan relasi roles(),
         * bukan method hasRole().
         */
        if (
            !Auth::user()
                ->roles()
                ->where('name', 'admin')
                ->exists()
        ) {
            abort(403);
        }

        /*
         * =====================================================
         * 3. AMBIL TIMELINE ADMIN
         * =====================================================
         */
        $timeline = Auth::user()
            ->timeline()
            ->findOrFail($id);

        $log = $timeline->log ?? [];

        /*
         * Timeline keputusan tidak boleh diproses lagi.
         */
        if (($log['type'] ?? null) === 'decision') {
            return back()->with(
                'error',
                'Notifikasi keputusan tidak dapat diproses kembali.'
            );
        }

        /*
         * Timeline yang sudah mempunyai keputusan
         * tidak boleh diproses lagi.
         */
        if (!empty($log['decision'])) {
            return back()->with(
                'error',
                'Timeline ini sudah memiliki keputusan.'
            );
        }

        /*
         * =====================================================
         * 4. AMBIL DATA PERUBAHAN
         * =====================================================
         */
        $data = $log['data'] ?? [];

        /*
         * Class model yang berubah.
         *
         * Contoh:
         * App\Models\DataPribadi
         */
        $modelClass = $data['model'] ?? null;

        /*
         * ID record yang berubah.
         */
        $modelId = $data['model_id'] ?? null;

        /*
         * Data sebelum perubahan.
         */
        $oldData = $data['old_data'] ?? [];

        /*
         * Data setelah perubahan.
         */
        $newData = $data['new_data']
            ?? $data['changes']
            ?? [];

        /*
         * =====================================================
         * 5. CARI USER PENGIRIM
         * =====================================================
         *
         * send_id pada Timeline perubahan adalah
         * ID DataPribadi user.
         */
        $senderId = $log['send_id'] ?? null;

        if (!$senderId) {
            return back()->with(
                'error',
                'Pengirim data tidak ditemukan.'
            );
        }

        /*
         * Cari DataPribadi.
         */
        $sender = DataPribadi::find($senderId);

        if (!$sender) {
            return back()->with(
                'error',
                'Data pribadi pengirim tidak ditemukan.'
            );
        }

        /*
         * User pemilik DataPribadi.
         */
        $senderUserId = $sender->user_id;

        if (!$senderUserId) {
            return back()->with(
                'error',
                'User pengirim tidak ditemukan.'
            );
        }

        /*
         * =====================================================
         * 6. APPROVED
         * =====================================================
         *
         * Hanya approved yang menerapkan new_data.
         */
        if ($decision === 'approved') {

            /*
             * Model dan ID wajib tersedia.
             */
            if (!$modelClass || !$modelId) {
                return back()->with(
                    'error',
                    'Referensi model tidak ditemukan. Timeline ini mungkin dibuat sebelum sistem approval diperbarui.'
                );
            }

            /*
             * Pastikan class model benar-benar tersedia.
             */
            if (!class_exists($modelClass)) {
                return back()->with(
                    'error',
                    'Model perubahan tidak ditemukan: '
                    . $modelClass
                );
            }

            /*
             * Ambil record.
             */
            $model = $modelClass::find($modelId);

            if (!$model) {
                return back()->with(
                    'error',
                    'Data yang akan diperbarui tidak ditemukan.'
                );
            }

            /*
             * Terapkan data baru tanpa menjalankan
             * event Observer.
             */
            if (!empty($newData)) {
                $model->updateQuietly($newData);
            }
        }

        /*
         * =====================================================
         * 7. UPDATE TIMELINE ADMIN + NOTIFIKASI USER
         * =====================================================
         */
        DB::transaction(function () use (
            $timeline,
            $log,
            $decision,
            $senderUserId,
            $modelClass,
            $modelId,
            $oldData,
            $newData
        ) {

            /*
             * Update Timeline admin.
             */
            $log['status'] = 'done';
            $log['decision'] = $decision;

            $timeline->log = $log;
            $timeline->saveQuietly();

            /*
             * Buat notifikasi keputusan untuk user.
             */
            Timeline::create([
                'user_id' => $senderUserId,

                'log' => [
                    'type' => 'decision',

                    'action' => $decision,

                    'status' => 'unread',

                    'decision' => $decision,

                    'opened_with' =>
                        $log['opened_with']
                        ?? 'Tidak diketahui',

                    /*
                     * Pada Timeline keputusan,
                     * send_id adalah ID User admin.
                     */
                    'send_id' => Auth::user()->id,

                    /*
                     * Hubungkan dengan Timeline asli.
                     */
                    'log_id' => $timeline->id,

                    /*
                     * Simpan informasi perubahan.
                     */
                    'data' => [
                        'model' => $modelClass,

                        'model_id' => $modelId,

                        'old_data' => $oldData,

                        'new_data' => $newData,

                        'changes' => $newData,
                    ],
                ],
            ]);
        });

        /*
         * =====================================================
         * 8. REDIRECT
         * =====================================================
         */
        return redirect()
            ->route(
                'timeline.show',
                $timeline->id
            )
            ->with(
                'success',
                match ($decision) {

                    'approved' =>
                        'Perubahan berhasil disetujui dan diterapkan. Notifikasi telah dikirim kepada user.',

                    'rejected' =>
                        'Perubahan berhasil ditolak. Notifikasi telah dikirim kepada user.',

                    'pending' =>
                        'Perubahan ditandai sebagai pending. Notifikasi telah dikirim kepada user.',

                    default =>
                        'Keputusan berhasil disimpan.',
                }
            );
    }
}