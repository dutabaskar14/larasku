{{-- =========================================================
     GURU — KELOLA PERTEMUAN TUGAS
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

    <title>Pertemuan Tugas — Guru</title>


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
            --border: #e7ebf2;
            --border-strong: #dbe2ec;
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
            --shadow-sm: 0 2px 10px rgba(15, 23, 42, .035);
            --shadow-md: 0 12px 35px rgba(15, 23, 42, .055);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        button,
        input,
        select {
            font: inherit;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        .assignment-page {
            min-height: 100vh;
            background:
                radial-gradient(circle at top right, rgba(99, 102, 241, .035), transparent 30%),
                var(--bg);
        }

        /* SIDEBAR IS PROVIDED BY guru.partials.sidebar */
        .assignment-main {
            min-height: 100vh;
            width: 100%;
        }

        .assignment-topbar {
            display: none;
        }

        .topbar-label {
            margin-bottom: 4px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: .08em;
            line-height: 1;
            text-transform: uppercase;
        }

        .topbar-title {
            color: var(--text);
            font-size: 15px;
            font-weight: 800;
            line-height: 1.2;
        }

        .topbar-avatar {
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #c7d2fe;
            border-radius: 50%;
            color: #4338ca;
            background: var(--primary-soft);
            font-size: 12px;
            font-weight: 850;
        }

        .assignment-content {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0 0 56px;
        }

        .page-header {
            margin-bottom: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 16px;
            color: var(--text-soft);
            font-size: 12px;
            font-weight: 750;
            transition: .18s ease;
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
            color: #4f46e5;
            background: var(--primary-soft);
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .06em;
        }

        .page-title {
            margin: 0;
            color: var(--text);
            font-size: 28px;
            font-weight: 850;
            letter-spacing: -.035em;
            line-height: 1.15;
        }

        .page-description {
            max-width: 720px;
            margin: 8px 0 0;
            color: var(--text-soft);
            font-size: 13px;
            font-weight: 500;
            line-height: 1.65;
        }

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

        .meeting-layout {
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .card {
            min-width: 0;
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
            flex: 0 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
        }

        .card-icon-blue {
            color: var(--primary);
            background: var(--primary-soft);
        }

        .card-icon-violet {
            color: #7c3aed;
            background: #f5f3ff;
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

        .field {
            margin-bottom: 16px;
        }

        .field:last-child {
            margin-bottom: 0;
        }

        .field-label {
            display: block;
            margin-bottom: 7px;
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
            left: 12px;
            top: 50%;
            width: 16px;
            height: 16px;
            color: var(--muted);
            pointer-events: none;
            transform: translateY(-50%);
        }

        .form-input,
        .form-select,
        .filter-select {
            width: 100%;
            height: 43px;
            border: 1px solid var(--border-strong);
            border-radius: 10px;
            outline: none;
            color: #334155;
            background: #fff;
            font-size: 12px;
            font-weight: 650;
            transition: border-color .18s ease, box-shadow .18s ease;
        }

        .form-input,
        .form-select {
            padding: 0 12px;
        }

        .form-input.with-icon,
        .form-select.with-icon {
            padding-left: 38px;
        }

        .form-input::placeholder {
            color: #cbd5e1;
        }

        .form-input:focus,
        .form-select:focus,
        .filter-select:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 3px rgba(99,102,241,.10);
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
            color: #dc2626;
            font-size: 10px;
            font-weight: 650;
        }

        .button {
            min-height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 13px;
            border: 1px solid transparent;
            border-radius: 10px;
            cursor: pointer;
            font-size: 10px;
            font-weight: 800;
            line-height: 1;
            white-space: nowrap;
            transition: transform .16s ease, background .16s ease,
                border-color .16s ease, box-shadow .16s ease, color .16s ease;
        }

        .button:hover {
            transform: translateY(-1px);
        }

        .button-primary {
            width: 100%;
            color: #fff;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            box-shadow: 0 7px 16px rgba(79,70,229,.16);
        }

        .button-primary:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            box-shadow: 0 9px 20px rgba(79,70,229,.21);
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

        .button-danger {
            color: #dc2626;
            background: #fff;
            border-color: #fecaca;
        }

        .button-danger:hover {
            background: var(--danger-soft);
            border-color: #fca5a5;
        }

        .button-small {
            min-width: 35px;
            min-height: 35px;
            padding: 0 9px;
            border-radius: 9px;
            font-size: 9px;
        }

        .info-box {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            margin-top: 17px;
            padding: 12px 13px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            background: #eff6ff;
        }

        .info-box svg {
            width: 15px;
            height: 15px;
            flex: 0 0 auto;
            color: #2563eb;
            margin-top: 1px;
        }

        .info-box p {
            margin: 0;
            color: #1d4ed8;
            font-size: 10px;
            font-weight: 600;
            line-height: 1.6;
        }

        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 16px;
            border-bottom: 1px solid #eef2f7;
            background: var(--surface-soft);
        }

        .filter-left {
            min-width: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-label {
            color: var(--text-soft);
            font-size: 10px;
            font-weight: 850;
            white-space: nowrap;
        }

        .filter-select {
            width: auto;
            min-width: 180px;
            height: 35px;
            padding: 0 10px;
            font-size: 10px;
        }

        .meeting-count {
            color: var(--muted);
            font-size: 10px;
            font-weight: 750;
            white-space: nowrap;
        }

        .meeting-list {
            padding: 6px 8px 9px;
        }

        .meeting-item {
            min-width: 0;
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr) auto;
            align-items: center;
            gap: 12px;
            padding: 12px 10px;
            border-bottom: 1px solid #f1f5f9;
            transition: background .16s ease;
        }

        .meeting-item:last-child {
            border-bottom: 0;
        }

        .meeting-item:hover {
            background: #fafbff;
        }

        .meeting-number {
            width: 44px;
            height: 44px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #e0e7ff;
            border-radius: 11px;
            color: var(--primary);
            background: var(--primary-soft);
        }

        .meeting-number small {
            font-size: 7px;
            font-weight: 850;
            letter-spacing: .04em;
            line-height: 1;
            text-transform: uppercase;
            opacity: .7;
        }

        .meeting-number strong {
            margin-top: 3px;
            font-size: 14px;
            font-weight: 850;
            line-height: 1;
        }

        .meeting-info {
            min-width: 0;
        }

        .meeting-title {
            margin: 0;
            overflow: hidden;
            color: var(--text);
            font-size: 12px;
            font-weight: 850;
            line-height: 1.35;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .meeting-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 7px 10px;
            margin-top: 5px;
        }

        .meeting-meta-item {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            color: var(--muted);
            font-size: 9px;
            font-weight: 650;
            white-space: nowrap;
        }

        .meeting-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            min-width: 77px;
        }

        .meeting-actions form {
            margin: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 7px;
            border-radius: 999px;
            font-size: 8px;
            font-weight: 850;
            line-height: 1;
            white-space: nowrap;
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

        .empty-state {
            padding: 54px 24px;
            text-align: center;
        }

        .empty-icon {
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 13px;
            border: 1px solid var(--border);
            border-radius: 15px;
            color: var(--muted);
            background: var(--surface-soft);
        }

        .empty-state h3 {
            margin: 0;
            color: #334155;
            font-size: 13px;
            font-weight: 850;
        }

        .empty-state p {
            max-width: 390px;
            margin: 6px auto 0;
            color: var(--muted);
            font-size: 10px;
            font-weight: 500;
            line-height: 1.6;
        }

        @media (max-width: 1100px) {
            .assignment-content {
                max-width: 1050px;
                padding-left: 24px;
                padding-right: 24px;
            }

            .meeting-layout {
                grid-template-columns: 290px minmax(0, 1fr);
            }
        }

        @media (max-width: 820px) {
            .assignment-topbar {
                padding: 0 20px;
            }

            .assignment-content {
                padding: 22px 18px 42px;
            }

            .meeting-layout {
                grid-template-columns: 1fr;
            }

            .page-title-row {
                align-items: flex-start;
            }
        }

        @media (max-width: 620px) {
            .assignment-topbar {
                height: 62px;
            }

            .assignment-content {
                padding: 18px 14px 35px;
            }

            .page-title {
                font-size: 23px;
            }

            .page-description {
                font-size: 12px;
            }

            .card-header,
            .card-body {
                padding: 15px;
            }

            .filter-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .filter-left {
                width: 100%;
            }

            .filter-select {
                flex: 1;
                min-width: 0;
            }

            .meeting-item {
                grid-template-columns: 42px minmax(0, 1fr);
                align-items: start;
            }

            .meeting-number {
                width: 42px;
                height: 42px;
            }

            .meeting-actions {
                grid-column: 2;
                justify-content: flex-start;
                min-width: 0;
            }
        }

        @media (max-width: 420px) {
            .topbar-avatar {
                display: none;
            }

            .meeting-meta {
                gap: 5px 8px;
            }

            .meeting-actions .button {
                flex: 1;
            }
        }
    </style>

</head>


<body class="min-h-screen text-slate-800">

<div class="flex min-h-screen">

    @include('guru.partials.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="flex-1 lg:ml-64">


        @include('guru.partials.header')



        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="p-5 lg:p-8 max-w-7xl mx-auto">
            <div class="assignment-content">


            {{-- =================================================
                 PAGE HEADER
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


                <div class="page-title-row">

                    <div>

                        <div class="page-kicker">

                            <i
                                data-lucide="calendar-days"
                                width="13"
                                height="13"
                            ></i>

                            PENGELOLAAN PERTEMUAN

                        </div>


                        <h1 class="page-title">
                            Pertemuan Tugas
                        </h1>


                        <p class="page-description">
                            Buat dan kelola pertemuan tugas secara manual
                            berdasarkan kelas. Nomor pertemuan dapat dimulai
                            dari angka berapa pun sesuai kebutuhan pembelajaran.
                        </p>

                    </div>

                </div>

            </section>



            {{-- =================================================
                 SUCCESS
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <i
                        data-lucide="check-circle-2"
                        class="alert-icon"
                    ></i>

                    <div>
                        {{ session('success') }}
                    </div>

                </div>

            @endif



            {{-- =================================================
                 ERROR
            ================================================== --}}

            @if(session('error'))

                <div class="alert alert-error">

                    <i
                        data-lucide="alert-circle"
                        class="alert-icon"
                    ></i>

                    <div>
                        {{ session('error') }}
                    </div>

                </div>

            @endif



            @if($errors->any())

                <div class="alert alert-error">

                    <i
                        data-lucide="alert-circle"
                        class="alert-icon"
                    ></i>

                    <div>

                        <strong>
                            Periksa kembali data.
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
                 MAIN LAYOUT
            ================================================== --}}

            <div class="meeting-layout">


                {{-- =================================================
                     LEFT — FORM
                ================================================== --}}

                <section class="card">

                    <div class="card-header">

                        <div class="card-heading">

                            <div class="card-icon card-icon-blue">

                                <i
                                    data-lucide="plus"
                                    width="18"
                                    height="18"
                                ></i>

                            </div>


                            <div>

                                <h2>
                                    Tambah Pertemuan
                                </h2>

                                <p>
                                    Buat pertemuan baru untuk kelas.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">


                        <form
                            method="POST"
                            action="{{ route('guru.assignments.meetings.store') }}"
                        >

                            @csrf


                            {{-- KELAS --}}

                            <div class="field">

                                <label
                                    for="kelas"
                                    class="field-label"
                                >
                                    Kelas
                                    <span class="required">*</span>
                                </label>


                                <div class="input-wrap">

                                    <i
                                        data-lucide="school"
                                        class="input-icon"
                                    ></i>


                                    <select
                                        id="kelas"
                                        name="kelas"
                                        class="form-select with-icon"
                                        required
                                    >

                                        <option value="">
                                            Pilih kelas
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


                                @error('kelas')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            {{-- PERTEMUAN --}}

                            <div class="field">

                                <label
                                    for="pertemuan"
                                    class="field-label"
                                >
                                    Nomor Pertemuan
                                    <span class="required">*</span>
                                </label>


                                <div class="input-wrap">

                                    <i
                                        data-lucide="hash"
                                        class="input-icon"
                                    ></i>


                                    <input
                                        type="number"
                                        id="pertemuan"
                                        name="pertemuan"
                                        value="{{ old('pertemuan') }}"
                                        min="1"
                                        max="255"
                                        step="1"
                                        required
                                        class="form-input with-icon"
                                        placeholder="Contoh: 4"
                                    >

                                </div>


                                <div class="field-help">

                                    Masukkan angka secara manual.
                                    Misalnya <strong>4</strong> akan menjadi
                                    <strong>Pertemuan 4</strong>.

                                </div>


                                @error('pertemuan')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>



                            <button
                                type="submit"
                                class="button button-primary"
                            >

                                <i
                                    data-lucide="plus"
                                    width="15"
                                    height="15"
                                ></i>

                                Tambah Pertemuan

                            </button>

                        </form>



                        {{-- INFO --}}

                        <div class="info-box">

                            <i data-lucide="info"></i>

                            <p>
                                Pertemuan dibuat khusus untuk kelas yang
                                dipilih. Nomor yang sama tidak dapat dibuat
                                dua kali dalam kelas yang sama.
                            </p>

                        </div>

                    </div>

                </section>



                {{-- =================================================
                     RIGHT — LIST
                ================================================== --}}

                <section class="card">

                    <div class="card-header">

                        <div class="card-heading">

                            <div class="card-icon card-icon-violet">

                                <i
                                    data-lucide="list-checks"
                                    width="18"
                                    height="18"
                                ></i>

                            </div>


                            <div>

                                <h2>
                                    Daftar Pertemuan
                                </h2>

                                <p>
                                    Pertemuan yang sudah dibuat guru.
                                </p>

                            </div>

                        </div>

                    </div>



                    {{-- FILTER --}}

                    <form
                        method="GET"
                        action="{{ route('guru.assignments.meetings.index') }}"
                        class="filter-bar"
                    >

                        <div class="filter-left">

                            <span class="filter-label">
                                Kelas
                            </span>


                            <select
                                name="kelas"
                                class="filter-select"
                                onchange="this.form.submit()"
                            >

                                <option value="">
                                    Semua kelas
                                </option>

                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class->nama }}"
                                        @selected(
                                            ($kelas ?? '') ===
                                            $class->nama
                                        )
                                    >
                                        {{ $class->nama }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="meeting-count">

                            {{ $meetings->count() }}
                            pertemuan

                        </div>

                    </form>



                    {{-- LIST --}}

                    @if($meetings->isNotEmpty())

                        <div class="meeting-list">

                            @foreach($meetings as $meeting)

                                <div class="meeting-item">


                                    {{-- NOMOR --}}

                                    <div class="meeting-number">

                                        <small>
                                            Pert.
                                        </small>

                                        <strong>
                                            {{ $meeting->pertemuan }}
                                        </strong>

                                    </div>



                                    {{-- INFO --}}

                                    <div class="meeting-info">

                                        <p class="meeting-title">
                                            Pertemuan {{ $meeting->pertemuan }}
                                        </p>


                                        <div class="meeting-meta">

                                            <span
                                                class="meeting-meta-item"
                                            >

                                                <i
                                                    data-lucide="school"
                                                    width="11"
                                                    height="11"
                                                ></i>

                                                {{ $meeting->kelas }}

                                            </span>


                                            <span
                                                class="meeting-meta-item"
                                            >

                                                <i
                                                    data-lucide="clipboard-list"
                                                    width="11"
                                                    height="11"
                                                ></i>

                                                {{ $meeting->assignments_count }}
                                                tugas

                                            </span>


                                            @if($meeting->aktif)

                                                <span
                                                    class="
                                                        status-badge
                                                        status-active
                                                    "
                                                >

                                                    <span
                                                        class="status-dot"
                                                    ></span>

                                                    Aktif

                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        status-badge
                                                        status-inactive
                                                    "
                                                >

                                                    <span
                                                        class="status-dot"
                                                    ></span>

                                                    Nonaktif

                                                </span>

                                            @endif

                                        </div>

                                    </div>



                                    {{-- ACTION --}}

                                    <div class="meeting-actions">


                                        {{-- TOGGLE --}}

                                        <form
                                            method="POST"
                                            action="{{
                                                route(
                                                    'guru.assignments.meetings.toggle',
                                                    $meeting
                                                )
                                            }}"
                                        >

                                            @csrf

                                            @method('PATCH')


                                            <button
                                                type="submit"
                                                class="
                                                    button
                                                    button-small
                                                    button-secondary
                                                "
                                                title="{{
                                                    $meeting->aktif
                                                        ? 'Nonaktifkan'
                                                        : 'Aktifkan'
                                                }}"
                                                onclick="
                                                    return confirm(
                                                        'Yakin ingin {{
                                                            $meeting->aktif
                                                                ? 'menonaktifkan'
                                                                : 'mengaktifkan'
                                                        }} Pertemuan {{ $meeting->pertemuan }} untuk kelas {{ $meeting->kelas }}?'
                                                    );
                                                "
                                            >

                                                <i
                                                    data-lucide="{{
                                                        $meeting->aktif
                                                            ? 'power-off'
                                                            : 'power'
                                                    }}"
                                                    width="13"
                                                    height="13"
                                                ></i>

                                                {{
                                                    $meeting->aktif
                                                        ? 'Nonaktifkan'
                                                        : 'Aktifkan'
                                                }}

                                            </button>

                                        </form>



                                        {{-- DELETE --}}

                                        @if(
                                            (int) $meeting->assignments_count === 0
                                        )

                                            <form
                                                method="POST"
                                                action="{{
                                                    route(
                                                        'guru.assignments.meetings.destroy',
                                                        $meeting
                                                    )
                                                }}"
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="
                                                        button
                                                        button-small
                                                        button-danger
                                                    "
                                                    title="Hapus pertemuan"
                                                    onclick="
                                                        return confirm(
                                                            'Yakin ingin menghapus Pertemuan {{ $meeting->pertemuan }} untuk kelas {{ $meeting->kelas }}?'
                                                        );
                                                    "
                                                >

                                                    <i
                                                        data-lucide="trash-2"
                                                        width="13"
                                                        height="13"
                                                    ></i>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @else

                        <div class="empty-state">

                            <div class="empty-icon">

                                <i
                                    data-lucide="calendar-plus"
                                    width="23"
                                    height="23"
                                ></i>

                            </div>


                            <h3>
                                Belum ada pertemuan
                            </h3>


                            <p>
                                Pilih kelas di sebelah kiri dan masukkan
                                nomor pertemuan untuk membuat pertemuan
                                pertama.
                            </p>

                        </div>

                    @endif

                </section>

            </div>

            </div>
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

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Auto focus nomor pertemuan
    |--------------------------------------------------------------------------
    */

    const kelasSelect =
        document.getElementById('kelas');

    const pertemuanInput =
        document.getElementById('pertemuan');


    if (
        kelasSelect &&
        pertemuanInput
    ) {

        kelasSelect.addEventListener(
            'change',
            function () {

                if (
                    this.value !== ''
                ) {

                    pertemuanInput.focus();

                }

            }
        );

    }

</script>

</body>

</html>