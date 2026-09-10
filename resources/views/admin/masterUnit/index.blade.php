@extends('layouts.layout')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                Master Unit
            </h3>

            <p class="text-muted mb-0">
                Daftar unit yang tersedia dalam sistem.
            </p>
        </div>

        <a href="{{ pageUrl('MasterUnitController', 'create') }}"
           class="btn btn-success">
            <i class="bi bi-plus-lg"></i>
            Tambah Unit
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


    {{-- Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead>
                        <tr>
                            <th width="70">
                                No
                            </th>

                            <th>
                                Nama Unit
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="250"
                                class="text-center">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $item->Nama_Unit }}
                                </td>

                                <td>

                                    @if($item->Status === 'Aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ $item->Status }}
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <div class="d-flex
                                                justify-content-center
                                                gap-2">

                                        {{-- Detail --}}
                                        <a href="{{ pageUrl(
                                            'MasterUnitController',
                                            'show',
                                            $item->id
                                        ) }}"
                                           class="btn btn-sm btn-outline-primary">

                                            Detail

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ pageUrl(
                                            'MasterUnitController',
                                            'edit',
                                            $item->id
                                        ) }}"
                                           class="btn btn-sm btn-outline-warning">

                                            Edit

                                        </a>


                                        {{-- Hapus --}}
                                        <form action="{{ pageUrl(
                                            'MasterUnitController',
                                            'destroy',
                                            $item->id
                                        ) }}"
                                              method="POST"
                                              onsubmit="return confirm(
                                                  'Yakin ingin menghapus unit ini?'
                                              );">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger">

                                                Hapus

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    class="text-center py-5 text-muted">

                                    Belum ada data unit.

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