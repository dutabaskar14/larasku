<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Materi — LARASKU</title>


    {{-- =========================================================
         TAILWIND
    ========================================================== --}}

    <script src="https://cdn.tailwindcss.com"></script>


    {{-- =========================================================
         LUCIDE
    ========================================================== --}}

    <script src="https://unpkg.com/lucide@latest"></script>


    {{-- =========================================================
         GOOGLE FONT
    ========================================================== --}}

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Lora:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700;800&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet"
    >


    {{-- =========================================================
         QUILL
    ========================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css"
        rel="stylesheet"
    >


    {{-- =========================================================
         QUILL RESIZE
    ========================================================== --}}

    <link
        href="https://cdn.jsdelivr.net/npm/quill-resize-module@2.1.3/dist/resize.css"
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
            background: #f4f7fb;
            color: #1e293b;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }


        /* =========================================================
           FORM
        ========================================================== */

        .form-card {
            background: #ffffff;

            border:
                1px solid
                #e2e8f0;

            border-radius:
                20px;

            box-shadow:
                0 8px 30px
                rgba(
                    15,
                    23,
                    42,
                    .045
                );

            overflow:
                hidden;
        }


        .form-section {
            padding:
                26px;
        }


        .form-section + .form-section {
            border-top:
                1px solid
                #eef2f7;
        }


        .section-heading {
            display:
                flex;

            align-items:
                flex-start;

            gap:
                13px;

            margin-bottom:
                22px;
        }


        .section-icon {
            width:
                40px;

            height:
                40px;

            min-width:
                40px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                11px;

            background:
                #eff6ff;

            color:
                #2563eb;
        }


        .section-title {
            font-size:
                15px;

            font-weight:
                800;

            color:
                #0f172a;
        }


        .section-description {
            margin-top:
                3px;

            font-size:
                12px;

            line-height:
                1.6;

            color:
                #94a3b8;
        }


        .field-label {
            display:
                block;

            margin-bottom:
                8px;

            font-size:
                12px;

            font-weight:
                750;

            color:
                #334155;
        }


        .required {
            color:
                #ef4444;
        }


        .field-help {
            margin-top:
                6px;

            font-size:
                11px;

            line-height:
                1.5;

            color:
                #94a3b8;
        }


        .field-error {
            margin-top:
                6px;

            font-size:
                11px;

            font-weight:
                600;

            color:
                #dc2626;
        }


        .input,
        .select {
            width:
                100%;

            height:
                46px;

            padding:
                0 13px;

            border:
                1px solid
                #dbe3ed;

            background:
                #ffffff;

            border-radius:
                11px;

            color:
                #0f172a;

            font-size:
                13px;

            outline:
                none;

            transition:
                .18s ease;
        }


        .input:focus,
        .select:focus {
            border-color:
                #60a5fa;

            box-shadow:
                0 0 0 4px
                rgba(
                    59,
                    130,
                    246,
                    .08
                );
        }


        .input::placeholder {
            color:
                #c0c8d4;
        }


        /* =========================================================
           HERO
        ========================================================== */

        .hero {
            position:
                relative;

            overflow:
                hidden;

            background:
                linear-gradient(
                    135deg,
                    #ffffff 0%,
                    #f8fbff 100%
                );

            border:
                1px solid
                #e2e8f0;

            border-radius:
                20px;

            padding:
                26px;

            margin-bottom:
                22px;

            box-shadow:
                0 8px 30px
                rgba(
                    15,
                    23,
                    42,
                    .035
                );
        }


        .hero::after {
            content:
                "";

            position:
                absolute;

            width:
                190px;

            height:
                190px;

            right:
                -70px;

            top:
                -90px;

            border-radius:
                999px;

            background:
                rgba(
                    59,
                    130,
                    246,
                    .07
                );
        }


        .hero-content {
            position:
                relative;

            z-index:
                2;
        }


        .hero-eyebrow {
            display:
                inline-flex;

            align-items:
                center;

            gap:
                7px;

            color:
                #2563eb;

            font-size:
                11px;

            font-weight:
                850;

            text-transform:
                uppercase;

            letter-spacing:
                .09em;

            margin-bottom:
                8px;
        }


        .hero-title {
            margin:
                0;

            font-size:
                28px;

            line-height:
                1.2;

            font-weight:
                900;

            letter-spacing:
                -.035em;

            color:
                #0f172a;
        }


        .hero-description {
            max-width:
                680px;

            margin-top:
                8px;

            font-size:
                13px;

            line-height:
                1.7;

            color:
                #64748b;
        }


        .material-badge {
            display:
                inline-flex;

            align-items:
                center;

            gap:
                7px;

            margin-top:
                14px;

            padding:
                7px 11px;

            border:
                1px solid
                #dbeafe;

            border-radius:
                999px;

            background:
                #eff6ff;

            color:
                #2563eb;

            font-size:
                11px;

            font-weight:
                800;
        }


        /* =========================================================
           GRID
        ========================================================== */

        .grid-2 {
            display:
                grid;

            grid-template-columns:
                repeat(
                    2,
                    minmax(
                        0,
                        1fr
                    )
                );

            gap:
                18px;
        }


        /* =========================================================
           RICH EDITOR
        ========================================================== */

        .editor-wrapper {
            border:
                1px solid
                #dbe3ed;

            border-radius:
                14px;

            overflow:
                visible;

            background:
                #ffffff;
        }


        #toolbar {
            background:
                #f8fafc;

            border:
                0;

            border-bottom:
                1px solid
                #e2e8f0;

            border-radius:
                13px 13px 0 0;

            padding:
                10px;
        }


        .ql-toolbar.ql-snow {
            border:
                0;

            background:
                #f8fafc;
        }


        .ql-container.ql-snow {
            border:
                0;

            border-radius:
                0 0 13px 13px;
        }


        #editor {
            min-height:
                430px;

            font-size:
                15px;

            line-height:
                1.85;

            color:
                #334155;
        }


        .ql-editor {
            min-height:
                430px;

            padding:
                22px;

            overflow-wrap:
                break-word;
        }


        .ql-editor.ql-blank::before {
            color:
                #c0c8d4;

            font-style:
                normal;

            left:
                22px;
        }


        .ql-editor h1 {
            font-size:
                30px;

            line-height:
                1.25;

            font-weight:
                850;

            color:
                #0f172a;
        }


        .ql-editor h2 {
            font-size:
                23px;

            line-height:
                1.3;

            font-weight:
                850;

            color:
                #0f172a;
        }


        .ql-editor h3 {
            font-size:
                18px;

            line-height:
                1.4;

            font-weight:
                800;

            color:
                #1e293b;
        }


        .ql-editor blockquote {
            border-left:
                4px solid
                #3b82f6;

            background:
                #f8fafc;

            padding:
                12px 16px;

            border-radius:
                0 10px 10px 0;

            color:
                #475569;
        }


        /* =========================================================
           IMAGE EDITOR
        ========================================================== */

        .ql-editor img {
            max-width:
                100%;

            height:
                auto;

            border-radius:
                10px;

            margin:
                12px 0;

            cursor:
                pointer;

            transition:
                box-shadow
                .15s ease;
        }


        .ql-editor img:hover {
            box-shadow:
                0 0 0 3px
                rgba(
                    37,
                    99,
                    235,
                    .10
                );
        }


        .ql-editor .ql-align-center img {
            display:
                block;

            margin-left:
                auto;

            margin-right:
                auto;
        }


        .ql-editor .ql-align-right img {
            display:
                block;

            margin-left:
                auto;
        }


        .ql-editor .ql-align-left img {
            display:
                block;

            margin-left:
                0;

            margin-right:
                auto;
        }


        /* =========================================================
           FONT
        ========================================================== */

        .ql-font-poppins {
            font-family:
                Poppins,
                sans-serif;
        }


        .ql-font-montserrat {
            font-family:
                Montserrat,
                sans-serif;
        }


        .ql-font-playfair {
            font-family:
                "Playfair Display",
                serif;
        }


        .ql-font-lora {
            font-family:
                Lora,
                serif;
        }


        .ql-font-roboto {
            font-family:
                Roboto,
                sans-serif;
        }


        .ql-font-serif {
            font-family:
                Georgia,
                serif;
        }


        .ql-font-monospace {
            font-family:
                "SFMono-Regular",
                Consolas,
                monospace;
        }


        /* =========================================================
           FONT PICKER
        ========================================================== */

        .ql-snow
        .ql-picker.ql-font {
            width:
                145px;
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="poppins"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="poppins"]::before {
            content:
                "Poppins";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="montserrat"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="montserrat"]::before {
            content:
                "Montserrat";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="playfair"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="playfair"]::before {
            content:
                "Playfair Display";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="lora"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="lora"]::before {
            content:
                "Lora";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="roboto"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="roboto"]::before {
            content:
                "Roboto";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="serif"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="serif"]::before {
            content:
                "Serif";
        }


        .ql-snow
        .ql-picker.ql-font
        .ql-picker-label[data-value="monospace"]::before,
        .ql-snow
        .ql-picker.ql-font
        .ql-picker-item[data-value="monospace"]::before {
            content:
                "Mono";
        }


        /* =========================================================
           SIZE
        ========================================================== */

        .ql-snow
        .ql-picker.ql-size {
            width:
                105px;
        }


        .ql-snow
        .ql-picker {
            font-size:
                12px;
        }


        .ql-snow
        .ql-picker-label {
            border-radius:
                7px;
        }


        .ql-snow button:hover,
        .ql-snow
        .ql-picker-label:hover {
            color:
                #2563eb;
        }


        /* =========================================================
           RESIZE MODULE
        ========================================================== */

        .ql-image-resize {
            z-index:
                50;
        }


        .ql-editor img {
            max-width:
                100%;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status-box {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            padding:
                15px;

            border:
                1px solid
                #e2e8f0;

            border-radius:
                13px;

            background:
                #f8fafc;
        }


        .status-info {
            display:
                flex;

            align-items:
                center;

            gap:
                12px;
        }


        .status-icon {
            width:
                38px;

            height:
                38px;

            border-radius:
                10px;

            background:
                #dcfce7;

            color:
                #16a34a;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;
        }


        .status-title {
            font-size:
                12px;

            font-weight:
                800;

            color:
                #334155;
        }


        .status-description {
            margin-top:
                2px;

            font-size:
                10px;

            color:
                #94a3b8;
        }


        /* =========================================================
           SWITCH
        ========================================================== */

        .switch {
            position:
                relative;

            width:
                48px;

            height:
                27px;

            flex-shrink:
                0;
        }


        .switch input {
            opacity:
                0;

            width:
                0;

            height:
                0;
        }


        .slider {
            position:
                absolute;

            inset:
                0;

            cursor:
                pointer;

            background:
                #cbd5e1;

            border-radius:
                999px;

            transition:
                .2s;
        }


        .slider::before {
            content:
                "";

            position:
                absolute;

            width:
                21px;

            height:
                21px;

            left:
                3px;

            top:
                3px;

            background:
                #ffffff;

            border-radius:
                50%;

            box-shadow:
                0 1px 4px
                rgba(
                    15,
                    23,
                    42,
                    .2
                );

            transition:
                .2s;
        }


        .switch input:checked + .slider {
            background:
                #2563eb;
        }


        .switch input:checked + .slider::before {
            transform:
                translateX(21px);
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .form-actions {
            display:
                flex;

            align-items:
                center;

            justify-content:
                space-between;

            gap:
                15px;

            padding:
                20px 26px;

            border-top:
                1px solid
                #eef2f7;

            background:
                #fbfcfe;
        }


        .cancel-button,
        .submit-button {
            min-height:
                44px;

            display:
                inline-flex;

            align-items:
                center;

            justify-content:
                center;

            gap:
                8px;

            padding:
                0 17px;

            border-radius:
                11px;

            font-size:
                12px;

            font-weight:
                800;

            text-decoration:
                none;

            transition:
                .18s ease;

            cursor:
                pointer;
        }


        .cancel-button {
            border:
                1px solid
                #e2e8f0;

            background:
                #ffffff;

            color:
                #64748b;
        }


        .cancel-button:hover {
            background:
                #f8fafc;

            color:
                #334155;
        }


        .submit-button {
            border:
                1px solid
                #2563eb;

            background:
                #2563eb;

            color:
                #ffffff;

            box-shadow:
                0 5px 14px
                rgba(
                    37,
                    99,
                    235,
                    .18
                );
        }


        .submit-button:hover {
            background:
                #1d4ed8;

            transform:
                translateY(-1px);
        }


        .submit-button:disabled {
            transform:
                none;

            opacity:
                .7;

            cursor:
                not-allowed;
        }


        /* =========================================================
           ERROR
        ========================================================== */

        .error-alert {
            margin-bottom:
                20px;

            padding:
                15px 17px;

            border:
                1px solid
                #fecaca;

            border-radius:
                13px;

            background:
                #fef2f2;

            color:
                #991b1b;

            font-size:
                12px;
        }


        .error-alert-title {
            display:
                flex;

            align-items:
                center;

            gap:
                8px;

            font-weight:
                800;

            margin-bottom:
                7px;
        }


        .error-alert ul {
            margin:
                0;

            padding-left:
                27px;
        }


        .error-alert li {
            margin-bottom:
                3px;
        }


        /* =========================================================
           EXISTING MATERIAL INFO
        ========================================================== */

        .existing-info {
            margin-top:
                12px;

            display:
                flex;

            flex-wrap:
                wrap;

            align-items:
                center;

            gap:
                8px;
        }


        .existing-badge {
            display:
                inline-flex;

            align-items:
                center;

            gap:
                6px;

            padding:
                6px 9px;

            border:
                1px solid
                #e2e8f0;

            border-radius:
                999px;

            background:
                #f8fafc;

            color:
                #64748b;

            font-size:
                10px;

            font-weight:
                700;
        }


        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 700px) {

            .grid-2 {
                grid-template-columns:
                    1fr;
            }


            .hero {
                padding:
                    21px;
            }


            .hero-title {
                font-size:
                    24px;
            }


            .form-section {
                padding:
                    20px;
            }


            .form-actions {
                padding:
                    17px 20px;

                flex-direction:
                    column-reverse;

                align-items:
                    stretch;
            }


            .cancel-button,
            .submit-button {
                width:
                    100%;
            }


            .status-box {
                align-items:
                    flex-start;
            }


            .ql-toolbar.ql-snow {
                overflow-x:
                    auto;

                white-space:
                    nowrap;
            }


            #editor,
            .ql-editor {
                min-height:
                    360px;
            }

        }

    </style>

</head>


<body class="min-h-screen text-slate-800">


    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main
        class="main-content lg:ml-64 transition-all duration-300"
    >


        {{-- =====================================================
             HEADER GURU
        ====================================================== --}}

        @include('guru.partials.header')


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div
            class="
                p-5
                lg:p-8
                max-w-[1500px]
                mx-auto
            "
        >


            {{-- =====================================================
                 HERO
            ====================================================== --}}

            <section class="hero">

                <div class="hero-content">

                    <div class="hero-eyebrow">

                        <i
                            data-lucide="book-open-check"
                            class="w-4 h-4"
                        ></i>

                        Materi Pembelajaran

                    </div>


                    <h1 class="hero-title">

                        Edit Materi

                    </h1>


                    <p class="hero-description">

                        Perbarui judul, pertemuan, kategori,
                        isi materi, dan status publikasi
                        tanpa membuat materi baru.

                    </p>


                    <div class="material-badge">

                        <i
                            data-lucide="file-edit"
                            class="w-3.5 h-3.5"
                        ></i>

                        Mengedit:
                        {{ $material->judul }}

                    </div>

                </div>

            </section>


            {{-- =====================================================
                 ERROR
            ====================================================== --}}

            @if($errors->any())

                <div class="error-alert">

                    <div class="error-alert-title">

                        <i
                            data-lucide="circle-alert"
                            class="w-4 h-4"
                        ></i>

                        Periksa kembali data materi

                    </div>


                    <ul>

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =====================================================
                 FORM UPDATE
            ====================================================== --}}

            <form
                action="{{ route('guru.materials.update', $material) }}"
                method="POST"
                enctype="multipart/form-data"
                id="materialForm"
                class="form-card"
            >

                @csrf

                @method('PUT')


                {{-- =================================================
                     INFORMASI DASAR
                ================================================== --}}

                <section class="form-section">


                    <div class="section-heading">

                        <div class="section-icon">

                            <i
                                data-lucide="file-text"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <div class="section-title">

                                Informasi Materi

                            </div>


                            <div class="section-description">

                                Perbarui identitas dan posisi materi
                                dalam pembelajaran.

                            </div>

                        </div>

                    </div>


                    <div class="grid-2">


                        {{-- =================================================
                             JUDUL
                        ================================================== --}}

                        <div class="md:col-span-2">

                            <label
                                for="judul"
                                class="field-label"
                            >

                                Judul Materi

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <input
                                type="text"
                                id="judul"
                                name="judul"
                                value="{{ old('judul', $material->judul) }}"
                                class="input"
                                placeholder="Contoh: Mengenal Musik Tradisional Nusantara"
                                required
                            >


                            @error('judul')

                                <div class="field-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- =================================================
                             PERTEMUAN
                        ================================================== --}}

                        <div>

                            <label
                                for="pertemuan"
                                class="field-label"
                            >

                                Pertemuan

                                <span class="required">
                                    *
                                </span>

                            </label>


                            <select
                                id="pertemuan"
                                name="pertemuan"
                                class="select"
                                required
                            >

                                <option value="">
                                    Pilih pertemuan
                                </option>


                                @foreach($pertemuans as $item)

                                    <option
                                        value="{{ $item }}"
                                        {{ (string) old('pertemuan', $material->pertemuan) === (string) $item ? 'selected' : '' }}
                                    >

                                        Pertemuan {{ $item }}

                                    </option>

                                @endforeach

                            </select>


                            <div class="existing-info">

                                <span class="existing-badge">

                                    <i
                                        data-lucide="calendar"
                                        class="w-3 h-3"
                                    ></i>

                                    Saat ini:
                                    Pertemuan {{ $material->pertemuan }}

                                </span>

                            </div>


                            <div class="field-help">

                                Pilih pertemuan yang sudah tersedia.
                                Perubahan ini hanya memindahkan materi
                                ke pertemuan yang dipilih.

                            </div>


                            @error('pertemuan')

                                <div class="field-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- =================================================
                             KATEGORI
                        ================================================== --}}

                        <div>

                            <label
                                for="kategori"
                                class="field-label"
                            >

                                Kategori

                            </label>


                            <input
                                type="text"
                                id="kategori"
                                name="kategori"
                                value="{{ old('kategori', $material->kategori) }}"
                                class="input"
                                placeholder="Contoh: Teori Musik"
                            >


                            <div class="field-help">

                                Kategori bersifat opsional.

                            </div>


                            @error('kategori')

                                <div class="field-error">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                    </div>

                </section>


                {{-- =================================================
                     EDITOR
                ================================================== --}}

                <section class="form-section">


                    <div class="section-heading">

                        <div class="section-icon">

                            <i
                                data-lucide="pen-line"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <div class="section-title">

                                Isi Materi

                            </div>


                            <div class="section-description">

                                Edit konten pembelajaran dengan teks,
                                gambar, font, warna, dan format tulisan.

                            </div>

                        </div>

                    </div>


                    <label class="field-label">

                        Konten Pembelajaran

                        <span class="required">
                            *
                        </span>

                    </label>


                    {{-- =================================================
                         EDITOR WRAPPER
                    ================================================== --}}

                    <div class="editor-wrapper">


                        {{-- =================================================
                             TOOLBAR
                        ================================================== --}}

                        <div id="toolbar">


                            {{-- FONT + SIZE --}}

                            <span class="ql-formats">

                                <select class="ql-font">

                                    <option
                                        selected
                                        value="sans"
                                    >
                                        Sans
                                    </option>

                                    <option value="poppins">
                                        Poppins
                                    </option>

                                    <option value="montserrat">
                                        Montserrat
                                    </option>

                                    <option value="roboto">
                                        Roboto
                                    </option>

                                    <option value="playfair">
                                        Playfair
                                    </option>

                                    <option value="lora">
                                        Lora
                                    </option>

                                    <option value="serif">
                                        Serif
                                    </option>

                                    <option value="monospace">
                                        Mono
                                    </option>

                                </select>


                                <select class="ql-size">

                                    <option value="small">
                                        Kecil
                                    </option>

                                    <option
                                        selected
                                        value=""
                                    >
                                        Normal
                                    </option>

                                    <option value="large">
                                        Besar
                                    </option>

                                    <option value="huge">
                                        Sangat Besar
                                    </option>

                                </select>

                            </span>


                            {{-- TEXT FORMAT --}}

                            <span class="ql-formats">

                                <button
                                    class="ql-bold"
                                ></button>

                                <button
                                    class="ql-italic"
                                ></button>

                                <button
                                    class="ql-underline"
                                ></button>

                                <button
                                    class="ql-strike"
                                ></button>

                            </span>


                            {{-- HEADING --}}

                            <span class="ql-formats">

                                <select class="ql-header">

                                    <option selected></option>

                                    <option value="1"></option>

                                    <option value="2"></option>

                                    <option value="3"></option>

                                </select>

                            </span>


                            {{-- COLOR --}}

                            <span class="ql-formats">

                                <select class="ql-color"></select>

                                <select class="ql-background"></select>

                            </span>


                            {{-- LIST --}}

                            <span class="ql-formats">

                                <button
                                    class="ql-list"
                                    value="ordered"
                                ></button>

                                <button
                                    class="ql-list"
                                    value="bullet"
                                ></button>

                                <button
                                    class="ql-blockquote"
                                ></button>

                            </span>


                            {{-- ALIGNMENT --}}

                            <span class="ql-formats">

                                <button
                                    class="ql-align"
                                    value=""
                                ></button>

                                <button
                                    class="ql-align"
                                    value="center"
                                ></button>

                                <button
                                    class="ql-align"
                                    value="right"
                                ></button>

                                <button
                                    class="ql-align"
                                    value="justify"
                                ></button>

                            </span>


                            {{-- LINK + IMAGE --}}

                            <span class="ql-formats">

                                <button
                                    class="ql-link"
                                ></button>

                                <button
                                    class="ql-image"
                                    type="button"
                                ></button>

                                <button
                                    class="ql-clean"
                                ></button>

                            </span>


                        </div>


                        {{-- =================================================
                             EDITOR
                        ================================================== --}}

                        <div id="editor"></div>


                    </div>


                    {{-- =================================================
                         HIDDEN CONTENT
                    ================================================== --}}

                    <textarea
                        name="isi"
                        id="isi"
                        class="hidden"
                    >{{ old('isi', $material->isi) }}</textarea>


                    <div class="field-help mt-3">

                        <strong>Tips:</strong>

                        Klik ikon gambar untuk memasukkan gambar.

                        Setelah gambar dipilih, klik gambar tersebut
                        untuk menampilkan kontrol resize.

                        <strong>
                            Tarik handle gambar
                        </strong>

                        untuk memperbesar atau memperkecil.

                        Toolbar gambar juga dapat digunakan
                        untuk mengatur posisi gambar.

                    </div>


                    @error('isi')

                        <div class="field-error">
                            {{ $message }}
                        </div>

                    @enderror


                </section>


                {{-- =================================================
                     STATUS
                ================================================== --}}

                <section class="form-section">


                    <div class="section-heading">

                        <div class="section-icon">

                            <i
                                data-lucide="settings-2"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <div class="section-title">

                                Publikasi Materi

                            </div>


                            <div class="section-description">

                                Tentukan apakah materi dapat
                                langsung diakses oleh siswa.

                            </div>

                        </div>

                    </div>


                    <div class="status-box">


                        <div class="status-info">

                            <div class="status-icon">

                                <i
                                    data-lucide="eye"
                                    class="w-5 h-5"
                                ></i>

                            </div>


                            <div>

                                <div class="status-title">

                                    Materi Aktif

                                </div>


                                <div class="status-description">

                                    Materi dapat dilihat siswa
                                    ketika status aktif.

                                </div>

                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                name="aktif"
                                value="1"
                                {{ old('aktif', $material->aktif) ? 'checked' : '' }}
                            >

                            <span class="slider"></span>

                        </label>


                    </div>


                </section>


                {{-- =================================================
                     ACTIONS
                ================================================== --}}

                <div class="form-actions">


                    <a
                        href="{{ route('guru.materials.index') }}"
                        class="cancel-button"
                    >

                        <i
                            data-lucide="arrow-left"
                            class="w-4 h-4"
                        ></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="submit-button"
                        id="submitButton"
                    >

                        <i
                            data-lucide="save"
                            class="w-4 h-4"
                        ></i>

                        Update Materi

                    </button>


                </div>


            </form>


            <div
                class="
                    text-center
                    text-[11px]
                    text-slate-400
                    mt-6
                "
            >

                LARASKU · Panel Guru

            </div>


        </div>


    </main>


    {{-- =========================================================
         QUILL JS
    ========================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>


    {{-- =========================================================
         QUILL RESIZE MODULE
    ========================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/quill-resize-module@2.1.3/dist/resize.js"></script>


    <script>


        /* =========================================================
           LUCIDE
        ========================================================== */

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


        /* =========================================================
           REGISTER FONT
        ========================================================== */

        const Font =
            Quill.import(
                'formats/font'
            );


        Font.whitelist = [

            'sans',

            'poppins',

            'montserrat',

            'roboto',

            'playfair',

            'lora',

            'serif',

            'monospace'

        ];


        Quill.register(
            Font,
            true
        );


        /* =========================================================
           REGISTER RESIZE MODULE
        ========================================================== */

        if (
            typeof QuillResizeModule !==
            'undefined'
        ) {

            Quill.register(
                'modules/resize',
                QuillResizeModule
            );

        }


        /* =========================================================
           QUILL EDITOR
        ========================================================== */

        const editor =
            new Quill(
                '#editor',
                {

                    theme:
                        'snow',


                    placeholder:
                        'Tulis isi materi pembelajaran di sini...',


                    modules: {


                        /* =========================================
                           TOOLBAR
                        ========================================== */

                        toolbar: {

                            container:
                                '#toolbar',

                            handlers: {

                                image:
                                    function () {

                                        openImagePicker();

                                    }

                            }

                        },


                        /* =========================================
                           RESIZE GAMBAR
                        ========================================== */

                        resize: {

                            modules: [

                                'Resize',

                                'DisplaySize',

                                'Toolbar'

                            ],


                            parchment: {

                                image: {

                                    attribute: [

                                        'width'

                                    ],


                                    limit: {

                                        minWidth:
                                            80,

                                        maxWidth:
                                            900,

                                        minHeight:
                                            40,

                                        maxHeight:
                                            900

                                    }

                                }

                            },


                            locale: {

                                left:
                                    'Kiri',

                                center:
                                    'Tengah',

                                right:
                                    'Kanan',

                                restore:
                                    'Reset'

                            }

                        }

                    }

                }
            );


        /* =========================================================
           LOAD EXISTING CONTENT
        ========================================================== */

        const existingContent =
            @json(old('isi', $material->isi ?? ''));


        if (
            existingContent &&
            existingContent.trim() !== ''
        ) {

            editor.clipboard.dangerouslyPasteHTML(
                existingContent
            );

        }


        /* =========================================================
           HIDDEN INPUT
        ========================================================== */

        const hiddenInput =
            document.getElementById(
                'isi'
            );


        function syncEditor() {

            hiddenInput.value =
                editor.root.innerHTML;

        }


        editor.on(
            'text-change',
            function () {

                syncEditor();

            }
        );


        /* =========================================================
           IMAGE PICKER
        ========================================================== */

        function openImagePicker() {

            const input =
                document.createElement(
                    'input'
                );


            input.type =
                'file';


            input.accept =
                'image/jpeg,image/png,image/webp';


            input.click();


            input.onchange =
                function () {

                    if (
                        !input.files ||
                        !input.files.length
                    ) {

                        return;

                    }


                    uploadEditorImage(
                        input.files[0]
                    );

                };

        }


        /* =========================================================
           UPLOAD IMAGE
        ========================================================== */

        async function uploadEditorImage(
            file
        ) {

            if (
                !file ||
                !file.type.startsWith(
                    'image/'
                )
            ) {

                alert(
                    'File harus berupa gambar.'
                );

                return;

            }


            const maxSize =
                5 * 1024 * 1024;


            if (
                file.size >
                maxSize
            ) {

                alert(
                    'Ukuran gambar maksimal 5 MB.'
                );

                return;

            }


            const formData =
                new FormData();


            formData.append(
                'image',
                file
            );


            const csrf =
                document
                    .querySelector(
                        'input[name="_token"]'
                    )
                    .value;


            try {

                const response =
                    await fetch(

                        "{{ route('guru.materials.upload-image') }}",

                        {

                            method:
                                'POST',

                            headers: {

                                'X-CSRF-TOKEN':
                                    csrf,

                                'Accept':
                                    'application/json'

                            },

                            body:
                                formData

                        }

                    );


                if (
                    !response.ok
                ) {

                    throw new Error(
                        'Upload gambar gagal.'
                    );

                }


                const data =
                    await response.json();


                if (
                    !data.success ||
                    !data.url
                ) {

                    throw new Error(
                        'URL gambar tidak diterima.'
                    );

                }


                let range =
                    editor.getSelection(
                        true
                    );


                if (!range) {

                    range = {

                        index:
                            editor.getLength(),

                        length:
                            0

                    };

                }


                editor.insertEmbed(

                    range.index,

                    'image',

                    data.url,

                    'user'

                );


                editor.setSelection(

                    range.index + 1,

                    0

                );


                syncEditor();


            } catch (error) {

                console.error(
                    error
                );


                alert(
                    'Gambar gagal diupload. Silakan coba lagi.'
                );

            }

        }


        /* =========================================================
           DRAG & DROP IMAGE
        ========================================================== */

        editor.root.addEventListener(
            'drop',
            function (event) {


                const files =
                    event.dataTransfer.files;


                if (
                    !files ||
                    !files.length
                ) {

                    return;

                }


                const image =
                    Array
                        .from(files)
                        .find(
                            file =>
                                file.type
                                    .startsWith(
                                        'image/'
                                    )
                        );


                if (!image) {

                    return;

                }


                event.preventDefault();


                uploadEditorImage(
                    image
                );

            }
        );


        /* =========================================================
           PASTE IMAGE
        ========================================================== */

        editor.root.addEventListener(
            'paste',
            function (event) {


                const clipboard =
                    event.clipboardData;


                if (!clipboard) {

                    return;

                }


                const items =
                    Array.from(
                        clipboard.items || []
                    );


                const imageItem =
                    items.find(
                        item =>
                            item.type
                                .startsWith(
                                    'image/'
                                )
                    );


                if (!imageItem) {

                    return;

                }


                const file =
                    imageItem.getAsFile();


                if (!file) {

                    return;

                }


                event.preventDefault();


                uploadEditorImage(
                    file
                );

            }
        );


        /* =========================================================
           FORM SUBMIT
        ========================================================== */

        const form =
            document.getElementById(
                'materialForm'
            );


        form.addEventListener(
            'submit',
            function () {


                syncEditor();


                const submitButton =
                    document.getElementById(
                        'submitButton'
                    );


                if (
                    submitButton
                ) {

                    submitButton.disabled =
                        true;


                    submitButton.innerHTML = `

                        <svg
                            class="w-4 h-4 animate-spin"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >

                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                                stroke="currentColor"
                                stroke-width="2"
                                opacity=".3"
                            ></circle>


                            <path
                                d="M21 12a9 9 0 0 0-9-9"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                            ></path>

                        </svg>

                        Menyimpan...

                    `;

                }

            }
        );


        /* =========================================================
           INITIAL SYNC
        ========================================================== */

        syncEditor();


    </script>


</body>

</html>