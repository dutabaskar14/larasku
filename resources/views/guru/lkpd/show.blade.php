<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail LKPD — LARASKU</title>

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


            {{-- FLASH --}}
            @if(session('success'))

                <div
                    class="mb-6 px-4 py-3 rounded-xl
                           border border-emerald-200
                           bg-emerald-50 text-emerald-700
                           text-sm font-semibold"
                >
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div
                    class="mb-6 px-4 py-3 rounded-xl
                           border border-red-200
                           bg-red-50 text-red-700
                           text-sm font-semibold"
                >
                    {{ session('error') }}
                </div>

            @endif


            {{-- HEADER LKPD --}}
            <section
                class="bg-white border border-slate-200
                       rounded-2xl p-6 shadow-sm mb-6"
            >

                <div
                    class="flex flex-col lg:flex-row
                           lg:items-start lg:justify-between gap-5"
                >

                    <div>

                        <div
                            class="inline-flex items-center gap-2
                                   px-3 py-1.5 rounded-lg
                                   bg-blue-50 text-blue-600
                                   text-xs font-bold mb-3"
                        >

                            <i
                                data-lucide="calendar-days"
                                class="w-3.5 h-3.5"
                            ></i>

                            Pertemuan {{ $lkpd->pertemuan }}

                        </div>


                        <h1
                            class="text-2xl lg:text-3xl
                                   font-black text-slate-900"
                        >
                            {{ $lkpd->judul }}
                        </h1>


                        @if($lkpd->deskripsi)

                            <p
                                class="mt-3 text-sm leading-7
                                       text-slate-500 max-w-3xl"
                            >
                                {{ $lkpd->deskripsi }}
                            </p>

                        @endif

                    </div>


                    {{-- STATUS AKTIF --}}
                    @if($lkpd->aktif)

                        <span
                            class="inline-flex items-center gap-2
                                   px-3 py-2 rounded-xl
                                   bg-emerald-50 text-emerald-700
                                   text-xs font-bold"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                       bg-emerald-500"
                            ></span>

                            Aktif untuk Siswa

                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-2
                                   px-3 py-2 rounded-xl
                                   bg-slate-100 text-slate-500
                                   text-xs font-bold"
                        >

                            <span
                                class="w-2 h-2 rounded-full
                                       bg-slate-400"
                            ></span>

                            Belum Aktif

                        </span>

                    @endif

                </div>

            </section>


            {{-- STATISTIK SOAL --}}
            @php

                $pgCount = $lkpd->questions
                    ->where('jenis', 'pilihan_ganda')
                    ->count();

                $essayCount = $lkpd->questions
                    ->where('jenis', 'essay')
                    ->count();

                $studentCount = $lkpd->answers
                    ->pluck('student_id')
                    ->unique()
                    ->count();

                $pendingEssay = $lkpd->answers
                    ->filter(function ($answer) {
                        return $answer->question &&
                            $answer->question->jenis === 'essay' &&
                            $answer->nilai === null;
                    })
                    ->count();

            @endphp


            <div
                class="grid grid-cols-2 lg:grid-cols-4
                       gap-4 mb-6"
            >

                <div
                    class="bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="text-xs font-semibold
                               text-slate-400"
                    >
                        Total Soal
                    </div>

                    <div
                        class="mt-2 text-2xl font-black
                               text-slate-900"
                    >
                        {{ $lkpd->questions->count() }}
                    </div>

                </div>


                <div
                    class="bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="text-xs font-semibold
                               text-slate-400"
                    >
                        Pilihan Ganda
                    </div>

                    <div
                        class="mt-2 text-2xl font-black
                               text-violet-600"
                    >
                        {{ $pgCount }}
                    </div>

                </div>


                <div
                    class="bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="text-xs font-semibold
                               text-slate-400"
                    >
                        Essay
                    </div>

                    <div
                        class="mt-2 text-2xl font-black
                               text-amber-600"
                    >
                        {{ $essayCount }}
                    </div>

                </div>


                <div
                    class="bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="text-xs font-semibold
                               text-slate-400"
                    >
                        Siswa
                    </div>

                    <div
                        class="mt-2 text-2xl font-black
                               text-blue-600"
                    >
                        {{ $studentCount }}
                    </div>

                </div>

            </div>


            {{-- SOAL --}}
            <section
                class="bg-white border border-slate-200
                       rounded-2xl overflow-hidden shadow-sm
                       mb-6"
            >

                <div
                    class="px-6 py-5 border-b
                           border-slate-100"
                >

                    <h2
                        class="font-black text-slate-900"
                    >
                        Daftar Soal
                    </h2>

                    <p
                        class="mt-1 text-xs text-slate-400"
                    >
                        Soal yang dibuat untuk LKPD ini.
                    </p>

                </div>


                <div class="p-6 space-y-5">

                    @forelse($lkpd->questions as $question)

                        <div
                            class="border border-slate-200
                                   rounded-2xl p-5"
                        >

                            <div
                                class="flex flex-col
                                       sm:flex-row
                                       sm:items-start
                                       sm:justify-between
                                       gap-3 mb-4"
                            >

                                <div
                                    class="flex items-center gap-2"
                                >

                                    <span
                                        class="w-8 h-8 rounded-lg
                                               bg-slate-100
                                               flex items-center
                                               justify-center
                                               text-xs font-black
                                               text-slate-500"
                                    >
                                        {{ $question->urutan }}
                                    </span>

                                    @if($question->jenis === 'pilihan_ganda')

                                        <span
                                            class="px-2.5 py-1.5
                                                   rounded-lg
                                                   bg-violet-50
                                                   text-violet-700
                                                   text-xs font-bold"
                                        >
                                            Pilihan Ganda
                                        </span>

                                    @else

                                        <span
                                            class="px-2.5 py-1.5
                                                   rounded-lg
                                                   bg-amber-50
                                                   text-amber-700
                                                   text-xs font-bold"
                                        >
                                            Essay
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div
                                class="text-sm font-semibold
                                       leading-7 text-slate-800"
                            >
                                {{ $question->pertanyaan }}
                            </div>


                            @if($question->jenis === 'pilihan_ganda')

                                <div
                                    class="grid grid-cols-1
                                           md:grid-cols-2
                                           gap-2 mt-4"
                                >

                                    @foreach([
                                        'A' => $question->opsi_a,
                                        'B' => $question->opsi_b,
                                        'C' => $question->opsi_c,
                                        'D' => $question->opsi_d,
                                    ] as $key => $option)

                                        @if($option !== null && $option !== '')

                                            <div
                                                class="
                                                    px-4 py-3
                                                    rounded-xl
                                                    border
                                                    {{ $question->jawaban_benar === $key
                                                        ? 'border-emerald-200 bg-emerald-50'
                                                        : 'border-slate-200 bg-slate-50'
                                                    }}
                                                "
                                            >

                                                <span
                                                    class="font-black
                                                           text-slate-500
                                                           mr-2"
                                                >
                                                    {{ $key }}.
                                                </span>

                                                <span
                                                    class="text-sm
                                                           text-slate-700"
                                                >
                                                    {{ $option }}
                                                </span>

                                                @if($question->jawaban_benar === $key)

                                                    <span
                                                        class="ml-2
                                                               text-xs
                                                               font-bold
                                                               text-emerald-600"
                                                    >
                                                        ✓ Benar
                                                    </span>

                                                @endif

                                            </div>

                                        @endif

                                    @endforeach

                                </div>

                            @endif

                        </div>

                    @empty

                        <div
                            class="py-12 text-center
                                   text-sm text-slate-400"
                        >
                            Belum ada soal.
                        </div>

                    @endforelse

                </div>

            </section>


            {{-- JAWABAN SISWA --}}
            <section
                class="bg-white border border-slate-200
                       rounded-2xl overflow-hidden shadow-sm"
            >

                <div
                    class="px-6 py-5 border-b
                           border-slate-100"
                >

                    <h2
                        class="font-black text-slate-900"
                    >
                        Jawaban Siswa
                    </h2>

                    <p
                        class="mt-1 text-xs text-slate-400"
                    >
                        Penilaian otomatis untuk PG dan manual
                        untuk essay.
                    </p>

                </div>


                @php

                    $students = $lkpd->answers
                        ->groupBy('student_id');

                @endphp


                @if($students->count())

                    <div class="p-6 space-y-8">

                        @foreach($students as $studentId => $answers)

                            @php
                                $student = $answers->first()->student;
                            @endphp


                            <div
                                class="border border-slate-200
                                       rounded-2xl overflow-hidden"
                            >

                                {{-- STUDENT HEADER --}}
                                <div
                                    class="px-5 py-4
                                           bg-slate-50
                                           border-b border-slate-200
                                           flex flex-col sm:flex-row
                                           sm:items-center
                                           sm:justify-between gap-3"
                                >

                                    <div>

                                        <div
                                            class="font-black
                                                   text-slate-900"
                                        >
                                            {{ $student->nama ?? 'Siswa' }}
                                        </div>

                                        <div
                                            class="text-xs
                                                   text-slate-400 mt-1"
                                        >
                                            Kelas:
                                            {{ $student->kelas ?? '-' }}
                                            &nbsp; • &nbsp;
                                            Absen:
                                            {{ $student->nomor_absen ?? '-' }}
                                        </div>

                                    </div>


                                    @php

                                        $studentEssayPending =
                                            $answers->contains(
                                                fn ($answer) =>
                                                    $answer->question &&
                                                    $answer->question->jenis === 'essay' &&
                                                    $answer->nilai === null
                                            );

                                    @endphp


                                    @if($studentEssayPending)

                                        <span
                                            class="inline-flex
                                                   items-center gap-1.5
                                                   px-3 py-2 rounded-lg
                                                   bg-orange-50
                                                   text-orange-700
                                                   text-xs font-bold"
                                        >

                                            <i
                                                data-lucide="clock-3"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Essay belum dinilai

                                        </span>

                                    @else

                                        <span
                                            class="inline-flex
                                                   items-center gap-1.5
                                                   px-3 py-2 rounded-lg
                                                   bg-emerald-50
                                                   text-emerald-700
                                                   text-xs font-bold"
                                        >

                                            <i
                                                data-lucide="circle-check"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Penilaian selesai

                                        </span>

                                    @endif

                                </div>


                                {{-- ANSWERS --}}
                                <div class="p-5 space-y-5">

                                    @foreach($lkpd->questions as $question)

                                        @php

                                            $answer = $answers->firstWhere(
                                                'lkpd_question_id',
                                                $question->id
                                            );

                                        @endphp


                                        <div
                                            class="border border-slate-100
                                                   rounded-xl p-4"
                                        >

                                            <div
                                                class="flex items-start
                                                       justify-between
                                                       gap-3"
                                            >

                                                <div
                                                    class="text-sm
                                                           font-bold
                                                           text-slate-800"
                                                >

                                                    {{ $question->urutan }}.
                                                    {{ $question->pertanyaan }}

                                                </div>

                                            </div>


                                            {{-- PG --}}
                                            @if($question->jenis === 'pilihan_ganda')

                                                <div
                                                    class="mt-3 flex flex-wrap
                                                           items-center gap-3"
                                                >

                                                    <span
                                                        class="text-xs
                                                               text-slate-400"
                                                    >
                                                        Jawaban:
                                                    </span>

                                                    <span
                                                        class="px-3 py-1.5
                                                               rounded-lg
                                                               bg-violet-50
                                                               text-violet-700
                                                               text-xs
                                                               font-black"
                                                    >
                                                        {{ $answer->jawaban ?? '-' }}
                                                    </span>


                                                    @if($answer && $answer->nilai !== null)

                                                        <span
                                                            class="text-xs
                                                                   font-bold
                                                                   text-emerald-600"
                                                        >
                                                            Nilai:
                                                            {{ $answer->nilai }}
                                                        </span>

                                                    @endif

                                                </div>

                                            {{-- ESSAY --}}
                                            @else

                                                <div
                                                    class="mt-3 p-4
                                                           rounded-xl
                                                           bg-slate-50
                                                           text-sm
                                                           leading-7
                                                           text-slate-700
                                                "
                                                >
                                                    {{ $answer->jawaban ?? 'Belum menjawab.' }}
                                                </div>


                                                @if($answer)

                                                    <div
                                                        class="mt-4"
                                                    >

                                                        <label
                                                            class="block
                                                                   text-xs
                                                                   font-bold
                                                                   text-slate-600
                                                                   mb-2"
                                                        >
                                                            Nilai Essay
                                                        </label>

                                                        <input
                                                            form="grade-form-{{ $studentId }}"
                                                            type="number"
                                                            name="answers[{{ $answer->id }}]"
                                                            min="0"
                                                            max="100"
                                                            value="{{ $answer->nilai }}"
                                                            placeholder="0–100"
                                                            class="w-full sm:w-40
                                                                   h-10 px-3
                                                                   border
                                                                   border-slate-200
                                                                   rounded-xl
                                                                   text-sm
                                                                   outline-none
                                                                   focus:border-blue-500
                                                                   focus:ring-4
                                                                   focus:ring-blue-100"
                                                        >

                                                    </div>

                                                @endif

                                            @endif

                                        </div>

                                    @endforeach


                                    {{-- GRADE FORM --}}
                                    @if($answers->contains(
                                        fn ($answer) =>
                                            $answer->question &&
                                            $answer->question->jenis === 'essay'
                                    ))

                                        <form
                                            id="grade-form-{{ $studentId }}"
                                            action="{{ route('guru.lkpd.grade', $lkpd) }}"
                                            method="POST"
                                            class="pt-2"
                                        >

                                            @csrf

                                            <button
                                                type="submit"
                                                class="inline-flex
                                                       items-center
                                                       justify-center gap-2
                                                       px-4 py-2.5
                                                       rounded-xl
                                                       bg-slate-900
                                                       hover:bg-slate-800
                                                       text-white
                                                       text-sm font-bold"
                                            >

                                                <i
                                                    data-lucide="save"
                                                    class="w-4 h-4"
                                                ></i>

                                                Simpan Nilai Essay

                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div
                        class="px-6 py-16 text-center"
                    >

                        <div
                            class="w-14 h-14 mx-auto
                                   rounded-2xl bg-slate-100
                                   flex items-center
                                   justify-center mb-4"
                        >

                            <i
                                data-lucide="inbox"
                                class="w-6 h-6 text-slate-400"
                            ></i>

                        </div>

                        <div
                            class="font-bold text-slate-700"
                        >
                            Belum ada jawaban siswa
                        </div>

                        <div
                            class="text-sm text-slate-400 mt-1"
                        >
                            Jawaban siswa akan muncul setelah LKPD
                            dikerjakan.
                        </div>

                    </div>

                @endif

            </section>


            {{-- FINALIZE --}}
            @if($essayCount > 0 && $studentCount > 0)

                <section
                    class="mt-6 bg-white border border-slate-200
                           rounded-2xl p-5 shadow-sm"
                >

                    <div
                        class="flex flex-col lg:flex-row
                               lg:items-center
                               lg:justify-between gap-4"
                    >

                        <div>

                            <div
                                class="font-black text-slate-900"
                            >
                                Selesaikan Penilaian LKPD
                            </div>

                            <div
                                class="text-xs text-slate-400 mt-1"
                            >
                                Pastikan seluruh jawaban essay
                                sudah dinilai sebelum menyelesaikan
                                penilaian.
                            </div>

                        </div>


                        <form
                            action="{{ route('guru.lkpd.finalize', $lkpd) }}"
                            method="POST"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="inline-flex items-center
                                       justify-center gap-2
                                       px-5 py-3 rounded-xl
                                       bg-emerald-600
                                       hover:bg-emerald-700
                                       text-white text-sm
                                       font-bold"
                            >

                                <i
                                    data-lucide="check-check"
                                    class="w-4 h-4"
                                ></i>

                                Selesaikan Penilaian

                            </button>

                        </form>

                    </div>

                </section>

            @endif


        </div>

    </main>

</div>


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