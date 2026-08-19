{{-- resources/views/guru/assignments/edit.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Edit Tugas — Guru
    </title>


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

        :root {
            --bg: #f6f8fc;
            --surface: #ffffff;
            --surface-soft: #f8fafc;
            --border: #e5eaf1;
            --border-strong: #d8e0eb;
            --text: #0f172a;
            --text-soft: #475569;
            --muted: #94a3b8;

            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-soft: #eef2ff;

            --success: #059669;
            --success-soft: #ecfdf5;

            --danger: #dc2626;
            --danger-soft: #fef2f2;

            --shadow-sm:
                0 2px 10px rgba(15, 23, 42, .035);

            --shadow-md:
                0 12px 35px rgba(15, 23, 42, .055);
        }


        * {
            box-sizing: border-box;
        }


        html {
            scroll-behavior: smooth;
        }


        body {
            margin: 0;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;

            color: var(--text);

            background:
                radial-gradient(
                    circle at top right,
                    rgba(99, 102, 241, .035),
                    transparent 30%
                ),
                var(--bg);

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            -webkit-font-smoothing: antialiased;
        }


        button,
        input,
        select,
        textarea {
            font: inherit;
        }


        a {
            color: inherit;
            text-decoration: none;
        }


        button {
            -webkit-tap-highlight-color: transparent;
        }


        /*
        |--------------------------------------------------------------------------
        | MAIN
        |--------------------------------------------------------------------------
        */

        .assignment-main {
            width: calc(100% - 256px);
            min-height: 100vh;
            margin-left: 256px;
            min-width: 0;
            overflow-x: hidden;
        }

        /* Sidebar is a fixed/shared component and must not inherit the
           main-content offset. */
        .assignment-main > .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 256px;
            height: 100vh;
            z-index: 1000;
        }

        .assignment-main > aside {
            flex-shrink: 0;
        }


        .assignment-content {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 30px 32px 60px;
            min-width: 0;
        }


        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        .page-header {
            margin-bottom: 22px;
        }


        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 15px;

            color: var(--text-soft);

            font-size: 12px;
            font-weight: 750;

            transition:
                color .18s ease,
                transform .18s ease;
        }


        .back-link:hover {
            color: var(--primary);
            transform: translateX(-2px);
        }


        .page-title-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;

            gap: 20px;
        }


        .page-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            margin-bottom: 9px;
            padding: 7px 10px;

            border: 1px solid #e0e7ff;
            border-radius: 999px;

            color: var(--primary);

            background: var(--primary-soft);

            font-size: 9px;
            font-weight: 850;

            letter-spacing: .06em;
            text-transform: uppercase;
        }


        .kicker-dot {
            width: 6px;
            height: 6px;

            border-radius: 50%;

            background: currentColor;
        }


        .page-title {
            margin: 0;

            color: var(--text);

            font-size: 28px;
            font-weight: 900;

            letter-spacing: -.035em;
            line-height: 1.15;
        }


        .page-description {
            max-width: 700px;

            margin: 8px 0 0;

            color: var(--text-soft);

            font-size: 13px;
            font-weight: 500;

            line-height: 1.65;
        }


        /*
        |--------------------------------------------------------------------------
        | ALERT
        |--------------------------------------------------------------------------
        */

        .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;

            margin-bottom: 18px;
            padding: 13px 15px;

            border-radius: 13px;

            font-size: 12px;
            font-weight: 650;

            line-height: 1.55;
        }


        .alert-success {
            color: #047857;
            background: var(--success-soft);
            border: 1px solid #bbf7d0;
        }


        .alert-error {
            color: #b91c1c;
            background: var(--danger-soft);
            border: 1px solid #fecaca;
        }


        .alert-icon {
            width: 17px;
            height: 17px;

            flex: 0 0 auto;

            margin-top: 1px;
        }


        /*
        |--------------------------------------------------------------------------
        | LAYOUT
        |--------------------------------------------------------------------------
        */

        .form-layout {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                300px;

            gap: 18px;

            align-items: start;
        }


        .main-column,
        .side-column {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }


        /*
        |--------------------------------------------------------------------------
        | CARD
        |--------------------------------------------------------------------------
        */

        .card {
            overflow: hidden;

            border: 1px solid var(--border);
            border-radius: 17px;

            background: var(--surface);

            box-shadow: var(--shadow-sm);
        }


        .card-header {
            padding: 17px 19px;

            border-bottom: 1px solid #eef2f7;
        }


        .card-heading {
            display: flex;
            align-items: center;
            gap: 11px;
        }


        .card-icon {
            width: 38px;
            height: 38px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex: 0 0 auto;

            border-radius: 11px;
        }


        .card-icon-primary {
            color: var(--primary);
            background: var(--primary-soft);
        }


        .card-icon-green {
            color: var(--success);
            background: var(--success-soft);
        }


        .card-heading h2 {
            margin: 0;

            color: var(--text);

            font-size: 14px;
            font-weight: 850;
        }


        .card-heading p {
            margin: 3px 0 0;

            color: var(--muted);

            font-size: 10px;
            font-weight: 550;

            line-height: 1.45;
        }


        .card-body {
            padding: 19px;
        }


        /*
        |--------------------------------------------------------------------------
        | FORM
        |--------------------------------------------------------------------------
        */

        .form-grid {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 16px;
        }


        .form-group {
            min-width: 0;
        }


        .form-group.full {
            grid-column: 1 / -1;
        }


        .form-label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 11px;
            font-weight: 800;
        }


        .required {
            color: #ef4444;
        }


        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;

            border: 1px solid var(--border-strong);
            border-radius: 10px;

            outline: none;

            color: #334155;
            background: #fff;

            font-size: 12px;
            font-weight: 600;

            transition:
                border-color .18s ease,
                box-shadow .18s ease,
                background .18s ease;
        }


        .form-input,
        .form-select {
            height: 43px;
            padding: 0 12px;
        }


        .form-textarea {
            min-height: 170px;

            padding: 12px;

            resize: vertical;

            line-height: 1.65;
        }


        .form-input::placeholder,
        .form-textarea::placeholder {
            color: #cbd5e1;
        }


        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: #818cf8;

            box-shadow:
                0 0 0 3px
                rgba(99, 102, 241, .10);
        }


        .form-input:disabled,
        .form-select:disabled {
            color: #64748b;
            background: #f8fafc;
            cursor: not-allowed;
        }


        .field-help {
            margin-top: 6px;

            color: var(--muted);

            font-size: 10px;
            font-weight: 500;

            line-height: 1.5;
        }


        .field-error {
            margin-top: 6px;

            color: var(--danger);

            font-size: 10px;
            font-weight: 650;
        }


        .input-error {
            border-color: #fca5a5 !important;
        }


        /*
        |--------------------------------------------------------------------------
        | INSTRUCTION
        |--------------------------------------------------------------------------
        */

        .instruction-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            margin-bottom: 8px;

            color: var(--muted);

            font-size: 9px;
            font-weight: 650;
        }


        .instruction-counter {
            font-variant-numeric: tabular-nums;
        }


        /*
        |--------------------------------------------------------------------------
        | MODE
        |--------------------------------------------------------------------------
        */

        .mode-options {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 10px;
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
            min-height: 90px;

            display: flex;
            align-items: flex-start;
            gap: 10px;

            padding: 13px;

            border: 1px solid var(--border-strong);
            border-radius: 12px;

            cursor: pointer;

            transition:
                border-color .18s ease,
                background .18s ease,
                box-shadow .18s ease;
        }


        .mode-label:hover {
            border-color: #c7d2fe;
            background: #fafbff;
        }


        .mode-option input:checked + .mode-label {
            border-color: #818cf8;
            background: var(--primary-soft);

            box-shadow:
                0 0 0 3px
                rgba(99, 102, 241, .08);
        }


        .mode-radio {
            width: 17px;
            height: 17px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex: 0 0 auto;

            margin-top: 1px;

            border: 1.5px solid #cbd5e1;
            border-radius: 50%;
        }


        .mode-option input:checked
        + .mode-label
        .mode-radio {
            border-color: var(--primary);
        }


        .mode-option input:checked
        + .mode-label
        .mode-radio::after {
            content: "";

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--primary);
        }


        .mode-title {
            color: #334155;

            font-size: 11px;
            font-weight: 850;
        }


        .mode-description {
            margin-top: 4px;

            color: var(--muted);

            font-size: 9px;
            font-weight: 500;

            line-height: 1.5;
        }


        /*
        |--------------------------------------------------------------------------
        | SIDE INFO
        |--------------------------------------------------------------------------
        */

        .assignment-preview {
            padding: 15px;

            border: 1px solid #e0e7ff;
            border-radius: 13px;

            background:
                linear-gradient(
                    135deg,
                    #f8faff,
                    #eef2ff
                );
        }


        .preview-label {
            margin-bottom: 8px;

            color: #6366f1;

            font-size: 9px;
            font-weight: 850;

            letter-spacing: .06em;
            text-transform: uppercase;
        }


        .preview-title {
            margin: 0;

            color: #1e1b4b;

            font-size: 13px;
            font-weight: 850;

            line-height: 1.45;

            word-break: break-word;
        }


        .preview-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;

            margin-top: 10px;
        }


        .preview-badge {
            display: inline-flex;
            align-items: center;

            padding: 5px 7px;

            border-radius: 7px;

            color: #475569;
            background: rgba(255,255,255,.72);

            font-size: 8px;
            font-weight: 800;
        }


        .detail-list {
            display: flex;
            flex-direction: column;
        }


        .detail-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 14px;

            padding: 11px 0;

            border-bottom: 1px solid #f1f5f9;
        }


        .detail-row:first-child {
            padding-top: 0;
        }


        .detail-row:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }


        .detail-label {
            color: var(--muted);

            font-size: 10px;
            font-weight: 650;
        }


        .detail-value {
            max-width: 170px;

            color: #334155;

            font-size: 10px;
            font-weight: 800;

            text-align: right;
            word-break: break-word;
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        .status-card {
            padding: 14px;

            border-radius: 12px;

            background: var(--surface-soft);
        }


        .status-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 10px;
        }


        .status-label {
            color: var(--text-soft);

            font-size: 10px;
            font-weight: 750;
        }


        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;

            padding: 6px 8px;

            border-radius: 999px;

            font-size: 8px;
            font-weight: 850;
        }


        .status-active {
            color: #047857;
            background: var(--success-soft);
        }


        .status-inactive {
            color: #64748b;
            background: #f1f5f9;
        }


        .status-dot {
            width: 5px;
            height: 5px;

            border-radius: 50%;

            background: currentColor;
        }


        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        */

        .action-buttons {
            display: flex;
            flex-direction: column;

            gap: 8px;
        }


        .button {
            min-height: 41px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            padding: 0 13px;

            border: 1px solid transparent;
            border-radius: 10px;

            cursor: pointer;

            font-size: 10px;
            font-weight: 850;

            line-height: 1;

            transition:
                transform .16s ease,
                background .16s ease,
                border-color .16s ease,
                box-shadow .16s ease;
        }


        .button:hover {
            transform: translateY(-1px);
        }


        .button-primary {
            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #6366f1
                );

            box-shadow:
                0 7px 16px
                rgba(79, 70, 229, .16);
        }


        .button-primary:hover {
            background:
                linear-gradient(
                    135deg,
                    #4338ca,
                    #4f46e5
                );

            box-shadow:
                0 9px 20px
                rgba(79, 70, 229, .21);
        }


        .button-secondary {
            color: #475569;
            background: #fff;

            border-color: var(--border-strong);
        }


        .button-secondary:hover {
            color: var(--primary-dark);
            background: #f8faff;
            border-color: #c7d2fe;
        }


        /*
        |--------------------------------------------------------------------------
        | DANGER / DELETE
        |--------------------------------------------------------------------------
        */

        .delete-box {
            padding: 14px;

            border: 1px solid #fee2e2;
            border-radius: 12px;

            background: #fffafa;
        }


        .delete-title {
            margin: 0;

            color: #991b1b;

            font-size: 11px;
            font-weight: 850;
        }


        .delete-description {
            margin: 5px 0 12px;

            color: #b91c1c;

            font-size: 9px;
            font-weight: 550;

            line-height: 1.55;
        }


        .button-delete {
            width: 100%;

            color: #dc2626;
            background: #fff;

            border-color: #fecaca;
        }


        .button-delete:hover {
            background: var(--danger-soft);
            border-color: #fca5a5;
        }


        /*
        |--------------------------------------------------------------------------
        | MOBILE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 1100px) {

            .assignment-main {
                width: calc(100% - 220px);
                margin-left: 220px;
            }

            .assignment-main > .sidebar {
                width: 220px;
            }

            .form-layout {
                grid-template-columns: 1fr;
            }

            .side-column {
                display: grid;

                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                align-items: start;
            }

        }


        @media (max-width: 760px) {

            .assignment-main {
                width: 100%;
                margin-left: 0;
            }

            .assignment-main > .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }

            .assignment-content {
                padding: 22px 18px 45px;
            }

            .page-title {
                font-size: 24px;
            }

            .page-title-row {
                align-items: flex-start;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }

            .side-column {
                display: flex;
            }

        }


        @media (max-width: 520px) {

            .assignment-content {
                padding: 18px 13px 35px;
            }

            .page-title {
                font-size: 22px;
            }

            .page-description {
                font-size: 12px;
            }

            .card-header,
            .card-body {
                padding: 15px;
            }

            .mode-options {
                grid-template-columns: 1fr;
            }

            .page-title-row {
                flex-direction: column;
            }

        }

    </style>


</head>


<body>


<div class="assignment-main">


    {{-- ============================================================
         SIDEBAR
    ============================================================= --}}

    @include('guru.partials.sidebar')

     {{-- =================================================
             HEADBAR GURU
        ================================================== --}}

        @include('guru.partials.header')


    {{-- ============================================================
         CONTENT
    ============================================================= --}}

    <main class="assignment-content">


        {{-- HEADER --}}

        <header class="page-header">


            <a
                href="{{ route(
                    'guru.assignments.show',
                    $assignment
                ) }}"
                class="back-link"
            >

                <span>←</span>

                Kembali ke Detail Tugas

            </a>


            <div class="page-title-row">


                <div>

                    <div class="page-kicker">

                        <span class="kicker-dot"></span>

                        Guru · Tugas

                    </div>


                    <h1 class="page-title">
                        Edit Tugas
                    </h1>


                    <p class="page-description">

                        Perbarui informasi tugas tanpa membuat
                        tugas baru. Data pengumpulan yang sudah ada
                        tetap tersimpan.

                    </p>

                </div>


            </div>

        </header>


        {{-- ========================================================
             FLASH SUCCESS
        ========================================================= --}}

        @if(session('success'))

            <div class="alert alert-success">

                <svg
                    class="alert-icon"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <path
                        d="M20 6 9 17l-5-5"
                    />

                </svg>


                <div>

                    {{ session('success') }}

                </div>

            </div>

        @endif


        {{-- ========================================================
             VALIDATION ERROR
        ========================================================= --}}

        @if($errors->any())

            <div class="alert alert-error">

                <svg
                    class="alert-icon"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >

                    <circle
                        cx="12"
                        cy="12"
                        r="9"
                    />

                    <path
                        d="M12 8v4"
                    />

                    <path
                        d="M12 16h.01"
                    />

                </svg>


                <div>

                    <strong>
                        Periksa kembali data berikut:
                    </strong>


                    <ul
                        style="
                            margin:6px 0 0;
                            padding-left:18px;
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


        {{-- ========================================================
             FORM LAYOUT
        ========================================================= --}}

        <form
            method="POST"
            action="{{ route(
                'guru.assignments.update',
                $assignment
            ) }}"
            id="assignmentEditForm"
        >

            @csrf

            @method('PUT')


            <div class="form-layout">


                {{-- ==================================================
                     MAIN COLUMN
                =================================================== --}}

                <div class="main-column">


                    {{-- =================================================
                         INFORMASI DASAR
                    ================================================== --}}

                    <section class="card">


                        <div class="card-header">

                            <div class="card-heading">


                                <div
                                    class="
                                        card-icon
                                        card-icon-primary
                                    "
                                >

                                    <svg
                                        width="18"
                                        height="18"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path
                                            d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
                                        />

                                        <polyline
                                            points="14 2 14 8 20 8"
                                        />

                                        <line
                                            x1="8"
                                            y1="13"
                                            x2="16"
                                            y2="13"
                                        />

                                        <line
                                            x1="8"
                                            y1="17"
                                            x2="14"
                                            y2="17"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h2>
                                        Informasi Tugas
                                    </h2>

                                    <p>
                                        Perbarui data utama tugas.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">


                            <div class="form-grid">


                                {{-- KELAS --}}

                                <div class="form-group">


                                    <label
                                        for="kelas"
                                        class="form-label"
                                    >

                                        Kelas
                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="kelas"
                                        id="kelas"
                                        class="
                                            form-select
                                            @error('kelas')
                                                input-error
                                            @enderror
                                        "
                                        required
                                    >

                                        <option value="">
                                            Pilih kelas
                                        </option>


                                        @foreach($classes as $class)

                                            @php

                                                $classValue =
                                                    $class->nama;

                                            @endphp


                                            <option
                                                value="{{ $classValue }}"
                                                @selected(
                                                    old(
                                                        'kelas',
                                                        $assignment->kelas
                                                    ) === $classValue
                                                )
                                            >

                                                {{ $class->nama }}

                                            </option>

                                        @endforeach

                                    </select>


                                    @error('kelas')

                                        <div class="field-error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- PERTEMUAN --}}

                                <div class="form-group">


                                    <label
                                        for="assignment_meeting_id"
                                        class="form-label"
                                    >

                                        Pertemuan
                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="assignment_meeting_id"
                                        id="assignment_meeting_id"
                                        class="
                                            form-select
                                            @error('assignment_meeting_id')
                                                input-error
                                            @enderror
                                        "
                                        required
                                    >

                                        <option value="">
                                            Pilih pertemuan
                                        </option>


                                        @foreach(
                                            $assignmentMeetings
                                            as $meeting
                                        )

                                            <option
                                                value="{{ $meeting->id }}"
                                                data-kelas="{{ $meeting->kelas }}"
                                                @selected(
                                                    (string) old(
                                                        'assignment_meeting_id',
                                                        $assignment->assignment_meeting_id
                                                    ) ===
                                                    (string) $meeting->id
                                                )
                                            >

                                                Pertemuan
                                                {{ $meeting->pertemuan }}

                                                @if($meeting->judul)

                                                    —
                                                    {{ $meeting->judul }}

                                                @endif

                                            </option>

                                        @endforeach

                                    </select>


                                    <div class="field-help">

                                        Pertemuan mengikuti daftar
                                        pertemuan tugas yang sudah dibuat.

                                    </div>


                                    @error('assignment_meeting_id')

                                        <div class="field-error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- JUDUL --}}

                                <div class="form-group full">


                                    <label
                                        for="judul"
                                        class="form-label"
                                    >

                                        Judul Tugas
                                        <span class="required">
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="judul"
                                        id="judul"
                                        class="
                                            form-input
                                            @error('judul')
                                                input-error
                                            @enderror
                                        "
                                        value="{{ old(
                                            'judul',
                                            $assignment->judul
                                        ) }}"
                                        maxlength="255"
                                        placeholder="Contoh: Analisis Karya Seni Nusantara"
                                        required
                                    >


                                    @error('judul')

                                        <div class="field-error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                                {{-- INSTRUKSI --}}

                                <div class="form-group full">


                                    <div class="instruction-toolbar">

                                        <label
                                            for="instruksi"
                                            class="form-label"
                                            style="
                                                margin:0;
                                            "
                                        >

                                            Instruksi Tugas
                                            <span class="required">
                                                *
                                            </span>

                                        </label>


                                        <span
                                            id="instructionCounter"
                                            class="instruction-counter"
                                        >
                                            0 karakter
                                        </span>

                                    </div>


                                    <textarea
                                        name="instruksi"
                                        id="instruksi"
                                        class="
                                            form-textarea
                                            @error('instruksi')
                                                input-error
                                            @enderror
                                        "
                                        maxlength="10000"
                                        placeholder="Tuliskan instruksi tugas secara jelas..."
                                        required
                                    >{{ old(
                                        'instruksi',
                                        $assignment->instruksi
                                    ) }}</textarea>


                                    <div class="field-help">

                                        Jelaskan apa yang harus
                                        dikerjakan siswa dan ketentuan
                                        pengumpulannya.

                                    </div>


                                    @error('instruksi')

                                        <div class="field-error">
                                            {{ $message }}
                                        </div>

                                    @enderror

                                </div>


                            </div>

                        </div>

                    </section>


                    {{-- =================================================
                         PENGUMPULAN
                    ================================================== --}}

                    <section class="card">


                        <div class="card-header">

                            <div class="card-heading">


                                <div
                                    class="
                                        card-icon
                                        card-icon-green
                                    "
                                >

                                    <svg
                                        width="18"
                                        height="18"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path
                                            d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"
                                        />

                                        <polyline
                                            points="7 10 12 15 17 10"
                                        />

                                        <line
                                            x1="12"
                                            y1="15"
                                            x2="12"
                                            y2="3"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h2>
                                        Pengaturan Pengumpulan
                                    </h2>

                                    <p>
                                        Tentukan cara siswa mengumpulkan tugas.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">


                            <div class="form-group">


                                <label class="form-label">

                                    Mode Pengumpulan
                                    <span class="required">
                                        *
                                    </span>

                                </label>


                                <div class="mode-options">


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
                                                    $assignment->mode_pengumpulan
                                                ) === 'individu'
                                            )
                                        >


                                        <label
                                            for="mode_individu"
                                            class="mode-label"
                                        >

                                            <span class="mode-radio"></span>


                                            <span>

                                                <span class="mode-title">
                                                    Individu
                                                </span>


                                                <span class="mode-description">

                                                    Setiap siswa mengumpulkan
                                                    tugas secara mandiri.

                                                </span>

                                            </span>

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
                                                    'mode_pengumpulan',
                                                    $assignment->mode_pengumpulan
                                                ) === 'kelompok'
                                            )
                                        >


                                        <label
                                            for="mode_kelompok"
                                            class="mode-label"
                                        >

                                            <span class="mode-radio"></span>


                                            <span>

                                                <span class="mode-title">
                                                    Kelompok
                                                </span>


                                                <span class="mode-description">

                                                    Siswa mengumpulkan
                                                    melalui kelompok tugas.

                                                </span>

                                            </span>

                                        </label>

                                    </div>


                                </div>


                                @error('mode_pengumpulan')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- DEADLINE --}}

                            <div
                                class="form-group"
                                style="
                                    margin-top:16px;
                                "
                            >

                                <label
                                    for="batas_waktu"
                                    class="form-label"
                                >

                                    Batas Waktu

                                </label>


                                <input
                                    type="datetime-local"
                                    name="batas_waktu"
                                    id="batas_waktu"
                                    class="
                                        form-input
                                        @error('batas_waktu')
                                            input-error
                                        @enderror
                                    "
                                    value="{{ old(
                                        'batas_waktu',
                                        $assignment->batas_waktu
                                            ? $assignment->batas_waktu->format(
                                                'Y-m-d\TH:i'
                                            )
                                            : ''
                                    ) }}"
                                >


                                <div class="field-help">

                                    Kosongkan jika tugas tidak memiliki
                                    batas waktu.

                                </div>


                                @error('batas_waktu')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </section>


                </div>


                {{-- ==================================================
                     SIDE COLUMN
                =================================================== --}}

                <aside class="side-column">


                    {{-- PREVIEW --}}

                    <section class="card">

                        <div class="card-header">

                            <div class="card-heading">

                                <div
                                    class="
                                        card-icon
                                        card-icon-primary
                                    "
                                >

                                    <svg
                                        width="17"
                                        height="17"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path
                                            d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                        />

                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h2>
                                        Ringkasan
                                    </h2>

                                    <p>
                                        Informasi tugas saat ini.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">


                            <div class="assignment-preview">


                                <div class="preview-label">
                                    Tugas
                                </div>


                                <h3
                                    class="preview-title"
                                    id="previewTitle"
                                >
                                    {{ $assignment->judul }}
                                </h3>


                                <div class="preview-meta">


                                    <span
                                        class="preview-badge"
                                        id="previewClass"
                                    >

                                        {{ $assignment->kelas }}

                                    </span>


                                    <span
                                        class="preview-badge"
                                        id="previewMeeting"
                                    >

                                        Pertemuan
                                        {{ $assignment->pertemuan }}

                                    </span>


                                    <span
                                        class="preview-badge"
                                        id="previewMode"
                                    >

                                        {{
                                            ucfirst(
                                                $assignment->mode_pengumpulan
                                            )
                                        }}

                                    </span>

                                </div>

                            </div>


                            <div
                                class="detail-list"
                                style="
                                    margin-top:17px;
                                "
                            >


                                <div class="detail-row">

                                    <span class="detail-label">
                                        ID Tugas
                                    </span>

                                    <span class="detail-value">
                                        #{{ $assignment->id }}
                                    </span>

                                </div>


                                <div class="detail-row">

                                    <span class="detail-label">
                                        Pertemuan
                                    </span>

                                    <span
                                        class="detail-value"
                                        id="detailMeeting"
                                    >

                                        {{ $assignment->pertemuan }}

                                    </span>

                                </div>


                                <div class="detail-row">

                                    <span class="detail-label">
                                        Kelas
                                    </span>

                                    <span
                                        class="detail-value"
                                        id="detailClass"
                                    >

                                        {{ $assignment->kelas }}

                                    </span>

                                </div>


                                <div class="detail-row">

                                    <span class="detail-label">
                                        Mode
                                    </span>

                                    <span
                                        class="detail-value"
                                        id="detailMode"
                                    >

                                        {{
                                            ucfirst(
                                                $assignment->mode_pengumpulan
                                            )
                                        }}

                                    </span>

                                </div>


                            </div>

                        </div>

                    </section>


                    {{-- STATUS --}}

                    <section class="card">

                        <div class="card-header">

                            <div class="card-heading">

                                <div
                                    class="
                                        card-icon
                                        card-icon-green
                                    "
                                >

                                    <svg
                                        width="17"
                                        height="17"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path
                                            d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20Z"
                                        />

                                        <path
                                            d="M8 12l2.5 2.5L16 9"
                                        />

                                    </svg>

                                </div>


                                <div>

                                    <h2>
                                        Status Tugas
                                    </h2>

                                    <p>
                                        Atur ketersediaan tugas.
                                    </p>

                                </div>

                            </div>

                        </div>


                        <div class="card-body">


                            <div class="status-card">


                                <div class="status-row">

                                    <span class="status-label">
                                        Status sekarang
                                    </span>


                                    <span
                                        id="statusBadge"
                                        class="
                                            status-badge
                                            {{
                                                $assignment->aktif
                                                    ? 'status-active'
                                                    : 'status-inactive'
                                            }}
                                    ">

                                        <span class="status-dot"></span>

                                        <span id="statusText">

                                            {{
                                                $assignment->aktif
                                                    ? 'Aktif'
                                                    : 'Nonaktif'
                                            }}

                                        </span>

                                    </span>

                                </div>

                            </div>


                            <div
                                class="field-help"
                                style="
                                    margin-top:10px;
                                "
                            >

                                Status dapat diubah menggunakan
                                tombol aktif/nonaktif di halaman
                                detail tugas.

                            </div>

                        </div>

                    </section>


                    {{-- ACTION --}}

                    <section class="card">

                        <div class="card-body">


                            <div class="action-buttons">


                                <button
                                    type="submit"
                                    class="
                                        button
                                        button-primary
                                    "
                                >

                                    <svg
                                        width="15"
                                        height="15"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >

                                        <path
                                            d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2Z"
                                        />

                                        <polyline
                                            points="17 21 17 13 7 13 7 21"
                                        />

                                        <polyline
                                            points="7 3 7 8 15 8"
                                        />

                                    </svg>

                                    Simpan Perubahan

                                </button>


                                <a
                                    href="{{ route(
                                        'guru.assignments.show',
                                        $assignment
                                    ) }}"
                                    class="
                                        button
                                        button-secondary
                                    "
                                >

                                    Batal

                                </a>


                            </div>

                        </div>

                    </section>


                    {{-- DELETE --}}

                    <section class="card">

                        <div class="card-body">


                            <div class="delete-box">

                                <h3 class="delete-title">
                                    Hapus Tugas
                                </h3>


                                <p class="delete-description">

                                    Gunakan hanya jika tugas memang
                                    sudah tidak diperlukan. Data
                                    pengumpulan yang berkaitan dapat
                                    ikut terdampak.

                                </p>


                                <button
                                    type="button"
                                    class="
                                        button
                                        button-delete
                                    "
                                    id="deleteAssignmentButton"
                                >

                                    Hapus Tugas

                                </button>

                            </div>

                        </div>

                    </section>


                </aside>


            </div>

        </form>


        {{-- ========================================================
             DELETE FORM
        ========================================================= --}}

        <form
            method="POST"
            action="{{ route(
                'guru.assignments.destroy',
                $assignment
            ) }}"
            id="deleteAssignmentForm"
            style="display:none;"
        >

            @csrf

            @method('DELETE')

        </form>


    </main>

</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            /*
            |--------------------------------------------------------------------------
            | INSTRUKSI COUNTER
            |--------------------------------------------------------------------------
            */

            const instruction =
                document.getElementById(
                    'instruksi'
                );


            const instructionCounter =
                document.getElementById(
                    'instructionCounter'
                );


            function updateInstructionCounter() {

                if (
                    !instruction ||
                    !instructionCounter
                ) {
                    return;
                }


                const length =
                    instruction.value.length;


                instructionCounter.textContent =
                    length.toLocaleString('id-ID')
                    + ' karakter';

            }


            if (instruction) {

                instruction.addEventListener(
                    'input',
                    updateInstructionCounter
                );

                updateInstructionCounter();

            }


            /*
            |--------------------------------------------------------------------------
            | LIVE PREVIEW JUDUL
            |--------------------------------------------------------------------------
            */

            const titleInput =
                document.getElementById(
                    'judul'
                );


            const previewTitle =
                document.getElementById(
                    'previewTitle'
                );


            if (
                titleInput &&
                previewTitle
            ) {

                titleInput.addEventListener(
                    'input',
                    function () {

                        previewTitle.textContent =
                            this.value.trim()
                            ||
                            'Judul Tugas';

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | MODE PREVIEW
            |--------------------------------------------------------------------------
            */

            const modeInputs =
                document.querySelectorAll(
                    'input[name="mode_pengumpulan"]'
                );


            const previewMode =
                document.getElementById(
                    'previewMode'
                );


            const detailMode =
                document.getElementById(
                    'detailMode'
                );


            modeInputs.forEach(
                function (input) {

                    input.addEventListener(
                        'change',
                        function () {

                            const value =
                                this.value === 'kelompok'
                                    ? 'Kelompok'
                                    : 'Individu';


                            if (previewMode) {

                                previewMode.textContent =
                                    value;

                            }


                            if (detailMode) {

                                detailMode.textContent =
                                    value;

                            }

                        }
                    );

                }
            );


            /*
            |--------------------------------------------------------------------------
            | KELAS → PERTEMUAN
            |--------------------------------------------------------------------------
            */

            const classSelect =
                document.getElementById(
                    'kelas'
                );


            const meetingSelect =
                document.getElementById(
                    'assignment_meeting_id'
                );


            const previewClass =
                document.getElementById(
                    'previewClass'
                );


            const detailClass =
                document.getElementById(
                    'detailClass'
                );


            function filterMeetings() {

                if (
                    !classSelect ||
                    !meetingSelect
                ) {
                    return;
                }


                const selectedClass =
                    classSelect.value;


                Array.from(
                    meetingSelect.options
                ).forEach(
                    function (option, index) {


                        if (index === 0) {

                            option.hidden = false;

                            return;

                        }


                        const meetingClass =
                            option.dataset.kelas
                            || '';


                        option.hidden =
                            selectedClass !== ''
                            &&
                            meetingClass !== ''
                            &&
                            meetingClass !== selectedClass;

                    }
                );


                const current =
                    meetingSelect.options[
                        meetingSelect.selectedIndex
                    ];


                if (
                    current &&
                    current.hidden
                ) {

                    meetingSelect.value = '';

                }

            }


            if (classSelect) {

                classSelect.addEventListener(
                    'change',
                    function () {

                        if (previewClass) {

                            previewClass.textContent =
                                this.value
                                || 'Kelas';

                        }


                        if (detailClass) {

                            detailClass.textContent =
                                this.value
                                || '—';

                        }


                        filterMeetings();

                    }
                );

            }


            filterMeetings();


            /*
            |--------------------------------------------------------------------------
            | PERTEMUAN PREVIEW
            |--------------------------------------------------------------------------
            */

            const previewMeeting =
                document.getElementById(
                    'previewMeeting'
                );


            const detailMeeting =
                document.getElementById(
                    'detailMeeting'
                );


            if (meetingSelect) {

                meetingSelect.addEventListener(
                    'change',
                    function () {


                        const option =
                            this.options[
                                this.selectedIndex
                            ];


                        if (
                            !option ||
                            !option.value
                        ) {
                            return;
                        }


                        const text =
                            option.textContent
                                .trim();


                        const match =
                            text.match(
                                /Pertemuan\s+(\d+)/i
                            );


                        const number =
                            match
                                ? match[1]
                                : '—';


                        if (previewMeeting) {

                            previewMeeting.textContent =
                                'Pertemuan '
                                + number;

                        }


                        if (detailMeeting) {

                            detailMeeting.textContent =
                                number;

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | DELETE
            |--------------------------------------------------------------------------
            */

            const deleteButton =
                document.getElementById(
                    'deleteAssignmentButton'
                );


            const deleteForm =
                document.getElementById(
                    'deleteAssignmentForm'
                );


            if (
                deleteButton &&
                deleteForm
            ) {

                deleteButton.addEventListener(
                    'click',
                    function () {


                        const confirmed =
                            window.confirm(
                                'Yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.'
                            );


                        if (confirmed) {

                            deleteForm.submit();

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | PREVENT DOUBLE SUBMIT
            |--------------------------------------------------------------------------
            */

            const form =
                document.getElementById(
                    'assignmentEditForm'
                );


            if (form) {

                form.addEventListener(
                    'submit',
                    function () {


                        const submitButton =
                            form.querySelector(
                                'button[type="submit"]'
                            );


                        if (
                            submitButton &&
                            submitButton.disabled
                        ) {

                            return;

                        }


                        if (submitButton) {

                            submitButton.disabled =
                                true;

                            submitButton.style.opacity =
                                '.7';

                            submitButton.style.cursor =
                                'wait';

                            submitButton.innerHTML =
                                'Menyimpan...';

                        }

                    }
                );

            }

        }
    );

</script>


    <script>
        if (window.lucide) {
            lucide.createIcons();
        }
    </script>

</body>

</html>