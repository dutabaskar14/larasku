<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Export Excel — LARASKU</title>

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

        .main-content {
            min-height: 100vh;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        .export-card {
            transition:
                transform 0.2s ease,
                box-shadow 0.2s ease,
                border-color 0.2s ease;
        }

        .export-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px rgba(15, 23, 42, 0.08);

            border-color: #e2e8f0;
        }

        .export-icon {
            transition:
                transform 0.2s ease,
                background 0.2s ease;
        }

        .export-card:hover .export-icon {
            transform: scale(1.04);
        }

        .final-card {
            background:
                linear-gradient(
                    135deg,
                    #0f172a 0%,
                    #1e293b 100%
                );
        }

        .final-card:hover {
            box-shadow:
                0 18px 40px rgba(15, 23, 42, 0.18);
        }

        .class-select,
        .meeting-select {
            appearance: none;

            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%2364758b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");

            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
        }
    </style>
</head>


<body>

<div class="min-h-screen">

    {{-- =====================================================
         SIDEBAR GURU
    ====================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main
        class="main-content lg:ml-64 transition-all duration-300"
    >

        {{-- HEADER --}}

        @include('guru.partials.header')


        {{-- CONTENT --}}

        <div class="p-5 lg:p-8 max-w-[1200px] mx-auto">

            {{-- PAGE HEADER --}}

            <section class="mb-7">

                <div class="mb-2">

                    <span
                        class="inline-flex items-center gap-2
                               text-xs font-semibold
                               text-blue-600
                               bg-blue-50
                               px-3 py-1.5
                               rounded-full"
                    >

                        <i
                            data-lucide="file-spreadsheet"
                            class="w-3.5 h-3.5"
                        ></i>

                        Panel Guru

                    </span>

                </div>


                <h1
                    class="text-3xl font-bold text-slate-900"
                >
                    Export Excel
                </h1>


                <p
                    class="text-sm text-slate-500 mt-2"
                >
                    Export data siswa, pembelajaran,
                    penilaian, dan rekap nilai.
                </p>

            </section>


            {{-- FLASH SUCCESS --}}

            @if(session('success'))

                <div
                    class="mb-6 px-4 py-3
                           rounded-xl
                           border border-emerald-200
                           bg-emerald-50
                           text-emerald-700
                           text-sm font-semibold"
                >

                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="circle-check"
                            class="w-4 h-4"
                        ></i>

                        {{ session('success') }}

                    </div>

                </div>

            @endif


            {{-- FLASH ERROR --}}

            @if(session('error'))

                <div
                    class="mb-6 px-4 py-3
                           rounded-xl
                           border border-red-200
                           bg-red-50
                           text-red-700
                           text-sm font-semibold"
                >

                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="circle-alert"
                            class="w-4 h-4"
                        ></i>

                        {{ session('error') }}

                    </div>

                </div>

            @endif


            {{-- =================================================
                 EXPORT CARDS
            ================================================== --}}

            <section>

                <div
                    class="grid
                           grid-cols-1
                           md:grid-cols-2
                           xl:grid-cols-3
                           gap-5"
                >


                    {{-- =================================================
                         DATA SISWA
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                               border border-slate-200
                               rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                       rounded-xl bg-blue-50
                                       text-blue-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="users"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <span
                                class="text-[11px] font-bold
                                       text-slate-400 uppercase
                                       tracking-wide"
                            >
                                Data
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                       text-slate-900"
                            >
                                Data Siswa
                            </h2>

                            <p
                                class="text-xs leading-5
                                       text-slate-500 mt-1.5"
                            >
                                Pilih kelas untuk menentukan
                                data siswa yang akan diekspor.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.students') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-siswa"
                                class="block text-[11px]
                                       font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-siswa"
                                class="class-select w-full h-11
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-3 pr-10
                                       text-sm font-semibold
                                       text-slate-700
                                       outline-none
                                       focus:bg-white
                                       focus:border-blue-400
                                       focus:ring-4
                                       focus:ring-blue-50
                                       transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                       inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-xl
                                       bg-slate-900
                                       hover:bg-slate-800
                                       text-white text-xs
                                       font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Excel

                            </button>

                        </form>

                    </article>


                    {{-- =================================================
                         ABSENSI
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                               border border-slate-200
                               rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                       rounded-xl bg-emerald-50
                                       text-emerald-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="calendar-check-2"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <span
                                class="text-[11px] font-bold
                                       text-slate-400 uppercase
                                       tracking-wide"
                            >
                                Kehadiran
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                       text-slate-900"
                            >
                                Rekap Absensi
                            </h2>

                            <p
                                class="text-xs leading-5
                                       text-slate-500 mt-1.5"
                            >
                                Pilih kelas dan pertemuan
                                untuk membuat rekap absensi.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.attendance') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-absensi"
                                class="block text-[11px]
                                       font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-absensi"
                                class="class-select w-full h-11
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-3 pr-10
                                       text-sm font-semibold
                                       text-slate-700
                                       outline-none
                                       focus:bg-white
                                       focus:border-emerald-400
                                       focus:ring-4
                                       focus:ring-emerald-50
                                       transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <label
                                for="pertemuan-absensi"
                                class="block text-[11px]
                                       font-bold text-slate-600
                                       mt-3 mb-2"
                            >
                                Pilih Pertemuan
                            </label>


                            <select
                                name="pertemuan"
                                id="pertemuan-absensi"
                                class="meeting-select w-full h-11
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-3 pr-10
                                       text-sm font-semibold
                                       text-slate-700
                                       outline-none
                                       focus:bg-white
                                       focus:border-emerald-400
                                       focus:ring-4
                                       focus:ring-emerald-50
                                       transition"
                            >

                                <option value="">
                                    Semua Pertemuan
                                </option>

                                @foreach($pertemuans as $pertemuan)

                                    <option value="{{ $pertemuan }}">
                                        Pertemuan {{ $pertemuan }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                       inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-xl
                                       bg-emerald-600
                                       hover:bg-emerald-700
                                       text-white text-xs
                                       font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Excel

                            </button>

                        </form>

                    </article>


                    {{-- =================================================
                         LKPD
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                               border border-violet-200
                               rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                       rounded-xl bg-violet-50
                                       text-violet-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="clipboard-list"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <span
                                class="text-[11px] font-bold
                                       text-violet-500 uppercase"
                            >
                                30%
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                       text-slate-900"
                            >
                                Nilai LKPD
                            </h2>

                            <p
                                class="text-xs leading-5
                                       text-slate-500 mt-1.5
                                       min-h-[40px]"
                            >
                                Rekap rata-rata nilai LKPD
                                seluruh pertemuan siswa.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.lkpd') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-lkpd"
                                class="block text-[11px]
                                       font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-lkpd"
                                class="class-select w-full h-11
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-3 pr-10
                                       text-sm font-semibold
                                       text-slate-700
                                       outline-none
                                       focus:bg-white
                                       focus:border-violet-400
                                       focus:ring-4
                                       focus:ring-violet-50
                                       transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                       inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-xl
                                       bg-violet-600
                                       hover:bg-violet-700
                                       text-white text-xs
                                       font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Nilai LKPD

                            </button>

                        </form>

                    </article>


                    {{-- =================================================
                         ⭐ QUIZ AKTIF
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                               border border-amber-200
                               rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                       rounded-xl bg-amber-50
                                       text-amber-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="brain"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <span
                                class="text-[11px] font-bold
                                       text-amber-500 uppercase
                                       tracking-wide"
                            >
                                25%
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                       text-slate-900"
                            >
                                Nilai Quiz
                            </h2>

                            <p
                                class="text-xs leading-5
                                       text-slate-500 mt-1.5
                                       min-h-[40px]"
                            >
                                Rekap rata-rata nilai quiz
                                seluruh pengerjaan siswa.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.quiz') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-quiz"
                                class="block text-[11px]
                                       font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-quiz"
                                class="class-select w-full h-11
                                       rounded-xl
                                       border border-slate-200
                                       bg-slate-50
                                       px-3 pr-10
                                       text-sm font-semibold
                                       text-slate-700
                                       outline-none
                                       focus:bg-white
                                       focus:border-amber-400
                                       focus:ring-4
                                       focus:ring-amber-50
                                       transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                       inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-xl
                                       bg-amber-500
                                       hover:bg-amber-600
                                       text-white text-xs
                                       font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Nilai Quiz

                            </button>

                        </form>

                    </article>


                    {{-- =================================================
                        ⭐ PRAKTIK - AKTIF
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                            border border-orange-200
                            rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                    rounded-xl bg-orange-50
                                    text-orange-600
                                    flex items-center
                                    justify-center"
                            >

                                <i
                                    data-lucide="wrench"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <span
                                class="text-[11px] font-bold
                                    text-orange-500 uppercase
                                    tracking-wide"
                            >
                                25%
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                    text-slate-900"
                            >
                                Nilai Praktik
                            </h2>

                            <p
                                class="text-xs leading-5
                                    text-slate-500 mt-1.5
                                    min-h-[40px]"
                            >
                                Rekap nilai tugas praktik
                                individu maupun kelompok.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.practice') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-practice"
                                class="block text-[11px]
                                    font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-practice"
                                class="class-select w-full h-11
                                    rounded-xl
                                    border border-slate-200
                                    bg-slate-50
                                    px-3 pr-10
                                    text-sm font-semibold
                                    text-slate-700
                                    outline-none
                                    focus:bg-white
                                    focus:border-orange-400
                                    focus:ring-4
                                    focus:ring-orange-50
                                    transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                    inline-flex items-center
                                    justify-center gap-2
                                    px-4 py-2.5 rounded-xl
                                    bg-orange-500
                                    hover:bg-orange-600
                                    text-white text-xs
                                    font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Nilai Praktik

                            </button>

                        </form>

                    </article>


                    {{-- =================================================
                        ⭐ REFLEKSI - AKTIF
                    ================================================== --}}

                    <article
                        class="export-card bg-white
                            border border-rose-200
                            rounded-2xl p-5 shadow-sm"
                    >

                        <div class="flex items-start justify-between gap-4">

                            <div
                                class="export-icon w-11 h-11
                                    rounded-xl bg-rose-50
                                    text-rose-600
                                    flex items-center
                                    justify-center"
                            >

                                <i
                                    data-lucide="message-square-heart"
                                    class="w-5 h-5"
                                ></i>

                            </div>


                            <span
                                class="text-[11px] font-bold
                                    text-rose-500 uppercase
                                    tracking-wide"
                            >
                                10%
                            </span>

                        </div>


                        <div class="mt-4">

                            <h2
                                class="text-base font-bold
                                    text-slate-900"
                            >
                                Nilai Refleksi
                            </h2>


                            <p
                                class="text-xs leading-5
                                    text-slate-500 mt-1.5
                                    min-h-[40px]"
                            >
                                Rekap rata-rata nilai refleksi
                                seluruh pengerjaan siswa.
                            </p>

                        </div>


                        <form
                            action="{{ route('guru.exports.reflection') }}"
                            method="GET"
                            class="mt-5"
                        >

                            <label
                                for="kelas-reflection"
                                class="block text-[11px]
                                    font-bold text-slate-600 mb-2"
                            >
                                Pilih Kelas
                            </label>


                            <select
                                name="kelas"
                                id="kelas-reflection"
                                class="class-select w-full h-11
                                    rounded-xl
                                    border border-slate-200
                                    bg-slate-50
                                    px-3 pr-10
                                    text-sm font-semibold
                                    text-slate-700
                                    outline-none
                                    focus:bg-white
                                    focus:border-rose-400
                                    focus:ring-4
                                    focus:ring-rose-50
                                    transition"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>


                                @foreach($kelas as $item)

                                    <option value="{{ $item }}">
                                        {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            <button
                                type="submit"
                                class="mt-3 w-full
                                    inline-flex items-center
                                    justify-center gap-2
                                    px-4 py-2.5 rounded-xl
                                    bg-rose-500
                                    hover:bg-rose-600
                                    text-white text-xs
                                    font-bold transition"
                            >

                                <i
                                    data-lucide="download"
                                    class="w-4 h-4"
                                ></i>

                                Export Nilai Refleksi

                            </button>

                        </form>

                    </article>

                    {{-- =================================================
                         NILAI AKHIR
                    ================================================== --}}

                    <article
                        class="export-card final-card
                               border border-slate-800
                               rounded-2xl p-5 shadow-sm
                               md:col-span-2
                               xl:col-span-3"
                    >

                        <div
                            class="flex flex-col
                                   lg:flex-row
                                   lg:items-center
                                   lg:justify-between
                                   gap-6"
                        >

                            <div
                                class="flex items-start gap-4"
                            >

                                <div
                                    class="w-11 h-11
                                           rounded-xl
                                           bg-white/10
                                           text-white
                                           flex items-center
                                           justify-center
                                           shrink-0"
                                >

                                    <i
                                        data-lucide="graduation-cap"
                                        class="w-5 h-5"
                                    ></i>

                                </div>


                                <div>

                                    <div
                                        class="flex items-center
                                               gap-2 flex-wrap"
                                    >

                                        <h2
                                            class="text-base
                                                   font-bold
                                                   text-white"
                                        >
                                            Rekap Nilai Akhir
                                        </h2>


                                        <span
                                            class="inline-flex
                                                   items-center
                                                   px-2 py-1
                                                   rounded-md
                                                   bg-white/10
                                                   text-white/80
                                                   text-[10px]
                                                   font-bold"
                                        >
                                            100%
                                        </span>

                                    </div>


                                    <p
                                        class="text-xs leading-5
                                               text-slate-300 mt-1.5"
                                    >
                                        Rekap seluruh komponen nilai
                                        berdasarkan bobot penilaian.
                                    </p>


                                    <div
                                        class="flex flex-wrap
                                               items-center
                                               gap-x-4 gap-y-2 mt-3"
                                    >

                                        <span
                                            class="text-[11px]
                                                   text-slate-300"
                                        >
                                            Absensi
                                            <strong class="text-white">
                                                10%
                                            </strong>
                                        </span>


                                        <span
                                            class="text-[11px]
                                                   text-slate-300"
                                        >
                                            LKPD
                                            <strong class="text-white">
                                                30%
                                            </strong>
                                        </span>


                                        <span
                                            class="text-[11px]
                                                   text-slate-300"
                                        >
                                            Quiz
                                            <strong class="text-white">
                                                25%
                                            </strong>
                                        </span>


                                        <span
                                            class="text-[11px]
                                                   text-slate-300"
                                        >
                                            Praktik
                                            <strong class="text-white">
                                                25%
                                            </strong>
                                        </span>


                                        <span
                                            class="text-[11px]
                                                   text-slate-300"
                                        >
                                            Refleksi
                                            <strong class="text-white">
                                                10%
                                            </strong>
                                        </span>

                                    </div>

                                </div>

                            </div>


                            <form
                                action="{{ route('guru.exports.final-grades') }}"
                                method="GET"
                                class="w-full lg:w-[280px] shrink-0"
                            >

                                <label
                                    for="kelas-final"
                                    class="block text-[11px]
                                           font-bold text-slate-300 mb-2"
                                >
                                    Pilih Kelas
                                </label>


                                <select
                                    name="kelas"
                                    id="kelas-final"
                                    class="class-select w-full h-11
                                           rounded-xl
                                           border border-white/10
                                           bg-white/10
                                           px-3 pr-10
                                           text-sm font-semibold
                                           text-white
                                           outline-none
                                           focus:bg-white/15
                                           focus:border-white/30
                                           focus:ring-4
                                           focus:ring-white/10
                                           transition"
                                >

                                    <option
                                        value=""
                                        class="text-slate-900"
                                    >
                                        Semua Kelas
                                    </option>

                                    @foreach($kelas as $item)

                                        <option
                                            value="{{ $item }}"
                                            class="text-slate-900"
                                        >
                                            {{ $item }}
                                        </option>

                                    @endforeach

                                </select>


                                <button
                                    type="submit"
                                    class="mt-3 w-full
                                           inline-flex items-center
                                           justify-center gap-2
                                           px-5 py-3 rounded-xl
                                           bg-white
                                           hover:bg-slate-100
                                           text-slate-900
                                           text-xs font-bold
                                           transition shadow-sm"
                                >

                                    <i
                                        data-lucide="download"
                                        class="w-4 h-4"
                                    ></i>

                                    Export Nilai Akhir

                                </button>

                            </form>

                        </div>

                    </article>

                </div>

            </section>

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