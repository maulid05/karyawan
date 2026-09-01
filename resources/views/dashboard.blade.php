<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'SIMAK UNIBA')
    </title>

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body, #nav{
            background-color:blanchedalmond ;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #198754;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, .85);
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, .15);
            color: #fff;
        }

        .main-content {
            min-height: 100vh;
        }

        .logo {
            max-width: 180px;
        }

        @media (max-width: 767px) {

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .main-content {
                min-height: auto;
            }

        }

    </style>

    @yield('css')

</head>


<body>

<div class="d-flex flex-column flex-md-row">


    {{-- =========================
         SIDEBAR
    ========================== --}}

    <aside class="sidebar p-3">

        {{-- Logo --}}
        <div class="text-center mb-4">

            <img
                src="https://unibamadura.ac.id/page/images/logo_unibamadura.png"
                class="img-fluid logo"
                alt="UNIBA MADURA"
            >

        </div>


        {{-- Menu --}}
        <nav class="nav flex-column">

            <a
                href="{{ url('/home') }}"
                class="nav-link active"
            >
                Dashboard
            </a>

            <a
                href="#"
                class="nav-link"
            >
                Data Master
            </a>

            <a
                href="#"
                class="nav-link"
            >
                Pengguna
            </a>

            <a
                href="#"
                class="nav-link"
            >
                Laporan
            </a>

            <a
                href="#"
                class="nav-link"
            >
                Pengaturan
            </a>

        </nav>

    </aside>



    {{-- =========================
         MAIN
    ========================== --}}

    <main class="main-content flex-grow-1">


        {{-- Navbar --}}
        <nav id="nav" class="navbar navbar-light px-4">

            <div>

                <h5 class="mb-0 fw-bold">
                    @yield('title', 'Dashboard')
                </h5>

            </div>


            {{-- User --}}
            @auth

                <div class="dropdown">

                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                    >

                        {{ auth()->user()->name }}

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" style="background-color: blanchedalmond">

                        <li>
                            <a
                                class="dropdown-item"
                                href="#"
                            >
                                Profile
                            </a>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>

                            <form
                                action="{{ route('logout') }}"
                                method="POST"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="dropdown-item"
                                >
                                    Logout
                                </button>

                            </form>

                        </li>

                    </ul>

                </div>

            @endauth

        </nav>


        {{-- Page Content --}}
        <div class="container-fluid p-4">

            @yield('content')

        </div>

    </main>

</div>


{{-- Bootstrap JS --}}
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>

@yield('js')

</body>

</html>