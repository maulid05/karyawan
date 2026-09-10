@extends('layouts.layout')

@section('title', 'Masuk Sebagai')

@section('content')

<div class="container">

    <div class="row g-3">

        @foreach ($jabatan as $item)

            <div class="col-md-6">

                <a href="{{ route('context.activate', $item->id) }}"
                   class="text-decoration-none">

                    <div class="card border-0 shadow-sm bg-success text-white">
                        <div class="card-body text-center">

                            <h5 class="fw-bold mb-2">
                                Masuk Sebagai
                            </h5>

                            <h4 class="mb-0">
                                {{ $item->Nama_Jabatan }}
                            </h4>

                        </div>
                    </div>

                </a>

            </div>

        @endforeach

    </div>

</div>

@endsection