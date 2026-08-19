<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Absensi Guru — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0 !important;
            }

        }

    </style>

</head>


<body class="bg-slate-50 text-slate-800">


<div class="min-h-screen">

{{-- =========================================================
     SIDEBAR GLOBAL
========================================================== --}}

@include('guru.partials.sidebar')


{{-- =========================================================
     MAIN CONTENT
========================================================== --}}

<main
    id="mainContent"
    class="main-content lg:ml-64 transition-all duration-300"
>


    {{-- =========================================================
         HEADBAR GURU
    ========================================================== --}}

    @include('guru.partials.header')


    {{-- =========================================================
         CONTENT
    ========================================================== --}}

    <div class="max-w-7xl mx-auto px-5 py-8">


        {{-- =================================================
             HEADER
        ================================================== --}}

        <div class="mb-8">

            <p class="text-sm text-blue-600 font-semibold">
                Panel Guru
            </p>

            <h1 class="text-3xl font-bold text-slate-900 mt-1">
                Kelola Absensi
            </h1>

            <p class="text-sm text-slate-500 mt-1">

                {{ $kelas ?: 'Belum memilih kelas' }}

                @if($pertemuan)
                    · Pertemuan {{ $pertemuan }}
                @endif

            </p>

        </div>


        {{-- =================================================
             FILTER KELAS
        ================================================== --}}

        <div
            class="
                bg-white
                border
                border-slate-200
                rounded-2xl
                p-5
                mb-6
            "
        >

            <div class="grid grid-cols-1 gap-4">


                {{-- KELAS --}}

                <div>

                    <label
                        class="
                            block
                            text-sm
                            font-semibold
                            mb-2
                        "
                    >
                        Kelas
                    </label>


                    <select
                        name="kelas"
                        onchange="window.location.href='{{ route('guru.attendance.index') }}?kelas=' + encodeURIComponent(this.value)"
                        class="
                            w-full
                            border
                            border-slate-200
                            rounded-xl
                            px-4
                            py-3
                            bg-white
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-100
                        "
                    >

                        @if($classes->isEmpty())

                            <option value="">
                                Belum ada kelas
                            </option>

                        @else

                            @foreach($classes as $class)

                                <option
                                    value="{{ $class->nama }}"
                                    @selected($kelas === $class->nama)
                                >
                                    {{ $class->nama }}
                                </option>

                            @endforeach

                        @endif

                    </select>

                </div>

            </div>

        </div>


        {{-- =================================================
             STATUS PERTEMUAN
        ================================================== --}}

            @if($selectedClass)

                @php
                    $pertemuanAktif =
                        (int) $selectedClass->pertemuan_aktif;

                    $pertemuanBerikutnya =
                        $pertemuanAktif + 1;

                    $pertemuanTersedia =
                        collect($pertemuans)
                            ->map(fn ($item) => (int) $item)
                            ->sort()
                            ->values();

                    $pertemuanBerikutnyaTersedia =
                        $pertemuanTersedia
                            ->first(
                                fn ($item) =>
                                    $item > $pertemuanAktif
                            );
                @endphp


                <div class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-5
                    mb-6
                ">


                    <div class="
                        flex
                        flex-col
                        lg:flex-row
                        lg:items-center
                        lg:justify-between
                        gap-5
                    ">


                        <div>

                            <div class="flex items-center gap-3">

                                <div class="
                                    w-11
                                    h-11
                                    rounded-xl
                                    bg-blue-50
                                    text-blue-600
                                    flex
                                    items-center
                                    justify-center
                                ">

                                    <i
                                        data-lucide="calendar-check-2"
                                        class="w-5 h-5"
                                    ></i>

                                </div>


                                <div>

                                    <h2 class="font-bold text-lg text-slate-900">
                                        Pertemuan Pembelajaran
                                    </h2>


                                    <p class="text-sm text-slate-500 mt-0.5">

                                        @if($pertemuanTersedia->isEmpty())

                                            Belum ada pertemuan materi yang dibuat.

                                        @elseif($pertemuanAktif === 0)

                                            Belum ada pertemuan yang dibuka.

                                        @else

                                            Pertemuan
                                            {{ $pertemuanTersedia
                                                ->filter(
                                                    fn ($item) =>
                                                        $item <= $pertemuanAktif
                                                )
                                                ->implode(', ') }}

                                            sudah terbuka.

                                        @endif

                                    </p>

                                </div>

                            </div>

                        </div>


                        {{-- =================================================
                             BUKA PERTEMUAN BERIKUTNYA
                        ================================================== --}}

                        @if($pertemuanBerikutnyaTersedia)

                            <form
                                method="POST"
                                action="{{ route('guru.attendance.open-meeting') }}"
                            >

                                @csrf

                                <input
                                    type="hidden"
                                    name="kelas"
                                    value="{{ $kelas }}"
                                >

                                <input
                                    type="hidden"
                                    name="pertemuan"
                                    value="{{ $pertemuanBerikutnyaTersedia }}"
                                >

                                <button
                                    type="submit"
                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        gap-2
                                        bg-blue-600
                                        hover:bg-blue-700
                                        text-white
                                        px-5
                                        py-3
                                        rounded-xl
                                        font-semibold
                                        transition
                                        shadow-sm
                                    "
                                >

                                    <i
                                        data-lucide="unlock"
                                        class="w-4 h-4"
                                    ></i>

                                    Buka Pertemuan
                                    {{ $pertemuanBerikutnyaTersedia }}

                                </button>

                            </form>

                        @elseif($pertemuanTersedia->isNotEmpty())

                            <div class="
                                inline-flex
                                items-center
                                gap-2
                                bg-emerald-50
                                text-emerald-700
                                border
                                border-emerald-100
                                px-5
                                py-3
                                rounded-xl
                                font-semibold
                            ">

                                <i
                                    data-lucide="check-circle-2"
                                    class="w-4 h-4"
                                ></i>

                                Semua Pertemuan Materi Terbuka

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                         DAFTAR PERTEMUAN
                    ================================================== --}}

                    @if($pertemuanTersedia->isNotEmpty())

                        <div class="
                            grid
                            grid-cols-2
                            sm:grid-cols-4
                            lg:grid-cols-8
                            gap-3
                            mt-5
                            pt-5
                            border-t
                            border-slate-100
                        ">

                            @foreach($pertemuanTersedia as $item)

                                @php
                                    $isOpen =
                                        $item <= $pertemuanAktif;

                                    $isCurrent =
                                        $pertemuan === $item;
                                @endphp


                                @if($isOpen)

                                    <a
                                        href="{{ route('guru.attendance.index', [
                                            'kelas' => $kelas,
                                            'pertemuan' => $item,
                                        ]) }}"
                                        class="
                                            group
                                            rounded-xl
                                            border
                                            px-3
                                            py-3
                                            transition
                                            {{ $isCurrent
                                                ? 'border-blue-500 bg-blue-50 text-blue-700 shadow-sm'
                                                : 'border-emerald-200 bg-emerald-50 text-emerald-700 hover:border-emerald-300'
                                            }}
                                        "
                                    >

                                        <div class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-2
                                        ">

                                            <span class="text-xs font-bold">
                                                P{{ $item }}
                                            </span>

                                            <i
                                                data-lucide="unlock"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                        </div>

                                        <p class="text-xs mt-1 font-medium">
                                            Terbuka
                                        </p>

                                    </a>


                                @elseif(
                                    $pertemuanBerikutnyaTersedia === $item
                                )

                                    <form
                                        method="POST"
                                        action="{{ route('guru.attendance.open-meeting') }}"
                                    >

                                        @csrf

                                        <input
                                            type="hidden"
                                            name="kelas"
                                            value="{{ $kelas }}"
                                        >

                                        <input
                                            type="hidden"
                                            name="pertemuan"
                                            value="{{ $item }}"
                                        >

                                        <button
                                            type="submit"
                                            class="
                                                group
                                                w-full
                                                text-left
                                                rounded-xl
                                                border
                                                border-blue-200
                                                bg-blue-50
                                                text-blue-700
                                                px-3
                                                py-3
                                                transition
                                                hover:bg-blue-100
                                                hover:border-blue-300
                                            "
                                        >

                                            <div class="
                                                flex
                                                items-center
                                                justify-between
                                                gap-2
                                            ">

                                                <span class="text-xs font-bold">
                                                    P{{ $item }}
                                                </span>

                                                <i
                                                    data-lucide="lock-keyhole-open"
                                                    class="w-3.5 h-3.5"
                                                ></i>

                                            </div>

                                            <p class="text-xs mt-1 font-semibold">
                                                Buka
                                            </p>

                                        </button>

                                    </form>


                                @else

                                    <div class="
                                        rounded-xl
                                        border
                                        border-slate-200
                                        bg-slate-50
                                        text-slate-400
                                        px-3
                                        py-3
                                        cursor-not-allowed
                                    ">

                                        <div class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-2
                                        ">

                                            <span class="text-xs font-bold">
                                                P{{ $item }}
                                            </span>

                                            <i
                                                data-lucide="lock"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                        </div>

                                        <p class="text-xs mt-1 font-medium">
                                            Terkunci
                                        </p>

                                    </div>

                                @endif

                            @endforeach

                        </div>

                    @else

                        <div class="
                            mt-5
                            pt-5
                            border-t
                            border-slate-100
                            text-sm
                            text-slate-400
                        ">

                            Belum ada pertemuan karena belum ada materi
                            yang dibuat.

                        </div>

                    @endif

                </div>

            @endif


            {{-- =================================================
                 REKAP STATUS
            ================================================== --}}

            @php

                $hadir = $attendances
                    ->where('status', 'hadir')
                    ->count();

                $sakit = $attendances
                    ->where('status', 'sakit')
                    ->count();

                $izin = $attendances
                    ->where('status', 'izin')
                    ->count();

                $alfa = $attendances
                    ->where('status', 'alfa')
                    ->count();

                $dispensasi = $attendances
                    ->where('status', 'dispensasi')
                    ->count();

            @endphp


            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">


                {{-- HADIR --}}

                <div class="bg-white rounded-2xl border border-slate-200 p-5">

                    <p class="text-sm text-slate-400">
                        Hadir
                    </p>

                    <p class="text-2xl font-bold text-green-600">
                        {{ $hadir }}
                    </p>

                </div>


                {{-- SAKIT --}}

                <div class="bg-white rounded-2xl border border-slate-200 p-5">

                    <p class="text-sm text-slate-400">
                        Sakit
                    </p>

                    <p class="text-2xl font-bold text-amber-600">
                        {{ $sakit }}
                    </p>

                </div>


                {{-- IZIN --}}

                <div class="bg-white rounded-2xl border border-slate-200 p-5">

                    <p class="text-sm text-slate-400">
                        Izin
                    </p>

                    <p class="text-2xl font-bold text-blue-600">
                        {{ $izin }}
                    </p>

                </div>


                {{-- ALFA --}}

                <div class="bg-white rounded-2xl border border-slate-200 p-5">

                    <p class="text-sm text-slate-400">
                        Alfa
                    </p>

                    <p class="text-2xl font-bold text-red-600">
                        {{ $alfa }}
                    </p>

                </div>


                {{-- DISPENSASI --}}

                <div class="bg-white rounded-2xl border border-slate-200 p-5">

                    <p class="text-sm text-slate-400">
                        Dispensasi
                    </p>

                    <p class="text-2xl font-bold text-purple-600">
                        {{ $dispensasi }}
                    </p>

                </div>

            </div>


            {{-- =================================================
                 FORM ABSENSI
            ================================================== --}}

            @if(
                $selectedClass
                && $pertemuan
                && $pertemuan > 0
                && $pertemuan <= (int) $selectedClass->pertemuan_aktif
            )

                <form
                    method="POST"
                    action="{{ route('guru.attendance.update') }}"
                >

                    @csrf


                    <input
                        type="hidden"
                        name="kelas"
                        value="{{ $kelas }}"
                    >


                    <input
                        type="hidden"
                        name="pertemuan"
                        value="{{ $pertemuan }}"
                    >


                    <div
                        class="
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            overflow-hidden
                        "
                    >


                        {{-- =================================================
                             TABLE HEADER
                        ================================================== --}}

                        <div
                            class="
                                p-5
                                border-b
                                border-slate-200
                                flex
                                flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-4
                            "
                        >

                            <div>

                                <h2 class="font-bold text-lg">
                                    {{ $kelas ?: 'Belum ada kelas' }}
                                </h2>

                                <p class="text-sm text-slate-400">
                                    {{ $students->count() }} siswa
                                    · Pertemuan {{ $pertemuan }}
                                </p>

                            </div>


                            <div class="flex flex-wrap items-center gap-2">


                                {{-- REKAP ABSENSI --}}

                                <a
                                    href="{{ route('guru.attendance.rekap', [
                                        'kelas' => $kelas
                                    ]) }}"
                                    class="
                                        inline-flex
                                        items-center
                                        gap-2
                                        bg-slate-900
                                        hover:bg-slate-800
                                        text-white
                                        px-4
                                        py-3
                                        rounded-xl
                                        font-semibold
                                        transition
                                    "
                                >

                                    <i
                                        data-lucide="clipboard-list"
                                        class="w-4 h-4"
                                    ></i>

                                    Rekap Absensi

                                </a>


                                {{-- SIMPAN --}}

                                @if($students->isNotEmpty())

                                    <button
                                        type="submit"
                                        class="
                                            inline-flex
                                            items-center
                                            gap-2
                                            bg-blue-600
                                            hover:bg-blue-700
                                            text-white
                                            px-5
                                            py-3
                                            rounded-xl
                                            font-semibold
                                            transition
                                        "
                                    >

                                        <i
                                            data-lucide="save"
                                            class="w-4 h-4"
                                        ></i>

                                        Simpan Absensi

                                    </button>

                                @endif

                            </div>

                        </div>


                        {{-- =================================================
                             TABLE SISWA
                        ================================================== --}}

                        <div class="overflow-x-auto">

                            <table class="w-full">

                                <thead class="bg-slate-50">

                                    <tr>

                                        <th
                                            class="
                                                text-left
                                                px-5
                                                py-4
                                                text-sm
                                                font-semibold
                                            "
                                        >
                                            No
                                        </th>

                                        <th
                                            class="
                                                text-left
                                                px-5
                                                py-4
                                                text-sm
                                                font-semibold
                                            "
                                        >
                                            Nama Siswa
                                        </th>

                                        <th
                                            class="
                                                text-left
                                                px-5
                                                py-4
                                                text-sm
                                                font-semibold
                                            "
                                        >
                                            Status
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($students as $student)

                                        @php

                                            $attendance =
                                                $attendances->get(
                                                    $student->id
                                                );

                                        @endphp


                                        <tr
                                            class="
                                                border-t
                                                border-slate-100
                                                hover:bg-slate-50
                                                transition
                                            "
                                        >


                                            {{-- NOMOR --}}

                                            <td class="px-5 py-4">

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        min-w-9
                                                        h-9
                                                        px-2
                                                        rounded-lg
                                                        bg-slate-100
                                                        text-sm
                                                        font-bold
                                                        text-slate-700
                                                    "
                                                >
                                                    {{ $student->nomor_absen ?: $loop->iteration }}
                                                </span>

                                            </td>


                                            {{-- NAMA --}}

                                            <td class="px-5 py-4">

                                                <div class="font-semibold">
                                                    {{ $student->nama }}
                                                </div>

                                                <div class="text-xs text-slate-400">
                                                    {{ $student->kelas }}
                                                </div>

                                            </td>


                                            {{-- STATUS --}}

                                            <td class="px-5 py-4">

                                                <div class="flex flex-wrap gap-2">

                                                    @foreach([
                                                        'hadir' => 'Hadir',
                                                        'sakit' => 'Sakit',
                                                        'izin' => 'Izin',
                                                        'alfa' => 'Alfa',
                                                        'dispensasi' => 'Dispensasi',
                                                    ] as $status => $label)

                                                        <label
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                cursor-pointer
                                                                select-none
                                                            "
                                                        >

                                                            <input
                                                                type="radio"
                                                                class="mr-1"
                                                                name="attendance[{{ $student->id }}]"
                                                                value="{{ $status }}"
                                                                @checked(
                                                                    ($attendance?->status ?? 'hadir')
                                                                    === $status
                                                                )
                                                            >

                                                            {{ $label }}

                                                        </label>

                                                    @endforeach

                                                </div>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td
                                                colspan="3"
                                                class="
                                                    text-center
                                                    py-16
                                                    text-slate-400
                                                "
                                            >

                                                <div
                                                    class="
                                                        flex
                                                        flex-col
                                                        items-center
                                                        justify-center
                                                        gap-3
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
                                                        "
                                                    >

                                                        <i
                                                            data-lucide="users-round"
                                                            class="w-6 h-6 text-slate-400"
                                                        ></i>

                                                    </div>

                                                    <div>

                                                        <p class="font-semibold text-slate-600">
                                                            Belum ada siswa
                                                        </p>

                                                        <p class="text-sm mt-1">
                                                            Belum ada siswa aktif
                                                            untuk kelas
                                                            {{ $kelas ?: 'ini' }}.
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </form>


            @elseif($selectedClass && $pertemuan)

                {{-- =================================================
                     PERTEMUAN TERKUNCI
                ================================================== --}}

                <div class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-10
                    text-center
                ">

                    <div
                        class="
                            w-16
                            h-16
                            mx-auto
                            rounded-2xl
                            bg-slate-100
                            text-slate-400
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            data-lucide="lock-keyhole"
                            class="w-7 h-7"
                        ></i>

                    </div>


                    <h2 class="
                        mt-5
                        text-lg
                        font-bold
                        text-slate-800
                    ">
                        Pertemuan Belum Dibuka
                    </h2>


                    <p class="
                        mt-2
                        text-sm
                        text-slate-500
                    ">
                        Pertemuan {{ $pertemuan }}
                        belum dibuka
                        untuk kelas {{ $kelas }}.
                    </p>


                    @if(
                        $pertemuanBerikutnyaTersedia === $pertemuan
                    )

                        <form
                            method="POST"
                            action="{{ route('guru.attendance.open-meeting') }}"
                            class="mt-6"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="kelas"
                                value="{{ $kelas }}"
                            >

                            <input
                                type="hidden"
                                name="pertemuan"
                                value="{{ $pertemuan }}"
                            >

                            <button
                                type="submit"
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    bg-blue-600
                                    hover:bg-blue-700
                                    text-white
                                    px-5
                                    py-3
                                    rounded-xl
                                    font-semibold
                                    transition
                                "
                            >

                                <i
                                    data-lucide="unlock"
                                    class="w-4 h-4"
                                ></i>

                                Buka Pertemuan {{ $pertemuan }}

                            </button>

                        </form>

                    @endif

                </div>

            @endif

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