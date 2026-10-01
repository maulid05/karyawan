@extends('layouts.layout')

@section('title', 'Detail Notifikasi')

@section('content')

{{-- =========================================================
     FLASH MESSAGE
========================================================= --}}

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
@endif


@php

    /*
    |--------------------------------------------------------------------------
    | LOG TIMELINE
    |--------------------------------------------------------------------------
    */

    $timelineLog = $timeline->log ?? [];

    /*
    |--------------------------------------------------------------------------
    | DEFAULT VALUE
    |--------------------------------------------------------------------------
    */

    $type = $timelineLog['type'] ?? 'data_update';

    $action = $timelineLog['action'] ?? 'Aktivitas';

    $status = $timelineLog['status'] ?? 'done';

    $decision = $timelineLog['decision'] ?? null;

    $openedWith = $timelineLog['opened_with']
        ?? 'Tidak diketahui';

    /*
    |--------------------------------------------------------------------------
    | TIMELINE ASAL
    |--------------------------------------------------------------------------
    |
    | Jika ini merupakan notifikasi keputusan,
    | log_id menunjuk ke Timeline perubahan asli.
    |
    */

    $sourceLog = $timelineLog;

    if (
        ($timelineLog['type'] ?? null) === 'decision'
        && !empty($timelineLog['log_id'])
    ) {

        $originalTimeline = \App\Models\Timeline::find(
            $timelineLog['log_id']
        );

        if ($originalTimeline) {
            $sourceLog = $originalTimeline->log ?? [];
        }
    }


    /*
    |--------------------------------------------------------------------------
    | DATA PERUBAHAN
    |--------------------------------------------------------------------------
    */

    $data = $sourceLog['data'] ?? [];

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
    |--------------------------------------------------------------------------
    | ACTION
    |--------------------------------------------------------------------------
    |
    | Untuk Timeline keputusan, action berasal dari Timeline
    | keputusan. Untuk Timeline biasa berasal dari Timeline
    | perubahan.
    |
    */

    if ($type === 'decision') {

        $action = $timelineLog['action']
            ?? $timelineLog['decision']
            ?? 'Keputusan';

    } else {

        $action = $sourceLog['action']
            ?? 'Aktivitas';
    }


    /*
    |--------------------------------------------------------------------------
    | JENIS DATA
    |--------------------------------------------------------------------------
    */

    $openedWith = $sourceLog['opened_with']
        ?? 'Tidak diketahui';


    /*
    |--------------------------------------------------------------------------
    | PENGIRIM
    |--------------------------------------------------------------------------
    */

    $sender = null;

    if ($type === 'decision') {

        /*
         * Pada Timeline keputusan:
         *
         * send_id = ID User admin.
         *
         * Jadi cari User terlebih dahulu.
         */
        if (!empty($timelineLog['send_id'])) {

            $senderUser = \App\Models\User::find(
                $timelineLog['send_id']
            );

            $sender = $senderUser?->dataPribadi;
        }

    } else {

        /*
         * Pada Timeline perubahan:
         *
         * send_id = ID DataPribadi user.
         */
        if (!empty($sourceLog['send_id'])) {

            $sender = \App\Models\DataPribadi::find(
                $sourceLog['send_id']
            );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | FIELD YANG BERUBAH
    |--------------------------------------------------------------------------
    */

    $changeKeys = array_unique(
        array_merge(
            array_keys($oldData),
            array_keys($newData)
        )
    );

@endphp


<div class="container-fluid px-0">

    <div class="card border-0 shadow-sm">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="card-header bg-success text-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="small opacity-75">
                        NOTIFIKASI
                    </div>

                    <h4 class="fw-bold mb-0">

                        @if($type === 'decision')

                            @if($decision === 'approved')

                                Keputusan Disetujui

                            @elseif($decision === 'rejected')

                                Keputusan Ditolak

                            @elseif($decision === 'pending')

                                Keputusan Ditunda

                            @else

                                Keputusan Admin

                            @endif

                        @else

                            {{ ucfirst($action) }}

                        @endif

                    </h4>

                </div>


                {{-- STATUS --}}

                <div class="d-flex gap-2 flex-wrap">

                    @if($status === 'unread')

                        <span class="badge bg-light text-dark px-3 py-2">
                            Belum Dibaca
                        </span>

                    @else

                        <span class="badge bg-light text-dark px-3 py-2">
                            ✓ Dibaca
                        </span>

                    @endif


                    @if($decision === 'approved')

                        <span class="badge bg-primary px-3 py-2">
                            Disetujui
                        </span>

                    @elseif($decision === 'rejected')

                        <span class="badge bg-danger px-3 py-2">
                            Ditolak
                        </span>

                    @elseif($decision === 'pending')

                        <span class="badge bg-warning text-dark px-3 py-2">
                            Ditunda
                        </span>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
             BODY
        ====================================================== --}}

        <div class="card-body p-4">


            {{-- =================================================
                 INFORMASI TIMELINE
            ================================================== --}}

            <div class="mb-4">

                <h5 class="fw-bold mb-3">
                    Informasi Timeline
                </h5>

                <div class="row g-3">


                    {{-- AKTIVITAS --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Aktivitas
                        </div>

                        <div class="fw-semibold">
                            {{ ucfirst($action) }}
                        </div>

                    </div>


                    {{-- JENIS DATA --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Jenis Data
                        </div>

                        <div class="fw-semibold">

                            {{ ucfirst(
                                str_replace(
                                    '_',
                                    ' ',
                                    $openedWith
                                )
                            ) }}

                        </div>

                    </div>


                    {{-- WAKTU --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Waktu
                        </div>

                        <div class="fw-semibold">

                            {{ $timeline->created_at
                                ->format('d-m-Y H:i:s')
                            }}

                        </div>

                    </div>


                    {{-- STATUS --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Status Notifikasi
                        </div>

                        <div class="fw-semibold">
                            {{ ucfirst($status) }}
                        </div>

                    </div>


                    {{-- KEPUTUSAN --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Keputusan
                        </div>

                        <div class="fw-semibold">

                            @if($decision)

                                {{ ucfirst($decision) }}

                            @else

                                <span class="text-muted">
                                    Belum ada keputusan
                                </span>

                            @endif

                        </div>

                    </div>


                    {{-- PENGIRIM --}}

                    <div class="col-md-4">

                        <div class="text-muted small">
                            Pengirim
                        </div>

                        <div class="fw-semibold">

                            {{ $sender?->Nama ?? '-' }}

                        </div>

                    </div>

                </div>

            </div>


            <hr>


            {{-- =================================================
                 PERUBAHAN DATA
            ================================================== --}}

            @if($type !== 'decision')

                <div class="mt-4">


                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="fw-bold mb-0">
                            Perubahan Data
                        </h5>

                        @if(count($changeKeys) > 0)

                            <span class="badge bg-success">

                                {{ count($changeKeys) }}
                                perubahan

                            </span>

                        @endif

                    </div>


                    @if(count($changeKeys) > 0)

                        <div class="border rounded overflow-hidden">


                            {{-- HEADER TABEL --}}

                            <div class="row g-0 bg-light border-bottom">

                                <div class="col-md-3 px-3 py-3 fw-bold">
                                    Field
                                </div>

                                <div class="col-md-4 px-3 py-3 fw-bold">
                                    Data Sebelumnya
                                </div>

                                <div class="col-md-5 px-3 py-3 fw-bold">
                                    Data Baru
                                </div>

                            </div>


                            {{-- DATA PERUBAHAN --}}

                            @foreach($changeKeys as $key)

                                @php

                                    $oldValue =
                                        $oldData[$key] ?? null;

                                    $newValue =
                                        $newData[$key] ?? null;

                                @endphp


                                <div class="row g-0
                                    {{ !$loop->last
                                        ? 'border-bottom'
                                        : ''
                                    }}">


                                    {{-- FIELD --}}

                                    <div class="col-md-3 px-3 py-3 fw-bold">

                                        {{ ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $key
                                            )
                                        ) }}

                                    </div>


                                    {{-- DATA LAMA --}}

                                    <div class="col-md-4 px-3 py-3">

                                        @if(is_null($oldValue))

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @elseif(is_bool($oldValue))

                                            {{ $oldValue
                                                ? 'Ya'
                                                : 'Tidak'
                                            }}

                                        @elseif(is_array($oldValue))

                                            <pre class="mb-0 small">{{ json_encode(
                                                $oldValue,
                                                JSON_PRETTY_PRINT |
                                                JSON_UNESCAPED_UNICODE
                                            ) }}</pre>

                                        @else

                                            {{ $oldValue }}

                                        @endif

                                    </div>


                                    {{-- DATA BARU --}}

                                    <div class="col-md-5 px-3 py-3">

                                        @if(is_null($newValue))

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @elseif(is_bool($newValue))

                                            {{ $newValue
                                                ? 'Ya'
                                                : 'Tidak'
                                            }}

                                        @elseif(is_array($newValue))

                                            <pre class="mb-0 small">{{ json_encode(
                                                $newValue,
                                                JSON_PRETTY_PRINT |
                                                JSON_UNESCAPED_UNICODE
                                            ) }}</pre>

                                        @else

                                            {{ $newValue }}

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>


                    @else

                        <div class="alert alert-light border text-muted mb-0">

                            Tidak ada perubahan data.

                        </div>

                    @endif

                </div>

            @endif


            {{-- =================================================
                 HASIL KEPUTUSAN
            ================================================== --}}

            @if($type === 'decision' && $decision)

                <hr class="my-4">

                <div>

                    <h5 class="fw-bold mb-3">
                        Hasil Keputusan
                    </h5>


                    @if($decision === 'approved')

                        <div class="alert alert-primary mb-0">

                            <strong>
                                ✓ Disetujui
                            </strong>

                            <div class="small mt-1">
                                Perubahan data telah disetujui
                                oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'rejected')

                        <div class="alert alert-danger mb-0">

                            <strong>
                                ✕ Ditolak
                            </strong>

                            <div class="small mt-1">
                                Perubahan data telah ditolak
                                oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'pending')

                        <div class="alert alert-warning mb-0">

                            <strong>
                                ⏳ Ditunda
                            </strong>

                            <div class="small mt-1">
                                Perubahan data masih menunggu
                                keputusan lebih lanjut.
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- =================================================
                 KEPUTUSAN ADMIN
            ================================================== --}}

            @if(
                auth()->user()->roles->contains('name', 'admin')
                && $type !== 'decision'
                && !$decision
            )

                <hr class="my-4">

                <div>

                    <h5 class="fw-bold mb-2">
                        Keputusan
                    </h5>

                    <p class="text-muted mb-3">
                        Tentukan keputusan terhadap perubahan
                        data yang dikirim oleh user.
                    </p>


                    <div class="d-flex gap-2 flex-wrap">


                        {{-- APPROVED --}}

                        <form
                            action="{{ route(
                                'timeline.decision',
                                [
                                    'id' => $timeline->id,
                                    'decision' => 'approved',
                                ]
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-success px-4"
                            >
                                ✓ Setujui
                            </button>

                        </form>


                        {{-- REJECTED --}}

                        <form
                            action="{{ route(
                                'timeline.decision',
                                [
                                    'id' => $timeline->id,
                                    'decision' => 'rejected',
                                ]
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-danger px-4"
                            >
                                ✕ Tolak
                            </button>

                        </form>


                        {{-- PENDING --}}

                        <form
                            action="{{ route(
                                'timeline.decision',
                                [
                                    'id' => $timeline->id,
                                    'decision' => 'pending',
                                ]
                            ) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-warning text-dark px-4"
                            >
                                ⏳ Tunda
                            </button>

                        </form>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 KEPUTUSAN PADA TIMELINE ASLI
            ================================================== --}}

            @if(
                $type !== 'decision'
                && $decision
            )

                <hr class="my-4">

                <div>

                    <h5 class="fw-bold mb-3">
                        Hasil Keputusan
                    </h5>


                    @if($decision === 'approved')

                        <div class="alert alert-primary mb-0">

                            <strong>
                                ✓ Disetujui
                            </strong>

                            <div class="small mt-1">
                                Perubahan data telah disetujui
                                oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'rejected')

                        <div class="alert alert-danger mb-0">

                            <strong>
                                ✕ Ditolak
                            </strong>

                            <div class="small mt-1">
                                Perubahan data telah ditolak
                                oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'pending')

                        <div class="alert alert-warning mb-0">

                            <strong>
                                ⏳ Ditunda
                            </strong>

                            <div class="small mt-1">
                                Perubahan data masih menunggu
                                keputusan lebih lanjut.
                            </div>

                        </div>

                    @endif

                </div>

            @endif

        </div>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        <div class="card-footer bg-transparent py-3">


            @if(
                !empty($sourceLog['pageUrl'])
                && $type !== 'decision'
            )

                <a
                    href="{{ $sourceLog['pageUrl'] }}"
                    class="btn btn-success me-2"
                >
                    Buka Data
                </a>

            @endif


            <a
                href="{{ route('timeline.index') }}"
                class="btn btn-secondary"
            >
                ← Kembali
            </a>

        </div>

    </div>

</div>

@endsection