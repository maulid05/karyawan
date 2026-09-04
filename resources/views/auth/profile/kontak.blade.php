<form
    action="{{ route('kontak.update', ['id' => $kontak->id]) }}"
    method="POST"
>

    @csrf
    @method('PATCH')

    <div class="row g-4">

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Email
            </label>

            <input
                type="email"
                class="form-control form-control-lg"
                name="Email"
                value="{{ old('Email', $kontak->Email) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Alamat
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="Alamat"
                value="{{ old('Alamat', $kontak->Alamat) }}"
            >

        </div>

        <div class="col-lg-3 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                RT
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="RT"
                value="{{ old('RT', $kontak->RT) }}"
            >

        </div>

        <div class="col-lg-3 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                RW
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="RW"
                value="{{ old('RW', $kontak->RW) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Provinsi
            </label>

            <select
                id="provinsi"
                class="form-select form-select-lg"
                name="Provinsi"
            >
                <option value="">
                    Memuat Provinsi...
                </option>
            </select>

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Kabupaten/Kota
            </label>

            <select
                id="kabupaten"
                class="form-select form-select-lg"
                name="Kabupaten_atau_Kota"
                disabled
            >
                <option value="">
                    Pilih Kabupaten/Kota
                </option>
            </select>

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Kecamatan
            </label>

            <select
                id="kecamatan"
                class="form-select form-select-lg"
                name="Kecamatan"
                disabled
            >
                <option value="">
                    Pilih Kecamatan
                </option>
            </select>

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Desa/Kelurahan
            </label>

            <select
                id="desa"
                class="form-select form-select-lg"
                name="Desa_atau_Kelurahan"
                disabled
            >
                <option value="">
                    Pilih Desa/Kelurahan
                </option>
            </select>

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                Kode Pos
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="Kode_Pos"
                value="{{ old('Kode_Pos', $kontak->Kode_Pos) }}"
                maxlength="5"
                inputmode="numeric"
                pattern="[0-9]{5}|-"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                No. Telepon Rumah
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="No_Telepon_Rumah"
                value="{{ old('No_Telepon_Rumah', $kontak->No_Telepon_Rumah) }}"
                inputmode="tel"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label fw-semibold text-white">
                No. Handphone
            </label>

            <input
                type="text"
                class="form-control form-control-lg"
                name="No_Handphone"
                value="{{ old('No_Handphone', $kontak->No_Handphone) }}"
                inputmode="tel"
            >

        </div>

    </div>

    <div class="d-flex justify-content-end mt-5">

        <button
            type="submit"
            class="btn btn-primary px-4 py-2 rounded-3"
        >
            Simpan Perubahan
        </button>

    </div>

</form>