@extends('layouts.layout')

@section('title', 'Tambah Navigation')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="mb-4">

                        <h4 class="fw-bold mb-1">
                            Tambah Navigation
                        </h4>

                        <p class="text-muted mb-0">
                            Tambahkan navigation untuk jabatan struktural tertentu.
                        </p>

                    </div>


                    {{-- Validation Error --}}
                    @if($errors->any())

                        <div class="alert alert-danger">

                            <strong>
                                Terjadi kesalahan:
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    <form action="{{ pageUrl('NavController', 'store') }}"
                          method="POST">

                        @csrf


                        {{-- Jabatan Struktural --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Jabatan Struktural
                            </label>

                            <select name="jabatan_struktural_id"
                                    class="form-select @error('jabatan_struktural_id') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Pilih Jabatan --
                                </option>

                                @foreach($jabatanStrukturals as $jabatan)

                                    <option value="{{ $jabatan->id }}"
                                        {{ old('jabatan_struktural_id') == $jabatan->id ? 'selected' : '' }}>

                                        {{ $jabatan->Nama_Jabatan }}

                                    </option>

                                @endforeach

                            </select>

                            @error('jabatan_struktural_id')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Nama Navigation --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Nama Navigation
                            </label>

                            <input type="text"
                                   name="Nama"
                                   class="form-control @error('Nama') is-invalid @enderror"
                                   value="{{ old('Nama') }}"
                                   placeholder="Contoh: Data Pribadi"
                                   required>

                            @error('Nama')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Controller --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Controller
                            </label>

                            <select name="Controller"
                                    id="Controller"
                                    class="form-select @error('Controller') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Pilih Controller --
                                </option>

                                @foreach($controllers as $controller)

                                    <option value="{{ $controller }}"
                                        {{ old('Controller') == $controller ? 'selected' : '' }}>

                                        {{ $controller }}

                                    </option>

                                @endforeach

                            </select>

                            @error('Controller')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Method --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Method
                            </label>

                            <select name="Method"
                                    id="Method"
                                    class="form-select @error('Method') is-invalid @enderror"
                                    required>

                                <option value="">
                                    -- Pilih Controller terlebih dahulu --
                                </option>

                            </select>

                            @error('Method')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">

                            <a href="{{ pageUrl('NavController') }}"
                               class="btn btn-secondary">

                                <i class="bi bi-arrow-left"></i>
                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-success">

                                <i class="bi bi-save"></i>
                                Simpan Navigation

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection


@section('js')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const controllerSelect =
        document.getElementById('Controller');

    const methodSelect =
        document.getElementById('Method');

    const controllerMethods =
        @json($controllerMethods);


    function loadMethods(
        controller,
        selectedMethod = ''
    ) {

        methodSelect.innerHTML = '';

        const defaultOption =
            document.createElement('option');

        defaultOption.value = '';
        defaultOption.textContent =
            '-- Pilih Method --';

        methodSelect.appendChild(defaultOption);


        if (
            !controller ||
            !controllerMethods[controller]
        ) {
            return;
        }


        controllerMethods[controller].forEach(
            function (method) {

                const option =
                    document.createElement('option');

                option.value = method;
                option.textContent = method;

                if (
                    method === selectedMethod
                ) {
                    option.selected = true;
                }

                methodSelect.appendChild(option);

            }
        );

    }


    controllerSelect.addEventListener(
        'change',
        function () {

            loadMethods(this.value);

        }
    );


    loadMethods(
        controllerSelect.value,
        @json(old('Method'))
    );

});

</script>

@endsection