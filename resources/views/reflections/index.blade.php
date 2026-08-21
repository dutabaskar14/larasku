<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
    >

    <title>Refleksi — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
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

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        button,
        a,
        select,
        input,
        textarea {
            -webkit-tap-highlight-color: transparent;
        }

        .student-main {
            min-height: 100vh;
        }

        /* =========================================================
           TOPBAR
        ========================================================== */

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

        /* =========================================================
           CONTAINER
        ========================================================== */

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

        /* =========================================================
           PERTEMUAN
        ========================================================== */

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
            scrollbar-width: none;
        }

        .meetings::-webkit-scrollbar {
            display: none;
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
            transition: .15s ease;
        }

        .meeting:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .meeting.active {
            border-color: #0f172a;
            background: #0f172a;
            color: #fff;
        }

        /* =========================================================
           NOTIFIKASI
        ========================================================== */

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

        /* =========================================================
           CARD UTAMA
        ========================================================== */

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

        /* =========================================================
           STATUS POJOK KANAN
        ========================================================== */

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
            line-height: 1.1;
        }

        .progress-mini span {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 8px;
            font-weight: 800;
            line-height: 1.1;
        }

        /* =========================================================
           FORM CONTENT
        ========================================================== */

        .form-content {
            padding: 18px 20px 22px;
        }

        /* =========================================================
           IDENTITAS
        ========================================================== */

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

        .field:last-child {
            margin-bottom: 0;
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
            transition: border-color .15s ease, box-shadow .15s ease;
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
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .08);
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

        /* =========================================================
           SEARCH SISWA
        ========================================================== */

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
            font-size: 13px;
            z-index: 2;
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
            box-shadow: 0 10px 24px rgba(15, 23, 42, .08);
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
            transition: background .15s ease;
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

        /* =========================================================
           PILIH SISWA
        ========================================================== */

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

        /* =========================================================
           PETUNJUK
        ========================================================== */

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

        /* =========================================================
           QUESTIONS
        ========================================================== */

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
            background: #fff;
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

        textarea {
            min-height: 105px;
            padding: 10px;
            resize: vertical;
            line-height: 1.55;
        }

        /* =========================================================
           SUBMIT
        ========================================================== */

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
            box-shadow: 0 7px 18px rgba(15, 23, 42, .16);
            transition: transform .12s ease, background .12s ease;
        }

        .submit-button:hover {
            background: #1e293b;
        }

        .submit-button:active {
            transform: translateY(1px);
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

        /* =========================================================
           SUBMITTED
        ========================================================== */

        .submitted-card {
            padding: 16px;
            border: 1px solid #bbf7d0;
            border-radius: 13px;
            background: linear-gradient(135deg, #f0fdf4, #fff);
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

        /* =========================================================
           WAITING
        ========================================================== */

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

        /* =========================================================
           NILAI
        ========================================================== */

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

        /* =========================================================
           LOCKED
        ========================================================== */

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

        /* =========================================================
           EMPTY
        ========================================================== */

        .no-reflection {
            padding: 30px 18px;
            text-align: center;
        }

        .no-reflection-icon {
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

        .no-reflection-title {
            color: #334155;
            font-size: 12px;
            font-weight: 850;
        }

        .no-reflection-text {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        /* =========================================================
           LOADING
        ========================================================== */

        .loading-screen {
            position: fixed;
            inset: 0;
            z-index: 100;
            display: none;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, .72);
            backdrop-filter: blur(3px);
        }

        .loading-box {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 11px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            font-size: 10px;
            font-weight: 800;
            box-shadow: 0 10px 25px rgba(15, 23, 42, .08);
        }

        .spinner {
            width: 15px;
            height: 15px;
            border: 2px solid #dbeafe;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin .7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* =========================================================
           DESKTOP SIDEBAR
        ========================================================== */

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

        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            .topbar {
                height: 58px;
                padding: 0 12px;
            }

            .brand {
                font-size: 17px;
            }

            .brand span {
                font-size: 8px;
            }

            .top-badge {
                padding: 6px 8px;
                font-size: 9px;
            }

            .container {
                width: calc(100% - 16px);
                padding: 15px 0 30px;
            }

            .heading {
                margin-bottom: 13px;
            }

            h1 {
                font-size: 24px;
            }

            .subtitle {
                font-size: 10px;
            }

            .meeting-wrapper {
                margin-bottom: 12px;
            }

            .meeting-title {
                font-size: 9px;
            }

            .meeting {
                min-width: 51px;
                padding: 7px 9px;
                font-size: 9px;
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

            .card-description {
                font-size: 10px;
            }

            .progress-mini {
                min-width: 61px;
                padding: 7px 7px;
            }

            .progress-mini strong {
                font-size: 14px;
            }

            .progress-mini span {
                font-size: 7px;
            }

            .student-box {
                padding: 11px;
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

            .student-result {
                padding: 9px 10px;
            }

            .student-name {
                font-size: 10px;
            }

            .student-info {
                font-size: 8px;
            }

            .choose-box {
                padding: 16px 12px;
            }

            .choose-title {
                font-size: 11px;
            }

            .choose-text {
                font-size: 9px;
            }

            .instruction {
                padding: 10px;
            }

            .instruction-text {
                font-size: 10px;
            }

            .question-card {
                padding: 11px;
            }

            .question-text {
                font-size: 11px;
            }

            textarea {
                min-height: 90px;
                font-size: 11px;
            }

            .submit-button {
                min-height: 43px;
            }

            .submitted-card {
                padding: 13px;
            }

            .submitted-title {
                font-size: 12px;
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

    {{-- =========================================================
         TOPBAR
    ========================================================== --}}

    <header class="topbar">

        <div class="brand">
            LARASKU
            <span>Pembelajaran Seni Musik</span>
        </div>

        <div class="top-badge">

            <i
                data-lucide="message-square-text"
                style="width:13px;height:13px;"
            ></i>

            Refleksi

        </div>

    </header>


    <main class="container">

        {{-- =========================================================
             HEADING
        ========================================================== --}}

        <section class="heading">

            <div class="eyebrow">
                LARASKU
            </div>

            <h1>
                Refleksi
            </h1>

            <p class="subtitle">
                Sampaikan refleksi pembelajaran yang tersedia dari guru.
            </p>

        </section>


        {{-- =========================================================
             DAFTAR PERTEMUAN
        ========================================================== --}}

        @if($pertemuans->count() > 0)

            <div class="meeting-wrapper">

                <div class="meeting-title">
                    Pertemuan tersedia
                </div>

                <div class="meetings">

                    @foreach($pertemuans as $item)

                        <a
                            href="{{ route('reflections.index', [
                                'pertemuan' => $item,
                                'kelas' => $kelas ?? '',
                                'student_id' => $selectedStudent->id ?? ''
                            ]) }}"
                            class="meeting {{ (int) $pertemuan === (int) $item ? 'active' : '' }}"
                        >
                            P{{ $item }}
                        </a>

                    @endforeach

                </div>

            </div>

        @endif


        {{-- =========================================================
             NOTIFIKASI SUKSES
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


        {{-- =========================================================
             ERROR
        ========================================================== --}}

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

            @if(!$reflection)

                {{-- =================================================
                     REFLEKSI TIDAK TERSEDIA
                ================================================== --}}

                <div class="no-reflection">

                    <div class="no-reflection-icon">

                        <i
                            data-lucide="message-square-off"
                            style="width:20px;height:20px;"
                        ></i>

                    </div>

                    <div class="no-reflection-title">
                        Belum ada refleksi
                    </div>

                    <div class="no-reflection-text">
                        Guru belum menyediakan refleksi aktif untuk
                        pertemuan ini.
                    </div>

                </div>

            @else

                {{-- =================================================
                     HEADER REFLEKSI
                ================================================== --}}

                <div class="card-header">

                    <div class="header-row">

                        <div>

                            <div class="meeting-label">
                                Pertemuan {{ $reflection->pertemuan }}
                            </div>

                            <h2 class="card-title">
                                {{ $reflection->judul }}
                            </h2>

                        </div>


                        {{-- =================================================
                             STATUS POJOK KANAN
                             BELUM PILIH = —
                             SUDAH TERKIRIM = ✓ TERKIRIM
                        ================================================== --}}

                        <div class="progress-mini">

                            @if($selectedStudent && $hasSubmitted)

                                <strong>
                                    ✓
                                </strong>

                                <span>
                                    TERKIRIM
                                </span>

                            @else

                                <strong>
                                    —
                                </strong>

                                <span>
                                    STATUS
                                </span>

                            @endif

                        </div>

                    </div>


                    @if($reflection->deskripsi)

                        <div class="card-description">
                            {{ $reflection->deskripsi }}
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


                        {{-- =================================================
                             KELAS
                        ================================================== --}}

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

                            {{-- =================================================
                                 NAMA
                            ================================================== --}}

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

                                        <div
                                            style="
                                                padding:10px;
                                                color:#94a3b8;
                                                font-size:10px;
                                            "
                                        >
                                            Tidak ada siswa pada kelas ini.
                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- =================================================
                                 ABSEN
                            ================================================== --}}

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


                        {{-- =================================================
                             SISWA TERPILIH
                        ================================================== --}}

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
                         BELUM PILIH SISWA
                         SOAL TIDAK DITAMPILKAN
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
                                Setelah nama dipilih, halaman akan memuat
                                ulang dan otomatis memeriksa status refleksi.
                                Pertanyaan belum ditampilkan sebelum siswa
                                dipilih.
                            </div>

                        </div>


                    @else


                        {{-- =================================================
                             SUDAH PERNAH DIKIRIM
                        ================================================== --}}

                        @if($hasSubmitted)

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
                                            Refleksi Sudah Dikumpulkan
                                        </div>

                                        <div class="submitted-name">
                                            {{ $selectedStudent->nama }}
                                            · No. Absen
                                            {{ $selectedStudent->nomor_absen }}
                                        </div>

                                    </div>

                                </div>


                                {{-- =================================================
                                     SUDAH DINILAI
                                ================================================== --}}

                                @if($hasBeenGraded)

                                    <div class="score-card">

                                        <div class="score-label">
                                            Nilai Refleksi
                                        </div>

                                        <div class="score-value">
                                            {{ $score }}
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
                                                Jawaban sudah berhasil
                                                dikumpulkan. Guru sedang
                                                melakukan penilaian.
                                            </div>

                                        </div>

                                    </div>

                                @endif


                                {{-- =================================================
                                     JAWABAN DIKUNCI
                                ================================================== --}}

                                <div class="locked-card">

                                    <i
                                        data-lucide="lock"
                                        style="width:13px;height:13px;"
                                    ></i>

                                    Jawaban tidak dapat dilihat,
                                    diubah, atau dikirim ulang.

                                </div>

                            </div>


                        {{-- =================================================
                             BELUM SUBMIT
                        ================================================== --}}

                        @else

                            @if($reflection->deskripsi)

                                <div class="instruction">

                                    <div class="instruction-label">
                                        Petunjuk
                                    </div>

                                    <div class="instruction-text">
                                        {{ $reflection->deskripsi }}
                                    </div>

                                </div>

                            @endif


                            {{-- =================================================
                                 PERTANYAAN
                            ================================================== --}}

                            @if($reflection->questions->count() > 0)

                                <form
                                    action="{{ route('reflections.store') }}"
                                    method="POST"
                                    id="reflection-form"
                                >

                                    @csrf


                                    <input
                                        type="hidden"
                                        name="pertemuan"
                                        value="{{ $reflection->pertemuan }}"
                                    >


                                    <input
                                        type="hidden"
                                        name="student_id"
                                        value="{{ $selectedStudent->id }}"
                                        id="student_id"
                                    >


                                    <div class="questions-heading">

                                        <div class="questions-title">
                                            Pertanyaan Refleksi
                                        </div>

                                        <div class="questions-count">
                                            {{ $reflection->questions->count() }}
                                            pertanyaan
                                        </div>

                                    </div>


                                    @foreach($reflection->questions as $question)

                                        <div class="question-card">

                                            <div class="question-number">
                                                {{ $question->urutan }}
                                            </div>

                                            <div class="question-text">
                                                {{ $question->pertanyaan }}
                                            </div>


                                            <textarea
                                                name="jawaban[{{ $question->id }}]"
                                                placeholder="Tulis jawabanmu di sini..."
                                                required
                                            ></textarea>

                                        </div>

                                    @endforeach


                                    <div class="required">

                                        <i
                                            data-lucide="alert-circle"
                                            style="
                                                width:13px;
                                                height:13px;
                                                vertical-align:-3px;
                                            "
                                        ></i>

                                        Semua pertanyaan wajib dijawab.
                                        Jawaban hanya dapat dikirim satu kali.

                                    </div>


                                    <div class="submit-area">

                                        <button
                                            type="submit"
                                            class="submit-button"
                                            id="submit-button"
                                        >

                                            <i
                                                data-lucide="send"
                                                style="width:14px;height:14px;"
                                            ></i>

                                            Kirim Jawaban Refleksi

                                        </button>

                                    </div>

                                </form>


                            @else

                                {{-- =================================================
                                     BELUM ADA SOAL
                                ================================================== --}}

                                <div class="no-reflection">

                                    <div class="no-reflection-icon">

                                        <i
                                            data-lucide="file-question"
                                            style="width:20px;height:20px;"
                                        ></i>

                                    </div>

                                    <div class="no-reflection-title">
                                        Belum ada pertanyaan
                                    </div>

                                    <div class="no-reflection-text">
                                        Guru belum menambahkan pertanyaan
                                        pada refleksi ini.
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


{{-- =========================================================
     LOADING
========================================================== --}}

<div
    id="loading-screen"
    class="loading-screen"
>

    <div class="loading-box">

        <div class="spinner"></div>

        Memuat data siswa...

    </div>

</div>


<script>

    /* =========================================================
       ICON
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
       LOADING
    ========================================================== */

    function showLoading()
    {
        const loading =
            document.getElementById(
                'loading-screen'
            );

        if (loading) {
            loading.style.display = 'flex';
        }
    }


    /* =========================================================
       GANTI KELAS
       - FULL RELOAD
       - STUDENT ID DIHAPUS
       - STATUS SISWA DI-RESET
    ========================================================== */

    function ubahKelas(kelas)
    {
        showLoading();

        const url =
            new URL(
                "{{ route('reflections.index') }}",
                window.location.origin
            );


        @if($pertemuan !== null)

            url.searchParams.set(
                'pertemuan',
                "{{ $pertemuan }}"
            );

        @endif


        if (kelas) {

            url.searchParams.set(
                'kelas',
                kelas
            );

        } else {

            url.searchParams.delete(
                'kelas'
            );

        }


        url.searchParams.delete(
            'student_id'
        );


        window.location.href =
            url.toString();
    }


    /* =========================================================
       SEARCH SISWA
    ========================================================== */

    const searchInput =
        document.getElementById(
            'cari_siswa'
        );

    const studentResults =
        document.getElementById(
            'student-results'
        );


    if (
        searchInput &&
        studentResults
    ) {

        searchInput.addEventListener(
            'focus',
            function () {

                if (
                    searchInput.disabled
                ) {
                    return;
                }

                filterStudents();

            }
        );


        searchInput.addEventListener(
            'input',
            function () {

                filterStudents();

            }
        );


        function filterStudents()
        {
            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();


            const students =
                studentResults.querySelectorAll(
                    '.student-result'
                );


            let visibleCount = 0;


            students.forEach(
                function (student) {

                    const name =
                        (
                            student.dataset.name
                            || ''
                        ).toLowerCase();

                    const absen =
                        (
                            student.dataset.absen
                            || ''
                        ).toLowerCase();


                    const match =
                        keyword === ''
                        ||
                        name.includes(keyword)
                        ||
                        absen.includes(keyword);


                    if (match) {

                        student.style.display =
                            'block';

                        visibleCount++;

                    } else {

                        student.style.display =
                            'none';

                    }

                }
            );


            if (
                students.length > 0 &&
                visibleCount > 0
            ) {

                studentResults.style.display =
                    'block';

            } else {

                studentResults.style.display =
                    'none';

            }

        }


        /* =====================================================
           PILIH NAMA SISWA
           FULL RELOAD
           SUPAYA STATUS SELALU DICEK DARI DATABASE
        ====================================================== */

        studentResults
            .querySelectorAll(
                '.student-result'
            )
            .forEach(
                function (button) {

                    button.addEventListener(
                        'click',
                        function () {

                            const studentId =
                                button.dataset.id;

                            const kelas =
                                button.dataset.kelas;


                            if (!studentId) {
                                return;
                            }


                            showLoading();


                            const url =
                                new URL(
                                    "{{ route('reflections.index') }}",
                                    window.location.origin
                                );


                            @if($pertemuan !== null)

                                url.searchParams.set(
                                    'pertemuan',
                                    "{{ $pertemuan }}"
                                );

                            @endif


                            if (kelas) {

                                url.searchParams.set(
                                    'kelas',
                                    kelas
                                );

                            }


                            url.searchParams.set(
                                'student_id',
                                studentId
                            );


                            window.location.href =
                                url.toString();

                        }
                    );

                }
            );


        /* =====================================================
           TUTUP DROPDOWN KETIKA KLIK DI LUAR
        ====================================================== */

        document.addEventListener(
            'click',
            function (event) {

                if (
                    !searchInput.contains(event.target) &&
                    !studentResults.contains(event.target)
                ) {

                    studentResults.style.display =
                        'none';

                }

            }
        );

    }


    /* =========================================================
       SUBMIT REFLEKSI
       CEGAH DOUBLE CLICK
    ========================================================== */

    const reflectionForm =
        document.getElementById(
            'reflection-form'
        );

    const submitButton =
        document.getElementById(
            'submit-button'
        );


    if (
        reflectionForm &&
        submitButton
    ) {

        reflectionForm.addEventListener(
            'submit',
            function () {

                submitButton.disabled =
                    true;

                submitButton.innerHTML = `
                    <div
                        class="spinner"
                        style="
                            width:14px;
                            height:14px;
                            border-width:2px;
                            border-color:rgba(255,255,255,.35);
                            border-top-color:#fff;
                        "
                    ></div>
                    Mengirim...
                `;

            }
        );

    }


    /* =========================================================
       SAAT HALAMAN DIMUAT DARI CACHE
       PASTIKAN STATUS TETAP FRESH
    ========================================================== */

    window.addEventListener(
        'pageshow',
        function (event) {

            if (
                event.persisted
            ) {

                window.location.reload();

            }

        }
    );

</script>

</body>

</html>