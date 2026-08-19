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

        .ranking-card {
            transition: .2s ease;
        }

        .ranking-card:hover {
            transform: translateY(-1px);
            border-color: #d7dee9;
            box-shadow:
                0 8px 25px rgba(15, 23, 42, .05);
        }

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }

    </style>

</head>


<body>

    @include('guru.partials.sidebar')


    <main
        id="mainContent"
        class="main-content"
    >


        {{-- =====================================================
             HEADBAR GURU
        ====================================================== --}}

        @include('guru.partials.header')


        {{-- CONTENT --}}

        <div
            class="
                max-w-7xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


            {{-- =================================================
                 TITLE
            ================================================== --}}

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

                    Evaluasi Pembelajaran

                </div>


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
                    "
                >
                    Peringkat berdasarkan empat aspek penilaian:
                    <strong>Absensi, Quiz, LKPD, dan Refleksi.</strong>
                    Nilai akhir hanya ditampilkan setelah seluruh aspek
                    penilaian siswa lengkap.
                </p>

            </section>


            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-3
                    gap-4
                    mb-6
                "
            >


                {{-- SISWA --}}

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-xs
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
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-xs
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
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-5
                        shadow-sm
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                        "
                    >

                        <div>

                            <p
                                class="
                                    text-xs
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
                                {{ number_format($averageFinalScore, 2) }}
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


            {{-- =================================================
                 INFO 4 ASPEK
            ================================================== --}}

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

                <div
                    class="
                        flex
                        items-start
                        gap-3
                    "
                >

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


                    <div>

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
                            Nilai akhir dihitung dari empat aspek dengan bobot:

                        </p>


                        <div
                            class="
                                flex
                                flex-wrap
                                gap-2
                                mt-3
                            "
                        >

                            <span
                                class="
                                    px-3
                                    py-1.5
                                    rounded-lg
                                    bg-blue-50
                                    text-blue-700
                                    text-xs
                                    font-bold
                                "
                            >
                                Absensi 20%
                            </span>

                            <span
                                class="
                                    px-3
                                    py-1.5
                                    rounded-lg
                                    bg-violet-50
                                    text-violet-700
                                    text-xs
                                    font-bold
                                "
                            >
                                Quiz 35%
                            </span>

                            <span
                                class="
                                    px-3
                                    py-1.5
                                    rounded-lg
                                    bg-emerald-50
                                    text-emerald-700
                                    text-xs
                                    font-bold
                                "
                            >
                                LKPD 25%
                            </span>

                            <span
                                class="
                                    px-3
                                    py-1.5
                                    rounded-lg
                                    bg-amber-50
                                    text-amber-700
                                    text-xs
                                    font-bold
                                "
                            >
                                Refleksi 20%
                            </span>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 FILTER KELAS
            ================================================== --}}

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
                    action="{{ route('guru.quiz-ranking.index') }}"
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-end
                        gap-4
                    "
                >

                    <div class="flex-1">

                        <label
                            class="
                                block
                                text-xs
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
                            href="{{ route('guru.quiz-ranking.index') }}"
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


            {{-- =================================================
                 RANKING
            ================================================== --}}

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

                <div
                    class="
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
                            Semua siswa ditampilkan berdasarkan
                            kelengkapan dan nilai akhir pembelajaran.
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
                            data-lucide="list-ordered"
                            class="w-4 h-4"
                        ></i>

                        {{ $totalStudents }} Siswa

                    </div>

                </div>


                @if($ranking->count() > 0)

                    {{-- DESKTOP --}}

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

                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Rank
                                    </th>

                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Siswa
                                    </th>

                                    <th class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Absensi
                                    </th>

                                    <th class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Quiz
                                    </th>

                                    <th class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        LKPD
                                    </th>

                                    <th class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Refleksi
                                    </th>

                                    <th class="px-4 py-3 text-center text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Nilai Akhir
                                    </th>

                                    <th class="px-4 py-3 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                                        Status
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($ranking as $item)

                                    <tr
                                        class="
                                            ranking-card
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

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    min-w-[60px]
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

                                            <div class="text-[10px] text-slate-400 mt-1">
                                                {{ $item['hadir'] }}/{{ $totalPertemuan }} hadir
                                            </div>

                                        </td>


                                        {{-- QUIZ --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($item['quiz_average'] !== null)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[60px]
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-violet-50
                                                        text-violet-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['quiz_average'], 1) }}
                                                </span>

                                                <div class="text-[10px] text-slate-400 mt-1">
                                                    {{ $item['quiz_count'] }} quiz
                                                </div>

                                            @else

                                                <span class="text-xs font-semibold text-slate-300">
                                                    Belum
                                                </span>

                                            @endif

                                        </td>


                                        {{-- LKPD --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($item['lkpd_score'] !== null)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[60px]
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-emerald-50
                                                        text-emerald-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['lkpd_score'], 1) }}
                                                </span>

                                            @else

                                                <span class="text-xs font-semibold text-slate-300">
                                                    —
                                                </span>

                                            @endif

                                        </td>


                                        {{-- REFLEKSI --}}

                                        <td class="px-4 py-4 text-center">

                                            @if($item['reflection_score'] !== null)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[60px]
                                                        px-2
                                                        py-1.5
                                                        rounded-lg
                                                        bg-amber-50
                                                        text-amber-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ number_format($item['reflection_score'], 1) }}
                                                </span>

                                            @else

                                                <span class="text-xs font-semibold text-slate-300">
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
                                                        min-w-[75px]
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        bg-slate-900
                                                        text-white
                                                        text-sm
                                                        font-black
                                                    "
                                                >
                                                    {{ number_format($item['final_score'], 2) }}
                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-[75px]
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

                                        <td class="px-4 py-4 min-w-[260px]">

                                            @if($item['is_complete'])

                                                <div
                                                    class="
                                                        inline-flex
                                                        items-start
                                                        gap-2
                                                        text-emerald-700
                                                    "
                                                >

                                                    <i
                                                        data-lucide="circle-check"
                                                        class="w-4 h-4 mt-0.5 shrink-0"
                                                    ></i>

                                                    <div>

                                                        <div class="text-xs font-bold">
                                                            Semua aspek lengkap
                                                        </div>

                                                        <div class="text-[10px] text-slate-400 mt-1">
                                                            Absensi, Quiz, LKPD, dan Refleksi selesai.
                                                        </div>

                                                    </div>

                                                </div>

                                            @else

                                                <div
                                                    class="
                                                        flex
                                                        items-start
                                                        gap-2
                                                        text-amber-600
                                                    "
                                                >

                                                    <i
                                                        data-lucide="triangle-alert"
                                                        class="w-4 h-4 mt-0.5 shrink-0"
                                                    ></i>

                                                    <div>

                                                        <div class="text-xs font-bold">
                                                            Penilaian belum lengkap
                                                        </div>

                                                        @if(!empty($item['missing']))

                                                            <ul class="mt-1 space-y-1">

                                                                @foreach($item['missing'] as $missing)

                                                                    <li
                                                                        class="
                                                                            text-[10px]
                                                                            text-slate-500
                                                                        "
                                                                    >
                                                                        • {{ $missing }}
                                                                    </li>

                                                                @endforeach

                                                            </ul>

                                                        @endif

                                                    </div>

                                                </div>

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- TABLET / MOBILE --}}

                    <div
                        class="
                            xl:hidden
                            divide-y
                            divide-slate-100
                        "
                    >

                        @foreach($ranking as $item)

                            <div class="p-5">

                                {{-- HEADER SISWA --}}

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-3
                                    "
                                >

                                    <div class="flex items-center gap-3 min-w-0">

                                        <div
                                            class="
                                                w-10
                                                h-10
                                                min-w-[40px]
                                                rounded-xl
                                                bg-slate-100
                                                text-slate-600
                                                flex
                                                items-center
                                                justify-center
                                                font-black
                                            "
                                        >
                                            {{ $item['rank'] ?? '—' }}
                                        </div>


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


                                    <div class="text-right shrink-0">

                                        @if($item['final_score'] !== null)

                                            <p
                                                class="
                                                    text-lg
                                                    font-black
                                                    text-slate-900
                                                "
                                            >
                                                {{ number_format($item['final_score'], 2) }}
                                            </p>

                                        @else

                                            <p
                                                class="
                                                    text-lg
                                                    font-black
                                                    text-slate-300
                                                "
                                            >
                                                —
                                            </p>

                                        @endif


                                        <p
                                            class="
                                                text-[10px]
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


                                {{-- 4 ASPEK --}}

                                <div
                                    class="
                                        grid
                                        grid-cols-2
                                        sm:grid-cols-4
                                        gap-2
                                        mt-4
                                    "
                                >

                                    {{-- ABSENSI --}}

                                    <div
                                        class="
                                            rounded-xl
                                            bg-blue-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p class="text-[10px] uppercase font-bold text-blue-500">
                                            Absensi
                                        </p>

                                        <p class="text-sm font-black text-blue-700 mt-1">
                                            {{ number_format($item['attendance_percentage'], 0) }}%
                                        </p>

                                    </div>


                                    {{-- QUIZ --}}

                                    <div
                                        class="
                                            rounded-xl
                                            bg-violet-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p class="text-[10px] uppercase font-bold text-violet-500">
                                            Quiz
                                        </p>

                                        <p class="text-sm font-black text-violet-700 mt-1">

                                            @if($item['quiz_average'] !== null)
                                                {{ number_format($item['quiz_average'], 1) }}
                                            @else
                                                —
                                            @endif

                                        </p>

                                    </div>


                                    {{-- LKPD --}}

                                    <div
                                        class="
                                            rounded-xl
                                            bg-emerald-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p class="text-[10px] uppercase font-bold text-emerald-500">
                                            LKPD
                                        </p>

                                        <p class="text-sm font-black text-emerald-700 mt-1">

                                            @if($item['lkpd_score'] !== null)
                                                {{ number_format($item['lkpd_score'], 1) }}
                                            @else
                                                —
                                            @endif

                                        </p>

                                    </div>


                                    {{-- REFLEKSI --}}

                                    <div
                                        class="
                                            rounded-xl
                                            bg-amber-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p class="text-[10px] uppercase font-bold text-amber-500">
                                            Refleksi
                                        </p>

                                        <p class="text-sm font-black text-amber-700 mt-1">

                                            @if($item['reflection_score'] !== null)
                                                {{ number_format($item['reflection_score'], 1) }}
                                            @else
                                                —
                                            @endif

                                        </p>

                                    </div>

                                </div>


                                {{-- STATUS MOBILE --}}

                                <div class="mt-4">

                                    @if($item['is_complete'])

                                        <div
                                            class="
                                                flex
                                                items-start
                                                gap-2
                                                p-3
                                                rounded-xl
                                                bg-emerald-50
                                                border
                                                border-emerald-100
                                            "
                                        >

                                            <i
                                                data-lucide="circle-check"
                                                class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0"
                                            ></i>

                                            <div>

                                                <p class="text-xs font-bold text-emerald-700">
                                                    Semua aspek penilaian sudah lengkap
                                                </p>

                                                <p class="text-[10px] text-emerald-600 mt-1">
                                                    Absensi, Quiz, LKPD, dan Refleksi telah selesai.
                                                </p>

                                            </div>

                                        </div>

                                    @else

                                        <div
                                            class="
                                                p-3
                                                rounded-xl
                                                bg-amber-50
                                                border
                                                border-amber-100
                                            "
                                        >

                                            <div class="flex items-start gap-2">

                                                <i
                                                    data-lucide="triangle-alert"
                                                    class="w-4 h-4 text-amber-600 mt-0.5 shrink-0"
                                                ></i>

                                                <div>

                                                    <p class="text-xs font-bold text-amber-700">
                                                        Penilaian belum lengkap
                                                    </p>

                                                    @if(!empty($item['missing']))

                                                        <ul class="mt-1 space-y-1">

                                                            @foreach($item['missing'] as $missing)

                                                                <li class="text-[10px] text-amber-700">
                                                                    • {{ $missing }}
                                                                </li>

                                                            @endforeach

                                                        </ul>

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

                    {{-- EMPTY --}}

                    <div
                        class="
                            p-14
                            text-center
                        "
                    >

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