<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Dashboard Guru — LARASKU
    </title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>


    <style>

        * {
            font-family:
                'DM Sans',
                'Inter',
                sans-serif;
        }


        body {
            background: #f4f7fb;
        }


        .menu-card,
        .stat-card,
        .activity-card,
        .ranking-card {
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .menu-card:hover {
            transform:
                translateY(-3px);

            box-shadow:
                0 12px 30px
                rgba(
                    15,
                    23,
                    42,
                    .08
                );
        }


        .stat-card:hover {
            transform:
                translateY(-2px);

            box-shadow:
                0 8px 24px
                rgba(
                    15,
                    23,
                    42,
                    .06
                );
        }


        .sidebar-link {
            transition:
                background .2s ease,
                color .2s ease;
        }


        .sidebar-link:hover {
            background: #f8fafc;
        }


        .progress-bar {
            overflow: hidden;

            height: 7px;

            border-radius: 999px;

            background: #e2e8f0;
        }


        .progress-fill {
            height: 100%;

            border-radius: 999px;

            background: #2563eb;
        }


        .scroll-clean {
            scrollbar-width: thin;
        }


        /* =====================================================
           QUICK MENU COMPACT
        ====================================================== */

        .quick-menu-grid {
            display: grid;

            grid-template-columns:
                repeat(1, minmax(0, 1fr));

            gap: 1rem;
        }


        @media (min-width: 768px) {

            .quick-menu-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }


        @media (min-width: 1024px) {

            .quick-menu-grid {
                grid-template-columns:
                    repeat(5, minmax(0, 1fr));
            }

        }


        /*
        |--------------------------------------------------------------------------
        | Card lebih compact
        |--------------------------------------------------------------------------
        */

        .menu-card {
            padding: 1.25rem !important;
        }


        .menu-card > div:first-child {
            width: 2.5rem !important;

            height: 2.5rem !important;

            margin-bottom: .75rem !important;
        }


        .menu-card > div:first-child i {
            width: 1.125rem !important;

            height: 1.125rem !important;
        }


        .menu-card h3 {
            font-size: .95rem !important;

            line-height: 1.35rem !important;
        }


        .menu-card p {
            font-size: .75rem !important;

            line-height: 1.1rem !important;

            margin-top: .25rem !important;
        }


        .menu-card > div:last-child {
            margin-top: .75rem !important;

            font-size: .75rem !important;
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

    <main
        class="
            flex-1
            lg:ml-64
        "
    >


        {{-- =====================================================
             HEADBAR GURU
        ====================================================== --}}

        @include('guru.partials.header')


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div
            class="
                p-5
                lg:p-8
                max-w-7xl
                mx-auto
            "
        >


            {{-- =================================================
                 WELCOME
            ================================================== --}}

            <div class="mb-7">

                <p
                    class="
                        text-sm
                        font-semibold
                        text-blue-600
                        mb-1
                    "
                >
                    Selamat Datang
                </p>


                <h1
                    class="
                        text-3xl
                        font-bold
                        text-slate-900
                    "
                >
                    Dashboard Guru
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-1
                    "
                >
                    Pantau seluruh aktivitas pembelajaran
                    siswa melalui LARASKU.
                </p>

            </div>


            {{-- =================================================
                 STATISTIK UTAMA
            ================================================== --}}

            <div
                class="
                    grid
                    grid-cols-2
                    md:grid-cols-5
                    gap-4
                    mb-7
                "
            >


                {{-- =================================================
                     TOTAL SISWA
                ================================================== --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            mb-4
                        "
                    >

                        <div
                            class="
                                w-10
                                h-10
                                rounded-xl
                                bg-blue-50
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="users"
                                class="
                                    w-5
                                    h-5
                                    text-blue-600
                                "
                            ></i>

                        </div>


                        <span
                            class="
                                text-[10px]
                                font-bold
                                text-green-600
                            "
                        >
                            Aktif
                        </span>

                    </div>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Total Siswa
                    </p>


                    <p
                        class="
                            text-2xl
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $totalStudents }}
                    </p>


                    <p
                        class="
                            text-[10px]
                            text-slate-400
                            mt-1
                        "
                    >
                        {{ $activeStudents }}
                        siswa aktif
                    </p>

                </div>


                {{-- =================================================
                     KEHADIRAN
                ================================================== --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-green-50
                            flex
                            items-center
                            justify-center
                            mb-4
                        "
                    >

                        <i
                            data-lucide="clipboard-check"
                            class="
                                w-5
                                h-5
                                text-green-600
                            "
                        ></i>

                    </div>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Kehadiran
                    </p>


                    <p
                        class="
                            text-2xl
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $attendancePercentage }}%
                    </p>


                    <p
                        class="
                            text-[10px]
                            text-slate-400
                            mt-1
                        "
                    >
                        {{ $attendanceToday }}
                        data hari ini
                    </p>

                </div>


                {{-- =================================================
                     QUIZ
                ================================================== --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-amber-50
                            flex
                            items-center
                            justify-center
                            mb-4
                        "
                    >

                        <i
                            data-lucide="help-circle"
                            class="
                                w-5
                                h-5
                                text-amber-600
                            "
                        ></i>

                    </div>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Rata-rata Quiz
                    </p>


                    <p
                        class="
                            text-2xl
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $quizAverage }}
                    </p>


                    <p
                        class="
                            text-[10px]
                            text-slate-400
                            mt-1
                        "
                    >
                        {{ $quizCompleted }}
                        pengerjaan
                    </p>

                </div>


                {{-- =================================================
                     LKPD
                ================================================== --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-purple-50
                            flex
                            items-center
                            justify-center
                            mb-4
                        "
                    >

                        <i
                            data-lucide="file-check-2"
                            class="
                                w-5
                                h-5
                                text-purple-600
                            "
                        ></i>

                    </div>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        LKPD
                    </p>


                    <p
                        class="
                            text-2xl
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $lkpdCount }}
                    </p>


                    <p
                        class="
                            text-[10px]
                            text-slate-400
                            mt-1
                        "
                    >
                        pengumpulan
                    </p>

                </div>


                {{-- =================================================
                     PRAKTIK
                ================================================== --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-emerald-50
                            flex
                            items-center
                            justify-center
                            mb-4
                        "
                    >

                        <i
                            data-lucide="music-2"
                            class="
                                w-5
                                h-5
                                text-emerald-600
                            "
                        ></i>

                    </div>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Praktik
                    </p>


                    <p
                        class="
                            text-2xl
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $practiceCount }}
                    </p>


                    <p
                        class="
                            text-[10px]
                            text-slate-400
                            mt-1
                        "
                    >
                        tugas praktik
                    </p>

                </div>


            </div>


            {{-- =================================================
                 KELOLA PEMBELAJARAN
            ================================================== --}}

            <div class="mb-7">

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        mb-4
                    "
                >

                    <div>

                        <h2
                            class="
                                text-lg
                                font-bold
                                text-slate-900
                            "
                        >
                            Kelola Pembelajaran
                        </h2>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >
                            Akses cepat fitur utama LARASKU.
                        </p>

                    </div>

                </div>


                {{-- =================================================
                     GRID COMPACT
                     5 CARD PER BARIS
                ================================================== --}}

                <div
                    class="
                        quick-menu-grid
                    "
                >


                    {{-- DATA SISWA --}}

                    <a
                        href="{{ route('guru.students.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-blue-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="users"
                                class="
                                    w-6
                                    h-6
                                    text-blue-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Data Siswa
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola daftar siswa,
                            kelas, dan nomor absen.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-blue-600
                                flex
                                items-center
                                gap-1
                            "
                        >
                            Kelola Siswa

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </div>

                    </a>


                    {{-- KELOLA KELAS --}}

                    <a
                        href="{{ route('guru.classes.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-indigo-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="school"
                                class="
                                    w-6
                                    h-6
                                    text-indigo-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Kelola Kelas
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Tambah, ubah, dan kelola
                            daftar kelas siswa.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-indigo-600
                                flex
                                items-center
                                gap-1
                            "
                        >
                            Kelola Kelas

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </div>

                    </a>


                    {{-- ABSENSI --}}

                    <a
                        href="{{ route('guru.attendance.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-green-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="clipboard-check"
                                class="
                                    w-6
                                    h-6
                                    text-green-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Absensi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola kehadiran siswa
                            setiap pertemuan.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-green-600
                                flex
                                items-center
                                gap-1
                            "
                        >
                            Kelola Absensi

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </div>

                    </a>


                    {{-- MATERI --}}

                    <a
                        href="{{ route('guru.materials.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-purple-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="book-open"
                                class="
                                    w-6
                                    h-6
                                    text-purple-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Materi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola materi pembelajaran
                            setiap pertemuan.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-purple-600
                            "
                        >
                            Kelola Materi →
                        </div>

                    </a>


                    {{-- VIDEO --}}

                    <a
                        href="{{ route('guru.videos.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-red-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="play-circle"
                                class="
                                    w-6
                                    h-6
                                    text-red-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Video
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola video pembelajaran
                            untuk siswa.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-red-600
                            "
                        >
                            Kelola Video →
                        </div>

                    </a>


                    {{-- QUIZ --}}

                    <a
                        href="{{ route('guru.quizzes.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-amber-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="help-circle"
                                class="
                                    w-6
                                    h-6
                                    text-amber-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Quiz
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola soal, kunci jawaban,
                            dan penilaian.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-amber-600
                            "
                        >
                            Kelola Quiz →
                        </div>

                    </a>


                    {{-- PERINGKAT --}}

                    <a
                        href="{{ route('guru.quiz-ranking.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-yellow-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="trophy"
                                class="
                                    w-6
                                    h-6
                                    text-yellow-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Peringkat
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Peringkat berdasarkan
                            Absen, LKPD, Quiz, Refleksi,
                            dan Praktik.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-yellow-600
                            "
                        >
                            Lihat Peringkat →
                        </div>

                    </a>


                    {{-- REFLEKSI --}}

                    <a
                        href="{{ route('guru.reflections.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-pink-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="message-square-heart"
                                class="
                                    w-6
                                    h-6
                                    text-pink-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Refleksi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Lihat refleksi yang dikirim
                            oleh siswa.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-pink-600
                            "
                        >
                            Lihat Refleksi →
                        </div>

                    </a>


                    {{-- LKPD --}}

                    <a
                        href="{{ route('guru.lkpd.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-indigo-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="file-check-2"
                                class="
                                    w-6
                                    h-6
                                    text-indigo-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            LKPD
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Periksa dan kelola pengumpulan
                            tugas siswa.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-indigo-600
                            "
                        >
                            Kelola LKPD →
                        </div>

                    </a>


                    {{-- PRAKTIK --}}

                    <a
                        href="{{ route('guru.assignments.index') }}"
                        class="
                            menu-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                        "
                    >

                        <div
                            class="
                                w-12
                                h-12
                                rounded-xl
                                bg-emerald-50
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="music-2"
                                class="
                                    w-6
                                    h-6
                                    text-emerald-600
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                font-bold
                                text-lg
                                text-slate-900
                            "
                        >
                            Praktik
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Kelola tugas praktik dan
                            penilaian siswa.
                        </p>


                        <div
                            class="
                                mt-5
                                text-sm
                                font-semibold
                                text-emerald-600
                            "
                        >
                            Kelola Praktik →
                        </div>

                    </a>


                </div>

            </div>


            {{-- =================================================
                 AKTIVITAS SISWA
            ================================================== --}}

            <div class="mb-7">

                <section
                    class="
                        activity-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        overflow-hidden
                    "
                >

                    <div
                        class="
                            p-6
                            border-b
                            border-slate-100
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <div>

                            <h3
                                class="
                                    font-bold
                                    text-slate-900
                                "
                            >
                                Aktivitas Siswa
                            </h3>

                            <p
                                class="
                                    text-xs
                                    text-slate-400
                                    mt-1
                                "
                            >
                                Aktivitas terbaru siswa di LARASKU
                            </p>

                        </div>

                        <i
                            data-lucide="activity"
                            class="
                                w-5
                                h-5
                                text-blue-600
                            "
                        ></i>

                    </div>


                    <div
                        class="
                            divide-y
                            divide-slate-100
                            max-h-[430px]
                            overflow-y-auto
                            scroll-clean
                        "
                    >

                        @forelse(
                            $studentActivities
                            as $activity
                        )

                            <div
                                class="
                                    px-6
                                    py-4
                                    flex
                                    items-center
                                    justify-between
                                "
                            >

                                <div
                                    class="
                                        flex
                                        items-center
                                        gap-3
                                        min-w-0
                                    "
                                >

                                    <div
                                        class="
                                            w-9
                                            h-9
                                            flex-shrink-0
                                            rounded-full
                                            bg-blue-50
                                            flex
                                            items-center
                                            justify-center
                                        "
                                    >

                                        <i
                                            data-lucide="{{ $activity['icon'] }}"
                                            class="
                                                w-4
                                                h-4
                                                text-blue-600
                                            "
                                        ></i>

                                    </div>


                                    <div
                                        class="
                                            min-w-0
                                        "
                                    >

                                        <p
                                            class="
                                                text-sm
                                                font-semibold
                                                text-slate-800
                                                truncate
                                            "
                                        >
                                            {{ $activity['student'] }}
                                        </p>


                                        <p
                                            class="
                                                text-[10px]
                                                text-slate-400
                                                mt-0.5
                                                truncate
                                            "
                                        >
                                            {{ $activity['description'] }}

                                            @if($activity['time'])
                                                • {{ $activity['time'] }}
                                            @endif
                                        </p>

                                    </div>

                                </div>


                                @if($activity['value'] !== null)

                                    <div
                                        class="
                                            flex-shrink-0
                                            ml-3
                                            text-right
                                        "
                                    >

                                        <span
                                            class="
                                                inline-flex
                                                px-2.5
                                                py-1
                                                rounded-lg
                                                bg-green-50
                                                text-green-700
                                                text-[10px]
                                                font-bold
                                            "
                                        >
                                            {{ $activity['value'] }}
                                        </span>

                                    </div>

                                @endif

                            </div>

                        @empty

                            <div
                                class="
                                    px-6
                                    py-10
                                    text-center
                                "
                            >

                                <i
                                    data-lucide="inbox"
                                    class="
                                        w-8
                                        h-8
                                        mx-auto
                                        text-slate-300
                                    "
                                ></i>


                                <p
                                    class="
                                        text-sm
                                        font-semibold
                                        text-slate-500
                                        mt-3
                                    "
                                >
                                    Belum ada aktivitas siswa.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </section>

            </div>


            {{-- =================================================
                 FOOTER INFO
            ================================================== --}}

            <div
                class="
                    mt-7
                    p-5
                    bg-slate-900
                    rounded-2xl
                    text-white
                    flex
                    flex-col
                    md:flex-row
                    md:items-center
                    md:justify-between
                    gap-4
                "
            >

                <div>

                    <p
                        class="
                            text-sm
                            font-bold
                        "
                    >
                        LARASKU
                    </p>


                    <p
                        class="
                            text-xs
                            text-slate-400
                            mt-1
                        "
                    >
                        Sistem pembelajaran seni musik
                        berbasis digital.
                    </p>

                </div>


                <div
                    class="
                        flex
                        gap-5
                        text-[10px]
                        text-slate-400
                    "
                >

                </div>

            </div>


        </div>

    </main>

</div>


<script>

    lucide.createIcons();

</script>


</body>

</html>