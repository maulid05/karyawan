<form
    action="{{ route('kepegawaian.update', $kepegawaian->id) }}"
    method="POST"
>
    @csrf
    @method('PATCH')

    <div class="row g-4">

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white">
                Nomor SK
            </label>

            <input
                type="text"
                class="form-control"
                name="Nomor_SK"
                value="{{ old('Nomor_SK', $kepegawaian->Nomor_SK) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white">
                Tanggal Masuk
            </label>

            <input
                type="date"
                class="form-control"
                name="Tanggal_Masuk"
                value="{{ old('Tanggal_Masuk', $kepegawaian->Tanggal_Masuk !== '-' ? $kepegawaian->Tanggal_Masuk : '') }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white">
                Sumber Gaji
            </label>

            <input
                type="text"
                class="form-control"
                name="Sumber_Gaji"
                value="{{ old('Sumber_Gaji', $kepegawaian->Sumber_Gaji) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white">
                Nama Jabatan
            </label>

            <input
                type="text"
                class="form-control"
                name="Nama_Jabatan"
                value="{{ old('Nama_Jabatan', $kepegawaian->Nama_Jabatan) }}"
            >

        </div>

    </div>

    <div class="d-flex justify-content-end mt-4">

        <button
            type="submit"
            class="btn btn-primary px-4"
        >
            Simpan Perubahan
        </button>

    </div>

</form>