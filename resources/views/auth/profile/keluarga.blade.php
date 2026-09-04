<form
    action="{{ route('keluarga.update', ['id' => $keluarga->id]) }}"
    method="POST"
>
    @csrf
    @method('PATCH')

    <div class="row g-4">

        @foreach ($keluarga->only([
            'Status_Perkawinan',
            'Nama_Suami_Atau_Istri',
            'NIP_Suami_Atau_Istri',
            'Pekerjaan_Suami_Atau_Istri',
        ]) as $key => $value)

            <div class="col-lg-6 col-md-6 col-12">

                <label class="form-label text-white">
                    {{ ucwords(str_replace('_', ' ', $key)) }}
                </label>

                @if ($key === 'Status_Perkawinan')

                    <select
                        class="form-select"
                        name="{{ $key }}"
                    >

                        <option value="">
                            Pilih Status Perkawinan
                        </option>

                        <option
                            value="Belum Menikah"
                            {{ old($key, $value) === 'Belum Menikah' ? 'selected' : '' }}
                        >
                            Belum Menikah
                        </option>

                        <option
                            value="Menikah"
                            {{ old($key, $value) === 'Menikah' ? 'selected' : '' }}
                        >
                            Menikah
                        </option>

                        <option
                            value="Cerai Hidup"
                            {{ old($key, $value) === 'Cerai Hidup' ? 'selected' : '' }}
                        >
                            Cerai Hidup
                        </option>

                        <option
                            value="Cerai Mati"
                            {{ old($key, $value) === 'Cerai Mati' ? 'selected' : '' }}
                        >
                            Cerai Mati
                        </option>

                        <option
                            value="-"
                            {{ old($key, $value) === '-' ? 'selected' : '' }}
                        >
                            -
                        </option>

                    </select>

                @elseif ($key === 'NIP_Suami_Atau_Istri')

                    <input
                        type="text"
                        class="form-control"
                        name="{{ $key }}"
                        value="{{ old($key, $value) }}"
                        inputmode="numeric"
                        maxlength="18"
                        placeholder="NIP atau -"
                    >

                @else

                    <input
                        type="text"
                        class="form-control"
                        name="{{ $key }}"
                        value="{{ old($key, $value) }}"
                    >

                @endif

            </div>

        @endforeach

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