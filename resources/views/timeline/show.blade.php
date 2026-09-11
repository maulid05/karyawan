@extends('layouts.layout')

@section('title', 'Detail Notifikasi')

@section('content')

@php
    $log = $timeline->log ?? [];

    //dd($log['log_id']);
    //dd($log, \App\Models\Timeline::find($log['log_id'])->log, \App\Models\DataPribadi::find($log['send_id'])->Nama);
    if (!isset($log['log_id'])) {
        $type = $log['type'] ?? 'data_update';
        $action = $log['action'] ?? 'Aktivitas';
        $status = $log['status'] ?? 'done';
        $decision = $log['decision'] ?? null;
        $openedWith = $log['opened_with'] ?? 'Tidak diketahui';

        $data = $log['data'] ?? [];
        $changes = $data['changes'] ?? [];

        $sender = \App\Models\DataPribadi::find($log['send_id']);
    }else{
        $lastlog = $log;
        $log = \App\Models\Timeline::find(
            $lastlog['log_id'])->log;
        $type = $log['type'] ?? 'data_update';
        $action = $log['action'] ?? 'Aktivitas';
        $status = $log['status'] ?? 'done';
        $decision = $log['decision'] ?? null;
        $openedWith = $log['opened_with'] ?? 'Tidak diketahui';

        $data = $log['data'] ?? [];
        $changes = $data['changes'] ?? [];

        $sender = \App\Models\DataPribadi::find($timeline['user_id']);
    }
    

@endphp


<div class="container-fluid px-0">

    <div class="card border-0 shadow-sm">

        {{-- HEADER --}}
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
                <div class="d-flex gap-2">

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


        {{-- BODY --}}
        <div class="card-body p-4">

            {{-- INFORMASI --}}
            <div class="mb-4">

                <h5 class="fw-bold mb-3">
                    Informasi Timeline
                </h5>

                <div class="row g-3">

                    {{-- Aktivitas --}}
                    <div class="col-md-4">

                        <div class="text-muted small">
                            Aktivitas
                        </div>

                        <div class="fw-semibold">
                            {{ ucfirst($action) }}
                        </div>

                    </div>


                    {{-- Jenis Data --}}
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


                    {{-- Waktu --}}
                    <div class="col-md-4">

                        <div class="text-muted small">
                            Waktu
                        </div>

                        <div class="fw-semibold">
                            {{ $timeline->created_at->format('d-m-Y H:i:s') }}
                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4">

                        <div class="text-muted small">
                            Status Notifikasi
                        </div>

                        <div class="fw-semibold">
                            {{ ucfirst($status) }}
                        </div>

                    </div>


                    {{-- Keputusan --}}
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


                    {{-- Pengirim --}}
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


            {{-- PERUBAHAN DATA --}}
            @if($type !== 'decision')

                <div class="mt-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h5 class="fw-bold mb-0">
                            Perubahan Data
                        </h5>

                        @if(count($changes) > 0)

                            <span class="badge bg-success">
                                {{ count($changes) }} perubahan
                            </span>

                        @endif

                    </div>


                    @if(count($changes) > 0)

                        <div class="border rounded overflow-hidden">

                            @foreach($changes as $key => $value)

                                <div class="row g-0
                                    {{ !$loop->last ? 'border-bottom' : '' }}">

                                    {{-- FIELD --}}
                                    <div class="col-md-4 bg-light px-3 py-3 fw-bold">

                                        {{ ucfirst(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $key
                                            )
                                        ) }}

                                    </div>


                                    {{-- NILAI --}}
                                    <div class="col-md-8 px-3 py-3">

                                        @if(is_null($value))

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @elseif(is_bool($value))

                                            {{ $value ? 'Ya' : 'Tidak' }}

                                        @elseif(is_array($value))

                                            <pre class="mb-0 small">{{ json_encode(
                                                $value,
                                                JSON_PRETTY_PRINT |
                                                JSON_UNESCAPED_UNICODE
                                            ) }}</pre>

                                        @else

                                            {{ $value }}

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


            {{-- KEPUTUSAN ADMIN --}}
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
                        Tentukan keputusan terhadap perubahan data
                        yang dikirim oleh user.
                    </p>


                    <div class="d-flex gap-2 flex-wrap">

                        {{-- APPROVED --}}
                        <form
                            action="{{ route('timeline.decision', [
                                'id' => $timeline->id,
                                'decision' => 'approved',
                            ]) }}"
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
                            action="{{ route('timeline.decision', [
                                'id' => $timeline->id,
                                'decision' => 'rejected',
                            ]) }}"
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
                            action="{{ route('timeline.decision', [
                                'id' => $timeline->id,
                                'decision' => 'pending',
                            ]) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="btn btn-warning px-4"
                            >
                                ⏳ Tunda
                            </button>

                        </form>

                    </div>

                </div>


            @elseif($decision)

                {{-- HASIL KEPUTUSAN --}}
                <hr class="my-4">

                <div>

                    <h5 class="fw-bold mb-3">
                        Hasil Keputusan
                    </h5>


                    @if($decision === 'approved')

                        <div class="alert alert-primary mb-0">

                            <strong>✓ Disetujui</strong>

                            <div class="small mt-1">
                                Perubahan data telah disetujui oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'rejected')

                        <div class="alert alert-danger mb-0">

                            <strong>✕ Ditolak</strong>

                            <div class="small mt-1">
                                Perubahan data telah ditolak oleh admin.
                            </div>

                        </div>


                    @elseif($decision === 'pending')

                        <div class="alert alert-warning mb-0">

                            <strong>⏳ Ditunda</strong>

                            <div class="small mt-1">
                                Perubahan data masih menunggu keputusan
                                lebih lanjut.
                            </div>

                        </div>

                    @endif

                </div>

            @endif

        </div>


        {{-- FOOTER --}}
        <div class="card-footer bg-transparent py-3">

            @if(!empty($log['pageUrl']) && $type !== 'decision')

                <a
                    href="{{ $log['pageUrl'] }}"
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