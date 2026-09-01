@extends('auth/app')

@section('content')

<div class="container-fluid h-100">
    <div class="row h-100 align-items-center justify-content-center g-5 p-4 p-md-5">

        <div class="col-12 col-md-6 text-center text-white">

            <h1 class="fw-bold">
                SIMAK UNIBA
            </h1>

            <p class="fs-5">
                Silakan daftarkan akun Anda
            </p>

            <small>
                Buat akun untuk mengakses SIstem inforMAsi Karyawan
                UNIBA MADURA.
            </small>

        </div>

        <div class="col-12 col-md-6">

            <div class="text-white mb-4">
                <h3 class="fw-bold mb-1">
                    Masuk
                </h3>

                <small>
                    Masukan Email dan Sandi Anda
                </small>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="login-form" action="{{ route('login') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label text-white">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value=""
                        class="form-control"
                        placeholder="Masukkan email"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label text-white">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >

                </div>
                <button
                    type="submit"
                    class="btn btn-primary w-100 fw-semibold mb-2"
                >
                    Login
                </button>


                <button
                    type="button"
                    id="show-register"
                    class="btn btn-outline-light w-100"
                >
                    Belum punya akun
                </button>

            </form>

        </div>

    </div>
</div>

@endsection