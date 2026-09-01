<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SIMAK UNIBA</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous"
    >
</head>

<body style="background-color: blanchedalmond">

    <div class="min-vh-100">

        {{-- Logo --}}
        <div class="text-center py-4 m-5">

            <img
                src="https://unibamadura.ac.id/page/images/logo_unibamadura.png"
                class="img-fluid"
                style="width: 50vw; max-width: 700px;"
                alt="Logo UNIBA MADURA"
            >

        </div>


        {{-- Container --}}
        <div
            class="container bg-success rounded shadow auth-container"
            style="min-height: 70vh;"
        >

            @yield('content')

        </div>

    </div>


    <script src="{{ asset('js/auth.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>