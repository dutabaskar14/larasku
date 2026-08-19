<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Penilaian Refleksi — LARASKU</title>

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

        .answer-box {
            white-space: pre-wrap;
            word-break: break-word;
        }

        .score-input::-webkit-inner-spin-button,
        .score-input::-webkit-outer-spin-button {
            opacity: 1;
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


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section
                class="
                    mb-6
                    flex
                    flex-col
                    lg:flex-row
                    lg:items-end
                    lg:justify-between
                    gap-5
                "
            >

                <div>

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
                            data-lucide="message-square-check"
                            class="w-3.5 h-3.5"
                        ></i>

                        Penilaian Guru

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
                        {{ $reflection->judul }}
                    </h1>


                    @if($reflection->deskripsi)

                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                max-w-3xl
                            "
                        >
                            {{ $reflection->deskripsi }}
                        </p>

                    @endif

                </div>


                <div
                    class="
                        flex
                        flex-wrap
                        gap-2
                    "
                >

                    {{-- PERTEMUAN REFLEKSI --}}

                    <span
                        class="
                            inline-flex
                            items-center
                            gap-2
                            px-3
                            py-2
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            text-xs
                            font-black
                        "
                    >

                        <i
                            data-lucide="calendar-days"
                            class="w-3.5 h-3.5"
                        ></i>

                        Pertemuan {{ $reflection->pertemuan }}

                    </span>


                    {{-- STATUS --}}

                    @if($reflection->aktif)

                        <span
                            class="
                                inline-flex
                                items-center
                                gap-2
                                px-3
                                py-2
                                rounded-xl
                                bg-emerald-50
                                text-emerald-700
                                text-xs
                                font-black
                            "
                        >

                            <span
                                class="
                                    w-1.5
                                    h-1.5
                                    rounded-full
                                    bg-emerald-500
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
                                py-2
                                rounded-xl
                                bg-slate-100
                                text-slate-500
                                text-xs
                                font-black
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

            </section>


            {{-- =================================================
                 FILTER KELAS
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-5
                    mb-5
                "
            >

                <form
                    method="GET"
                    action="{{ route(
                        'guru.reflections.show',
                        $reflection
                    ) }}"
                >

                    <div
                        class="
                            flex
                            flex-col
                            md:flex-row
                            md:items-end
                            gap-4
                        "
                    >

                        <div class="flex-1 max-w-md">

                            <label
                                for="kelas"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Filter Kelas
                            </label>


                            <select
                                id="kelas"
                                name="kelas"
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

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        @selected(
                                            (string) $kelas ===
                                            (string) $class
                                        )
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <button
                            type="submit"
                            class="
                                h-11
                                px-5
                                rounded-xl
                                bg-slate-900
                                hover:bg-slate-800
                                text-white
                                text-sm
                                font-bold
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                transition
                            "
                        >

                            <i
                                data-lucide="filter"
                                class="w-4 h-4"
                            ></i>

                            Tampilkan

                        </button>


                        @if($kelas)

                            <a
                                href="{{ route(
                                    'guru.reflections.show',
                                    $reflection
                                ) }}"
                                class="
                                    h-11
                                    px-4
                                    rounded-xl
                                    border
                                    border-slate-200
                                    bg-white
                                    hover:bg-slate-50
                                    text-slate-600
                                    text-sm
                                    font-bold
                                    inline-flex
                                    items-center
                                    justify-center
                                "
                                title="Reset kelas"
                            >

                                <i
                                    data-lucide="rotate-ccw"
                                    class="w-4 h-4"
                                ></i>

                            </a>

                        @endif

                    </div>

                </form>

            </section>


            {{-- =================================================
                 STATISTIK
            ================================================== --}}

            @php

                $students =
                    $reflection->answers
                        ->filter(
                            fn ($answer) =>
                                $answer->student
                        )
                        ->groupBy('student_id');


                $studentCount =
                    $students->count();


                $gradedStudentCount =
                    $students
                        ->filter(
                            function ($answers) {

                                return $answers->isNotEmpty()
                                    && $answers->every(
                                        fn ($answer) =>
                                            $answer->nilai !== null
                                    );

                            }
                        )
                        ->count();


                $ungradedStudentCount =
                    max(
                        0,
                        $studentCount -
                        $gradedStudentCount
                    );


                $questionCount =
                    $reflection->questions->count();

            @endphp


            <div
                class="
                    grid
                    grid-cols-2
                    md:grid-cols-4
                    gap-3
                    mb-5
                "
            >

                {{-- SOAL --}}

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Soal
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-slate-900
                            mt-1
                        "
                    >
                        {{ $questionCount }}
                    </div>

                </div>


                {{-- SISWA --}}

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Siswa
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-blue-600
                            mt-1
                        "
                    >
                        {{ $studentCount }}
                    </div>

                </div>


                {{-- SUDAH DINILAI --}}

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Sudah Dinilai
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-emerald-600
                            mt-1
                        "
                    >
                        {{ $gradedStudentCount }}
                    </div>

                </div>


                {{-- BELUM DINILAI --}}

                <div
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        p-4
                    "
                >

                    <div
                        class="
                            text-[11px]
                            uppercase
                            tracking-wider
                            font-black
                            text-slate-400
                        "
                    >
                        Belum Dinilai
                    </div>

                    <div
                        class="
                            text-2xl
                            font-black
                            text-amber-600
                            mt-1
                        "
                    >
                        {{ $ungradedStudentCount }}
                    </div>

                </div>

            </div>


            {{-- =================================================
                 FORM PENILAIAN
            ================================================== --}}

            <form
                method="POST"
                action="{{ route(
                    'guru.reflections.grade',
                    $reflection
                ) }}"
                id="gradingForm"
            >

                @csrf


                @if($students->count())

                    <div class="space-y-5">

                        @foreach(
                            $students as $studentId => $answers
                        )

                            @php

                                $student =
                                    $answers
                                        ->first()
                                        ->student;


                                $allGraded =
                                    $answers->every(
                                        fn ($answer) =>
                                            $answer->nilai !== null
                                    );


                                $answersByQuestion =
                                    $answers->keyBy(
                                        'reflection_question_id'
                                    );

                            @endphp


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

                                {{-- STUDENT HEADER --}}

                                <div
                                    class="
                                        px-5
                                        lg:px-6
                                        py-5
                                        border-b
                                        border-slate-100
                                        bg-slate-50
                                        flex
                                        flex-col
                                        md:flex-row
                                        md:items-center
                                        md:justify-between
                                        gap-4
                                    "
                                >

                                    <div>

                                        <div
                                            class="
                                                text-lg
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            {{ $student->nama ?? 'Siswa tidak ditemukan' }}
                                        </div>


                                        <div
                                            class="
                                                flex
                                                flex-wrap
                                                gap-x-4
                                                gap-y-1
                                                mt-1
                                                text-xs
                                                text-slate-500
                                            "
                                        >

                                            <span>
                                                No. Absen:

                                                <strong
                                                    class="text-slate-700"
                                                >
                                                    {{ $student->nomor_absen ?? '-' }}
                                                </strong>
                                            </span>


                                            <span>
                                                Kelas:

                                                <strong
                                                    class="text-slate-700"
                                                >
                                                    {{ $student->kelas ?? '-' }}
                                                </strong>
                                            </span>

                                        </div>

                                    </div>


                                    @if($allGraded)

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-2
                                                px-3
                                                py-2
                                                rounded-xl
                                                bg-emerald-50
                                                text-emerald-700
                                                text-xs
                                                font-black
                                            "
                                        >

                                            <i
                                                data-lucide="check-circle"
                                                class="w-4 h-4"
                                            ></i>

                                            Sudah Dinilai

                                        </span>

                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                items-center
                                                gap-2
                                                px-3
                                                py-2
                                                rounded-xl
                                                bg-amber-50
                                                text-amber-700
                                                text-xs
                                                font-black
                                            "
                                        >

                                            <i
                                                data-lucide="clock-3"
                                                class="w-4 h-4"
                                            ></i>

                                            Belum Selesai Dinilai

                                        </span>

                                    @endif

                                </div>


                                {{-- QUESTIONS --}}

                                <div>

                                    @foreach(
                                        $reflection->questions
                                        as $index => $question
                                    )

                                        @php

                                            $answer =
                                                $answersByQuestion
                                                    ->get(
                                                        $question->id
                                                    );

                                        @endphp


                                        <div
                                            class="
                                                px-5
                                                lg:px-6
                                                py-6
                                                border-b
                                                border-slate-100
                                                last:border-b-0
                                            "
                                        >

                                            {{-- QUESTION --}}

                                            <div
                                                class="
                                                    flex
                                                    items-start
                                                    gap-3
                                                    mb-4
                                                "
                                            >

                                                <div
                                                    class="
                                                        shrink-0
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
                                                            text-[10px]
                                                            font-black
                                                            uppercase
                                                            tracking-wider
                                                            text-blue-600
                                                            mb-1
                                                        "
                                                    >
                                                        Pertanyaan
                                                        {{ $index + 1 }}
                                                    </div>


                                                    <div
                                                        class="
                                                            text-sm
                                                            font-bold
                                                            leading-relaxed
                                                            text-slate-800
                                                        "
                                                    >
                                                        {{ $question->pertanyaan }}
                                                    </div>

                                                </div>

                                            </div>


                                            {{-- ANSWER --}}

                                            <div class="ml-0 md:ml-11">

                                                <div
                                                    class="
                                                        text-[10px]
                                                        font-black
                                                        uppercase
                                                        tracking-wider
                                                        text-slate-400
                                                        mb-2
                                                    "
                                                >
                                                    Jawaban Siswa
                                                </div>


                                                <div
                                                    class="
                                                        answer-box
                                                        min-h-[80px]
                                                        p-4
                                                        rounded-xl
                                                        bg-slate-50
                                                        border
                                                        border-slate-200
                                                        text-sm
                                                        leading-7
                                                        text-slate-700
                                                    "
                                                >

                                                    @if(
                                                        $answer &&
                                                        filled(
                                                            $answer->jawaban
                                                        )
                                                    )

                                                        {{ $answer->jawaban }}

                                                    @else

                                                        <span
                                                            class="
                                                                italic
                                                                text-slate-400
                                                            "
                                                        >
                                                            Tidak ada jawaban.
                                                        </span>

                                                    @endif

                                                </div>


                                                {{-- SCORE --}}

                                                @if($answer)

                                                    <div
                                                        class="
                                                            mt-4
                                                            flex
                                                            flex-col
                                                            sm:flex-row
                                                            sm:items-center
                                                            sm:justify-between
                                                            gap-3
                                                        "
                                                    >

                                                        <div>

                                                            <div
                                                                class="
                                                                    text-xs
                                                                    font-black
                                                                    text-slate-700
                                                                "
                                                            >
                                                                Nilai Jawaban
                                                            </div>

                                                            <div
                                                                class="
                                                                    text-[11px]
                                                                    text-slate-400
                                                                    mt-0.5
                                                                "
                                                            >
                                                                Masukkan nilai
                                                                0 sampai 100.
                                                            </div>

                                                        </div>


                                                        <div
                                                            class="
                                                                relative
                                                                w-full
                                                                sm:w-32
                                                            "
                                                        >

                                                            <input
                                                                type="number"
                                                                name="nilai[{{ $answer->id }}]"
                                                                value="{{ old(
                                                                    'nilai.' . $answer->id,
                                                                    $answer->nilai
                                                                ) }}"
                                                                min="0"
                                                                max="100"
                                                                step="1"
                                                                class="
                                                                    score-input
                                                                    w-full
                                                                    h-12
                                                                    pl-4
                                                                    pr-12
                                                                    rounded-xl
                                                                    border
                                                                    border-slate-200
                                                                    bg-white
                                                                    text-lg
                                                                    font-black
                                                                    text-slate-900
                                                                    outline-none
                                                                    focus:border-blue-400
                                                                    focus:ring-4
                                                                    focus:ring-blue-50
                                                                "
                                                                placeholder="0"
                                                            >


                                                            <span
                                                                class="
                                                                    absolute
                                                                    right-4
                                                                    top-1/2
                                                                    -translate-y-1/2
                                                                    text-xs
                                                                    font-bold
                                                                    text-slate-400
                                                                "
                                                            >
                                                                / 100
                                                            </span>

                                                        </div>

                                                    </div>

                                                @else

                                                    <div
                                                        class="
                                                            mt-4
                                                            rounded-xl
                                                            bg-amber-50
                                                            border
                                                            border-amber-100
                                                            px-4
                                                            py-3
                                                            text-xs
                                                            font-bold
                                                            text-amber-700
                                                        "
                                                    >

                                                        Jawaban untuk pertanyaan
                                                        ini belum tersedia.

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    @endforeach

                                </div>

                            </section>

                        @endforeach

                    </div>


                    {{-- SAVE --}}

                    <div
                        class="
                            sticky
                            bottom-4
                            mt-6
                            flex
                            flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between
                            gap-4
                            p-4
                            bg-white/95
                            backdrop-blur
                            border
                            border-slate-200
                            rounded-2xl
                            shadow-lg
                        "
                    >

                        <div>

                            <div
                                class="
                                    text-sm
                                    font-black
                                    text-slate-800
                                "
                            >
                                Selesaikan Penilaian
                            </div>

                            <div
                                class="
                                    text-xs
                                    text-slate-400
                                    mt-1
                                "
                            >
                                Pastikan seluruh nilai yang ingin disimpan
                                sudah diisi sebelum menekan tombol.
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
                                    'guru.reflections.index',
                                    [
                                        'pertemuan' =>
                                            $reflection->pertemuan
                                    ]
                                ) }}"
                                class="
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
                                    bg-blue-600
                                    hover:bg-blue-700
                                    text-white
                                    text-sm
                                    font-black
                                    transition
                                    shadow-sm
                                "
                            >

                                <i
                                    data-lucide="check-check"
                                    class="w-4 h-4"
                                ></i>

                                Selesaikan Nilai

                            </button>

                        </div>

                    </div>

                @else

                    {{-- EMPTY --}}

                    <section
                        class="
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            shadow-sm
                            px-5
                            py-16
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
                                data-lucide="message-square-off"
                                class="
                                    w-7
                                    h-7
                                    text-slate-400
                                "
                            ></i>

                        </div>


                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Belum ada jawaban siswa
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Belum ada siswa yang mengirim jawaban
                            untuk refleksi ini
                            @if($kelas)
                                pada kelas {{ $kelas }}
                            @endif.
                        </p>

                    </section>

                @endif

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
                    typeof lucide !==
                    'undefined'
                ) {

                    lucide.createIcons();

                }


                const form =
                    document.getElementById(
                        'gradingForm'
                    );


                if (!form) {

                    return;

                }


                form.addEventListener(
                    'submit',
                    function (event) {

                        const inputs =
                            form.querySelectorAll(
                                '.score-input'
                            );


                        let invalid = false;


                        inputs.forEach(
                            function (input) {

                                if (
                                    input.value === ''
                                ) {

                                    return;

                                }


                                const value =
                                    Number(
                                        input.value
                                    );


                                if (
                                    Number.isNaN(value) ||
                                    value < 0 ||
                                    value > 100
                                ) {

                                    invalid = true;

                                    input.focus();

                                }

                            }
                        );


                        if (invalid) {

                            event.preventDefault();

                            alert(
                                'Nilai harus berada di antara 0 sampai 100.'
                            );

                        }

                    }
                );

            }
        );

    </script>

</body>

</html>