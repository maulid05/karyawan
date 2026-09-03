@extends('SuperAdmin.app')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">Profile</h4>
        <p class="text-muted mb-0">
            Informasi akun dan data pribadi
        </p>
    </div>

    <div class="row g-4">

        {{-- Profile Card --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center p-4">

                    {{-- Foto --}}
                    <div class="mb-3">
                        <div
                            class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                            style="width: 100px; height: 100px; font-size: 36px;"
                        >
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </div>

                    <h5 class="fw-bold mb-1">
                        {{ $user->Nama }}
                    </h5>

                    <hr class="my-4">

                    <div class="text-start">

                        <div class="mb-3">
                            <small class="text-muted d-block">
                                Email
                            </small>
                            <span>
                                {{ $user->email }}
                            </span>
                        </div>

                        <div>
                            <small class="text-muted d-block">
                                Bergabung
                            </small>
                            <span>
                                {{ $user->created_at?->format('d F Y') ?? '-' }}
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>

</div>

@endsection