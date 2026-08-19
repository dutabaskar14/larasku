<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Hasil Quiz — LARASKU</title>

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


        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }


        .result-row {
            transition: .2s ease;
        }


        .result-row:hover {
            background: #fafbfc;
        }


        .score-high {
            background: #dcfce7;
            color: #15803d;
        }


        .score-medium {
            background: #fef3c7;
            color: #a16207;
        }


        .score-low {
            background: #fee2e2;
            color: #b91c1c;
        }

    </style>

</head>


<body>


    {{-- =========================================================
     SIDEBAR
========================================================== --}}

@include('guru.partials.sidebar')


{{-- =========================================================
     MAIN
========================================================== --}}

<main
    id="mainContent"
    class="main-content"
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
                max-w-6xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


            {{-- =================================================
                 KEMBALI
            ================================================== --}}

            <a
                href="{{ route(
                    'guru.quizzes.index',
                    [
                        'pertemuan' => $quiz->pertemuan
                    ]
                ) }}"
                class="
                    inline-flex
                    items-center
                    gap-2
                    mb-5
                    text-sm
                    font-semibold
                    text-slate-500
                    hover:text-blue-600
                "
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke Quiz

            </a>



            {{-- =================================================
                 HEADER
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
                        data-lucide="bar-chart-3"
                        class="w-3.5 h-3.5"
                    ></i>

                    Rekap Penilaian

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
                    Hasil Quiz
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Daftar hasil siswa untuk Quiz
                    Pertemuan {{ $quiz->pertemuan }}.
                </p>

            </section>



            {{-- =================================================
                 INFO QUIZ
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-6
                    mb-5
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-start
                        md:justify-between
                        gap-4
                    "
                >

                    <div>

                        <h2
                            class="
                                text-xl
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $quiz->judul }}
                        </h2>


                        @if($quiz->deskripsi)

                            <p
                                class="
                                    text-sm
                                    text-slate-500
                                    mt-2
                                    leading-relaxed
                                "
                            >
                                {{ $quiz->deskripsi }}
                            </p>

                        @endif

                    </div>


                    @if($quiz->aktif)

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-2
                                self-start
                                px-3
                                py-2
                                rounded-xl
                                bg-green-50
                                text-green-700
                                text-xs
                                font-bold
                            "
                        >

                            <span
                                class="
                                    w-1.5
                                    h-1.5
                                    rounded-full
                                    bg-green-500
                                "
                            ></span>

                            Aktif

                        </span>

                    @else

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-2
                                self-start
                                px-3
                                py-2
                                rounded-xl
                                bg-slate-100
                                text-slate-500
                                text-xs
                                font-bold
                            "
                        >

                            <span
                                class="
                                    w-1.5
                                    h-1.5
                                    rounded-full
                                    bg-slate-400
                                "
                            ></span>

                            Tidak Aktif

                        </span>

                    @endif

                </div>


                <div
                    class="
                        flex
                        flex-wrap
                        gap-2
                        mt-5
                    "
                >

                    <span
                        class="
                            px-3
                            py-2
                            rounded-xl
                            bg-slate-100
                            text-slate-600
                            text-xs
                            font-bold
                        "
                    >
                        Pertemuan {{ $quiz->pertemuan }}
                    </span>


                    <span
                        class="
                            px-3
                            py-2
                            rounded-xl
                            bg-slate-100
                            text-slate-600
                            text-xs
                            font-bold
                        "
                    >
                        {{ $quiz->questions->count() }} Soal
                    </span>


                    <span
                        class="
                            px-3
                            py-2
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            text-xs
                            font-bold
                        "
                    >
                        {{ $attempts->count() }}
                        Hasil Ditampilkan
                    </span>

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
                    mb-5
                "
            >

                <form
                    method="GET"
                    action="{{ route(
                        'guru.quizzes.show',
                        $quiz
                    ) }}"
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
                            for="kelas"
                            class="
                                block
                                text-xs
                                font-black
                                uppercase
                                tracking-wider
                                text-slate-500
                                mb-2
                            "
                        >
                            Filter Kelas
                        </label>


                        <select
                            id="kelas"
                            name="kelas"
                            class="
                                w-full
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                                font-semibold
                                text-slate-700
                                bg-white
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
                                    value="{{ $class->nama }}"
                                    @selected(
                                        $kelas === $class->nama
                                    )
                                >
                                    {{ $class->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div
                        class="
                            flex
                            items-center
                            gap-2
                        "
                    >

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
                                bg-blue-600
                                hover:bg-blue-700
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


                        @if($kelas)

                            <a
                                href="{{ route(
                                    'guru.quizzes.show',
                                    $quiz
                                ) }}"
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
                                    hover:bg-slate-50
                                    text-slate-600
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

                    </div>

                </form>


                @if($kelas)

                    <div
                        class="
                            mt-4
                            flex
                            items-center
                            gap-2
                            text-xs
                            text-blue-600
                            font-semibold
                        "
                    >

                        <i
                            data-lucide="info"
                            class="w-4 h-4"
                        ></i>

                        Menampilkan hasil untuk kelas:
                        <strong>
                            {{ $kelas }}
                        </strong>

                    </div>

                @endif

            </section>



            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            @php

                $totalAttempts =
                    $attempts->count();

                $averageScore =
                    $totalAttempts > 0
                        ? round(
                            $attempts->avg('nilai'),
                            2
                        )
                        : 0;

                $highestScore =
                    $totalAttempts > 0
                        ? $attempts->max('nilai')
                        : 0;

            @endphp


            <section
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-3
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

                    <p
                        class="
                            text-xs
                            font-bold
                            uppercase
                            tracking-wider
                            text-slate-400
                        "
                    >
                        Siswa Mengerjakan
                    </p>


                    <p
                        class="
                            text-3xl
                            font-black
                            text-slate-900
                            mt-2
                        "
                    >
                        {{ $totalAttempts }}
                    </p>

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
                        {{ number_format(
                            (float) $averageScore,
                            1
                        ) }}
                    </p>

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
                        {{ number_format(
                            (float) $highestScore,
                            0
                        ) }}
                    </p>

                </div>

            </section>



            {{-- =================================================
                 DAFTAR NILAI
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
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-3
                        px-5
                        py-5
                        border-b
                        border-slate-100
                    "
                >

                    <div>

                        <h2
                            class="
                                text-base
                                font-black
                                text-slate-900
                            "
                        >
                            Daftar Nilai Siswa
                        </h2>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >

                            @if($kelas)

                                Hasil kelas {{ $kelas }}

                            @else

                                Semua kelas

                            @endif

                        </p>

                    </div>


                    <span
                        class="
                            px-3
                            py-2
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            text-xs
                            font-bold
                        "
                    >
                        {{ $totalAttempts }} siswa
                    </span>

                </div>



                @if($attempts->count())

                    <div class="overflow-x-auto">

                        <table
                            class="
                                w-full
                                min-w-[850px]
                            "
                        >

                            <thead class="bg-slate-50">

                                <tr>

                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        No
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Nama Siswa
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Kelas
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Absen
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Benar
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Nilai
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-3
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Dikerjakan
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach(
                                    $attempts
                                    as $attempt
                                )

                                    @php

                                        $student =
                                            $attempt->student;

                                        $nilai =
                                            (float)
                                            $attempt->nilai;

                                        if ($nilai >= 80) {

                                            $scoreClass =
                                                'score-high';

                                        } elseif ($nilai >= 60) {

                                            $scoreClass =
                                                'score-medium';

                                        } else {

                                            $scoreClass =
                                                'score-low';

                                        }

                                    @endphp


                                    <tr
                                        class="
                                            result-row
                                            border-t
                                            border-slate-100
                                        "
                                    >

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-sm
                                                font-bold
                                                text-slate-500
                                            "
                                        >
                                            {{ $loop->iteration }}
                                        </td>


                                        <td class="px-5 py-4">

                                            @if($student)

                                                <div
                                                    class="
                                                        text-sm
                                                        font-black
                                                        text-slate-900
                                                    "
                                                >
                                                    {{ $student->nama }}
                                                </div>


                                                <div
                                                    class="
                                                        text-[11px]
                                                        text-slate-400
                                                        mt-1
                                                    "
                                                >
                                                    ID Siswa
                                                    #{{ $student->id }}
                                                </div>

                                            @else

                                                <div
                                                    class="
                                                        text-sm
                                                        font-bold
                                                        text-red-500
                                                    "
                                                >
                                                    Siswa tidak ditemukan
                                                </div>

                                            @endif

                                        </td>


                                        <td class="px-5 py-4">

                                            @if(
                                                $student &&
                                                $student->kelas
                                            )

                                                <span
                                                    class="
                                                        inline-flex
                                                        px-2.5
                                                        py-1.5
                                                        rounded-lg
                                                        bg-slate-100
                                                        text-slate-600
                                                        text-xs
                                                        font-bold
                                                    "
                                                >
                                                    {{ $student->kelas }}
                                                </span>

                                            @else

                                                —

                                            @endif

                                        </td>


                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-sm
                                                font-bold
                                                text-slate-600
                                            "
                                        >

                                            @if($student)

                                                {{
                                                    $student->nomor_absen
                                                    ?? '—'
                                                }}

                                            @else

                                                —

                                            @endif

                                        </td>


                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-green-600
                                                "
                                            >

                                                {{ $attempt->jumlah_benar }}

                                                <span
                                                    class="text-slate-400"
                                                >
                                                    /
                                                </span>

                                                {{ $attempt->jumlah_soal }}

                                            </span>

                                        </td>


                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    inline-flex
                                                    min-w-[55px]
                                                    justify-center
                                                    px-3
                                                    py-2
                                                    rounded-lg
                                                    text-xs
                                                    font-black
                                                    {{ $scoreClass }}
                                                "
                                            >
                                                {{ number_format(
                                                    $nilai,
                                                    0
                                                ) }}
                                            </span>

                                        </td>


                                        <td class="px-5 py-4">

                                            @if(
                                                $attempt->dikerjakan_at
                                            )

                                                <div
                                                    class="
                                                        text-xs
                                                        font-semibold
                                                        text-slate-600
                                                    "
                                                >
                                                    {{
                                                        $attempt
                                                            ->dikerjakan_at
                                                            ->format(
                                                                'd/m/Y'
                                                            )
                                                    }}
                                                </div>


                                                <div
                                                    class="
                                                        text-[11px]
                                                        text-slate-400
                                                        mt-1
                                                    "
                                                >
                                                    {{
                                                        $attempt
                                                            ->dikerjakan_at
                                                            ->format(
                                                                'H:i'
                                                            )
                                                    }}
                                                </div>

                                            @else

                                                —

                                            @endif

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div
                        class="
                            px-5
                            py-16
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
                                data-lucide="users-round"
                                class="w-7 h-7 text-slate-400"
                            ></i>

                        </div>


                        @if($kelas)

                            <h3
                                class="
                                    text-base
                                    font-black
                                    text-slate-700
                                "
                            >
                                Belum Ada Hasil
                            </h3>


                            <p
                                class="
                                    max-w-md
                                    mx-auto
                                    text-sm
                                    text-slate-400
                                    mt-2
                                "
                            >
                                Belum ada siswa dari kelas
                                <strong>{{ $kelas }}</strong>
                                yang mengerjakan Quiz ini.
                            </p>

                        @else

                            <h3
                                class="
                                    text-base
                                    font-black
                                    text-slate-700
                                "
                            >
                                Belum Ada Siswa yang Mengerjakan
                            </h3>


                            <p
                                class="
                                    max-w-md
                                    mx-auto
                                    text-sm
                                    text-slate-400
                                    mt-2
                                "
                            >
                                Belum ada hasil pengerjaan
                                Quiz Pertemuan
                                {{ $quiz->pertemuan }}.
                            </p>

                        @endif

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