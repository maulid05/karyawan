@extends('auth.layout')

@section('content')

<style>
    .profile-tabs-wrapper {
        background: #198754;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .profile-tabs-header {
        padding: 20px 24px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        background: #198754;
    }

    .profile-tabs-header h5 {
        color: #ffffff;
    }

    .profile-tabs-header small {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    .profile-tabs {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        scrollbar-width: thin;
        padding-bottom: 2px;
    }

    .profile-tab {
        border: 1px solid rgba(255, 255, 255, 0.5);
        background: #ffffff;
        color: #198754;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .profile-tab:hover {
        background: #e9f7ef;
        border-color: #ffffff;
        color: #146c43;
        transform: translateY(-1px);
    }

    .profile-tab.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }

    .profile-tab-content {
        padding: 28px 24px;
        background: #198754;
    }

    .profile-panel {
        animation: profileFade 0.2s ease;
    }

    .profile-panel .card {
        border: 0 !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .profile-panel h4,
    .profile-panel h5,
    .profile-panel h6 {
        color: #212529;
    }

    .profile-panel .text-muted {
        color: #6c757d !important;
    }

    .profile-panel .form-label {
        color: #212529;
        font-weight: 500;
    }

    .form-control,
    .form-select {
        background-color: #ffffff;
        color: #212529;
        border: 1px solid #ced4da;
        border-radius: 10px;
    }

    .form-control::placeholder {
        color: #6c757d;
    }

    .form-control:hover,
    .form-select:hover {
        border-color: #adb5bd;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: #ffffff;
        color: #212529;
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .form-select:disabled {
        background-color: #e9ecef;
        color: #6c757d;
        border-color: #ced4da;
    }

    .btn-primary {
        background: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-primary:hover {
        background: #0b5ed7;
        border-color: #0a58ca;
    }

    @keyframes profileFade {
        from {
            opacity: 0;
            transform: translateY(5px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 576px) {

        .profile-tabs-header {
            padding: 16px;
        }

        .profile-tab-content {
            padding: 20px 16px;
        }

        .profile-tab {
            padding: 9px 13px;
            font-size: 13px;
        }
    }
</style>
<div class="container-fluid py-4">

    @include('auth.datapribadi')

    @php
        $tabPath = resource_path('views/auth/profile');

        $tabFiles = is_dir($tabPath)
            ? \Illuminate\Support\Facades\File::files($tabPath)
            : [];
    @endphp

    @if (count($tabFiles))

        <div class="profile-tabs-wrapper mt-4">

            <div class="profile-tabs-header">

                <div class="mb-3">

                    <h5 class="fw-bold mb-1">
                        Data Profil
                    </h5>

                    <small class="text-muted">
                        Kelola informasi profil Anda
                    </small>

                </div>

                <div class="profile-tabs">

                    @foreach ($tabFiles as $index => $file)

                        @php
                            $name = preg_replace(
                                '/\.blade\.php$/',
                                '',
                                $file->getFilename()
                            );

                            $id = 'tab-' . $name;

                            $title = ucwords(
                                str_replace(
                                    ['-', '_'],
                                    ' ',
                                    $name
                                )
                            );
                        @endphp

                        <button
                            type="button"
                            class="profile-tab {{ $index === 0 ? 'active' : '' }}"
                            data-tab="{{ $id }}"
                        >
                            {{ $title }}
                        </button>

                    @endforeach

                </div>

            </div>

            <div class="profile-tab-content">

                @foreach ($tabFiles as $index => $file)

                    @php
                        $name = preg_replace(
                            '/\.blade\.php$/',
                            '',
                            $file->getFilename()
                        );

                        $id = 'tab-' . $name;

                        $view = 'auth.profile.' . $name;
                    @endphp

                    <div
                        id="{{ $id }}"
                        class="profile-panel {{ $index === 0 ? '' : 'd-none' }}"
                    >
                        @include($view)
                    </div>

                @endforeach

            </div>

        </div>

    @endif

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const buttons = document.querySelectorAll('.profile-tab');
    const panels = document.querySelectorAll('.profile-panel');

    buttons.forEach(button => {

        button.addEventListener('click', function () {

            const target = this.dataset.tab;
            const panel = document.getElementById(target);

            if (!panel) {
                return;
            }

            buttons.forEach(btn => {
                btn.classList.remove('active');
            });

            panels.forEach(panel => {
                panel.classList.add('d-none');
            });

            this.classList.add('active');
            panel.classList.remove('d-none');

        });

    });

    const provinsi = document.getElementById('provinsi');
    const kabupaten = document.getElementById('kabupaten');
    const kecamatan = document.getElementById('kecamatan');
    const desa = document.getElementById('desa');

    if (!provinsi || !kabupaten || !kecamatan || !desa) {
        return;
    }

    const API =
        'https://www.emsifa.com/api-wilayah-indonesia/api';

    const currentProvinsi =
        @json($kontak->Provinsi ?? '');

    const currentKabupaten =
        @json($kontak->Kabupaten_atau_Kota ?? '');

    const currentKecamatan =
        @json($kontak->Kecamatan ?? '');

    const currentDesa =
        @json($kontak->Desa_atau_Kelurahan ?? '');

    async function getData(url) {

        const response = await fetch(url);

        if (!response.ok) {
            throw new Error(
                'HTTP ' +
                response.status +
                ' - ' +
                response.statusText
            );
        }

        const data = await response.json();

        if (!Array.isArray(data)) {
            throw new Error(
                'Format data API tidak valid'
            );
        }

        return data;
    }

    function resetSelect(select, text) {

        select.innerHTML = '';

        const option =
            document.createElement('option');

        option.value = '';
        option.textContent = text;

        select.appendChild(option);

        select.disabled = true;
    }

    function fillSelect(
        select,
        data,
        placeholder,
        selected = ''
    ) {

        select.innerHTML = '';

        const firstOption =
            document.createElement('option');

        firstOption.value = '';
        firstOption.textContent = placeholder;

        select.appendChild(firstOption);

        data.forEach(item => {

            const option =
                document.createElement('option');

            option.value = item.name;
            option.textContent = item.name;

            option.dataset.code = item.id;

            if (
                item.name.toLowerCase() ===
                selected.toLowerCase()
            ) {
                option.selected = true;
            }

            select.appendChild(option);

        });

        select.disabled = false;
    }

    async function loadProvinsi() {

        try {

            resetSelect(
                provinsi,
                'Memuat Provinsi...'
            );

            const data = await getData(
                `${API}/provinces.json`
            );

            fillSelect(
                provinsi,
                data,
                'Pilih Provinsi',
                currentProvinsi
            );

            if (currentProvinsi) {

                const selected =
                    data.find(
                        item =>
                            item.name.toLowerCase() ===
                            currentProvinsi.toLowerCase()
                    );

                if (selected) {
                    await loadKabupaten(selected.id);
                }
            }

        } catch (error) {

            console.error(
                'Gagal memuat Provinsi:',
                error
            );

            resetSelect(
                provinsi,
                'Gagal memuat Provinsi'
            );
        }
    }

    async function loadKabupaten(provinceId) {

        resetSelect(
            kabupaten,
            'Memuat Kabupaten/Kota...'
        );

        resetSelect(
            kecamatan,
            'Pilih Kecamatan'
        );

        resetSelect(
            desa,
            'Pilih Desa/Kelurahan'
        );

        const data = await getData(
            `${API}/regencies/${provinceId}.json`
        );

        fillSelect(
            kabupaten,
            data,
            'Pilih Kabupaten/Kota',
            currentKabupaten
        );

        if (currentKabupaten) {

            const selected =
                data.find(
                    item =>
                        item.name.toLowerCase() ===
                        currentKabupaten.toLowerCase()
                );

            if (selected) {
                await loadKecamatan(selected.id);
            }
        }
    }

    async function loadKecamatan(regencyId) {

        resetSelect(
            kecamatan,
            'Memuat Kecamatan...'
        );

        resetSelect(
            desa,
            'Pilih Desa/Kelurahan'
        );

        const data = await getData(
            `${API}/districts/${regencyId}.json`
        );

        fillSelect(
            kecamatan,
            data,
            'Pilih Kecamatan',
            currentKecamatan
        );

        if (currentKecamatan) {

            const selected =
                data.find(
                    item =>
                        item.name.toLowerCase() ===
                        currentKecamatan.toLowerCase()
                );

            if (selected) {
                await loadDesa(selected.id);
            }
        }
    }

    async function loadDesa(districtId) {

        resetSelect(
            desa,
            'Memuat Desa/Kelurahan...'
        );

        const data = await getData(
            `${API}/villages/${districtId}.json`
        );

        fillSelect(
            desa,
            data,
            'Pilih Desa/Kelurahan',
            currentDesa
        );
    }

    provinsi.addEventListener(
        'change',
        async function () {

            resetSelect(
                kabupaten,
                'Pilih Kabupaten/Kota'
            );

            resetSelect(
                kecamatan,
                'Pilih Kecamatan'
            );

            resetSelect(
                desa,
                'Pilih Desa/Kelurahan'
            );

            if (!this.value) {
                return;
            }

            try {

                const option =
                    this.options[
                        this.selectedIndex
                    ];

                const provinceId =
                    option.dataset.code;

                if (!provinceId) {
                    return;
                }

                await loadKabupaten(
                    provinceId
                );

            } catch (error) {

                console.error(
                    'Gagal memuat Kabupaten/Kota:',
                    error
                );

                resetSelect(
                    kabupaten,
                    'Gagal memuat Kabupaten/Kota'
                );
            }
        }
    );

    kabupaten.addEventListener(
        'change',
        async function () {

            resetSelect(
                kecamatan,
                'Pilih Kecamatan'
            );

            resetSelect(
                desa,
                'Pilih Desa/Kelurahan'
            );

            if (!this.value) {
                return;
            }

            try {

                const option =
                    this.options[
                        this.selectedIndex
                    ];

                const regencyId =
                    option.dataset.code;

                if (!regencyId) {
                    return;
                }

                await loadKecamatan(
                    regencyId
                );

            } catch (error) {

                console.error(
                    'Gagal memuat Kecamatan:',
                    error
                );

                resetSelect(
                    kecamatan,
                    'Gagal memuat Kecamatan'
                );
            }
        }
    );

    kecamatan.addEventListener(
        'change',
        async function () {

            resetSelect(
                desa,
                'Pilih Desa/Kelurahan'
            );

            if (!this.value) {
                return;
            }

            try {

                const option =
                    this.options[
                        this.selectedIndex
                    ];

                const districtId =
                    option.dataset.code;

                if (!districtId) {
                    return;
                }

                await loadDesa(
                    districtId
                );

            } catch (error) {

                console.error(
                    'Gagal memuat Desa/Kelurahan:',
                    error
                );

                resetSelect(
                    desa,
                    'Gagal memuat Desa/Kelurahan'
                );
            }
        }
    );

    loadProvinsi();

});
</script>

@endsection