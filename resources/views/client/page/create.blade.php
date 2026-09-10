@extends('layouts.layout')

@section('title', $title)

@section('content')

@php

    $systemColumns = [
        'id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    $visibleColumns = array_values(
        array_filter(
            $columns,
            fn ($column) =>
                !in_array(
                    $column,
                    $systemColumns
                )
        )
    );

@endphp


<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <h3 class="fw-bold mb-4">
            Tambah {{ $title }}
        </h3>


        <form
            action="{{ pageUrl(
                $currentController,
                'store'
            ) }}"
            method="POST"
        >

            @csrf


            @foreach($visibleColumns as $column)

                @php

                    $lower = strtolower($column);

                    /*
                    |--------------------------------------------------------------------------
                    | Field khusus
                    |--------------------------------------------------------------------------
                    */

                    $isJabatan =
                        $column === 'Nama_Jabatan';

                    $isUnit =
                        $column === 'Unit';

                    $isStatus =
                        $column === 'Status';


                    /*
                    |--------------------------------------------------------------------------
                    | Deteksi tipe input otomatis
                    |--------------------------------------------------------------------------
                    */

                    if (
                        str_contains($lower, 'keterangan') ||
                        str_contains($lower, 'deskripsi') ||
                        str_contains($lower, 'alamat') ||
                        str_contains($lower, 'catatan')
                    ) {

                        $type = 'textarea';

                    } elseif (
                        str_contains($lower, 'tanggal') ||
                        str_contains($lower, 'tgl') ||
                        str_contains($lower, 'date')
                    ) {

                        $type = 'date';

                    } elseif (
                        str_contains($lower, 'jumlah') ||
                        str_contains($lower, 'nilai') ||
                        str_contains($lower, 'angka') ||
                        str_contains($lower, 'umur') ||
                        str_contains($lower, 'tahun')
                    ) {

                        $type = 'number';

                    } elseif (
                        str_contains($lower, 'email')
                    ) {

                        $type = 'email';

                    } elseif (
                        str_contains($lower, 'telp') ||
                        str_contains($lower, 'phone') ||
                        str_contains($lower, 'telepon')
                    ) {

                        $type = 'tel';

                    } else {

                        $type = 'text';

                    }

                @endphp


                <div class="mb-3">


                    {{-- Label --}}
                    <label
                        class="form-label fw-semibold"
                    >

                        {{ ucwords(
                            str_replace(
                                '_',
                                ' ',
                                $column
                            )
                        ) }}

                    </label>


                    {{-- ========================================================= --}}
                    {{-- STATUS --}}
                    {{-- ========================================================= --}}

                    @if($isStatus)

                        <select
                            name="{{ $column }}"
                            class="form-select
                                @error($column)
                                    is-invalid
                                @enderror"
                        >

                            <option value="">
                                -- Pilih Status --
                            </option>

                            <option
                                value="Aktif"
                                {{ old($column) === 'Aktif'
                                    ? 'selected'
                                    : '' }}
                            >
                                Aktif
                            </option>

                            <option
                                value="Tidak Aktif"
                                {{ old($column) === 'Tidak Aktif'
                                    ? 'selected'
                                    : '' }}
                            >
                                Tidak Aktif
                            </option>

                        </select>


                    {{-- ========================================================= --}}
                    {{-- MASTER JABATAN --}}
                    {{-- ========================================================= --}}

                    @elseif($isJabatan)

                        <select
                            name="{{ $column }}"
                            class="form-select
                                @error($column)
                                    is-invalid
                                @enderror"
                        >

                            <option value="">
                                -- Pilih Jabatan --
                            </option>


                            @foreach($masterJabatans ?? [] as $jabatan)

                                <option
                                    value="{{ $jabatan->Nama_Jabatan }}"
                                    {{ old($column) === $jabatan->Nama_Jabatan
                                        ? 'selected'
                                        : '' }}
                                >

                                    {{ $jabatan->Nama_Jabatan }}

                                </option>

                            @endforeach

                        </select>


                    {{-- ========================================================= --}}
                    {{-- MASTER UNIT --}}
                    {{-- ========================================================= --}}

                    @elseif($isUnit)

                        <select
                            name="{{ $column }}"
                            class="form-select
                                @error($column)
                                    is-invalid
                                @enderror"
                        >

                            <option value="">
                                -- Pilih Unit --
                            </option>


                            @foreach($masterUnits ?? [] as $unit)

                                <option
                                    value="{{ $unit->Nama_Unit }}"
                                    {{ old($column) === $unit->Nama_Unit
                                        ? 'selected'
                                        : '' }}
                                >

                                    {{ $unit->Nama_Unit }}

                                </option>

                            @endforeach

                        </select>


                    {{-- ========================================================= --}}
                    {{-- TEXTAREA --}}
                    {{-- ========================================================= --}}

                    @elseif($type === 'textarea')

                        <textarea
                            name="{{ $column }}"
                            class="form-control
                                @error($column)
                                    is-invalid
                                @enderror"
                            rows="4"
                        >{{ old($column) }}</textarea>


                    {{-- ========================================================= --}}
                    {{-- INPUT BIASA --}}
                    {{-- ========================================================= --}}

                    @else

                        <input
                            type="{{ $type }}"
                            name="{{ $column }}"
                            value="{{ old($column) }}"
                            class="form-control
                                @error($column)
                                    is-invalid
                                @enderror"
                        >

                    @endif


                    {{-- Validation Error --}}
                    @error($column)

                        <div class="text-danger small mt-1">

                            {{ $message }}

                        </div>

                    @enderror


                </div>

            @endforeach


            {{-- ========================================================= --}}
            {{-- BUTTON --}}
            {{-- ========================================================= --}}

            <div class="d-flex gap-2 mt-4">


                <button
                    type="submit"
                    class="btn btn-success"
                >

                    Simpan

                </button>


                <a
                    href="{{ pageUrl(
                        $currentController
                    ) }}"
                    class="btn btn-secondary"
                >

                    Kembali

                </a>


            </div>


        </form>

    </div>

</div>

@endsection