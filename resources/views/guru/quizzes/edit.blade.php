<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Quiz — LARASKU</title>

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
        }


        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }


        .question-card {
            transition:
                opacity .2s ease,
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .question-card:hover {
            border-color: #d7dee9;

            box-shadow:
                0 8px 25px
                rgba(15, 23, 42, .04);
        }


        .question-card.removing {
            opacity: 0;
            transform: translateY(-8px);
        }


        input,
        textarea,
        select {
            outline: none;
        }


        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2563eb !important;

            box-shadow:
                0 0 0 3px
                rgba(37, 99, 235, .08);
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
                max-w-5xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


            {{-- =================================================
                 BACK
            ================================================== --}}

            <a
                href="{{ route('guru.quizzes.index', [
                    'pertemuan' => $quiz->pertemuan
                ]) }}"
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
                 ERRORS
            ================================================== --}}

            @if($errors->any())

                <div
                    class="
                        mb-5
                        px-4
                        py-4
                        rounded-xl
                        border
                        border-red-200
                        bg-red-50
                        text-red-700
                        text-sm
                    "
                >

                    <div class="font-bold mb-2">
                        Periksa kembali data berikut:
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
                 FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route(
                    'guru.quizzes.update',
                    $quiz
                ) }}"
                id="quizForm"
            >

                @csrf

                @method('PUT')



                {{-- =================================================
                     INFORMASI QUIZ
                ================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-6
                        lg:p-7
                        mb-6
                    "
                >

                    <div class="mb-6">

                        <p
                            class="
                                text-xs
                                font-bold
                                uppercase
                                tracking-widest
                                text-blue-600
                                mb-2
                            "
                        >
                            Pertemuan {{ $quiz->pertemuan }}
                        </p>


                        <h1
                            class="
                                text-2xl
                                lg:text-3xl
                                font-black
                                text-slate-900
                            "
                        >
                            Edit Quiz
                        </h1>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                            "
                        >
                            Ubah informasi Quiz, soal, pilihan jawaban,
                            dan kunci jawaban.
                        </p>

                    </div>



                    {{-- =================================================
                         PERTEMUAN
                    ================================================== --}}

                    <div class="mb-5">

                        <label
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Pertemuan
                        </label>


                        <div
                            class="
                                w-full
                                border
                                border-slate-200
                                bg-slate-50
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                                font-semibold
                                text-slate-600
                            "
                        >

                            Pertemuan {{ $quiz->pertemuan }}

                        </div>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >
                            Pertemuan Quiz berdiri sendiri dan dikelola
                            melalui daftar Pertemuan Quiz.
                        </p>

                    </div>



                    {{-- =================================================
                         JUDUL
                    ================================================== --}}

                    <div class="mb-5">

                        <label
                            for="judul"
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Judul Quiz
                        </label>


                        <input
                            id="judul"
                            type="text"
                            name="judul"
                            value="{{ old(
                                'judul',
                                $quiz->judul
                            ) }}"
                            required
                            class="
                                w-full
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                            "
                        >


                        @error('judul')

                            <p
                                class="
                                    text-xs
                                    text-red-600
                                    mt-2
                                "
                            >
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- =================================================
                         DESKRIPSI
                    ================================================== --}}

                    <div class="mb-5">

                        <label
                            for="deskripsi"
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Deskripsi
                        </label>


                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            class="
                                w-full
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                                resize-y
                            "
                        >{{ old(
                            'deskripsi',
                            $quiz->deskripsi
                        ) }}</textarea>


                        @error('deskripsi')

                            <p
                                class="
                                    text-xs
                                    text-red-600
                                    mt-2
                                "
                            >
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- =================================================
                         STATUS
                    ================================================== --}}

                    <div>

                        <label
                            for="aktif"
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Status Quiz
                        </label>


                        <select
                            id="aktif"
                            name="aktif"
                            class="
                                w-full
                                border
                                border-slate-200
                                rounded-xl
                                px-4
                                py-3
                                text-sm
                                bg-white
                            "
                        >

                            <option
                                value="1"
                                @selected(
                                    old(
                                        'aktif',
                                        $quiz->aktif ? '1' : '0'
                                    ) === '1'
                                )
                            >
                                Aktif — Dapat Diakses Siswa
                            </option>


                            <option
                                value="0"
                                @selected(
                                    old(
                                        'aktif',
                                        $quiz->aktif ? '1' : '0'
                                    ) === '0'
                                )
                            >
                                Tidak Aktif — Disembunyikan dari Siswa
                            </option>

                        </select>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-2
                            "
                        >
                            Quiz yang Tidak Aktif tidak ditampilkan
                            kepada siswa.
                        </p>


                        @error('aktif')

                            <p
                                class="
                                    text-xs
                                    text-red-600
                                    mt-2
                                "
                            >
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </section>



                {{-- =================================================
                     HEADER SOAL
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-3
                        mb-4
                    "
                >

                    <div>

                        <h2
                            class="
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            Daftar Soal
                        </h2>


                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >

                            Total

                            <strong
                                id="questionCount"
                                class="text-slate-700"
                            >
                                {{ $quiz->questions->count() }}
                            </strong>

                            soal

                        </p>

                    </div>


                    {{-- TAMBAH SOAL --}}

                    <button
                        type="button"
                        id="addQuestion"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-4
                            py-2.5
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
                            class="w-4 h-4"
                        ></i>

                        Tambah Soal

                    </button>

                </div>



                {{-- =================================================
                     QUESTIONS CONTAINER
                ================================================== --}}

                <div
                    id="questionsContainer"
                    class="space-y-4"
                >

                    @forelse($quiz->questions as $question)

                        <section
                            class="
                                question-card
                                bg-white
                                border
                                border-slate-200
                                rounded-2xl
                                shadow-sm
                                p-5
                                lg:p-6
                            "
                            data-question
                            data-existing="1"
                            data-id="{{ $question->id }}"
                        >

                            {{-- HEADER SOAL --}}

                            <div
                                class="
                                    flex
                                    items-center
                                    justify-between
                                    gap-3
                                    mb-5
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
                                            question-number
                                            w-9
                                            h-9
                                            rounded-xl
                                            bg-blue-50
                                            text-blue-600
                                            flex
                                            items-center
                                            justify-center
                                            font-black
                                            text-sm
                                        "
                                    >
                                        {{ $question->urutan }}
                                    </div>


                                    <div>

                                        <h3
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            Soal {{ $question->urutan }}
                                        </h3>


                                        <p
                                            class="
                                                text-[11px]
                                                text-slate-400
                                            "
                                        >
                                            ID #{{ $question->id }}
                                        </p>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="
                                        remove-question
                                        w-9
                                        h-9
                                        rounded-xl
                                        bg-red-50
                                        text-red-600
                                        hover:bg-red-100
                                        inline-flex
                                        items-center
                                        justify-center
                                    "
                                    title="Hapus soal"
                                >

                                    <i
                                        data-lucide="trash-2"
                                        class="w-4 h-4"
                                    ></i>

                                </button>

                            </div>



                            {{-- PERTANYAAN --}}

                            <div class="mb-5">

                                <label
                                    class="
                                        block
                                        text-xs
                                        font-bold
                                        text-slate-700
                                        mb-2
                                    "
                                >
                                    Pertanyaan
                                </label>


                                <textarea
                                    data-field="pertanyaan"
                                    name="questions[{{ $question->id }}][pertanyaan]"
                                    rows="4"
                                    required
                                    class="
                                        w-full
                                        border
                                        border-slate-200
                                        rounded-xl
                                        px-4
                                        py-3
                                        text-sm
                                        resize-y
                                    "
                                >{{ old(
                                    "questions.{$question->id}.pertanyaan",
                                    $question->pertanyaan
                                ) }}</textarea>


                                @error(
                                    "questions.{$question->id}.pertanyaan"
                                )

                                    <p
                                        class="
                                            text-xs
                                            text-red-600
                                            mt-2
                                        "
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>



                            {{-- PILIHAN --}}

                            <div
                                class="
                                    grid
                                    grid-cols-1
                                    md:grid-cols-2
                                    gap-4
                                "
                            >

                                @foreach([
                                    'a' => 'A',
                                    'b' => 'B',
                                    'c' => 'C',
                                    'd' => 'D',
                                ] as $field => $letter)

                                    <div>

                                        <label
                                            class="
                                                flex
                                                items-center
                                                gap-2
                                                text-xs
                                                font-bold
                                                text-slate-600
                                                mb-2
                                            "
                                        >

                                            <span
                                                class="
                                                    w-6
                                                    h-6
                                                    rounded-lg
                                                    bg-slate-100
                                                    flex
                                                    items-center
                                                    justify-center
                                                    text-[10px]
                                                    font-black
                                                "
                                            >
                                                {{ $letter }}
                                            </span>

                                            Pilihan {{ $letter }}

                                        </label>


                                        <input
                                            type="text"
                                            data-field="opsi_{{ $field }}"
                                            name="questions[{{ $question->id }}][opsi_{{ $field }}]"
                                            value="{{ old(
                                                "questions.{$question->id}.opsi_{$field}",
                                                $question->{'opsi_'.$field}
                                            ) }}"
                                            required
                                            class="
                                                w-full
                                                border
                                                border-slate-200
                                                rounded-xl
                                                px-4
                                                py-3
                                                text-sm
                                            "
                                        >


                                        @error(
                                            "questions.{$question->id}.opsi_{$field}"
                                        )

                                            <p
                                                class="
                                                    text-xs
                                                    text-red-600
                                                    mt-2
                                                "
                                            >
                                                {{ $message }}
                                            </p>

                                        @enderror

                                    </div>

                                @endforeach

                            </div>



                            {{-- KUNCI JAWABAN --}}

                            <div
                                class="
                                    mt-6
                                    pt-5
                                    border-t
                                    border-slate-100
                                "
                            >

                                <div
                                    class="
                                        flex
                                        flex-col
                                        sm:flex-row
                                        sm:items-center
                                        sm:justify-between
                                        gap-2
                                        mb-2
                                    "
                                >

                                    <label
                                        class="
                                            text-xs
                                            font-bold
                                            text-slate-700
                                        "
                                    >
                                        Kunci Jawaban
                                    </label>


                                    <span
                                        class="
                                            text-[11px]
                                            text-slate-400
                                        "
                                    >
                                        Digunakan untuk penilaian otomatis
                                    </span>

                                </div>


                                <select
                                    data-field="jawaban_benar"
                                    name="questions[{{ $question->id }}][jawaban_benar]"
                                    required
                                    class="
                                        w-full
                                        border
                                        border-slate-200
                                        rounded-xl
                                        px-4
                                        py-3
                                        text-sm
                                        bg-white
                                    "
                                >

                                    @foreach([
                                        'A',
                                        'B',
                                        'C',
                                        'D'
                                    ] as $option)

                                        <option
                                            value="{{ $option }}"
                                            @selected(
                                                old(
                                                    "questions.{$question->id}.jawaban_benar",
                                                    $question->jawaban_benar
                                                ) === $option
                                            )
                                        >
                                            {{ $option }}
                                        </option>

                                    @endforeach

                                </select>


                                @error(
                                    "questions.{$question->id}.jawaban_benar"
                                )

                                    <p
                                        class="
                                            text-xs
                                            text-red-600
                                            mt-2
                                        "
                                    >
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </section>


                    @empty


                        {{-- EMPTY --}}

                        <section
                            id="emptyQuestions"
                            class="
                                bg-white
                                border
                                border-slate-200
                                rounded-2xl
                                p-12
                                text-center
                            "
                        >

                            <div
                                class="
                                    w-12
                                    h-12
                                    rounded-xl
                                    bg-slate-100
                                    flex
                                    items-center
                                    justify-center
                                    mx-auto
                                    mb-3
                                "
                            >

                                <i
                                    data-lucide="help-circle"
                                    class="w-5 h-5 text-slate-400"
                                ></i>

                            </div>


                            <p
                                class="
                                    text-sm
                                    font-bold
                                    text-slate-600
                                "
                            >
                                Belum ada soal
                            </p>


                            <p
                                class="
                                    text-xs
                                    text-slate-400
                                    mt-1
                                "
                            >
                                Klik Tambah Soal untuk membuat soal pertama.
                            </p>

                        </section>

                    @endforelse

                </div>



                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div
                    class="
                        flex
                        flex-col-reverse
                        sm:flex-row
                        items-center
                        justify-between
                        gap-3
                        mt-6
                        pt-5
                        border-t
                        border-slate-200
                    "
                >

                    <a
                        href="{{ route(
                            'guru.quizzes.index',
                            [
                                'pertemuan' =>
                                    $quiz->pertemuan
                            ]
                        ) }}"
                        class="
                            w-full
                            sm:w-auto
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
                            text-slate-600
                            text-sm
                            font-bold
                            hover:bg-slate-50
                        "
                    >

                        <i
                            data-lucide="arrow-left"
                            class="w-4 h-4"
                        ></i>

                        Batal

                    </a>


                    <button
                        type="submit"
                        class="
                            w-full
                            sm:w-auto
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-6
                            py-3
                            rounded-xl
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            text-sm
                            font-bold
                            shadow-sm
                        "
                    >

                        <i
                            data-lucide="save"
                            class="w-4 h-4"
                        ></i>

                        Simpan Semua Perubahan

                    </button>

                </div>

            </form>

        </div>

    </main>



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


                const container =
                    document.getElementById(
                        'questionsContainer'
                    );


                const addButton =
                    document.getElementById(
                        'addQuestion'
                    );


                const countElement =
                    document.getElementById(
                        'questionCount'
                    );


                if (
                    !container ||
                    !addButton
                ) {

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE NOMOR
                |--------------------------------------------------------------------------
                */

                function updateNumbers()
                {

                    const cards =
                        container.querySelectorAll(
                            '[data-question]'
                        );


                    cards.forEach(
                        function (card, index) {

                            const number =
                                index + 1;


                            const numberElement =
                                card.querySelector(
                                    '.question-number'
                                );


                            const titleElement =
                                card.querySelector(
                                    'h3'
                                );


                            if (numberElement) {

                                numberElement.textContent =
                                    number;

                            }


                            if (titleElement) {

                                titleElement.textContent =
                                    'Soal ' + number;

                            }

                        }
                    );


                    if (countElement) {

                        countElement.textContent =
                            cards.length;

                    }


                    if (
                        typeof lucide !== 'undefined'
                    ) {

                        lucide.createIcons();

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | CREATE SOAL BARU
                |--------------------------------------------------------------------------
                */

                function createQuestion()
                {

                    const index =
                        container.querySelectorAll(
                            '[data-question]'
                        ).length;


                    const card =
                        document.createElement(
                            'section'
                        );


                    card.className =
                        `
                        question-card
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-5
                        lg:p-6
                    `;


                    card.setAttribute(
                        'data-question',
                        ''
                    );


                    card.setAttribute(
                        'data-existing',
                        '0'
                    );


                    card.setAttribute(
                        'data-id',
                        ''
                    );


                    card.innerHTML = `

                        <div
                            class="
                                flex
                                items-center
                                justify-between
                                gap-3
                                mb-5
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
                                        question-number
                                        w-9
                                        h-9
                                        rounded-xl
                                        bg-blue-50
                                        text-blue-600
                                        flex
                                        items-center
                                        justify-center
                                        font-black
                                        text-sm
                                    "
                                >
                                    ${index + 1}
                                </div>


                                <div>

                                    <h3
                                        class="
                                            text-sm
                                            font-black
                                            text-slate-900
                                        "
                                    >
                                        Soal ${index + 1}
                                    </h3>


                                    <p
                                        class="
                                            text-[11px]
                                            text-blue-500
                                        "
                                    >
                                        Soal baru
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="
                                    remove-question
                                    w-9
                                    h-9
                                    rounded-xl
                                    bg-red-50
                                    text-red-600
                                    hover:bg-red-100
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                title="Hapus soal"
                            >

                                <i
                                    data-lucide="trash-2"
                                    class="w-4 h-4"
                                ></i>

                            </button>

                        </div>


                        <div class="mb-5">

                            <label
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-700
                                    mb-2
                                "
                            >
                                Pertanyaan
                            </label>


                            <textarea
                                data-field="pertanyaan"
                                rows="4"
                                required
                                placeholder="Tulis pertanyaan quiz..."
                                class="
                                    w-full
                                    border
                                    border-slate-200
                                    rounded-xl
                                    px-4
                                    py-3
                                    text-sm
                                    resize-y
                                "
                            ></textarea>

                        </div>


                        <div
                            class="
                                grid
                                grid-cols-1
                                md:grid-cols-2
                                gap-4
                            "
                        >

                            ${['a', 'b', 'c', 'd'].map(
                                function (field) {

                                    const letter =
                                        field.toUpperCase();

                                    return `

                                        <div>

                                            <label
                                                class="
                                                    flex
                                                    items-center
                                                    gap-2
                                                    text-xs
                                                    font-bold
                                                    text-slate-600
                                                    mb-2
                                                "
                                            >

                                                <span
                                                    class="
                                                        w-6
                                                        h-6
                                                        rounded-lg
                                                        bg-slate-100
                                                        flex
                                                        items-center
                                                        justify-center
                                                        text-[10px]
                                                        font-black
                                                    "
                                                >
                                                    ${letter}
                                                </span>

                                                Pilihan ${letter}

                                            </label>


                                            <input
                                                type="text"
                                                data-field="opsi_${field}"
                                                placeholder="Pilihan ${letter}"
                                                required
                                                class="
                                                    w-full
                                                    border
                                                    border-slate-200
                                                    rounded-xl
                                                    px-4
                                                    py-3
                                                    text-sm
                                                "
                                            >

                                        </div>

                                    `;

                                }
                            ).join('')}

                        </div>


                        <div
                            class="
                                mt-6
                                pt-5
                                border-t
                                border-slate-100
                            "
                        >

                            <div
                                class="
                                    flex
                                    flex-col
                                    sm:flex-row
                                    sm:items-center
                                    sm:justify-between
                                    gap-2
                                    mb-2
                                "
                            >

                                <label
                                    class="
                                        text-xs
                                        font-bold
                                        text-slate-700
                                    "
                                >
                                    Kunci Jawaban
                                </label>


                                <span
                                    class="
                                        text-[11px]
                                        text-slate-400
                                    "
                                >
                                    Digunakan untuk penilaian otomatis
                                </span>

                            </div>


                            <select
                                data-field="jawaban_benar"
                                required
                                class="
                                    w-full
                                    border
                                    border-slate-200
                                    rounded-xl
                                    px-4
                                    py-3
                                    text-sm
                                    bg-white
                                "
                            >

                                <option value="A">
                                    A
                                </option>

                                <option value="B">
                                    B
                                </option>

                                <option value="C">
                                    C
                                </option>

                                <option value="D">
                                    D
                                </option>

                            </select>

                        </div>

                    `;


                    container.appendChild(
                        card
                    );


                    assignNewQuestionNames();


                    updateNumbers();


                    if (
                        typeof lucide !== 'undefined'
                    ) {

                        lucide.createIcons();

                    }


                    const textarea =
                        card.querySelector(
                            'textarea'
                        );


                    if (textarea) {

                        textarea.focus();

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | NAMA INPUT SOAL BARU
                |--------------------------------------------------------------------------
                */

                function assignNewQuestionNames()
                {

                    const cards =
                        container.querySelectorAll(
                            '[data-question]'
                        );


                    cards.forEach(
                        function (card, index) {

                            const isExisting =
                                card.dataset.existing === '1';


                            if (isExisting) {

                                return;

                            }


                            const fields =
                                card.querySelectorAll(
                                    '[data-field]'
                                );


                            fields.forEach(
                                function (field) {

                                    const name =
                                        field.dataset.field;


                                    field.name =
                                        'questions[new_' +
                                        index +
                                        '][' +
                                        name +
                                        ']';

                                }
                            );

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | HAPUS SOAL
                |--------------------------------------------------------------------------
                */

                container.addEventListener(
                    'click',
                    function (event) {

                        const button =
                            event.target.closest(
                                '.remove-question'
                            );


                        if (!button) {

                            return;

                        }


                        const card =
                            button.closest(
                                '[data-question]'
                            );


                        if (!card) {

                            return;

                        }


                        const cards =
                            container.querySelectorAll(
                                '[data-question]'
                            );


                        if (cards.length <= 1) {

                            alert(
                                'Quiz harus memiliki minimal 1 soal.'
                            );

                            return;

                        }


                        card.classList.add(
                            'removing'
                        );


                        setTimeout(
                            function () {

                                card.remove();

                                assignNewQuestionNames();

                                updateNumbers();

                            },
                            180
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | TAMBAH SOAL
                |--------------------------------------------------------------------------
                */

                addButton.addEventListener(
                    'click',
                    function () {

                        createQuestion();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | INITIAL
                |--------------------------------------------------------------------------
                */

                updateNumbers();

                assignNewQuestionNames();

            }
        );

    </script>


</body>

</html>