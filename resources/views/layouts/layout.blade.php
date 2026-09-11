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
        ========================== */

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


        /* =========================
           HAMBURGER
        ========================== */

        .hamburger {
            display: none;
            border: none;
            font-size: 25px;
            background: transparent;
        }


        /* =========================
           CLOSE SIDEBAR
        ========================== */

        .close-sidebar {
            display: none;
            border: none;
            background: transparent;
            color: white;
            font-size: 28px;
        }


        /* =========================
           NOTIFICATION
        ========================== */

        .notification-button {
            border: none;
            background: transparent;
            font-size: 21px;
            padding: 6px 10px;
            position: relative;
        }


        .notification-button:hover {
            background-color: rgba(0, 0, 0, .05);
            border-radius: 8px;
        }


        .notification-menu {
            width: 360px;
            max-height: 500px;
            overflow-y: auto;
            background-color: blanchedalmond;
        }


        .notification-item {
            white-space: normal;
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }


        /*
         * Notifikasi belum dibaca
         */
        .notification-item.unread {
            background-color: rgba(255, 255, 255, .55);
        }


        /*
         * Notifikasi sudah selesai
         */
        .notification-item.done {
            background-color: transparent;
            opacity: .75;
        }


        .notification-item:hover {
            background-color: rgba(255, 255, 255, .75);
            opacity: 1;
        }


        .notification-title {
            font-size: 14px;
        }


        .notification-time {
            font-size: 12px;
        }


        .notification-status {
            font-size: 11px;
        }


        /* =========================
           MOBILE / TABLET
        ========================== */

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


            .notification-menu {
                width: min(360px, calc(100vw - 30px));
            }

        }


        /* =========================
           DESKTOP
        ========================== */

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


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    <aside
        id="sidebar"
        class="sidebar p-3"
    >

        <div class="sidebar-header">

            <div class="text-center">

                <img
                    src="https://unibamadura.ac.id/page/images/logo_unibamadura.png"
                    class="img-fluid logo"
                    alt="UNIBA MADURA"
                >

            </div>


            <button
                type="button"
                class="close-sidebar"
                onclick="closeSidebar()"
            >
                &times;
            </button>

        </div>


        {{-- =================================================
             MENU
        ================================================== --}}

        <nav class="nav flex-column">


            {{-- Dashboard --}}

            <a
                href="{{ route('home') }}"
                class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
            >
                Dashboard
            </a>


            @auth


                {{-- SUPERADMIN --}}

                @if (auth()->user()->roles->contains('name', 'superadmin'))

                    <li class="nav-item">

                        <a
                            href="{{ pageUrl('NavController') }}"
                            class="nav-link"
                        >
                            Nav Manager
                        </a>

                    </li>


                    <li class="nav-item">

                        <a
                            href="{{ pageUrl('MasterJabatanController') }}"
                            class="nav-link"
                        >
                            Master Jabatan
                        </a>

                    </li>


                {{-- ADMIN --}}

                @elseif(auth()->user()->roles->contains('name', 'admin'))

                    <li class="nav-item">

                        <a
                            href="{{ pageUrl('MasterJabatanController') }}"
                            class="nav-link"
                        >
                            Master Jabatan
                        </a>

                    </li>


                    <li class="nav-item">

                        <a
                            href="{{ pageUrl('MasterUnitController') }}"
                            class="nav-link"
                        >
                            Master Unit
                        </a>

                    </li>


                {{-- CLIENT --}}

                @elseif (auth()->user()->roles->contains('name', 'client'))

                    <a
                        href="{{ pageUrl('JabatanStrukturalController') }}"
                        class="nav-link
                        {{ isset($currentController) &&
                        $currentController === 'JabatanStrukturalController'
                        ? 'active'
                        : '' }}"
                    >
                        Jabatan Struktural
                    </a>


                    @php
                        $navs = \App\Facades\Context::navs();
                    @endphp


                    @foreach ($navs as $nav)

                        <a
                            href="{{ pageUrl($nav->Controller, $nav->Method) }}"
                            class="nav-link"
                        >
                            {{ $nav->Nama }}
                        </a>

                    @endforeach


                    <a
                        href="{{ pageUrl('RiwayatPendidikanFormalController') }}"
                        class="nav-link
                        {{ isset($currentController) &&
                        $currentController === 'RiwayatPendidikanFormalController'
                        ? 'active'
                        : '' }}"
                    >
                        Riwayat Pendidikan Formal
                    </a>


                    <a
                        href="{{ pageUrl('RiwayatPekerjaanController') }}"
                        class="nav-link
                        {{ isset($currentController) &&
                        $currentController === 'RiwayatPekerjaanController'
                        ? 'active'
                        : '' }}"
                    >
                        Riwayat Pekerjaan
                    </a>

                     <a
                        href="{{ route('timeline.index') }}"
                        class="nav-link {{ request()->routeIs('timeline.index') ? 'active' : '' }}"
                    >
                        Status
                    </a>


                @endif


            @endauth


        </nav>

    </aside>



    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="main-content flex-grow-1">


        {{-- =================================================
             NAVBAR
        ================================================== --}}

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


                {{-- Title --}}

                <h5 class="mb-0 fw-bold">

                    @yield('title', 'Dashboard')

                    :

                    {{ \App\Facades\Context::active()?->Nama_Jabatan }}

                </h5>

            </div>



            {{-- =================================================
                 USER + NOTIFICATION
            ================================================== --}}

            @auth

                <div class="d-flex align-items-center gap-2">


                    {{-- =================================================
                         NOTIFICATION
                    ================================================== --}}

                    @php

                        /*
                         * Ambil timeline milik user yang sedang login.
                         */
                        $timelines = Auth::user()
                            ->timeline()
                            ->latest()
                            ->take(10)
                            ->get();


                        /*
                         * Hitung hanya notifikasi yang
                         * statusnya masih unread.
                         */
                        $unreadCount = Auth::user()
                            ->timeline()
                            ->where('log->status', 'unread')
                            ->count();

                    @endphp


                    <div class="dropdown">


                        {{-- Notification Button --}}

                        <button
                            class="notification-button"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            title="Notifikasi"
                        >

                            🔔


                            {{-- Badge jumlah unread --}}

                            @if($unreadCount > 0)

                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 10px;"
                                >
                                    {{ $unreadCount }}
                                </span>

                            @endif

                        </button>



                        {{-- Notification Menu --}}

                        <ul
                            class="dropdown-menu dropdown-menu-end p-0 notification-menu"
                        >


                            {{-- HEADER --}}

                            <li class="px-3 py-3 border-bottom">

                                <div
                                    class="d-flex justify-content-between align-items-center"
                                >

                                    <strong>
                                        Notifikasi
                                    </strong>


                                    @if($unreadCount > 0)

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-link text-decoration-none p-0"
                                            onclick="readAllTimeline(event)"
                                        >
                                            Tandai semua selesai
                                        </button>

                                    @endif

                                </div>

                            </li>



                            {{-- LIST NOTIFICATION --}}

                            @forelse($timelines as $timeline)

                                @php

                                    $log = $timeline->log ?? [];


                                    $status = $log['status'] ?? 'unread';


                                    $action = $log['action'] ?? 'Aktivitas';


                                    $type = $log['type'] ?? null;


                                    $openedWith =
                                        $log['opened_with']
                                        ?? 'Tidak diketahui';


                                    $decision =
                                        $log['decision']
                                        ?? null;

                                @endphp


                                <li>

                                    {{--

                                        PENTING:

                                        Tidak menggunakan onclick
                                        readTimeline() di sini.

                                        Klik langsung menuju show.

                                        show() akan mengubah:
                                        unread -> done

                                    --}}

                                    <a
                                        href="{{ route('timeline.show', $timeline->id) }}"
                                        class="dropdown-item notification-item py-3
                                        {{ $status === 'unread' ? 'unread' : 'done' }}"
                                    >


                                        {{-- Judul --}}

                                        <div
                                            class="notification-title fw-bold"
                                        >

                                            @if($type === 'decision')

                                                @if($decision === 'approved')
                                                    ✓ Keputusan Disetujui

                                                @elseif($decision === 'rejected')
                                                    ✕ Keputusan Ditolak

                                                @elseif($decision === 'pending')
                                                    ⏳ Keputusan Ditunda

                                                @else
                                                    Keputusan Admin
                                                @endif

                                            @else

                                                {{ ucfirst($action) }}

                                            @endif

                                        </div>



                                        {{-- Jenis data --}}

                                        <div class="small text-muted">

                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $openedWith
                                                )
                                            ) }}

                                        </div>



                                        {{-- Status --}}

                                        <div class="notification-status mt-1">

                                            @if($status === 'unread')

                                                <span class="text-success fw-bold">
                                                    ● Belum dibaca
                                                </span>

                                            @else

                                                <span class="text-muted">
                                                    ✓ Selesai
                                                </span>

                                            @endif

                                        </div>



                                        {{-- Waktu --}}

                                        <div class="notification-time text-muted mt-1">

                                            {{ $timeline->created_at->diffForHumans() }}

                                        </div>


                                    </a>

                                </li>


                            @empty

                                <li>

                                    <div
                                        class="text-center text-muted py-4"
                                    >

                                        🔕
                                        <br>

                                        Tidak ada notifikasi.

                                    </div>

                                </li>

                            @endforelse



                            {{-- FOOTER --}}

                            <li class="border-top">

                                <a
                                    href="{{ route('timeline.index') }}"
                                    class="dropdown-item text-center py-3"
                                >
                                    Lihat semua notifikasi
                                </a>

                            </li>


                        </ul>

                    </div>



                    {{-- =================================================
                         USER
                    ================================================== --}}

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
                                    href="{{ route('cek', Auth::user()->id) }}"
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


                </div>

            @endauth


        </nav>



        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="container-fluid p-4">

            @yield('content')

        </div>


    </main>

</div>



{{-- =====================================================
     BOOTSTRAP JS
====================================================== --}}

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
</script>



<script>


    /* =================================================
       SIDEBAR
    ================================================== */

    function openSidebar()
    {
        document
            .getElementById('sidebar')
            .classList
            .add('show');
    }


    function closeSidebar()
    {
        document
            .getElementById('sidebar')
            .classList
            .remove('show');
    }



    /* =================================================
       READ ALL TIMELINE
    ================================================== */

    function readAllTimeline(event)
    {

        /*
         * Jangan membuka dropdown setelah tombol diklik.
         */
        event.preventDefault();

        event.stopPropagation();


        fetch('/timeline/read-all', {

            method: 'PATCH',

            headers: {

                'X-CSRF-TOKEN':
                    document
                    .querySelector(
                        'meta[name="csrf-token"]'
                    )
                    .getAttribute('content'),

                'Accept': 'application/json',

            }

        })

        .then(response => {

            if (!response.ok) {

                throw new Error(
                    'Gagal menyelesaikan semua notifikasi.'
                );

            }

            return response.json();

        })

        .then(data => {

            if (data.success) {

                location.reload();

            }

        })

        .catch(error => {

            console.error(error);

        });

    }


</script>


@yield('js')


</body>

</html>