<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap LKPD — LARASKU</title>

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
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
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


<body>

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
        class="
            main-content
            lg:ml-64
            transition-all
            duration-300
        "
    >

        {{-- =====================================================
             TOPBAR
        ====================================================== --}}

        <header
            class="
                h-[74px]
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
                    Rekap LKPD
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

        <div
            class="
                p-5
                lg:p-8
                max-w-[1500px]
                mx-auto
            "
        >

            {{-- =================================================
                 HEADING
            ================================================== --}}

            <section class="mb-7">

                <div class="mb-2">

                    <span
                        class="
                            inline-flex
                            items-center
                            gap-2
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
                            data-lucide="file-check-2"
                            class="w-3.5 h-3.5"
                        ></i>

                        Panel Guru

                    </span>

                </div>


                <h1
                    class="
                        text-3xl
                        font-bold
                        text-slate-900
                    "
                >
                    Rekap LKPD
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Periksa pengumpulan tugas siswa dan berikan persetujuan.
                </p>

            </section>


            {{-- =================================================
                 FILTER
            ================================================== --}}

            <section
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
                    action="{{ route('guru.lkpd.index') }}"
                    method="GET"
                >

                    <div
                        class="
                            grid
                            grid-cols-1
                            md:grid-cols-[1fr_220px_auto]
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
                                    font-semibold
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
                                    h-[43px]
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-500
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >

                                <option value="">
                                    Semua Kelas
                                </option>


                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        {{ ($kelas ?? '') === $class ? 'selected' : '' }}
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PERTEMUAN --}}
                        <div>

                            <label
                                for="pertemuan"
                                class="
                                    block
                                    text-xs
                                    font-semibold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Pertemuan
                            </label>


                            <select
                                id="pertemuan"
                                name="pertemuan"
                                class="
                                    w-full
                                    h-[43px]
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-500
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >

                                <option value="">
                                    Semua Pertemuan
                                </option>


                                @for($i = 1; $i <= 8; $i++)

                                    <option
                                        value="{{ $i }}"
                                        {{ (string) ($pertemuan ?? '') === (string) $i ? 'selected' : '' }}
                                    >
                                        Pertemuan {{ $i }}
                                    </option>

                                @endfor

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="
                                h-[43px]
                                px-5
                                rounded-xl
                                bg-slate-900
                                hover:bg-slate-800
                                text-white
                                text-sm
                                font-semibold
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

                            Terapkan Filter

                        </button>

                    </div>

                </form>

            </section>


            {{-- =================================================
                 SUMMARY
            ================================================== --}}

            @php

                $total =
                    $lkpds->count();

                $approvedCount =
                    $lkpds
                        ->where('disetujui', true)
                        ->count();

                $waitingCount =
                    $total - $approvedCount;

            @endphp


            <div
                class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-3
                    mb-3
                    text-sm
                    text-slate-500
                "
            >

                <div>

                    Total pengumpulan:

                    <strong class="text-slate-900">
                        {{ $total }}
                    </strong>

                </div>


                <div class="flex flex-wrap gap-2">

                    <span
                        class="
                            px-3
                            py-1.5
                            rounded-lg
                            text-xs
                            font-bold
                            bg-orange-50
                            text-orange-700
                        "
                    >
                        Menunggu {{ $waitingCount }}
                    </span>


                    <span
                        class="
                            px-3
                            py-1.5
                            rounded-lg
                            text-xs
                            font-bold
                            bg-emerald-50
                            text-emerald-700
                        "
                    >
                        Disetujui {{ $approvedCount }}
                    </span>

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
                    overflow-hidden
                    shadow-sm
                "
            >

                @if($lkpds->count())

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[900px]">

                            <thead>

                                <tr>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                        width="55"
                                    >
                                        No
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                    >
                                        Siswa
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                    >
                                        Absen
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                    >
                                        Pertemuan
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                    >
                                        Status
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                    >
                                        Dikirim
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            bg-slate-50
                                            border-b
                                            border-slate-200
                                            text-left
                                            text-xs
                                            font-bold
                                            text-slate-500
                                            uppercase
                                        "
                                        width="100"
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($lkpds as $index => $lkpd)

                                    <tr
                                        class="
                                            border-b
                                            border-slate-100
                                            last:border-0
                                            hover:bg-slate-50
                                            transition
                                        "
                                    >

                                        {{-- NO --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    text-sm
                                                    font-semibold
                                                    text-slate-400
                                                "
                                            >
                                                {{ $index + 1 }}
                                            </span>

                                        </td>


                                        {{-- SISWA --}}
                                        <td class="px-5 py-4">

                                            <div
                                                class="
                                                    font-bold
                                                    text-slate-900
                                                "
                                            >
                                                {{ $lkpd->student->nama ?? 'Siswa tidak ditemukan' }}
                                            </div>


                                            <div
                                                class="
                                                    mt-1
                                                    text-xs
                                                    text-slate-400
                                                "
                                            >
                                                {{ $lkpd->student->kelas ?? '-' }}
                                            </div>

                                        </td>


                                        {{-- ABSEN --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    font-semibold
                                                    text-slate-600
                                                "
                                            >
                                                {{ $lkpd->student->nomor_absen ?? '-' }}
                                            </span>

                                        </td>


                                        {{-- PERTEMUAN --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    inline-flex
                                                    px-2.5
                                                    py-1.5
                                                    rounded-lg
                                                    bg-blue-50
                                                    text-blue-600
                                                    text-xs
                                                    font-bold
                                                "
                                            >
                                                Pertemuan {{ $lkpd->pertemuan }}
                                            </span>

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-5 py-4">

                                            @if($lkpd->disetujui)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-2
                                                        rounded-lg
                                                        bg-emerald-50
                                                        text-emerald-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >

                                                    <span>
                                                        ●
                                                    </span>

                                                    Disetujui

                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-3
                                                        py-2
                                                        rounded-lg
                                                        bg-orange-50
                                                        text-orange-700
                                                        text-xs
                                                        font-bold
                                                    "
                                                >

                                                    <span>
                                                        ●
                                                    </span>

                                                    Menunggu Pemeriksaan

                                                </span>

                                            @endif

                                        </td>


                                        {{-- DIKIRIM --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    text-sm
                                                    text-slate-500
                                                    whitespace-nowrap
                                                "
                                            >
                                                {{ $lkpd->created_at->format('d/m/Y H:i') }}
                                            </span>

                                        </td>


                                        {{-- AKSI --}}
                                        <td class="px-5 py-4">

                                            <a
                                                href="{{ route('guru.lkpd.show', $lkpd) }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    gap-2
                                                    px-3
                                                    py-2
                                                    rounded-lg
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

                                                Lihat

                                            </a>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    {{-- EMPTY STATE --}}

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
                                mx-auto
                                rounded-2xl
                                bg-slate-100
                                flex
                                items-center
                                justify-center
                                mb-4
                            "
                        >

                            <i
                                data-lucide="file-text"
                                class="
                                    w-6
                                    h-6
                                    text-slate-400
                                "
                            ></i>

                        </div>


                        <div
                            class="
                                text-base
                                font-bold
                                text-slate-700
                            "
                        >
                            Belum ada pengumpulan LKPD
                        </div>


                        <div
                            class="
                                text-sm
                                text-slate-400
                                mt-1
                            "
                        >
                            Belum ada siswa yang mengirimkan tugas
                            sesuai filter yang dipilih.
                        </div>

                    </div>

                @endif

            </section>

        </div>

    </main>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    });
</script>

</body>
</html>