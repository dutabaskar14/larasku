<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quiz — LARASKU</title>

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


        .meeting {
            transition: .2s ease;
        }


        .meeting:hover {
            transform: translateY(-1px);
        }


        .question-card {
            transition: .2s ease;
        }


        .question-card:hover {
            border-color: #d7dee9;

            box-shadow:
                0 8px 25px
                rgba(15, 23, 42, .04);
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
                        data-lucide="clipboard-check"
                        class="w-3.5 h-3.5"
                    ></i>

                    Panel Guru

                </div>


                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-end
                        md:justify-between
                        gap-5
                    "
                >

                    <div>

                        <h1
                            class="
                                text-3xl
                                lg:text-4xl
                                font-black
                                tracking-tight
                                text-slate-900
                            "
                        >
                            Quiz Pembelajaran
                        </h1>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                max-w-2xl
                            "
                        >
                            Kelola Quiz, soal, kunci jawaban,
                            status Quiz, dan hasil penilaian
                            berdasarkan pertemuan.
                        </p>

                    </div>


                    @if($pertemuan)

                        @if(!$quiz)

                            <a
                                href="{{ route(
                                    'guru.quizzes.create',
                                    [
                                        'pertemuan' => $pertemuan
                                    ]
                                ) }}"
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
                                    text-sm
                                    font-bold
                                    shadow-sm
                                    transition
                                "
                            >

                                <i
                                    data-lucide="plus"
                                    class="w-4 h-4"
                                ></i>

                                Buat Quiz

                            </a>

                        @endif

                    @endif

                </div>

            </section>



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
                        px-4
                        py-3
                        rounded-xl
                        border
                        border-green-200
                        bg-green-50
                        text-green-700
                        text-sm
                        font-semibold
                    "
                >

                    <i
                        data-lucide="circle-check"
                        class="w-5 h-5"
                    ></i>

                    {{ session('success') }}

                </div>

            @endif



            {{-- =================================================
                 ERROR
            ================================================== --}}

            @if($errors->any())

                <div
                    class="
                        mb-5
                        px-4
                        py-3
                        rounded-xl
                        border
                        border-red-200
                        bg-red-50
                        text-red-700
                        text-sm
                    "
                >

                    <div class="font-bold mb-1">
                        Terjadi kesalahan:
                    </div>


                    <ul class="list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif



            {{-- =================================================
                 PILIH PERTEMUAN
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
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-4
                        mb-4
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            gap-2
                        "
                    >

                        <i
                            data-lucide="calendar-days"
                            class="w-4 h-4 text-blue-600"
                        ></i>


                        <span
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-wider
                                text-slate-500
                            "
                        >
                            Pilih Pertemuan
                        </span>

                    </div>


                    {{-- =================================================
                         TAMBAH PERTEMUAN
                    ================================================== --}}

                    <form
                        method="POST"
                        action="{{ route(
                            'guru.quizzes.meetings.store'
                        ) }}"
                        class="
                            flex
                            items-center
                            gap-2
                        "
                    >

                        @csrf

                        <input
                            type="number"
                            name="pertemuan"
                            min="1"
                            max="255"
                            required
                            placeholder="No. pertemuan"
                            class="
                                w-32
                                px-3
                                py-2
                                rounded-xl
                                border
                                border-slate-200
                                bg-slate-50
                                text-xs
                                font-semibold
                                text-slate-700
                                outline-none
                                focus:border-blue-400
                                focus:ring-2
                                focus:ring-blue-100
                            "
                        >

                        <button
                            type="submit"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-1.5
                                px-3.5
                                py-2
                                rounded-xl
                                bg-blue-600
                                hover:bg-blue-700
                                text-white
                                text-xs
                                font-bold
                                transition
                            "
                        >

                            <i
                                data-lucide="plus"
                                class="w-3.5 h-3.5"
                            ></i>

                            Tambah

                        </button>

                    </form>

                </div>


                @if($pertemuans->isNotEmpty())

                    <div
                        class="
                            flex
                            flex-wrap
                            gap-2
                        "
                    >

                        @foreach($pertemuans as $item)

                            @php

                                $meeting =
                                    \App\Models\QuizMeetingAdmin::where(
                                        'pertemuan',
                                        $item
                                    )->first();

                            @endphp


                            <div
                                class="
                                    meeting
                                    inline-flex
                                    items-center
                                    gap-1
                                    rounded-xl
                                    border
                                    overflow-hidden
                                    {{
                                        $pertemuan === (int) $item
                                            ? 'border-slate-900 bg-slate-900'
                                            : 'border-slate-200 bg-white'
                                    }}
                                "
                            >

                                <a
                                    href="{{ route(
                                        'guru.quizzes.index',
                                        [
                                            'pertemuan' => $item
                                        ]
                                    ) }}"
                                    class="
                                        inline-flex
                                        items-center
                                        justify-center
                                        gap-2
                                        px-4
                                        py-2.5
                                        text-xs
                                        font-bold
                                        no-underline
                                        {{
                                            $pertemuan === (int) $item
                                                ? 'text-white'
                                                : 'text-slate-500 hover:text-slate-800'
                                        }}
                                    "
                                >

                                    <i
                                        data-lucide="calendar"
                                        class="w-3.5 h-3.5"
                                    ></i>

                                    Pertemuan {{ $item }}

                                </a>


                                {{-- =================================================
                                     HAPUS PERTEMUAN INI SAJA
                                ================================================== --}}

                                @if($meeting)

                                    <form
                                        method="POST"
                                        action="{{ route(
                                            'guru.quizzes.meetings.destroy',
                                            [
                                                'quizMeetingAdmin' => $meeting
                                            ]
                                        ) }}"
                                        onsubmit="return confirm('Hapus Pertemuan {{ $item }} beserta Quiz dan seluruh soalnya?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="
                                                inline-flex
                                                items-center
                                                justify-center
                                                px-3
                                                py-2.5
                                                {{
                                                    $pertemuan === (int) $item
                                                        ? 'text-red-300 hover:text-red-200'
                                                        : 'text-red-500 hover:text-red-700'
                                                }}
                                                transition
                                            "
                                            title="Hapus Pertemuan {{ $item }}"
                                        >

                                            <i
                                                data-lucide="trash-2"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                        </button>

                                    </form>

                                @endif

                            </div>

                        @endforeach

                    </div>

                @else

                    <div
                        class="
                            rounded-xl
                            border
                            border-amber-200
                            bg-amber-50
                            text-amber-700
                            px-4
                            py-4
                            text-sm
                        "
                    >

                        <div
                            class="
                                flex
                                items-center
                                gap-2
                            "
                        >

                            <i
                                data-lucide="info"
                                class="w-4 h-4"
                            ></i>

                            <span class="font-semibold">
                                Belum ada pertemuan Quiz.
                            </span>

                        </div>


                        <p class="mt-1 text-xs">
                            Tambahkan pertemuan terlebih dahulu
                            menggunakan tombol Tambah di atas.
                        </p>

                    </div>

                @endif

            </section>



            {{-- =================================================
                 QUIZ TERPILIH
            ================================================== --}}

            @if($quiz)


                {{-- =================================================
                     HEADER QUIZ
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-col
                        md:flex-row
                        md:items-center
                        md:justify-between
                        gap-4
                        mb-4
                    "
                >

                    <div>

                        <div
                            class="
                                flex
                                flex-wrap
                                items-center
                                gap-3
                            "
                        >

                            <div
                                class="
                                    text-xl
                                    font-black
                                    text-slate-900
                                "
                            >
                                {{ $quiz->judul }}
                            </div>


                            @if($quiz->aktif)

                                <span
                                    class="
                                        inline-flex
                                        items-center
                                        gap-2
                                        px-3
                                        py-1.5
                                        rounded-xl
                                        bg-green-50
                                        text-green-700
                                        border
                                        border-green-100
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
                                        px-3
                                        py-1.5
                                        rounded-xl
                                        bg-slate-100
                                        text-slate-500
                                        border
                                        border-slate-200
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


                        @if($quiz->deskripsi)

                            <div
                                class="
                                    text-sm
                                    text-slate-500
                                    mt-1
                                "
                            >
                                {{ $quiz->deskripsi }}
                            </div>

                        @endif


                        <div
                            class="
                                flex
                                flex-wrap
                                items-center
                                gap-3
                                mt-2
                                text-xs
                                text-slate-400
                            "
                        >

                            <span
                                class="
                                    flex
                                    items-center
                                    gap-1.5
                                "
                            >

                                <i
                                    data-lucide="calendar"
                                    class="w-3.5 h-3.5"
                                ></i>

                                Pertemuan {{ $pertemuan }}

                            </span>


                            <span
                                class="
                                    flex
                                    items-center
                                    gap-1.5
                                "
                            >

                                <i
                                    data-lucide="file-question"
                                    class="w-3.5 h-3.5"
                                ></i>

                                {{ $quiz->questions_count }}
                                Soal

                            </span>

                        </div>

                    </div>


                    <div
                        class="
                            flex
                            flex-col
                            sm:flex-row
                            gap-2
                        "
                    >

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
                                px-4
                                py-2.5
                                rounded-xl
                                border
                                border-blue-200
                                bg-blue-50
                                text-blue-600
                                hover:bg-blue-100
                                text-xs
                                font-bold
                                transition
                            "
                        >

                            <i
                                data-lucide="bar-chart-3"
                                class="w-4 h-4"
                            ></i>

                            Lihat Hasil

                        </a>


                        <a
                            href="{{ route(
                                'guru.quizzes.edit',
                                $quiz
                            ) }}"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                px-4
                                py-2.5
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
                                data-lucide="pencil"
                                class="w-4 h-4"
                            ></i>

                            Edit Quiz

                        </a>

                    </div>

                </div>



                {{-- =================================================
                     SOAL
                ================================================== --}}

                @if($quiz->questions->count())

                    <div class="space-y-3">

                        @foreach($quiz->questions as $question)

                            <article
                                class="
                                    question-card
                                    bg-white
                                    border
                                    border-slate-200
                                    rounded-2xl
                                    shadow-sm
                                    p-5
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
                                            shrink-0
                                            w-9
                                            h-9
                                            rounded-xl
                                            bg-blue-50
                                            text-blue-600
                                            flex
                                            items-center
                                            justify-center
                                            text-sm
                                            font-black
                                        "
                                    >
                                        {{ $question->urutan }}
                                    </div>


                                    <div class="min-w-0 flex-1">

                                        <div
                                            class="
                                                text-sm
                                                font-bold
                                                leading-relaxed
                                                text-slate-900
                                            "
                                        >
                                            {{ $question->pertanyaan }}
                                        </div>


                                        {{-- =================================================
                                             SEMUA OPSI JAWABAN A - D
                                        ================================================== --}}

                                        <div
                                            class="
                                                grid
                                                grid-cols-1
                                                md:grid-cols-2
                                                gap-2
                                                mt-4
                                            "
                                        >

                                            {{-- OPSI A --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    text-xs
                                                    leading-relaxed
                                                    {{
                                                        $question->jawaban_benar === 'A'
                                                            ? 'border-green-200 bg-green-50 text-green-700 font-bold'
                                                            : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                "
                                            >

                                                <strong>A.</strong>

                                                {{ $question->opsi_a }}

                                            </div>


                                            {{-- OPSI B --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    text-xs
                                                    leading-relaxed
                                                    {{
                                                        $question->jawaban_benar === 'B'
                                                            ? 'border-green-200 bg-green-50 text-green-700 font-bold'
                                                            : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                "
                                            >

                                                <strong>B.</strong>

                                                {{ $question->opsi_b }}

                                            </div>


                                            {{-- OPSI C --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    text-xs
                                                    leading-relaxed
                                                    {{
                                                        $question->jawaban_benar === 'C'
                                                            ? 'border-green-200 bg-green-50 text-green-700 font-bold'
                                                            : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                "
                                            >

                                                <strong>C.</strong>

                                                {{ $question->opsi_c }}

                                            </div>


                                            {{-- OPSI D --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    text-xs
                                                    leading-relaxed
                                                    {{
                                                        $question->jawaban_benar === 'D'
                                                            ? 'border-green-200 bg-green-50 text-green-700 font-bold'
                                                            : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                "
                                            >

                                                <strong>D.</strong>

                                                {{ $question->opsi_d }}

                                            </div>

                                        </div>


                                        {{-- =================================================
                                             KUNCI JAWABAN
                                        ================================================== --}}

                                        <div
                                            class="
                                                flex
                                                items-center
                                                gap-2
                                                mt-4
                                                text-xs
                                                font-bold
                                                text-green-600
                                            "
                                        >

                                            <i
                                                data-lucide="circle-check"
                                                class="w-4 h-4"
                                            ></i>

                                            Kunci jawaban:
                                            {{ $question->jawaban_benar }}

                                        </div>

                                    </div>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @else

                    <section
                        class="
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            shadow-sm
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
                                data-lucide="file-question"
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
                            Belum Ada Soal
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Quiz Pertemuan {{ $pertemuan }}
                            belum memiliki soal.
                        </p>


                        <a
                            href="{{ route(
                                'guru.quizzes.edit',
                                $quiz
                            ) }}"
                            class="
                                inline-flex
                                items-center
                                gap-2
                                mt-5
                                px-4
                                py-2.5
                                rounded-xl
                                bg-slate-900
                                text-white
                                text-xs
                                font-bold
                                hover:bg-slate-800
                            "
                        >

                            <i
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Tambahkan Soal

                        </a>

                    </section>

                @endif


            @else


                {{-- =================================================
                     QUIZ BELUM DIBUAT
                ================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-14
                        text-center
                    "
                >

                    <div
                        class="
                            w-14
                            h-14
                            rounded-2xl
                            bg-blue-50
                            text-blue-600
                            flex
                            items-center
                            justify-center
                            mx-auto
                            mb-4
                        "
                    >

                        <i
                            data-lucide="clipboard-plus"
                            class="w-7 h-7"
                        ></i>

                    </div>


                    @if($pertemuan)

                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Quiz Pertemuan {{ $pertemuan }}
                            Belum Dibuat
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Buat Quiz untuk Pertemuan
                            {{ $pertemuan }}
                            dan tambahkan soal beserta
                            kunci jawabannya.
                        </p>


                        <a
                            href="{{ route(
                                'guru.quizzes.create',
                                [
                                    'pertemuan' => $pertemuan
                                ]
                            ) }}"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                mt-5
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
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Buat Quiz Pertemuan
                            {{ $pertemuan }}

                        </a>

                    @else

                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Belum Ada Pertemuan
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Buat pertemuan Quiz terlebih dahulu
                            menggunakan tombol Tambah Pertemuan
                            di atas.
                        </p>

                    @endif

                </section>

            @endif


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