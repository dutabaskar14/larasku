<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            box-shadow: 0 8px 25px rgba(15, 23, 42, .04);
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
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .08);
        }
    </style>
</head>


<body>

    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="main-content">


        {{-- HEADER --}}

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
                    Edit Quiz
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



        {{-- CONTENT --}}

        <div class="max-w-5xl mx-auto px-5 lg:px-8 py-8">


            {{-- BACK --}}

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
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Quiz
            </a>



            {{-- FORM --}}

            <form
                method="POST"
                action="{{ route('guru.quizzes.update', $quiz) }}"
            >

                @csrf
                @method('PUT')


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

                        <p class="text-sm text-slate-500 mt-2">
                            Ubah informasi quiz, soal, pilihan jawaban,
                            dan kunci jawaban.
                        </p>

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
                            value="{{ old('judul', $quiz->judul) }}"
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
                            <p class="text-xs text-red-600 mt-2">
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
                        >{{ old('deskripsi', $quiz->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <p class="text-xs text-red-600 mt-2">
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
                                Aktif
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
                                Tidak Aktif
                            </option>

                        </select>

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

                        <p class="text-xs text-slate-400 mt-1">
                            Total
                            <strong class="text-slate-700">
                                {{ $quiz->questions->count() }}
                            </strong>
                            soal
                        </p>

                    </div>

                </div>



                {{-- =================================================
                     SOAL
                ================================================== --}}

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
                            mb-4
                        "
                    >

                        {{-- HEADER SOAL --}}

                        <div
                            class="
                                flex
                                items-center
                                gap-3
                                mb-5
                            "
                        >

                            <div
                                class="
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

                                <p class="text-[11px] text-slate-400">
                                    ID #{{ $question->id }}
                                </p>

                            </div>

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
                                <p class="text-xs text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>



                        {{-- PILIHAN --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">


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
                                        <p class="text-xs text-red-600 mt-2">
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
                                "
                            >

                                @foreach(['A', 'B', 'C', 'D'] as $option)

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
                                <p class="text-xs text-red-600 mt-2">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </section>

                @empty

                    <div
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

                    </div>

                @endforelse



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
                        href="{{ route('guru.quizzes.index', [
                            'pertemuan' => $quiz->pertemuan
                        ]) }}"
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



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

</body>
</html>