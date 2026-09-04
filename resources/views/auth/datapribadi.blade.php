<div class="card border-0 shadow-sm text-white"
    style="background: #198754; border-radius: 16px;">

    <div class="text-center pt-4">

        <h4 class="fw-bold mb-0">
            Data Pribadi
        </h4>

    </div>

    <div class="text-center p-4">

        <div
            class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
            style="width: 100px; height: 100px; font-size: 36px;"
        >
            {{ strtoupper(substr($datapribadi->user->name, 0, 1)) }}
        </div>

        <h5 class="mt-3 mb-0 fw-semibold">
            {{ $datapribadi->user->name }}
        </h5>

    </div>

    <form
        action="{{ route('profil.update', ['id' => $datapribadi->id]) }}"
        method="POST"
    >

        @csrf
        @method('PATCH')

        <div class="px-4 px-md-5 pb-4">

            <div class="row g-4">

                @foreach ($datapribadi->only([
                    'NUPTK',
                    'NIDN',
                    'Nama',
                    'Jenis_Kelamin',
                    'Tempat_Lahir',
                    'Tanggal_Lahir',
                    'NIP',
                ]) as $k => $v)

                    <div class="col-lg-6 col-md-6 col-12">

                        <label class="form-label text-white mb-2">
                            {{ ucwords(str_replace('_', ' ', $k)) }}
                        </label>

                        @if ($k === 'NIDN')

                            <input
                                type="text"
                                class="form-control"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
                                maxlength="10"
                                inputmode="numeric"
                                pattern="[0-9]{10}|-"
                                oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/-/g, (m, i) => i === 0 ? m : '')"
                                placeholder="10 digit NIDN atau -"
                            >

                        @elseif ($k === 'NUPTK')

                            <input
                                type="text"
                                class="form-control"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
                                maxlength="16"
                                inputmode="numeric"
                                pattern="[0-9]{16}|-"
                                oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/-/g, (m, i) => i === 0 ? m : '')"
                                placeholder="16 digit NUPTK atau -"
                            >

                        @elseif ($k === 'Jenis_Kelamin')

                            <select
                                class="form-select"
                                name="{{ $k }}"
                            >

                                <option value="">
                                    Pilih Jenis Kelamin
                                </option>

                                <option
                                    value="Laki-laki"
                                    {{ old($k, $v) === 'Laki-laki' ? 'selected' : '' }}
                                >
                                    Laki-laki
                                </option>

                                <option
                                    value="Perempuan"
                                    {{ old($k, $v) === 'Perempuan' ? 'selected' : '' }}
                                >
                                    Perempuan
                                </option>

                                <option
                                    value="-"
                                    {{ old($k, $v) === '-' ? 'selected' : '' }}
                                >
                                    -
                                </option>

                            </select>

                        @elseif ($k === 'Tanggal_Lahir')

                            <input
                                type="date"
                                class="form-control"
                                name="{{ $k }}"
                                value="{{ old($k, $v !== '-' ? $v : '') }}"
                            >

                        @else

                            <input
                                type="text"
                                class="form-control"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
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

        </div>

    </form>

</div>