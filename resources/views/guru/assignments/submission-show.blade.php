<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Penilaian — {{ $assignment->judul }}
    </title>

    {{-- =====================================================
         GURU GLOBAL FONT / TAILWIND / LUCIDE
    ====================================================== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
            min-height: 100vh;
            color: #0f172a;
            background:
                linear-gradient(
                    180deg,
                    #f8fafc 0%,
                    #f1f5f9 100%
                );
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
        textarea {
            font: inherit;
        }

        a {
            text-decoration: none;
        }

        .page {
            width: 100%;
            max-width: 1180px;
            margin: 0 auto;
            padding: 28px 30px 60px;
        }

        .topbar {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 12px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
        }

        .back-link:hover {
            color: #4f46e5;
        }

        .eyebrow {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 7px;
            color: #64748b;
            font-size: 11px;
            font-weight: 850;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #6366f1;
            box-shadow:
                0 0 0 4px #e0e7ff;
        }

        .title {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -.035em;
        }

        .subtitle {
            max-width: 760px;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.65;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid transparent;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 850;
            cursor: pointer;
            transition:
                transform .18s ease,
                box-shadow .18s ease,
                background .18s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #fff;
            background:
                linear-gradient(
                    135deg,
                    #4f46e5,
                    #6366f1
                );
            box-shadow:
                0 8px 20px rgba(79,70,229,.18);
        }

        .btn-primary:hover {
            box-shadow:
                0 11px 25px rgba(79,70,229,.25);
        }

        .btn-success {
            color: #fff;
            background:
                linear-gradient(
                    135deg,
                    #059669,
                    #10b981
                );
            box-shadow:
                0 8px 20px rgba(5,150,105,.15);
        }

        .btn-success:hover {
            box-shadow:
                0 11px 25px rgba(5,150,105,.22);
        }

        .btn-secondary {
            color: #334155;
            background: #fff;
            border-color: #e2e8f0;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .alert {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 18px;
            padding: 13px 15px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 700;
        }

        .alert-success {
            color: #166534;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            color: #991b1b;
            background: #fef2f2;
            border: 1px solid #fecaca;
        }

        .alert-close {
            border: 0;
            padding: 0;
            color: inherit;
            background: transparent;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
        }

        .layout {
            display: grid;
            grid-template-columns:
                minmax(0, 1.35fr)
                minmax(320px, .75fr);
            gap: 18px;
            align-items: start;
        }

        .stack {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 8px 28px rgba(15,23,42,.045);
        }

        .card-header {
            padding: 17px 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .card-heading {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 900;
        }

        .card-description {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }

        .card-body {
            padding: 18px;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 14px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 850;
        }

        .badge-blue {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .badge-violet {
            color: #7e22ce;
            background: #f3e8ff;
        }

        .badge-green {
            color: #047857;
            background: #d1fae5;
        }

        .badge-amber {
            color: #b45309;
            background: #fef3c7;
        }

        .badge-gray {
            color: #475569;
            background: #f1f5f9;
        }

        .identity {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            border-radius: 13px;
            color: #4338ca;
            background: #e0e7ff;
            font-size: 14px;
            font-weight: 900;
        }

        .identity-name {
            color: #0f172a;
            font-size: 16px;
            font-weight: 900;
        }

        .identity-meta {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 10px;
        }

        .group-members {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .member {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 10px;
            border: 1px solid #eef2f7;
            border-radius: 9px;
            background: #fafbff;
        }

        .member-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            border-radius: 7px;
            color: #4338ca;
            background: #eef2ff;
            font-size: 9px;
            font-weight: 900;
        }

        .member-name {
            color: #334155;
            font-size: 11px;
            font-weight: 800;
        }

        .member-meta {
            margin-top: 2px;
            color: #94a3b8;
            font-size: 9px;
        }

        .submission-box {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .submission-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 13px;
            border-bottom: 1px solid #e2e8f0;
            background: #fff;
        }

        .submission-label {
            color: #475569;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .submission-time {
            color: #94a3b8;
            font-size: 9px;
        }

        .submission-content {
            padding: 15px;
        }

        .submission-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px;
            border: 1px solid #dbeafe;
            border-radius: 10px;
            color: #1d4ed8;
            background: #eff6ff;
            font-size: 11px;
            font-weight: 850;
            word-break: break-all;
        }

        .submission-link:hover {
            background: #dbeafe;
        }

        .submission-text {
            padding: 13px;
            border-radius: 10px;
            color: #475569;
            background: #fff;
            border: 1px solid #e2e8f0;
            font-size: 11px;
            line-height: 1.7;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .empty {
            padding: 28px 15px;
            color: #94a3b8;
            font-size: 11px;
            text-align: center;
        }

        .detail-list {
            display: flex;
            flex-direction: column;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 11px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .detail-row:last-child {
            border-bottom: 0;
        }

        .detail-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 750;
        }

        .detail-value {
            color: #334155;
            font-size: 11px;
            font-weight: 850;
            text-align: right;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: 900;
        }

        .status-pending {
            color: #b45309;
            background: #fef3c7;
        }

        .status-done {
            color: #047857;
            background: #d1fae5;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .score-current {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 76px;
            border-radius: 12px;
            color: #4338ca;
            background: #eef2ff;
        }

        .score-current-number {
            font-size: 30px;
            line-height: 1;
            font-weight: 950;
        }

        .score-current-label {
            margin-left: 6px;
            color: #6366f1;
            font-size: 10px;
            font-weight: 850;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 10px;
            font-weight: 850;
        }

        .input,
        .textarea {
            width: 100%;
            padding: 0 11px;
            color: #0f172a;
            background: #fff;
            border: 1px solid #dbe3ed;
            border-radius: 10px;
            outline: none;
            font-size: 12px;
        }

        .input {
            height: 42px;
        }

        .textarea {
            min-height: 125px;
            padding-top: 10px;
            padding-bottom: 10px;
            resize: vertical;
            line-height: 1.6;
        }

        .input:focus,
        .textarea:focus {
            border-color: #818cf8;
            box-shadow:
                0 0 0 3px rgba(99,102,241,.10);
        }

        .input-error {
            border-color: #fca5a5;
        }

        .field-error {
            margin-top: 5px;
            color: #dc2626;
            font-size: 9px;
            font-weight: 700;
        }

        .help {
            margin-top: 5px;
            color: #94a3b8;
            font-size: 9px;
            line-height: 1.5;
        }

        .grade-actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
        }

        .grade-actions .btn {
            width: 100%;
        }

        .warning {
            margin-top: 12px;
            padding: 11px 12px;
            border: 1px solid #fde68a;
            border-radius: 10px;
            color: #92400e;
            background: #fffbeb;
            font-size: 10px;
            line-height: 1.6;
        }

        .success-note {
            margin-top: 12px;
            padding: 11px 12px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            color: #166534;
            background: #f0fdf4;
            font-size: 10px;
            line-height: 1.6;
        }

        .instruction-box {
            padding: 13px;
            border-radius: 11px;
            color: #475569;
            background: #f8fafc;
            font-size: 11px;
            line-height: 1.7;
        }

        .instruction-box p:first-child {
            margin-top: 0;
        }

        .instruction-box p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 900px) {

            .layout {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 650px) {

            .page {
                padding: 20px 14px 45px;
            }

            .topbar {
                flex-direction: column;
            }

            .top-actions {
                width: 100%;
            }

            .top-actions .btn {
                flex: 1;
            }

            .title {
                font-size: 23px;
            }

        }


        /* =========================================================
           GURU SHELL — SAMA DENGAN DASHBOARD GURU
           Sidebar 220px | Header 58px | Konten tidak tertutup
        ========================================================= */

        html,
        body {
            min-height: 100%;
        }

        body {
            overflow-x: hidden;
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        .guru-shell {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            margin-left: 220px;
            padding-top: 58px;
            min-width: 0;
        }

        .guru-shell > .page {
            width: 100%;
            max-width: 1480px;
            margin: 0 auto;
            padding: 14px 20px 42px;
            min-width: 0;
        }

        .guru-shell .topbar {
            margin-bottom: 12px;
        }

        .guru-shell .layout {
            min-width: 0;
        }

        .guru-shell .card,
        .guru-shell .stack {
            min-width: 0;
        }

        @media (min-width: 1181px) {
            .guru-shell > .page {
                padding-left: 18px;
                padding-right: 18px;
            }
        }

        @media (max-width: 1180px) {
            .guru-shell {
                margin-left: 220px;
                padding-top: 58px;
            }

            .guru-shell > .page {
                padding-left: 16px;
                padding-right: 16px;
            }
        }

        @media (max-width: 1000px) {
            .guru-shell {
                margin-left: 0;
                padding-top: 58px;
            }

            .guru-shell > .page {
                padding: 14px 16px 38px;
            }
        }

        @media (max-width: 700px) {
            .guru-shell > .page {
                padding: 12px 14px 36px;
            }
        }

    </style>

</head>


<body class="min-h-screen text-slate-800">

@include('guru.partials.sidebar')
@include('guru.partials.header')

<div class="guru-shell">
<div class="page">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="topbar">

        <div>

            <a
                href="{{ route(
                    'guru.assignments.submissions.index',
                    $assignment
                ) }}"
                class="back-link"
            >

                ← Kembali ke Pengumpulan

            </a>


            <div class="eyebrow">

                <span class="eyebrow-dot"></span>

                Guru · Penilaian

            </div>


            <h1 class="title">
                Detail Pengumpulan
            </h1>


            <p class="subtitle">

                Periksa hasil pekerjaan, berikan nilai dan catatan,
                kemudian selesaikan penilaian.

            </p>

        </div>


        <div class="top-actions">

            <a
                href="{{ route(
                    'guru.assignments.submissions.index',
                    $assignment
                ) }}"
                class="btn btn-secondary"
            >
                Semua Pengumpulan
            </a>

        </div>

    </div>


    {{-- ============================================================
         FLASH
    ============================================================= --}}

    @if(session('success'))

        <div class="alert alert-success">

            <div>
                {{ session('success') }}
            </div>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-error">

            <div>

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

            </div>

            <button
                type="button"
                class="alert-close"
                onclick="this.parentElement.remove()"
            >
                ×
            </button>

        </div>

    @endif


    @php

        $isDone =
            $submission->status === 'selesai';

        $isGroup =
            $assignment->mode_pengumpulan === 'kelompok';

        $submittedAt =
            $submission->submitted_at
            ?? $submission->created_at;

    @endphp


    <div class="layout">


        {{-- ========================================================
             LEFT
        ========================================================= --}}

        <div class="stack">


            {{-- ====================================================
                 IDENTITAS
            ===================================================== --}}

            <section class="card">

                <div class="card-body">


                    <div class="meta-row">

                        <span class="badge badge-blue">
                            Pertemuan {{ $assignment->pertemuan }}
                        </span>

                        <span class="badge badge-violet">
                            {{ $assignment->kelas }}
                        </span>


                        @if($isGroup)

                            <span class="badge badge-violet">
                                Kelompok
                            </span>

                        @else

                            <span class="badge badge-blue">
                                Individu
                            </span>

                        @endif


                        @if($isDone)

                            <span class="badge badge-green">
                                Penilaian Selesai
                            </span>

                        @else

                            <span class="badge badge-amber">
                                Belum Dinilai
                            </span>

                        @endif

                    </div>


                    <div class="identity">


                        <div class="avatar">

                            @if($isGroup)

                                K{{ $submission->group?->nomor_kelompok ?? '?' }}

                            @else

                                {{
                                    strtoupper(
                                        mb_substr(
                                            $submission->student?->nama ?? 'S',
                                            0,
                                            1
                                        )
                                    )
                                }}

                            @endif

                        </div>


                        <div>

                            <div class="identity-name">

                                @if($isGroup)

                                    Kelompok
                                    {{ $submission->group?->nomor_kelompok ?? '' }}

                                @else

                                    {{ $submission->student?->nama ?? 'Siswa' }}

                                @endif

                            </div>


                            <div class="identity-meta">

                                @if($isGroup)

                                    {{
                                        $submission
                                            ->group
                                            ?->members
                                            ?->count() ?? 0
                                    }}
                                    anggota

                                @else

                                    @if($submission->student?->kelas)

                                        Kelas
                                        {{ $submission->student->kelas }}

                                    @else

                                        Siswa

                                    @endif

                                @endif

                                @if($submittedAt)

                                    · Dikirim
                                    {{ $submittedAt->format(
                                        'd M Y, H:i'
                                    ) }}
                                    WIB

                                @endif

                            </div>

                        </div>

                    </div>


                    @if($isGroup && $submission->group)

                        <div class="group-members">

                            @foreach(
                                $submission->group->members
                                as $index => $member
                            )

                                <div class="member">

                                    <div class="member-number">
                                        {{ $index + 1 }}
                                    </div>


                                    <div>

                                        <div class="member-name">

                                            {{ $member->student?->nama ?? 'Siswa' }}

                                        </div>


                                        <div class="member-meta">

                                            @if($member->student?->kelas)

                                                Kelas
                                                {{ $member->student->kelas }}

                                            @endif

                                            @if(
                                                $member->student?->nomor_absen !== null
                                            )

                                                · Absen
                                                {{ $member->student->nomor_absen }}

                                            @endif

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

            </section>


            {{-- ====================================================
                 HASIL PENGUMPULAN
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <h2 class="card-heading">
                        Hasil Pengumpulan
                    </h2>

                    <p class="card-description">
                        Materi yang dikirim oleh
                        {{ $isGroup ? 'kelompok' : 'siswa' }}.
                    </p>

                </div>


                <div class="card-body">


                    <div class="submission-box">


                        <div class="submission-head">

                            <span class="submission-label">
                                Pengumpulan
                            </span>


                            @if($submittedAt)

                                <span class="submission-time">

                                    {{ $submittedAt->format(
                                        'd M Y, H:i'
                                    ) }}
                                    WIB

                                </span>

                            @endif

                        </div>


                        <div class="submission-content">


                            @php

                                $url =
                                    $submission->link_pengumpulan
                                    ?? $submission->link
                                    ?? null;

                                $text =
                                    $submission->jawaban
                                    ?? $submission->isi
                                    ?? $submission->keterangan
                                    ?? null;

                                $file =
                                    $submission->file
                                    ?? $submission->file_path
                                    ?? null;

                            @endphp


                            @if($url)

                                <a
                                    href="{{ $url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="submission-link"
                                >

                                    <span>
                                        Buka Link Pengumpulan
                                    </span>

                                    <span>
                                        ↗
                                    </span>

                                </a>

                            @elseif($file)

                                <a
                                    href="{{ asset(
                                        'storage/' . ltrim(
                                            $file,
                                            '/'
                                        )
                                    ) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="submission-link"
                                >

                                    <span>
                                        Buka File Pengumpulan
                                    </span>

                                    <span>
                                        ↗
                                    </span>

                                </a>

                            @elseif($text)

                                <div class="submission-text">

                                    {{ $text }}

                                </div>

                            @else

                                <div class="empty">

                                    Belum ada isi pengumpulan
                                    yang dapat ditampilkan.

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </section>


            {{-- ====================================================
                 INSTRUKSI TUGAS
            ===================================================== --}}

            @if($assignment->instruksi)

                <section class="card">

                    <div class="card-header">

                        <h2 class="card-heading">
                            Instruksi Tugas
                        </h2>

                    </div>


                    <div class="card-body">

                        <div class="instruction-box">

                            {!! $assignment->instruksi !!}

                        </div>

                    </div>

                </section>

            @endif


        </div>


        {{-- ========================================================
             RIGHT
        ========================================================= --}}

        <div class="stack">


            {{-- ====================================================
                 STATUS
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <h2 class="card-heading">
                        Status Penilaian
                    </h2>

                </div>


                <div class="card-body">


                    @if($isDone)

                        <div
                            class="
                                status
                                status-done
                            "
                            style="
                                width:100%;
                                justify-content:center;
                                min-height:38px;
                            "
                        >

                            <span class="status-dot"></span>

                            Penilaian sudah selesai

                        </div>

                    @else

                        <div
                            class="
                                status
                                status-pending
                            "
                            style="
                                width:100%;
                                justify-content:center;
                                min-height:38px;
                            "
                        >

                            <span class="status-dot"></span>

                            Menunggu penilaian

                        </div>

                    @endif


                </div>

            </section>


            {{-- ====================================================
                 NILAI SAAT INI
            ===================================================== --}}

            @if($submission->nilai !== null)

                <section class="card">

                    <div class="card-header">

                        <h2 class="card-heading">
                            Nilai Saat Ini
                        </h2>

                    </div>


                    <div class="card-body">

                        <div class="score-current">

                            <span
                                class="score-current-number"
                            >

                                {{
                                    number_format(
                                        (float) $submission->nilai,
                                        0
                                    )
                                }}

                            </span>

                            <span class="score-current-label">
                                / 100
                            </span>

                        </div>


                        @if($submission->catatan_guru)

                            <div
                                style="
                                    margin-top:12px;
                                    color:#64748b;
                                    font-size:10px;
                                    line-height:1.6;
                                "
                            >

                                <strong>
                                    Catatan guru:
                                </strong>

                                <div style="margin-top:4px;">

                                    {{
                                        $submission->catatan_guru
                                    }}

                                </div>

                            </div>

                        @endif

                    </div>

                </section>

            @endif


            {{-- ====================================================
                 FORM PENILAIAN
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <h2 class="card-heading">
                        Penilaian
                    </h2>

                    <p class="card-description">

                        @if($isDone)

                            Penilaian telah dikunci.

                        @else

                            Simpan nilai terlebih dahulu,
                            kemudian selesaikan penilaian.

                        @endif

                    </p>

                </div>


                <div class="card-body">


                    @if($isDone)


                        <div class="success-note">

                            Penilaian sudah diselesaikan pada:

                            @if($submission->graded_at)

                                {{
                                    $submission->graded_at->format(
                                        'd M Y, H:i'
                                    )
                                }}
                                WIB

                            @else

                                waktu yang tercatat sistem.

                            @endif

                        </div>


                    @else


                        {{-- SIMPAN NILAI --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'guru.assignments.submissions.grade',
                                [
                                    $assignment,
                                    $submission
                                ]
                            ) }}"
                        >

                            @csrf

                            @method('PATCH')


                            <div class="form-group">

                                <label
                                    for="nilai"
                                    class="label"
                                >
                                    Nilai
                                </label>


                                <input
                                    type="number"
                                    id="nilai"
                                    name="nilai"
                                    class="
                                        input
                                        @error('nilai')
                                            input-error
                                        @enderror
                                    "
                                    min="0"
                                    max="100"
                                    step="0.01"
                                    value="{{ old(
                                        'nilai',
                                        $submission->nilai
                                    ) }}"
                                    placeholder="0 - 100"
                                    required
                                >


                                <div class="help">
                                    Masukkan nilai antara 0 sampai 100.
                                </div>


                                @error('nilai')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <div class="form-group">

                                <label
                                    for="catatan_guru"
                                    class="label"
                                >
                                    Catatan Guru
                                </label>


                                <textarea
                                    id="catatan_guru"
                                    name="catatan_guru"
                                    class="
                                        textarea
                                        @error('catatan_guru')
                                            input-error
                                        @enderror
                                    "
                                    maxlength="10000"
                                    placeholder="Berikan catatan atau umpan balik..."
                                >{{ old(
                                    'catatan_guru',
                                    $submission->catatan_guru
                                ) }}</textarea>


                                @error('catatan_guru')

                                    <div class="field-error">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <button
                                type="submit"
                                class="btn btn-primary"
                                style="width:100%;"
                            >

                                Simpan Nilai

                            </button>

                        </form>


                        {{-- SELESAIKAN --}}

                        <form
                            method="POST"
                            action="{{ route(
                                'guru.assignments.submissions.complete',
                                [
                                    $assignment,
                                    $submission
                                ]
                            ) }}"
                            onsubmit="return confirm(
                                'Selesaikan penilaian ini? Setelah selesai, submission tidak dapat dihapus lagi.'
                            )"
                            style="margin-top:9px;"
                        >

                            @csrf

                            @method('PATCH')


                            <button
                                type="submit"
                                class="btn btn-success"
                                style="width:100%;"
                            >

                                ✓ Selesaikan Penilaian

                            </button>

                        </form>


                        <div class="warning">

                            Setelah penilaian diselesaikan,
                            status akan berubah menjadi
                            <strong>Selesai</strong>.
                            Submission juga tidak dapat dihapus
                            melalui sistem.

                        </div>


                    @endif

                </div>

            </section>


            {{-- ====================================================
                 DETAIL TUGAS
            ===================================================== --}}

            <section class="card">

                <div class="card-header">

                    <h2 class="card-heading">
                        Detail Tugas
                    </h2>

                </div>


                <div class="card-body">

                    <div class="detail-list">


                        <div class="detail-row">

                            <span class="detail-label">
                                Judul
                            </span>

                            <span class="detail-value">
                                {{ $assignment->judul }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Kelas
                            </span>

                            <span class="detail-value">
                                {{ $assignment->kelas }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Pertemuan
                            </span>

                            <span class="detail-value">
                                {{ $assignment->pertemuan }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Mode
                            </span>

                            <span class="detail-value">
                                {{ ucfirst(
                                    $assignment->mode_pengumpulan
                                ) }}
                            </span>

                        </div>


                        <div class="detail-row">

                            <span class="detail-label">
                                Deadline
                            </span>

                            <span class="detail-value">

                                @if($assignment->batas_waktu)

                                    {{ $assignment->batas_waktu->format(
                                        'd M Y H:i'
                                    ) }}
                                    WIB

                                @else

                                    Tidak dibatasi

                                @endif

                            </span>

                        </div>


                    </div>

                </div>

            </section>


        </div>

    </div>


</div>
</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            const nilai =
                document.getElementById(
                    'nilai'
                );


            if (nilai) {

                nilai.addEventListener(
                    'input',
                    function () {

                        let value =
                            parseFloat(
                                this.value
                            );


                        if (
                            !Number.isNaN(value)
                        ) {

                            if (value > 100) {

                                this.value = 100;

                            }

                            if (value < 0) {

                                this.value = 0;

                            }

                        }

                    }
                );

            }


            const forms =
                document.querySelectorAll(
                    'form'
                );


            forms.forEach(
                function (form) {

                    form.addEventListener(
                        'submit',
                        function () {

                            const button =
                                form.querySelector(
                                    'button[type="submit"]'
                                );


                            if (button) {

                                setTimeout(
                                    function () {

                                        button.disabled =
                                            true;

                                        button.style.opacity =
                                            '.7';

                                    },
                                    10
                                );

                            }

                        }
                    );

                }
            );


        }
    );

</script>


</body>

</html>