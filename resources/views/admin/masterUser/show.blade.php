@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="mb-4">

        <h3 class="fw-bold">
            Detail Master User
        </h3>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="mb-3">

                <label class="text-muted">
                    Nama User
                </label>

                <div class="fw-semibold">
                    {{ $data->name }}
                </div>

            </div>


            <div class="mb-3">

                <label class="text-muted">
                    Jenis User
                </label>

                <div>
                    {{ $data->Jenis_User ?? '-' }}
                </div>

            </div>


            <div class="mb-4">

                <label class="text-muted">
                    Status
                </label>

                <div>
                    {{ $data->Status ?? '-' }}
                </div>

            </div>


            <div class="d-flex gap-2">

                <a
                    href="{{ pageUrl('MasterUserController') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <a
                    href="{{ pageUrl(
                        'MasterUserController',
                        'edit',
                        $data->id
                    ) }}"
                    class="btn btn-success"
                >
                    Edit
                </a>

            </div>

        </div>

    </div>

</div>

@endsection