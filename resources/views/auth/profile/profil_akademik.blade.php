<form
    action="{{ route('profil-akademik.update', ['id' => $profilAkademik->id]) }}"
    method="POST"
>

    @csrf
    @method('PATCH')

    <div class="row g-4">

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Rumpun Ilmu
            </label>

            <input
                type="text"
                class="form-control"
                name="Rumpun_Ilmu"
                value="{{ old('Rumpun_Ilmu', $profilAkademik->Rumpun_Ilmu) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Pohon Ilmu
            </label>

            <input
                type="text"
                class="form-control"
                name="Pohon_Ilmu"
                value="{{ old('Pohon_Ilmu', $profilAkademik->Pohon_Ilmu) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Kelompok Ilmu
            </label>

            <input
                type="text"
                class="form-control"
                name="Kelompok_Ilmu"
                value="{{ old('Kelompok_Ilmu', $profilAkademik->Kelompok_Ilmu) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Cabang Ilmu
            </label>

            <input
                type="text"
                class="form-control"
                name="Cabang_Ilmu"
                value="{{ old('Cabang_Ilmu', $profilAkademik->Cabang_Ilmu) }}"
            >

        </div>

        <div class="col-12">

            <hr class="border-white opacity-25">

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Scopus ID
            </label>

            <input
                type="text"
                class="form-control"
                name="Scopus_Id"
                value="{{ old('Scopus_Id', $profilAkademik->Scopus_Id) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Scopus Link
            </label>

            <input
                type="url"
                class="form-control"
                name="Scopus_Link"
                value="{{ old('Scopus_Link', $profilAkademik->Scopus_Link) }}"
                placeholder="https://www.scopus.com/..."
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Scopus H-Index
            </label>

            <input
                type="text"
                class="form-control"
                name="Scopus_H_Index"
                value="{{ old('Scopus_H_Index', $profilAkademik->Scopus_H_Index) }}"
                inputmode="numeric"
            >

        </div>

        <div class="col-12">

            <hr class="border-white opacity-25">

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Google Scholar ID
            </label>

            <input
                type="text"
                class="form-control"
                name="Google_Schoolar_Id"
                value="{{ old('Google_Schoolar_Id', $profilAkademik->Google_Schoolar_Id) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Google Scholar Link
            </label>

            <input
                type="url"
                class="form-control"
                name="Google_Schoolar_Link"
                value="{{ old('Google_Schoolar_Link', $profilAkademik->Google_Schoolar_Link) }}"
                placeholder="https://scholar.google.com/..."
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Google Scholar H-Index
            </label>

            <input
                type="text"
                class="form-control"
                name="Google_Schoolar_H_Index"
                value="{{ old('Google_Schoolar_H_Index', $profilAkademik->Google_Schoolar_H_Index) }}"
                inputmode="numeric"
            >

        </div>

        <div class="col-12">

            <hr class="border-white opacity-25">

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Orchid ID
            </label>

            <input
                type="text"
                class="form-control"
                name="Orchid_Id"
                value="{{ old('Orchid_Id', $profilAkademik->Orchid_Id) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Orchid Link
            </label>

            <input
                type="url"
                class="form-control"
                name="Orchid_Link"
                value="{{ old('Orchid_Link', $profilAkademik->Orchid_Link) }}"
                placeholder="https://orcid.org/..."
            >

        </div>

        <div class="col-12">

            <hr class="border-white opacity-25">

        </div>

        <div class="col-12">

            <label class="form-label text-white mb-2">
                Repository Universitas
            </label>

            <input
                type="url"
                class="form-control"
                name="Repository_Universitas"
                value="{{ old('Repository_Universitas', $profilAkademik->Repository_Universitas) }}"
                placeholder="https://repository.universitas.ac.id/..."
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