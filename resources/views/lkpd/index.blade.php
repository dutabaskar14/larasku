<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >

    <title>LKPD — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #172033;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        .student-main {
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 26px;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .brand {
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .brand span {
            display: block;
            margin-top: 1px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 700;
        }

        .top-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            font-size: 10px;
            font-weight: 800;
        }

        .container {
            width: min(900px, calc(100% - 30px));
            margin: auto;
            padding: 25px 0 50px;
        }

        .heading {
            margin-bottom: 17px;
        }

        .eyebrow {
            margin-bottom: 4px;
            color: #2563eb;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .13em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -.045em;
        }

        .subtitle {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.55;
        }

        .meeting-wrapper {
            margin-bottom: 15px;
        }

        .meeting-title {
            margin-bottom: 7px;
            color: #475569;
            font-size: 10px;
            font-weight: 850;
        }

        .meetings {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding: 1px 1px 5px;
        }

        .meeting {
            flex: 0 0 auto;
            min-width: 54px;
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            text-align: center;
            font-size: 10px;
            font-weight: 850;
        }

        .meeting.active {
            border-color: #0f172a;
            background: #0f172a;
            color: #fff;
        }

        .success,
        .error-box {
            margin-bottom: 13px;
            padding: 10px 12px;
            border-radius: 9px;
            font-size: 11px;
            font-weight: 750;
        }

        .success {
            border: 1px solid #bbf7d0;
            background: #ecfdf5;
            color: #166534;
        }

        .error-box {
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #b91c1c;
        }

        .card {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, .035);
        }

        .card-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
        }

        .header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }

        .meeting-label {
            display: inline-flex;
            padding: 4px 8px;
            border-radius: 6px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 9px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .card-title {
            margin: 7px 0 0;
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
            letter-spacing: -.025em;
        }

        .card-description {
            margin-top: 4px;
            color: #64748b;
            font-size: 11px;
            line-height: 1.55;
        }

        .progress-mini {
            flex: 0 0 auto;
            min-width: 65px;
            padding: 7px 8px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #f8fafc;
            text-align: center;
        }

        .progress-mini strong {
            display: block;
            color: #0f172a;
            font-size: 15px;
            font-weight: 900;
        }

        .progress-mini span {
            color: #94a3b8;
            font-size: 8px;
            font-weight: 800;
        }

        .form-content {
            padding: 18px 20px 22px;
        }

        .student-box {
            margin-bottom: 16px;
            padding: 13px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .student-box-title {
            margin-bottom: 9px;
            color: #0f172a;
            font-size: 11px;
            font-weight: 900;
        }

        .field {
            margin-bottom: 9px;
        }

        label {
            display: block;
            margin-bottom: 4px;
            color: #475569;
            font-size: 9px;
            font-weight: 850;
        }

        select,
        input[type="text"],
        textarea {
            width: 100%;
            border: 1px solid #dbe2ea;
            border-radius: 8px;
            background: #fff;
            color: #0f172a;
            font-family: inherit;
            font-size: 12px;
            outline: none;
        }

        select,
        input[type="text"] {
            height: 38px;
            padding: 0 10px;
        }

        select:focus,
        input:focus,
        textarea:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59,130,246,.08);
        }

        input[readonly] {
            background: #f1f5f9;
            color: #475569;
        }

        .identity {
            display: grid;
            grid-template-columns: 1fr 105px;
            gap: 8px;
        }

        .search-box {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
        }

        .search-box input {
            padding-left: 31px;
        }

        .student-results {
            display: none;
            max-height: 190px;
            overflow-y: auto;
            margin-top: 5px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            box-shadow: 0 10px 24px rgba(15,23,42,.08);
        }

        .student-result {
            display: block;
            width: 100%;
            padding: 10px 11px;
            border: 0;
            border-bottom: 1px solid #f1f5f9;
            background: #fff;
            text-align: left;
            cursor: pointer;
        }

        .student-result:last-child {
            border-bottom: 0;
        }

        .student-result:hover {
            background: #f8fafc;
        }

        .student-name {
            display: block;
            color: #0f172a;
            font-size: 11px;
            font-weight: 850;
        }

        .student-info {
            display: block;
            margin-top: 2px;
            color: #64748b;
            font-size: 9px;
        }

        .selected-student {
            display: none;
            margin-top: 7px;
            padding: 8px 10px;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            background: #eff6ff;
            color: #1e3a8a;
            font-size: 10px;
            font-weight: 750;
        }

        .choose-box {
            margin-top: 12px;
            padding: 18px 14px;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #f8fafc;
            text-align: center;
        }

        .choose-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #eff6ff;
            color: #2563eb;
        }

        .choose-title {
            color: #334155;
            font-size: 12px;
            font-weight: 900;
        }

        .choose-text {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        .instruction {
            margin-bottom: 16px;
            padding: 12px;
            border: 1px solid #dbeafe;
            border-radius: 11px;
            background: #f8fbff;
        }

        .instruction-label {
            margin-bottom: 4px;
            color: #2563eb;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .instruction-text {
            color: #334155;
            font-size: 11px;
            line-height: 1.6;
        }

        .questions-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 9px;
        }

        .questions-title {
            color: #0f172a;
            font-size: 12px;
            font-weight: 900;
        }

        .questions-count {
            color: #94a3b8;
            font-size: 9px;
            font-weight: 800;
        }

        .question-card {
            margin-bottom: 9px;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
        }

        .question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            margin-bottom: 7px;
            border-radius: 7px;
            background: #0f172a;
            color: #fff;
            font-size: 9px;
            font-weight: 900;
        }

        .question-text {
            margin-bottom: 9px;
            color: #1e293b;
            font-size: 12px;
            line-height: 1.55;
            font-weight: 750;
        }

        .question-type {
            display: inline-block;
            margin-bottom: 8px;
            padding: 3px 6px;
            border-radius: 5px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 8px;
            font-weight: 850;
            text-transform: uppercase;
        }

        .option-list {
            display: grid;
            gap: 6px;
        }

        .option {
            position: relative;
        }

        .option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .option label {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            width: 100%;
            margin: 0;
            padding: 9px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            color: #334155;
            font-size: 11px;
            line-height: 1.4;
            font-weight: 650;
            cursor: pointer;
        }

        .option label:hover {
            border-color: #bfdbfe;
            background: #f8fbff;
        }

        .option input:checked + label {
            border-color: #60a5fa;
            background: #eff6ff;
            color: #1e3a8a;
        }

        .option-letter {
            display: inline-flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 9px;
            font-weight: 900;
        }

        .option input:checked + label .option-letter {
            background: #2563eb;
            color: #fff;
        }

        textarea {
            min-height: 95px;
            padding: 9px 10px;
            resize: vertical;
            line-height: 1.5;
        }

        .submit-area {
            margin-top: 15px;
        }

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            min-height: 44px;
            padding: 9px 15px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #fff;
            font-family: inherit;
            font-size: 11px;
            font-weight: 850;
            cursor: pointer;
            box-shadow: 0 7px 18px rgba(15,23,42,.16);
        }

        .submit-button:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            box-shadow: none;
        }

        .required {
            margin-top: 10px;
            padding: 9px 10px;
            border: 1px solid #fed7aa;
            border-radius: 8px;
            background: #fff7ed;
            color: #9a3412;
            font-size: 10px;
            font-weight: 700;
        }

        .submitted-card {
            padding: 16px;
            border: 1px solid #bbf7d0;
            border-radius: 13px;
            background: linear-gradient(135deg,#f0fdf4,#fff);
        }

        .submitted-head {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .submitted-icon {
            width: 38px;
            height: 38px;
            flex: 0 0 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #dcfce7;
            color: #16a34a;
        }

        .submitted-title {
            color: #166534;
            font-size: 13px;
            font-weight: 950;
        }

        .submitted-name {
            margin-top: 2px;
            color: #64748b;
            font-size: 10px;
            font-weight: 700;
        }

        .score-card {
            margin-top: 13px;
            padding: 18px;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            background: #fff;
            text-align: center;
        }

        .score-label {
            color: #64748b;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: .14em;
            text-transform: uppercase;
        }

        .score-value {
            margin-top: 5px;
            color: #15803d;
            font-size: 44px;
            line-height: 1;
            font-weight: 950;
            letter-spacing: -.06em;
        }

        .score-info {
            margin-top: 7px;
            color: #64748b;
            font-size: 9px;
        }

        .waiting-card {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-top: 13px;
            padding: 12px;
            border: 1px solid #fde68a;
            border-radius: 11px;
            background: #fffbeb;
        }

        .waiting-icon {
            width: 32px;
            height: 32px;
            flex: 0 0 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9px;
            background: #fef3c7;
            color: #d97706;
        }

        .waiting-title {
            color: #92400e;
            font-size: 11px;
            font-weight: 900;
        }

        .waiting-text {
            margin-top: 3px;
            color: #78716c;
            font-size: 9px;
            line-height: 1.5;
        }

        .locked-card {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
            padding: 9px;
            border-radius: 8px;
            background: #f8fafc;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 750;
            text-align: center;
        }

        .no-lkpd {
            padding: 30px 18px;
            text-align: center;
        }

        .no-lkpd-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #f1f5f9;
            color: #64748b;
        }

        .no-lkpd-title {
            color: #334155;
            font-size: 12px;
            font-weight: 850;
        }

        .no-lkpd-text {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (min-width: 1024px) {
            .student-main {
                margin-left: 256px;
            }
        }

        @media (max-width: 1023px) {
            .student-main {
                margin-left: 0;
            }
        }

        @media (max-width: 600px) {
            .topbar {
                height: 58px;
                padding: 0 12px;
            }

            .brand {
                font-size: 17px;
            }

            .top-badge {
                padding: 6px 8px;
                font-size: 9px;
            }

            .container {
                width: calc(100% - 16px);
                padding: 15px 0 30px;
            }

            h1 {
                font-size: 24px;
            }

            .subtitle {
                font-size: 10px;
            }

            .card {
                border-radius: 13px;
            }

            .card-header {
                padding: 14px;
            }

            .form-content {
                padding: 14px;
            }

            .card-title {
                font-size: 16px;
            }

            .identity {
                grid-template-columns: 1fr 78px;
                gap: 6px;
            }

            select,
            input[type="text"] {
                height: 37px;
                font-size: 11px;
            }

            .question-card {
                padding: 11px;
            }

            .question-text {
                font-size: 11px;
            }

            .option label {
                padding: 8px;
                font-size: 10px;
            }

            textarea {
                min-height: 90px;
                font-size: 11px;
            }

            .score-value {
                font-size: 39px;
            }
        }
    </style>
</head>

<body>

@include('partials.sidebar')

<div class="student-main">

    <header class="topbar">

        <div class="brand">
            LARASKU
            <span>Pembelajaran Seni Musik</span>
        </div>

        <div class="top-badge">
            <i
                data-lucide="clipboard-list"
                style="width:13px;height:13px;"
            ></i>
            LKPD
        </div>

    </header>


    <main class="container">

        <section class="heading">

            <div class="eyebrow">
                LARASKU
            </div>

            <h1>LKPD</h1>

            <p class="subtitle">
                Kerjakan lembar kerja yang tersedia dari guru.
            </p>

        </section>


        {{-- =========================================================
             DAFTAR PERTEMUAN
        ========================================================== --}}

        @if($lkpds->count() > 0)

            <div class="meeting-wrapper">

                <div class="meeting-title">
                    Pertemuan tersedia
                </div>

                <div class="meetings">

                    @foreach($lkpds as $item)

                        <a
                            href="{{ route('lkpd.index', [
                                'pertemuan' => $item->pertemuan,
                                'kelas' => $kelas ?? '',
                                'student_id' => $selectedStudent->id ?? ''
                            ]) }}"
                            class="meeting {{ (int)$pertemuan === (int)$item->pertemuan ? 'active' : '' }}"
                        >
                            P{{ $item->pertemuan }}
                        </a>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- =========================================================
             NOTIFIKASI
        ========================================================== --}}

        @if(session('success'))

            <div class="success">

                <i
                    data-lucide="check-circle"
                    style="width:14px;height:14px;vertical-align:-3px;"
                ></i>

                {{ session('success') }}

            </div>

        @endif


        @if($errors->any())

            <div class="error-box">

                <strong>
                    Periksa kembali:
                </strong>

                <ul style="margin:5px 0 0 16px;">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =========================================================
             CARD UTAMA
        ========================================================== --}}

        <section class="card">

            @if(!$lkpd)

                <div class="no-lkpd">

                    <div class="no-lkpd-icon">

                        <i
                            data-lucide="clipboard-x"
                            style="width:20px;height:20px;"
                        ></i>

                    </div>

                    <div class="no-lkpd-title">
                        Belum ada LKPD
                    </div>

                    <div class="no-lkpd-text">
                        Guru belum menyediakan LKPD aktif untuk pertemuan ini.
                    </div>

                </div>

            @else

                {{-- =================================================
                     HEADER LKPD
                ================================================== --}}

                <div class="card-header">

                    <div class="header-row">

                        <div>

                            <div class="meeting-label">
                                Pertemuan {{ $lkpd->pertemuan }}
                            </div>

                            <h2 class="card-title">
                                {{ $lkpd->judul }}
                            </h2>

                        </div>

                        <div class="progress-mini">

                            @if($selectedStudent && $lkpdSubmitted)

                                <strong>✓</strong>

                                <span>
                                    TERKIRIM
                                </span>

                            @elseif($selectedStudent)

                                <strong>
                                    {{ $answeredQuestions }}/{{ $totalQuestions }}
                                </strong>

                                <span>
                                    TERJAWAB
                                </span>

                            @else

                                <strong>—</strong>

                                <span>
                                    STATUS
                                </span>

                            @endif

                        </div>

                    </div>

                    @if($lkpd->deskripsi)

                        <div class="card-description">
                            {{ $lkpd->deskripsi }}
                        </div>

                    @endif

                </div>


                <div class="form-content">


                    {{-- =================================================
                         IDENTITAS SISWA
                    ================================================== --}}

                    <div class="student-box">

                        <div class="student-box-title">
                            Identitas Siswa
                        </div>


                        {{-- KELAS --}}

                        <div class="field">

                            <label for="kelas">
                                Kelas
                            </label>

                            <select
                                id="kelas"
                                onchange="ubahKelas(this.value)"
                            >

                                <option value="">
                                    — Pilih Kelas —
                                </option>

                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        {{ ($kelas ?? '') === $class ? 'selected' : '' }}
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <div class="identity">

                            {{-- NAMA --}}

                            <div class="field">

                                <label for="cari_siswa">
                                    Nama Siswa
                                </label>

                                <div class="search-box">

                                    <span class="search-icon">
                                        🔍
                                    </span>

                                    <input
                                        type="text"
                                        id="cari_siswa"
                                        placeholder="{{ ($kelas ?? '') ? 'Cari nama atau absen...' : 'Pilih kelas dahulu' }}"
                                        {{ ($kelas ?? '') ? '' : 'disabled' }}
                                        autocomplete="off"
                                        value="{{ $selectedStudent->nama ?? '' }}"
                                    >

                                </div>


                                <div
                                    id="student-results"
                                    class="student-results"
                                >

                                    @if(($kelas ?? '') && $students->count())

                                        @foreach($students as $student)

                                            <button
                                                type="button"
                                                class="student-result"
                                                data-id="{{ $student->id }}"
                                                data-name="{{ $student->nama }}"
                                                data-absen="{{ $student->nomor_absen }}"
                                                data-kelas="{{ $student->kelas }}"
                                            >

                                                <span class="student-name">
                                                    {{ $student->nama }}
                                                </span>

                                                <span class="student-info">
                                                    No. Absen {{ $student->nomor_absen }}
                                                    · {{ $student->kelas }}
                                                </span>

                                            </button>

                                        @endforeach

                                    @elseif(($kelas ?? ''))

                                        <div style="padding:10px;color:#94a3b8;font-size:10px;">
                                            Tidak ada siswa pada kelas ini.
                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- ABSEN --}}

                            <div class="field">

                                <label for="nomor_absen">
                                    Absen
                                </label>

                                <input
                                    type="text"
                                    id="nomor_absen"
                                    value="{{ $selectedStudent->nomor_absen ?? '' }}"
                                    placeholder="—"
                                    readonly
                                >

                            </div>

                        </div>


                        @if($selectedStudent)

                            <div
                                class="selected-student"
                                style="display:block;"
                            >
                                Siswa terpilih:

                                <strong>
                                    {{ $selectedStudent->nama }}
                                </strong>
                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                         BELUM PILIH KELAS / NAMA
                         SOAL SENGAJA TIDAK DITAMPILKAN
                    ================================================== --}}

                    @if(!$selectedStudent)

                        <div class="choose-box">

                            <div class="choose-icon">

                                <i
                                    data-lucide="user-round-search"
                                    style="width:20px;height:20px;"
                                ></i>

                            </div>

                            <div class="choose-title">
                                Pilih kelas dan nama siswa
                            </div>

                            <div class="choose-text">
                                Setelah nama dipilih, halaman akan memuat ulang
                                dan otomatis memeriksa status LKPD siswa.
                                Soal belum ditampilkan sebelum siswa dipilih.
                            </div>

                        </div>


                    @else


                        {{-- =================================================
                             SUDAH SUBMIT
                        ================================================== --}}

                        @if($lkpdSubmitted)

                            <div class="submitted-card">

                                <div class="submitted-head">

                                    <div class="submitted-icon">

                                        <i
                                            data-lucide="check-circle"
                                            style="width:20px;height:20px;"
                                        ></i>

                                    </div>

                                    <div>

                                        <div class="submitted-title">
                                            LKPD Sudah Dikumpulkan
                                        </div>

                                        <div class="submitted-name">
                                            {{ $selectedStudent->nama }}
                                            · No. Absen {{ $selectedStudent->nomor_absen }}
                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                     SUDAH DINILAI
                                ================================================== --}}

                                @if($lkpdGraded)

                                    <div class="score-card">

                                        <div class="score-label">
                                            Nilai LKPD
                                        </div>

                                        <div class="score-value">
                                            {{ $lkpdScore }}
                                        </div>

                                        <div class="score-info">
                                            Penilaian telah selesai.
                                        </div>

                                    </div>


                                {{-- =================================================
                                     BELUM DINILAI
                                ================================================== --}}

                                @else

                                    <div class="waiting-card">

                                        <div class="waiting-icon">

                                            <i
                                                data-lucide="clock-3"
                                                style="width:17px;height:17px;"
                                            ></i>

                                        </div>

                                        <div>

                                            <div class="waiting-title">
                                                Menunggu Penilaian Guru
                                            </div>

                                            <div class="waiting-text">
                                                Jawaban sudah berhasil dikumpulkan.
                                                Guru sedang melakukan penilaian.
                                            </div>

                                        </div>

                                    </div>

                                @endif


                                <div class="locked-card">

                                    <i
                                        data-lucide="lock"
                                        style="width:13px;height:13px;"
                                    ></i>

                                    Jawaban tidak dapat dilihat, diubah,
                                    atau dikirim ulang.

                                </div>

                            </div>


                        {{-- =================================================
                             BELUM SUBMIT
                        ================================================== --}}

                        @else

                            @if($lkpd->deskripsi)

                                <div class="instruction">

                                    <div class="instruction-label">
                                        Petunjuk
                                    </div>

                                    <div class="instruction-text">
                                        {{ $lkpd->deskripsi }}
                                    </div>

                                </div>

                            @endif


                            @if($totalQuestions > 0)

                                <form
                                    action="{{ route('lkpd.store') }}"
                                    method="POST"
                                    id="lkpd-form"
                                >

                                    @csrf

                                    <input
                                        type="hidden"
                                        name="pertemuan"
                                        value="{{ $lkpd->pertemuan }}"
                                    >

                                    <input
                                        type="hidden"
                                        name="student_id"
                                        value="{{ $selectedStudent->id }}"
                                        id="student_id"
                                    >


                                    <div class="questions-heading">

                                        <div class="questions-title">
                                            Pertanyaan
                                        </div>

                                        <div class="questions-count">
                                            {{ $totalQuestions }} soal
                                        </div>

                                    </div>


                                    @foreach($lkpd->questions as $question)

                                        <div class="question-card">

                                            <div class="question-number">
                                                {{ $question->urutan }}
                                            </div>

                                            <div class="question-text">
                                                {{ $question->pertanyaan }}
                                            </div>

                                            <div class="question-type">

                                                @if($question->jenis === 'pilihan_ganda')

                                                    Pilihan Ganda

                                                @else

                                                    Essay

                                                @endif

                                            </div>


                                            {{-- PILIHAN GANDA --}}

                                            @if($question->jenis === 'pilihan_ganda')

                                                <div class="option-list">

                                                    @foreach([
                                                        'A' => $question->opsi_a,
                                                        'B' => $question->opsi_b,
                                                        'C' => $question->opsi_c,
                                                        'D' => $question->opsi_d,
                                                    ] as $letter => $option)

                                                        @if($option !== null && $option !== '')

                                                            <div class="option">

                                                                <input
                                                                    type="radio"
                                                                    id="q{{ $question->id }}_{{ $letter }}"
                                                                    name="jawaban[{{ $question->id }}]"
                                                                    value="{{ $letter }}"
                                                                >

                                                                <label
                                                                    for="q{{ $question->id }}_{{ $letter }}"
                                                                >

                                                                    <span class="option-letter">
                                                                        {{ $letter }}
                                                                    </span>

                                                                    <span>
                                                                        {{ $option }}
                                                                    </span>

                                                                </label>

                                                            </div>

                                                        @endif

                                                    @endforeach

                                                </div>


                                            {{-- ESSAY --}}

                                            @else

                                                <textarea
                                                    name="jawaban[{{ $question->id }}]"
                                                    placeholder="Tulis jawabanmu di sini..."
                                                ></textarea>

                                            @endif

                                        </div>

                                    @endforeach


                                    <div class="required">

                                        <i
                                            data-lucide="alert-circle"
                                            style="width:13px;height:13px;vertical-align:-3px;"
                                        ></i>

                                        Semua soal wajib dijawab.
                                        Jawaban hanya dapat dikirim satu kali.

                                    </div>


                                    <div class="submit-area">

                                        <button
                                            type="submit"
                                            id="submit-button"
                                            class="submit-button"
                                        >

                                            <i
                                                data-lucide="send"
                                                style="width:14px;height:14px;"
                                            ></i>

                                            Kirim Jawaban LKPD

                                        </button>

                                    </div>

                                </form>


                            @else

                                <div class="no-lkpd">

                                    <div class="no-lkpd-icon">

                                        <i
                                            data-lucide="file-question"
                                            style="width:20px;height:20px;"
                                        ></i>

                                    </div>

                                    <div class="no-lkpd-title">
                                        Belum ada soal
                                    </div>

                                    <div class="no-lkpd-text">
                                        Guru belum menambahkan pertanyaan
                                        pada LKPD ini.
                                    </div>

                                </div>

                            @endif

                        @endif

                    @endif

                </div>

            @endif

        </section>

    </main>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | GANTI KELAS
    |--------------------------------------------------------------------------
    | Full reload.
    | student_id selalu dihapus.
    |--------------------------------------------------------------------------
    */

    function ubahKelas(kelas)
    {
        const url = new URL(
            "{{ route('lkpd.index') }}",
            window.location.origin
        );

        url.searchParams.set(
            'pertemuan',
            "{{ $pertemuan }}"
        );

        if (kelas) {

            url.searchParams.set(
                'kelas',
                kelas
            );

        } else {

            url.searchParams.delete('kelas');

        }

        url.searchParams.delete(
            'student_id'
        );

        window.location.href =
            url.toString();
    }


    /*
    |--------------------------------------------------------------------------
    | SEARCH SISWA
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('cari_siswa');

    const results =
        document.getElementById('student-results');


    if (searchInput && results) {

        searchInput.addEventListener(
            'input',
            function () {

                const keyword =
                    this.value
                        .toLowerCase()
                        .trim();

                const students =
                    results.querySelectorAll(
                        '.student-result'
                    );

                let visible = 0;

                students.forEach(
                    function (student) {

                        const name =
                            String(
                                student.dataset.name || ''
                            ).toLowerCase();

                        const absen =
                            String(
                                student.dataset.absen || ''
                            ).toLowerCase();

                        const match =
                            keyword === '' ||
                            name.includes(keyword) ||
                            absen.includes(keyword);

                        student.style.display =
                            match
                                ? 'block'
                                : 'none';

                        if (match) {
                            visible++;
                        }

                    }
                );

                results.style.display =
                    visible > 0
                        ? 'block'
                        : 'none';

            }
        );


        /*
        |--------------------------------------------------------------------------
        | FOCUS NAMA
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener(
            'focus',
            function () {

                const first =
                    results.querySelector(
                        '.student-result'
                    );

                if (first) {

                    results.style.display =
                        'block';

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PILIH SISWA
    |--------------------------------------------------------------------------
    |
    | Jangan hanya mengganti tampilan menggunakan JavaScript.
    | Full reload supaya controller membaca database terbaru.
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll(
        '.student-result'
    ).forEach(
        function (button) {

            button.addEventListener(
                'click',
                function () {

                    const id =
                        this.dataset.id;

                    const kelas =
                        this.dataset.kelas;

                    if (!id || !kelas) {
                        return;
                    }

                    const url =
                        new URL(
                            "{{ route('lkpd.index') }}",
                            window.location.origin
                        );

                    url.searchParams.set(
                        'pertemuan',
                        "{{ $pertemuan }}"
                    );

                    url.searchParams.set(
                        'kelas',
                        kelas
                    );

                    url.searchParams.set(
                        'student_id',
                        id
                    );

                    /*
                    |--------------------------------------------------------------------------
                    | FULL RELOAD
                    |--------------------------------------------------------------------------
                    */

                    window.location.href =
                        url.toString();

                }
            );

        }
    );


    /*
    |--------------------------------------------------------------------------
    | TUTUP HASIL PENCARIAN
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const searchBox =
                document.querySelector(
                    '.search-box'
                );

            if (
                searchBox &&
                results &&
                !searchBox.contains(event.target) &&
                !results.contains(event.target)
            ) {

                results.style.display =
                    'none';

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | CEGAH SUBMIT TANPA KONFIRMASI
    |--------------------------------------------------------------------------
    */

    const lkpdForm =
        document.getElementById(
            'lkpd-form'
        );

    if (lkpdForm) {

        lkpdForm.addEventListener(
            'submit',
            function (event) {

                const confirmed =
                    confirm(
                        'Jawaban hanya dapat dikirim satu kali. Setelah dikirim, jawaban tidak dapat diubah atau dikirim ulang. Lanjutkan?'
                    );

                if (!confirmed) {

                    event.preventDefault();

                    return;

                }


                const button =
                    document.getElementById(
                        'submit-button'
                    );

                if (button) {

                    button.disabled = true;

                    button.innerHTML = `
                        <span
                            style="
                                width:14px;
                                height:14px;
                                border:2px solid rgba(255,255,255,.35);
                                border-top-color:#fff;
                                border-radius:50%;
                                display:inline-block;
                                animation:spin .7s linear infinite;
                            "
                        ></span>
                        Mengirim...
                    `;

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | LUCIDE
    |--------------------------------------------------------------------------
    */

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