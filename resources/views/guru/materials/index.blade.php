<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Materi Pembelajaran — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>


    <style>

        * {
            font-family: 'DM Sans', 'Inter', sans-serif;
        }


        body {
            background: #f4f7fb;
        }


        .main-content {
            min-height: 100vh;
        }


        .material-card {
            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .material-card:hover {
            transform: translateY(-2px);
            box-shadow:
                0 12px 30px rgba(15, 23, 42, .07);
            border-color: #dbe4f0;
        }


        .meeting-card {
            transition:
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .meeting-card:hover {
            box-shadow:
                0 12px 30px rgba(15, 23, 42, .06);
            border-color: #dbe4f0;
        }


        .filter-select {
            appearance: none;
            -webkit-appearance: none;
            background-image: none;
        }


        .empty-dashed {
            border: 1.5px dashed #d8e0ea;
        }


        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0 !important;
            }

        }

    </style>

</head>


<body class="min-h-screen text-slate-800">


{{-- =========================================================
     SIDEBAR
========================================================= --}}

@include('guru.partials.sidebar')



{{-- =========================================================
     MAIN
========================================================= --}}

<main
    class="main-content lg:ml-64 transition-all duration-300"
>


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    @include('guru.partials.header')



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
                xl:flex-row
                xl:items-end
                xl:justify-between
                gap-5
                mb-6
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
                            border
                            border-blue-100
                            px-3
                            py-1.5
                            rounded-full
                        "
                    >

                        <i
                            data-lucide="book-open"
                            class="w-3.5 h-3.5"
                        ></i>

                        Pembelajaran

                    </span>

                </div>


                <h1
                    class="
                        text-2xl
                        lg:text-3xl
                        font-bold
                        text-slate-900
                    "
                >
                    Materi Pembelajaran
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-1
                    "
                >
                    Kelola materi pembelajaran berdasarkan pertemuan.
                </p>

            </div>


            <a
                href="{{ route('guru.materials.create') }}"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    bg-blue-600
                    hover:bg-blue-700
                    text-white
                    px-4
                    py-2.5
                    rounded-xl
                    text-sm
                    font-semibold
                    transition
                    shadow-sm
                    shrink-0
                "
            >

                <i
                    data-lucide="plus"
                    class="w-4 h-4"
                ></i>

                Tambah Materi

            </a>

        </div>



        {{-- =================================================
             SUCCESS
        ================================================== --}}

        @if(session('success'))

            <div
                class="
                    mb-5
                    flex
                    items-center
                    gap-3
                    bg-green-50
                    border
                    border-green-200
                    text-green-700
                    rounded-2xl
                    px-5
                    py-4
                    text-sm
                "
            >

                <i
                    data-lucide="circle-check"
                    class="w-5 h-5 shrink-0"
                ></i>

                <span>
                    {{ session('success') }}
                </span>

            </div>

        @endif



        {{-- =================================================
             ERROR
        ================================================== --}}

        @if($errors->any())

            <div
                class="
                    mb-5
                    bg-red-50
                    border
                    border-red-200
                    text-red-700
                    rounded-2xl
                    px-5
                    py-4
                    text-sm
                "
            >

                <div class="flex gap-3">

                    <i
                        data-lucide="circle-alert"
                        class="w-5 h-5 shrink-0"
                    ></i>


                    <div>

                        <p class="font-semibold">
                            Terjadi kesalahan.
                        </p>


                        <ul
                            class="
                                mt-2
                                list-disc
                                list-inside
                                space-y-1
                            "
                        >

                            @foreach($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif



        {{-- =================================================
             SUMMARY
        ================================================== --}}

        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-3
                gap-4
                mb-5
            "
        >


            {{-- TOTAL MATERI --}}

            <div
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-5
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
                                font-semibold
                                text-slate-400
                                uppercase
                                tracking-wide
                            "
                        >
                            Total Materi
                        </p>


                        <p
                            class="
                                text-2xl
                                font-bold
                                text-slate-900
                                mt-1
                            "
                        >
                            {{ $materials->count() }}
                        </p>

                    </div>


                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            data-lucide="book-open"
                            class="w-5 h-5"
                        ></i>

                    </div>

                </div>

            </div>



            {{-- MATERI AKTIF --}}

            <div
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-5
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
                                font-semibold
                                text-slate-400
                                uppercase
                                tracking-wide
                            "
                        >
                            Materi Aktif
                        </p>


                        <p
                            class="
                                text-2xl
                                font-bold
                                text-green-600
                                mt-1
                            "
                        >
                            {{ $materials->where('aktif', true)->count() }}
                        </p>

                    </div>


                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-green-50
                            text-green-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            data-lucide="circle-check"
                            class="w-5 h-5"
                        ></i>

                    </div>

                </div>

            </div>



            {{-- PERTEMUAN --}}

            <div
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    p-5
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
                                font-semibold
                                text-slate-400
                                uppercase
                                tracking-wide
                            "
                        >
                            Pertemuan
                        </p>


                        <p
                            class="
                                text-2xl
                                font-bold
                                text-slate-900
                                mt-1
                            "
                        >

                            @if($pertemuan)

                                {{ $pertemuan }}

                            @elseif(isset($pertemuans) && $pertemuans->count())

                                {{ $pertemuans->count() }}

                            @else

                                0

                            @endif

                        </p>

                    </div>


                    <div
                        class="
                            w-10
                            h-10
                            rounded-xl
                            bg-purple-50
                            text-purple-600
                            flex
                            items-center
                            justify-center
                        "
                    >

                        <i
                            data-lucide="calendar-days"
                            class="w-5 h-5"
                        ></i>

                    </div>

                </div>

            </div>

        </div>



        {{-- =================================================
             FILTER
        ================================================== --}}

        <div
            class="
                bg-white
                border
                border-slate-200
                rounded-2xl
                p-4
                lg:p-5
                mb-6
            "
        >

            <div
                class="
                    flex
                    flex-col
                    lg:flex-row
                    lg:items-end
                    gap-4
                "
            >

                {{-- FILTER PERTEMUAN --}}

                <div class="flex-1">

                    <label
                        class="
                            block
                            text-xs
                            font-semibold
                            text-slate-500
                            mb-2
                        "
                    >
                        Pertemuan
                    </label>


                    <div class="relative">

                        <select
                            id="pertemuanFilter"
                            class="
                                filter-select
                                w-full
                                h-11
                                bg-slate-50
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                pr-10
                                text-sm
                                text-slate-700
                                outline-none
                                focus:bg-white
                                focus:border-blue-400
                                focus:ring-4
                                focus:ring-blue-50
                                transition
                            "
                        >

                            <option value="">
                                Semua Pertemuan
                            </option>


                            @if(isset($pertemuans))

                                @foreach($pertemuans as $meeting)

                                    <option
                                        value="{{ $meeting }}"
                                        @selected(
                                            (string) $pertemuan ===
                                            (string) $meeting
                                        )
                                    >
                                        Pertemuan {{ $meeting }}
                                    </option>

                                @endforeach

                            @endif

                        </select>


                        <i
                            data-lucide="chevron-down"
                            class="
                                w-4
                                h-4
                                text-slate-400
                                absolute
                                right-3
                                top-1/2
                                -translate-y-1/2
                                pointer-events-none
                            "
                        ></i>

                    </div>

                </div>



                {{-- TOMBOL FILTER --}}

                <div
                    class="
                        flex
                        items-center
                        gap-2
                    "
                >

                    <button
                        type="button"
                        id="applyFilter"
                        class="
                            h-11
                            px-5
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            rounded-xl
                            text-sm
                            font-semibold
                            transition
                        "
                    >

                        <i
                            data-lucide="filter"
                            class="w-4 h-4"
                        ></i>

                        Filter

                    </button>


                    <button
                        type="button"
                        id="resetFilter"
                        class="
                            h-11
                            px-4
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            bg-slate-100
                            hover:bg-slate-200
                            text-slate-600
                            rounded-xl
                            text-sm
                            font-semibold
                            transition
                        "
                    >

                        <i
                            data-lucide="rotate-ccw"
                            class="w-4 h-4"
                        ></i>

                        Reset

                    </button>

                </div>

            </div>


            <div
                class="
                    flex
                    items-center
                    gap-2
                    mt-3
                    text-[11px]
                    text-slate-400
                "
            >

                <i
                    data-lucide="info"
                    class="w-3.5 h-3.5"
                ></i>

                Filter pertemuan aktif.

            </div>

        </div>



        {{-- =================================================
             MATERIAL LIST
        ================================================== --}}

        @if($materials->count())

            @php

                $materialsByMeeting =
                    $materials
                        ->groupBy('pertemuan');

            @endphp


            <div
                class="
                    space-y-5
                "
            >


                @foreach(
                    $materialsByMeeting
                    as $meetingNumber => $meetingMaterials
                )


                    {{-- =================================================
                         MEETING CARD
                    ================================================== --}}

                    <section
                        class="
                            meeting-card
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            overflow-hidden
                        "
                        data-meeting="{{ $meetingNumber }}"
                    >


                        {{-- MEETING HEADER --}}

                        <div
                            class="
                                flex
                                flex-col
                                sm:flex-row
                                sm:items-center
                                sm:justify-between
                                gap-3
                                px-5
                                py-4
                                border-b
                                border-slate-200
                                bg-slate-50/80
                            "
                        >

                            <div
                                class="
                                    flex
                                    items-center
                                    gap-3
                                "
                            >

                                <div
                                    class="
                                        w-10
                                        h-10
                                        rounded-xl
                                        bg-blue-50
                                        text-blue-600
                                        flex
                                        items-center
                                        justify-center
                                        shrink-0
                                    "
                                >

                                    <i
                                        data-lucide="calendar-days"
                                        class="w-5 h-5"
                                    ></i>

                                </div>


                                <div>

                                    <p
                                        class="
                                            text-[10px]
                                            font-bold
                                            uppercase
                                            tracking-[.12em]
                                            text-slate-400
                                        "
                                    >
                                        Pertemuan
                                    </p>


                                    <h2
                                        class="
                                            text-base
                                            font-bold
                                            text-slate-900
                                        "
                                    >
                                        Pertemuan {{ $meetingNumber }}
                                    </h2>

                                </div>

                            </div>


                            <div
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    self-start
                                    sm:self-auto
                                    bg-white
                                    border
                                    border-blue-100
                                    text-blue-700
                                    px-3
                                    py-1.5
                                    rounded-full
                                    text-xs
                                    font-semibold
                                "
                            >

                                <i
                                    data-lucide="book-open"
                                    class="w-3.5 h-3.5"
                                ></i>

                                {{ $meetingMaterials->count() }}

                                {{ $meetingMaterials->count() == 1 ? 'materi' : 'materi' }}

                            </div>

                        </div>



                        {{-- MATERIAL GRID --}}

                        <div
                            class="
                                p-5
                                grid
                                grid-cols-1
                                md:grid-cols-2
                                xl:grid-cols-3
                                gap-4
                            "
                        >


                            @foreach(
                                $meetingMaterials
                                as $material
                            )


                                <article
                                    class="
                                        material-card
                                        bg-white
                                        border
                                        border-slate-200
                                        rounded-2xl
                                        overflow-hidden
                                    "
                                >


                                    {{-- TOP ACCENT --}}

                                    <div
                                        class="
                                            h-1.5
                                            bg-blue-600
                                        "
                                    ></div>


                                    <div class="p-4">


                                        {{-- STATUS --}}

                                        <div
                                            class="
                                                flex
                                                items-center
                                                justify-between
                                                gap-2
                                                mb-4
                                            "
                                        >

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    gap-1.5
                                                    bg-blue-50
                                                    text-blue-700
                                                    px-2.5
                                                    py-1.5
                                                    rounded-lg
                                                    text-[11px]
                                                    font-bold
                                                "
                                            >

                                                <i
                                                    data-lucide="book-open"
                                                    class="w-3.5 h-3.5"
                                                ></i>

                                                Materi {{ $loop->iteration }}

                                            </span>


                                            @if($material->aktif)

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        bg-green-50
                                                        text-green-700
                                                        border
                                                        border-green-100
                                                        px-2.5
                                                        py-1
                                                        rounded-full
                                                        text-[10px]
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
                                                        gap-1.5
                                                        bg-slate-100
                                                        text-slate-500
                                                        border
                                                        border-slate-200
                                                        px-2.5
                                                        py-1
                                                        rounded-full
                                                        text-[10px]
                                                        font-bold
                                                    "
                                                >

                                                    Nonaktif

                                                </span>

                                            @endif

                                        </div>



                                        {{-- TITLE --}}

                                        <h3
                                            class="
                                                text-base
                                                font-bold
                                                text-slate-900
                                                leading-snug
                                                min-h-[44px]
                                            "
                                        >
                                            {{ $material->judul }}
                                        </h3>



                                        {{-- CATEGORY --}}

                                        @if($material->kategori)

                                            <p
                                                class="
                                                    text-xs
                                                    text-slate-400
                                                    font-medium
                                                    mt-2
                                                "
                                            >
                                                {{ $material->kategori }}
                                            </p>

                                        @else

                                            <div class="h-[17px] mt-2"></div>

                                        @endif


                                        {{-- ACTION --}}

                                        <div
                                            class="
                                                grid
                                                grid-cols-[1fr_1fr_auto]
                                                gap-2
                                                mt-5
                                                pt-4
                                                border-t
                                                border-slate-100
                                            "
                                        >


                                            {{-- LIHAT --}}

                                            <a
                                                href="{{ route(
                                                    'guru.materials.show',
                                                    $material
                                                ) }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    gap-1.5
                                                    bg-slate-100
                                                    hover:bg-slate-200
                                                    text-slate-700
                                                    px-3
                                                    py-2.5
                                                    rounded-xl
                                                    text-xs
                                                    font-semibold
                                                    transition
                                                "
                                            >

                                                <i
                                                    data-lucide="eye"
                                                    class="w-3.5 h-3.5"
                                                ></i>

                                                Lihat

                                            </a>



                                            {{-- EDIT --}}

                                            <a
                                                href="{{ route(
                                                    'guru.materials.edit',
                                                    $material
                                                ) }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    gap-1.5
                                                    bg-blue-50
                                                    hover:bg-blue-100
                                                    text-blue-700
                                                    px-3
                                                    py-2.5
                                                    rounded-xl
                                                    text-xs
                                                    font-semibold
                                                    transition
                                                "
                                            >

                                                <i
                                                    data-lucide="pencil"
                                                    class="w-3.5 h-3.5"
                                                ></i>

                                                Edit

                                            </a>



                                            {{-- HAPUS --}}

                                            <form
                                                method="POST"
                                                action="{{ route(
                                                    'guru.materials.destroy',
                                                    $material
                                                ) }}"
                                                onsubmit="
                                                    return confirm(
                                                        'Hapus materi ini? Jika ini adalah materi terakhir pada Pertemuan {{ $meetingNumber }}, pertemuan tersebut juga akan dihapus.'
                                                    );
                                                "
                                            >

                                                @csrf

                                                @method('DELETE')


                                                <button
                                                    type="submit"
                                                    class="
                                                        w-10
                                                        h-10
                                                        inline-flex
                                                        items-center
                                                        justify-center
                                                        bg-red-50
                                                        hover:bg-red-100
                                                        text-red-600
                                                        rounded-xl
                                                        transition
                                                    "
                                                    title="Hapus materi"
                                                >

                                                    <i
                                                        data-lucide="trash-2"
                                                        class="w-4 h-4"
                                                    ></i>

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </article>


                            @endforeach

                        </div>

                    </section>


                @endforeach

            </div>


        @else


            {{-- =================================================
                 EMPTY STATE
            ================================================== --}}

            <div
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    overflow-hidden
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        items-center
                        justify-center
                        text-center
                        px-6
                        py-20
                    "
                >

                    <div
                        class="
                            w-16
                            h-16
                            rounded-2xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                            mb-5
                        "
                    >

                        <i
                            data-lucide="book-open"
                            class="w-7 h-7"
                        ></i>

                    </div>


                    @if($pertemuan)

                        <h3
                            class="
                                text-lg
                                font-bold
                                text-slate-800
                            "
                        >
                            Belum ada materi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                max-w-md
                                mt-2
                            "
                        >
                            Belum ada materi pembelajaran
                            untuk Pertemuan {{ $pertemuan }}.
                        </p>

                    @else

                        <h3
                            class="
                                text-lg
                                font-bold
                                text-slate-800
                            "
                        >
                            Materi masih kosong
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                max-w-md
                                mt-2
                            "
                        >
                            Belum ada materi pembelajaran.
                            Tambahkan materi pertama untuk
                            mulai membangun pembelajaran.
                        </p>

                    @endif


                    <a
                        href="{{ route(
                            'guru.materials.create'
                        ) }}"
                        class="
                            mt-6
                            inline-flex
                            items-center
                            gap-2
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            px-5
                            py-3
                            rounded-xl
                            text-sm
                            font-semibold
                            transition
                        "
                    >

                        <i
                            data-lucide="plus"
                            class="w-4 h-4"
                        ></i>

                        Tambah Materi

                    </a>

                </div>

            </div>


        @endif



        {{-- =================================================
             FOOTER INFO
        ================================================== --}}

        <div
            class="
                mt-5
                flex
                items-start
                gap-2
                text-xs
                text-slate-400
            "
        >

            <i
                data-lucide="info"
                class="w-4 h-4 shrink-0 mt-0.5"
            ></i>

            <p>
                Materi dikelompokkan berdasarkan nomor pertemuan
                dan dapat dilengkapi teks, gambar, video, maupun audio.
            </p>

        </div>


    </div>


</main>



{{-- =========================================================
     SCRIPT
========================================================= --}}

<script>

    document.addEventListener(
        'DOMContentLoaded',
        function () {


            /*
            |--------------------------------------------------------------------------
            | LUCIDE
            |--------------------------------------------------------------------------
            */

            if (
                typeof lucide !== 'undefined'
            ) {

                lucide.createIcons();

            }



            /*
            |--------------------------------------------------------------------------
            | FILTER
            |--------------------------------------------------------------------------
            */

            const pertemuanFilter =
                document.getElementById(
                    'pertemuanFilter'
                );


            const kelasFilter =
                document.getElementById(
                    'kelasFilter'
                );


            const applyFilter =
                document.getElementById(
                    'applyFilter'
                );


            const resetFilter =
                document.getElementById(
                    'resetFilter'
                );



            /*
            |--------------------------------------------------------------------------
            | TERAPKAN FILTER
            |--------------------------------------------------------------------------
            */

            if (applyFilter) {

                applyFilter.addEventListener(
                    'click',
                    function () {

                        const pertemuan =
                            pertemuanFilter
                                ? pertemuanFilter.value
                                : '';


                        /*
                        |--------------------------------------------------------------------------
                        | Kelas belum mempunyai relasi database
                        |--------------------------------------------------------------------------
                        |
                        | Untuk sekarang hanya pertemuan yang dikirim ke
                        | MaterialController karena tabel materials belum
                        | memiliki kolom kelas.
                        |
                        */

                        let url =
                            new URL(
                                window.location.href
                            );


                        if (pertemuan) {

                            url.searchParams.set(
                                'pertemuan',
                                pertemuan
                            );

                        } else {

                            url.searchParams.delete(
                                'pertemuan'
                            );

                        }


                        window.location.href =
                            url.toString();

                    }
                );

            }



            /*
            |--------------------------------------------------------------------------
            | RESET
            |--------------------------------------------------------------------------
            */

            if (resetFilter) {

                resetFilter.addEventListener(
                    'click',
                    function () {

                        window.location.href =
                            "{{ route('guru.materials.index') }}";

                    }
                );

            }


        }
    );

</script>


</body>

</html>