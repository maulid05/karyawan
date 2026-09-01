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

        body {
            background-color: blanchedalmond;
        }

        /* =========================
           SIDEBAR
        ========================= */

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #198754;
            flex-shrink: 0;
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

        .logo {
            max-width: 180px;
        }

        .main-content {
            min-height: 100vh;
        }

        /* Tombol hamburger */
        .hamburger {
            display: none;
            border: none;
            font-size: 25px;
            background: transparent;
        }

        /* Tombol close */
        .close-sidebar {
            display: none;
            border: none;
            background: transparent;
            color: white;
            font-size: 28px;
        }


        /* =========================
           MOBILE / TABLET
           < 950px
        ========================= */

        @media (max-width: 949px) {

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: auto;
                min-height: auto;

                transform: translateY(-100%);
                transition: transform .3s ease;

                z-index: 1050;
            }

            .sidebar.show {
                transform: translateY(0);
            }

            .hamburger {
                display: block;
            }

            .close-sidebar {
                display: block;
            }

            .sidebar-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar .nav {
                margin-top: 10px;
            }

            .main-content {
                width: 100%;
                min-height: 100vh;
            }

        }


        /* =========================
           DESKTOP
           >= 950px
        ========================= */

        @media (min-width: 950px) {

            .sidebar-header {
                display: block;
            }

        }

    </style>

    @yield('css')

</head>


<body>

<div class="d-flex">


    {{-- =========================
         SIDEBAR
    ========================== --}}

    <aside id="sidebar" class="sidebar p-3">

        <div class="sidebar-header">

            <div class="text-center">

                <img
                    src="https://unibamadura.ac.id/page/images/logo_unibamadura.png"
                    class="img-fluid logo"
                    alt="UNIBA MADURA"
                >

            </div>

            {{-- Tombol Close --}}
            <button
                type="button"
                class="close-sidebar"
                onclick="closeSidebar()"
            >
                &times;
            </button>

        </div>


        {{-- Menu --}}

        <nav class="nav flex-column">

            <a
                href="{{ route('home') }}"
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


        {{-- =========================
             NAVBAR
        ========================== --}}

        <nav
            id="nav"
            class="navbar px-4"
        >

            <div class="d-flex align-items-center gap-3">

                {{-- Hamburger --}}
                <button
                    id="hamburger"
                    class="hamburger"
                    type="button"
                    onclick="openSidebar()"
                >
                    ☰
                </button>


                <h5 class="mb-0 fw-bold">

                    @yield('title', 'Dashboard')

                </h5>

            </div>



            {{-- =========================
                 USER
            ========================== --}}

            @auth

                <div class="dropdown">

                    <button
                        class="btn dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                    >

                        {{ auth()->user()->name }}

                    </button>


                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        style="background-color: blanchedalmond"
                    >

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



        {{-- =========================
             PAGE CONTENT
        ========================== --}}

        <div class="container-fluid p-4">

            @yield('content')

        </div>

    </main>

</div>



{{-- Bootstrap JS --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>


<script>

    function openSidebar() {

        document
            .getElementById('sidebar')
            .classList.add('show');

    }


    function closeSidebar() {

        document
            .getElementById('sidebar')
            .classList.remove('show');

    }

</script>


@yield('js')

</body>

</html>

