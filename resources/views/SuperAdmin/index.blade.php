@extends('SuperAdmin.app')
@section('content')
<div class="card col-md-6 d-flex w-100 container bg-transparent border-0 gap-3 flex-column flex-md-row">
    @foreach ($data as $key => $datas)
     <div class="row bg-success text-white rounded p-3 m-3 flex-fill btn btn-success">

            <div class="text-center">

                <h5>
                    {{ ucfirst(str_replace('_', ' ', $key)) }}
                </h5>

                <h2 class="fw-bold">
                    {{ $datas->count() }}
                </h2>

            </div>

        </div>

    @endforeach
</div>
@endsection