<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Pengumpulan Tugas — {{ $assignment->judul }}
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
        select {
            font: inherit;
        }

        a {
            text-decoration: none;
        }

        .page {
            width: 100%;
            max-width: 1440px;
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
            max-width: 800px;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.65;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
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
                background .18s ease,
                border-color .18s ease;
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

        .hero {
            overflow: hidden;
            margin-bottom: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow:
                0 10px 35px rgba(15,23,42,.055);
        }

        .hero-main {
            padding: 20px 22px;
        }

        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
            margin-bottom: 12px;
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

        .hero-title {
            margin: 0;
            color: #0f172a;
            font-size: 20px;
            line-height: 1.35;
            font-weight: 900;
        }

        .hero-subtitle {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .stats {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            border-top: 1px solid #eef2f7;
        }

        .stat {
            padding: 15px 18px;
            border-right: 1px solid #eef2f7;
        }

        .stat:last-child {
            border-right: 0;
        }

        .stat-label {
            color: #94a3b8;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .stat-value {
            margin-top: 5px;
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
        }

        .stat-value.pending {
            color: #b45309;
        }

        .stat-value.done {
            color: #047857;
        }

        .content {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 8px 28px rgba(15,23,42,.045);
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 16px 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .toolbar-left {
            min-width: 0;
        }

        .heading {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 900;
        }

        .description {
            margin: 4px 0 0;
            color: #94a3b8;
            font-size: 11px;
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search {
            width: 240px;
            height: 38px;
            padding: 0 11px;
            border: 1px solid #dbe3ed;
            border-radius: 10px;
            outline: none;
            color: #0f172a;
            background: #fff;
            font-size: 11px;
        }

        .search:focus {
            border-color: #818cf8;
            box-shadow:
                0 0 0 3px rgba(99,102,241,.10);
        }

        .filter {
            height: 38px;
            padding: 0 10px;
            border: 1px solid #dbe3ed;
            border-radius: 10px;
            outline: none;
            color: #475569;
            background: #fff;
            font-size: 11px;
            font-weight: 750;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 12px 16px;
            color: #94a3b8;
            background: #f8fafc;
            border-bottom: 1px solid #eef2f7;
            font-size: 9px;
            font-weight: 900;
            letter-spacing: .05em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        tbody tr {
            transition: background .15s ease;
        }

        tbody tr:hover {
            background: #fafbff;
        }

        tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #475569;
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .person {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 200px;
        }

        .avatar {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 10px;
            color: #4338ca;
            background: #e0e7ff;
            font-size: 11px;
            font-weight: 900;
        }

        .person-name {
            color: #334155;
            font-size: 11px;
            font-weight: 850;
        }

        .person-meta {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 9px;
        }

        .group-name {
            color: #334155;
            font-size: 11px;
            font-weight: 850;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 8px;
            border-radius: 8px;
            font-size: 9px;
            font-weight: 900;
            white-space: nowrap;
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

        .score {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 45px;
            height: 29px;
            padding: 0 8px;
            border-radius: 8px;
            color: #047857;
            background: #d1fae5;
            font-size: 11px;
            font-weight: 900;
        }

        .score.empty {
            color: #b45309;
            background: #fef3c7;
        }

        .date {
            color: #64748b;
            white-space: nowrap;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .action-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 31px;
            padding: 0 10px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            background: #fff;
            font-size: 10px;
            font-weight: 850;
        }

        .action-link:hover {
            color: #4338ca;
            border-color: #c7d2fe;
            background: #eef2ff;
        }

        .delete-btn {
            min-height: 31px;
            padding: 0 9px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #dc2626;
            background: #fff;
            font-size: 10px;
            font-weight: 850;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: #fef2f2;
        }

        .empty {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            margin: 0 auto 13px;
            border-radius: 14px;
            color: #6366f1;
            background: #eef2ff;
            font-size: 20px;
            font-weight: 900;
        }

        .empty-title {
            margin: 0;
            color: #334155;
            font-size: 13px;
            font-weight: 900;
        }

        .empty-text {
            max-width: 420px;
            margin: 6px auto 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-top: 18px;
            color: #94a3b8;
            font-size: 10px;
        }

        @media (max-width: 900px) {

            .stats {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .stat:nth-child(2) {
                border-right: 0;
            }

            .stat:nth-child(-n+2) {
                border-bottom: 1px solid #eef2f7;
            }

        }

        @media (max-width: 700px) {

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

            .toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .toolbar-right {
                width: 100%;
            }

            .search {
                width: 100%;
                flex: 1;
            }

            .filter {
                flex-shrink: 0;
            }

        }

        @media (max-width: 480px) {

            .stats {
                grid-template-columns: 1fr;
            }

            .stat {
                border-right: 0 !important;
                border-bottom: 1px solid #eef2f7;
            }

            .stat:last-child {
                border-bottom: 0;
            }

            .toolbar-right {
                flex-direction: column;
            }

            .search,
            .filter {
                width: 100%;
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

        /* Header/sidebar partial tetap menjadi shell utama. */
        .guru-shell .topbar {
            margin-bottom: 12px;
        }

        .guru-shell .hero,
        .guru-shell .content {
            min-width: 0;
        }

        /* Desktop: konten jangan terlalu jauh dari sidebar. */
        @media (min-width: 1181px) {
            .guru-shell > .page {
                padding-left: 18px;
                padding-right: 18px;
            }
        }

        /* Tablet */
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

        /* Mobile: sidebar partial dapat berubah menjadi mobile navigation. */
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
                href="{{ route('guru.assignments.show', $assignment) }}"
                class="back-link"
            >

                ← Kembali ke Kelola Tugas

            </a>


            <div class="eyebrow">

                <span class="eyebrow-dot"></span>

                Guru · Pengumpulan

            </div>


            <h1 class="title">
                Pengumpulan Tugas
            </h1>


            <p class="subtitle">

                Pantau seluruh pengumpulan siswa atau kelompok,
                periksa status penilaian, dan buka detail pekerjaan.

            </p>

        </div>


        <div class="top-actions">

            <a
                href="{{ route(
                    'guru.assignments.show',
                    $assignment
                ) }}"
                class="btn btn-secondary"
            >
                Kelola Tugas
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


    {{-- ============================================================
         HERO
    ============================================================= --}}

    <section class="hero">

        <div class="hero-main">

            <div class="meta-row">

                <span class="badge badge-blue">
                    Pertemuan {{ $assignment->pertemuan }}
                </span>

                <span class="badge badge-violet">
                    {{ $assignment->kelas }}
                </span>


                @if($assignment->mode_pengumpulan === 'kelompok')

                    <span class="badge badge-violet">
                        Kelompok
                    </span>

                @else

                    <span class="badge badge-blue">
                        Individu
                    </span>

                @endif


                @if($assignment->aktif)

                    <span class="badge badge-green">
                        Aktif
                    </span>

                @else

                    <span class="badge badge-gray">
                        Nonaktif
                    </span>

                @endif

            </div>


            <h2 class="hero-title">
                {{ $assignment->judul }}
            </h2>


            <p class="hero-subtitle">

                Batas waktu:

                @if($assignment->batas_waktu)

                    {{ $assignment->batas_waktu->format(
                        'd M Y, H:i'
                    ) }}
                    WIB

                @else

                    Tidak dibatasi

                @endif

            </p>

        </div>


        @php

            $total =
                $submissions->count();

            $completed =
                $submissions
                    ->where('status', 'selesai')
                    ->count();

            $pending =
                $submissions
                    ->where('status', '!=', 'selesai')
                    ->count();

        @endphp


        <div class="stats">


            <div class="stat">

                <div class="stat-label">
                    Total Pengumpulan
                </div>

                <div class="stat-value">
                    {{ $total }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    Menunggu Penilaian
                </div>

                <div class="stat-value pending">
                    {{ $pending }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    Selesai Dinilai
                </div>

                <div class="stat-value done">
                    {{ $completed }}
                </div>

            </div>


            <div class="stat">

                <div class="stat-label">
                    Mode
                </div>

                <div class="stat-value">

                    {{ ucfirst(
                        $assignment->mode_pengumpulan
                    ) }}

                </div>

            </div>

        </div>

    </section>


    {{-- ============================================================
         LIST
    ============================================================= --}}

    <section class="content">


        <div class="toolbar">

            <div class="toolbar-left">

                <h2 class="heading">
                    Daftar Pengumpulan
                </h2>

                <p class="description">
                    Klik "Lihat & Nilai" untuk membuka detail.
                </p>

            </div>


            <div class="toolbar-right">

                <input
                    type="search"
                    id="searchSubmission"
                    class="search"
                    placeholder="Cari siswa / kelompok..."
                    autocomplete="off"
                >


                <select
                    id="statusFilter"
                    class="filter"
                >

                    <option value="all">
                        Semua status
                    </option>

                    <option value="pending">
                        Belum dinilai
                    </option>

                    <option value="done">
                        Selesai
                    </option>

                </select>

            </div>

        </div>


        @if($submissions->count())


            <div class="table-wrap">

                <table>

                    <thead>

                        <tr>

                            <th>
                                {{ $assignment->mode_pengumpulan === 'kelompok'
                                    ? 'Kelompok'
                                    : 'Siswa'
                                }}
                            </th>

                            @if($assignment->mode_pengumpulan === 'kelompok')

                                <th>
                                    Anggota
                                </th>

                            @endif

                            <th>
                                Dikirim
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Nilai
                            </th>

                            <th>
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody id="submissionTable">

                        @foreach($submissions as $submission)

                            @php

                                $isDone =
                                    $submission->status === 'selesai';

                                if (
                                    $assignment->mode_pengumpulan === 'kelompok'
                                ) {

                                    $group =
                                        $submission->group;

                                    $groupName =
                                        $group
                                        ? 'Kelompok ' . $group->nomor_kelompok
                                        : 'Kelompok';

                                    $searchName =
                                        strtolower(
                                            $groupName
                                        );

                                } else {

                                    $student =
                                        $submission->student;

                                    $groupName =
                                        null;

                                    $searchName =
                                        strtolower(
                                            $student?->nama ?? 'Siswa'
                                        );

                                }

                                $submittedAt =
                                    $submission->submitted_at
                                    ?? $submission->created_at;

                            @endphp


                            <tr
                                class="submission-row"
                                data-name="{{ $searchName }}"
                                data-status="{{ $isDone ? 'done' : 'pending' }}"
                            >


                                {{-- IDENTITAS --}}

                                <td>

                                    <div class="person">


                                        <div class="avatar">

                                            @if(
                                                $assignment->mode_pengumpulan === 'kelompok'
                                            )

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

                                            <div class="person-name">

                                                @if(
                                                    $assignment->mode_pengumpulan === 'kelompok'
                                                )

                                                    {{ $groupName }}

                                                @else

                                                    {{ $submission->student?->nama ?? 'Siswa' }}

                                                @endif

                                            </div>


                                            <div class="person-meta">

                                                @if(
                                                    $assignment->mode_pengumpulan === 'kelompok'
                                                )

                                                    {{ $submission->group?->members?->count() ?? 0 }}
                                                    anggota

                                                @else

                                                    @if($submission->student?->kelas)

                                                        Kelas
                                                        {{ $submission->student->kelas }}

                                                    @else

                                                        Siswa

                                                    @endif

                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- ANGGOTA KELOMPOK --}}

                                @if(
                                    $assignment->mode_pengumpulan === 'kelompok'
                                )

                                    <td>

                                        <div>

                                            @if(
                                                $submission->group &&
                                                $submission->group->members->count()
                                            )

                                                @foreach(
                                                    $submission->group->members->take(3)
                                                    as $member
                                                )

                                                    <div
                                                        style="
                                                            color:#475569;
                                                            font-size:10px;
                                                            margin-bottom:2px;
                                                        "
                                                    >

                                                        {{ $member->student?->nama ?? 'Siswa' }}

                                                    </div>

                                                @endforeach


                                                @if(
                                                    $submission->group->members->count() > 3
                                                )

                                                    <div
                                                        style="
                                                            color:#94a3b8;
                                                            font-size:9px;
                                                        "
                                                    >

                                                        +
                                                        {{
                                                            $submission->group->members->count() - 3
                                                        }}
                                                        lainnya

                                                    </div>

                                                @endif

                                            @else

                                                <span
                                                    style="
                                                        color:#94a3b8;
                                                        font-size:10px;
                                                    "
                                                >
                                                    -
                                                </span>

                                            @endif

                                        </div>

                                    </td>

                                @endif


                                {{-- WAKTU --}}

                                <td>

                                    @if($submittedAt)

                                        <div class="date">

                                            {{ $submittedAt->format(
                                                'd M Y'
                                            ) }}

                                        </div>

                                        <div
                                            style="
                                                margin-top:3px;
                                                color:#94a3b8;
                                                font-size:9px;
                                            "
                                        >

                                            {{ $submittedAt->format(
                                                'H:i'
                                            ) }}
                                            WIB

                                        </div>

                                    @else

                                        <span
                                            style="
                                                color:#94a3b8;
                                            "
                                        >
                                            Belum ada waktu
                                        </span>

                                    @endif

                                </td>


                                {{-- STATUS --}}

                                <td>

                                    @if($isDone)

                                        <span
                                            class="
                                                status
                                                status-done
                                            "
                                        >

                                            <span class="status-dot"></span>

                                            Selesai

                                        </span>

                                    @else

                                        <span
                                            class="
                                                status
                                                status-pending
                                            "
                                        >

                                            <span class="status-dot"></span>

                                            Belum dinilai

                                        </span>

                                    @endif

                                </td>


                                {{-- NILAI --}}

                                <td>

                                    @if($submission->nilai !== null)

                                        <span class="score">

                                            {{
                                                number_format(
                                                    (float) $submission->nilai,
                                                    0
                                                )
                                            }}

                                        </span>

                                    @else

                                        <span class="score empty">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}

                                <td>

                                    <div class="actions">


                                        <a
                                            href="{{ route(
                                                'guru.assignments.submissions.show',
                                                [
                                                    $assignment,
                                                    $submission
                                                ]
                                            ) }}"
                                            class="action-link"
                                        >

                                            Lihat & Nilai

                                        </a>


                                        @if(!$isDone)

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'guru.assignments.submissions.destroy',
                                                    [
                                                        $assignment,
                                                        $submission
                                                    ]
                                                ) }}"
                                                onsubmit="return confirm(
                                                    'Hapus pengumpulan ini? Tindakan ini tidak dapat dibatalkan.'
                                                )"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="delete-btn"
                                                >

                                                    Hapus

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div
                id="emptyFilter"
                class="empty"
                style="display:none;"
            >

                <div class="empty-icon">
                    ?
                </div>

                <h3 class="empty-title">
                    Data tidak ditemukan
                </h3>

                <p class="empty-text">
                    Tidak ada pengumpulan yang sesuai dengan
                    pencarian atau filter yang dipilih.
                </p>

            </div>


        @else


            <div class="empty">

                <div class="empty-icon">
                    ✓
                </div>

                <h3 class="empty-title">
                    Belum ada pengumpulan
                </h3>

                <p class="empty-text">
                    Belum ada siswa atau kelompok yang mengirimkan
                    tugas ini.
                </p>

            </div>


        @endif


    </section>


    <div class="footer">

        <span>
            LARASKU · Pengelolaan Tugas
        </span>

        <span>
            {{ $assignment->kelas }}
            · Pertemuan {{ $assignment->pertemuan }}
        </span>

    </div>


</div>
</div>


<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            const search =
                document.getElementById(
                    'searchSubmission'
                );


            const filter =
                document.getElementById(
                    'statusFilter'
                );


            const rows =
                Array.from(
                    document.querySelectorAll(
                        '.submission-row'
                    )
                );


            const empty =
                document.getElementById(
                    'emptyFilter'
                );


            function applyFilter() {


                const query =
                    (search?.value || '')
                        .toLowerCase()
                        .trim();


                const status =
                    filter?.value || 'all';


                let visible = 0;


                rows.forEach(
                    function (row) {


                        const name =
                            row.dataset.name || '';


                        const rowStatus =
                            row.dataset.status || '';


                        const matchesName =
                            !query ||
                            name.includes(query);


                        const matchesStatus =
                            status === 'all' ||
                            rowStatus === status;


                        if (
                            matchesName &&
                            matchesStatus
                        ) {

                            row.style.display =
                                '';

                            visible++;

                        } else {

                            row.style.display =
                                'none';

                        }

                    }
                );


                if (empty) {

                    empty.style.display =
                        visible === 0
                            ? 'block'
                            : 'none';

                }

            }


            if (search) {

                search.addEventListener(
                    'input',
                    applyFilter
                );

            }


            if (filter) {

                filter.addEventListener(
                    'change',
                    applyFilter
                );

            }


        }
    );

</script>


</body>

</html>
