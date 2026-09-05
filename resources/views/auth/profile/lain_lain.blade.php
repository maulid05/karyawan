<form
    action="{{ route('lain-lain.update', ['id' => $lainLain->id]) }}"
    method="POST"
>

    @csrf
    @method('PATCH')

    <div class="row g-4">

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                NPWP
            </label>

            <input
                type="text"
                class="form-control"
                name="NPWP"
                value="{{ old('NPWP', $lainLain->NPWP) }}"
                inputmode="numeric"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Nama Wajib Pajak
            </label>

            <input
                type="text"
                class="form-control"
                name="Nama_Wajib_Pajak"
                value="{{ old('Nama_Wajib_Pajak', $lainLain->Nama_Wajib_Pajak) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Sinta ID
            </label>

            <input
                type="text"
                class="form-control"
                name="Sinta_Id"
                value="{{ old('Sinta_Id', $lainLain->Sinta_Id) }}"
            >

        </div>

        <div class="col-lg-6 col-md-6 col-12">

            <label class="form-label text-white mb-2">
                Sinta Link
            </label>

            <input
                type="url"
                class="form-control"
                name="Sinta_Link"
                value="{{ old('Sinta_Link', $lainLain->Sinta_Link) }}"
                placeholder="https://sinta.kemdikbud.go.id/..."
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