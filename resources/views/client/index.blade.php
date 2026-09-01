@extends('client.app')

@section('content')
<div class="card col-md-6 d-flex w-100 container bg-transparent border-0 gap-3 flex-column flex-md-row">
    @foreach ($role as $key => $roles)
     <div class="row bg-success text-white rounded p-3 m-3 flex-fill btn btn-success">

            <div class="text-center">
                <h5>
                    Masuk Sebagai
                </h5>

                <a href="" class="fw-bold nav-link" style="color:white;">
                    {{ $roles->name }}
                </a>

            </div>

        </div>

    @endforeach
</div>
@endsection