<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Rekap Absensi — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        * {
            font-family: 'DM Sans', 'Inter', sans-serif;
        }

        body {
            background: #f4f7fb;
        }

        .status {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 800;
        }

        .status-hadir {
            color: #15803d;
            background: #dcfce7;
        }

        .status-sakit {
            color: #b45309;
            background: #fef3c7;
        }

        .status-izin {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .status-alfa {
            color: #b91c1c;
            background: #fee2e2;
        }

        .status-dispensasi {
            color: #7e22ce;
            background: #f3e8ff;
        }

        .status-empty {
            color: #94a3b8;
            background: #f1f5f9;
        }

        .score {
            min-width: 72px;
        }

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0 !important;
            }

        }

    </style>

</head>


<body class="min-h-screen text-slate-800">

<div class="min-h-screen">


    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main
        class="main-content lg:ml-64 transition-all duration-300"
    >

        {{-- =====================================================
             HEADER
        ====================================================== --}}

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
                    Rekap Absensi
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


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="p-5 lg:p-8 max-w-[1500px] mx-auto">


            {{-- =================================================
                 PAGE HEADER
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    md:flex-row
                    md:items-end
                    md:justify-between
                    gap-5
                    mb-7
                "
            >

                <div>

                    <div class="flex items-center gap-2 mb-2">

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-1.5
                                text-xs
                                font-semibold
                                text-blue-600
                                bg-blue-50
                                px-3
                                py-1.5
                                rounded-full
                            "
                        >

                            <i
                                data-lucide="clipboard-check"
                                class="w-3.5 h-3.5"
                            ></i>

                            Absensi

                        </span>


                        <span class="text-xs text-slate-400">
                            / Rekap 8 Pertemuan
                        </span>

                    </div>


                    <h1 class="text-3xl font-bold text-slate-900">
                        Rekap Absensi
                    </h1>


                    <p class="text-sm text-slate-500 mt-1">
                        Rekap kehadiran dan nilai absensi siswa
                        selama 8 pertemuan.
                    </p>

                </div>


                <div class="flex flex-wrap gap-2">


                    {{-- KELOLA ABSENSI --}}

                    <a
                        href="{{ route('guru.attendance.index', [
                            'kelas' => $kelas
                        ]) }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            bg-white
                            border
                            border-slate-200
                            hover:bg-slate-50
                            text-slate-700
                            px-4
                            py-2.5
                            rounded-xl
                            text-sm
                            font-semibold
                            transition
                        "
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="w-4 h-4"
                        ></i>

                        Kelola Absensi

                    </a>


                    {{-- DASHBOARD --}}

                    <a
                        href="{{ route('guru.dashboard') }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            bg-slate-900
                            hover:bg-slate-800
                            text-white
                            px-4
                            py-2.5
                            rounded-xl
                            text-sm
                            font-semibold
                            transition
                        "
                    >

                        <i
                            data-lucide="layout-dashboard"
                            class="w-4 h-4"
                        ></i>

                        Dashboard

                    </a>

                </div>

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
                    shadow-sm
                "
            >

                <form
                    method="GET"
                    action="{{ route('guru.attendance.rekap') }}"
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-end
                        gap-4
                    "
                >

                    <div class="w-full md:w-72">

                        <label
                            class="
                                block
                                text-xs
                                font-semibold
                                text-slate-500
                                mb-2
                            "
                        >
                            Pilih Kelas
                        </label>


                        <select
                            name="kelas"
                            onchange="this.form.submit()"
                            class="
                                w-full
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                                bg-white
                                focus:outline-none
                                focus:ring-4
                                focus:ring-blue-100
                                focus:border-blue-500
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


                    <div
                        class="
                            flex
                            items-center
                            gap-2
                            text-sm
                            text-slate-500
                            pb-3
                        "
                    >

                        <i
                            data-lucide="info"
                            class="w-4 h-4 text-blue-500"
                        ></i>

                        <span>
                            Menampilkan seluruh siswa kelas
                            {{ $kelas ?: '-' }}
                        </span>

                    </div>

                </form>

            </div>


            {{-- =================================================
                 SISTEM NILAI
            ================================================== --}}

            <div
                class="
                    bg-blue-50
                    border
                    border-blue-100
                    rounded-2xl
                    p-5
                    mb-6
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-center
                        gap-4
                    "
                >

                    <div
                        class="
                            w-11
                            h-11
                            rounded-xl
                            bg-blue-600
                            flex
                            items-center
                            justify-center
                            shrink-0
                        "
                    >

                        <i
                            data-lucide="calculator"
                            class="w-5 h-5 text-white"
                        ></i>

                    </div>


                    <div class="flex-1">

                        <h3 class="font-bold text-blue-900">
                            Sistem Penilaian Absensi
                        </h3>

                        <p class="text-sm text-blue-700 mt-1">
                            Nilai awal <strong>100</strong>.
                            Izin dan Alfa masing-masing mengurangi
                            <strong>10 poin</strong>.
                            Hadir, Sakit, dan Dispensasi tidak mengurangi nilai.
                        </p>

                    </div>


                    <div
                        class="
                            bg-white
                            rounded-xl
                            px-4
                            py-3
                            border
                            border-blue-100
                        "
                    >

                        <p class="text-xs text-slate-400">
                            Rumus
                        </p>

                        <p class="text-sm font-bold text-blue-700">
                            100 − (I + A) × 10
                        </p>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 TABLE
            ================================================== --}}

            <div
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    overflow-hidden
                    shadow-sm
                "
            >


                {{-- TABLE HEADER --}}

                <div
                    class="
                        px-5
                        py-5
                        border-b
                        border-slate-100
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-3
                    "
                >

                    <div>

                        <h2 class="font-bold text-lg text-slate-900">
                            {{ $kelas ?: 'Belum ada kelas' }}
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Pertemuan 1 sampai 8
                        </p>

                    </div>


                    <div class="flex items-center gap-2">

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-1.5
                                bg-slate-100
                                text-slate-600
                                px-3
                                py-2
                                rounded-lg
                                text-xs
                                font-semibold
                            "
                        >

                            <i
                                data-lucide="users"
                                class="w-3.5 h-3.5"
                            ></i>

                            {{ $students->count() }} Siswa

                        </span>

                    </div>

                </div>


                {{-- TABLE --}}

                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1100px]">

                        <thead
                            class="
                                bg-slate-50
                                border-b
                                border-slate-200
                            "
                        >

                            <tr>

                                <th
                                    class="
                                        px-4
                                        py-4
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        sticky
                                        left-0
                                        bg-slate-50
                                        z-10
                                    "
                                >
                                    No
                                </th>


                                <th
                                    class="
                                        px-4
                                        py-4
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        sticky
                                        left-[55px]
                                        bg-slate-50
                                        z-10
                                    "
                                >
                                    Nama Siswa
                                </th>


                                @for($i = 1; $i <= 8; $i++)

                                    <th
                                        class="
                                            px-3
                                            py-4
                                            text-center
                                            text-xs
                                            font-semibold
                                            text-slate-500
                                        "
                                    >
                                        P{{ $i }}
                                    </th>

                                @endfor


                                <th
                                    class="
                                        px-4
                                        py-4
                                        text-center
                                        text-xs
                                        font-bold
                                        text-blue-600
                                    "
                                >
                                    SKOR
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($students as $student)

                                @php

                                    $studentAttendances =
                                        $student->attendances
                                            ->keyBy('pertemuan');

                                    $deductions =
                                        $student->attendances
                                            ->whereIn(
                                                'status',
                                                [
                                                    'alfa',
                                                    'izin'
                                                ]
                                            )
                                            ->count() * 10;

                                    $score = max(
                                        0,
                                        100 - $deductions
                                    );

                                @endphp


                                <tr
                                    class="
                                        border-b
                                        border-slate-100
                                        last:border-0
                                        hover:bg-slate-50
                                    "
                                >


                                    {{-- NO --}}

                                    <td
                                        class="
                                            px-4
                                            py-4
                                            text-sm
                                            text-slate-400
                                            sticky
                                            left-0
                                            bg-white
                                            z-10
                                        "
                                    >

                                        {{ $student->nomor_absen ?: $loop->iteration }}

                                    </td>


                                    {{-- NAMA --}}

                                    <td
                                        class="
                                            px-4
                                            py-4
                                            sticky
                                            left-[55px]
                                            bg-white
                                            z-10
                                        "
                                    >

                                        <div class="flex items-center gap-3">

                                            <div
                                                class="
                                                    w-9
                                                    h-9
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600
                                                    flex
                                                    items-center
                                                    justify-center
                                                    font-bold
                                                    text-xs
                                                    shrink-0
                                                "
                                            >

                                                {{ strtoupper(
                                                    substr(
                                                        $student->nama,
                                                        0,
                                                        1
                                                    )
                                                ) }}

                                            </div>


                                            <div class="min-w-[180px]">

                                                <p
                                                    class="
                                                        font-semibold
                                                        text-slate-800
                                                        whitespace-nowrap
                                                    "
                                                >
                                                    {{ $student->nama }}
                                                </p>

                                                <p
                                                    class="
                                                        text-xs
                                                        text-slate-400
                                                        mt-0.5
                                                    "
                                                >
                                                    Absen {{ $student->nomor_absen }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- PERTEMUAN 1-8 --}}

                                    @for($i = 1; $i <= 8; $i++)

                                        @php

                                            $attendance =
                                                $studentAttendances
                                                    ->get($i);

                                            $status =
                                                $attendance?->status;

                                            $labels = [
                                                'hadir' => 'H',
                                                'sakit' => 'S',
                                                'izin' => 'I',
                                                'alfa' => 'A',
                                                'dispensasi' => 'D',
                                            ];

                                        @endphp


                                        <td class="px-3 py-4 text-center">

                                            @if($status)

                                                <span
                                                    class="
                                                        status
                                                        status-{{ $status }}
                                                    "
                                                    title="{{ ucfirst($status) }}"
                                                >
                                                    {{ $labels[$status] ?? '?' }}
                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        status
                                                        status-empty
                                                    "
                                                    title="Belum ada data"
                                                >
                                                    —
                                                </span>

                                            @endif

                                        </td>

                                    @endfor


                                    {{-- SCORE --}}

                                    <td class="px-4 py-4 text-center">

                                        <span
                                            class="
                                                score
                                                inline-flex
                                                items-center
                                                justify-center
                                                px-3
                                                py-2
                                                rounded-xl
                                                bg-blue-50
                                                text-blue-700
                                                font-bold
                                                text-sm
                                            "
                                        >
                                            {{ $score }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="11"
                                        class="px-5 py-16 text-center"
                                    >

                                        <div
                                            class="
                                                flex
                                                flex-col
                                                items-center
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
                                                    mb-4
                                                "
                                            >

                                                <i
                                                    data-lucide="users-round"
                                                    class="
                                                        w-6
                                                        h-6
                                                        text-slate-400
                                                    "
                                                ></i>

                                            </div>


                                            <p class="font-semibold text-slate-700">
                                                Belum ada siswa
                                            </p>


                                            <p class="text-sm text-slate-400 mt-1">
                                                Belum ada data siswa untuk kelas
                                                {{ $kelas ?: '-' }}.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     LEGEND
                ================================================== --}}

                <div
                    class="
                        px-5
                        py-5
                        border-t
                        border-slate-100
                        bg-slate-50
                    "
                >

                    <div
                        class="
                            flex
                            flex-wrap
                            items-center
                            gap-x-5
                            gap-y-3
                            text-xs
                            text-slate-500
                        "
                    >

                        <span class="font-semibold text-slate-600">
                            Keterangan:
                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-hadir w-6 h-6">
                                H
                            </span>

                            Hadir

                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-sakit w-6 h-6">
                                S
                            </span>

                            Sakit

                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-izin w-6 h-6">
                                I
                            </span>

                            Izin (-10)

                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-alfa w-6 h-6">
                                A
                            </span>

                            Alfa (-10)

                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-dispensasi w-6 h-6">
                                D
                            </span>

                            Dispensasi

                        </span>


                        <span class="flex items-center gap-1.5">

                            <span class="status status-empty w-6 h-6">
                                —
                            </span>

                            Belum ada data

                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 FOOTER INFO
            ================================================== --}}

            <div
                class="
                    mt-5
                    flex
                    items-start
                    gap-3
                    text-xs
                    text-slate-400
                "
            >

                <i
                    data-lucide="info"
                    class="w-4 h-4 shrink-0 mt-0.5"
                ></i>

                <p>
                    Skor dihitung otomatis berdasarkan seluruh data absensi
                    siswa pada 8 pertemuan. Nilai maksimum 100 dan minimum 0.
                </p>

            </div>

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