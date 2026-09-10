@extends('layouts.layout')

@section('title', 'Navigation')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Navigation
            </h4>

            <p class="text-muted mb-0">
                Kelola navigation berdasarkan jabatan struktural.
            </p>
        </div>

        <a href="{{ pageUrl('NavController', 'create') }}"
           class="btn btn-success">

            <i class="bi bi-plus-lg"></i>
            Tambah Navigation

        </a>

    </div>


    {{-- Alert sukses --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Alert error --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-success">

                        <tr>

                            <th width="60">
                                #
                            </th>

                            <th>
                                Nama Navigation
                            </th>

                            <th>
                                Jabatan
                            </th>

                            <th>
                                Controller
                            </th>

                            <th>
                                Method
                            </th>

                            <th width="180">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($data as $nav)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>

                                    <span class="fw-semibold">
                                        {{ $nav->Nama }}
                                    </span>

                                </td>

                                <td>

                                    {{ $nav->jabatanStruktural?->Nama_Jabatan ?? '-' }}

                                </td>

                                <td>

                                    <code>
                                        {{ $nav->Controller }}
                                    </code>

                                </td>

                                <td>

                                    <code>
                                        {{ $nav->Method }}
                                    </code>

                                </td>

                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- Show --}}
                                        <a href="{{ pageUrl(
                                            'NavController',
                                            'show',
                                            $nav->id
                                        ) }}"
                                           class="btn btn-sm btn-info text-white"
                                           title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ pageUrl(
                                            'NavController',
                                            'edit',
                                            $nav->id
                                        ) }}"
                                           class="btn btn-sm btn-warning"
                                           title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ pageUrl(
                                            'NavController',
                                            'destroy',
                                            $nav->id
                                        ) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus navigation ini?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger"
                                                    title="Hapus">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="text-center text-muted py-5">

                                    <i class="bi bi-menu-button-wide fs-1 d-block mb-2"></i>

                                    Belum ada navigation.

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