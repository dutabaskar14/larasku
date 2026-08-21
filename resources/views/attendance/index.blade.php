<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Absensi — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            font-family: 'DM Sans', 'Inter', sans-serif;
        }

        body {
            background: #f4f7fb;
        }

        .student-card,
        .meeting-btn,
        .class-btn {
            transition: all .2s ease;
        }

        .student-card:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
            box-shadow: 0 8px 20px rgba(15, 23, 42, .07);
        }

        .student-card.selected {
            border-color: #2563eb;
            background: #eff6ff;
        }

        .class-btn.selected {
            border-color: #2563eb;
            background: #2563eb;
            color: white;
        }

        .class-btn.selected span:first-child {
            color: rgba(255, 255, 255, .7);
        }

        .meeting-btn:hover {
            border-color: #93c5fd;
            background: #eff6ff;
        }

        .meeting-btn.selected {
            border-color: #2563eb;
            background: #2563eb;
            color: white;
        }

        .meeting-btn.open {
            border-color: #bbf7d0;
            background: #f0fdf4;
            color: #15803d;
        }

        .meeting-btn.open:hover {
            border-color: #86efac;
            background: #dcfce7;
        }

        .search-empty {
            min-height: 170px;
        }

        .student-results {
            max-height: 420px;
            overflow-y: auto;
        }

        .student-results::-webkit-scrollbar {
            width: 6px;
        }

        .student-results::-webkit-scrollbar-track {
            background: transparent;
        }

        .student-results::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }
    </style>
</head>


<body class="min-h-screen text-slate-800">

<div class="max-w-5xl mx-auto px-5 py-8">

    {{-- =========================================================
         HEADER
    ========================================================== --}}

    <div class="text-center mb-8">

        <div
            class="
                inline-flex
                items-center
                justify-center
                w-14
                h-14
                rounded-2xl
                bg-blue-600
                shadow-lg
                mb-4
            "
        >
            <i
                data-lucide="graduation-cap"
                class="w-7 h-7 text-white"
            ></i>
        </div>

        <h1 class="text-3xl font-bold text-slate-900">
            LARASKU
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Absensi Pembelajaran
        </p>

    </div>


    {{-- =========================================================
         SUCCESS
    ========================================================== --}}

    @if(session('success'))

        <div
            class="
                mb-6
                flex
                items-center
                gap-3
                rounded-2xl
                border
                border-green-200
                bg-green-50
                px-5
                py-4
                text-sm
                text-green-700
            "
        >

            <i
                data-lucide="circle-check"
                class="w-5 h-5 shrink-0"
            ></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
         ERROR
    ========================================================== --}}

    @if($errors->any())

        <div
            class="
                mb-6
                rounded-2xl
                border
                border-red-200
                bg-red-50
                px-5
                py-4
                text-sm
                text-red-700
            "
        >

            <div class="flex items-start gap-3">

                <i
                    data-lucide="circle-alert"
                    class="w-5 h-5 shrink-0 mt-0.5"
                ></i>

                <div class="space-y-1">

                    @foreach($errors->all() as $error)

                        <p>
                            {{ $error }}
                        </p>

                    @endforeach

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
         STEP 1 — PILIH KELAS & CARI SISWA
    ========================================================== --}}

    <section
        class="
            bg-white
            border
            border-slate-200
            rounded-3xl
            shadow-sm
            p-6
            md:p-8
            mb-6
        "
    >

        <div class="flex items-start gap-4 mb-6">

            <div
                class="
                    w-10
                    h-10
                    rounded-xl
                    bg-blue-50
                    text-blue-600
                    flex
                    items-center
                    justify-center
                    font-bold
                    shrink-0
                "
            >
                1
            </div>

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Pilih Kelas
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Pilih kelas terlebih dahulu, kemudian cari nama siswa.
                </p>

            </div>

        </div>


        {{-- =====================================================
             KELAS DARI DATABASE
        ====================================================== --}}

        @if($classes->isEmpty())

            <div
                class="
                    rounded-2xl
                    border
                    border-amber-200
                    bg-amber-50
                    p-5
                    text-sm
                    text-amber-700
                "
            >

                <div class="flex items-center gap-3">

                    <i
                        data-lucide="school"
                        class="w-5 h-5"
                    ></i>

                    <span>
                        Belum ada kelas yang tersedia.
                    </span>

                </div>

            </div>

        @else

            <div
                class="
                    grid
                    grid-cols-2
                    sm:grid-cols-3
                    md:grid-cols-4
                    gap-3
                    mb-6
                "
            >

                @foreach($classes as $class)

                    <button
                        type="button"
                        class="
                            class-btn
                            border
                            border-slate-200
                            rounded-2xl
                            p-4
                            text-center
                            bg-white
                        "
                        data-class="{{ $class->nama }}"
                    >

                        <span
                            class="
                                block
                                text-xs
                                text-slate-400
                                mb-1
                            "
                        >
                            Kelas
                        </span>

                        <span class="text-lg font-bold">
                            {{ $class->nama }}
                        </span>

                    </button>

                @endforeach

            </div>

        @endif


        {{-- =====================================================
             AREA PENCARIAN SISWA
        ====================================================== --}}

        <div
            id="studentSearchArea"
            class="
                opacity-50
                pointer-events-none
            "
        >

            <div class="mb-3">

                <p class="text-sm font-semibold text-slate-700">
                    Cari Nama Siswa
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Ketik nama siswa untuk menampilkan hasil pencarian.
                </p>

            </div>


            {{-- SEARCH INPUT --}}

            <div class="relative">

                <i
                    data-lucide="search"
                    class="
                        absolute
                        left-4
                        top-1/2
                        -translate-y-1/2
                        w-5
                        h-5
                        text-slate-400
                    "
                ></i>

                <input
                    id="studentSearch"
                    type="text"
                    placeholder="Ketik nama siswa untuk mencari..."
                    autocomplete="off"
                    class="
                        w-full
                        pl-12
                        pr-4
                        py-4
                        rounded-2xl
                        border
                        border-slate-200
                        bg-slate-50
                        text-base
                        focus:outline-none
                        focus:bg-white
                        focus:border-blue-500
                        focus:ring-4
                        focus:ring-blue-100
                    "
                >

            </div>


            {{-- =================================================
                 PESAN AWAL
            ================================================== --}}

            <div
                id="searchInstruction"
                class="
                    search-empty
                    flex
                    flex-col
                    items-center
                    justify-center
                    text-center
                    py-10
                    text-slate-400
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
                        mb-4
                    "
                >

                    <i
                        data-lucide="search"
                        class="w-7 h-7"
                    ></i>

                </div>

                <p class="text-sm font-semibold text-slate-600">
                    Cari nama siswa
                </p>

                <p class="text-xs mt-1">
                    Ketik nama siswa terlebih dahulu.
                </p>

            </div>


            {{-- =================================================
                 STUDENT RESULTS
            ================================================== --}}

            <div
                id="studentList"
                class="
                    student-results
                    grid
                    grid-cols-1
                    sm:grid-cols-2
                    md:grid-cols-3
                    gap-3
                    mt-4
                "
            >

                @forelse($students as $student)

                    <button
                        type="button"
                        class="
                            student-card
                            text-left
                            bg-white
                            border
                            border-slate-200
                            rounded-2xl
                            p-4
                            hidden
                        "
                        data-id="{{ $student->id }}"
                        data-name="{{ strtolower(trim($student->nama)) }}"
                        data-class="{{ strtoupper(trim($student->kelas)) }}"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="
                                    w-11
                                    h-11
                                    rounded-full
                                    bg-blue-50
                                    text-blue-600
                                    flex
                                    items-center
                                    justify-center
                                    font-bold
                                    shrink-0
                                "
                            >
                                {{ strtoupper(
                                    substr(
                                        trim($student->nama),
                                        0,
                                        1
                                    )
                                ) }}
                            </div>


                            <div class="min-w-0">

                                <p
                                    class="
                                        student-name
                                        font-semibold
                                        text-slate-800
                                        truncate
                                    "
                                >
                                    {{ $student->nama }}
                                </p>

                                <p
                                    class="
                                        text-xs
                                        text-slate-400
                                        mt-0.5
                                    "
                                >
                                    Absen {{ $student->nomor_absen }}
                                    ·
                                    {{ $student->kelas }}
                                </p>

                            </div>

                        </div>

                    </button>

                @empty

                    <div
                        class="
                            col-span-full
                            text-center
                            py-10
                            text-slate-400
                        "
                    >

                        <i
                            data-lucide="users-round"
                            class="w-8 h-8 mx-auto mb-2"
                        ></i>

                        <p>
                            Belum ada data siswa.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- =================================================
                 TIDAK DITEMUKAN
            ================================================== --}}

            <div
                id="noStudent"
                class="
                    hidden
                    text-center
                    py-10
                    text-slate-400
                "
            >

                <i
                    data-lucide="user-round-x"
                    class="w-8 h-8 mx-auto mb-2"
                ></i>

                <p class="text-sm font-medium">
                    Nama siswa tidak ditemukan.
                </p>

                <p class="text-xs mt-1">
                    Coba ketik nama lain atau periksa kelas yang dipilih.
                </p>

            </div>

        </div>

    </section>


    {{-- =========================================================
         STEP 2 — PERTEMUAN
    ========================================================== --}}

    <section
        id="attendanceSection"
        class="
            bg-white
            border
            border-slate-200
            rounded-3xl
            shadow-sm
            p-6
            md:p-8
            mb-6
            opacity-50
            pointer-events-none
        "
    >

        <div class="flex items-start gap-4 mb-6">

            <div
                class="
                    w-10
                    h-10
                    rounded-xl
                    bg-blue-50
                    text-blue-600
                    flex
                    items-center
                    justify-center
                    font-bold
                    shrink-0
                "
            >
                2
            </div>

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Pilih Pertemuan
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Pilih pertemuan yang sudah dibuka oleh guru.
                </p>

            </div>

        </div>


        {{-- =====================================================
             DAFTAR PERTEMUAN DARI DATABASE
        ====================================================== --}}

        <div
            id="meetingList"
            class="
                grid
                grid-cols-2
                sm:grid-cols-4
                gap-3
            "
        >

            @forelse($meetings as $meeting)

                <button
                    type="button"
                    class="
                        meeting-btn
                        open
                        rounded-2xl
                        border
                        p-4
                        text-center
                    "
                    data-meeting="{{ $meeting->pertemuan }}"
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-center
                            gap-2
                        "
                    >

                        <i
                            data-lucide="unlock"
                            class="meeting-icon w-4 h-4"
                        ></i>

                        <span class="text-lg font-bold">
                            {{ $meeting->pertemuan }}
                        </span>

                    </div>

                    <span
                        class="
                            meeting-label
                            block
                            text-xs
                            font-medium
                            mt-1
                        "
                    >
                        Pertemuan
                    </span>

                </button>

            @empty

                <div
                    class="
                        col-span-full
                        rounded-2xl
                        border
                        border-amber-200
                        bg-amber-50
                        px-5
                        py-4
                        text-sm
                        text-amber-700
                        flex
                        items-center
                        gap-3
                    "
                >

                    <i
                        data-lucide="lock-keyhole"
                        class="w-5 h-5 shrink-0"
                    ></i>

                    <span>
                        Belum ada pertemuan yang dibuka oleh guru.
                    </span>

                </div>

            @endforelse

        </div>

    </section>


    {{-- =========================================================
         STEP 3 — KONFIRMASI
    ========================================================== --}}

    <section
        id="confirmSection"
        class="
            bg-white
            border
            border-slate-200
            rounded-3xl
            shadow-sm
            p-6
            md:p-8
            opacity-50
            pointer-events-none
        "
    >

        <div class="flex items-start gap-4 mb-6">

            <div
                class="
                    w-10
                    h-10
                    rounded-xl
                    bg-green-50
                    text-green-600
                    flex
                    items-center
                    justify-center
                    font-bold
                    shrink-0
                "
            >
                3
            </div>

            <div>

                <h2 class="text-lg font-bold text-slate-900">
                    Konfirmasi Kehadiran
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Pastikan nama, kelas, dan pertemuan sudah benar.
                </p>

            </div>

        </div>


        {{-- =====================================================
             RINGKASAN
        ====================================================== --}}

        <div
            class="
                bg-slate-50
                rounded-2xl
                p-5
                mb-5
            "
        >

            <div
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-3
                    gap-5
                "
            >

                <div>

                    <p class="text-xs text-slate-400">
                        Nama Siswa
                    </p>

                    <p
                        id="selectedStudentName"
                        class="
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        -
                    </p>

                </div>


                <div class="sm:text-center">

                    <p class="text-xs text-slate-400">
                        Kelas
                    </p>

                    <p
                        id="selectedClass"
                        class="
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        -
                    </p>

                </div>


                <div class="sm:text-right">

                    <p class="text-xs text-slate-400">
                        Pertemuan
                    </p>

                    <p
                        id="selectedMeeting"
                        class="
                            font-bold
                            text-slate-900
                            mt-1
                        "
                    >
                        -
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM ABSENSI
        ====================================================== --}}

        <form
            id="attendanceForm"
            action="{{ route('attendance.store') }}"
            method="POST"
        >

            @csrf

            <input
                type="hidden"
                name="student_id"
                id="studentId"
            >

            <input
                type="hidden"
                name="kelas"
                id="classId"
            >

            <input
                type="hidden"
                name="pertemuan"
                id="meetingId"
            >

            <button
                type="submit"
                class="
                    w-full
                    flex
                    items-center
                    justify-center
                    gap-2
                    bg-blue-600
                    hover:bg-blue-700
                    text-white
                    rounded-2xl
                    py-4
                    font-bold
                    shadow-lg
                    shadow-blue-100
                    transition
                "
            >

                <i
                    data-lucide="check-circle"
                    class="w-5 h-5"
                ></i>

                Tandai Saya Hadir

            </button>

        </form>

    </section>

</div>


<script>

    /*
    |--------------------------------------------------------------------------
    | ICON
    |--------------------------------------------------------------------------
    */

    lucide.createIcons();


    /*
    |--------------------------------------------------------------------------
    | ELEMENT
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('studentSearch');

    const studentCards =
        document.querySelectorAll('.student-card');

    const classButtons =
        document.querySelectorAll('.class-btn');

    const studentSearchArea =
        document.getElementById('studentSearchArea');

    const studentList =
        document.getElementById('studentList');

    const searchInstruction =
        document.getElementById('searchInstruction');

    const noStudent =
        document.getElementById('noStudent');

    const attendanceSection =
        document.getElementById('attendanceSection');

    const confirmSection =
        document.getElementById('confirmSection');

    const studentIdInput =
        document.getElementById('studentId');

    const classIdInput =
        document.getElementById('classId');

    const meetingIdInput =
        document.getElementById('meetingId');

    const selectedStudentName =
        document.getElementById('selectedStudentName');

    const selectedClass =
        document.getElementById('selectedClass');

    const selectedMeeting =
        document.getElementById('selectedMeeting');

    const meetingButtons =
        document.querySelectorAll('.meeting-btn');


    /*
    |--------------------------------------------------------------------------
    | STATE
    |--------------------------------------------------------------------------
    */

    let selectedStudent = null;
    let selectedClassName = null;
    let selectedMeetingNumber = null;


    /*
    |--------------------------------------------------------------------------
    | NORMALISASI KELAS
    |--------------------------------------------------------------------------
    */

    function normalizeClass(value) {

        return String(value || '')
            .toUpperCase()
            .replace(/[\s_-]+/g, '');

    }


    /*
    |--------------------------------------------------------------------------
    | RESET HASIL PENCARIAN
    |--------------------------------------------------------------------------
    */

    function resetStudentSearch() {

        searchInput.value = '';

        studentCards.forEach(card => {

            card.classList.add('hidden');
            card.classList.remove('selected');

        });

        noStudent.classList.add('hidden');

        searchInstruction.classList.remove('hidden');

    }


    /*
    |--------------------------------------------------------------------------
    | RESET PERTEMUAN
    |--------------------------------------------------------------------------
    */

    function resetMeetings() {

        selectedMeetingNumber = null;

        meetingIdInput.value = '';

        selectedMeeting.textContent = '-';

        meetingButtons.forEach(button => {

            button.classList.remove('selected');

        });

    }


    /*
    |--------------------------------------------------------------------------
    | RESET STEP 2 & 3
    |--------------------------------------------------------------------------
    */

    function lockAttendance() {

        attendanceSection.classList.add(
            'opacity-50',
            'pointer-events-none'
        );

    }


    function unlockAttendance() {

        attendanceSection.classList.remove(
            'opacity-50',
            'pointer-events-none'
        );

    }


    function lockConfirmation() {

        confirmSection.classList.add(
            'opacity-50',
            'pointer-events-none'
        );

    }


    function unlockConfirmation() {

        confirmSection.classList.remove(
            'opacity-50',
            'pointer-events-none'
        );

    }


    /*
    |--------------------------------------------------------------------------
    | PILIH KELAS
    |--------------------------------------------------------------------------
    */

    classButtons.forEach(button => {

        button.addEventListener(
            'click',
            function () {

                /*
                |--------------------------------------------------------------------------
                | RESET KELAS
                |--------------------------------------------------------------------------
                */

                classButtons.forEach(item => {

                    item.classList.remove(
                        'selected'
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | AKTIFKAN KELAS
                |--------------------------------------------------------------------------
                */

                this.classList.add(
                    'selected'
                );


                selectedClassName =
                    this.dataset.class;


                classIdInput.value =
                    selectedClassName;


                /*
                |--------------------------------------------------------------------------
                | AKTIFKAN AREA PENCARIAN
                |--------------------------------------------------------------------------
                */

                studentSearchArea.classList.remove(
                    'opacity-50',
                    'pointer-events-none'
                );


                /*
                |--------------------------------------------------------------------------
                | PENTING:
                | SEMUA NAMA TETAP TERSEMBUNYI
                |--------------------------------------------------------------------------
                */

                resetStudentSearch();


                /*
                |--------------------------------------------------------------------------
                | RESET SISWA
                |--------------------------------------------------------------------------
                */

                selectedStudent = null;

                studentIdInput.value = '';

                selectedStudentName.textContent =
                    '-';

                selectedClass.textContent =
                    selectedClassName;


                /*
                |--------------------------------------------------------------------------
                | RESET PERTEMUAN
                |--------------------------------------------------------------------------
                */

                resetMeetings();


                /*
                |--------------------------------------------------------------------------
                | KUNCI STEP 2
                |--------------------------------------------------------------------------
                */

                lockAttendance();


                /*
                |--------------------------------------------------------------------------
                | KUNCI STEP 3
                |--------------------------------------------------------------------------
                */

                lockConfirmation();


                /*
                |--------------------------------------------------------------------------
                | FOCUS SEARCH
                |--------------------------------------------------------------------------
                */

                setTimeout(() => {

                    searchInput.focus();

                }, 150);


                /*
                |--------------------------------------------------------------------------
                | SCROLL
                |--------------------------------------------------------------------------
                */

                studentSearchArea.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | CARI SISWA
    |--------------------------------------------------------------------------
    |
    | Nama siswa HANYA muncul setelah keyword diketik.
    |
    */

    searchInput.addEventListener(
        'input',
        function () {

            const keyword =
                this.value
                    .toLowerCase()
                    .trim();


            const selectedNormalized =
                normalizeClass(
                    selectedClassName
                );


            /*
            |--------------------------------------------------------------------------
            | BELUM MENGETIK
            |--------------------------------------------------------------------------
            */

            if (
                !selectedClassName ||
                keyword.length === 0
            ) {

                studentCards.forEach(card => {

                    card.classList.add(
                        'hidden'
                    );

                });

                noStudent.classList.add(
                    'hidden'
                );

                searchInstruction.classList.remove(
                    'hidden'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | SUDAH MENGETIK
            |--------------------------------------------------------------------------
            */

            searchInstruction.classList.add(
                'hidden'
            );


            let visibleCount = 0;


            studentCards.forEach(card => {

                const name =
                    String(
                        card.dataset.name || ''
                    ).toLowerCase();


                const studentClass =
                    normalizeClass(
                        card.dataset.class
                    );


                const sameClass =
                    studentClass ===
                    selectedNormalized;


                const sameName =
                    name.includes(
                        keyword
                    );


                if (
                    sameClass &&
                    sameName
                ) {

                    card.classList.remove(
                        'hidden'
                    );

                    visibleCount++;

                } else {

                    card.classList.add(
                        'hidden'
                    );

                }

            });


            /*
            |--------------------------------------------------------------------------
            | HASIL TIDAK DITEMUKAN
            |--------------------------------------------------------------------------
            */

            if (
                visibleCount === 0
            ) {

                noStudent.classList.remove(
                    'hidden'
                );

            } else {

                noStudent.classList.add(
                    'hidden'
                );

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | PILIH SISWA
    |--------------------------------------------------------------------------
    */

    studentCards.forEach(card => {

        card.addEventListener(
            'click',
            function () {

                /*
                |--------------------------------------------------------------------------
                | RESET SISWA LAIN
                |--------------------------------------------------------------------------
                */

                studentCards.forEach(item => {

                    item.classList.remove(
                        'selected'
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | PILIH SISWA
                |--------------------------------------------------------------------------
                */

                this.classList.add(
                    'selected'
                );


                selectedStudent = {

                    id:
                        this.dataset.id,

                    name:
                        this
                            .querySelector(
                                '.student-name'
                            )
                            .textContent
                            .trim(),

                    class:
                        this.dataset.class

                };


                /*
                |--------------------------------------------------------------------------
                | FORM
                |--------------------------------------------------------------------------
                */

                studentIdInput.value =
                    selectedStudent.id;

                classIdInput.value =
                    selectedClassName;


                /*
                |--------------------------------------------------------------------------
                | RINGKASAN
                |--------------------------------------------------------------------------
                */

                selectedStudentName.textContent =
                    selectedStudent.name;

                selectedClass.textContent =
                    selectedClassName;


                /*
                |--------------------------------------------------------------------------
                | AKTIFKAN STEP 2
                |--------------------------------------------------------------------------
                */

                unlockAttendance();


                /*
                |--------------------------------------------------------------------------
                | STEP 3 TETAP TERKUNCI
                |--------------------------------------------------------------------------
                */

                lockConfirmation();


                /*
                |--------------------------------------------------------------------------
                | SCROLL
                |--------------------------------------------------------------------------
                */

                attendanceSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | PILIH PERTEMUAN
    |--------------------------------------------------------------------------
    */

    meetingButtons.forEach(button => {

        button.addEventListener(
            'click',
            function () {

                /*
                |--------------------------------------------------------------------------
                | PASTIKAN SISWA SUDAH DIPILIH
                |--------------------------------------------------------------------------
                */

                if (
                    !selectedStudent ||
                    !studentIdInput.value
                ) {

                    alert(
                        'Silakan cari dan pilih nama siswa terlebih dahulu.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | RESET PERTEMUAN LAIN
                |--------------------------------------------------------------------------
                */

                meetingButtons.forEach(item => {

                    item.classList.remove(
                        'selected'
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | PILIH PERTEMUAN
                |--------------------------------------------------------------------------
                */

                this.classList.add(
                    'selected'
                );


                selectedMeetingNumber =
                    this.dataset.meeting;


                meetingIdInput.value =
                    selectedMeetingNumber;


                /*
                |--------------------------------------------------------------------------
                | RINGKASAN
                |--------------------------------------------------------------------------
                */

                selectedMeeting.textContent =
                    'Pertemuan ' +
                    selectedMeetingNumber;


                /*
                |--------------------------------------------------------------------------
                | AKTIFKAN STEP 3
                |--------------------------------------------------------------------------
                */

                unlockConfirmation();


                /*
                |--------------------------------------------------------------------------
                | SCROLL
                |--------------------------------------------------------------------------
                */

                confirmSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

            }
        );

    });


    /*
    |--------------------------------------------------------------------------
    | VALIDASI SUBMIT
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('attendanceForm')
        .addEventListener(
            'submit',
            function (event) {

                if (
                    !studentIdInput.value ||
                    !classIdInput.value ||
                    !meetingIdInput.value
                ) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih kelas, cari nama siswa, pilih nama siswa, dan pilih pertemuan terlebih dahulu.'
                    );

                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | KONFIRMASI TERAKHIR
                |--------------------------------------------------------------------------
                */

                const confirmed =
                    confirm(
                        'Tandai ' +
                        selectedStudentName.textContent +
                        ' sebagai HADIR pada ' +
                        selectedMeeting.textContent +
                        '?'
                    );


                if (!confirmed) {

                    event.preventDefault();

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    |
    | Saat halaman pertama dibuka:
    | - tidak ada siswa tampil
    | - search belum aktif
    | - pertemuan terkunci
    | - konfirmasi terkunci
    |
    */

    resetStudentSearch();

    resetMeetings();

    lockAttendance();

    lockConfirmation();


    /*
    |--------------------------------------------------------------------------
    | ICON
    |--------------------------------------------------------------------------
    */

    lucide.createIcons();

</script>

</body>

</html>