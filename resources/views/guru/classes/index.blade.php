<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Manajemen Kelas — LARASKU</title>

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

            max-width: 1180px;

            margin:
                0 auto;

            padding:
                28px 24px 50px;
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
           HERO
        ========================================================== */

        .hero-card {

            position: relative;

            overflow: hidden;

            margin-bottom: 20px;

            background: #fff;

            border:
                1px solid
                #e3e8f0;

            border-radius: 21px;

            box-shadow:
                0 12px 38px
                rgba(15,23,42,.045);
        }


        .hero-card::after {

            content: "";

            position: absolute;

            width: 280px;
            height: 280px;

            right: -130px;
            top: -170px;

            border-radius: 999px;

            background:
                radial-gradient(
                    circle,
                    rgba(59,130,246,.12),
                    transparent 70%
                );

            pointer-events: none;
        }


        .hero-line {

            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb,
                    #3b82f6,
                    #60a5fa
                );
        }


        .hero-body {

            position: relative;

            z-index: 2;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 25px;

            padding:
                25px 27px;
        }


        .hero-icon {

            width: 46px;
            height: 46px;

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


        .hero-title {

            margin: 0;

            color:
                #0f172a;

            font-size: 25px;

            line-height: 1.2;

            letter-spacing:
                -.025em;

            font-weight:
                900;
        }


        .hero-description {

            margin-top: 6px;

            color:
                #94a3b8;

            font-size:
                11px;

            line-height:
                1.6;

            font-weight:
                600;
        }


        /* =========================================================
           BUTTON
        ========================================================== */

        .primary-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 8px;

            min-height: 42px;

            padding:
                0 15px;

            border-radius: 11px;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            color: #fff;

            text-decoration: none;

            font-size: 11px;

            font-weight: 800;

            box-shadow:
                0 7px 20px
                rgba(37,99,235,.18);

            transition:
                transform .18s ease,
                box-shadow .18s ease;
        }


        .primary-button:hover {

            transform:
                translateY(-1px);

            box-shadow:
                0 10px 25px
                rgba(37,99,235,.24);
        }


        /* =========================================================
           STATISTICS
        ========================================================== */

        .stats-grid {

            display: grid;

            grid-template-columns:
                repeat(3, 1fr);

            gap: 14px;

            margin-bottom: 20px;
        }


        .stat-card {

            display: flex;

            align-items: center;

            gap: 13px;

            padding:
                17px 18px;

            background: #fff;

            border:
                1px solid
                #e5eaf1;

            border-radius: 16px;

            box-shadow:
                0 7px 25px
                rgba(15,23,42,.025);
        }


        .stat-icon {

            width: 40px;
            height: 40px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 11px;
        }


        .stat-icon-blue {

            background: #eff6ff;

            color: #2563eb;
        }


        .stat-icon-green {

            background: #ecfdf5;

            color: #16a34a;
        }


        .stat-icon-slate {

            background: #f1f5f9;

            color: #475569;
        }


        .stat-label {

            color: #94a3b8;

            font-size: 9px;

            font-weight: 700;

            text-transform:
                uppercase;

            letter-spacing:
                .08em;
        }


        .stat-value {

            margin-top: 2px;

            color: #0f172a;

            font-size: 20px;

            line-height: 1.2;

            font-weight: 900;
        }


        /* =========================================================
           CLASS CARD
        ========================================================== */

        .classes-card {

            overflow: hidden;

            background: #fff;

            border:
                1px solid
                #e3e8f0;

            border-radius: 20px;

            box-shadow:
                0 10px 32px
                rgba(15,23,42,.035);
        }


        .section-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            padding:
                18px 21px;

            border-bottom:
                1px solid
                #edf1f6;
        }


        .section-title {

            color:
                #0f172a;

            font-size:
                13px;

            font-weight:
                900;
        }


        .section-subtitle {

            margin-top:
                2px;

            color:
                #94a3b8;

            font-size:
                9px;

            font-weight:
                600;
        }


        /* =========================================================
           CLASS LIST
        ========================================================== */

        .class-list {

            display:
                flex;

            flex-direction:
                column;
        }


        .class-row {

            display:
                grid;

            grid-template-columns:
                minmax(220px, 1fr)
                150px
                120px
                150px;

            align-items:
                center;

            gap: 20px;

            padding:
                15px 21px;

            border-bottom:
                1px solid
                #f1f5f9;

            transition:
                background .18s ease;
        }


        .class-row:last-child {

            border-bottom:
                0;
        }


        .class-row:hover {

            background:
                #fbfcfe;
        }


        .class-main {

            display:
                flex;

            align-items:
                center;

            gap: 12px;

            min-width: 0;
        }


        .class-icon {

            width: 41px;
            height: 41px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #eff6ff,
                    #dbeafe
                );

            color:
                #2563eb;
        }


        .class-name {

            color:
                #172033;

            font-size:
                12px;

            font-weight:
                850;
        }


        .class-meta {

            margin-top:
                2px;

            color:
                #94a3b8;

            font-size:
                9px;

            font-weight:
                600;
        }


        .column-label {

            margin-bottom:
                3px;

            color:
                #a1adbd;

            font-size:
                8px;

            font-weight:
                700;

            text-transform:
                uppercase;

            letter-spacing:
                .08em;
        }


        .column-value {

            color:
                #334155;

            font-size:
                11px;

            font-weight:
                800;
        }


        /* =========================================================
           STATUS
        ========================================================== */

        .status {

            display:
                inline-flex;

            align-items:
                center;

            gap: 6px;

            width:
                fit-content;

            min-height:
                27px;

            padding:
                0 9px;

            border-radius:
                8px;

            font-size:
                9px;

            font-weight:
                800;
        }


        .status-dot {

            width:
                5px;

            height:
                5px;

            border-radius:
                999px;

            background:
                currentColor;
        }


        .status-active {

            background:
                #ecfdf5;

            color:
                #15803d;

            border:
                1px solid
                #d1fae5;
        }


        .status-inactive {

            background:
                #f8fafc;

            color:
                #64748b;

            border:
                1px solid
                #e2e8f0;
        }


        /* =========================================================
           ACTIONS
        ========================================================== */

        .actions {

            display:
                flex;

            align-items:
                center;

            justify-content:
                flex-end;

            gap:
                7px;
        }


        .action-button {

            width:
                34px;

            height:
                34px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            border-radius:
                9px;

            border:
                1px solid
                #e5eaf1;

            background:
                #fff;

            text-decoration:
                none;

            transition:
                background .18s ease,
                border .18s ease,
                transform .18s ease;
        }


        .action-button:hover {

            transform:
                translateY(-1px);
        }


        .action-edit {

            color:
                #2563eb;
        }


        .action-edit:hover {

            background:
                #eff6ff;

            border-color:
                #dbeafe;
        }


        .action-delete {

            color:
                #dc2626;
        }


        .action-delete:hover {

            background:
                #fff1f2;

            border-color:
                #ffe4e6;
        }


        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-state {

            padding:
                65px 25px;

            text-align:
                center;
        }


        .empty-icon {

            width:
                54px;

            height:
                54px;

            display:
                flex;

            align-items:
                center;

            justify-content:
                center;

            margin:
                0 auto 13px;

            border-radius:
                16px;

            background:
                #f1f5f9;

            color:
                #94a3b8;
        }


        .empty-title {

            color:
                #475569;

            font-size:
                13px;

            font-weight:
                800;
        }


        .empty-description {

            max-width:
                360px;

            margin:
                5px auto 17px;

            color:
                #94a3b8;

            font-size:
                10px;

            line-height:
                1.6;
        }


        /* =========================================================
           ALERT
        ========================================================== */

        .alert {

            display:
                flex;

            align-items:
                center;

            gap:
                9px;

            margin-bottom:
                16px;

            padding:
                12px 14px;

            border-radius:
                11px;

            font-size:
                10px;

            font-weight:
                700;
        }


        .alert-success {

            background:
                #ecfdf5;

            border:
                1px solid
                #d1fae5;

            color:
                #15803d;
        }


        .alert-error {

            background:
                #fff1f2;

            border:
                1px solid
                #ffe4e6;

            color:
                #be123c;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .footer {

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

        @media (max-width: 1050px) {

            .class-row {

                grid-template-columns:
                    minmax(200px, 1fr)
                    120px
                    110px
                    100px;

                gap:
                    12px;
            }

        }


        @media (max-width: 800px) {

            .stats-grid {

                grid-template-columns:
                    1fr;
            }


            .hero-body {

                align-items:
                    flex-start;

                flex-direction:
                    column;
            }


            .primary-button {

                width:
                    100%;
            }


            .class-row {

                grid-template-columns:
                    1fr;

                gap:
                    12px;
            }


            .actions {

                justify-content:
                    flex-start;
            }

        }


        @media (max-width: 1023px) {

            .main-content {

                margin-left:
                    0 !important;
            }

        }


        @media (max-width: 600px) {

            .page {

                padding:
                    20px 14px 40px;
            }


            .hero-body {

                padding:
                    21px;
            }


            .hero-title {

                font-size:
                    22px;
            }


            .section-header {

                padding:
                    16px;
            }


            .class-row {

                padding:
                    15px 16px;
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
         MAIN CONTENT
    ========================================================== --}}

    <main
        class="
            main-content
            lg:ml-64
        "
    >


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header
            class="
                top-header
                sticky
                top-0
                z-30
                flex
                items-center
                justify-between
                px-5
                lg:px-8
            "
        >

            <div>

                <p
                    class="
                        text-[10px]
                        font-semibold
                        text-slate-400
                    "
                >
                    Panel Guru
                </p>

                <h2
                    class="
                        text-sm
                        font-extrabold
                        text-slate-900
                    "
                >
                    Manajemen Kelas
                </h2>

            </div>


            <div class="avatar">
                G
            </div>

        </header>


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

                <span class="breadcrumb-current">
                    Kelas
                </span>

            </div>


            {{-- =================================================
                 SUCCESS MESSAGE
            ================================================== --}}

            @if(session('success'))

                <div class="alert alert-success">

                    <i
                        data-lucide="circle-check"
                        class="w-4 h-4"
                    ></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 ERROR MESSAGE
            ================================================== --}}

            @if(session('error'))

                <div class="alert alert-error">

                    <i
                        data-lucide="circle-alert"
                        class="w-4 h-4"
                    ></i>

                    <span>
                        {{ session('error') }}
                    </span>

                </div>

            @endif


            {{-- =================================================
                 HERO
            ================================================== --}}

            <section class="hero-card">

                <div class="hero-line"></div>

                <div class="hero-body">


                    <div
                        class="
                            flex
                            items-center
                            gap-4
                        "
                    >

                        <div class="hero-icon">

                            <i
                                data-lucide="school"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <h1 class="hero-title">
                                Manajemen Kelas
                            </h1>

                            <p class="hero-description">
                                Kelola daftar kelas dan jumlah
                                siswa yang terdaftar dalam
                                pembelajaran.
                            </p>

                        </div>

                    </div>


                    <a
                        href="{{ route('guru.classes.create') }}"
                        class="primary-button"
                    >

                        <i
                            data-lucide="plus"
                            class="w-4 h-4"
                        ></i>

                        Tambah Kelas

                    </a>

                </div>

            </section>


            {{-- =================================================
                 STATISTICS
            ================================================== --}}

            @php

                $totalClasses = $classes->count();

                $activeClasses = $classes
                    ->where('aktif', true)
                    ->count();

                $totalStudents = $classes
                    ->sum('students_count');

            @endphp


            <div class="stats-grid">


                {{-- TOTAL KELAS --}}

                <div class="stat-card">

                    <div
                        class="
                            stat-icon
                            stat-icon-blue
                        "
                    >

                        <i
                            data-lucide="layers"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div>

                        <div class="stat-label">
                            Total Kelas
                        </div>

                        <div class="stat-value">
                            {{ $totalClasses }}
                        </div>

                    </div>

                </div>


                {{-- KELAS AKTIF --}}

                <div class="stat-card">

                    <div
                        class="
                            stat-icon
                            stat-icon-green
                        "
                    >

                        <i
                            data-lucide="badge-check"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div>

                        <div class="stat-label">
                            Kelas Aktif
                        </div>

                        <div class="stat-value">
                            {{ $activeClasses }}
                        </div>

                    </div>

                </div>


                {{-- TOTAL SISWA --}}

                <div class="stat-card">

                    <div
                        class="
                            stat-icon
                            stat-icon-slate
                        "
                    >

                        <i
                            data-lucide="users"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div>

                        <div class="stat-label">
                            Total Siswa
                        </div>

                        <div class="stat-value">
                            {{ $totalStudents }}
                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 DAFTAR KELAS
            ================================================== --}}

            <section class="classes-card">


                {{-- HEADER --}}

                <div class="section-header">

                    <div>

                        <div class="section-title">
                            Daftar Kelas
                        </div>

                        <div class="section-subtitle">
                            Semua kelas yang tersedia di sistem
                        </div>

                    </div>

                    <span
                        class="
                            text-[9px]
                            font-bold
                            text-slate-400
                        "
                    >
                        {{ $totalClasses }} kelas
                    </span>

                </div>


                {{-- =================================================
                     LIST
                ================================================== --}}

                @if($classes->count() > 0)

                    <div class="class-list">


                        @foreach($classes as $class)

                            <div class="class-row">


                                {{-- KELAS --}}

                                <div class="class-main">

                                    <div class="class-icon">

                                        <i
                                            data-lucide="graduation-cap"
                                            class="w-5 h-5"
                                        ></i>

                                    </div>


                                    <div class="min-w-0">

                                        <div class="class-name">

                                            {{ $class->nama }}

                                        </div>

                                        <div class="class-meta">

                                            Kelas pembelajaran

                                        </div>

                                    </div>

                                </div>


                                {{-- SISWA --}}

                                <div>

                                    <div class="column-label">
                                        Siswa
                                    </div>

                                    <div class="column-value">

                                        {{ $class->students_count }}

                                        <span
                                            class="
                                                text-[9px]
                                                font-semibold
                                                text-slate-400
                                            "
                                        >
                                            siswa
                                        </span>

                                    </div>

                                </div>


                                {{-- STATUS --}}

                                <div>

                                    <div class="column-label">
                                        Status
                                    </div>


                                    @if($class->aktif)

                                        <span
                                            class="
                                                status
                                                status-active
                                            "
                                        >

                                            <span class="status-dot"></span>

                                            Aktif

                                        </span>

                                    @else

                                        <span
                                            class="
                                                status
                                                status-inactive
                                            "
                                        >

                                            <span class="status-dot"></span>

                                            Nonaktif

                                        </span>

                                    @endif

                                </div>


                                {{-- ACTION --}}

                                <div>

                                    <div class="column-label text-right">
                                        Aksi
                                    </div>

                                    <div class="actions">


                                        {{-- EDIT --}}

                                        <a
                                            href="{{ route(
                                                'guru.classes.edit',
                                                $class
                                            ) }}"
                                            class="
                                                action-button
                                                action-edit
                                            "
                                            title="Edit kelas"
                                        >

                                            <i
                                                data-lucide="pencil"
                                                class="w-4 h-4"
                                            ></i>

                                        </a>


                                        {{-- DELETE --}}

                                        <form
                                            method="POST"
                                            action="{{ route(
                                                'guru.classes.destroy',
                                                $class
                                            ) }}"
                                            onsubmit="
                                                return confirm(
                                                    'Yakin ingin menghapus kelas {{ $class->nama }}?'
                                                );
                                            "
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="
                                                    action-button
                                                    action-delete
                                                "
                                                title="Hapus kelas"
                                            >

                                                <i
                                                    data-lucide="trash-2"
                                                    class="w-4 h-4"
                                                ></i>

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    </div>


                @else


                    {{-- =================================================
                         EMPTY
                    ================================================== --}}

                    <div class="empty-state">

                        <div class="empty-icon">

                            <i
                                data-lucide="school"
                                class="w-6 h-6"
                            ></i>

                        </div>


                        <div class="empty-title">

                            Belum ada kelas

                        </div>


                        <div class="empty-description">

                            Belum ada data kelas yang tersimpan.
                            Buat kelas pertama untuk mulai
                            mengelola siswa.

                        </div>


                        <a
                            href="{{ route('guru.classes.create') }}"
                            class="primary-button"
                        >

                            <i
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Buat Kelas Pertama

                        </a>

                    </div>

                @endif

            </section>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="footer">

                LARASKU · Manajemen Kelas

            </div>

        </div>

    </main>


    {{-- =========================================================
         SCRIPT
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

    </script>

</body>

</html>