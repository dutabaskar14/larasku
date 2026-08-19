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

    @php
        $pertemuan = (int) request('pertemuan', 1);

        if ($pertemuan < 1 || $pertemuan > 8) {
            $pertemuan = 1;
        }
    @endphp


    {{-- =========================================================
         SIDEBAR GLOBAL
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
             TOPBAR
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
                    Quiz Pembelajaran
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
                    Kelola soal, kunci jawaban, dan hasil penilaian
                    Quiz berdasarkan pertemuan.
                </p>

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
                        items-center
                        gap-2
                        mb-4
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


                <div
                    class="
                        flex
                        gap-2
                        overflow-x-auto
                        pb-1
                    "
                >

                    @for($i = 1; $i <= 8; $i++)

                        <a
                            href="{{ route('guru.quizzes.index', [
                                'pertemuan' => $i
                            ]) }}"
                            class="
                                meeting
                                shrink-0
                                inline-flex
                                items-center
                                justify-center
                                px-4
                                py-2.5
                                rounded-xl
                                border
                                text-xs
                                font-bold
                                no-underline

                                {{ $pertemuan === $i
                                    ? 'bg-slate-900 border-slate-900 text-white'
                                    : 'bg-white border-slate-200 text-slate-500 hover:border-slate-300 hover:text-slate-800'
                                }}
                            "
                        >
                            Pertemuan {{ $i }}
                        </a>

                    @endfor

                </div>

            </section>



            {{-- =================================================
                 QUIZ TERPILIH
            ================================================== --}}

            @if($quiz)


                {{-- HEADER QUIZ --}}

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
                                text-xl
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $quiz->judul }}
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

                    </div>


                    @if($quiz->aktif)

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-2
                                self-start
                                md:self-auto
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
                                md:self-auto
                                px-3
                                py-2
                                rounded-xl
                                bg-red-50
                                text-red-600
                                text-xs
                                font-bold
                            "
                        >

                            <span
                                class="
                                    w-1.5
                                    h-1.5
                                    rounded-full
                                    bg-red-500
                                "
                            ></span>

                            Tidak Aktif

                        </span>

                    @endif

                </div>



                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        sm:justify-end
                        gap-2
                        mb-5
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

                        Edit Pertemuan

                    </a>

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


                                        <div
                                            class="
                                                grid
                                                grid-cols-1
                                                md:grid-cols-2
                                                gap-2
                                                mt-4
                                            "
                                        >

                                            {{-- A --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    {{ $question->jawaban_benar === 'A'
                                                        ? 'border-green-200 bg-green-50 text-green-700'
                                                        : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                    text-xs
                                                    leading-relaxed
                                                    {{ $question->jawaban_benar === 'A'
                                                        ? 'font-bold'
                                                        : ''
                                                    }}
                                                "
                                            >

                                                <strong>A.</strong>

                                                {{ $question->opsi_a }}

                                            </div>


                                            {{-- B --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    {{ $question->jawaban_benar === 'B'
                                                        ? 'border-green-200 bg-green-50 text-green-700'
                                                        : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                    text-xs
                                                    leading-relaxed
                                                    {{ $question->jawaban_benar === 'B'
                                                        ? 'font-bold'
                                                        : ''
                                                    }}
                                                "
                                            >

                                                <strong>B.</strong>

                                                {{ $question->opsi_b }}

                                            </div>


                                            {{-- C --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    {{ $question->jawaban_benar === 'C'
                                                        ? 'border-green-200 bg-green-50 text-green-700'
                                                        : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                    text-xs
                                                    leading-relaxed
                                                    {{ $question->jawaban_benar === 'C'
                                                        ? 'font-bold'
                                                        : ''
                                                    }}
                                                "
                                            >

                                                <strong>C.</strong>

                                                {{ $question->opsi_c }}

                                            </div>


                                            {{-- D --}}

                                            <div
                                                class="
                                                    p-3
                                                    rounded-xl
                                                    border
                                                    {{ $question->jawaban_benar === 'D'
                                                        ? 'border-green-200 bg-green-50 text-green-700'
                                                        : 'border-slate-100 bg-slate-50 text-slate-500'
                                                    }}
                                                    text-xs
                                                    leading-relaxed
                                                    {{ $question->jawaban_benar === 'D'
                                                        ? 'font-bold'
                                                        : ''
                                                    }}
                                                "
                                            >

                                                <strong>D.</strong>

                                                {{ $question->opsi_d }}

                                            </div>

                                        </div>


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


                    {{-- EMPTY SOAL --}}

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
                            Belum ada soal
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Belum ada soal untuk Pertemuan
                            {{ $pertemuan }}.
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
                     QUIZ TIDAK TERSEDIA
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
                            bg-slate-100
                            flex
                            items-center
                            justify-center
                            mx-auto
                            mb-4
                        "
                    >

                        <i
                            data-lucide="clipboard-x"
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
                        Quiz belum tersedia
                    </h3>


                    <p
                        class="
                            text-sm
                            text-slate-400
                            mt-2
                        "
                    >
                        Quiz untuk Pertemuan
                        {{ $pertemuan }}
                        belum tersedia.
                    </p>

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