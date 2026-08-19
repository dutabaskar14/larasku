<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Peringkat Quiz — LARASKU</title>

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

        {{-- HEADER --}}

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
                sticky
                top-0
                z-20
            "
        >

            <div>

                <p class="text-xs text-slate-400">
                    Panel Guru
                </p>

                <h2 class="font-bold text-slate-900">
                    Peringkat Siswa
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
                G
            </div>

        </header>


        {{-- CONTENT --}}

        <div
            class="
                max-w-6xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >

            {{-- TITLE --}}

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
                    Peringkat Siswa
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Peringkat berdasarkan nilai Quiz 80%
                    dan kehadiran 20%.
                </p>

            </section>


            {{-- STATISTIK --}}

            <div
                class="
                    grid
                    grid-cols-1
                    md:grid-cols-3
                    gap-4
                    mb-6
                "
            >

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
                                {{ $totalRanked }}
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
                                Rata-rata Nilai
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
                                bg-emerald-50
                                text-emerald-600
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
                                Nilai Tertinggi
                            </p>

                            <p
                                class="
                                    text-3xl
                                    font-black
                                    text-slate-900
                                    mt-2
                                "
                            >
                                {{ number_format($highestFinalScore, 2) }}
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
                                data-lucide="award"
                                class="w-5 h-5"
                            ></i>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FILTER KELAS --}}

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


            {{-- RANKING --}}

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
                    "
                >

                    <div>

                        <h3
                            class="
                                font-black
                                text-slate-900
                            "
                        >
                            Ranking Siswa
                        </h3>

                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >
                            Siswa yang sudah mengerjakan minimal satu Quiz.
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
                        "
                    >

                        <i
                            data-lucide="list-ordered"
                            class="w-4 h-4"
                        ></i>

                        {{ $totalRanked }} Siswa

                    </div>

                </div>


                @if($ranking->count() > 0)

                    {{-- DESKTOP TABLE --}}

                    <div class="hidden md:block overflow-x-auto">

                        <table class="w-full">

                            <thead>

                                <tr
                                    class="
                                        bg-slate-50
                                        border-b
                                        border-slate-100
                                    "
                                >

                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Rank
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Siswa
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Quiz
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Rata-rata Quiz
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-center
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Kehadiran
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-right
                                            text-[11px]
                                            font-bold
                                            uppercase
                                            tracking-wider
                                            text-slate-400
                                        "
                                    >
                                        Nilai Akhir
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

                                        <td class="px-5 py-4">

                                            @if($item['rank'] === 1)

                                                <div
                                                    class="
                                                        w-9
                                                        h-9
                                                        rounded-xl
                                                        bg-amber-50
                                                        text-amber-600
                                                        flex
                                                        items-center
                                                        justify-center
                                                        font-black
                                                    "
                                                >
                                                    1
                                                </div>

                                            @elseif($item['rank'] === 2)

                                                <div
                                                    class="
                                                        w-9
                                                        h-9
                                                        rounded-xl
                                                        bg-slate-100
                                                        text-slate-600
                                                        flex
                                                        items-center
                                                        justify-center
                                                        font-black
                                                    "
                                                >
                                                    2
                                                </div>

                                            @elseif($item['rank'] === 3)

                                                <div
                                                    class="
                                                        w-9
                                                        h-9
                                                        rounded-xl
                                                        bg-orange-50
                                                        text-orange-600
                                                        flex
                                                        items-center
                                                        justify-center
                                                        font-black
                                                    "
                                                >
                                                    3
                                                </div>

                                            @else

                                                <div
                                                    class="
                                                        w-9
                                                        h-9
                                                        rounded-xl
                                                        bg-slate-50
                                                        text-slate-500
                                                        flex
                                                        items-center
                                                        justify-center
                                                        font-bold
                                                    "
                                                >
                                                    {{ $item['rank'] }}
                                                </div>

                                            @endif

                                        </td>


                                        {{-- SISWA --}}

                                        <td class="px-5 py-4">

                                            <div
                                                class="
                                                    font-bold
                                                    text-slate-800
                                                "
                                            >
                                                {{ $item['student']->nama }}
                                            </div>


                                            <div
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
                                            </div>

                                        </td>


                                        {{-- QUIZ --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-center
                                            "
                                        >

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    min-w-[34px]
                                                    px-2
                                                    py-1
                                                    rounded-lg
                                                    bg-blue-50
                                                    text-blue-600
                                                    text-xs
                                                    font-bold
                                                "
                                            >
                                                {{ $item['quiz_count'] }}
                                            </span>

                                        </td>


                                        {{-- RATA-RATA QUIZ --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-center
                                                text-sm
                                                font-bold
                                                text-slate-700
                                            "
                                        >
                                            {{ number_format(
                                                $item['quiz_average'],
                                                2
                                            ) }}
                                        </td>


                                        {{-- KEHADIRAN --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-center
                                            "
                                        >

                                            <div
                                                class="
                                                    text-sm
                                                    font-bold
                                                    text-slate-700
                                                "
                                            >
                                                {{ number_format(
                                                    $item['attendance_percentage'],
                                                    0
                                                ) }}%
                                            </div>


                                            <div
                                                class="
                                                    text-[11px]
                                                    text-slate-400
                                                    mt-1
                                                "
                                            >
                                                {{ $item['hadir'] }}/8 hadir
                                            </div>

                                        </td>


                                        {{-- NILAI AKHIR --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-right
                                            "
                                        >

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    min-w-[70px]
                                                    px-3
                                                    py-2
                                                    rounded-xl
                                                    bg-slate-900
                                                    text-white
                                                    text-sm
                                                    font-black
                                                "
                                            >
                                                {{ number_format(
                                                    $item['final_score'],
                                                    2
                                                ) }}
                                            </span>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- MOBILE --}}

                    <div
                        class="
                            md:hidden
                            divide-y
                            divide-slate-100
                        "
                    >

                        @foreach($ranking as $item)

                            <div class="p-5">

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-3
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
                                                min-w-[36px]
                                                rounded-xl
                                                bg-slate-100
                                                text-slate-600
                                                flex
                                                items-center
                                                justify-center
                                                font-black
                                            "
                                        >
                                            {{ $item['rank'] }}
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
                                            </p>

                                        </div>

                                    </div>


                                    <div class="text-right">

                                        <p
                                            class="
                                                text-lg
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            {{ number_format(
                                                $item['final_score'],
                                                2
                                            ) }}
                                        </p>


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


                                <div
                                    class="
                                        grid
                                        grid-cols-3
                                        gap-2
                                        mt-4
                                    "
                                >

                                    <div
                                        class="
                                            rounded-xl
                                            bg-slate-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p
                                            class="
                                                text-[10px]
                                                uppercase
                                                font-bold
                                                text-slate-400
                                            "
                                        >
                                            Quiz
                                        </p>

                                        <p
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-700
                                                mt-1
                                            "
                                        >
                                            {{ $item['quiz_count'] }}
                                        </p>

                                    </div>


                                    <div
                                        class="
                                            rounded-xl
                                            bg-slate-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p
                                            class="
                                                text-[10px]
                                                uppercase
                                                font-bold
                                                text-slate-400
                                            "
                                        >
                                            Quiz Avg
                                        </p>

                                        <p
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-700
                                                mt-1
                                            "
                                        >
                                            {{ number_format(
                                                $item['quiz_average'],
                                                1
                                            ) }}
                                        </p>

                                    </div>


                                    <div
                                        class="
                                            rounded-xl
                                            bg-slate-50
                                            p-3
                                            text-center
                                        "
                                    >

                                        <p
                                            class="
                                                text-[10px]
                                                uppercase
                                                font-bold
                                                text-slate-400
                                            "
                                        >
                                            Hadir
                                        </p>

                                        <p
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-700
                                                mt-1
                                            "
                                        >
                                            {{ $item['hadir'] }}/8
                                        </p>

                                    </div>

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
                            Belum ada peringkat
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Belum ada siswa yang mengerjakan Quiz.
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