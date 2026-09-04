<form
    action="{{ route('kependudukan.update', ['id' => $kependudukan->id]) }}"
    method="POST"
>

    @csrf
    @method('PATCH')

    <div class="row g-4">

        @foreach ($kependudukan->only([
            'NIK',
            'Agama',
            'Kewarganegaraan',
        ]) as $k => $v)

            <div class="col-lg-6 col-md-6 col-12">

                <label class="form-label fw-semibold mb-2 text-white">
                    {{ ucwords(str_replace('_', ' ', $k)) }}
                </label>

                @if ($k === 'NIK')

                    <input
                        type="text"
                        class="form-control form-control-lg"
                        name="{{ $k }}"
                        value="{{ old($k, $v) }}"
                        maxlength="16"
                        inputmode="numeric"
                        pattern="[0-9]{16}|-"
                        oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/-/g, (m, i) => i === 0 ? m : '')"
                        placeholder="16 digit NIK atau -"
                    >

                    <small class="text-white">
                        Masukkan 16 digit NIK.
                    </small>

                @elseif ($k === 'Agama')

                    <select
                        class="form-select form-select-lg"
                        name="{{ $k }}"
                    >

                        <option value="">
                            Pilih Agama
                        </option>

                        <option
                            value="Islam"
                            {{ old($k, $v) === 'Islam' ? 'selected' : '' }}
                        >
                            Islam
                        </option>

                        <option
                            value="Kristen"
                            {{ old($k, $v) === 'Kristen' ? 'selected' : '' }}
                        >
                            Kristen
                        </option>

                        <option
                            value="Katolik"
                            {{ old($k, $v) === 'Katolik' ? 'selected' : '' }}
                        >
                            Katolik
                        </option>

                        <option
                            value="Hindu"
                            {{ old($k, $v) === 'Hindu' ? 'selected' : '' }}
                        >
                            Hindu
                        </option>

                        <option
                            value="Buddha"
                            {{ old($k, $v) === 'Buddha' ? 'selected' : '' }}
                        >
                            Buddha
                        </option>

                        <option
                            value="Khonghucu"
                            {{ old($k, $v) === 'Khonghucu' ? 'selected' : '' }}
                        >
                            Khonghucu
                        </option>

                        <option
                            value="-"
                            {{ old($k, $v) === '-' ? 'selected' : '' }}
                        >
                            -
                        </option>

                    </select>

                @elseif ($k === 'Kewarganegaraan')

                    <select
                        class="form-select form-select-lg"
                        name="{{ $k }}"
                    >

                        <option value="">
                            Pilih Kewarganegaraan
                        </option>

                        <option
                            value="WNI"
                            {{ old($k, $v) === 'WNI' ? 'selected' : '' }}
                        >
                            WNI
                        </option>

                        <option
                            value="WNA"
                            {{ old($k, $v) === 'WNA' ? 'selected' : '' }}
                        >
                            WNA
                        </option>

                        <option
                            value="-"
                            {{ old($k, $v) === '-' ? 'selected' : '' }}
                        >
                            -
                        </option>

                    </select>

                @endif

            </div>

        @endforeach

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