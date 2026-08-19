<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit LKPD — LARASKU</title>

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

        .main-content {
            min-height: 100vh;
        }

        .question-card {
            transition: .18s ease;
        }

        .question-card:hover {
            border-color: #cbd5e1;
        }

        .input {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            color: #0f172a;
            font-size: 14px;
            outline: none;
            transition: .18s ease;
        }

        .input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px #dbeafe;
        }

        textarea.input {
            min-height: 110px;
            resize: vertical;
        }

        select.input {
            cursor: pointer;
        }

        .option-input {
            width: 100%;
            height: 42px;
            padding: 0 12px;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            background: #fff;
            font-size: 13px;
            outline: none;
        }

        .option-input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px #ede9fe;
        }

        .radio-card {
            cursor: pointer;
            transition: .18s ease;
        }

        .radio-card:hover {
            border-color: #93c5fd;
            background: #f8fbff;
        }

        .radio-card.active-pg {
            border-color: #c4b5fd;
            background: #faf5ff;
        }

        .radio-card.active-essay {
            border-color: #fcd34d;
            background: #fffbeb;
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

    @include('guru.partials.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main
        class="main-content lg:ml-64 transition-all duration-300"
    >


        {{-- =====================================================
             HEADBAR GURU
        ====================================================== --}}

        @include('guru.partials.header')


        <div
            class="p-5 lg:p-8 max-w-[1200px] mx-auto"
        >

            {{-- BACK --}}
            <a
                href="{{ route('guru.lkpd.index') }}"
                class="inline-flex items-center gap-2
                       mb-6 text-sm font-semibold
                       text-slate-500 hover:text-slate-900"
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke LKPD

            </a>


            {{-- HEADER --}}
            <section class="mb-7">

                <div class="mb-2">

                    <span
                        class="inline-flex items-center gap-2
                               text-xs font-semibold text-blue-600
                               bg-blue-50 px-3 py-1.5 rounded-full"
                    >

                        <i
                            data-lucide="pencil"
                            class="w-3.5 h-3.5"
                        ></i>

                        Edit LKPD

                    </span>

                </div>


                <h1
                    class="text-3xl font-black
                           tracking-tight text-slate-900"
                >
                    Edit LKPD
                </h1>


                <p class="text-sm text-slate-500 mt-2">
                    Perbarui pertemuan, informasi, dan soal LKPD.
                </p>

            </section>


            {{-- ERROR --}}
            @if($errors->any())

                <div
                    class="mb-6 p-5 rounded-2xl
                           border border-red-200
                           bg-red-50 text-red-700"
                >

                    <div
                        class="flex items-center gap-2
                               font-bold text-sm mb-2"
                    >

                        <i
                            data-lucide="circle-alert"
                            class="w-4 h-4"
                        ></i>

                        Periksa kembali data LKPD

                    </div>


                    <ul
                        class="list-disc pl-5 text-sm
                               space-y-1"
                    >

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- FORM --}}
            <form
                action="{{ route('guru.lkpd.update', $lkpd) }}"
                method="POST"
                id="lkpdForm"
            >

                @csrf
                @method('PUT')


                {{-- INFORMASI --}}
                <section
                    class="bg-white border border-slate-200
                           rounded-2xl shadow-sm overflow-hidden
                           mb-6"
                >

                    <div
                        class="px-6 py-5 border-b
                               border-slate-100"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="w-10 h-10 rounded-xl
                                       bg-blue-50 text-blue-600
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    data-lucide="file-text"
                                    class="w-5 h-5"
                                ></i>

                            </div>


                            <div>

                                <h2 class="font-black text-slate-900">
                                    Informasi LKPD
                                </h2>

                                <p class="text-xs text-slate-400 mt-1">
                                    Ubah identitas dan status LKPD.
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="p-6 space-y-5">

                        {{-- PERTEMUAN --}}
                        <div>

                            <label
                                for="pertemuan"
                                class="block text-xs font-bold
                                       text-slate-600 mb-2"
                            >
                                Pertemuan
                            </label>


                            <select
                                name="pertemuan"
                                id="pertemuan"
                                required
                                class="input"
                            >

                                @foreach($pertemuans ?? [] as $item)

                                    <option
                                        value="{{ $item }}"
                                        {{ old('pertemuan', $lkpd->pertemuan) == $item ? 'selected' : '' }}
                                    >
                                        Pertemuan {{ $item }}
                                    </option>

                                @endforeach

                                {{-- Pastikan pertemuan lama tetap tersedia --}}
                                @if(
                                    !collect($pertemuans ?? [])
                                        ->contains((int) $lkpd->pertemuan)
                                )

                                    <option
                                        value="{{ $lkpd->pertemuan }}"
                                        selected
                                    >
                                        Pertemuan {{ $lkpd->pertemuan }}
                                    </option>

                                @endif

                            </select>

                            <p class="mt-2 text-xs text-slate-400">
                                LKPD berdiri sendiri berdasarkan pertemuan.
                            </p>

                        </div>


                        {{-- JUDUL --}}
                        <div>

                            <label
                                for="judul"
                                class="block text-xs font-bold
                                       text-slate-600 mb-2"
                            >
                                Judul LKPD
                            </label>

                            <input
                                type="text"
                                name="judul"
                                id="judul"
                                required
                                value="{{ old('judul', $lkpd->judul) }}"
                                class="input"
                                placeholder="Contoh: LKPD Analisis Musik Tradisional"
                            >

                        </div>


                        {{-- DESKRIPSI --}}
                        <div>

                            <label
                                for="deskripsi"
                                class="block text-xs font-bold
                                       text-slate-600 mb-2"
                            >
                                Deskripsi / Petunjuk
                            </label>

                            <textarea
                                name="deskripsi"
                                id="deskripsi"
                                class="input"
                                placeholder="Tuliskan petunjuk pengerjaan LKPD..."
                            >{{ old('deskripsi', $lkpd->deskripsi) }}</textarea>

                        </div>


                        {{-- AKTIF --}}
                        <div
                            class="flex items-center
                                   justify-between gap-4
                                   p-4 rounded-xl
                                   border border-slate-200
                                   bg-slate-50"
                        >

                            <div>

                                <div
                                    class="text-sm font-bold
                                           text-slate-800"
                                >
                                    Aktifkan untuk siswa
                                </div>

                                <div
                                    class="text-xs
                                           text-slate-400 mt-1"
                                >
                                    Jika aktif, LKPD dapat dikerjakan siswa.
                                </div>

                            </div>


                            <label
                                class="relative inline-flex
                                       items-center cursor-pointer"
                            >

                                <input
                                    type="checkbox"
                                    name="aktif"
                                    value="1"
                                    class="sr-only peer"
                                    {{ old('aktif', $lkpd->aktif) ? 'checked' : '' }}
                                >

                                <div
                                    class="w-11 h-6
                                           bg-slate-300
                                           peer-focus:outline-none
                                           rounded-full peer
                                           peer-checked:bg-blue-600
                                           after:content-['']
                                           after:absolute
                                           after:top-[2px]
                                           after:left-[2px]
                                           after:bg-white
                                           after:border-gray-300
                                           after:border
                                           after:rounded-full
                                           after:h-5 after:w-5
                                           after:transition-all
                                           peer-checked:after:translate-x-full"
                                ></div>

                            </label>

                        </div>

                    </div>

                </section>


                {{-- SOAL --}}
                <section
                    class="bg-white border border-slate-200
                           rounded-2xl shadow-sm overflow-hidden
                           mb-6"
                >

                    <div
                        class="px-6 py-5 border-b
                               border-slate-100"
                    >

                        <div
                            class="flex flex-col
                                   sm:flex-row
                                   sm:items-center
                                   sm:justify-between
                                   gap-4"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl
                                           bg-violet-50
                                           text-violet-600
                                           flex items-center
                                           justify-center"
                                >

                                    <i
                                        data-lucide="list-checks"
                                        class="w-5 h-5"
                                    ></i>

                                </div>


                                <div>

                                    <h2 class="font-black text-slate-900">
                                        Soal LKPD
                                    </h2>

                                    <p class="text-xs text-slate-400 mt-1">
                                        Edit, tambah, atau hapus soal.
                                    </p>

                                </div>

                            </div>


                            <button
                                type="button"
                                id="addQuestionBtn"
                                class="inline-flex items-center
                                       justify-center gap-2
                                       px-4 py-2.5 rounded-xl
                                       bg-slate-900
                                       hover:bg-slate-800
                                       text-white text-sm font-bold"
                            >

                                <i
                                    data-lucide="plus"
                                    class="w-4 h-4"
                                ></i>

                                Tambah Soal

                            </button>

                        </div>

                    </div>


                    <div
                        id="questionsContainer"
                        class="p-6 space-y-5"
                    >

                        @foreach($lkpd->questions as $index => $question)

                            @php
                                $jenis = $question->jenis;
                            @endphp

                            <div
                                class="question-card border border-slate-200
                                       rounded-2xl overflow-hidden
                                       bg-white"
                            >

                                <input
                                    type="hidden"
                                    name="questions[{{ $index }}][id]"
                                    value="{{ $question->id }}"
                                >


                                <div
                                    class="px-5 py-4 bg-slate-50
                                           border-b border-slate-200
                                           flex items-center
                                           justify-between gap-3"
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="question-number
                                                   w-9 h-9 rounded-xl
                                                   bg-slate-900
                                                   text-white
                                                   flex items-center
                                                   justify-center
                                                   text-xs font-black"
                                        >
                                            {{ $index + 1 }}
                                        </div>


                                        <div>

                                            <div
                                                class="font-black
                                                       text-slate-900"
                                            >
                                                Soal {{ $index + 1 }}
                                            </div>

                                            <div
                                                class="text-xs
                                                       text-slate-400"
                                            >
                                                {{ $jenis === 'pilihan_ganda'
                                                    ? 'Pilihan Ganda'
                                                    : 'Essay' }}
                                            </div>

                                        </div>

                                    </div>


                                    <button
                                        type="button"
                                        class="remove-question
                                               w-9 h-9 rounded-xl
                                               bg-white
                                               border border-slate-200
                                               text-slate-400
                                               hover:text-red-600
                                               hover:border-red-200
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            data-lucide="trash-2"
                                            class="w-4 h-4"
                                        ></i>

                                    </button>

                                </div>


                                <div class="p-5">

                                    {{-- JENIS --}}
                                    <div
                                        class="grid grid-cols-1
                                               sm:grid-cols-2 gap-3 mb-5"
                                    >

                                        <label
                                            class="radio-card type-pg
                                                   {{ $jenis === 'pilihan_ganda'
                                                       ? 'active-pg'
                                                       : '' }}
                                                   border border-slate-200
                                                   rounded-xl p-4"
                                        >

                                            <input
                                                type="radio"
                                                name="questions[{{ $index }}][jenis]"
                                                value="pilihan_ganda"
                                                class="sr-only type-radio"
                                                {{ $jenis === 'pilihan_ganda' ? 'checked' : '' }}
                                            >

                                            <div class="flex items-start gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-violet-50
                                                           text-violet-600
                                                           flex items-center
                                                           justify-center"
                                                >

                                                    <i
                                                        data-lucide="list-checks"
                                                        class="w-4 h-4"
                                                    ></i>

                                                </div>


                                                <div>

                                                    <div
                                                        class="text-sm font-black
                                                               text-slate-800"
                                                    >
                                                        Pilihan Ganda
                                                    </div>

                                                    <div
                                                        class="text-xs
                                                               text-slate-400 mt-1"
                                                    >
                                                        Nilai otomatis
                                                    </div>

                                                </div>

                                            </div>

                                        </label>


                                        <label
                                            class="radio-card type-essay
                                                   {{ $jenis === 'essay'
                                                       ? 'active-essay'
                                                       : '' }}
                                                   border border-slate-200
                                                   rounded-xl p-4"
                                        >

                                            <input
                                                type="radio"
                                                name="questions[{{ $index }}][jenis]"
                                                value="essay"
                                                class="sr-only type-radio"
                                                {{ $jenis === 'essay' ? 'checked' : '' }}
                                            >

                                            <div class="flex items-start gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-lg
                                                           bg-amber-50
                                                           text-amber-600
                                                           flex items-center
                                                           justify-center"
                                                >

                                                    <i
                                                        data-lucide="file-pen-line"
                                                        class="w-4 h-4"
                                                    ></i>

                                                </div>


                                                <div>

                                                    <div
                                                        class="text-sm font-black
                                                               text-slate-800"
                                                    >
                                                        Essay
                                                    </div>

                                                    <div
                                                        class="text-xs
                                                               text-slate-400 mt-1"
                                                    >
                                                        Dinilai manual guru
                                                    </div>

                                                </div>

                                            </div>

                                        </label>

                                    </div>


                                    {{-- PERTANYAAN --}}
                                    <div>

                                        <label
                                            class="block text-xs
                                                   font-bold text-slate-600
                                                   mb-2"
                                        >
                                            Pertanyaan
                                        </label>

                                        <textarea
                                            name="questions[{{ $index }}][pertanyaan]"
                                            required
                                            class="input"
                                            placeholder="Tuliskan pertanyaan..."
                                        >{{ old(
                                            "questions.$index.pertanyaan",
                                            $question->pertanyaan
                                        ) }}</textarea>

                                    </div>


                                    {{-- PG --}}
                                    <div
                                        class="pg-fields mt-5
                                               {{ $jenis === 'essay'
                                                   ? 'hidden'
                                                   : '' }}"
                                    >

                                        <div class="mb-3">

                                            <div
                                                class="text-sm font-black
                                                       text-slate-800"
                                            >
                                                Pilihan Jawaban
                                            </div>

                                            <div
                                                class="text-xs text-slate-400 mt-1"
                                            >
                                                Tentukan satu jawaban yang benar.
                                            </div>

                                        </div>


                                        <div
                                            class="grid grid-cols-1
                                                   md:grid-cols-2 gap-3"
                                        >

                                            @foreach(['a','b','c','d'] as $letter)

                                                <div
                                                    class="flex items-center gap-2"
                                                >

                                                    <div
                                                        class="w-9 h-[42px]
                                                               rounded-lg
                                                               bg-slate-100
                                                               text-slate-600
                                                               flex items-center
                                                               justify-center
                                                               text-xs font-black
                                                               flex-shrink-0"
                                                    >
                                                        {{ strtoupper($letter) }}
                                                    </div>


                                                    <input
                                                        type="text"
                                                        name="questions[{{ $index }}][opsi_{{ $letter }}]"
                                                        value="{{ old(
                                                            "questions.$index.opsi_$letter",
                                                            $question->{"opsi_$letter"}
                                                        ) }}"
                                                        class="option-input"
                                                        placeholder="Pilihan {{ strtoupper($letter) }}"
                                                    >

                                                </div>

                                            @endforeach

                                        </div>


                                        <div class="mt-4">

                                            <label
                                                class="block text-xs
                                                       font-bold
                                                       text-slate-600 mb-2"
                                            >
                                                Kunci Jawaban
                                            </label>


                                            <select
                                                name="questions[{{ $index }}][jawaban_benar]"
                                                class="input"
                                            >

                                                <option value="">
                                                    Pilih jawaban benar
                                                </option>

                                                @foreach(['A','B','C','D'] as $letter)

                                                    <option
                                                        value="{{ $letter }}"
                                                        {{ old(
                                                            "questions.$index.jawaban_benar",
                                                            strtoupper($question->jawaban_benar ?? '')
                                                        ) === $letter
                                                            ? 'selected'
                                                            : '' }}
                                                    >
                                                        {{ $letter }}
                                                    </option>

                                                @endforeach

                                            </select>

                                        </div>

                                    </div>


                                    {{-- ESSAY --}}
                                    <div
                                        class="essay-info mt-5
                                               {{ $jenis === 'pilihan_ganda'
                                                   ? 'hidden'
                                                   : '' }}"
                                    >

                                        <div
                                            class="p-4 rounded-xl
                                                   border border-amber-200
                                                   bg-amber-50"
                                        >

                                            <div
                                                class="flex items-start gap-3"
                                            >

                                                <i
                                                    data-lucide="info"
                                                    class="w-5 h-5
                                                           text-amber-600
                                                           flex-shrink-0"
                                                ></i>


                                                <div>

                                                    <div
                                                        class="text-sm font-bold
                                                               text-amber-800"
                                                    >
                                                        Penilaian manual
                                                    </div>

                                                    <div
                                                        class="text-xs
                                                               text-amber-700
                                                               mt-1 leading-5"
                                                    >
                                                        Jawaban essay akan
                                                        diperiksa dan diberi
                                                        nilai secara manual
                                                        oleh guru.
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endforeach


                        @if($lkpd->questions->count() === 0)

                            <div
                                id="emptyQuestions"
                                class="py-12 text-center
                                       border-2 border-dashed
                                       border-slate-200
                                       rounded-2xl"
                            >

                                <i
                                    data-lucide="file-question"
                                    class="w-6 h-6 text-slate-400 mx-auto"
                                ></i>

                                <div
                                    class="font-bold text-slate-700 mt-3"
                                >
                                    Belum ada soal
                                </div>

                                <div
                                    class="text-sm text-slate-400 mt-1"
                                >
                                    Klik "Tambah Soal" untuk menambahkan soal.
                                </div>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- FOOTER --}}
                <section
                    class="bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="flex flex-col-reverse
                               sm:flex-row
                               sm:items-center
                               sm:justify-between gap-3"
                    >

                        <a
                            href="{{ route('guru.lkpd.index') }}"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   px-5 py-3 rounded-xl
                                   border border-slate-200
                                   bg-white hover:bg-slate-50
                                   text-slate-600 text-sm font-bold"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            id="saveBtn"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   px-6 py-3 rounded-xl
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-bold"
                        >

                            <i
                                data-lucide="save"
                                class="w-4 h-4"
                            ></i>

                            Simpan Perubahan

                        </button>

                    </div>

                </section>

            </form>

        </div>

    </main>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }


    const container =
        document.getElementById('questionsContainer');

    const addButton =
        document.getElementById('addQuestionBtn');

    let questionIndex =
        {{ $lkpd->questions->count() }};


    /* =========================================================
       UPDATE EMPTY
    ========================================================= */

    function updateEmptyState() {

        const cards =
            container.querySelectorAll('.question-card');

        const empty =
            document.getElementById('emptyQuestions');

        if (cards.length === 0) {

            if (!empty) {

                const div =
                    document.createElement('div');

                div.id = 'emptyQuestions';

                div.className =
                    'py-12 text-center border-2 border-dashed border-slate-200 rounded-2xl';

                div.innerHTML = `
                    <i data-lucide="file-question"
                       class="w-6 h-6 text-slate-400 mx-auto"></i>

                    <div class="font-bold text-slate-700 mt-3">
                        Belum ada soal
                    </div>

                    <div class="text-sm text-slate-400 mt-1">
                        Klik "Tambah Soal" untuk menambahkan soal.
                    </div>
                `;

                container.appendChild(div);

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }

            }

        } else if (empty) {

            empty.remove();

        }

    }


    /* =========================================================
       BIND QUESTION
    ========================================================= */

    function bindQuestion(card) {

        const radios =
            card.querySelectorAll('.type-radio');

        const pgFields =
            card.querySelector('.pg-fields');

        const essayInfo =
            card.querySelector('.essay-info');

        const pgCard =
            card.querySelector('.type-pg');

        const essayCard =
            card.querySelector('.type-essay');


        radios.forEach(radio => {

            radio.addEventListener('change', function () {

                const isPg =
                    this.value === 'pilihan_ganda';


                if (isPg) {

                    pgFields.classList.remove('hidden');
                    essayInfo.classList.add('hidden');

                    pgCard.classList.add('active-pg');
                    essayCard.classList.remove('active-essay');

                } else {

                    pgFields.classList.add('hidden');
                    essayInfo.classList.remove('hidden');

                    pgCard.classList.remove('active-pg');
                    essayCard.classList.add('active-essay');

                }

            });

        });


        const remove =
            card.querySelector('.remove-question');

        remove.addEventListener('click', function () {

            if (!confirm(
                'Hapus soal ini?\n\nSoal akan dihapus dari LKPD saat disimpan.'
            )) {
                return;
            }

            card.remove();

            renumber();

            updateEmptyState();

        });

    }


    /* =========================================================
       RENUMBER
    ========================================================= */

    function renumber() {

        const cards =
            container.querySelectorAll('.question-card');

        cards.forEach((card, position) => {

            const number =
                card.querySelector('.question-number');

            if (number) {
                number.textContent = position + 1;
            }

        });

    }


    /* =========================================================
       ADD QUESTION
    ========================================================= */

    function addQuestion() {

        const index =
            questionIndex++;

        const card =
            document.createElement('div');

        card.className =
            'question-card border border-slate-200 rounded-2xl overflow-hidden bg-white';

        card.innerHTML = `

            <div
                class="px-5 py-4 bg-slate-50
                       border-b border-slate-200
                       flex items-center
                       justify-between gap-3"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="question-number
                               w-9 h-9 rounded-xl
                               bg-slate-900 text-white
                               flex items-center justify-center
                               text-xs font-black"
                    >
                        1
                    </div>

                    <div>

                        <div class="font-black text-slate-900">
                            Soal Baru
                        </div>

                        <div class="text-xs text-slate-400">
                            Tentukan jenis soal
                        </div>

                    </div>

                </div>


                <button
                    type="button"
                    class="remove-question
                           w-9 h-9 rounded-xl
                           bg-white border border-slate-200
                           text-slate-400
                           hover:text-red-600
                           flex items-center justify-center"
                >
                    <i data-lucide="trash-2"
                       class="w-4 h-4"></i>
                </button>

            </div>


            <div class="p-5">

                <div
                    class="grid grid-cols-1
                           sm:grid-cols-2 gap-3 mb-5"
                >

                    <label
                        class="radio-card type-pg active-pg
                               border border-slate-200
                               rounded-xl p-4"
                    >

                        <input
                            type="radio"
                            name="questions[${index}][jenis]"
                            value="pilihan_ganda"
                            class="sr-only type-radio"
                            checked
                        >

                        <div class="flex items-start gap-3">

                            <div
                                class="w-9 h-9 rounded-lg
                                       bg-violet-50 text-violet-600
                                       flex items-center justify-center"
                            >
                                <i data-lucide="list-checks"
                                   class="w-4 h-4"></i>
                            </div>

                            <div>

                                <div
                                    class="text-sm font-black
                                           text-slate-800"
                                >
                                    Pilihan Ganda
                                </div>

                                <div
                                    class="text-xs text-slate-400 mt-1"
                                >
                                    Nilai otomatis
                                </div>

                            </div>

                        </div>

                    </label>


                    <label
                        class="radio-card type-essay
                               border border-slate-200
                               rounded-xl p-4"
                    >

                        <input
                            type="radio"
                            name="questions[${index}][jenis]"
                            value="essay"
                            class="sr-only type-radio"
                        >

                        <div class="flex items-start gap-3">

                            <div
                                class="w-9 h-9 rounded-lg
                                       bg-amber-50 text-amber-600
                                       flex items-center justify-center"
                            >
                                <i data-lucide="file-pen-line"
                                   class="w-4 h-4"></i>
                            </div>

                            <div>

                                <div
                                    class="text-sm font-black
                                           text-slate-800"
                                >
                                    Essay
                                </div>

                                <div
                                    class="text-xs text-slate-400 mt-1"
                                >
                                    Dinilai manual guru
                                </div>

                            </div>

                        </div>

                    </label>

                </div>


                <div>

                    <label
                        class="block text-xs font-bold
                               text-slate-600 mb-2"
                    >
                        Pertanyaan
                    </label>

                    <textarea
                        name="questions[${index}][pertanyaan]"
                        required
                        class="input"
                        placeholder="Tuliskan pertanyaan..."
                    ></textarea>

                </div>


                <div class="pg-fields mt-5">

                    <div
                        class="text-sm font-black
                               text-slate-800 mb-3"
                    >
                        Pilihan Jawaban
                    </div>


                    <div
                        class="grid grid-cols-1
                               md:grid-cols-2 gap-3"
                    >

                        ${option(index, 'a', 'A')}
                        ${option(index, 'b', 'B')}
                        ${option(index, 'c', 'C')}
                        ${option(index, 'd', 'D')}

                    </div>


                    <div class="mt-4">

                        <label
                            class="block text-xs font-bold
                                   text-slate-600 mb-2"
                        >
                            Kunci Jawaban
                        </label>

                        <select
                            name="questions[${index}][jawaban_benar]"
                            class="input"
                        >

                            <option value="">
                                Pilih jawaban benar
                            </option>

                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="C">C</option>
                            <option value="D">D</option>

                        </select>

                    </div>

                </div>


                <div class="essay-info hidden mt-5">

                    <div
                        class="p-4 rounded-xl
                               border border-amber-200
                               bg-amber-50"
                    >

                        <div class="flex items-start gap-3">

                            <i
                                data-lucide="info"
                                class="w-5 h-5 text-amber-600"
                            ></i>

                            <div>

                                <div
                                    class="text-sm font-bold
                                           text-amber-800"
                                >
                                    Penilaian manual
                                </div>

                                <div
                                    class="text-xs text-amber-700
                                           mt-1 leading-5"
                                >
                                    Jawaban essay akan diperiksa
                                    dan diberi nilai secara manual
                                    oleh guru.
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        `;


        container.appendChild(card);

        bindQuestion(card);

        renumber();

        updateEmptyState();

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

    }


    /* =========================================================
       OPTION
    ========================================================= */

    function option(index, name, letter) {

        return `
            <div class="flex items-center gap-2">

                <div
                    class="w-9 h-[42px] rounded-lg
                           bg-slate-100 text-slate-600
                           flex items-center justify-center
                           text-xs font-black"
                >
                    ${letter}
                </div>

                <input
                    type="text"
                    name="questions[${index}][opsi_${name}]"
                    class="option-input"
                    placeholder="Pilihan ${letter}"
                >

            </div>
        `;

    }


    /* =========================================================
       INITIAL BIND
    ========================================================= */

    container
        .querySelectorAll('.question-card')
        .forEach(bindQuestion);


    /* =========================================================
       ADD
    ========================================================= */

    addButton.addEventListener(
        'click',
        addQuestion
    );


    /* =========================================================
       VALIDATION
    ========================================================= */

    document
        .getElementById('lkpdForm')
        .addEventListener('submit', function (event) {

            const cards =
                container.querySelectorAll('.question-card');


            if (cards.length === 0) {

                event.preventDefault();

                alert(
                    'Tambahkan minimal satu soal.'
                );

                return;

            }


            let invalid = false;


            cards.forEach(card => {

                const type =
                    card.querySelector(
                        '.type-radio:checked'
                    )?.value;


                const question =
                    card.querySelector(
                        'textarea[name*="[pertanyaan]"]'
                    );


                if (!question ||
                    !question.value.trim()) {

                    invalid = true;

                    alert(
                        'Pertanyaan tidak boleh kosong.'
                    );

                    question?.focus();

                    return;

                }


                if (type === 'pilihan_ganda') {

                    const options = [
                        card.querySelector('[name*="[opsi_a]"]'),
                        card.querySelector('[name*="[opsi_b]"]'),
                        card.querySelector('[name*="[opsi_c]"]'),
                        card.querySelector('[name*="[opsi_d]"]')
                    ];


                    if (
                        options.some(
                            input =>
                                !input ||
                                !input.value.trim()
                        )
                    ) {

                        invalid = true;

                        alert(
                            'Semua pilihan A, B, C, dan D harus diisi.'
                        );

                        return;

                    }


                    const correct =
                        card.querySelector(
                            '[name*="[jawaban_benar]"]'
                        );


                    if (
                        !correct ||
                        !correct.value
                    ) {

                        invalid = true;

                        alert(
                            'Pilih kunci jawaban untuk soal pilihan ganda.'
                        );

                    }

                }

            });


            if (invalid) {
                event.preventDefault();
                return;
            }


            const saveBtn =
                document.getElementById('saveBtn');

            saveBtn.disabled = true;

            saveBtn.classList.add(
                'opacity-60',
                'cursor-not-allowed'
            );

            saveBtn.innerHTML = `
                <svg
                    class="animate-spin w-4 h-4"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                >
                    <circle
                        class="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        stroke-width="4"
                    ></circle>

                    <path
                        class="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                    ></path>
                </svg>

                Menyimpan...
            `;

        });

});


</script>

</body>
</html>