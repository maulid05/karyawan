@extends('layouts.layout')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Master Jabatan
            </h3>

            <p class="text-muted mb-0">
                Daftar jabatan yang tersedia dalam sistem.
            </p>
        </div>

        <a
            href="{{ pageUrl('MasterJabatanController', 'create') }}"
            class="btn btn-success"
        >
            Tambah Jabatan
        </a>

    </div>


    {{-- Pesan sukses --}}
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    {{-- Tabel --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th width="60">
                                No
                            </th>

                            <th>
                                Nama Jabatan
                            </th>

                            <th>
                                Jenis Jabatan
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="250">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $jabatan)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $jabatan->Nama_Jabatan }}
                                </td>

                                <td>
                                    {{ $jabatan->Jenis_Jabatan ?? '-' }}
                                </td>

                                <td>
                                    {{ $jabatan->Status ?? '-' }}
                                </td>

                                <td>

                                    <div class="d-flex gap-2">

                                        <a
                                            href="{{ pageUrl(
                                                'MasterJabatanController',
                                                'show',
                                                $jabatan->id
                                            ) }}"
                                            class="btn btn-sm btn-outline-success"
                                        >
                                            Detail
                                        </a>

                                        <a
                                            href="{{ pageUrl(
                                                'MasterJabatanController',
                                                'edit',
                                                $jabatan->id
                                            ) }}"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ pageUrl(
                                                'MasterJabatanController',
                                                'destroy',
                                                $jabatan->id
                                            ) }}"
                                            method="POST"
                                            onsubmit="return confirm(
                                                'Yakin ingin menghapus jabatan ini?'
                                            )"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
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
                                    colspan="5"
                                    class="text-center py-4 text-muted"
                                >
                                    Belum ada master jabatan.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection