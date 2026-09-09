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
            Edit {{ $title }}
        </h3>


        <form
            action="{{ pageUrl(
                $currentController,
                'update',
                $data->id
            ) }}"
            method="POST"
        >

            @csrf

            @method('PUT')


            @foreach($visibleColumns as $column)

                @php

                    $lower = strtolower($column);


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


                    $value = old(
                        $column,
                        $data->{$column}
                    );

                @endphp


                <div class="mb-3">


                    <label class="form-label fw-semibold">

                        {{ ucwords(
                            str_replace(
                                '_',
                                ' ',
                                $column
                            )
                        ) }}

                    </label>


                    @if($type === 'textarea')

                        <textarea
                            name="{{ $column }}"
                            class="form-control"
                            rows="4"
                        >{{ $value }}</textarea>

                    @else

                        <input
                            type="{{ $type }}"
                            name="{{ $column }}"
                            value="{{ $value }}"
                            class="form-control"
                        >

                    @endif


                    @error($column)

                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>

                    @enderror


                </div>

            @endforeach


            <div class="d-flex gap-2 mt-4">


                <button
                    type="submit"
                    class="btn btn-success"
                >
                    Simpan Perubahan
                </button>


                <a
                    href="{{ pageUrl(
                        $currentController
                    ) }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>


            </div>


        </form>

    </div>

</div>

@endsection