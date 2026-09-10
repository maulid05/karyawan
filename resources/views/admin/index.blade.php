@extends('layouts.layout')

@section('content')

<div class="container-fluid">

    {{-- Judul --}}
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Dashboard Admin</h3>
        <p class="text-muted mb-0">
            Ringkasan data sistem
        </p>
    </div>

    {{-- Statistik User --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="mb-2">Total User</h6>
                    <h2 class="fw-bold mb-0">
                        {{ $totalUsers }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="mb-2">Total Client</h6>
                    <h2 class="fw-bold mb-0">
                        {{ $totalClients }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="mb-2">Total Admin</h6>
                    <h2 class="fw-bold mb-0">
                        {{ $totalAdmins }}
                    </h2>
                </div>
            </div>
        </div>

    </div>


    {{-- Statistik Data --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        Jabatan Struktural
                    </h6>

                    <h2 class="fw-bold text-success">
                        {{ $totalJabatanStruktural }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        Diklat
                    </h6>

                    <h2 class="fw-bold text-success">
                        {{ $totalDiklat }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h6 class="text-muted">
                        Penempatan
                    </h6>

                    <h2 class="fw-bold text-success">
                        {{ $totalPenempatan }}
                    </h2>
                </div>
            </div>
        </div>

    </div>


    {{-- User Terbaru --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                User Terbaru
            </h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="px-3">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($latestUsers as $user)

                            <tr>
                                <td class="px-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $user->name }}
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>
                                    {{ $user->created_at?->format('d-m-Y H:i') }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    Belum ada user.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection