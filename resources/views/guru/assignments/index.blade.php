{{-- resources/views/guru/assignments/index.blade.php --}}

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tugas Pengumpulan — Guru</title>

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
            background:
                linear-gradient(
                    180deg,
                    #f8fafc 0%,
                    #f1f5f9 100%
                );
            color: #0f172a;
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

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            text-decoration: none;
        }

        .assignment-page {
            width: 100%;
            max-width: none;
            margin: 0;
            padding: 0 0 50px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 24px;
        }

        .heading-wrap {
            min-width: 0;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 7px;
        }

        .eyebrow-dot {
            width: 7px;
            height: 7px;
            border-radius: 999px;
            background: #6366f1;
            box-shadow: 0 0 0 4px #e0e7ff;
        }

        .page-title {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            line-height: 1.2;
            font-weight: 850;
            letter-spacing: -.035em;
        }

        .page-subtitle {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .top-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-shrink: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 16px;
            border: 1px solid transparent;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            line-height: 1;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
            transition:
                transform .18s ease,
                box-shadow .18s ease,
                background .18s ease,
                border-color .18s ease,
                color .18s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            color: #fff;
            background: linear-gradient(
                135deg,
                #4f46e5,
                #6366f1
            );
            box-shadow:
                0 8px 20px rgba(79, 70, 229, .18);
        }

        .btn-primary:hover {
            box-shadow:
                0 11px 25px rgba(79, 70, 229, .25);
        }

        .btn-secondary {
            color: #334155;
            background: #fff;
            border-color: #dbe3ed;
            box-shadow: 0 4px 12px rgba(15, 23, 42, .035);
        }

        .btn-secondary:hover {
            color: #4338ca;
            background: #f8faff;
            border-color: #c7d2fe;
            box-shadow: 0 8px 18px rgba(79, 70, 229, .08);
        }

        .btn-meetings .icon {
            color: #4f46e5;
        }

        .icon {
            width: 17px;
            height: 17px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns:
                repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            min-height: 112px;
            padding: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: rgba(255,255,255,.92);
            box-shadow:
                0 8px 28px rgba(15, 23, 42, .045);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -28px;
            bottom: -30px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #eef2ff;
            opacity: .8;
        }

        .stat-label {
            position: relative;
            z-index: 1;
            color: #64748b;
            font-size: 12px;
            font-weight: 750;
        }

        .stat-value {
            position: relative;
            z-index: 1;
            margin-top: 8px;
            color: #0f172a;
            font-size: 27px;
            line-height: 1;
            font-weight: 850;
            letter-spacing: -.04em;
        }

        .filter-card {
            margin-bottom: 20px;
            padding: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 8px 28px rgba(15, 23, 42, .045);
        }

        .filter-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 14px;
        }

        .filter-title {
            margin: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 850;
        }

        .filter-grid {
            display: grid;
            grid-template-columns:
                minmax(180px, 1.2fr)
                minmax(150px, 1fr)
                minmax(170px, 1fr)
                minmax(160px, 1fr)
                auto;
            gap: 11px;
            align-items: end;
        }

        .field {
            min-width: 0;
        }

        .field-label {
            display: block;
            margin-bottom: 6px;
            color: #475569;
            font-size: 11px;
            font-weight: 800;
        }

        .field-control {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            color: #0f172a;
            background: #f8fafc;
            border: 1px solid #dbe3ed;
            border-radius: 11px;
            outline: none;
            transition:
                border-color .18s ease,
                box-shadow .18s ease,
                background .18s ease;
        }

        .field-control:focus {
            background: #fff;
            border-color: #818cf8;
            box-shadow:
                0 0 0 3px rgba(99,102,241,.10);
        }

        .filter-actions {
            display: flex;
            gap: 8px;
        }

        .filter-actions .btn {
            white-space: nowrap;
        }

        .assignment-card {
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            background: #fff;
            box-shadow:
                0 10px 35px rgba(15, 23, 42, .055);
        }

        .assignment-card-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 18px 20px;
            border-bottom: 1px solid #eef2f7;
        }

        .section-title {
            margin: 0;
            color: #0f172a;
            font-size: 16px;
            font-weight: 850;
        }

        .section-description {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
        }

        .result-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 28px;
            padding: 0 9px;
            border-radius: 9px;
            color: #4338ca;
            background: #eef2ff;
            font-size: 12px;
            font-weight: 850;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .assignment-table {
            width: 100%;
            min-width: 920px;
            border-collapse: collapse;
        }

        .assignment-table th {
            padding: 12px 17px;
            color: #64748b;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .06em;
            text-align: left;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .assignment-table td {
            padding: 15px 17px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .assignment-table tbody tr {
            transition: background .16s ease;
        }

        .assignment-table tbody tr:hover {
            background: #fafbff;
        }

        .assignment-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .meeting-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 48px;
            padding: 6px 9px;
            border-radius: 9px;
            color: #4338ca;
            background: #eef2ff;
            font-size: 11px;
            font-weight: 850;
            white-space: nowrap;
        }

        .class-name {
            color: #334155;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .assignment-title {
            max-width: 340px;
            color: #0f172a;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.4;
        }

        .assignment-instruction {
            max-width: 340px;
            margin-top: 3px;
            overflow: hidden;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.45;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .mode-badge,
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 9px;
            border-radius: 9px;
            font-size: 10px;
            font-weight: 850;
            white-space: nowrap;
        }

        .mode-individu {
            color: #0369a1;
            background: #e0f2fe;
        }

        .mode-kelompok {
            color: #7e22ce;
            background: #f3e8ff;
        }

        .status-active {
            color: #047857;
            background: #d1fae5;
        }

        .status-inactive {
            color: #64748b;
            background: #f1f5f9;
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: currentColor;
        }

        .deadline {
            color: #475569;
            font-size: 11px;
            line-height: 1.45;
            white-space: nowrap;
        }

        .deadline.late {
            color: #dc2626;
            font-weight: 800;
        }

        .count-cell {
            color: #334155;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .count-muted {
            color: #94a3b8;
            font-weight: 700;
        }

        .row-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 7px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            color: #475569;
            background: #fff;
            cursor: pointer;
            transition:
                background .16s ease,
                border-color .16s ease,
                color .16s ease,
                transform .16s ease;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            color: #4338ca;
            background: #eef2ff;
            border-color: #c7d2fe;
        }

        .action-btn.danger:hover {
            color: #dc2626;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .empty-state {
            padding: 60px 25px;
            text-align: center;
        }

        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin: 0 auto 14px;
            border-radius: 16px;
            color: #6366f1;
            background: #eef2ff;
        }

        .empty-title {
            margin: 0;
            color: #0f172a;
            font-size: 16px;
            font-weight: 850;
        }

        .empty-text {
            max-width: 450px;
            margin: 7px auto 18px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .pagination-wrap {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            padding: 15px 20px;
            border-top: 1px solid #eef2f7;
        }

        .pagination-info {
            color: #64748b;
            font-size: 11px;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .page-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 32px;
            height: 32px;
            padding: 0 8px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            background: #fff;
            font-size: 11px;
            font-weight: 800;
        }

        .page-link:hover {
            color: #4338ca;
            background: #eef2ff;
            border-color: #c7d2fe;
        }

        .page-link.active {
            color: #fff;
            background: #4f46e5;
            border-color: #4f46e5;
        }

        .page-link.disabled {
            opacity: .45;
            pointer-events: none;
        }

        .flash {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 18px;
            padding: 12px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            color: #166534;
            background: #f0fdf4;
            font-size: 12px;
            font-weight: 700;
        }

        .flash-close {
            border: 0;
            color: inherit;
            background: transparent;
            cursor: pointer;
            font-size: 17px;
            opacity: .7;
        }

        .meeting-panel {
            margin-top: 20px;
            padding: 18px;
            border: 1px solid #e2e8f0;
            border-radius: 17px;
            background: #fff;
            box-shadow:
                0 8px 28px rgba(15, 23, 42, .045);
        }

        .meeting-grid {
            display: grid;
            grid-template-columns:
                repeat(auto-fill, minmax(220px, 1fr));
            gap: 10px;
            margin-top: 14px;
        }

        .meeting-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #f8fafc;
        }

        .meeting-main {
            min-width: 0;
        }

        .meeting-number {
            color: #0f172a;
            font-size: 12px;
            font-weight: 850;
        }

        .meeting-class {
            margin-top: 3px;
            color: #64748b;
            font-size: 10px;
        }

        .meeting-status {
            flex-shrink: 0;
            padding: 5px 8px;
            border-radius: 8px;
            color: #047857;
            background: #d1fae5;
            font-size: 9px;
            font-weight: 850;
        }

        .meeting-status.off {
            color: #64748b;
            background: #e2e8f0;
        }

        @media (max-width: 1100px) {

            .filter-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

            .filter-actions {
                grid-column: span 2;
            }

            .stats-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 760px) {

            .assignment-page {
                padding: 0 0 40px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .top-actions {
                width: 100%;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .top-actions .btn {
                width: 100%;
            }

            .page-title {
                font-size: 23px;
            }

            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 9px;
            }

            .stat-card {
                min-height: 98px;
                padding: 14px;
            }

            .stat-value {
                font-size: 23px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: auto;
            }

            .filter-actions .btn {
                flex: 1;
            }

            .assignment-card-head {
                align-items: flex-start;
            }

            .pagination-wrap {
                align-items: flex-start;
                flex-direction: column;
            }

        }

        @media (max-width: 450px) {

            .top-actions {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .filter-card,
            .assignment-card,
            .meeting-panel {
                border-radius: 14px;
            }

            .assignment-card-head,
            .filter-card,
            .meeting-panel {
                padding: 15px;
            }

        }


        /* =========================================================
           FITUR ASSIGNMENT
        ========================================================== */

        .assignment-features {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 20px;
        }

        .assignment-feature {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            min-width: 0;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 6px 22px rgba(15, 23, 42, .035);
            transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
        }

        .assignment-feature:hover {
            transform: translateY(-1px);
            border-color: #c7d2fe;
            box-shadow: 0 9px 26px rgba(79, 70, 229, .07);
        }

        .assignment-feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            min-width: 38px;
            border-radius: 11px;
            color: #4f46e5;
            background: #eef2ff;
        }

        .assignment-feature-title {
            margin: 0;
            color: #0f172a;
            font-size: 12px;
            font-weight: 850;
            line-height: 1.35;
        }

        .assignment-feature-text {
            margin: 3px 0 0;
            color: #64748b;
            font-size: 10px;
            line-height: 1.45;
        }

        .assignment-feature-link {
            display: inline-flex;
            margin-top: 6px;
            color: #4f46e5;
            font-size: 10px;
            font-weight: 800;
        }

        @media (max-width: 1100px) {
            .assignment-features {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 560px) {
            .assignment-features {
                grid-template-columns: 1fr;
            }
        }

    </style>

</head>


<body class="min-h-screen text-slate-800">

<div class="flex min-h-screen">

    {{-- =====================================================
         SIDEBAR GLOBAL
    ====================================================== --}}

    @include('guru.partials.sidebar')

    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main class="flex-1 lg:ml-[220px]">

        {{-- =================================================
             HEADBAR GURU
        ================================================== --}}

        @include('guru.partials.header')

        {{-- =================================================
             CONTENT
        ================================================== --}}

        <div class="p-5 lg:p-8 max-w-7xl mx-auto">

            <div class="assignment-page">

    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="topbar">

        <div class="heading-wrap">

            <div class="eyebrow">
                <span class="eyebrow-dot"></span>
                Guru · Pengumpulan Tugas
            </div>

            <h1 class="page-title">
                Tugas Pengumpulan
            </h1>

            <p class="page-subtitle">
                Kelola tugas, pertemuan, kelompok, pengumpulan, dan penilaian siswa.
            </p>

        </div>


        <div class="top-actions">

            <a
                href="{{ route('guru.assignments.meetings.index') }}"
                class="btn btn-secondary btn-meetings"
                title="Kelola pertemuan tugas"
            >
                <span class="icon">
                    <svg
                        width="16"
                        height="16"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <rect x="3" y="4" width="18" height="17" rx="2"/>
                        <path d="M16 2v4"/>
                        <path d="M8 2v4"/>
                        <path d="M3 10h18"/>
                        <path d="M8 14h.01"/>
                        <path d="M12 14h.01"/>
                        <path d="M16 14h.01"/>
                        <path d="M8 18h.01"/>
                        <path d="M12 18h.01"/>
                    </svg>
                </span>

                Kelola Pertemuan
            </a>

            <a
                href="{{ route('guru.assignments.create') }}"
                class="btn btn-primary"
            >
                <span class="icon">
                    +
                </span>

                Tambah Tugas
            </a>

        </div>

    </div>


    {{-- ============================================================
         FLASH SUCCESS
    ============================================================= --}}

    @if(session('success'))

        <div
            class="flash"
            id="flashMessage"
        >

            <span>
                {{ session('success') }}
            </span>

            <button
                type="button"
                class="flash-close"
                onclick="document.getElementById('flashMessage').remove()"
            >
                ×
            </button>

        </div>

    @endif


    {{-- ============================================================
         STATISTIK
    ============================================================= --}}

    <div class="stats-grid">

        <div class="stat-card">

            <div class="stat-label">
                Total Tugas
            </div>

            <div class="stat-value">
                {{ $assignments->total() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Tugas Aktif
            </div>

            <div class="stat-value">
                {{ $assignments->getCollection()->where('aktif', true)->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Individu
            </div>

            <div class="stat-value">
                {{ $assignments->getCollection()->where('mode_pengumpulan', 'individu')->count() }}
            </div>

        </div>


        <div class="stat-card">

            <div class="stat-label">
                Kelompok
            </div>

            <div class="stat-value">
                {{ $assignments->getCollection()->where('mode_pengumpulan', 'kelompok')->count() }}
            </div>

        </div>

    </div>


    {{-- ============================================================
         FITUR ASSIGNMENT
    ============================================================= --}}

    <div class="assignment-features">

        <a
            href="{{ route('guru.assignments.meetings.index') }}"
            class="assignment-feature"
        >
            <span class="assignment-feature-icon">
                <i data-lucide="calendar-days" class="w-4 h-4"></i>
            </span>

            <span>
                <span class="assignment-feature-title">
                    Pertemuan Tugas
                </span>

                <span class="assignment-feature-text">
                    Buat dan kelola nomor pertemuan untuk tugas.
                </span>

                <span class="assignment-feature-link">
                    Kelola pertemuan →
                </span>
            </span>
        </a>


        <a
            href="{{ route('guru.assignments.create') }}"
            class="assignment-feature"
        >
            <span class="assignment-feature-icon">
                <i data-lucide="file-plus-2" class="w-4 h-4"></i>
            </span>

            <span>
                <span class="assignment-feature-title">
                    Buat Tugas
                </span>

                <span class="assignment-feature-text">
                    Tugas individu atau kelompok dengan instruksi dan tenggat.
                </span>

                <span class="assignment-feature-link">
                    Tambah tugas →
                </span>
            </span>
        </a>


        <div class="assignment-feature">
            <span class="assignment-feature-icon">
                <i data-lucide="users-round" class="w-4 h-4"></i>
            </span>

            <span>
                <span class="assignment-feature-title">
                    Kelompok & Anggota
                </span>

                <span class="assignment-feature-text">
                    Kelola kelompok, tambah siswa, dan atur anggota kelompok.
                </span>

                <span class="assignment-feature-link">
                    Dari detail tugas
                </span>
            </span>
        </div>


        <div class="assignment-feature">
            <span class="assignment-feature-icon">
                <i data-lucide="clipboard-check" class="w-4 h-4"></i>
            </span>

            <span>
                <span class="assignment-feature-title">
                    Pengumpulan & Nilai
                </span>

                <span class="assignment-feature-text">
                    Lihat submission, buka detail, beri nilai, dan selesaikan penilaian.
                </span>

                <span class="assignment-feature-link">
                    Dari detail tugas
                </span>
            </span>
        </div>

    </div>


    {{-- ============================================================
         FILTER
    ============================================================= --}}

    <div class="filter-card">

        <div class="filter-head">

            <div>

                <h2 class="filter-title">
                    Filter Tugas
                </h2>

            </div>

        </div>


        <form
            method="GET"
            action="{{ route('guru.assignments.index') }}"
        >

            <div class="filter-grid">


                {{-- KELAS --}}

                <div class="field">

                    <label
                        for="kelas"
                        class="field-label"
                    >
                        Kelas
                    </label>

                    <select
                        id="kelas"
                        name="kelas"
                        class="field-control"
                    >

                        <option value="">
                            Semua kelas
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->nama }}"
                                @selected($kelas === $class->nama)
                            >
                                {{ $class->nama }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- PERTEMUAN --}}

                <div class="field">

                    <label
                        for="pertemuan"
                        class="field-label"
                    >
                        Pertemuan
                    </label>

                    <select
                        id="pertemuan"
                        name="pertemuan"
                        class="field-control"
                    >

                        <option value="">
                            Semua pertemuan
                        </option>

                        @foreach($meetingNumbers as $number)

                            <option
                                value="{{ $number }}"
                                @selected((string) $pertemuan === (string) $number)
                            >
                                Pertemuan {{ $number }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- MODE --}}

                <div class="field">

                    <label
                        for="mode_pengumpulan"
                        class="field-label"
                    >
                        Pengumpulan
                    </label>

                    <select
                        id="mode_pengumpulan"
                        name="mode_pengumpulan"
                        class="field-control"
                    >

                        <option value="">
                            Semua jenis
                        </option>

                        <option
                            value="individu"
                            @selected($mode === 'individu')
                        >
                            Individu
                        </option>

                        <option
                            value="kelompok"
                            @selected($mode === 'kelompok')
                        >
                            Kelompok
                        </option>

                    </select>

                </div>


                {{-- STATUS --}}

                <div class="field">

                    <label
                        for="status"
                        class="field-label"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="field-control"
                    >

                        <option value="">
                            Semua status
                        </option>

                        <option
                            value="aktif"
                            @selected($status === 'aktif')
                        >
                            Aktif
                        </option>

                        <option
                            value="nonaktif"
                            @selected($status === 'nonaktif')
                        >
                            Nonaktif
                        </option>

                    </select>

                </div>


                {{-- ACTION --}}

                <div class="filter-actions">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Terapkan
                    </button>

                    <a
                        href="{{ route('guru.assignments.index') }}"
                        class="btn btn-secondary"
                    >
                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- ============================================================
         DAFTAR TUGAS
    ============================================================= --}}

    <div class="assignment-card">

        <div class="assignment-card-head">

            <div>

                <h2 class="section-title">
                    Daftar Tugas
                </h2>

                <p class="section-description">
                    Tugas yang dibuat guru berdasarkan kelas dan pertemuan.
                </p>

            </div>


            <span class="result-count">
                {{ $assignments->total() }}
            </span>

        </div>


        @if($assignments->count())


            <div class="table-wrap">

                <table class="assignment-table">

                    <thead>

                    <tr>

                        <th>
                            Pertemuan
                        </th>

                        <th>
                            Kelas
                        </th>

                        <th>
                            Tugas
                        </th>

                        <th>
                            Pengumpulan
                        </th>

                        <th>
                            Kelompok
                        </th>

                        <th>
                            Pengumpulan Masuk
                        </th>

                        <th>
                            Tenggang Waktu
                        </th>

                        <th>
                            Status
                        </th>

                        <th style="text-align:right;">
                            Aksi
                        </th>

                    </tr>

                    </thead>


                    <tbody>

                    @foreach($assignments as $assignment)

                        @php

                            $deadlinePassed =
                                $assignment->batas_waktu &&
                                now()->greaterThan($assignment->batas_waktu);

                        @endphp


                        <tr>


                            {{-- PERTEMUAN --}}

                            <td>

                                <span class="meeting-badge">

                                    Pertemuan
                                    {{ $assignment->pertemuan }}

                                </span>

                            </td>


                            {{-- KELAS --}}

                            <td>

                                <span class="class-name">
                                    {{ $assignment->kelas }}
                                </span>

                            </td>


                            {{-- TUGAS --}}

                            <td>

                                <div class="assignment-title">

                                    {{ $assignment->judul }}

                                </div>


                                @if($assignment->instruksi)

                                    <div class="assignment-instruction">

                                        {{ strip_tags($assignment->instruksi) }}

                                    </div>

                                @endif

                            </td>


                            {{-- MODE --}}

                            <td>

                                @if($assignment->mode_pengumpulan === 'kelompok')

                                    <span class="mode-badge mode-kelompok">
                                        Kelompok
                                    </span>

                                @else

                                    <span class="mode-badge mode-individu">
                                        Individu
                                    </span>

                                @endif

                            </td>


                            {{-- KELOMPOK --}}

                            <td>

                                @if($assignment->groups_count > 0)

                                    <span class="count-cell">
                                        {{ $assignment->groups_count }}
                                        kelompok
                                    </span>

                                @else

                                    <span class="count-cell count-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- SUBMISSION --}}

                            <td>

                                @if($assignment->submissions_count > 0)

                                    <span class="count-cell">
                                        {{ $assignment->submissions_count }}
                                        masuk
                                    </span>

                                @else

                                    <span class="count-cell count-muted">
                                        Belum ada
                                    </span>

                                @endif

                            </td>


                            {{-- DEADLINE --}}

                            <td>

                                @if($assignment->batas_waktu)

                                    <div
                                        class="
                                            deadline
                                            {{ $deadlinePassed ? 'late' : '' }}
                                        "
                                    >

                                        {{ $assignment->batas_waktu->format('d M Y') }}

                                        <br>

                                        {{ $assignment->batas_waktu->format('H:i') }}
                                        WIB

                                        @if($deadlinePassed)

                                            <br>
                                            Sudah lewat

                                        @endif

                                    </div>

                                @else

                                    <span class="count-cell count-muted">
                                        Tidak dibatasi
                                    </span>

                                @endif

                            </td>


                            {{-- STATUS --}}

                            <td>

                                @if($assignment->aktif)

                                    <span class="status-badge status-active">

                                        <span class="status-dot"></span>

                                        Aktif

                                    </span>

                                @else

                                    <span class="status-badge status-inactive">

                                        <span class="status-dot"></span>

                                        Nonaktif

                                    </span>

                                @endif

                            </td>


                            {{-- ACTION --}}

                            <td>

                                <div class="row-actions">


                                    {{-- DETAIL --}}

                                    <a
                                        href="{{ route('guru.assignments.show', $assignment) }}"
                                        class="action-btn"
                                        title="Kelola tugas"
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
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>

                                    </a>


                                    {{-- EDIT --}}

                                    <a
                                        href="{{ route('guru.assignments.edit', $assignment) }}"
                                        class="action-btn"
                                        title="Edit tugas"
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
                                            <path d="M12 20h9"/>
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                                        </svg>

                                    </a>


                                    {{-- TOGGLE --}}

                                    <form
                                        method="POST"
                                        action="{{ route('guru.assignments.toggle', $assignment) }}"
                                        onsubmit="return confirm('Ubah status tugas ini?')"
                                    >

                                        @csrf

                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="action-btn"
                                            title="{{ $assignment->aktif ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        >

                                            @if($assignment->aktif)

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
                                                    <rect
                                                        x="3"
                                                        y="3"
                                                        width="18"
                                                        height="18"
                                                        rx="2"
                                                    />
                                                    <path d="M9 9v6"/>
                                                    <path d="M15 9v6"/>
                                                </svg>

                                            @else

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
                                                    <path d="m9 18 6-6-6-6"/>
                                                </svg>

                                            @endif

                                        </button>

                                    </form>


                                    {{-- DELETE --}}

                                    <form
                                        method="POST"
                                        action="{{ route('guru.assignments.destroy', $assignment) }}"
                                        onsubmit="return confirm('Hapus tugas ini beserta kelompok dan pengumpulannya? Tindakan ini tidak dapat dibatalkan.')"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action-btn danger"
                                            title="Hapus tugas"
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
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4h8v2"/>
                                                <path d="M19 6l-1 14H6L5 6"/>
                                                <path d="M10 11v5"/>
                                                <path d="M14 11v5"/>
                                            </svg>

                                        </button>

                                    </form>


                                </div>

                            </td>


                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}

            <div class="pagination-wrap">

                <div class="pagination-info">

                    Menampilkan
                    <strong>
                        {{ $assignments->firstItem() ?? 0 }}
                    </strong>
                    –
                    <strong>
                        {{ $assignments->lastItem() ?? 0 }}
                    </strong>
                    dari
                    <strong>
                        {{ $assignments->total() }}
                    </strong>
                    tugas

                </div>


                @if($assignments->hasPages())

                    <div class="pagination">

                        @if($assignments->onFirstPage())

                            <span class="page-link disabled">
                                ‹
                            </span>

                        @else

                            <a
                                href="{{ $assignments->previousPageUrl() }}"
                                class="page-link"
                            >
                                ‹
                            </a>

                        @endif


                        @foreach($assignments->getUrlRange(
                            max(1, $assignments->currentPage() - 2),
                            min(
                                $assignments->lastPage(),
                                $assignments->currentPage() + 2
                            )
                        ) as $page => $url)

                            <a
                                href="{{ $url }}"
                                class="
                                    page-link
                                    {{ $page === $assignments->currentPage() ? 'active' : '' }}
                                "
                            >
                                {{ $page }}
                            </a>

                        @endforeach


                        @if($assignments->hasMorePages())

                            <a
                                href="{{ $assignments->nextPageUrl() }}"
                                class="page-link"
                            >
                                ›
                            </a>

                        @else

                            <span class="page-link disabled">
                                ›
                            </span>

                        @endif

                    </div>

                @endif

            </div>


        @else


            {{-- EMPTY --}}

            <div class="empty-state">

                <div class="empty-icon">

                    <svg
                        width="25"
                        height="25"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <path d="M14 2v6h6"/>
                        <path d="M8 13h8"/>
                        <path d="M8 17h5"/>
                    </svg>

                </div>


                <h3 class="empty-title">
                    Belum ada tugas
                </h3>


                <p class="empty-text">
                    Belum ada tugas pengumpulan yang dibuat.
                    Buat tugas baru berdasarkan kelas dan pertemuan
                    yang sudah tersedia.
                </p>


                <a
                    href="{{ route('guru.assignments.create') }}"
                    class="btn btn-primary"
                >
                    + Tambah Tugas
                </a>

            </div>


        @endif

    </div>


    {{-- ============================================================
         PERTEMUAN AKTIF
    ============================================================= --}}

    @if($assignmentMeetings->count())

        <div class="meeting-panel">

            <div>

                <h2 class="section-title">
                    Pertemuan Tugas
                </h2>

                <p class="section-description">
                    Pertemuan dibuat manual oleh guru dan dapat digunakan
                    untuk membuat tugas pengumpulan.
                </p>

            </div>


            <div class="meeting-grid">

                @foreach($assignmentMeetings as $meeting)

                    <div class="meeting-item">

                        <div class="meeting-main">

                            <div class="meeting-number">

                                Pertemuan
                                {{ $meeting->pertemuan }}

                            </div>

                            <div class="meeting-class">

                                Kelas
                                {{ $meeting->kelas }}

                            </div>

                        </div>


                        @if($meeting->aktif)

                            <span class="meeting-status">
                                Aktif
                            </span>

                        @else

                            <span class="meeting-status off">
                                Nonaktif
                            </span>

                        @endif

                    </div>

                @endforeach

            </div>

        </div>

    @endif
            </div>

        </div>

    </main>

</div>

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const kelas =
                document.getElementById('kelas');

            const pertemuan =
                document.getElementById('pertemuan');

            if (!kelas || !pertemuan) {
                return;
            }

            kelas.addEventListener(
                'change',
                function () {

                    /*
                     * Pertemuan yang tersedia akan difilter
                     * berdasarkan kelas yang dipilih.
                     *
                     * Filter utama tetap diproses oleh Laravel.
                     * Script ini hanya memberikan pengalaman
                     * visual yang lebih nyaman.
                     */

                    if (!this.value) {
                        return;
                    }

                }
            );

        }
    );


    /*
     * Auto-hide flash message.
     */

    setTimeout(
        function () {

            const flash =
                document.getElementById('flashMessage');

            if (flash) {

                flash.style.transition =
                    'opacity .35s ease, transform .35s ease';

                flash.style.opacity = '0';

                flash.style.transform =
                    'translateY(-5px)';

                setTimeout(
                    function () {

                        if (flash) {
                            flash.remove();
                        }

                    },
                    350
                );

            }

        },
        4500
    );

</script>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>