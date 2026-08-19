<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Refleksi — LARASKU</title>

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
                box-shadow .2s ease,
                transform .2s ease;
        }

        .question-card:focus-within {
            border-color: #93c5fd;
            box-shadow: 0 10px 30px rgba(37, 99, 235, .08);
        }

        .modal-backdrop {
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
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

            {{-- =================================================
                 BACK
            ================================================== --}}

            <a
                href="{{ route('guru.reflections.index') }}"
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
                        data-lucide="message-square-plus"
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
                    Buat Refleksi
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Buat pertanyaan refleksi essay untuk siswa
                    berdasarkan pertemuan pembelajaran.
                </p>

            </section>


            {{-- =================================================
                 SUCCESS
            ================================================== --}}

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


            {{-- =================================================
                 ERROR
            ================================================== --}}

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

                    <div
                        class="
                            flex
                            items-start
                            gap-3
                        "
                    >

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


            {{-- =================================================
                 FORM
            ================================================== --}}

            <form
                method="POST"
                action="{{ route('guru.reflections.store') }}"
                id="reflectionForm"
            >

                @csrf


                {{-- =================================================
                     INFORMASI REFLEKSI
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
                            Tentukan pertemuan dan informasi refleksi.
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

                        {{-- =================================================
                             PERTEMUAN
                        ================================================== --}}

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


                            <div
                                class="
                                    flex
                                    items-center
                                    gap-2
                                "
                            >

                                <select
                                    id="pertemuan"
                                    name="pertemuan"
                                    required
                                    class="
                                        flex-1
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

                                    @if($pertemuans->isEmpty())

                                        <option value="">
                                            Belum ada pertemuan
                                        </option>

                                    @else

                                        @foreach($pertemuans as $item)

                                            <option
                                                value="{{ $item }}"
                                                @selected(
                                                    (string) $pertemuan === (string) $item
                                                )
                                            >
                                                Pertemuan {{ $item }}
                                            </option>

                                        @endforeach

                                    @endif

                                </select>


                                {{-- =================================================
                                     TAMBAH PERTEMUAN
                                ================================================== --}}

                                <button
                                    type="button"
                                    id="openMeetingModal"
                                    class="
                                        h-11
                                        px-3.5
                                        rounded-xl
                                        bg-blue-600
                                        hover:bg-blue-700
                                        text-white
                                        text-xs
                                        font-black
                                        inline-flex
                                        items-center
                                        justify-center
                                        gap-1.5
                                        transition
                                        shadow-sm
                                        whitespace-nowrap
                                    "
                                >

                                    <i
                                        data-lucide="plus"
                                        class="w-4 h-4"
                                    ></i>

                                    Tambah

                                </button>

                            </div>


                            <p
                                class="
                                    mt-2
                                    text-[11px]
                                    text-slate-400
                                "
                            >
                                Pertemuan Refleksi berdiri sendiri dan tidak mengikuti Materi.
                            </p>

                        </div>


                        {{-- =================================================
                             STATUS
                        ================================================== --}}

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
                                    {{ old('aktif') ? 'checked' : '' }}
                                >

                            </label>

                        </div>

                    </div>


                    {{-- =================================================
                         JUDUL
                    ================================================== --}}

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
                            value="{{ old('judul') }}"
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


                    {{-- =================================================
                         DESKRIPSI
                    ================================================== --}}

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
                            placeholder="Tuliskan petunjuk atau gambaran refleksi untuk siswa..."
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
                        >{{ old('deskripsi') }}</textarea>

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
                                Jumlah soal bebas. Tambahkan atau hapus sesuai kebutuhan.
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

                        @php

                            $oldQuestions =
                                old('questions');

                            if (
                                !is_array($oldQuestions) ||
                                count($oldQuestions) === 0
                            ) {

                                $oldQuestions = [
                                    [
                                        'pertanyaan' => ''
                                    ]
                                ];

                            }

                        @endphp


                        @foreach(
                            $oldQuestions
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
                                                Jawaban siswa berupa essay.
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


                                <textarea
                                    name="questions[{{ $index }}][pertanyaan]"
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
                                >{{ $question['pertanyaan'] ?? '' }}</textarea>

                            </div>

                        @endforeach

                    </div>


                    {{-- =================================================
                         EMPTY MESSAGE
                    ================================================== --}}

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
                                Klik "Tambah Soal" untuk membuat pertanyaan essay.
                            </p>

                        </div>

                    </div>

                </section>


                {{-- =================================================
                     ACTION
                ================================================== --}}

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
                        href="{{ route('guru.reflections.index') }}"
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

                        Simpan Refleksi

                    </button>

                </div>

            </form>

        </div>

    </main>


    {{-- =========================================================
         MODAL TAMBAH PERTEMUAN
    ========================================================== --}}

    <div
        id="meetingModal"
        class="
            fixed
            inset-0
            z-50
            hidden
            items-center
            justify-center
            p-4
            bg-slate-900/50
            modal-backdrop
        "
    >

        <div
            id="meetingModalPanel"
            class="
                w-full
                max-w-md
                bg-white
                rounded-3xl
                shadow-2xl
                border
                border-slate-200
                overflow-hidden
            "
        >

            {{-- HEADER MODAL --}}

            <div
                class="
                    px-6
                    py-5
                    border-b
                    border-slate-100
                    flex
                    items-center
                    justify-between
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
                        "
                    >
                        Pertemuan Refleksi
                    </div>

                    <h3
                        class="
                            mt-1
                            text-lg
                            font-black
                            text-slate-900
                        "
                    >
                        Tambah Pertemuan
                    </h3>

                </div>


                <button
                    type="button"
                    id="closeMeetingModal"
                    class="
                        w-9
                        h-9
                        rounded-xl
                        bg-slate-100
                        hover:bg-slate-200
                        text-slate-500
                        flex
                        items-center
                        justify-center
                        transition
                    "
                >

                    <i
                        data-lucide="x"
                        class="w-4 h-4"
                    ></i>

                </button>

            </div>


            {{-- FORM MEETING --}}

            <form
                method="POST"
                action="{{ route('guru.reflections.meetings.store') }}"
                id="meetingForm"
            >

                @csrf

                <div class="p-6">

                    <label
                        for="meeting_pertemuan"
                        class="
                            block
                            text-xs
                            font-bold
                            text-slate-600
                            mb-2
                        "
                    >
                        Nomor Pertemuan
                    </label>


                    <input
                        type="number"
                        id="meeting_pertemuan"
                        name="pertemuan"
                        min="1"
                        max="255"
                        step="1"
                        required
                        inputmode="numeric"
                        placeholder="Contoh: 1"
                        class="
                            w-full
                            h-12
                            px-4
                            border
                            border-slate-200
                            rounded-xl
                            bg-white
                            text-sm
                            font-bold
                            text-slate-800
                            outline-none
                            focus:border-blue-400
                            focus:ring-4
                            focus:ring-blue-50
                        "
                    >


                    <div
                        class="
                            mt-3
                            flex
                            items-start
                            gap-2
                            rounded-xl
                            bg-blue-50
                            border
                            border-blue-100
                            p-3
                        "
                    >

                        <i
                            data-lucide="info"
                            class="
                                w-4
                                h-4
                                text-blue-600
                                mt-0.5
                                shrink-0
                            "
                        ></i>

                        <p
                            class="
                                text-[11px]
                                leading-5
                                text-blue-700
                            "
                        >
                            Nomor pertemuan disimpan khusus untuk Refleksi
                            dan tidak bergantung pada Materi.
                        </p>

                    </div>

                </div>


                {{-- FOOTER MODAL --}}

                <div
                    class="
                        px-6
                        py-4
                        border-t
                        border-slate-100
                        bg-slate-50
                        flex
                        items-center
                        justify-end
                        gap-3
                    "
                >

                    <button
                        type="button"
                        id="cancelMeetingModal"
                        class="
                            px-4
                            py-2.5
                            rounded-xl
                            bg-white
                            border
                            border-slate-200
                            hover:bg-slate-50
                            text-slate-700
                            text-xs
                            font-bold
                            transition
                        "
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="
                            px-5
                            py-2.5
                            rounded-xl
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            text-xs
                            font-black
                            transition
                            shadow-sm
                            inline-flex
                            items-center
                            gap-2
                        "
                    >

                        <i
                            data-lucide="plus"
                            class="w-4 h-4"
                        ></i>

                        Tambahkan

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
         JAVASCRIPT
    ========================================================== --}}

    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                /*
                |--------------------------------------------------------------------------
                | ELEMENT
                |--------------------------------------------------------------------------
                */

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


                const meetingModal =
                    document.getElementById(
                        'meetingModal'
                    );

                const meetingInput =
                    document.getElementById(
                        'meeting_pertemuan'
                    );

                const openMeetingModal =
                    document.getElementById(
                        'openMeetingModal'
                    );

                const closeMeetingModal =
                    document.getElementById(
                        'closeMeetingModal'
                    );

                const cancelMeetingModal =
                    document.getElementById(
                        'cancelMeetingModal'
                    );

                const meetingModalPanel =
                    document.getElementById(
                        'meetingModalPanel'
                    );

                const meetingForm =
                    document.getElementById(
                        'meetingForm'
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
                | OPEN MODAL
                |--------------------------------------------------------------------------
                */

                function openMeeting() {

                    meetingModal.classList.remove(
                        'hidden'
                    );

                    meetingModal.classList.add(
                        'flex'
                    );

                    document.body.classList.add(
                        'overflow-hidden'
                    );

                    setTimeout(
                        function () {

                            meetingInput.focus();

                        },
                        100
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | CLOSE MODAL
                |--------------------------------------------------------------------------
                */

                function closeMeeting() {

                    meetingModal.classList.add(
                        'hidden'
                    );

                    meetingModal.classList.remove(
                        'flex'
                    );

                    document.body.classList.remove(
                        'overflow-hidden'
                    );

                    meetingForm.reset();

                }


                /*
                |--------------------------------------------------------------------------
                | BUTTON MODAL
                |--------------------------------------------------------------------------
                */

                openMeetingModal.addEventListener(
                    'click',
                    openMeeting
                );


                closeMeetingModal.addEventListener(
                    'click',
                    closeMeeting
                );


                cancelMeetingModal.addEventListener(
                    'click',
                    closeMeeting
                );


                /*
                |--------------------------------------------------------------------------
                | KLIK BACKDROP
                |--------------------------------------------------------------------------
                */

                meetingModal.addEventListener(
                    'click',
                    function (event) {

                        if (
                            event.target ===
                            meetingModal
                        ) {

                            closeMeeting();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | ESC
                |--------------------------------------------------------------------------
                */

                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Escape' &&
                            !meetingModal.classList.contains(
                                'hidden'
                            )
                        ) {

                            closeMeeting();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | VALIDASI MEETING
                |--------------------------------------------------------------------------
                */

                meetingForm.addEventListener(
                    'submit',
                    function (event) {

                        const value =
                            parseInt(
                                meetingInput.value,
                                10
                            );


                        if (
                            !Number.isInteger(
                                value
                            ) ||
                            value < 1 ||
                            value > 255
                        ) {

                            event.preventDefault();

                            alert(
                                'Nomor pertemuan harus berupa angka 1 sampai 255.'
                            );

                            meetingInput.focus();

                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | UPDATE NOMOR SOAL
                |--------------------------------------------------------------------------
                */

                function updateQuestionNumbers() {

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


                            if (textarea) {

                                textarea.name =
                                    `questions[${index}][pertanyaan]`;

                            }

                        }
                    );


                    /*
                    |--------------------------------------------------------------------------
                    | EMPTY STATE
                    |--------------------------------------------------------------------------
                    */

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

                        const index =
                            container.querySelectorAll(
                                '[data-question]'
                            ).length;


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
                                        ${index + 1}
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
                                            Jawaban siswa berupa essay.
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


                            <textarea
                                name="questions[${index}][pertanyaan]"
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
                            ></textarea>
                        `;


                        container.appendChild(
                            card
                        );


                        updateQuestionNumbers();

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


                        if (card) {

                            card.remove();

                        }


                        updateQuestionNumbers();

                        refreshIcons();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | VALIDASI FORM REFLEKSI
                |--------------------------------------------------------------------------
                */

                document
                    .getElementById(
                        'reflectionForm'
                    )
                    .addEventListener(
                        'submit',
                        function (event) {

                            const meeting =
                                document.getElementById(
                                    'pertemuan'
                                );


                            /*
                            |--------------------------------------------------------------------------
                            | VALIDASI PERTEMUAN
                            |--------------------------------------------------------------------------
                            */

                            if (
                                !meeting.value
                            ) {

                                event.preventDefault();

                                alert(
                                    'Silakan pilih atau buat Pertemuan terlebih dahulu.'
                                );

                                meeting.focus();

                                return;

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | VALIDASI SOAL
                            |--------------------------------------------------------------------------
                            */

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


                            let valid =
                                true;


                            cards.forEach(
                                function (
                                    card
                                ) {

                                    const textarea =
                                        card.querySelector(
                                            'textarea'
                                        );


                                    if (
                                        !textarea ||
                                        !textarea.value.trim()
                                    ) {

                                        valid =
                                            false;

                                        if (
                                            textarea
                                        ) {

                                            textarea.focus();

                                        }

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

                        }
                    );


                /*
                |--------------------------------------------------------------------------
                | INIT
                |--------------------------------------------------------------------------
                */

                updateQuestionNumbers();

                refreshIcons();

            }
        );

    </script>

</body>

</html>