<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Siswa — LARASKU</title>

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

        .stat-card {
            transition: all .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(15, 23, 42, .08);
        }

        .student-row {
            transition: background .15s ease;
        }

        .student-row:hover {
            background: #f8fafc;
        }

        .btn-primary {
            transition: all .2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 18px rgba(37, 99, 235, .20);
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>


<body class="min-h-screen text-slate-800">


    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="main-content">


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

                <h2 class="text-lg font-bold text-slate-900">
                    Data Siswa
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
                    text-sm
                    font-bold
                "
            >
                G
            </div>

        </header>



        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="p-5 lg:p-8 max-w-7xl mx-auto">


            {{-- FLASH MESSAGE --}}

            @if(session('success'))

                <div
                    class="
                        mb-6
                        flex
                        items-center
                        gap-3
                        rounded-xl
                        border
                        border-green-200
                        bg-green-50
                        px-4
                        py-3
                        text-sm
                        text-green-700
                    "
                >

                    <i
                        data-lucide="circle-check"
                        class="w-5 h-5"
                    ></i>

                    <span>
                        {{ session('success') }}
                    </span>

                </div>

            @endif



            {{-- =================================================
                 TITLE
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-end
                    sm:justify-between
                    gap-4
                    mb-7
                "
            >

                <div>

                    <p
                        class="
                            text-sm
                            font-medium
                            text-blue-600
                            mb-1
                        "
                    >
                        Manajemen Siswa
                    </p>


                    <h1
                        class="
                            text-3xl
                            font-bold
                            tracking-tight
                            text-slate-900
                        "
                    >
                        Data Siswa
                    </h1>


                    <p class="mt-1 text-sm text-slate-500">
                        Kelola data siswa yang terdaftar di LARASKU.
                    </p>

                </div>


                <a
                    href="{{ route('guru.students.create') }}"
                    class="
                        btn-primary
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        bg-blue-600
                        hover:bg-blue-700
                        text-white
                        px-5
                        py-2.5
                        rounded-xl
                        text-sm
                        font-semibold
                    "
                >

                    <i
                        data-lucide="plus"
                        class="w-4 h-4"
                    ></i>

                    Tambah Siswa

                </a>

            </div>



            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            @php

                $totalSiswa = $students->count();

                $siswaAktif = $students
                    ->where('aktif', true)
                    ->count();

                $siswaNonaktif = $students
                    ->where('aktif', false)
                    ->count();

            @endphp


            <div
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-3
                    gap-4
                    mb-7
                "
            >


                {{-- TOTAL --}}

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

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                    uppercase
                                    tracking-wide
                                "
                            >
                                Total Siswa
                            </p>


                            <p
                                class="
                                    mt-2
                                    text-3xl
                                    font-bold
                                    text-slate-900
                                "
                            >
                                {{ $totalSiswa }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-blue-50
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="users"
                                class="w-5 h-5 text-blue-600"
                            ></i>

                        </div>

                    </div>

                </div>



                {{-- AKTIF --}}

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

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                    uppercase
                                    tracking-wide
                                "
                            >
                                Siswa Aktif
                            </p>


                            <p
                                class="
                                    mt-2
                                    text-3xl
                                    font-bold
                                    text-slate-900
                                "
                            >
                                {{ $siswaAktif }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-green-50
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="user-check"
                                class="w-5 h-5 text-green-600"
                            ></i>

                        </div>

                    </div>

                </div>



                {{-- NONAKTIF --}}

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

                    <div class="flex items-center justify-between">

                        <div>

                            <p
                                class="
                                    text-xs
                                    font-medium
                                    text-slate-400
                                    uppercase
                                    tracking-wide
                                "
                            >
                                Nonaktif
                            </p>


                            <p
                                class="
                                    mt-2
                                    text-3xl
                                    font-bold
                                    text-slate-900
                                "
                            >
                                {{ $siswaNonaktif }}
                            </p>

                        </div>


                        <div
                            class="
                                w-11
                                h-11
                                rounded-xl
                                bg-slate-100
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="user-x"
                                class="w-5 h-5 text-slate-500"
                            ></i>

                        </div>

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
                        lg:px-6
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

                        <h2 class="font-bold text-slate-900">
                            Daftar Siswa
                        </h2>

                        <p class="text-xs text-slate-400 mt-1">
                            Data siswa yang tersimpan dalam database.
                        </p>

                    </div>


                    {{-- SEARCH --}}

                    <div class="relative">

                        <i
                            data-lucide="search"
                            class="
                                absolute
                                left-3
                                top-1/2
                                -translate-y-1/2
                                w-4
                                h-4
                                text-slate-400
                            "
                        ></i>


                        <input
                            type="text"
                            id="searchStudent"
                            placeholder="Cari siswa..."
                            class="
                                w-full
                                sm:w-64
                                pl-9
                                pr-4
                                py-2.5
                                rounded-xl
                                border
                                border-slate-200
                                text-sm
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-100
                                focus:border-blue-400
                            "
                        >

                    </div>

                </div>



                {{-- TABLE --}}

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead
                            class="
                                bg-slate-50
                                border-b
                                border-slate-100
                            "
                        >

                            <tr>

                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    No
                                </th>


                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    Nama Siswa
                                </th>


                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    Kelas
                                </th>


                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    No. Absen
                                </th>


                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-left
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    Status
                                </th>


                                <th
                                    class="
                                        px-5
                                        lg:px-6
                                        py-3
                                        text-right
                                        text-xs
                                        font-semibold
                                        text-slate-500
                                        uppercase
                                        tracking-wide
                                    "
                                >
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody id="studentTable">

                            @forelse($students as $student)

                                <tr
                                    class="
                                        student-row
                                        border-b
                                        border-slate-100
                                        last:border-0
                                    "
                                    data-search="{{ strtolower($student->nama . ' ' . $student->kelas . ' ' . ($student->nomor_absen ?? '')) }}"
                                >


                                    {{-- NO --}}

                                    <td
                                        class="
                                            px-5
                                            lg:px-6
                                            py-4
                                            text-slate-400
                                            font-medium
                                        "
                                    >
                                        {{ $loop->iteration }}
                                    </td>



                                    {{-- NAMA --}}

                                    <td
                                        class="
                                            px-5
                                            lg:px-6
                                            py-4
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
                                                {{ strtoupper(substr($student->nama, 0, 1)) }}
                                            </div>


                                            <div>

                                                <p
                                                    class="
                                                        font-semibold
                                                        text-slate-800
                                                    "
                                                >
                                                    {{ $student->nama }}
                                                </p>

                                                <p
                                                    class="
                                                        text-xs
                                                        text-slate-400
                                                    "
                                                >
                                                    ID #{{ $student->id }}
                                                </p>

                                            </div>

                                        </div>

                                    </td>



                                    {{-- KELAS --}}

                                    <td
                                        class="
                                            px-5
                                            lg:px-6
                                            py-4
                                            text-slate-600
                                        "
                                    >
                                        {{ $student->kelas ?: '-' }}
                                    </td>



                                    {{-- ABSEN --}}

                                    <td
                                        class="
                                            px-5
                                            lg:px-6
                                            py-4
                                            text-slate-600
                                        "
                                    >
                                        {{ $student->nomor_absen ?: '-' }}
                                    </td>



                                    {{-- STATUS --}}

                                    <td
                                        class="
                                            px-5
                                            lg:px-6
                                            py-4
                                        "
                                    >

                                        @if($student->aktif)

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    gap-1.5
                                                    px-2.5
                                                    py-1
                                                    rounded-full
                                                    bg-green-50
                                                    text-green-700
                                                    text-xs
                                                    font-semibold
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
                                                    gap-1.5
                                                    px-2.5
                                                    py-1
                                                    rounded-full
                                                    bg-slate-100
                                                    text-slate-500
                                                    text-xs
                                                    font-semibold
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
================================================= --}}

<td
    class="
        px-5
        lg:px-6
        py-4
    "
>
    <div
        class="
            flex
            justify-end
            items-center
            gap-1
        "
    >

        {{-- EDIT --}}

        <a
            href="{{ route('guru.students.edit', $student) }}"
            title="Edit Siswa"
            class="
                w-9
                h-9
                rounded-lg
                flex
                items-center
                justify-center
                text-slate-400
                hover:text-amber-600
                hover:bg-amber-50
                transition
            "
        >
            <i
                data-lucide="pencil"
                class="w-4 h-4"
            ></i>
        </a>


        {{-- HAPUS --}}

        <form
            action="{{ route('guru.students.destroy', $student) }}"
            method="POST"
            onsubmit="return confirm('Hapus siswa {{ addslashes($student->nama) }}?')"
        >

            @csrf

            @method('DELETE')

            <button
                type="submit"
                title="Hapus Siswa"
                class="
                    w-9
                    h-9
                    rounded-lg
                    flex
                    items-center
                    justify-center
                    text-slate-400
                    hover:text-red-600
                    hover:bg-red-50
                    transition
                "
            >
                <i
                    data-lucide="trash-2"
                    class="w-4 h-4"
                ></i>
            </button>

        </form>

    </div>
</td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="6"
                                        class="
                                            px-6
                                            py-16
                                            text-center
                                        "
                                    >

                                        <div class="flex flex-col items-center">

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
                                                    data-lucide="users"
                                                    class="w-6 h-6 text-slate-400"
                                                ></i>

                                            </div>


                                            <h3
                                                class="
                                                    font-semibold
                                                    text-slate-800
                                                "
                                            >
                                                Belum ada siswa
                                            </h3>


                                            <p
                                                class="
                                                    text-sm
                                                    text-slate-400
                                                    mt-1
                                                "
                                            >
                                                Tambahkan siswa untuk mulai menggunakan LARASKU.
                                            </p>


                                            <a
                                                href="{{ route('guru.students.create') }}"
                                                class="
                                                    mt-5
                                                    inline-flex
                                                    items-center
                                                    gap-2
                                                    bg-blue-600
                                                    hover:bg-blue-700
                                                    text-white
                                                    px-4
                                                    py-2.5
                                                    rounded-xl
                                                    text-sm
                                                    font-semibold
                                                "
                                            >

                                                <i
                                                    data-lucide="plus"
                                                    class="w-4 h-4"
                                                ></i>

                                                Tambah Siswa

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>



    <script>

        document.addEventListener('DOMContentLoaded', function () {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }


            /*
            |--------------------------------------------------------------------------
            | PENCARIAN SISWA
            |--------------------------------------------------------------------------
            */

            const searchInput =
                document.getElementById('searchStudent');


            if (searchInput) {

                searchInput.addEventListener('input', function () {

                    const keyword =
                        this.value
                            .toLowerCase()
                            .trim();


                    document
                        .querySelectorAll(
                            '#studentTable .student-row'
                        )
                        .forEach(row => {

                            const text =
                                row.dataset.search || '';

                            row.style.display =
                                text.includes(keyword)
                                    ? ''
                                    : 'none';

                        });

                });

            }

        });

    </script>

</body>
</html>