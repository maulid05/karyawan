@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="mb-4">

        <h3 class="fw-bold">
            Detail Master Jabatan
        </h3>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="mb-3">

                <label class="text-muted">
                    Nama Jabatan
                </label>

                <div class="fw-semibold">
                    {{ $data->Nama_Jabatan }}
                </div>

            </div>


            <div class="mb-3">

                <label class="text-muted">
                    Jenis Jabatan
                </label>

                <div>
                    {{ $data->Jenis_Jabatan ?? '-' }}
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
                    href="{{ pageUrl('MasterJabatanController') }}"
                    class="btn btn-secondary"
                >
                    Kembali
                </a>

                <a
                    href="{{ pageUrl(
                        'MasterJabatanController',
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