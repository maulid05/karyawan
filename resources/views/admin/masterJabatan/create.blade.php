@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Tambah Jabatan
        </h3>

        <p class="text-muted">
            Tambahkan jabatan baru ke master jabatan.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form
                action="{{ pageUrl(
                    'MasterJabatanController',
                    'store'
                ) }}"
                method="POST"
            >

                @csrf

                {{-- Nama Jabatan --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Jabatan
                    </label>

                    <input
                        type="text"
                        name="Nama_Jabatan"
                        class="form-control @error('Nama_Jabatan') is-invalid @enderror"
                        value="{{ old('Nama_Jabatan') }}"
                        required
                    >

                    @error('Nama_Jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Jenis Jabatan --}}
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Jenis Jabatan
                    </label>

                    <select
                        name="Jenis_Jabatan"
                        class="form-select"
                    >

                        <option value="">
                            -- Pilih Jenis Jabatan --
                        </option>

                        <option
                            value="Struktural"
                            @selected(old('Jenis_Jabatan') === 'Struktural')
                        >
                            Struktural
                        </option>

                        <option
                            value="Fungsional"
                            @selected(old('Jenis_Jabatan') === 'Fungsional')
                        >
                            Fungsional
                        </option>

                    </select>

                </div>


                {{-- Status --}}
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select
                        name="Status"
                        class="form-select"
                    >

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option
                            value="Aktif"
                            @selected(old('Status') === 'Aktif')
                        >
                            Aktif
                        </option>

                        <option
                            value="Tidak Aktif"
                            @selected(old('Status') === 'Tidak Aktif')
                        >
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                {{-- Tombol --}}
                <div class="d-flex gap-2">

                    <a
                        href="{{ pageUrl('MasterJabatanController') }}"
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