<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Refleksi — LARASKU</title>

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
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }

        .modal-backdrop {
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
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
                 HEADER
            ================================================== --}}

            <section
                class="
                    mb-6
                    flex
                    flex-col
                    lg:flex-row
                    lg:items-end
                    lg:justify-between
                    gap-5
                "
            >

                <div>

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
                            data-lucide="message-square"
                            class="w-3.5 h-3.5"
                        ></i>

                        Panel Guru

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
                        Refleksi
                    </h1>


                    <p
                        class="
                            text-sm
                            text-slate-500
                            mt-2
                        "
                    >
                        Kelola pertemuan, pertanyaan refleksi,
                        dan nilai jawaban siswa.
                    </p>

                </div>


                {{-- =================================================
                     AKSI HEADER
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-wrap
                        items-center
                        gap-2
                    "
                >

                    {{-- BUAT REFLEKSI --}}

                    <a
                        href="{{ route('guru.reflections.create') }}"
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
                            font-black
                            transition
                            shadow-sm
                        "
                    >

                        <i
                            data-lucide="message-square-plus"
                            class="w-4 h-4"
                        ></i>

                        Buat Refleksi

                    </a>

                </div>

            </section>


            {{-- =================================================
                 FLASH SUCCESS
            ================================================== --}}

            @if(session('success'))

                <div
                    class="
                        mb-5
                        rounded-2xl
                        border
                        border-emerald-200
                        bg-emerald-50
                        px-5
                        py-4
                        flex
                        items-center
                        gap-3
                    "
                >

                    <i
                        data-lucide="check-circle"
                        class="w-5 h-5 text-emerald-600"
                    ></i>

                    <p
                        class="
                            text-sm
                            font-bold
                            text-emerald-700
                        "
                    >
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- =================================================
                 FLASH ERROR
            ================================================== --}}

            @if(session('error'))

                <div
                    class="
                        mb-5
                        rounded-2xl
                        border
                        border-red-200
                        bg-red-50
                        px-5
                        py-4
                        flex
                        items-center
                        gap-3
                    "
                >

                    <i
                        data-lucide="alert-circle"
                        class="w-5 h-5 text-red-600"
                    ></i>

                    <p
                        class="
                            text-sm
                            font-bold
                            text-red-700
                        "
                    >
                        {{ session('error') }}
                    </p>

                </div>

            @endif


            {{-- =================================================
                 FILTER
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

                <div
                    class="
                        flex
                        items-center
                        gap-2
                        mb-4
                    "
                >

                    <i
                        data-lucide="filter"
                        class="w-4 h-4 text-blue-600"
                    ></i>

                    <h2
                        class="
                            text-sm
                            font-black
                            text-slate-800
                        "
                    >
                        Filter Refleksi
                    </h2>

                </div>


                <form
                    action="{{ route('guru.reflections.index') }}"
                    method="GET"
                >

                    <div
                        class="
                            grid
                            grid-cols-1
                            md:grid-cols-2
                            lg:grid-cols-4
                            gap-4
                            items-end
                        "
                    >

                        {{-- KELAS --}}

                        <div>

                            <label
                                for="kelas"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Kelas
                            </label>

                            <select
                                id="kelas"
                                name="kelas"
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        @selected(
                                            (string) $kelas === (string) $class
                                        )
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PERTEMUAN --}}

                        <div>

                            <label
                                for="filter_pertemuan"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Pertemuan
                            </label>

                            <select
                                id="filter_pertemuan"
                                name="pertemuan"
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                <option value="">
                                    Semua Pertemuan
                                </option>

                                @foreach($pertemuans as $item)

                                    @php
                                        $meetingValue = is_object($item)
                                            ? $item->pertemuan
                                            : $item;
                                    @endphp

                                    <option
                                        value="{{ $meetingValue }}"
                                        @selected(
                                            (string) $pertemuan === (string) $meetingValue
                                        )
                                    >
                                        Pertemuan {{ $meetingValue }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}

                        <div>

                            <label
                                for="status"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Status Penilaian
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="dinilai"
                                    @selected($status === 'dinilai')
                                >
                                    Sudah Dinilai
                                </option>

                                <option
                                    value="belum_dinilai"
                                    @selected($status === 'belum_dinilai')
                                >
                                    Belum Dinilai
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}

                        <div
                            class="
                                flex
                                gap-2
                            "
                        >

                            <button
                                type="submit"
                                class="
                                    h-11
                                    flex-1
                                    px-5
                                    rounded-xl
                                    bg-slate-900
                                    hover:bg-slate-800
                                    text-white
                                    text-sm
                                    font-bold
                                    transition
                                    inline-flex
                                    items-center
                                    justify-center
                                    gap-2
                                "
                            >

                                <i
                                    data-lucide="filter"
                                    class="w-4 h-4"
                                ></i>

                                Terapkan

                            </button>


                            @if(
                                $kelas ||
                                $pertemuan ||
                                $status
                            )

                                <a
                                    href="{{ route('guru.reflections.index') }}"
                                    class="
                                        h-11
                                        px-4
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-white
                                        hover:bg-slate-50
                                        text-slate-600
                                        text-sm
                                        font-bold
                                        inline-flex
                                        items-center
                                        justify-center
                                    "
                                    title="Reset filter"
                                >

                                    <i
                                        data-lucide="rotate-ccw"
                                        class="w-4 h-4"
                                    ></i>

                                </a>

                            @endif

                        </div>

                    </div>

                </form>

            </section>


            {{-- =================================================
                 SUMMARY
            ================================================== --}}

            <div
                class="
                    grid
                    grid-cols-2
                    md:grid-cols-4
                    gap-3
                    mb-5
                "
            >

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Refleksi
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $reflections->count() }}
                    </div>

                </div>


                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Jawaban
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-blue-600
                            mt-1
                        "
                    >
                        {{ $reflections->sum(
                            fn ($reflection) =>
                                $reflection->answers
                                    ->pluck('student_id')
                                    ->unique()
                                    ->count()
                        ) }}
                    </div>

                </div>


                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Sudah Dinilai
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-emerald-600
                            mt-1
                        "
                    >
                        {{ $reflections->sum(
                            fn ($reflection) =>
                                $reflection->answers
                                    ->filter(
                                        fn ($answer) =>
                                            $answer->nilai !== null
                                    )
                                    ->pluck('student_id')
                                    ->unique()
                                    ->count()
                        ) }}
                    </div>

                </div>


                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Belum Dinilai
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-amber-600
                            mt-1
                        "
                    >
                        {{ $reflections->sum(
                            fn ($reflection) =>
                                $reflection->answers
                                    ->filter(
                                        fn ($answer) =>
                                            $answer->nilai === null
                                    )
                                    ->pluck('student_id')
                                    ->unique()
                                    ->count()
                        ) }}
                    </div>

                </div>

            </div>


            {{-- =================================================
                 TABLE
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

                @if($reflections->count())

                    <div class="overflow-x-auto">

                        <table
                            class="
                                w-full
                                min-w-[1050px]
                            "
                        >

                            <thead class="bg-slate-50">

                                <tr>

                                    <th
                                        class="
                                            px-5
                                            py-4
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
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Refleksi
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Pertemuan
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-center
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Soal
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-center
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Jawaban
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-center
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Penilaian
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-center
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Status
                                    </th>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-right
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach(
                                    $reflections
                                    as $index => $reflection
                                )

                                    @php

                                        $studentIds =
                                            $reflection->answers
                                                ->pluck('student_id')
                                                ->filter()
                                                ->unique();

                                        $totalStudents =
                                            $studentIds->count();

                                        $gradedStudents =
                                            $reflection->answers
                                                ->filter(
                                                    fn ($answer) =>
                                                        $answer->nilai !== null
                                                )
                                                ->pluck('student_id')
                                                ->filter()
                                                ->unique()
                                                ->count();

                                        $ungradedStudents =
                                            max(
                                                0,
                                                $totalStudents -
                                                $gradedStudents
                                            );

                                        $totalQuestions =
                                            $reflection->questions->count();

                                        /*
                                        |--------------------------------------------------------------------------
                                        | MEETING UNTUK BARIS INI SAJA
                                        |--------------------------------------------------------------------------
                                        */

                                        $reflectionMeeting =
                                            \App\Models\ReflectionMeeting::query()
                                                ->where(
                                                    'pertemuan',
                                                    $reflection->pertemuan
                                                )
                                                ->first();

                                    @endphp


                                    <tr
                                        class="
                                            border-t
                                            border-slate-100
                                            hover:bg-slate-50
                                            transition
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
                                            {{ $index + 1 }}
                                        </td>


                                        <td class="px-5 py-4">

                                            <div
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-900
                                                "
                                            >
                                                {{ $reflection->judul }}
                                            </div>

                                            @if($reflection->deskripsi)

                                                <div
                                                    class="
                                                        text-xs
                                                        text-slate-400
                                                        mt-1
                                                        max-w-sm
                                                        truncate
                                                    "
                                                >
                                                    {{ $reflection->deskripsi }}
                                                </div>

                                            @endif

                                        </td>


                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    px-3
                                                    py-1.5
                                                    rounded-lg
                                                    bg-blue-50
                                                    text-blue-600
                                                    text-xs
                                                    font-bold
                                                "
                                            >
                                                Pertemuan
                                                {{ $reflection->pertemuan }}
                                            </span>

                                        </td>


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
                                                    min-w-8
                                                    h-8
                                                    px-2
                                                    items-center
                                                    justify-center
                                                    rounded-lg
                                                    bg-slate-100
                                                    text-slate-700
                                                    text-xs
                                                    font-black
                                                "
                                            >
                                                {{ $totalQuestions }}
                                            </span>

                                        </td>


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
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                {{ $totalStudents }}
                                            </div>

                                            <div
                                                class="
                                                    text-[10px]
                                                    text-slate-400
                                                    mt-0.5
                                                "
                                            >
                                                siswa
                                            </div>

                                        </td>


                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-center
                                            "
                                        >

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    justify-center
                                                    gap-2
                                                    flex-wrap
                                                "
                                            >

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1
                                                        px-2.5
                                                        py-1.5
                                                        rounded-lg
                                                        bg-emerald-50
                                                        text-emerald-700
                                                        text-[11px]
                                                        font-black
                                                    "
                                                >

                                                    <i
                                                        data-lucide="check"
                                                        class="w-3 h-3"
                                                    ></i>

                                                    {{ $gradedStudents }}

                                                </span>


                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1
                                                        px-2.5
                                                        py-1.5
                                                        rounded-lg
                                                        bg-amber-50
                                                        text-amber-700
                                                        text-[11px]
                                                        font-black
                                                    "
                                                >

                                                    <i
                                                        data-lucide="clock-3"
                                                        class="w-3 h-3"
                                                    ></i>

                                                    {{ $ungradedStudents }}

                                                </span>

                                            </div>

                                        </td>


                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-center
                                            "
                                        >

                                            @if($reflection->aktif)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-emerald-50
                                                        text-emerald-700
                                                        text-[11px]
                                                        font-black
                                                    "
                                                >

                                                    <span
                                                        class="
                                                            w-1.5
                                                            h-1.5
                                                            rounded-full
                                                            bg-emerald-500
                                                        "
                                                    ></span>

                                                    Aktif

                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-1.5
                                                        rounded-full
                                                        bg-slate-100
                                                        text-slate-500
                                                        text-[11px]
                                                        font-black
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

                                                    Nonaktif

                                                </span>

                                            @endif

                                        </td>


                                        {{-- =================================================
                                             AKSI
                                        ================================================== --}}

                                        <td class="px-5 py-4">

                                            <div
                                                class="
                                                    flex
                                                    items-center
                                                    justify-end
                                                    gap-2
                                                "
                                            >

                                                {{-- JAWABAN --}}

                                                <a
                                                    href="{{ route(
                                                        'guru.reflections.show',
                                                        $reflection
                                                    ) }}"
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        bg-slate-900
                                                        hover:bg-slate-800
                                                        text-white
                                                        text-xs
                                                        font-bold
                                                        transition
                                                    "
                                                >

                                                    <i
                                                        data-lucide="eye"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Jawaban

                                                </a>


                                                {{-- EDIT --}}

                                                <a
                                                    href="{{ route(
                                                        'guru.reflections.edit',
                                                        $reflection
                                                    ) }}"
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-2
                                                        rounded-xl
                                                        border
                                                        border-slate-200
                                                        bg-white
                                                        hover:bg-slate-50
                                                        text-slate-700
                                                        text-xs
                                                        font-bold
                                                        transition
                                                    "
                                                >

                                                    <i
                                                        data-lucide="pencil"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Edit

                                                </a>


                                                {{-- =================================================
                                                     HAPUS PERTEMUAN INI SAJA
                                                ================================================== --}}

                                                @if($reflectionMeeting)

                                                    <form
                                                        method="POST"
                                                        action="{{ route(
                                                            'guru.reflections.meetings.destroy',
                                                            $reflectionMeeting
                                                        ) }}"
                                                        class="delete-meeting-form"
                                                    >

                                                        @csrf

                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                gap-1.5
                                                                px-3
                                                                py-2
                                                                rounded-xl
                                                                border
                                                                border-red-200
                                                                bg-white
                                                                hover:bg-red-50
                                                                hover:border-red-300
                                                                text-red-600
                                                                text-xs
                                                                font-bold
                                                                transition
                                                            "
                                                            title="Hapus Pertemuan"
                                                        >

                                                            <i
                                                                data-lucide="trash-2"
                                                                class="w-3.5 h-3.5"
                                                            ></i>

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
                                data-lucide="message-square-off"
                                class="
                                    w-7
                                    h-7
                                    text-slate-400
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Belum ada refleksi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Pilih atau buat pertemuan Refleksi terlebih dahulu,
                            kemudian buat refleksi untuk pertemuan tersebut.
                        </p>


                        <a
                            href="{{ route('guru.reflections.create') }}"
                            class="
                                inline-flex
                                items-center
                                gap-2
                                mt-5
                                px-4
                                py-2.5
                                rounded-xl
                                bg-blue-600
                                hover:bg-blue-700
                                text-white
                                text-xs
                                font-black
                            "
                        >

                            <i
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Buat Refleksi

                        </a>

                    </div>

                @endif

            </section>

        </div>

    </main>


    {{-- =========================================================
         MODAL TAMBAH PERTEMUAN
    ========================================================== --}}

    <div
        id="meetingModal"
        class="
            fixed
            inset-0
            z-50
            hidden
            items-center
            justify-center
            p-4
            bg-slate-900/50
            modal-backdrop
        "
    >

        <div
            class="
                w-full
                max-w-md
                bg-white
                rounded-3xl
                shadow-2xl
                border
                border-slate-200
                overflow-hidden
            "
        >

            <div
                class="
                    px-6
                    py-5
                    border-b
                    border-slate-100
                    flex
                    items-center
                    justify-between
                "
            >

                <div>

                    <div
                        class="
                            text-[11px]
                            font-black
                            uppercase
                            tracking-wider
                            text-blue-600
                        "
                    >
                        Refleksi
                    </div>

                    <h3
                        class="
                            mt-1
                            text-lg
                            font-black
                            text-slate-900
                        "
                    >
                        Tambah Pertemuan
                    </h3>

                </div>


                <button
                    type="button"
                    id="closeMeetingModal"
                    class="
                        w-9
                        h-9
                        rounded-xl
                        bg-slate-100
                        hover:bg-slate-200
                        text-slate-500
                        flex
                        items-center
                        justify-center
                    "
                >

                    <i
                        data-lucide="x"
                        class="w-4 h-4"
                    ></i>

                </button>

            </div>


            <form
                method="POST"
                action="{{ route('guru.reflections.meetings.store') }}"
            >

                @csrf

                <div class="p-6">

                    <label
                        for="meeting_pertemuan"
                        class="
                            block
                            text-xs
                            font-bold
                            text-slate-600
                            mb-2
                        "
                    >
                        Nomor Pertemuan
                    </label>


                    <input
                        type="number"
                        id="meeting_pertemuan"
                        name="pertemuan"
                        min="1"
                        max="255"
                        step="1"
                        required
                        inputmode="numeric"
                        placeholder="Contoh: 1"
                        class="
                            w-full
                            h-12
                            px-4
                            border
                            border-slate-200
                            rounded-xl
                            text-sm
                            font-bold
                            outline-none
                            focus:border-blue-400
                            focus:ring-4
                            focus:ring-blue-50
                        "
                    >


                    <p
                        class="
                            mt-3
                            text-[11px]
                            leading-5
                            text-slate-400
                        "
                    >
                        Pertemuan ini hanya untuk Refleksi dan
                        tidak mengambil data dari Materi.
                    </p>

                </div>


                <div
                    class="
                        px-6
                        py-4
                        border-t
                        border-slate-100
                        bg-slate-50
                        flex
                        justify-end
                        gap-3
                    "
                >

                    <button
                        type="button"
                        id="cancelMeetingModal"
                        class="
                            px-4
                            py-2.5
                            rounded-xl
                            bg-white
                            border
                            border-slate-200
                            hover:bg-slate-50
                            text-slate-700
                            text-xs
                            font-bold
                        "
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="
                            px-5
                            py-2.5
                            rounded-xl
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            text-xs
                            font-black
                            inline-flex
                            items-center
                            gap-2
                        "
                    >

                        <i
                            data-lucide="plus"
                            class="w-4 h-4"
                        ></i>

                        Tambahkan

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
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


                const modal =
                    document.getElementById(
                        'meetingModal'
                    );

                const openButton =
                    document.getElementById(
                        'openMeetingModal'
                    );

                const closeButton =
                    document.getElementById(
                        'closeMeetingModal'
                    );

                const cancelButton =
                    document.getElementById(
                        'cancelMeetingModal'
                    );


                function openModal() {

                    if (!modal) {
                        return;
                    }

                    modal.classList.remove(
                        'hidden'
                    );

                    modal.classList.add(
                        'flex'
                    );

                    document.body.classList.add(
                        'overflow-hidden'
                    );


                    setTimeout(
                        function () {

                            const input =
                                document.getElementById(
                                    'meeting_pertemuan'
                                );

                            if (input) {

                                input.focus();

                            }

                        },
                        100
                    );

                }


                function closeModal() {

                    if (!modal) {
                        return;
                    }

                    modal.classList.add(
                        'hidden'
                    );

                    modal.classList.remove(
                        'flex'
                    );

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                }


                if (openButton) {

                    openButton.addEventListener(
                        'click',
                        openModal
                    );

                }


                if (closeButton) {

                    closeButton.addEventListener(
                        'click',
                        closeModal
                    );

                }


                if (cancelButton) {

                    cancelButton.addEventListener(
                        'click',
                        closeModal
                    );

                }


                if (modal) {

                    modal.addEventListener(
                        'click',
                        function (event) {

                            if (
                                event.target === modal
                            ) {

                                closeModal();

                            }

                        }
                    );


                    document.addEventListener(
                        'keydown',
                        function (event) {

                            if (
                                event.key === 'Escape' &&
                                !modal.classList.contains(
                                    'hidden'
                                )
                            ) {

                                closeModal();

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | KONFIRMASI HAPUS PERTEMUAN
                |--------------------------------------------------------------------------
                */

                document
                    .querySelectorAll(
                        '.delete-meeting-form'
                    )
                    .forEach(
                        function (form) {

                            form.addEventListener(
                                'submit',
                                function (event) {

                                    const confirmed =
                                        confirm(
                                            'Hapus Pertemuan ini?\n\nSemua Refleksi, soal, dan jawaban siswa pada pertemuan ini akan ikut dihapus.'
                                        );


                                    if (!confirmed) {

                                        event.preventDefault();

                                    }

                                }
                            );

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | KONFIRMASI HAPUS REFLEKSI
                |--------------------------------------------------------------------------
                */

                document
                    .querySelectorAll(
                        '.delete-reflection-form'
                    )
                    .forEach(
                        function (form) {

                            form.addEventListener(
                                'submit',
                                function (event) {

                                    const confirmed =
                                        confirm(
                                            'Hapus Refleksi ini?\n\nSemua soal dan jawaban siswa pada refleksi ini akan ikut dihapus.'
                                        );


                                    if (!confirmed) {

                                        event.preventDefault();

                                    }

                                }
                            );

                        }
                    );

            }
        );

    </script>

</body>

</html>