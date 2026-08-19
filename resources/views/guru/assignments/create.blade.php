{{-- =========================================================
     GURU — TAMBAH TUGAS PENGUMPULAN
     CSS + JS LANGSUNG DI DALAM BLADE
========================================================= --}}

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Tugas — Guru</title>


   {{-- =====================================================
         FONT
    ====================================================== --}}

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
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- =====================================================
         LUCIDE
    ====================================================== --}}

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>


    {{-- =====================================================
         CSS
    ====================================================== --}}

    <style>

        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
        }


        button,
        input,
        textarea,
        select {
            font-family: inherit;
        }


        a {
            text-decoration: none;
        }


        /* =====================================================
           LAYOUT
        ===================================================== */

        .assignment-page {
            min-height: 100vh;
            background: #f8fafc;
        }


        .assignment-main {
            min-height: 100vh;
            width: calc(100% - 240px);
            margin-left: 240px;
            min-width: 0;
        }


        .assignment-content {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 28px 32px 50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .page-header {
            margin-bottom: 24px;
        }


        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 17px;
            transition: .2s ease;
        }


        .back-link:hover {
            color: #2563eb;
        }


        .page-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 7px 11px;
            border-radius: 999px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 10px;
            font-weight: 800;
            margin-bottom: 10px;
        }


        .page-title {
            margin: 0;
            color: #0f172a;
            font-size: 27px;
            line-height: 1.15;
            font-weight: 800;
            letter-spacing: -.025em;
        }


        .page-description {
            margin: 8px 0 0;
            max-width: 680px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
            font-weight: 500;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 14px 16px;
            border-radius: 14px;
            margin-bottom: 20px;
            font-size: 12px;
            line-height: 1.6;
            font-weight: 600;
        }


        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }


        .alert-icon {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }


        /* =====================================================
           FORM CARD
        ===================================================== */

        .form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            box-shadow: 0 2px 8px rgba(15, 23, 42, .035);
            overflow: hidden;
        }


        .form-card-header {
            padding: 20px 22px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 12px;
        }


        .header-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }


        .form-card-header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 15px;
            font-weight: 800;
        }


        .form-card-header p {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
            font-weight: 500;
        }


        .form-body {
            padding: 24px 22px 26px;
        }


        /* =====================================================
           GRID
        ===================================================== */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }


        .full-width {
            grid-column: 1 / -1;
        }


        /* =====================================================
           FIELD
        ===================================================== */

        .field {
            min-width: 0;
        }


        .field-label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 11px;
            font-weight: 800;
        }


        .required {
            color: #ef4444;
        }


        .input-wrap {
            position: relative;
        }


        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px;
            height: 16px;
            color: #94a3b8;
            pointer-events: none;
        }


        .input-icon-top {
            top: 17px;
            transform: none;
        }


        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #ffffff;
            color: #334155;
            font-size: 12px;
            font-weight: 600;
            outline: none;
            transition: .2s ease;
        }


        .form-input,
        .form-select {
            height: 45px;
            padding: 0 13px;
        }


        .form-input.with-icon,
        .form-select.with-icon {
            padding-left: 40px;
        }


        .form-textarea {
            min-height: 145px;
            padding: 13px;
            resize: vertical;
            line-height: 1.7;
        }


        .form-textarea.with-icon {
            padding-left: 40px;
        }


        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #cbd5e1;
            font-weight: 500;
        }


        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
        }


        .field-help {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.6;
            font-weight: 500;
        }


        .field-error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 10px;
            line-height: 1.5;
            font-weight: 600;
        }


        /* =====================================================
           MEETING SELECT
        ===================================================== */

        .meeting-select-area {
            padding: 16px;
            border-radius: 14px;
            border: 1px solid #dbeafe;
            background: #f8fbff;
        }


        .meeting-selected-info {
            display: none;
            align-items: center;
            gap: 11px;
            margin-top: 12px;
            padding: 11px 12px;
            border-radius: 11px;
            background: #eff6ff;
            border: 1px solid #dbeafe;
        }


        .meeting-selected-info.show {
            display: flex;
        }


        .meeting-selected-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            background: #2563eb;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }


        .meeting-selected-text {
            min-width: 0;
        }


        .meeting-selected-text strong {
            display: block;
            color: #1e3a8a;
            font-size: 11px;
            font-weight: 800;
        }


        .meeting-selected-text span {
            display: block;
            margin-top: 2px;
            color: #64748b;
            font-size: 9px;
            font-weight: 600;
        }


        /* =====================================================
           MODE PENGUMPULAN
        ===================================================== */

        .mode-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }


        .mode-option {
            position: relative;
        }


        .mode-option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }


        .mode-label {
            min-height: 108px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            cursor: pointer;
            transition: .2s ease;
        }


        .mode-label:hover {
            border-color: #bfdbfe;
            background: #f8fbff;
        }


        .mode-option input:checked + .mode-label {
            border-color: #60a5fa;
            background: #eff6ff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .08);
        }


        .mode-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 9px;
        }


        .mode-icon-individual {
            background: #eff6ff;
            color: #2563eb;
        }


        .mode-icon-group {
            background: #f5f3ff;
            color: #7c3aed;
        }


        .mode-title {
            color: #334155;
            font-size: 11px;
            font-weight: 800;
        }


        .mode-description {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 9px;
            line-height: 1.5;
            font-weight: 500;
        }


        /* =====================================================
           DEADLINE
        ===================================================== */

        .deadline-box {
            padding: 15px;
            border-radius: 13px;
            background: #fffbeb;
            border: 1px solid #fde68a;
        }


        .deadline-title {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 9px;
            color: #92400e;
            font-size: 10px;
            font-weight: 800;
        }


        .deadline-title svg {
            width: 14px;
            height: 14px;
        }


        /* =====================================================
           ACTIVE SWITCH
        ===================================================== */

        .active-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px;
            border-radius: 13px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }


        .active-info {
            min-width: 0;
        }


        .active-title {
            color: #334155;
            font-size: 11px;
            font-weight: 800;
        }


        .active-description {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 9px;
            line-height: 1.5;
            font-weight: 500;
        }


        .switch {
            position: relative;
            width: 43px;
            height: 24px;
            flex-shrink: 0;
        }


        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }


        .switch-slider {
            position: absolute;
            inset: 0;
            background: #cbd5e1;
            border-radius: 999px;
            cursor: pointer;
            transition: .2s ease;
        }


        .switch-slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            top: 3px;
            background: #ffffff;
            border-radius: 50%;
            transition: .2s ease;
            box-shadow: 0 1px 3px rgba(15, 23, 42, .15);
        }


        .switch input:checked + .switch-slider {
            background: #2563eb;
        }


        .switch input:checked + .switch-slider::before {
            transform: translateX(19px);
        }


        /* =====================================================
           FOOTER ACTION
        ===================================================== */

        .form-footer {
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }


        .footer-note {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
            font-weight: 600;
        }


        .footer-note svg {
            width: 14px;
            height: 14px;
            flex-shrink: 0;
        }


        .footer-actions {
            display: flex;
            align-items: center;
            gap: 9px;
        }


        .button {
            min-height: 42px;
            border: 0;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 17px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 800;
            transition: .2s ease;
        }


        .button-primary {
            background: #2563eb;
            color: #ffffff;
            box-shadow: 0 2px 5px rgba(37, 99, 235, .18);
        }


        .button-primary:hover {
            background: #1d4ed8;
            box-shadow: 0 4px 10px rgba(37, 99, 235, .20);
            transform: translateY(-1px);
        }


        .button-secondary {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            color: #64748b;
        }


        .button-secondary:hover {
            background: #f8fafc;
            color: #334155;
        }


        /* =====================================================
           INFO CARD
        ===================================================== */

        .info-card {
            margin-top: 18px;
            padding: 15px 17px;
            border: 1px solid #dbeafe;
            background: #eff6ff;
            border-radius: 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }


        .info-card-icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #2563eb;
            margin-top: 1px;
        }


        .info-card p {
            margin: 0;
            color: #1d4ed8;
            font-size: 10px;
            line-height: 1.65;
            font-weight: 600;
        }


        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 1100px) {

            .assignment-main {
                width: calc(100% - 220px);
                margin-left: 220px;
            }

            .assignment-content {
                max-width: 100%;
                padding-left: 24px;
                padding-right: 24px;
            }

        }


        @media (max-width: 760px) {

            .assignment-main {
                width: 100%;
                margin-left: 0;
            }

            .assignment-content {
                padding: 22px 18px 40px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .form-footer {
                align-items: flex-start;
                flex-direction: column;
            }

            .footer-actions {
                width: 100%;
            }

            .footer-actions .button {
                flex: 1;
            }

        }


        @media (max-width: 520px) {

            .assignment-content {
                padding: 18px 14px 35px;
            }

            .page-title {
                font-size: 23px;
            }

            .form-card-header,
            .form-body {
                padding: 17px;
            }

            .mode-grid {
                grid-template-columns: 1fr;
            }

            .mode-label {
                min-height: 92px;
            }

            .footer-actions {
                flex-direction: column;
                width: 100%;
            }

            .footer-actions .button {
                width: 100%;
            }

        }


        /* =====================================================
           DASHBOARD GURU — SIDEBAR & HEADER COMPATIBILITY
        ===================================================== */

        .assignment-page {
            min-height: 100vh;
            background: #f8fafc;
        }

        .assignment-main {
            min-width: 0;
            overflow-x: hidden;
        }

        .assignment-content {
            min-width: 0;
        }

        /* shared sidebar should keep its own width/behavior */
        .assignment-page > aside,
        .assignment-page .sidebar {
            flex-shrink: 0;
        }

        /* Prevent page content from sitting underneath the Guru sidebar. */
        @media (min-width: 1101px) {
            .assignment-main {
                width: calc(100% - 240px);
                margin-left: 240px;
            }
        }

        @media (max-width: 1024px) {
            .assignment-content {
                padding: 24px;
            }
        }

        @media (max-width: 640px) {
            .assignment-content {
                padding: 18px 14px 35px;
            }
        }

    </style>

</head>


<body>

<div class="assignment-page">


    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="assignment-main">


        {{-- =================================================
             HEADER GURU
        ================================================== --}}

        @include('guru.partials.header')


        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="assignment-content">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="page-header">

                <a
                    href="{{ route('guru.assignments.index') }}"
                    class="back-link"
                >

                    <i
                        data-lucide="arrow-left"
                        width="15"
                        height="15"
                    ></i>

                    Kembali ke Tugas

                </a>


                <div class="page-kicker">

                    <i
                        data-lucide="clipboard-plus"
                        width="13"
                        height="13"
                    ></i>

                    TUGAS PENGUMPULAN

                </div>


                <h1 class="page-title">
                    Tambah Tugas
                </h1>


                <p class="page-description">
                    Buat tugas pengumpulan berdasarkan kelas dan
                    pertemuan yang sudah dibuat sebelumnya.
                </p>

            </section>



            {{-- =================================================
                 ERRORS
            ================================================== --}}

            @if($errors->any())

                <div class="alert alert-error">

                    <i
                        data-lucide="alert-circle"
                        class="alert-icon"
                    ></i>

                    <div>

                        <strong>
                            Data belum dapat disimpan.
                        </strong>

                        <ul
                            style="
                                margin:6px 0 0;
                                padding-left:17px;
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

            @endif



            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('guru.assignments.store') }}"
                id="assignmentForm"
            >

                @csrf


                <div class="form-card">


                    {{-- =================================================
                         HEADER CARD
                    ================================================== --}}

                    <div class="form-card-header">

                        <div class="header-icon">

                            <i
                                data-lucide="clipboard-list"
                                width="19"
                                height="19"
                            ></i>

                        </div>


                        <div>

                            <h2>
                                Informasi Tugas
                            </h2>

                            <p>
                                Lengkapi informasi tugas yang akan diberikan
                                kepada siswa.
                            </p>

                        </div>

                    </div>



                    {{-- =================================================
                         BODY
                    ================================================== --}}

                    <div class="form-body">

                        <div class="form-grid">


                            {{-- =================================================
                                 KELAS
                            ================================================== --}}

                            <div class="field">

                                <label
                                    for="kelas"
                                    class="field-label"
                                >

                                    Kelas
                                    <span class="required">*</span>

                                </label>


                                <div class="meeting-select-area">

                                    <div class="input-wrap">

                                        <i
                                            data-lucide="school"
                                            class="input-icon"
                                        ></i>


                                        <select
                                            name="kelas"
                                            id="kelas"
                                            class="form-select with-icon"
                                            required
                                        >

                                            <option value="">
                                                Pilih kelas terlebih dahulu
                                            </option>

                                            @foreach($classes as $class)

                                                <option
                                                    value="{{ $class->nama }}"
                                                    @selected(
                                                        old('kelas', $kelas ?? '') ===
                                                        $class->nama
                                                    )
                                                >

                                                    {{ $class->nama }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    <div class="field-help">

                                        Pertemuan yang tersedia akan
                                        mengikuti kelas yang dipilih.

                                    </div>

                                </div>


                                @error('kelas')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 PERTEMUAN
                            ================================================== --}}

                            <div class="field">

                                <label
                                    for="assignment_meeting_id"
                                    class="field-label"
                                >

                                    Pertemuan
                                    <span class="required">*</span>

                                </label>


                                <div class="meeting-select-area">

                                    <div class="input-wrap">

                                        <i
                                            data-lucide="calendar-days"
                                            class="input-icon"
                                        ></i>


                                        <select
                                            name="assignment_meeting_id"
                                            id="assignment_meeting_id"
                                            class="form-select with-icon"
                                            required
                                            disabled
                                        >

                                            <option value="">
                                                Pilih kelas terlebih dahulu
                                            </option>

                                            @foreach($assignmentMeetings as $meeting)

                                                <option
                                                    value="{{ $meeting->id }}"
                                                    data-kelas="{{ $meeting->kelas }}"
                                                    data-pertemuan="{{ $meeting->pertemuan }}"
                                                    @selected(
                                                        (string) old(
                                                            'assignment_meeting_id'
                                                        ) ===
                                                        (string) $meeting->id
                                                    )
                                                >

                                                    Pertemuan
                                                    {{ $meeting->pertemuan }}

                                                </option>

                                            @endforeach

                                        </select>

                                    </div>


                                    <div
                                        class="field-help"
                                        id="meetingHelp"
                                    >
                                        Pilih kelas untuk melihat
                                        pertemuan yang tersedia.
                                    </div>


                                    <div
                                        class="meeting-selected-info"
                                        id="meetingSelectedInfo"
                                    >

                                        <div class="meeting-selected-icon">

                                            <i
                                                data-lucide="calendar-check"
                                                width="16"
                                                height="16"
                                            ></i>

                                        </div>


                                        <div class="meeting-selected-text">

                                            <strong id="meetingSelectedTitle">
                                                Pertemuan
                                            </strong>

                                            <span id="meetingSelectedClass">
                                                —
                                            </span>

                                        </div>

                                    </div>

                                </div>


                                @error('assignment_meeting_id')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 JUDUL
                            ================================================== --}}

                            <div class="field full-width">

                                <label
                                    for="judul"
                                    class="field-label"
                                >

                                    Judul Tugas
                                    <span class="required">*</span>

                                </label>


                                <div class="input-wrap">

                                    <i
                                        data-lucide="file-text"
                                        class="input-icon"
                                    ></i>


                                    <input
                                        type="text"
                                        name="judul"
                                        id="judul"
                                        class="form-input with-icon"
                                        value="{{ old('judul') }}"
                                        maxlength="255"
                                        required
                                        placeholder="Contoh: Praktik Musik Tradisional"
                                    >

                                </div>


                                <div class="field-help">
                                    Gunakan judul yang singkat dan mudah
                                    dipahami siswa.
                                </div>


                                @error('judul')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 INSTRUKSI
                            ================================================== --}}

                            <div class="field full-width">

                                <label
                                    for="instruksi"
                                    class="field-label"
                                >

                                    Instruksi Tugas

                                </label>


                                <div class="input-wrap">

                                    <i
                                        data-lucide="align-left"
                                        class="input-icon input-icon-top"
                                    ></i>


                                    <textarea
                                        name="instruksi"
                                        id="instruksi"
                                        class="form-textarea with-icon"
                                        maxlength="10000"
                                        placeholder="Tuliskan petunjuk, ketentuan, langkah pengerjaan, atau informasi lain untuk siswa..."
                                    >{{ old('instruksi') }}</textarea>

                                </div>


                                <div class="field-help">
                                    Instruksi dapat menjelaskan apa yang harus
                                    dikerjakan dan apa yang harus dikumpulkan.
                                </div>


                                @error('instruksi')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 MODE PENGUMPULAN
                            ================================================== --}}

                            <div class="field">

                                <label class="field-label">

                                    Mode Pengumpulan
                                    <span class="required">*</span>

                                </label>


                                <div class="mode-grid">


                                    {{-- INDIVIDU --}}

                                    <div class="mode-option">

                                        <input
                                            type="radio"
                                            name="mode_pengumpulan"
                                            id="mode_individu"
                                            value="individu"
                                            @checked(
                                                old(
                                                    'mode_pengumpulan',
                                                    'individu'
                                                ) === 'individu'
                                            )
                                        >


                                        <label
                                            for="mode_individu"
                                            class="mode-label"
                                        >

                                            <div
                                                class="
                                                    mode-icon
                                                    mode-icon-individual
                                                "
                                            >

                                                <i
                                                    data-lucide="user"
                                                    width="17"
                                                    height="17"
                                                ></i>

                                            </div>


                                            <div class="mode-title">
                                                Individu
                                            </div>


                                            <div class="mode-description">
                                                Setiap siswa mengumpulkan
                                                tugas sendiri.
                                            </div>

                                        </label>

                                    </div>



                                    {{-- KELOMPOK --}}

                                    <div class="mode-option">

                                        <input
                                            type="radio"
                                            name="mode_pengumpulan"
                                            id="mode_kelompok"
                                            value="kelompok"
                                            @checked(
                                                old(
                                                    'mode_pengumpulan'
                                                ) === 'kelompok'
                                            )
                                        >


                                        <label
                                            for="mode_kelompok"
                                            class="mode-label"
                                        >

                                            <div
                                                class="
                                                    mode-icon
                                                    mode-icon-group
                                                "
                                            >

                                                <i
                                                    data-lucide="users"
                                                    width="17"
                                                    height="17"
                                                ></i>

                                            </div>


                                            <div class="mode-title">
                                                Kelompok
                                            </div>


                                            <div class="mode-description">
                                                Satu tugas dikumpulkan
                                                mewakili satu kelompok.
                                            </div>

                                        </label>

                                    </div>

                                </div>


                                @error('mode_pengumpulan')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 DEADLINE
                            ================================================== --}}

                            <div class="field">

                                <label
                                    for="batas_waktu"
                                    class="field-label"
                                >

                                    Tenggang Waktu

                                </label>


                                <div class="deadline-box">

                                    <div class="deadline-title">

                                        <i
                                            data-lucide="clock-3"
                                        ></i>

                                        Batas pengumpulan

                                    </div>


                                    <input
                                        type="datetime-local"
                                        name="batas_waktu"
                                        id="batas_waktu"
                                        class="form-input"
                                        value="{{ old('batas_waktu') }}"
                                    >


                                    <div class="field-help">
                                        Jika sudah melewati waktu ini,
                                        siswa tidak dapat mengirim tugas.
                                    </div>

                                </div>


                                @error('batas_waktu')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- =================================================
                                 AKTIF
                            ================================================== --}}

                            <div class="field full-width">

                                <div class="active-box">

                                    <div class="active-info">

                                        <div class="active-title">
                                            Tugas langsung aktif
                                        </div>


                                        <div class="active-description">
                                            Jika aktif, tugas dapat langsung
                                            dilihat dan dikerjakan oleh siswa.
                                        </div>

                                    </div>


                                    <label class="switch">

                                        <input
                                            type="checkbox"
                                            name="aktif"
                                            value="1"
                                            @checked(
                                                old(
                                                    'aktif',
                                                    true
                                                )
                                            )
                                        >

                                        <span
                                            class="switch-slider"
                                        ></span>

                                    </label>

                                </div>

                            </div>

                        </div>



                        {{-- =================================================
                             INFO
                        ================================================== --}}

                        <div class="info-card">

                            <i
                                data-lucide="info"
                                class="info-card-icon"
                            ></i>


                            <p>
                                Untuk tugas kelompok, kelompok dan anggota
                                siswa akan dikelola setelah tugas dibuat.
                                Guru dapat menambahkan kelompok serta anggota
                                berdasarkan database siswa pada kelas tugas.
                            </p>

                        </div>



                        {{-- =================================================
                             FOOTER
                        ================================================== --}}

                        <div class="form-footer">

                            <div class="footer-note">

                                <i
                                    data-lucide="shield-check"
                                ></i>

                                Data tugas tersimpan di sistem Guru.

                            </div>


                            <div class="footer-actions">

                                <a
                                    href="{{ route('guru.assignments.index') }}"
                                    class="button button-secondary"
                                >

                                    <i
                                        data-lucide="x"
                                        width="14"
                                        height="14"
                                    ></i>

                                    Batal

                                </a>


                                <button
                                    type="submit"
                                    class="button button-primary"
                                    id="submitButton"
                                >

                                    <i
                                        data-lucide="save"
                                        width="14"
                                        height="14"
                                    ></i>

                                    Simpan Tugas

                                </button>

                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </main>

</div>



{{-- =========================================================
     JAVASCRIPT
========================================================== --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            if (
                typeof lucide !== 'undefined'
            ) {

                lucide.createIcons();

            }


            const kelasSelect =
                document.getElementById('kelas');


            const meetingSelect =
                document.getElementById(
                    'assignment_meeting_id'
                );


            const meetingHelp =
                document.getElementById(
                    'meetingHelp'
                );


            const selectedInfo =
                document.getElementById(
                    'meetingSelectedInfo'
                );


            const selectedTitle =
                document.getElementById(
                    'meetingSelectedTitle'
                );


            const selectedClass =
                document.getElementById(
                    'meetingSelectedClass'
                );


            const form =
                document.getElementById(
                    'assignmentForm'
                );


            const submitButton =
                document.getElementById(
                    'submitButton'
                );


            if (
                !kelasSelect ||
                !meetingSelect
            ) {

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Simpan semua option pertemuan
            |--------------------------------------------------------------------------
            */

            const meetingOptions =
                Array.from(
                    meetingSelect.querySelectorAll(
                        'option[data-kelas]'
                    )
                ).map(
                    function (option) {

                        return {
                            value: option.value,
                            kelas: option.dataset.kelas,
                            pertemuan: option.dataset.pertemuan,
                            text: option.textContent.trim()
                        };

                    }
                );


            /*
            |--------------------------------------------------------------------------
            | Nilai lama
            |--------------------------------------------------------------------------
            */

            const oldMeetingId =
                @json(
                    old(
                        'assignment_meeting_id'
                    )
                );


            /*
            |--------------------------------------------------------------------------
            | Render pertemuan berdasarkan kelas
            |--------------------------------------------------------------------------
            */

            function renderMeetings(
                selectedId = ''
            ) {

                const selectedClassName =
                    kelasSelect.value;


                meetingSelect.innerHTML = '';


                if (
                    selectedClassName === ''
                ) {

                    const option =
                        document.createElement(
                            'option'
                        );

                    option.value = '';

                    option.textContent =
                        'Pilih kelas terlebih dahulu';

                    meetingSelect.appendChild(
                        option
                    );

                    meetingSelect.disabled =
                        true;

                    meetingHelp.textContent =
                        'Pilih kelas untuk melihat pertemuan yang tersedia.';

                    selectedInfo.classList.remove(
                        'show'
                    );

                    return;

                }


                const filtered =
                    meetingOptions.filter(
                        function (item) {

                            return (
                                item.kelas ===
                                selectedClassName
                            );

                        }
                    );


                const placeholder =
                    document.createElement(
                        'option'
                    );


                placeholder.value = '';


                if (
                    filtered.length > 0
                ) {

                    placeholder.textContent =
                        'Pilih pertemuan';

                    meetingSelect.disabled =
                        false;

                } else {

                    placeholder.textContent =
                        'Belum ada pertemuan untuk kelas ini';

                    meetingSelect.disabled =
                        true;

                }


                meetingSelect.appendChild(
                    placeholder
                );


                filtered.forEach(
                    function (item) {

                        const option =
                            document.createElement(
                                'option'
                            );


                        option.value =
                            item.value;


                        option.textContent =
                            'Pertemuan ' +
                            item.pertemuan;


                        option.dataset.pertemuan =
                            item.pertemuan;


                        option.dataset.kelas =
                            item.kelas;


                        if (
                            String(
                                selectedId
                            ) ===
                            String(
                                item.value
                            )
                        ) {

                            option.selected =
                                true;

                        }


                        meetingSelect.appendChild(
                            option
                        );

                    }
                );


                if (
                    filtered.length > 0
                ) {

                    meetingHelp.textContent =
                        filtered.length +
                        ' pertemuan tersedia untuk kelas ' +
                        selectedClassName +
                        '.';

                } else {

                    meetingHelp.textContent =
                        'Belum ada pertemuan. Buat pertemuan terlebih dahulu di halaman Kelola Pertemuan.';

                }


                updateSelectedMeeting();

            }


            /*
            |--------------------------------------------------------------------------
            | Update informasi pertemuan
            |--------------------------------------------------------------------------
            */

            function updateSelectedMeeting() {

                const selectedOption =
                    meetingSelect.options[
                        meetingSelect.selectedIndex
                    ];


                if (
                    !selectedOption ||
                    !selectedOption.value
                ) {

                    selectedInfo.classList.remove(
                        'show'
                    );

                    return;

                }


                selectedTitle.textContent =
                    'Pertemuan ' +
                    selectedOption.dataset.pertemuan;


                selectedClass.textContent =
                    'Kelas ' +
                    selectedOption.dataset.kelas;


                selectedInfo.classList.add(
                    'show'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Saat kelas berubah
            |--------------------------------------------------------------------------
            */

            kelasSelect.addEventListener(
                'change',
                function () {

                    renderMeetings('');

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Saat pertemuan berubah
            |--------------------------------------------------------------------------
            */

            meetingSelect.addEventListener(
                'change',
                function () {

                    updateSelectedMeeting();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Submit protection
            |--------------------------------------------------------------------------
            */

            if (
                form &&
                submitButton
            ) {

                form.addEventListener(
                    'submit',
                    function () {

                        submitButton.disabled =
                            true;

                        submitButton.style.opacity =
                            '.65';

                        submitButton.style.cursor =
                            'not-allowed';

                        submitButton.innerHTML = `
                            <i
                                data-lucide="loader-circle"
                                width="14"
                                height="14"
                                style="animation: spin 1s linear infinite;"
                            ></i>
                            Menyimpan...
                        `;


                        if (
                            typeof lucide !==
                            'undefined'
                        ) {

                            lucide.createIcons();

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Initial render
            |--------------------------------------------------------------------------
            */

            renderMeetings(
                oldMeetingId || ''
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Spinner
    |--------------------------------------------------------------------------
    */

    const spinnerStyle =
        document.createElement(
            'style'
        );


    spinnerStyle.textContent = `
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    `;


    document.head.appendChild(
        spinnerStyle
    );

</script>

</body>

</html>