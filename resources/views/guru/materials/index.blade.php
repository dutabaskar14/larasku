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

        .lesson-tab {
            transition: all .2s ease;
        }

        .material-card {
            transition: all .2s ease;
        }

        .material-card:hover {
            transform: translateY(-2px);
        }

        .meeting-number {
            transition: all .2s ease;
        }

        .material-card:hover .meeting-number {
            transform: scale(1.04);
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
         HEADBAR GURU
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
                                data-lucide="book-open"
                                class="w-3.5 h-3.5"
                            ></i>

                            Pembelajaran

                        </span>

                    </div>


                    <h1
                        class="
                            text-3xl
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
                        Kelola materi pembelajaran untuk
                        setiap pertemuan.
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
                        mb-6
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
                        class="w-5 h-5"
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
                        mb-6
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
                    mb-6
                "
            >


                {{-- TOTAL --}}

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
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="book-open"
                                class="w-5 h-5 text-blue-600"
                            ></i>

                        </div>

                    </div>

                </div>



                {{-- AKTIF --}}

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
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="circle-check"
                                class="w-5 h-5 text-green-600"
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

                                    Pertemuan {{ $pertemuan }}

                                @elseif(isset($pertemuans) && $pertemuans->count())

                                    {{ $pertemuans->count() }} pertemuan

                                @else

                                    Belum ada

                                @endif

                            </p>

                        </div>


                        <div
                            class="
                                w-10
                                h-10
                                rounded-xl
                                bg-purple-50
                                flex
                                items-center
                                justify-center
                            "
                        >

                            <i
                                data-lucide="calendar-days"
                                class="w-5 h-5 text-purple-600"
                            ></i>

                        </div>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 MATERIAL LIST
            ================================================== --}}

            @if($materials->count())


                <div
                    class="
                        grid
                        grid-cols-1
                        md:grid-cols-2
                        xl:grid-cols-3
                        gap-5
                    "
                >


                    @foreach($materials as $material)


                        <article
                            class="
                                material-card
                                bg-white
                                border
                                border-slate-200
                                rounded-2xl
                                overflow-hidden
                                shadow-sm
                            "
                        >


                            {{-- =================================================
                                 TOP ACCENT
                            ================================================== --}}

                            <div class="h-2 bg-blue-600"></div>



                            <div class="p-5">


                                {{-- =================================================
                                     PERTEMUAN + STATUS
                                ================================================== --}}

                                <div
                                    class="
                                        flex
                                        items-start
                                        justify-between
                                        gap-3
                                        mb-4
                                    "
                                >


                                    {{-- PERTEMUAN --}}

                                    <div
                                        class="
                                            flex
                                            items-center
                                            gap-3
                                        "
                                    >

                                        <div
                                            class="
                                                meeting-number
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
                                                class="w-4 h-4"
                                            ></i>

                                        </div>


                                        <div>


                                            <div class="flex items-center gap-1.5">

                                            <span
                                                class="
                                                    text-[11px]
                                                    font-bold
                                                    uppercase
                                                    tracking-[0.08em]
                                                    text-slate-400
                                                "
                                            >
                                                Pertemuan
                                            </span>

                                            <span
                                                class="
                                                    text-[11px]
                                                    font-bold
                                                    text-slate-500
                                                "
                                            >
                                                {{ $material->pertemuan }}
                                            </span>

                                        </div>

                                        </div>

                                    </div>



                                    {{-- STATUS --}}

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
                                                py-1.5
                                                rounded-full
                                                text-[11px]
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
                                                bg-slate-100
                                                text-slate-500
                                                border
                                                border-slate-200
                                                px-2.5
                                                py-1.5
                                                rounded-full
                                                text-[11px]
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

                                </div>



                                {{-- =================================================
                                     MATERI NUMBER
                                ================================================== --}}

                                <div class="mb-3">

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            gap-1.5
                                            bg-blue-50
                                            text-blue-700
                                            px-2.5
                                            py-1
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

                                </div>



                                {{-- =================================================
                                     TITLE
                                ================================================== --}}

                                <h3
                                    class="
                                        text-lg
                                        font-bold
                                        text-slate-900
                                        leading-snug
                                    "
                                >
                                    {{ $material->judul }}
                                </h3>



                                {{-- =================================================
                                     CATEGORY
                                ================================================== --}}

                                @if($material->kategori)

                                    <p
                                        class="
                                            text-xs
                                            font-semibold
                                            text-slate-400
                                            mt-2
                                        "
                                    >
                                        {{ $material->kategori }}
                                    </p>

                                @endif



                                {{-- =================================================
                                     MEDIA
                                ================================================== --}}

                                <div
                                    class="
                                        flex
                                        items-center
                                        gap-2
                                        mt-5
                                        flex-wrap
                                    "
                                >

                                    @if($material->gambar)

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                bg-slate-100
                                                text-slate-600
                                                px-2.5
                                                py-1.5
                                                rounded-lg
                                                text-[11px]
                                                font-semibold
                                            "
                                        >

                                            <i
                                                data-lucide="image"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Gambar

                                        </span>

                                    @endif



                                    @if($material->video_url)

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                bg-red-50
                                                text-red-600
                                                px-2.5
                                                py-1.5
                                                rounded-lg
                                                text-[11px]
                                                font-semibold
                                            "
                                        >

                                            <i
                                                data-lucide="play-circle"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Video

                                        </span>

                                    @endif



                                    @if($material->audio_url)

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                bg-purple-50
                                                text-purple-600
                                                px-2.5
                                                py-1.5
                                                rounded-lg
                                                text-[11px]
                                                font-semibold
                                            "
                                        >

                                            <i
                                                data-lucide="volume-2"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Audio

                                        </span>

                                    @endif



                                    @if(
                                        !$material->gambar &&
                                        !$material->video_url &&
                                        !$material->audio_url
                                    )

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-1.5
                                                text-[11px]
                                                text-slate-400
                                            "
                                        >
                                        </span>

                                    @endif

                                </div>



                                {{-- =================================================
                                     ACTION
                                ================================================== --}}

                                <div
                                    class="
                                        flex
                                        items-center
                                        gap-2
                                        mt-6
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
                                            flex-1
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
                                            flex-1
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
                                                'Hapus materi ini?'
                                            )
                                        "
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                w-10
                                                h-10
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
                        shadow-sm
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
                                flex
                                items-center
                                justify-center
                                mb-5
                            "
                        >

                            <i
                                data-lucide="book-open"
                                class="w-7 h-7 text-blue-600"
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
                 FOOTER
            ================================================== --}}

            <div
                class="
                    mt-6
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
                    Materi dapat dikelompokkan berdasarkan
                    pertemuan yang dibuat dan dilengkapi teks,
                    gambar, video, maupun audio.
                </p>

            </div>


        </div>

    </main>



    {{-- =========================================================
         SCRIPT
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

            }
        );

    </script>


</body>

</html>