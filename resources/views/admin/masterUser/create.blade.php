@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Tambah User
        </h3>

        <p class="text-muted">
            Tambahkan User baru ke master User.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ pageUrl(
                    'MasterUserController',
                    'store'
                ) }}"
                method="POST"
            >

                @csrf

                {{-- Nama User --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama User
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}"
                        required
                    >

                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- password --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        value="{{ old('password') }}"
                        required
                    >

                </div>

                {{-- Tombol --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ pageUrl('MasterUserController') }}"
                        class="btn btn-secondary"
                    >
                        Kembali
                    </a>

                    <button
                        type="submit"
                        class="btn btn-success"
                    >
                        Simpan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection