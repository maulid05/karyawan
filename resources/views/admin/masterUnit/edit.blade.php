@extends('layouts.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Edit Unit
        </h3>

        <p class="text-muted mb-0">
            Perbarui informasi master unit.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ pageUrl(
                'MasterUnitController',
                'update',
                $data->id
            ) }}"
                  method="POST">

                @csrf
                @method('PUT')


                {{-- Nama Unit --}}
                <div class="mb-3">

                    <label for="Nama_Unit"
                           class="form-label fw-semibold">

                        Nama Unit

                    </label>

                    <input type="text"
                           id="Nama_Unit"
                           name="Nama_Unit"
                           value="{{ old(
                               'Nama_Unit',
                               $data->Nama_Unit
                           ) }}"
                           class="form-control
                                  @error('Nama_Unit')
                                      is-invalid
                                  @enderror"
                           placeholder="Masukkan nama unit"
                           required>

                    @error('Nama_Unit')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Status --}}
                <div class="mb-4">

                    <label for="Status"
                           class="form-label fw-semibold">

                        Status

                    </label>

                    <select name="Status"
                            id="Status"
                            class="form-select
                                   @error('Status')
                                       is-invalid
                                   @enderror"
                            required>

                        <option value="">
                            -- Pilih Status --
                        </option>

                        <option value="Aktif"
                            {{ old(
                                'Status',
                                $data->Status
                            ) === 'Aktif'
                                ? 'selected'
                                : '' }}>

                            Aktif

                        </option>

                        <option value="Tidak Aktif"
                            {{ old(
                                'Status',
                                $data->Status
                            ) === 'Tidak Aktif'
                                ? 'selected'
                                : '' }}>

                            Tidak Aktif

                        </option>

                    </select>

                    @error('Status')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Tombol --}}
                <div class="d-flex gap-2">

                    <a href="{{ pageUrl(
                        'MasterUnitController'
                    ) }}"
                       class="btn btn-secondary">

                        Batal

                    </a>

                    <button type="submit"
                            class="btn btn-success">

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
