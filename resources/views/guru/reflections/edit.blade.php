<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Refleksi — LARASKU</title>

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
            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }

        .question-card:focus-within {
            border-color: #93c5fd;
            box-shadow: 0 10px 30px rgba(37, 99, 235, .08);
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
                max-w-4xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >

            {{-- BACK --}}
            <a
                href="{{ route('guru.reflections.index', [
                    'pertemuan' => $reflection->pertemuan
                ]) }}"
                class="
                    inline-flex
                    items-center
                    gap-2
                    mb-6
                    text-sm
                    font-bold
                    text-slate-500
                    hover:text-blue-600
                    transition
                "
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke Rekap Refleksi

            </a>


            {{-- HEADER --}}
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
                        data-lucide="message-square-edit"
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
                    Edit Refleksi
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Perbarui informasi dan pertanyaan refleksi essay.
                </p>

            </section>


            {{-- ERROR --}}
            @if ($errors->any())

                <div
                    class="
                        mb-5
                        rounded-2xl
                        border
                        border-red-200
                        bg-red-50
                        p-5
                    "
                >

                    <div class="flex items-start gap-3">

                        <i
                            data-lucide="alert-circle"
                            class="w-5 h-5 text-red-600 mt-0.5"
                        ></i>

                        <div>

                            <div
                                class="
                                    text-sm
                                    font-black
                                    text-red-700
                                "
                            >
                                Periksa kembali data
                            </div>

                            <ul
                                class="
                                    mt-2
                                    space-y-1
                                    text-sm
                                    text-red-600
                                "
                            >

                                @foreach ($errors->all() as $error)

                                    <li>
                                        {{ $error }}
                                    </li>

                                @endforeach

                            </ul>

                        </div>

                    </div>

                </div>

            @endif


            {{-- SUCCESS --}}
            @if(session('success'))

                <div
                    class="
                        mb-5
                        rounded-2xl
                        border
                        border-emerald-200
                        bg-emerald-50
                        p-4
                        flex
                        items-center
                        gap-3
                    "
                >

                    <i
                        data-lucide="check-circle"
                        class="w-5 h-5 text-emerald-600"
                    ></i>

                    <div
                        class="
                            text-sm
                            font-bold
                            text-emerald-700
                        "
                    >
                        {{ session('success') }}
                    </div>

                </div>

            @endif


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('guru.reflections.update', $reflection) }}"
                id="reflectionForm"
            >

                @csrf
                @method('PUT')


                {{-- =================================================
                     INFORMASI
                ================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-5
                        lg:p-6
                        mb-5
                    "
                >

                    <div class="mb-6">

                        <div
                            class="
                                text-[11px]
                                font-black
                                uppercase
                                tracking-wider
                                text-blue-600
                                mb-1
                            "
                        >
                            Informasi Refleksi
                        </div>

                        <h2
                            class="
                                text-lg
                                font-black
                                text-slate-900
                            "
                        >
                            Pengaturan Refleksi
                        </h2>

                        <p
                            class="
                                text-xs
                                text-slate-400
                                mt-1
                            "
                        >
                            Pertemuan Refleksi dikelola secara mandiri.
                        </p>

                    </div>


                    <div
                        class="
                            grid
                            grid-cols-1
                            md:grid-cols-2
                            gap-5
                        "
                    >

                        {{-- PERTEMUAN --}}

                        <div>

                            <label
                                for="pertemuan"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Pertemuan
                            </label>


                            <select
                                id="pertemuan"
                                name="pertemuan"
                                required
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                @foreach($pertemuans as $item)

                                    @php
                                        $meetingValue = is_object($item)
                                            ? $item->pertemuan
                                            : $item;
                                    @endphp

                                    <option
                                        value="{{ $meetingValue }}"
                                        @selected(
                                            (int) old(
                                                'pertemuan',
                                                $reflection->pertemuan
                                            ) === (int) $meetingValue
                                        )
                                    >
                                        Pertemuan {{ $meetingValue }}
                                    </option>

                                @endforeach

                            </select>


                            <p
                                class="
                                    mt-2
                                    text-[11px]
                                    text-slate-400
                                "
                            >
                                Pertemuan berasal dari daftar Pertemuan Refleksi.
                            </p>

                        </div>


                        {{-- STATUS --}}

                        <div>

                            <label
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Status Refleksi
                            </label>


                            <label
                                class="
                                    relative
                                    flex
                                    items-center
                                    justify-between
                                    gap-4
                                    min-h-[44px]
                                    px-4
                                    border
                                    border-slate-200
                                    rounded-xl
                                    cursor-pointer
                                    hover:border-blue-300
                                    transition
                                "
                            >

                                <div>

                                    <div
                                        class="
                                            text-sm
                                            font-bold
                                            text-slate-800
                                        "
                                    >
                                        Aktifkan refleksi
                                    </div>

                                    <div
                                        class="
                                            text-[11px]
                                            text-slate-400
                                            mt-0.5
                                        "
                                    >
                                        Siswa dapat mengakses refleksi.
                                    </div>

                                </div>


                                <input
                                    type="checkbox"
                                    name="aktif"
                                    value="1"
                                    class="
                                        w-5
                                        h-5
                                        accent-blue-600
                                        cursor-pointer
                                    "
                                    @checked(
                                        old(
                                            'aktif',
                                            $reflection->aktif
                                        )
                                    )
                                >

                            </label>

                        </div>

                    </div>


                    {{-- JUDUL --}}

                    <div class="mt-5">

                        <label
                            for="judul"
                            class="
                                block
                                text-xs
                                font-bold
                                text-slate-600
                                mb-2
                            "
                        >
                            Judul Refleksi
                        </label>

                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            value="{{ old(
                                'judul',
                                $reflection->judul
                            ) }}"
                            required
                            maxlength="255"
                            placeholder="Contoh: Refleksi Pembelajaran Musik Tradisional"
                            class="
                                w-full
                                h-11
                                px-4
                                border
                                border-slate-200
                                rounded-xl
                                bg-white
                                text-sm
                                text-slate-800
                                outline-none
                                focus:border-blue-400
                                focus:ring-4
                                focus:ring-blue-50
                            "
                        >

                    </div>


                    {{-- DESKRIPSI --}}

                    <div class="mt-5">

                        <label
                            for="deskripsi"
                            class="
                                block
                                text-xs
                                font-bold
                                text-slate-600
                                mb-2
                            "
                        >
                            Deskripsi

                            <span class="font-normal text-slate-400">
                                (opsional)
                            </span>

                        </label>


                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            placeholder="Tuliskan petunjuk atau gambaran refleksi..."
                            class="
                                w-full
                                px-4
                                py-3
                                border
                                border-slate-200
                                rounded-xl
                                bg-white
                                text-sm
                                leading-6
                                text-slate-800
                                outline-none
                                resize-y
                                focus:border-blue-400
                                focus:ring-4
                                focus:ring-blue-50
                            "
                        >{{ old(
                            'deskripsi',
                            $reflection->deskripsi
                        ) }}</textarea>

                    </div>

                </section>


                {{-- =================================================
                     PERTANYAAN
                ================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        overflow-hidden
                    "
                >

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
                            gap-4
                        "
                    >

                        <div>

                            <div
                                class="
                                    text-[11px]
                                    font-black
                                    uppercase
                                    tracking-wider
                                    text-blue-600
                                    mb-1
                                "
                            >
                                Pertanyaan Essay
                            </div>

                            <h2
                                class="
                                    text-lg
                                    font-black
                                    text-slate-900
                                "
                            >
                                Soal Refleksi
                            </h2>

                            <p
                                class="
                                    text-xs
                                    text-slate-400
                                    mt-1
                                "
                            >
                                Edit, tambah, atau hapus pertanyaan.
                            </p>

                        </div>


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
                                font-black
                                transition
                                shadow-sm
                            "
                        >

                            <i
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Tambah Soal

                        </button>

                    </div>


                    <div
                        id="questionsContainer"
                        class="p-5 lg:p-6 space-y-4"
                    >

                        @foreach(
                            $reflection->questions
                            as $index => $question
                        )

                            <div
                                class="
                                    question-card
                                    rounded-2xl
                                    border
                                    border-slate-200
                                    bg-slate-50/70
                                    p-5
                                "
                                data-question
                            >

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-between
                                        gap-3
                                        mb-4
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
                                                w-8
                                                h-8
                                                rounded-xl
                                                bg-blue-600
                                                text-white
                                                flex
                                                items-center
                                                justify-center
                                                text-xs
                                                font-black
                                            "
                                        >
                                            {{ $index + 1 }}
                                        </div>


                                        <div>

                                            <div
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                Pertanyaan
                                            </div>

                                            <div
                                                class="
                                                    text-[11px]
                                                    text-slate-400
                                                "
                                            >
                                                Soal essay refleksi siswa.
                                            </div>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="
                                            remove-question
                                            inline-flex
                                            items-center
                                            justify-center
                                            w-9
                                            h-9
                                            rounded-xl
                                            border
                                            border-red-100
                                            bg-red-50
                                            text-red-500
                                            hover:bg-red-100
                                            transition
                                        "
                                        title="Hapus soal"
                                    >

                                        <i
                                            data-lucide="trash-2"
                                            class="w-4 h-4"
                                        ></i>

                                    </button>

                                </div>


                                <input
                                    type="hidden"
                                    class="question-id"
                                    value="{{ $question->id }}"
                                >


                                <textarea
                                    name="questions[{{ $question->id }}][pertanyaan]"
                                    rows="4"
                                    required
                                    placeholder="Tuliskan pertanyaan refleksi essay..."
                                    class="
                                        w-full
                                        px-4
                                        py-3
                                        border
                                        border-slate-200
                                        rounded-xl
                                        bg-white
                                        text-sm
                                        leading-6
                                        text-slate-800
                                        outline-none
                                        resize-y
                                        focus:border-blue-400
                                        focus:ring-4
                                        focus:ring-blue-50
                                    "
                                >{{ old(
                                    "questions.$question->id.pertanyaan",
                                    $question->pertanyaan
                                ) }}</textarea>

                            </div>

                        @endforeach


                        {{-- OLD INPUT JIKA VALIDASI GAGAL --}}

                        @if(
                            old('questions') &&
                            count($reflection->questions) === 0
                        )

                            @foreach(
                                old('questions')
                                as $index => $question
                            )

                                <div
                                    class="
                                        question-card
                                        rounded-2xl
                                        border
                                        border-slate-200
                                        bg-slate-50/70
                                        p-5
                                    "
                                    data-question
                                >

                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-3
                                            mb-4
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
                                                    w-8
                                                    h-8
                                                    rounded-xl
                                                    bg-blue-600
                                                    text-white
                                                    flex
                                                    items-center
                                                    justify-center
                                                    text-xs
                                                    font-black
                                                "
                                            >
                                                {{ $index + 1 }}
                                            </div>


                                            <div
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                Pertanyaan
                                            </div>

                                        </div>


                                        <button
                                            type="button"
                                            class="
                                                remove-question
                                                inline-flex
                                                items-center
                                                justify-center
                                                w-9
                                                h-9
                                                rounded-xl
                                                border
                                                border-red-100
                                                bg-red-50
                                                text-red-500
                                                hover:bg-red-100
                                            "
                                        >

                                            <i
                                                data-lucide="trash-2"
                                                class="w-4 h-4"
                                            ></i>

                                        </button>

                                    </div>


                                    <textarea
                                        name="questions[{{ $index }}][pertanyaan]"
                                        rows="4"
                                        required
                                        class="
                                            w-full
                                            px-4
                                            py-3
                                            border
                                            border-slate-200
                                            rounded-xl
                                            bg-white
                                            text-sm
                                            leading-6
                                            outline-none
                                            resize-y
                                            focus:border-blue-400
                                            focus:ring-4
                                            focus:ring-blue-50
                                        "
                                    >{{ $question['pertanyaan'] ?? '' }}</textarea>

                                </div>

                            @endforeach

                        @endif

                    </div>


                    {{-- EMPTY --}}

                    <div
                        id="emptyQuestions"
                        class="
                            hidden
                            px-5
                            pb-6
                        "
                    >

                        <div
                            class="
                                rounded-2xl
                                border
                                border-dashed
                                border-slate-300
                                bg-slate-50
                                px-5
                                py-10
                                text-center
                            "
                        >

                            <i
                                data-lucide="file-question"
                                class="
                                    w-8
                                    h-8
                                    mx-auto
                                    text-slate-300
                                "
                            ></i>

                            <div
                                class="
                                    mt-3
                                    text-sm
                                    font-black
                                    text-slate-600
                                "
                            >
                                Belum ada pertanyaan
                            </div>

                            <p
                                class="
                                    mt-1
                                    text-xs
                                    text-slate-400
                                "
                            >
                                Klik "Tambah Soal" untuk membuat pertanyaan.
                            </p>

                        </div>

                    </div>

                </section>


                {{-- ACTION --}}

                <div
                    class="
                        flex
                        flex-col-reverse
                        sm:flex-row
                        sm:justify-end
                        gap-3
                        mt-5
                    "
                >

                    <a
                        href="{{ route('guru.reflections.index', [
                            'pertemuan' => $reflection->pertemuan
                        ]) }}"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-3
                            rounded-xl
                            bg-white
                            border
                            border-slate-200
                            hover:bg-slate-50
                            text-slate-700
                            text-sm
                            font-bold
                            transition
                        "
                    >
                        Batal
                    </a>


                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-6
                            py-3
                            rounded-xl
                            bg-slate-900
                            hover:bg-slate-800
                            text-white
                            text-sm
                            font-black
                            transition
                            shadow-sm
                        "
                    >

                        <i
                            data-lucide="save"
                            class="w-4 h-4"
                        ></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </main>


    {{-- JAVASCRIPT --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                const container =
                    document.getElementById(
                        'questionsContainer'
                    );

                const addButton =
                    document.getElementById(
                        'addQuestion'
                    );

                const emptyMessage =
                    document.getElementById(
                        'emptyQuestions'
                    );

                const form =
                    document.getElementById(
                        'reflectionForm'
                    );


                /*
                |--------------------------------------------------------------------------
                | ICON
                |--------------------------------------------------------------------------
                */

                function refreshIcons() {

                    if (
                        typeof lucide !==
                        'undefined'
                    ) {

                        lucide.createIcons();

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | UPDATE NOMOR & NAME
                |--------------------------------------------------------------------------
                */

                function updateQuestionNames() {

                    const cards =
                        container.querySelectorAll(
                            '[data-question]'
                        );


                    cards.forEach(
                        function (
                            card,
                            index
                        ) {

                            const number =
                                card.querySelector(
                                    '.question-number'
                                );

                            if (number) {

                                number.textContent =
                                    index + 1;

                            }


                            const textarea =
                                card.querySelector(
                                    'textarea'
                                );

                            if (!textarea) {

                                return;

                            }


                            const questionId =
                                card.querySelector(
                                    '.question-id'
                                );


                            if (
                                questionId &&
                                questionId.value
                            ) {

                                textarea.name =
                                    `questions[${questionId.value}][pertanyaan]`;

                            } else {

                                if (
                                    !textarea.dataset.newKey
                                ) {

                                    textarea.dataset.newKey =
                                        'new_' +
                                        Date.now() +
                                        '_' +
                                        index;

                                }


                                textarea.name =
                                    `questions[${textarea.dataset.newKey}][pertanyaan]`;

                            }

                        }
                    );


                    if (
                        cards.length === 0
                    ) {

                        emptyMessage.classList.remove(
                            'hidden'
                        );

                    } else {

                        emptyMessage.classList.add(
                            'hidden'
                        );

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | TAMBAH SOAL
                |--------------------------------------------------------------------------
                */

                addButton.addEventListener(
                    'click',
                    function () {

                        const key =
                            'new_' +
                            Date.now() +
                            '_' +
                            Math.floor(
                                Math.random() * 100000
                            );


                        const card =
                            document.createElement(
                                'div'
                            );


                        card.className =
                            'question-card rounded-2xl border border-slate-200 bg-slate-50/70 p-5';


                        card.setAttribute(
                            'data-question',
                            ''
                        );


                        card.innerHTML = `

                            <div
                                class="
                                    flex
                                    items-center
                                    justify-between
                                    gap-3
                                    mb-4
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
                                            w-8
                                            h-8
                                            rounded-xl
                                            bg-blue-600
                                            text-white
                                            flex
                                            items-center
                                            justify-center
                                            text-xs
                                            font-black
                                        "
                                    >
                                        1
                                    </div>


                                    <div>

                                        <div
                                            class="
                                                text-sm
                                                font-black
                                                text-slate-800
                                            "
                                        >
                                            Pertanyaan
                                        </div>

                                        <div
                                            class="
                                                text-[11px]
                                                text-slate-400
                                            "
                                        >
                                            Soal essay refleksi siswa.
                                        </div>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    class="
                                        remove-question
                                        inline-flex
                                        items-center
                                        justify-center
                                        w-9
                                        h-9
                                        rounded-xl
                                        border
                                        border-red-100
                                        bg-red-50
                                        text-red-500
                                        hover:bg-red-100
                                    "
                                >

                                    <i
                                        data-lucide="trash-2"
                                        class="w-4 h-4"
                                    ></i>

                                </button>

                            </div>


                            <textarea
                                rows="4"
                                required
                                data-new-key="${key}"
                                name="questions[${key}][pertanyaan]"
                                placeholder="Tuliskan pertanyaan refleksi essay..."
                                class="
                                    w-full
                                    px-4
                                    py-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    leading-6
                                    text-slate-800
                                    outline-none
                                    resize-y
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            ></textarea>
                        `;


                        container.appendChild(
                            card
                        );


                        updateQuestionNames();

                        refreshIcons();


                        const textarea =
                            card.querySelector(
                                'textarea'
                            );


                        if (textarea) {

                            textarea.focus();

                        }

                    }
                );


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


                        const questionId =
                            card.querySelector(
                                '.question-id'
                            );


                        if (
                            questionId &&
                            questionId.value
                        ) {

                            const confirmed =
                                confirm(
                                    'Hapus pertanyaan ini dari refleksi?'
                                );


                            if (!confirmed) {

                                return;

                            }

                        }


                        card.remove();

                        updateQuestionNames();

                        refreshIcons();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | VALIDASI
                |--------------------------------------------------------------------------
                */

                form.addEventListener(
                    'submit',
                    function (event) {

                        const meeting =
                            document.getElementById(
                                'pertemuan'
                            );


                        if (
                            !meeting ||
                            !meeting.value
                        ) {

                            event.preventDefault();

                            alert(
                                'Pertemuan refleksi harus dipilih.'
                            );

                            meeting?.focus();

                            return;

                        }


                        const cards =
                            container.querySelectorAll(
                                '[data-question]'
                            );


                        if (
                            cards.length === 0
                        ) {

                            event.preventDefault();

                            alert(
                                'Minimal harus ada 1 pertanyaan refleksi.'
                            );

                            return;

                        }


                        let valid = true;


                        cards.forEach(
                            function (card) {

                                const textarea =
                                    card.querySelector(
                                        'textarea'
                                    );


                                if (
                                    !textarea ||
                                    !textarea.value.trim()
                                ) {

                                    valid = false;

                                    textarea?.focus();

                                }

                            }
                        );


                        if (!valid) {

                            event.preventDefault();

                            alert(
                                'Semua pertanyaan refleksi harus diisi.'
                            );

                            return;

                        }


                        updateQuestionNames();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | INIT
                |--------------------------------------------------------------------------
                */

                updateQuestionNames();

                refreshIcons();

            }
        );

    </script>

</body>

</html>