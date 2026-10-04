<div class="card border-0 shadow-sm text-white"
    style="background: #198754; border-radius: 16px;">

    <div class="text-center pt-4">

        <h4 class="fw-bold mb-0">
            Data Pribadi
        </h4>

    </div>

    <div class="text-center p-4">

        <div
            class="mx-auto"
            style="
                width: 130px;
                height: 160px;
                overflow: hidden;
                border-radius: 16px;
                background: #ffffff;
                display: flex;
                align-items: center;
                justify-content: center;
            "
        >

            @if ($pasFoto && $pasFoto->Foto && $pasFoto->Foto !== '-')

                <img
                    src="{{ asset('storage/' . $pasFoto->Foto) }}"
                    alt="Pas Foto"
                    style="
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    "
                >

            @else

                <div
                    class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                    style="
                        width: 100px;
                        height: 100px;
                        font-size: 36px;
                    "
                >
                    {{ strtoupper(substr($datapribadi->user->name, 0, 1)) }}
                </div>

            @endif

        </div>

        <h5 class="mt-3 mb-3 fw-semibold">
            {{ $datapribadi->user->name }}
        </h5>

        @if ($pasFoto)

            <form
                action="{{ route('pas-foto.update', ['id' => $pasFoto->id]) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PATCH')

                <div class="d-flex justify-content-center">

                    <label
                        for="Foto"
                        class="btn btn-primary px-4"
                    >
                        Edit Foto
                    </label>

                    <input
                        type="file"
                        id="Foto"
                        name="Foto"
                        class="d-none"
                        accept=".jpg,.jpeg,.png,.webp"
                        onchange="this.form.submit()"
                    >

                </div>

            </form>

        @endif

    </div>

    <form
        action="{{ route('timeline.store') }}"
        method="POST"
        id="dataPribadiForm"
    >

        @csrf
        @method('POST')

        <input
            type="hidden"
            name="type"
            value="data_update"
        >

        <input
            type="hidden"
            name="action"
            value="update"
        >

        <input
            type="hidden"
            name="status"
            value="unread"
        >

        <input
            type="hidden"
            name="decision"
            value=""
        >

        <input
            type="hidden"
            name="opened_with"
            value="data_pribadi"
        >

        <input
            type="hidden"
            name="send_id"
            value="{{ $datapribadi->id }}"
        >

        <input
            type="hidden"
            name="pageUrl"
            value="{{ url()->current() }}"
        >

        <input
            type="hidden"
            name="log_id"
            value=""
        >

        <div id="timelineChangesContainer"></div>

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

                        <label
                            for="{{ $k }}"
                            class="form-label text-white mb-2"
                        >
                            {{ ucwords(str_replace('_', ' ', $k)) }}
                        </label>

                        @if ($k === 'NIDN')

                            <input
                                type="text"
                                id="{{ $k }}"
                                class="form-control data-pribadi-field"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
                                data-field="{{ $k }}"
                                data-old-value="{{ $v }}"
                                maxlength="10"
                                inputmode="numeric"
                                pattern="[0-9]{10}|-"
                                oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/-/g, (m, i) => i === 0 ? m : '')"
                                placeholder="10 digit NIDN atau -"
                            >

                        @elseif ($k === 'NUPTK')

                            <input
                                type="text"
                                id="{{ $k }}"
                                class="form-control data-pribadi-field"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
                                data-field="{{ $k }}"
                                data-old-value="{{ $v }}"
                                maxlength="16"
                                inputmode="numeric"
                                pattern="[0-9]{16}|-"
                                oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/-/g, (m, i) => i === 0 ? m : '')"
                                placeholder="16 digit NUPTK atau -"
                            >

                        @elseif ($k === 'Jenis_Kelamin')

                            <select
                                id="{{ $k }}"
                                class="form-select data-pribadi-field"
                                name="{{ $k }}"
                                data-field="{{ $k }}"
                                data-old-value="{{ $v }}"
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
                                id="{{ $k }}"
                                class="form-control data-pribadi-field"
                                name="{{ $k }}"
                                value="{{ old($k, $v !== '-' ? $v : '') }}"
                                data-field="{{ $k }}"
                                data-old-value="{{ $v }}"
                            >

                        @else

                            <input
                                type="text"
                                id="{{ $k }}"
                                class="form-control data-pribadi-field"
                                name="{{ $k }}"
                                value="{{ old($k, $v) }}"
                                data-field="{{ $k }}"
                                data-old-value="{{ $v }}"
                            >

                        @endif

                    </div>

                @endforeach

            </div>

            <div class="d-flex justify-content-end mt-4">

                <button
                    type="submit"
                    class="btn btn-primary px-4"
                    id="submitDataPribadi"
                >
                    Simpan Perubahan
                </button>

            </div>

        </div>

    </form>

</div>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('dataPribadiForm');

        const container = document.getElementById(
            'timelineChangesContainer'
        );

        const submitButton = document.getElementById(
            'submitDataPribadi'
        );

        if (!form || !container) {
            return;
        }

        form.addEventListener('submit', function (event) {

            container.innerHTML = '';

            let hasChanges = false;

            const fields = form.querySelectorAll(
                '.data-pribadi-field'
            );

            fields.forEach(function (field) {

                const fieldName = field.dataset.field;

                const oldValue = normalizeValue(
                    field.dataset.oldValue
                );

                const newValue = normalizeValue(
                    field.value
                );

                if (oldValue !== newValue) {

                    hasChanges = true;

                    createHiddenInput(
                        container,
                        `data[changes][${fieldName}][old]`,
                        oldValue
                    );

                    createHiddenInput(
                        container,
                        `data[changes][${fieldName}][new]`,
                        newValue
                    );

                } else {

                    field.removeAttribute('name');

                }

            });

            if (!hasChanges) {

                event.preventDefault();

                alert(
                    'Tidak ada perubahan data yang disimpan.'
                );

                return;

            }

            submitButton.disabled = true;

            submitButton.innerHTML = `
                <span
                    class="spinner-border spinner-border-sm me-2"
                    role="status"
                ></span>
                Menyimpan...
            `;

        });

        function normalizeValue(value) {

            if (
                value === null ||
                value === undefined ||
                value === 'null'
            ) {

                return '-';

            }

            const normalizedValue = String(value).trim();

            return normalizedValue === ''
                ? '-'
                : normalizedValue;

        }

        function createHiddenInput(
            container,
            name,
            value
        ) {

            const input = document.createElement('input');

            input.type = 'hidden';

            input.name = name;

            input.value = value ?? '';

            container.appendChild(input);

        }

    });

</script>