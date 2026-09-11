<?php

namespace App\Http\Controllers;

use App\Models\Timeline;
use Illuminate\Support\Facades\Auth;

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
     * Saat notifikasi dibuka:
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
            $timeline->save();
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
        $timeline->save();

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
                $timeline->save();
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
     * Alur:
     *
     * Timeline Admin
     *      ↓
     * update decision
     *      ↓
     * status admin = done
     *      ↓
     * buat Timeline baru untuk pengirim
     *      ↓
     * status client = unread
     */
    public function decision($id, $decision)
    {
        /*
         * Ambil Timeline milik admin yang sedang login.
         */
        $timeline = Auth::user()
            ->timeline()
            ->findOrFail($id);

        /*
         * Keputusan yang diperbolehkan.
         */
        $allowed = [
            'approved',
            'rejected',
            'pending',
        ];

        if (!in_array($decision, $allowed)) {
            abort(404);
        }

        /*
         * Ambil log Timeline.
         */
        $log = $timeline->log ?? [];

        /*
         * Timeline keputusan tidak boleh
         * diproses kembali.
         */
        if (($log['type'] ?? null) === 'decision') {
            return back()->with(
                'error',
                'Notifikasi keputusan tidak dapat diproses kembali.'
            );
        }

        /*
         * ==========================================
         * PENGIRIM ASLI
         * ==========================================
         *
         * send_id pada Timeline Admin adalah
         * ID DataPribadi milik user pengirim.
         */
        $senderId = $log['send_id'] ?? null;

        if (!$senderId) {
            return back()->with(
                'error',
                'Pengirim data tidak ditemukan.'
            );
        }

        /*
         * ==========================================
         * UPDATE TIMELINE ADMIN
         * ==========================================
         */
        $log['status'] = 'done';
        $log['decision'] = $decision;

        $timeline->log = $log;
        $timeline->save();

        /*
         * ==========================================
         * BUAT TIMELINE KEPUTUSAN UNTUK CLIENT
         * ==========================================
         *
         * send_id  = Admin sebagai pengirim
         * user_id  = tujuan
         *
         * log_id   = Timeline asli yang diputuskan.
         */
        Timeline::create([
            /*
             * Tujuan.
             *
             * Karena send_id Timeline asli adalah
             * ID DataPribadi, kita cari User pemiliknya.
             */
            'user_id' => \App\Models\DataPribadi::findOrFail($senderId)->user_id,

            'log' => [

                /*
                 * Jenis notifikasi.
                 */
                'type' => 'decision',

                /*
                 * approved / rejected / pending
                 */
                'action' => $decision,

                /*
                 * Client belum membuka.
                 */
                'status' => 'unread',

                /*
                 * Hasil keputusan.
                 */
                'decision' => $decision,

                /*
                 * Data yang terkait.
                 */
                'opened_with' =>
                    $log['opened_with']
                    ?? 'Tidak diketahui',

                /*
                 * Admin adalah pengirim keputusan.
                 */
                'send_id' => Auth::user()->id,

                /*
                 * Referensi Timeline asli.
                 */
                'log_id' => $timeline->id,
            ],
        ]);

        /*
         * Kembali ke Timeline Admin.
         */
        return redirect()
            ->route('timeline.show', $timeline->id)
            ->with(
                'success',
                'Keputusan berhasil disimpan dan notifikasi telah dikirim kepada client.'
            );
    }
}