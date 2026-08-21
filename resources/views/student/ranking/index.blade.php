<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Peringkat Seni Budaya — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f7fb;
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
            margin-left: 240px;
            min-height: 100vh;
        }

        .ranking-row {
            transition: .18s ease;
        }

        .ranking-row:hover {
            background: #fafcff;
        }

        .score-box {
            min-width: 58px;
        }

        .status-list {
            max-height: 110px;
            overflow-y: auto;
        }

        .status-list::-webkit-scrollbar {
            width: 4px;
        }

        .status-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }

        @media (max-width: 639px) {

            .page-container {
                padding-left: 12px !important;
                padding-right: 12px !important;
                padding-top: 18px !important;
            }

            .stat-card {
                padding: 14px !important;
            }

            .system-card {
                padding: 14px !important;
            }

            .ranking-header {
                padding: 14px !important;
            }

            .student-card {
                padding: 14px !important;
            }

        }

    </style>

</head>


<body>

    @include('partials.sidebar')


    <main
        id="mainContent"
        class="main-content"
    >

    


        <div
            class="
                page-container
                max-w-7xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <section class="mb-6">

                <div
                    class="
                        inline-flex
                        items-center
                        gap-2
                        px-3
                        py-1.5
                        rounded-full
                        bg-blue-50
                        text-blue-600
                        text-xs
                        font-bold
                        mb-3
                    "
                >

                    <i
                        data-lucide="trophy"
                        class="w-3.5 h-3.5"
                    ></i>

                    Peringkat Pembelajaran

                </div>


                <div
                    class="
                        flex
                        flex-col
                        lg:flex-row
                        lg:items-end
                        lg:justify-between
                        gap-3
                    "
                >

                    <div>

                        <h1
                            class="
                                text-3xl
                                lg:text-4xl
                                font-black
                                tracking-tight
                                text-slate-900
                            "
                        >
                            Peringkat Seni Budaya
                        </h1>

                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                max-w-3xl
                                leading-6
                            "
                        >
                            Peringkat berdasarkan lima aspek penilaian:
                            <strong class="text-slate-700">
                                Absensi, Quiz, LKPD, Refleksi, dan Praktik.
                            </strong>
                            Nilai akhir hanya dihitung apabila seluruh aspek
                            telah lengkap.
                        </p>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                 STATISTIK
            ========================================================== --}}

            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-3
                    gap-4
                    mb-6
                "
            >

                {{-- TOTAL SISWA --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-400
                                "
                            >
                                Siswa Terdaftar
                            </p>

                            <p
                                class="
                                    text-3xl
                                    font-black
                                    text-slate-900
                                    mt-2
                                "
                            >
                                {{ $totalStudents }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-blue-50
                                text-blue-600
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="users"
                                class="w-5 h-5"
                            ></i>

                        </div>

                    </div>

                </div>


                {{-- LENGKAP --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-400
                                "
                            >
                                Penilaian Lengkap
                            </p>

                            <p
                                class="
                                    text-3xl
                                    font-black
                                    text-slate-900
                                    mt-2
                                "
                            >
                                {{ $totalRanked }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-emerald-50
                                text-emerald-600
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="badge-check"
                                class="w-5 h-5"
                            ></i>

                        </div>

                    </div>

                </div>


                {{-- RATA-RATA --}}

                <div
                    class="
                        stat-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-[11px]
                                    font-bold
                                    uppercase
                                    tracking-wider
                                    text-slate-400
                                "
                            >
                                Rata-rata Nilai Akhir
                            </p>

                            <p
                                class="
                                    text-3xl
                                    font-black
                                    text-slate-900
                                    mt-2
                                "
                            >
                                {{ number_format($averageFinalScore, 0) }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-amber-50
                                text-amber-600
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="chart-no-axes-column"
                                class="w-5 h-5"
                            ></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 SISTEM PENILAIAN
            ========================================================== --}}

            <section
                class="
                    system-card
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-5
                    mb-6
                "
            >

                <div class="flex items-start gap-3">

                    <div
                        class="
                            w-10
                            h-10
                            shrink-0
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            data-lucide="graduation-cap"
                            class="w-5 h-5"
                        ></i>

                    </div>


                    <div class="min-w-0">

                        <h3
                            class="
                                font-black
                                text-slate-900
                            "
                        >
                            Sistem Penilaian
                        </h3>

                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >
                            Nilai akhir menggunakan lima aspek berikut.
                        </p>


                        <div
                            class="
                                flex
                                flex-wrap
                                gap-2
                                mt-3
                            "
                        >

                            <span class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 text-xs font-bold">
                                Absensi 10%
                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-violet-50 text-violet-700 text-xs font-bold">
                                Quiz 25%
                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold">
                                LKPD 30%
                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-amber-50 text-amber-700 text-xs font-bold">
                                Refleksi 10%
                            </span>

                            <span class="px-3 py-1.5 rounded-lg bg-rose-50 text-rose-700 text-xs font-bold">
                                Praktik 25%
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                 FILTER
            ========================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-5
                    mb-6
                "
            >

                <form
                    method="GET"
                    action="{{ route('student.ranking.index') }}"
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-end
                        gap-3
                    "
                >

                    <div class="flex-1">

                        <label
                            class="
                                block
                                text-[11px]
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-400
                                mb-2
                            "
                        >
                            Filter Kelas
                        </label>


                        <select
                            name="kelas"
                            class="
                                w-full
                                px-4
                                py-3
                                rounded-xl
                                border
                                border-slate-200
                                bg-white
                                text-sm
                                font-semibold
                                text-slate-700
                                outline-none
                                focus:border-blue-500
                                focus:ring-2
                                focus:ring-blue-100
                            "
                        >

                            <option value="">
                                Semua Kelas
                            </option>


                            @foreach($classes as $class)

                                <option
                                    value="{{ $class }}"
                                    {{ $kelas === $class ? 'selected' : '' }}
                                >
                                    {{ $class }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-3
                            rounded-xl
                            bg-slate-900
                            hover:bg-slate-800
                            text-white
                            text-sm
                            font-bold
                            transition
                        "
                    >

                        <i
                            data-lucide="filter"
                            class="w-4 h-4"
                        ></i>

                        Terapkan

                    </button>


                    @if($kelas !== '')

                        <a
                            href="{{ route('student.ranking.index') }}"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                px-5
                                py-3
                                rounded-xl
                                border
                                border-slate-200
                                bg-white
                                text-slate-600
                                hover:bg-slate-50
                                text-sm
                                font-bold
                                transition
                            "
                        >

                            <i
                                data-lucide="x"
                                class="w-4 h-4"
                            ></i>

                            Reset

                        </a>

                    @endif

                </form>

            </section>


            {{-- =========================================================
                 RANKING
            ========================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    overflow-hidden
                "
            >

                {{-- HEADER --}}

                <div
                    class="
                        ranking-header
                        px-5
                        py-5
                        border-b
                        border-slate-100
                        flex
                        items-center
                        justify-between
                        gap-4
                    "
                >

                    <div>

                        <h3
                            class="
                                font-black
                                text-slate-900
                            "
                        >
                            Peringkat Siswa
                        </h3>

                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >
                            Siswa lengkap diprioritaskan berdasarkan nilai akhir.
                        </p>

                    </div>


                    <div
                        class="
                            inline-flex
                            items-center
                            gap-2
                            px-3
                            py-2
                            rounded-xl
                            bg-slate-50
                            text-slate-500
                            text-xs
                            font-bold
                            whitespace-nowrap
                        "
                    >

                        <i
                            data-lucide="users"
                            class="w-4 h-4"
                        ></i>

                        {{ $totalStudents }} Siswa

                    </div>

                </div>


                @if($ranking->count() > 0)

                    {{-- =================================================
                         DESKTOP
                    ================================================== --}}

                    <div class="hidden xl:block overflow-x-auto">

                        <table class="w-full">

                            <thead>

                                <tr
                                    class="
                                        bg-slate-50
                                        border-b
                                        border-slate-100
                                    "
                                >

                                    <th class="px-4 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Rank
                                    </th>

                                    <th class="px-4 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Siswa
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Absensi
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Quiz
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        LKPD
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Refleksi
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Praktik
                                    </th>

                                    <th class="px-4 py-3 text-center text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Nilai Akhir
                                    </th>

                                    <th class="px-4 py-3 text-left text-[10px] font-bold uppercase tracking-wider text-slate-400">
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($ranking as $item)

                                    <tr
                                        class="
                                            ranking-row
                                            border-b
                                            border-slate-100
                                            last:border-0
                                        "
                                    >

                                        {{-- RANK --}}

                                        <td class="px-4 py-4">

                                            @if($item['rank'] === 1)

                                                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black">
                                                    1
                                                </div>

                                            @elseif($item['rank'] === 2)

                                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-black">
                                                    2
                                                </div>

                                            @elseif($item['rank'] === 3)

                                                <div class="w-9 h-9 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center font-black">
                                                    3
                                                </div>

                                            @elseif($item['rank'] !== null)

                                                <div class="w-9 h-9 rounded-xl bg-slate-50 text-slate-500 flex items-center justify-center font-bold">
                                                    {{ $item['rank'] }}
                                                </div>

                                            @else

                                                <div class="w-9 h-9 rounded-xl bg-slate-50 text-slate-300 flex items-center justify-center font-bold">
                                                    —
                                                </div>

                                            @endif

                                        </td>


                                        {{-- SISWA --}}

                                        <td class="px-4 py-4">

                                            <div class="font-bold text-slate-800">
                                                {{ $item['student']->nama }}
                                            </div>

                                            <div class="text-xs text-slate-400 mt-1">

                                                {{ $item['student']->kelas ?: 'Tanpa kelas' }}

                                                @if($item['student']->nomor_absen)

                                                    · No. {{ $item['student']->nomor_absen }}

                                                @endif

                                            </div>

                                        </td>


                                        {{-- ABSENSI --}}

                                        <td class="px-4 py-4 text-center">

                                            <div class="text-[10px] text-slate-400 font-semibold mb-1">
                                                {{ $totalPertemuan > 0 ? $item['hadir'] . '/' . $totalPertemuan : '—' }}
                                            </div>

                                            <span
                                                class="
                                                    score-box
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    px-2
                                                    py-1.5
                                                    rounded-lg
                                                    bg-blue-50
                                                    text-blue-700
                                                    text-xs
                                                    font-bold
                                                "
                                            >
                                                {{ number_format($item['attendance_percentage'], 0) }}%
                                            </span>

                                        </td>


                                        {{-- QUIZ --}}

                                        <td class="px-4 py-4 text-center">

                                            <div class="text-[10px] text-slate-400 font-semibold mb-1">
                                                {{ $item['quiz_total'] > 0 ? $item['quiz_count'] . '/' . $item['quiz_total'] : '—' }}
                                            </div>

                                            @if($item['quiz_average'] !== null)

                                                <span
                                                    class="
                                                        score-box
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-violet-50
                                                        text-violet-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['quiz_average'], 0) }}
                                                </span>

                                            @else

                                                <span class="text-slate-300 text-sm font-bold">
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- LKPD --}}

                                        <td class="px-4 py-4 text-center">

                                            <div class="text-[10px] text-slate-400 font-semibold mb-1">
                                                {{ $item['lkpd_total'] > 0 ? $item['lkpd_count'] . '/' . $item['lkpd_total'] : '—' }}
                                            </div>

                                            @if($item['lkpd_score'] !== null)

                                                <span
                                                    class="
                                                        score-box
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-emerald-50
                                                        text-emerald-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['lkpd_score'], 0) }}
                                                </span>

                                            @else

                                                <span class="text-slate-300 text-sm font-bold">
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- REFLEKSI --}}

                                        <td class="px-4 py-4 text-center">

                                            <div class="text-[10px] text-slate-400 font-semibold mb-1">
                                                {{ $item['reflection_total'] > 0 ? $item['reflection_count'] . '/' . $item['reflection_total'] : '—' }}
                                            </div>

                                            @if($item['reflection_score'] !== null)

                                                <span
                                                    class="
                                                        score-box
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-amber-50
                                                        text-amber-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['reflection_score'], 0) }}
                                                </span>

                                            @else

                                                <span class="text-slate-300 text-sm font-bold">
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- PRAKTIK --}}

                                        <td class="px-4 py-4 text-center">

                                            <div class="text-[10px] text-slate-400 font-semibold mb-1">
                                                {{ $item['practice_total'] > 0 ? $item['practice_count'] . '/' . $item['practice_total'] : '—' }}
                                            </div>

                                            @if($item['practice_score'] !== null)

                                                <span
                                                    class="
                                                        score-box
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-rose-50
                                                        text-rose-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['practice_score'], 0) }}
                                                </span>

                                            @else

                                                <span class="text-slate-300 text-sm font-bold">
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- NILAI AKHIR --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($item['final_score'] !== null)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[72px]
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        bg-slate-900
                                                        text-white
                                                        text-sm
                                                        font-black
                                                    "
                                                >
                                                    {{ number_format($item['final_score'], 0) }}
                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[72px]
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        bg-slate-100
                                                        text-slate-400
                                                        text-sm
                                                        font-bold
                                                    "
                                                >
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- STATUS --}}

                                        <td class="px-4 py-4 min-w-[270px]">

                                            @if($item['is_complete'])

                                                <div
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-2
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        bg-emerald-50
                                                        border
                                                        border-emerald-100
                                                        text-emerald-700
                                                    "
                                                >

                                                    <i
                                                        data-lucide="circle-check"
                                                        class="w-4 h-4 shrink-0"
                                                    ></i>

                                                    <div>

                                                        <div class="text-xs font-bold">
                                                            Penilaian lengkap
                                                        </div>

                                                        <div class="text-[10px] text-emerald-600 mt-0.5">
                                                            Semua aspek sudah selesai.
                                                        </div>

                                                    </div>

                                                </div>

                                            @else

                                                <div
                                                    class="
                                                        rounded-xl
                                                        bg-amber-50
                                                        border
                                                        border-amber-100
                                                        p-3
                                                    "
                                                >

                                                    <div class="flex items-start gap-2">

                                                        <i
                                                            data-lucide="triangle-alert"
                                                            class="w-4 h-4 text-amber-600 mt-0.5 shrink-0"
                                                        ></i>

                                                        <div class="min-w-0">

                                                            <div class="text-xs font-bold text-amber-700">
                                                                Penilaian belum lengkap
                                                            </div>


                                                            @if(!empty($item['missing']))

                                                                <div class="status-list mt-2 space-y-1">

                                                                    @foreach($item['missing'] as $missing)

                                                                        <div
                                                                            class="
                                                                                flex
                                                                                items-start
                                                                                gap-1.5
                                                                                text-[10px]
                                                                                text-slate-600
                                                                            "
                                                                        >

                                                                            <span class="text-amber-500 mt-[1px]">
                                                                                •
                                                                            </span>

                                                                            <span>
                                                                                {{ $missing }}
                                                                            </span>

                                                                        </div>

                                                                    @endforeach

                                                                </div>

                                                            @endif

                                                        </div>

                                                    </div>

                                                </div>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- =================================================
                         TABLET / MOBILE
                    ================================================== --}}

                    <div
                        class="
                            xl:hidden
                            divide-y
                            divide-slate-100
                        "
                    >

                        @foreach($ranking as $item)

                            <div class="student-card p-5">

                                {{-- SISWA --}}

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-3
                                    "
                                >

                                    <div class="flex items-center gap-3 min-w-0">

                                        @if($item['rank'] === 1)

                                            <div class="w-10 h-10 min-w-[40px] rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-black">
                                                1
                                            </div>

                                        @elseif($item['rank'] === 2)

                                            <div class="w-10 h-10 min-w-[40px] rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-black">
                                                2
                                            </div>

                                        @elseif($item['rank'] === 3)

                                            <div class="w-10 h-10 min-w-[40px] rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center font-black">
                                                3
                                            </div>

                                        @elseif($item['rank'] !== null)

                                            <div class="w-10 h-10 min-w-[40px] rounded-xl bg-slate-50 text-slate-500 flex items-center justify-center font-bold">
                                                {{ $item['rank'] }}
                                            </div>

                                        @else

                                            <div class="w-10 h-10 min-w-[40px] rounded-xl bg-slate-50 text-slate-300 flex items-center justify-center font-bold">
                                                —
                                            </div>

                                        @endif


                                        <div class="min-w-0">

                                            <p
                                                class="
                                                    font-bold
                                                    text-slate-800
                                                    truncate
                                                "
                                            >
                                                {{ $item['student']->nama }}
                                            </p>

                                            <p
                                                class="
                                                    text-xs
                                                    text-slate-400
                                                    mt-1
                                                "
                                            >

                                                {{ $item['student']->kelas ?: 'Tanpa kelas' }}

                                                @if($item['student']->nomor_absen)

                                                    · No. {{ $item['student']->nomor_absen }}

                                                @endif

                                            </p>

                                        </div>

                                    </div>


                                    {{-- NILAI AKHIR --}}

                                    <div class="text-right shrink-0">

                                        @if($item['final_score'] !== null)

                                            <p class="text-lg font-black text-slate-900">
                                                {{ number_format($item['final_score'], 0) }}
                                            </p>

                                        @else

                                            <p class="text-lg font-black text-slate-300">
                                                —
                                            </p>

                                        @endif

                                        <p
                                            class="
                                                text-[9px]
                                                uppercase
                                                font-bold
                                                tracking-wider
                                                text-slate-400
                                            "
                                        >
                                            Nilai Akhir
                                        </p>

                                    </div>

                                </div>


                                {{-- =================================================
                                     5 ASPEK
                                ================================================== --}}

                                <div
                                    class="
                                        grid
                                        grid-cols-2
                                        sm:grid-cols-5
                                        gap-2
                                        mt-4
                                    "
                                >

                                    {{-- ABSENSI --}}

                                    <div class="rounded-xl bg-blue-50 p-3 text-center">

                                        <p class="text-[9px] uppercase font-bold text-blue-500">
                                            Absen
                                        </p>

                                        <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                            {{ $totalPertemuan > 0 ? $item['hadir'] . '/' . $totalPertemuan : '—' }}
                                        </p>

                                        <p class="text-sm font-black text-blue-700 mt-0.5">
                                            {{ number_format($item['attendance_percentage'], 0) }}%
                                        </p>

                                    </div>


                                    {{-- QUIZ --}}

                                    <div class="rounded-xl bg-violet-50 p-3 text-center">

                                        <p class="text-[9px] uppercase font-bold text-violet-500">
                                            Quiz
                                        </p>

                                        <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                            {{ $item['quiz_total'] > 0 ? $item['quiz_count'] . '/' . $item['quiz_total'] : '—' }}
                                        </p>

                                        @if($item['quiz_average'] !== null)

                                            <p class="text-sm font-black text-violet-700 mt-0.5">
                                                {{ number_format($item['quiz_average'], 0) }}
                                            </p>

                                        @else

                                            <p class="text-sm font-black text-slate-300 mt-0.5">
                                                —
                                            </p>

                                        @endif

                                    </div>


                                    {{-- LKPD --}}

                                    <div class="rounded-xl bg-emerald-50 p-3 text-center">

                                        <p class="text-[9px] uppercase font-bold text-emerald-500">
                                            LKPD
                                        </p>

                                        <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                            {{ $item['lkpd_total'] > 0 ? $item['lkpd_count'] . '/' . $item['lkpd_total'] : '—' }}
                                        </p>

                                        @if($item['lkpd_score'] !== null)

                                            <p class="text-sm font-black text-emerald-700 mt-0.5">
                                                {{ number_format($item['lkpd_score'], 0) }}
                                            </p>

                                        @else

                                            <p class="text-sm font-black text-slate-300 mt-0.5">
                                                —
                                            </p>

                                        @endif

                                    </div>


                                    {{-- REFLEKSI --}}

                                    <div class="rounded-xl bg-amber-50 p-3 text-center">

                                        <p class="text-[9px] uppercase font-bold text-amber-500">
                                            Refleksi
                                        </p>

                                        <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                            {{ $item['reflection_total'] > 0 ? $item['reflection_count'] . '/' . $item['reflection_total'] : '—' }}
                                        </p>

                                        @if($item['reflection_score'] !== null)

                                            <p class="text-sm font-black text-amber-700 mt-0.5">
                                                {{ number_format($item['reflection_score'], 0) }}
                                            </p>

                                        @else

                                            <p class="text-sm font-black text-slate-300 mt-0.5">
                                                —
                                            </p>

                                        @endif

                                    </div>


                                    {{-- PRAKTIK --}}

                                    <div class="rounded-xl bg-rose-50 p-3 text-center">

                                        <p class="text-[9px] uppercase font-bold text-rose-500">
                                            Praktik
                                        </p>

                                        <p class="text-[10px] font-semibold text-slate-400 mt-1">
                                            {{ $item['practice_total'] > 0 ? $item['practice_count'] . '/' . $item['practice_total'] : '—' }}
                                        </p>

                                        @if($item['practice_score'] !== null)

                                            <p class="text-sm font-black text-rose-700 mt-0.5">
                                                {{ number_format($item['practice_score'], 0) }}
                                            </p>

                                        @else

                                            <p class="text-sm font-black text-slate-300 mt-0.5">
                                                —
                                            </p>

                                        @endif

                                    </div>

                                </div>


                                {{-- =================================================
                                     STATUS MOBILE
                                ================================================== --}}

                                <div class="mt-4">

                                    @if($item['is_complete'])

                                        <div
                                            class="
                                                flex
                                                items-center
                                                gap-2
                                                px-3
                                                py-2.5
                                                rounded-xl
                                                bg-emerald-50
                                                border
                                                border-emerald-100
                                            "
                                        >

                                            <i
                                                data-lucide="circle-check"
                                                class="w-4 h-4 text-emerald-600 shrink-0"
                                            ></i>

                                            <div>

                                                <p class="text-xs font-bold text-emerald-700">
                                                    Penilaian lengkap
                                                </p>

                                                <p class="text-[10px] text-emerald-600 mt-0.5">
                                                    Semua aspek sudah selesai.
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <div
                                            class="
                                                rounded-xl
                                                bg-amber-50
                                                border
                                                border-amber-100
                                                p-3
                                            "
                                        >

                                            <div class="flex items-start gap-2">

                                                <i
                                                    data-lucide="triangle-alert"
                                                    class="w-4 h-4 text-amber-600 mt-0.5 shrink-0"
                                                ></i>

                                                <div class="min-w-0">

                                                    <p class="text-xs font-bold text-amber-700">
                                                        Penilaian belum lengkap
                                                    </p>


                                                    @if(!empty($item['missing']))

                                                        <div class="mt-2 space-y-1">

                                                            @foreach($item['missing'] as $missing)

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-start
                                                                        gap-1.5
                                                                        text-[10px]
                                                                        text-slate-600
                                                                    "
                                                                >

                                                                    <span class="text-amber-500">
                                                                        •
                                                                    </span>

                                                                    <span>
                                                                        {{ $missing }}
                                                                    </span>

                                                                </div>

                                                            @endforeach

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>


                @else

                    {{-- =================================================
                         EMPTY
                    ================================================== --}}

                    <div class="p-14 text-center">

                        <div
                            class="
                                w-14
                                h-14
                                rounded-2xl
                                bg-slate-100
                                flex
                                items-center
                                justify-center
                                mx-auto
                                mb-4
                            "
                        >

                            <i
                                data-lucide="trophy"
                                class="w-7 h-7 text-slate-400"
                            ></i>

                        </div>


                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Belum ada data peringkat
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Belum terdapat data siswa untuk ditampilkan.
                        </p>

                    </div>

                @endif

            </section>

        </div>

    </main>


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