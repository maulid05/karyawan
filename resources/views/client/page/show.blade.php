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


        <div
            class="d-flex justify-content-between align-items-center mb-4"
        >

            <h3 class="fw-bold mb-0">
                {{ $title }}
            </h3>


            <a
                href="{{ pageUrl(
                    $currentController,
                    'edit',
                    $data->id
                ) }}"
                class="btn btn-warning"
            >
                Edit
            </a>

        </div>


        @foreach($visibleColumns as $column)

            <div class="row border-bottom py-3">


                <div class="col-md-4 fw-semibold">

                    {{ ucwords(
                        str_replace(
                            '_',
                            ' ',
                            $column
                        )
                    ) }}

                </div>


                <div class="col-md-8">

                    {{ $data->{$column} }}

                </div>


            </div>

        @endforeach


        <div class="mt-4">

            <a
                href="{{ pageUrl(
                    $currentController
                ) }}"
                class="btn btn-secondary"
            >
                Kembali
            </a>

        </div>


    </div>

</div>

@endsection