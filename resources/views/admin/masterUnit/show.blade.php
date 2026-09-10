@extends('layouts.layout')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold mb-1">
            Detail Master Unit
        </h3>

        <p class="text-muted mb-0">
            Informasi detail unit.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row g-3">

                {{-- Nama Unit --}}
                <div class="col-12">

                    <label class="form-label
                                  text-muted
                                  mb-1">

                        Nama Unit

                    </label>

                    <div class="form-control bg-light">

                        {{ $data->Nama_Unit }}

                    </div>

                </div>


                {{-- Status --}}
                <div class="col-md-6">

                    <label class="form-label
                                  text-muted
                                  mb-1">

                        Status

                    </label>

                    <div>

                        @if($data->Status === 'Aktif')

                            <span class="badge bg-success fs-6">
                                Aktif
                            </span>

                        @else

                            <span class="badge bg-secondary fs-6">
                                {{ $data->Status }}
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Dibuat --}}
                <div class="col-md-6">

                    <label class="form-label
                                  text-muted
                                  mb-1">

                        Dibuat

                    </label>

                    <div class="form-control bg-light">

                        {{ $data->created_at?->format('d-m-Y H:i') }}

                    </div>

                </div>


                {{-- Diperbarui --}}
                <div class="col-md-6">

                    <label class="form-label
                                  text-muted
                                  mb-1">

                        Terakhir Diperbarui

                    </label>

                    <div class="form-control bg-light">

                        {{ $data->updated_at?->format('d-m-Y H:i') }}

                    </div>

                </div>

            </div>


            {{-- Tombol --}}
            <div class="d-flex gap-2 mt-4">

                <a href="{{ pageUrl(
                    'MasterUnitController'
                ) }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

                <a href="{{ pageUrl(
                    'MasterUnitController',
                    'edit',
                    $data->id
                ) }}"
                   class="btn btn-warning">

                    Edit

                </a>

            </div>

        </div>

    </div>

</div>

@endsection