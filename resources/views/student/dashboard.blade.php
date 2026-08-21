<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard Siswa — LARASKU</title>

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
        .stat-card {
            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }


        .menu-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 12px 30px
                rgba(15, 23, 42, .08);
        }


        .stat-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 8px 24px
                rgba(15, 23, 42, .06);
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
        }

    </style>

</head>


<body class="min-h-screen text-slate-800">


<div class="flex min-h-screen">


    {{-- =====================================================
         SIDEBAR SISWA
    ====================================================== --}}

    @include('partials.sidebar')



    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main
        id="studentMainContent"
        class="
            flex-1
            min-h-screen
            lg:ml-64
            transition-all
            duration-300
            ease-in-out
        "
    >


        {{-- =================================================
             TOPBAR
        ================================================== --}}

        <header
            class="
                h-16
                bg-white
                border-b
                border-slate-200
                flex
                items-center
                justify-between
                px-5
                lg:px-8
            "
        >

            <div>

                <p class="text-xs text-slate-400">
                    Panel Siswa
                </p>


                <h2 class="font-bold text-slate-900">
                    Dashboard
                </h2>

            </div>



            <div
                class="
                    w-9
                    h-9
                    rounded-full
                    bg-blue-600
                    text-white
                    flex
                    items-center
                    justify-center
                    font-bold
                "
            >

                {{ strtoupper(substr($student->nama, 0, 1)) }}

            </div>

        </header>



        {{-- =================================================
             CONTENT
        ================================================== --}}

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
                    Halo, {{ $student->nama }} 👋
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-1
                    "
                >
                    Pantau dan lanjutkan aktivitas pembelajaranmu
                    melalui LARASKU.
                </p>

            </div>



            {{-- =================================================
                 IDENTITAS SISWA
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-5
                    mb-7
                "
            >

                <div
                    class="
                        flex
                        items-center
                        gap-4
                    "
                >

                    <div
                        class="
                            w-12
                            h-12
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                            text-lg
                            font-bold
                        "
                    >

                        {{ strtoupper(substr($student->nama, 0, 1)) }}

                    </div>



                    <div class="min-w-0">

                        <p class="text-xs text-slate-400">
                            Siswa
                        </p>


                        <h2
                            class="
                                text-lg
                                font-bold
                                text-slate-900
                                truncate
                            "
                        >
                            {{ $student->nama }}
                        </h2>


                        <div
                            class="
                                flex
                                flex-wrap
                                gap-x-4
                                gap-y-1
                                mt-1
                                text-xs
                                text-slate-500
                            "
                        >

                            <span>
                                Kelas {{ $student->kelas }}
                            </span>

                            <span>
                                No. Absen {{ $student->nomor_absen }}
                            </span>

                        </div>

                    </div>

                </div>

            </section>



            {{-- =================================================
                 SUCCESS
            ================================================== --}}

            @if(session('success'))

                <div
                    class="
                        mb-7
                        flex
                        items-center
                        gap-3
                        rounded-2xl
                        border
                        border-green-200
                        bg-green-50
                        px-5
                        py-4
                        text-sm
                        text-green-700
                    "
                >

                    <i
                        data-lucide="circle-check"
                        class="w-5 h-5 shrink-0"
                    ></i>


                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- =================================================
                 STATISTIK PEMBELAJARAN
            ================================================== --}}

            <div class="mb-7">

                <div class="mb-4">

                    <h2
                        class="
                            text-lg
                            font-bold
                            text-slate-900
                        "
                    >
                        Progres Pembelajaran
                    </h2>


                    <p
                        class="
                            text-xs
                            text-slate-400
                            mt-1
                        "
                    >
                        Ringkasan aktivitas pembelajaran kamu.
                    </p>

                </div>


                <div
                    class="
                        grid
                        grid-cols-2
                        md:grid-cols-5
                        gap-4
                    "
                >


                    {{-- ABSENSI --}}

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
                                bg-cyan-50
                                flex
                                items-center
                                justify-center
                                mb-4
                            "
                        >

                            <i
                                data-lucide="clipboard-check"
                                class="w-5 h-5 text-cyan-600"
                            ></i>

                        </div>


                        <p class="text-xs text-slate-400">
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
                            {{ $attendanceProgress }}/{{ $totalPertemuan }}
                        </p>

                    </div>



                    {{-- QUIZ --}}

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
                                class="w-5 h-5 text-amber-600"
                            ></i>

                        </div>


                        <p class="text-xs text-slate-400">
                            Quiz
                        </p>


                        <p
                            class="
                                text-2xl
                                font-bold
                                text-slate-900
                                mt-1
                            "
                        >
                            {{ $quizCompleted }}/{{ $totalQuiz }}
                        </p>

                    </div>



                    {{-- REFLEKSI --}}

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
                                data-lucide="message-square-heart"
                                class="w-5 h-5 text-purple-600"
                            ></i>

                        </div>


                        <p class="text-xs text-slate-400">
                            Refleksi
                        </p>


                        <p
                            class="
                                text-2xl
                                font-bold
                                text-slate-900
                                mt-1
                            "
                        >
                            {{ $reflectionProgress }}/{{ $totalPertemuan }}
                        </p>

                    </div>



                    {{-- LKPD --}}

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
                                data-lucide="file-check-2"
                                class="w-5 h-5 text-green-600"
                            ></i>

                        </div>


                        <p class="text-xs text-slate-400">
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
                            {{ $lkpdProgress }}/{{ $totalPertemuan }}
                        </p>

                    </div>



                    {{-- PRAKTIK --}}

                    <a
                        href="{{ route('assignments.index') }}"
                        class="
                            stat-card
                            group
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            p-5
                            hover:border-indigo-200
                        "
                    >

                        <div
                            class="
                                w-10
                                h-10
                                rounded-xl
                                bg-indigo-50
                                flex
                                items-center
                                justify-center
                                mb-4
                            "
                        >

                            <i
                                data-lucide="clipboard-pen-line"
                                class="w-5 h-5 text-indigo-600"
                            ></i>

                        </div>


                        <p class="text-xs text-slate-400">
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
                            {{ $praktikProgress ?? 0 }}/{{ $totalPraktik ?? 0 }}
                        </p>

                    </a>


                </div>

            </div>



            {{-- =================================================
                 PEMBELAJARAN
            ================================================== --}}

            <div class="mb-4">

                <h2
                    class="
                        text-lg
                        font-bold
                        text-slate-900
                    "
                >
                    Pembelajaran
                </h2>


                <p
                    class="
                        text-xs
                        text-slate-400
                        mt-1
                    "
                >
                    Pilih aktivitas pembelajaran yang ingin kamu buka.
                </p>

            </div>


            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-2
                    lg:grid-cols-3
                    gap-5
                    mb-7
                "
            >


                {{-- ABSENSI --}}

                <a
                    href="{{ route('attendance.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
                    "
                >

                    <div
                        class="
                            w-12
                            h-12
                            rounded-xl
                            bg-cyan-50
                            flex
                            items-center
                            justify-center
                            mb-5
                        "
                    >

                        <i
                            data-lucide="clipboard-check"
                            class="w-6 h-6 text-cyan-600"
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
                        Lakukan absensi untuk setiap pertemuan
                        pembelajaran.
                    </p>


                    <div
                        class="
                            mt-5
                            text-sm
                            font-semibold
                            text-cyan-600
                            flex
                            items-center
                            gap-1
                        "
                    >

                        Buka Absensi

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- MATERI --}}

                <a
                    href="{{ route('materials.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            data-lucide="book-open"
                            class="w-6 h-6 text-blue-600"
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
                        Pelajari materi pembelajaran yang telah
                        disediakan oleh guru.
                    </p>


                    <div
                        class="
                            mt-5
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <span
                            class="
                                text-sm
                                font-semibold
                                text-blue-600
                                flex
                                items-center
                                gap-1
                            "
                        >

                            Buka Materi

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </span>


                        <span
                            class="
                                text-xs
                                font-semibold
                                text-slate-400
                            "
                        >
                            {{ $materials->count() }} materi
                        </span>

                    </div>

                </a>



                {{-- VIDEO --}}

                <a
                    href="{{ route('videos.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            class="w-6 h-6 text-red-600"
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
                        Tonton video pembelajaran yang
                        disediakan guru.
                    </p>


                    <div
                        class="
                            mt-5
                            text-sm
                            font-semibold
                            text-red-600
                            flex
                            items-center
                            gap-1
                        "
                    >

                        Buka Video

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- QUIZ --}}

                <a
                    href="{{ route('quiz.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            class="w-6 h-6 text-amber-600"
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
                        Kerjakan quiz dan lihat hasil
                        nilaimu.
                    </p>


                    <div
                        class="
                            mt-5
                            text-sm
                            font-semibold
                            text-amber-600
                            flex
                            items-center
                            gap-1
                        "
                    >

                        Kerjakan Quiz

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- GAME --}}

                <a
                    href="{{ route('game.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            data-lucide="gamepad-2"
                            class="w-6 h-6 text-pink-600"
                        ></i>

                    </div>


                    <h3
                        class="
                            font-bold
                            text-lg
                            text-slate-900
                        "
                    >
                        Game Interaktif
                    </h3>


                    <p
                        class="
                            text-sm
                            text-slate-500
                            mt-1
                        "
                    >
                        Bermain sambil belajar melalui
                        game interaktif.
                    </p>


                    <div
                        class="
                            mt-5
                            text-sm
                            font-semibold
                            text-pink-600
                            flex
                            items-center
                            gap-1
                        "
                    >

                        Mulai Bermain

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- REFLEKSI --}}

                <a
                    href="{{ route('reflections.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            data-lucide="message-square-heart"
                            class="w-6 h-6 text-purple-600"
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
                        Sampaikan refleksi setelah
                        mengikuti pembelajaran.
                    </p>


                    <div
                        class="
                            mt-5
                            text-sm
                            font-semibold
                            text-purple-600
                            flex
                            items-center
                            gap-1
                        "
                    >

                        Isi Refleksi

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- LKPD --}}

                <a
                    href="{{ route('lkpd.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
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
                            data-lucide="file-check-2"
                            class="w-6 h-6 text-green-600"
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
                        Kerjakan dan kumpulkan lembar
                        kerja peserta didik.
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

                        Buka LKPD

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>



                {{-- PRAKTIK --}}

                <a
                    href="{{ route('assignments.index') }}"
                    class="
                        menu-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-6
                        hover:border-indigo-200
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
                            data-lucide="clipboard-pen-line"
                            class="w-6 h-6 text-indigo-600"
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
                        Kumpulkan tugas praktik dan pantau
                        status serta hasil penilaianmu.
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

                        Buka Praktik

                        <i
                            data-lucide="arrow-right"
                            class="w-4 h-4"
                        ></i>

                    </div>

                </a>


            </div>



            {{-- =================================================
                 RINGKASAN PROGRES
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-6
                    mb-7
                "
            >

                <div
                    class="
                        flex
                        items-center
                        justify-between
                        mb-5
                    "
                >

                    <div>

                        <h3
                            class="
                                font-bold
                                text-slate-900
                            "
                        >
                            Progres Kamu
                        </h3>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >
                            Pantau perkembangan aktivitasmu.
                        </p>

                    </div>


                    <i
                        data-lucide="chart-no-axes-column"
                        class="w-5 h-5 text-blue-600"
                    ></i>

                </div>


                <div class="space-y-5">


                    {{-- ABSENSI --}}

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                text-xs
                                mb-2
                            "
                        >

                            <span
                                class="
                                    font-semibold
                                    text-slate-600
                                "
                            >
                                Absensi
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-cyan-600
                                "
                            >
                                {{ $attendancePercentage }}%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="
                                    progress-fill
                                    bg-cyan-500
                                "
                                style="
                                    width:
                                    {{ $attendancePercentage }}%;
                                "
                            ></div>

                        </div>

                    </div>



                    {{-- QUIZ --}}

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                text-xs
                                mb-2
                            "
                        >

                            <span
                                class="
                                    font-semibold
                                    text-slate-600
                                "
                            >
                                Quiz
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-amber-600
                                "
                            >
                                {{ $quizPercentage }}%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="
                                    progress-fill
                                    bg-amber-500
                                "
                                style="
                                    width:
                                    {{ $quizPercentage }}%;
                                "
                            ></div>

                        </div>

                    </div>



                    {{-- REFLEKSI --}}

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                text-xs
                                mb-2
                            "
                        >

                            <span
                                class="
                                    font-semibold
                                    text-slate-600
                                "
                            >
                                Refleksi
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-purple-600
                                "
                            >
                                {{ $reflectionPercentage }}%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="
                                    progress-fill
                                    bg-purple-500
                                "
                                style="
                                    width:
                                    {{ $reflectionPercentage }}%;
                                "
                            ></div>

                        </div>

                    </div>



                    {{-- LKPD --}}

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                text-xs
                                mb-2
                            "
                        >

                            <span
                                class="
                                    font-semibold
                                    text-slate-600
                                "
                            >
                                LKPD
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-green-600
                                "
                            >
                                {{ $lkpdPercentage }}%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="
                                    progress-fill
                                    bg-green-500
                                "
                                style="
                                    width:
                                    {{ $lkpdPercentage }}%;
                                "
                            ></div>

                        </div>

                    </div>



                    {{-- PRAKTIK --}}

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                text-xs
                                mb-2
                            "
                        >

                            <span
                                class="
                                    font-semibold
                                    text-slate-600
                                "
                            >
                                Praktik
                            </span>


                            <span
                                class="
                                    font-bold
                                    text-indigo-600
                                "
                            >
                                {{ $praktikPercentage ?? 0 }}%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="
                                    progress-fill
                                    bg-indigo-500
                                "
                                style="
                                    width:
                                    {{ $praktikPercentage ?? 0 }}%;
                                "
                            ></div>

                        </div>

                    </div>


                </div>

            </section>



            {{-- =================================================
                 ABSENSI
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-6
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-4
                    "
                >

                    <div>

                        <div
                            class="
                                flex
                                items-center
                                gap-2
                            "
                        >

                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-xl
                                    bg-cyan-50
                                    text-cyan-600
                                    flex
                                    items-center
                                    justify-center
                                "
                            >

                                <i
                                    data-lucide="calendar-check"
                                    class="w-4 h-4"
                                ></i>

                            </div>


                            <h2
                                class="
                                    font-bold
                                    text-slate-900
                                "
                            >
                                Absensi
                            </h2>

                        </div>


                        <p
                            class="
                                mt-2
                                text-xs
                                text-slate-500
                            "
                        >
                            Pastikan kamu melakukan absensi
                            pada setiap pertemuan.
                        </p>

                    </div>


                    <a
                        href="{{ route('attendance.index') }}"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-3
                            rounded-xl
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            text-sm
                            font-bold
                            transition
                        "
                    >

                        <i
                            data-lucide="check-circle"
                            class="w-4 h-4"
                        ></i>

                        Buka Absensi

                    </a>

                </div>

            </section>



            {{-- FOOTER --}}

            <footer
                class="
                    mt-10
                    text-center
                    text-xs
                    text-slate-400
                "
            >
                LARASKU · Pembelajaran Seni Musik
            </footer>


        </div>

    </main>

</div>



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