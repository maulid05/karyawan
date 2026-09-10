@extends('layouts.layout')

@section('title', 'Detail Navigation')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- Header --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <h4 class="fw-bold mb-1">
                                Detail Navigation
                            </h4>

                            <p class="text-muted mb-0">
                                Informasi navigation.
                            </p>

                        </div>

                    </div>


                    {{-- Nama --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Nama Navigation
                        </label>

                        <div class="fw-semibold fs-5">
                            {{ $data->Nama }}
                        </div>

                    </div>


                    {{-- Jabatan --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Jabatan Struktural
                        </label>

                        <div class="fw-semibold">

                            {{ $data->jabatanStruktural?->Nama_Jabatan ?? '-' }}

                        </div>

                    </div>


                    {{-- Controller --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Controller
                        </label>

                        <div>

                            <code class="fs-6">
                                {{ $data->Controller }}
                            </code>

                        </div>

                    </div>


                    {{-- Method --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Method
                        </label>

                        <div>

                            <code class="fs-6">
                                {{ $data->Method }}
                            </code>

                        </div>

                    </div>


                    {{-- Created --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Dibuat
                        </label>

                        <div>
                            {{ $data->created_at?->format('d F Y H:i') ?? '-' }}
                        </div>

                    </div>


                    {{-- Updated --}}
                    <div class="mb-4">

                        <label class="text-muted small">
                            Terakhir Diperbarui
                        </label>

                        <div>
                            {{ $data->updated_at?->format('d F Y H:i') ?? '-' }}
                        </div>

                    </div>


                    {{-- Tombol --}}
                    <div class="d-flex gap-2">

                        <a href="{{ pageUrl('NavController') }}"
                           class="btn btn-secondary">

                            <i class="bi bi-arrow-left"></i>
                            Kembali

                        </a>


                        <a href="{{ pageUrl(
                            'NavController',
                            'edit',
                            $data->id
                        ) }}"
                           class="btn btn-warning">

                            <i class="bi bi-pencil"></i>
                            Edit

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection