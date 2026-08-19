<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Buat Quiz — LARASKU</title>

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


        .question-card {
            transition: .2s ease;
        }


        .question-card:hover {
            border-color: #d7dee9;

            box-shadow:
                0 8px 25px
                rgba(15, 23, 42, .04);
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


        .question-card.removing {
            opacity: 0;
            transform: translateY(-8px);
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
                    'pertemuan' => $pertemuan
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
                 ERROR
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
                 JIKA QUIZ SUDAH ADA
            ================================================== --}}

            @if($existingQuiz)

                <section
                    class="
                        mb-6
                        bg-amber-50
                        border
                        border-amber-200
                        rounded-2xl
                        p-5
                    "
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="
                                w-10
                                h-10
                                rounded-xl
                                bg-amber-100
                                text-amber-700
                                flex
                                items-center
                                justify-center
                                shrink-0
                            "
                        >

                            <i
                                data-lucide="triangle-alert"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div>

                            <h3
                                class="
                                    font-bold
                                    text-amber-900
                                "
                            >
                                Quiz Pertemuan
                                {{ $pertemuan }}
                                sudah ada
                            </h3>


                            <p
                                class="
                                    text-sm
                                    text-amber-700
                                    mt-1
                                "
                            >
                                Satu pertemuan hanya memiliki satu Quiz.
                                Silakan edit Quiz yang sudah ada.
                            </p>


                            <a
                                href="{{ route(
                                    'guru.quizzes.edit',
                                    $existingQuiz
                                ) }}"
                                class="
                                    inline-flex
                                    items-center
                                    gap-2
                                    mt-4
                                    px-4
                                    py-2.5
                                    rounded-xl
                                    bg-amber-600
                                    hover:bg-amber-700
                                    text-white
                                    text-xs
                                    font-bold
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

                </section>

            @endif



            {{-- =================================================
                 FORM
            ================================================== --}}

            @if(!$existingQuiz && $pertemuan)


                <form
                    method="POST"
                    action="{{ route('guru.quizzes.store') }}"
                    id="quizForm"
                >

                    @csrf



                    {{-- =================================================
                         INFO QUIZ
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
                                Pertemuan {{ $pertemuan }}
                            </p>


                            <h1
                                class="
                                    text-2xl
                                    lg:text-3xl
                                    font-black
                                    text-slate-900
                                "
                            >
                                Buat Quiz Baru
                            </h1>


                            <p
                                class="
                                    text-sm
                                    text-slate-500
                                    mt-2
                                "
                            >
                                Buat quiz, pertanyaan, pilihan jawaban,
                                dan tentukan kunci jawaban.
                            </p>

                        </div>



                        {{-- PERTEMUAN --}}

                        <div class="mb-5">

                            <label
                                for="pertemuan"
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


                            <select
                                id="pertemuan"
                                name="pertemuan"
                                onchange="
                                    window.location.href =
                                    '{{ route('guru.quizzes.create') }}?pertemuan='
                                    + this.value
                                "
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

                                @foreach($pertemuans as $item)

                                    <option
                                        value="{{ $item }}"
                                        @selected(
                                            (int) $pertemuan ===
                                            (int) $item
                                        )
                                    >
                                        Pertemuan {{ $item }}
                                    </option>

                                @endforeach

                            </select>


                            @error('pertemuan')

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



                        {{-- JUDUL --}}

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
                                value="{{ old('judul') }}"
                                placeholder="Contoh: Quiz Pertemuan 1"
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



                        {{-- DESKRIPSI --}}

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
                                placeholder="Tulis petunjuk atau deskripsi quiz..."
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
                            >{{ old('deskripsi') }}</textarea>


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



                        {{-- STATUS --}}

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
                                    value="0"
                                    @selected(
                                        old(
                                            'aktif',
                                            '0'
                                        ) === '0'
                                    )
                                >
                                    Tidak Aktif — Disembunyikan dari Siswa
                                </option>


                                <option
                                    value="1"
                                    @selected(
                                        old(
                                            'aktif',
                                            '0'
                                        ) === '1'
                                    )
                                >
                                    Aktif — Dapat Diakses Siswa
                                </option>

                            </select>


                            <p
                                class="
                                    text-xs
                                    text-slate-400
                                    mt-2
                                "
                            >
                                Quiz sebaiknya tetap Tidak Aktif sampai
                                semua soal selesai diperiksa.
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
                            items-center
                            justify-between
                            gap-4
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
                                    1
                                </strong>
                                soal
                            </p>

                        </div>


                        <button
                            type="button"
                            id="addQuestion"
                            class="
                                inline-flex
                                items-center
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
                         SOAL CONTAINER
                    ================================================== --}}

                    <div
                        id="questionsContainer"
                        class="space-y-4"
                    >


                        {{-- =================================================
                             SOAL PERTAMA
                        ================================================== --}}

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
                        >

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
                                        1
                                    </div>


                                    <div>

                                        <h3
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            Soal 1
                                        </h3>


                                        <p
                                            class="
                                                text-[11px]
                                                text-slate-400
                                            "
                                        >
                                            Pertanyaan dan pilihan jawaban
                                        </p>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="
                                        remove-question
                                        hidden
                                        w-9
                                        h-9
                                        rounded-xl
                                        bg-red-50
                                        text-red-600
                                        hover:bg-red-100
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
                                    name="questions[0][pertanyaan]"
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
                                >{{ old('questions.0.pertanyaan') }}</textarea>


                                @error('questions.0.pertanyaan')

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
                                            name="questions[0][opsi_{{ $field }}]"
                                            value="{{ old(
                                                'questions.0.opsi_'.$field
                                            ) }}"
                                            placeholder="Pilihan {{ $letter }}"
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
                                            'questions.0.opsi_'.$field
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



                            {{-- KUNCI --}}

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
                                    name="questions[0][jawaban_benar]"
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
                                                    'questions.0.jawaban_benar',
                                                    'A'
                                                ) === $option
                                            )
                                        >
                                            {{ $option }}
                                        </option>

                                    @endforeach

                                </select>


                                @error(
                                    'questions.0.jawaban_benar'
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
                                        $pertemuan
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

                            Simpan Quiz

                        </button>

                    </div>


                </form>


            @elseif(!$pertemuan)


                {{-- =================================================
                     BELUM ADA PERTEMUAN
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
                            data-lucide="calendar-plus"
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
                        Belum Ada Pertemuan Quiz
                    </h3>


                    <p
                        class="
                            text-sm
                            text-slate-400
                            mt-2
                        "
                    >
                        Buat pertemuan Quiz terlebih dahulu
                        pada halaman Quiz.
                    </p>


                    <a
                        href="{{ route('guru.quizzes.index') }}"
                        class="
                            inline-flex
                            items-center
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
                        "
                    >

                        <i
                            data-lucide="clipboard-plus"
                            class="w-4 h-4"
                        ></i>

                        Kelola Pertemuan Quiz

                    </a>

                </section>

            @endif


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


                function updateQuestions()
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


                            /*
                            |--------------------------------------------------------------------------
                            | RENAME INPUT
                            |--------------------------------------------------------------------------
                            */

                            const inputs =
                                card.querySelectorAll(
                                    'input, textarea, select'
                                );


                            inputs.forEach(
                                function (input) {

                                    const field =
                                        input.dataset.field;


                                    if (!field) {
                                        return;
                                    }


                                    input.name =
                                        'questions[' +
                                        index +
                                        '][' +
                                        field +
                                        ']';

                                }
                            );


                            /*
                            |--------------------------------------------------------------------------
                            | TOMBOL HAPUS
                            |--------------------------------------------------------------------------
                            */

                            const removeButton =
                                card.querySelector(
                                    '.remove-question'
                                );


                            if (removeButton) {

                                if (cards.length > 1) {

                                    removeButton.classList.remove(
                                        'hidden'
                                    );

                                    removeButton.classList.add(
                                        'inline-flex'
                                    );

                                } else {

                                    removeButton.classList.add(
                                        'hidden'
                                    );

                                    removeButton.classList.remove(
                                        'inline-flex'
                                    );

                                }

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


                    card.setAttribute(
                        'data-question',
                        ''
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
                                            text-slate-400
                                        "
                                    >
                                        Pertanyaan dan pilihan jawaban
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="
                                    remove-question
                                    inline-flex
                                    w-9
                                    h-9
                                    rounded-xl
                                    bg-red-50
                                    text-red-600
                                    hover:bg-red-100
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

                            ${['a','b','c','d'].map(
                                function(field) {

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


                    updateQuestions();


                    const firstInput =
                        card.querySelector(
                            'textarea'
                        );


                    if (firstInput) {

                        firstInput.focus();

                    }

                }


                addButton.addEventListener(
                    'click',
                    createQuestion
                );


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
                            return;
                        }


                        card.classList.add(
                            'removing'
                        );


                        setTimeout(
                            function () {

                                card.remove();

                                updateQuestions();

                            },
                            180
                        );

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | RESTORE INPUT SETELAH VALIDASI GAGAL
                |--------------------------------------------------------------------------
                */

                const oldQuestions =
                    @json(old('questions', []));


                if (
                    Array.isArray(
                        oldQuestions
                    ) &&
                    oldQuestions.length > 1
                ) {

                    for (
                        let i = 1;
                        i < oldQuestions.length;
                        i++
                    ) {

                        createQuestion();

                    }


                    const cards =
                        container.querySelectorAll(
                            '[data-question]'
                        );


                    cards.forEach(
                        function (card, index) {

                            const data =
                                oldQuestions[index];


                            if (!data) {
                                return;
                            }


                            Object.keys(data)
                                .forEach(
                                    function (field) {

                                        const element =
                                            card.querySelector(
                                                '[data-field="' +
                                                field +
                                                '"]'
                                            );


                                        if (
                                            element &&
                                            data[field] !== undefined
                                        ) {

                                            element.value =
                                                data[field];

                                        }

                                    }
                                );

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | INITIAL UPDATE
                |--------------------------------------------------------------------------
                */

                updateQuestions();

            }

        );

    </script>


</body>

</html>