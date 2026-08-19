<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Kelas — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;

            background:
                radial-gradient(
                    circle at 80% 0%,
                    rgba(37, 99, 235, .055),
                    transparent 30%
                ),
                #f6f8fb;

            color: #172033;

            font-family:
                "DM Sans",
                sans-serif;
        }


        /* =========================================================
           MAIN
        ========================================================== */

        .main-content {
            min-height: 100vh;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .top-header {

            height: 66px;

            background:
                rgba(255,255,255,.94);

            border-bottom:
                1px solid
                #e7ebf2;

            backdrop-filter:
                blur(16px);
        }


        .avatar {

            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            color: #fff;

            font-size: 13px;

            font-weight: 900;

            box-shadow:
                0 7px 20px
                rgba(37,99,235,.20);
        }


        /* =========================================================
           PAGE
        ========================================================== */

        .page {

            max-width: 1050px;

            margin:
                0 auto;

            padding:
                28px 24px 55px;
        }


        /* =========================================================
           BREADCRUMB
        ========================================================== */

        .breadcrumb {

            display: flex;

            align-items: center;

            gap: 8px;

            margin-bottom: 18px;

            color: #94a3b8;

            font-size: 10px;

            font-weight: 700;
        }


        .breadcrumb-current {
            color: #2563eb;
        }


        /* =========================================================
           PAGE HEADER
        ========================================================== */

        .page-header {

            display: flex;

            align-items: flex-start;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 22px;
        }


        .page-heading {

            display: flex;

            align-items: flex-start;

            gap: 13px;
        }


        .heading-icon {

            width: 45px;
            height: 45px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 13px;

            background:
                #eff6ff;

            color:
                #2563eb;
        }


        .eyebrow {

            margin-bottom: 4px;

            color: #94a3b8;

            font-size: 9px;

            font-weight: 800;

            text-transform: uppercase;

            letter-spacing: .11em;
        }


        .page-title {

            margin: 0;

            color: #0f172a;

            font-size: 25px;

            line-height: 1.2;

            letter-spacing: -.025em;

            font-weight: 900;
        }


        .page-description {

            max-width: 560px;

            margin-top: 6px;

            color: #94a3b8;

            font-size: 11px;

            line-height: 1.65;

            font-weight: 600;
        }


        /* =========================================================
           BACK BUTTON
        ========================================================== */

        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 7px;

            min-height: 38px;

            padding:
                0 12px;

            border:
                1px solid
                #e2e8f0;

            border-radius: 10px;

            background: #fff;

            color: #64748b;

            text-decoration: none;

            font-size: 10px;

            font-weight: 800;

            transition:
                .18s ease;
        }


        .back-button:hover {

            color: #2563eb;

            border-color: #dbeafe;

            background: #f8fbff;
        }


        /* =========================================================
           FORM CARD
        ========================================================== */

        .form-card {

            overflow: hidden;

            background: #fff;

            border:
                1px solid
                #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 12px 38px
                rgba(15,23,42,.045);
        }


        .form-top-line {

            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #3b82f6,
                    #60a5fa
                );
        }


        .form-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            padding:
                20px 23px;

            border-bottom:
                1px solid
                #edf1f6;
        }


        .form-header-title {

            color:
                #0f172a;

            font-size:
                13px;

            font-weight:
                900;
        }


        .form-header-description {

            margin-top:
                3px;

            color:
                #94a3b8;

            font-size:
                9px;

            font-weight:
                600;

            line-height:
                1.6;
        }


        .student-badge {

            display:
                inline-flex;

            align-items:
                center;

            gap:
                7px;

            min-height:
                30px;

            padding:
                0 10px;

            border:
                1px solid
                #dbeafe;

            border-radius:
                9px;

            background:
                #eff6ff;

            color:
                #2563eb;

            font-size:
                9px;

            font-weight:
                800;

            white-space:
                nowrap;
        }


        /* =========================================================
           FORM BODY
        ========================================================== */

        .form-body {

            padding:
                25px 23px;
        }


        /* =========================================================
           FIELD
        ========================================================== */

        .field {

            margin-bottom:
                22px;
        }


        .field:last-child {

            margin-bottom:
                0;
        }


        .field-label-row {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                10px;

            margin-bottom:
                7px;
        }


        .field-label {

            color:
                #334155;

            font-size:
                10px;

            font-weight:
                800;
        }


        .required {

            color:
                #ef4444;
        }


        .field-hint {

            color:
                #a1adbd;

            font-size:
                8px;

            font-weight:
                600;
        }


        .input-wrapper {

            position:
                relative;
        }


        .input-icon {

            position:
                absolute;

            left:
                13px;

            top:
                50%;

            transform:
                translateY(-50%);

            color:
                #94a3b8;

            pointer-events:
                none;
        }


        .text-input {

            width:
                100%;

            height:
                46px;

            padding:
                0 13px 0 40px;

            border:
                1px solid
                #dfe5ed;

            border-radius:
                11px;

            outline:
                none;

            background:
                #fff;

            color:
                #172033;

            font-family:
                inherit;

            font-size:
                11px;

            font-weight:
                700;

            transition:
                border .18s ease,
                box-shadow .18s ease;
        }


        .text-input:hover {

            border-color:
                #cbd5e1;
        }


        .text-input:focus {

            border-color:
                #60a5fa;

            box-shadow:
                0 0 0 4px
                rgba(59,130,246,.08);
        }


        .field-error {

            display:
                flex;

            align-items:
                center;

            gap:
                5px;

            margin-top:
                7px;

            color:
                #dc2626;

            font-size:
                9px;

            font-weight:
                700;
        }


        /* =========================================================
           INFO BOX
        ========================================================== */

        .info-box {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                11px;

            margin-top:
                22px;

            padding:
                13px 14px;

            border:
                1px solid
                #dbeafe;

            border-radius:
                11px;

            background:
                #f8fbff;
        }


        .info-icon {

            flex-shrink:
                0;

            color:
                #2563eb;
        }


        .info-title {

            color:
                #334155;

            font-size:
                9px;

            font-weight:
                800;
        }


        .info-text {

            margin-top:
                3px;

            color:
                #64748b;

            font-size:
                8px;

            line-height:
                1.65;

            font-weight:
                600;
        }


        /* =========================================================
           TOGGLE
        ========================================================== */

        .status-box {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                20px;

            padding:
                14px;

            border:
                1px solid
                #e5eaf1;

            border-radius:
                12px;

            background:
                #fafbfd;
        }


        .status-content {

            display:
                flex;

            align-items:
                center;

            gap:
                11px;
        }


        .status-icon {

            width:
                37px;

            height:
                37px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                10px;

            background:
                #ecfdf5;

            color:
                #16a34a;
        }


        .status-title {

            color:
                #334155;

            font-size:
                10px;

            font-weight:
                800;
        }


        .status-description {

            margin-top:
                2px;

            color:
                #94a3b8;

            font-size:
                8px;

            font-weight:
                600;
        }


        .toggle {

            position:
                relative;

            width:
                44px;

            height:
                24px;

            flex-shrink:
                0;
        }


        .toggle input {

            opacity:
                0;

            width:
                0;

            height:
                0;
        }


        .toggle-slider {

            position:
                absolute;

            inset:
                0;

            cursor:
                pointer;

            border-radius:
                999px;

            background:
                #cbd5e1;

            transition:
                .2s ease;
        }


        .toggle-slider::before {

            content:
                "";

            position:
                absolute;

            width:
                18px;

            height:
                18px;

            left:
                3px;

            top:
                3px;

            border-radius:
                999px;

            background:
                #fff;

            box-shadow:
                0 2px 5px
                rgba(15,23,42,.18);

            transition:
                .2s ease;
        }


        .toggle input:checked + .toggle-slider {

            background:
                #2563eb;
        }


        .toggle input:checked + .toggle-slider::before {

            transform:
                translateX(20px);
        }


        /* =========================================================
           WARNING
        ========================================================== */

        .warning-box {

            display:
                flex;

            align-items:
                flex-start;

            gap:
                11px;

            margin-top:
                14px;

            padding:
                13px 14px;

            border:
                1px solid
                #fef3c7;

            border-radius:
                11px;

            background:
                #fffbeb;
        }


        .warning-icon {

            flex-shrink:
                0;

            color:
                #d97706;
        }


        .warning-title {

            color:
                #92400e;

            font-size:
                9px;

            font-weight:
                800;
        }


        .warning-text {

            margin-top:
                3px;

            color:
                #a16207;

            font-size:
                8px;

            line-height:
                1.65;

            font-weight:
                600;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .form-footer {

            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            padding:
                17px 23px;

            border-top:
                1px solid
                #edf1f6;

            background:
                #fbfcfe;
        }


        .delete-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                7px;

            min-height:
                40px;

            padding:
                0 13px;

            border:
                1px solid
                #fee2e2;

            border-radius:
                10px;

            background:
                #fff;

            color:
                #dc2626;

            cursor:
                pointer;

            font-family:
                inherit;

            font-size:
                10px;

            font-weight:
                800;

            transition:
                .18s ease;
        }


        .delete-button:hover {

            background:
                #fff1f2;

            border-color:
                #fecaca;
        }


        .footer-actions {

            display:
                flex;

            align-items:
                center;

            gap:
                9px;
        }


        .secondary-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                7px;

            min-height:
                40px;

            padding:
                0 14px;

            border:
                1px solid
                #e2e8f0;

            border-radius:
                10px;

            background:
                #fff;

            color:
                #64748b;

            text-decoration:
                none;

            font-size:
                10px;

            font-weight:
                800;

            transition:
                .18s ease;
        }


        .secondary-button:hover {

            background:
                #f8fafc;

            color:
                #334155;

            border-color:
                #cbd5e1;
        }


        .submit-button {

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            min-height:
                40px;

            padding:
                0 16px;

            border:
                0;

            border-radius:
                10px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            color:
                #fff;

            cursor:
                pointer;

            font-family:
                inherit;

            font-size:
                10px;

            font-weight:
                800;

            box-shadow:
                0 7px 18px
                rgba(37,99,235,.18);

            transition:
                .18s ease;
        }


        .submit-button:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 10px 24px
                rgba(37,99,235,.24);
        }


        /* =========================================================
           FOOTER PAGE
        ========================================================== */

        .page-footer {

            margin-top:
                25px;

            text-align:
                center;

            color:
                #a1adbd;

            font-size:
                9px;

            font-weight:
                600;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1023px) {

            .main-content {

                margin-left:
                    0 !important;
            }

        }


        @media (max-width: 650px) {

            .page {

                padding:
                    20px 14px 40px;
            }


            .page-header {

                flex-direction:
                    column;
            }


            .back-button {

                width:
                    100%;
            }


            .form-header {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .form-header,
            .form-body,
            .form-footer {

                padding-left:
                    16px;

                padding-right:
                    16px;
            }


            .form-footer {

                align-items:
                    stretch;

                flex-direction:
                    column;
            }


            .footer-actions {

                width:
                    100%;

                flex-direction:
                    column-reverse;
            }


            .delete-button,
            .secondary-button,
            .submit-button {

                width:
                    100%;
            }

        }

    </style>
</head>


<body>


    {{-- =========================================================
     SIDEBAR GURU
========================================================== --}}

@include('guru.partials.sidebar')


{{-- =========================================================
     MAIN
========================================================== --}}

<main
    class="
        main-content
        lg:ml-64
    "
>


    {{-- =====================================================
         HEADBAR GURU
    ====================================================== --}}

    @include('guru.partials.header')


    {{-- =====================================================
         PAGE
    ====================================================== --}}
        <div class="page">


            {{-- =================================================
                 BREADCRUMB
            ================================================== --}}

            <div class="breadcrumb">

                <span>
                    Panel Guru
                </span>

                <span>
                    /
                </span>

                <a
                    href="{{ route('guru.classes.index') }}"
                    class="no-underline text-slate-400 hover:text-blue-600"
                >
                    Kelas
                </a>

                <span>
                    /
                </span>

                <span class="breadcrumb-current">
                    Edit
                </span>

            </div>


            {{-- =================================================
                 PAGE HEADER
            ================================================== --}}

            <div class="page-header">


                <div class="page-heading">

                    <div class="heading-icon">

                        <i
                            data-lucide="pencil-line"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div>

                        <div class="eyebrow">
                            Manajemen Kelas
                        </div>

                        <h1 class="page-title">
                            Edit Kelas
                        </h1>

                        <p class="page-description">
                            Perbarui informasi kelas dan status
                            penggunaannya dalam sistem pembelajaran.
                        </p>

                    </div>

                </div>


                <a
                    href="{{ route('guru.classes.index') }}"
                    class="back-button"
                >

                    <i
                        data-lucide="arrow-left"
                        class="w-3.5 h-3.5"
                    ></i>

                    Kembali

                </a>

            </div>


            {{-- =================================================
                 VALIDATION ERROR
            ================================================== --}}

            @if($errors->any())

                <div
                    class="
                        mb-4
                        rounded-xl
                        border
                        border-rose-100
                        bg-rose-50
                        px-4
                        py-3
                    "
                >

                    <div
                        class="
                            flex
                            items-start
                            gap-2
                            text-rose-700
                        "
                    >

                        <i
                            data-lucide="circle-alert"
                            class="w-4 h-4 mt-0.5 shrink-0"
                        ></i>

                        <div>

                            <p
                                class="
                                    text-[10px]
                                    font-extrabold
                                "
                            >
                                Data belum dapat diperbarui
                            </p>

                            <ul
                                class="
                                    mt-1
                                    space-y-0.5
                                    text-[9px]
                                    font-semibold
                                "
                            >

                                @foreach($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- =================================================
                 FORM CARD
            ================================================== --}}

            <form
                method="POST"
                action="{{ route(
                    'guru.classes.update',
                    $class
                ) }}"
                class="form-card"
            >

                @csrf

                @method('PUT')


                <div class="form-top-line"></div>


                {{-- =================================================
                     FORM HEADER
                ================================================== --}}

                <div class="form-header">

                    <div>

                        <div class="form-header-title">
                            Informasi Kelas
                        </div>

                        <div class="form-header-description">
                            Perbarui informasi dasar kelas yang
                            tersimpan di dalam sistem.
                        </div>

                    </div>


                    <div class="student-badge">

                        <i
                            data-lucide="users"
                            class="w-3.5 h-3.5"
                        ></i>

                        {{ $studentCount }}
                        {{ $studentCount == 1 ? 'Siswa' : 'Siswa' }}

                    </div>

                </div>


                {{-- =================================================
                     FORM BODY
                ================================================== --}}

                <div class="form-body">


                    {{-- =================================================
                         NAMA KELAS
                    ================================================== --}}

                    <div class="field">

                        <div class="field-label-row">

                            <label
                                for="nama"
                                class="field-label"
                            >
                                Nama Kelas
                                <span class="required">*</span>
                            </label>

                            <span class="field-hint">
                                Maksimal 50 karakter
                            </span>

                        </div>


                        <div class="input-wrapper">

                            <i
                                data-lucide="graduation-cap"
                                class="
                                    input-icon
                                    w-4
                                    h-4
                                "
                            ></i>


                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old(
                                    'nama',
                                    $class->nama
                                ) }}"
                                class="text-input"
                                placeholder="Masukkan nama kelas"
                                maxlength="50"
                                autocomplete="off"
                                required
                            >

                        </div>


                        @error('nama')

                            <div class="field-error">

                                <i
                                    data-lucide="circle-alert"
                                    class="w-3 h-3"
                                ></i>

                                {{ $message }}

                            </div>

                        @enderror

                    </div>


                    {{-- =================================================
                         STATUS
                    ================================================== --}}

                    <div class="field">

                        <div class="field-label-row">

                            <label class="field-label">
                                Status Kelas
                            </label>

                            <span class="field-hint">
                                Atur ketersediaan kelas
                            </span>

                        </div>


                        <div class="status-box">


                            <div class="status-content">

                                <div class="status-icon">

                                    <i
                                        data-lucide="badge-check"
                                        class="w-4 h-4"
                                    ></i>

                                </div>


                                <div>

                                    <div class="status-title">
                                        Kelas Aktif
                                    </div>

                                    <div class="status-description">
                                        Kelas dapat dipilih dan
                                        digunakan dalam sistem.
                                    </div>

                                </div>

                            </div>


                            <label class="toggle">

                                <input
                                    type="checkbox"
                                    name="aktif"
                                    value="1"
                                    {{ old(
                                        'aktif',
                                        $class->aktif
                                    ) ? 'checked' : '' }}
                                >

                                <span class="toggle-slider"></span>

                            </label>

                        </div>

                    </div>


                    {{-- =================================================
                         INFO
                    ================================================== --}}

                    <div class="info-box">

                        <div class="info-icon">

                            <i
                                data-lucide="info"
                                class="w-4 h-4"
                            ></i>

                        </div>


                        <div>

                            <div class="info-title">
                                Perubahan nama kelas
                            </div>

                            <div class="info-text">
                                Jika nama kelas diubah, seluruh siswa
                                yang saat ini menggunakan kelas
                                <strong>{{ $class->nama }}</strong>
                                akan otomatis dipindahkan ke nama
                                kelas yang baru.
                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                         WARNING JIKA ADA SISWA
                    ================================================== --}}

                    @if($studentCount > 0)

                        <div class="warning-box">

                            <div class="warning-icon">

                                <i
                                    data-lucide="triangle-alert"
                                    class="w-4 h-4"
                                ></i>

                            </div>


                            <div>

                                <div class="warning-title">
                                    Kelas sedang digunakan
                                </div>

                                <div class="warning-text">

                                    Kelas ini sedang digunakan oleh
                                    <strong>
                                        {{ $studentCount }} siswa
                                    </strong>.
                                    Perubahan nama kelas akan ikut
                                    memperbarui data kelas siswa
                                    tersebut.

                                </div>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- =================================================
                     FORM FOOTER
                ================================================== --}}

                <div class="form-footer">


                    {{-- DELETE --}}

                    <button
                        type="button"
                        class="delete-button"
                        onclick="confirmDelete()"
                    >

                        <i
                            data-lucide="trash-2"
                            class="w-3.5 h-3.5"
                        ></i>

                        Hapus Kelas

                    </button>


                    <div class="footer-actions">


                        <a
                            href="{{ route('guru.classes.index') }}"
                            class="secondary-button"
                        >

                            <i
                                data-lucide="x"
                                class="w-3.5 h-3.5"
                            ></i>

                            Batal

                        </a>


                        <button
                            type="submit"
                            class="submit-button"
                        >

                            <i
                                data-lucide="save"
                                class="w-3.5 h-3.5"
                            ></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </div>

            </form>


            {{-- =================================================
                 DELETE FORM TERPISAH
            ================================================== --}}

            <form
                id="delete-class-form"
                method="POST"
                action="{{ route(
                    'guru.classes.destroy',
                    $class
                ) }}"
                class="hidden"
            >

                @csrf

                @method('DELETE')

            </form>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="page-footer">

                LARASKU · Manajemen Kelas

            </div>

        </div>

    </main>


    {{-- =========================================================
         SCRIPT
    ========================================================== --}}

    <script>

        function confirmDelete() {

            const studentCount =
                {{ $studentCount }};

            const className =
                @json($class->nama);


            if (studentCount > 0) {

                alert(
                    'Kelas ' +
                    className +
                    ' tidak dapat dihapus karena masih memiliki ' +
                    studentCount +
                    ' siswa.'
                );

                return;

            }


            const confirmed =
                confirm(
                    'Yakin ingin menghapus kelas ' +
                    className +
                    '?'
                );


            if (confirmed) {

                document
                    .getElementById(
                        'delete-class-form'
                    )
                    .submit();

            }

        }


        document.addEventListener(
            'DOMContentLoaded',
            function () {

                if (
                    typeof lucide !== 'undefined'
                ) {

                    lucide.createIcons();

                }

            }
        );

    </script>

</body>

</html>