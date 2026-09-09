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


<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">
            {{ $title }}
        </h2>

        <p class="text-muted mb-0">
            Daftar {{ strtolower($title) }}
        </p>

    </div>


    <a
        href="{{ pageUrl(
            $currentController,
            'create'
        ) }}"
        class="btn btn-success"
    >
        Tambah Data
    </a>

</div>


@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


@if(session('error'))

    <div class="alert alert-danger">
        {{ session('error') }}
    </div>

@endif


<div class="table-responsive">

    <table class="table table-hover align-middle shadow-sm">


        <thead
            style="
                background:#198754;
                color:white;
            "
        >

            <tr>

                <th style="width:50px">
                    #
                </th>


                @foreach($visibleColumns as $column)

                    <th>

                        {{ ucwords(
                            str_replace(
                                '_',
                                ' ',
                                $column
                            )
                        ) }}

                    </th>

                @endforeach


                <th style="width:220px">
                    Aksi
                </th>

            </tr>

        </thead>


        <tbody>


            @forelse($data as $index => $item)

                <tr>


                    <td>
                        {{ $index + 1 }}
                    </td>


                    @foreach($visibleColumns as $column)

                        <td>
                            {{ $item->{$column} }}
                        </td>

                    @endforeach


                    <td>

                        <div class="d-flex gap-1">


                            {{-- DETAIL --}}

                            <a
                                href="{{ pageUrl(
                                    $currentController,
                                    'show',
                                    $item->id
                                ) }}"
                                class="btn btn-sm btn-info text-white"
                            >
                                Detail
                            </a>


                            {{-- EDIT --}}

                            <a
                                href="{{ pageUrl(
                                    $currentController,
                                    'edit',
                                    $item->id
                                ) }}"
                                class="btn btn-sm btn-warning"
                            >
                                Edit
                            </a>


                            {{-- DELETE --}}

                            <form
                                action="{{ pageUrl(
                                    $currentController,
                                    'destroy',
                                    $item->id
                                ) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="
                                    return confirm(
                                        'Yakin ingin menghapus data ini?'
                                    )
                                "
                            >

                                @csrf

                                @method('DELETE')


                                <button
                                    type="submit"
                                    class="btn btn-sm btn-danger"
                                >
                                    Hapus
                                </button>

                            </form>


                        </div>

                    </td>


                </tr>

            @empty


                <tr>

                    <td
                        colspan="{{ count($visibleColumns) + 2 }}"
                        class="text-center py-4"
                    >
                        Belum ada data.
                    </td>

                </tr>


            @endforelse


        </tbody>

    </table>

</div>

@endsection