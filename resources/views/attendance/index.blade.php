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
            color: rgba(255,255,255,.7);
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
                class="w-5 h-5"
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

                <div>

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
         STEP 1 — PILIH KELAS
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
                    Pilih kelas kamu terlebih dahulu.
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
                        data-pertemuan-aktif="{{ (int) ($class->pertemuan_aktif ?? 0) }}"
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
             CARI SISWA
        ====================================================== --}}

        <div
            id="studentSearchArea"
            class="opacity-50 pointer-events-none"
        >

            <div class="mb-3">

                <p class="text-sm font-semibold text-slate-700">
                    Cari Nama Kamu
                </p>

                <p class="text-xs text-slate-400 mt-1">
                    Data siswa akan menyesuaikan kelas yang dipilih.
                </p>

            </div>


            <div class="relative mb-5">

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
                    placeholder="Ketik nama kamu..."
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
                 STUDENTS
            ================================================== --}}

            <div
                id="studentList"
                class="
                    grid
                    grid-cols-1
                    sm:grid-cols-2
                    md:grid-cols-3
                    gap-3
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
                        data-name="{{ strtolower($student->nama) }}"
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
                                        $student->nama,
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
                                    · {{ $student->kelas }}
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
                    py-8
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
                    Pastikan kamu memilih kelas yang benar.
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
             DAFTAR PERTEMUAN
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

            @for($i = 1; $i <= 8; $i++)

                <button
                    type="button"
                    class="
                        meeting-btn
                        hidden
                        rounded-2xl
                        border
                        p-4
                        text-center
                    "
                    data-meeting="{{ $i }}"
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
                            {{ $i }}
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


                <div
                    class="
                        meeting-lock
                        hidden
                        border
                        border-slate-200
                        bg-slate-50
                        text-slate-400
                        rounded-2xl
                        p-4
                        text-center
                    "
                    data-lock-meeting="{{ $i }}"
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
                            data-lucide="lock"
                            class="w-4 h-4"
                        ></i>


                        <span class="text-lg font-bold">
                            {{ $i }}
                        </span>

                    </div>


                    <span
                        class="
                            block
                            text-xs
                            font-medium
                            mt-1
                        "
                    >
                        Terkunci
                    </span>

                </div>

            @endfor

        </div>


        {{-- =====================================================
             BELUM ADA PERTEMUAN
        ====================================================== --}}

        <div
            id="noMeeting"
            class="
                hidden
                mt-5
                rounded-2xl
                border
                border-amber-200
                bg-amber-50
                px-5
                py-4
                text-sm
                text-amber-700
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
             FORM
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

    const noMeeting =
        document.getElementById('noMeeting');

    const meetingButtons =
        document.querySelectorAll('.meeting-btn');

    const meetingLocks =
        document.querySelectorAll('.meeting-lock');


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
    | RESET PERTEMUAN
    |--------------------------------------------------------------------------
    */

    function resetMeetings() {

        selectedMeetingNumber = null;

        meetingIdInput.value = '';

        selectedMeeting.textContent = '-';


        meetingButtons.forEach(button => {

            button.classList.add('hidden');

            button.classList.remove('selected');

        });


        meetingLocks.forEach(lock => {

            lock.classList.add('hidden');

        });


        noMeeting.classList.add('hidden');

        noMeeting.classList.remove('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN PERTEMUAN SESUAI KELAS
    |--------------------------------------------------------------------------
    */

    function renderMeetings(pertemuanAktif) {

        resetMeetings();


        pertemuanAktif =
            parseInt(
                pertemuanAktif || 0,
                10
            );


        /*
        |--------------------------------------------------------------------------
        | BELUM ADA YANG DIBUKA
        |--------------------------------------------------------------------------
        */

        if (pertemuanAktif <= 0) {

            for (
                let i = 1;
                i <= 8;
                i++
            ) {

                const lock =
                    document.querySelector(
                        `[data-lock-meeting="${i}"]`
                    );


                if (lock) {

                    lock.classList.remove(
                        'hidden'
                    );

                }

            }


            noMeeting.classList.remove(
                'hidden'
            );

            noMeeting.classList.add(
                'flex'
            );


            return;
        }


        /*
        |--------------------------------------------------------------------------
        | PERTEMUAN YANG SUDAH DIBUKA
        |--------------------------------------------------------------------------
        */

        for (
            let i = 1;
            i <= 8;
            i++
        ) {

            const button =
                document.querySelector(
                    `[data-meeting="${i}"]`
                );

            const lock =
                document.querySelector(
                    `[data-lock-meeting="${i}"]`
                );


            if (i <= pertemuanAktif) {

                /*
                | Terbuka
                */

                if (button) {

                    button.classList.remove(
                        'hidden'
                    );

                    button.classList.add(
                        'open'
                    );

                }


                if (lock) {

                    lock.classList.add(
                        'hidden'
                    );

                }

            } else {

                /*
                | Terkunci
                */

                if (button) {

                    button.classList.add(
                        'hidden'
                    );

                }


                if (lock) {

                    lock.classList.remove(
                        'hidden'
                    );

                }

            }

        }

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
                | PILIH KELAS
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
                | AMBIL pertemuan_aktif DARI classes
                |--------------------------------------------------------------------------
                */

                const pertemuanAktif =
                    parseInt(
                        this.dataset.pertemuanAktif || '0',
                        10
                    );


                /*
                |--------------------------------------------------------------------------
                | AKTIFKAN PENCARIAN SISWA
                |--------------------------------------------------------------------------
                */

                studentSearchArea.classList.remove(
                    'opacity-50',
                    'pointer-events-none'
                );


                searchInput.value = '';


                /*
                |--------------------------------------------------------------------------
                | FILTER SISWA
                |--------------------------------------------------------------------------
                */

                const selectedNormalized =
                    normalizeClass(
                        selectedClassName
                    );


                let visibleCount = 0;


                studentCards.forEach(card => {

                    card.classList.remove(
                        'selected'
                    );


                    const studentClass =
                        normalizeClass(
                            card.dataset.class
                        );


                    if (
                        studentClass ===
                        selectedNormalized
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
                | RENDER PERTEMUAN KELAS TERPILIH
                |--------------------------------------------------------------------------
                */

                renderMeetings(
                    pertemuanAktif
                );


                /*
                |--------------------------------------------------------------------------
                | KUNCI STEP 2 SAMPAI SISWA DIPILIH
                |--------------------------------------------------------------------------
                */

                attendanceSection.classList.add(
                    'opacity-50',
                    'pointer-events-none'
                );


                /*
                |--------------------------------------------------------------------------
                | KUNCI STEP 3
                |--------------------------------------------------------------------------
                */

                confirmSection.classList.add(
                    'opacity-50',
                    'pointer-events-none'
                );


                /*
                |--------------------------------------------------------------------------
                | PESAN SISWA
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


            let visibleCount = 0;


            studentCards.forEach(card => {

                const name =
                    card.dataset.name;


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

                attendanceSection.classList.remove(
                    'opacity-50',
                    'pointer-events-none'
                );


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
                | RESET
                |--------------------------------------------------------------------------
                */

                meetingButtons.forEach(item => {

                    item.classList.remove(
                        'selected'
                    );

                });


                /*
                |--------------------------------------------------------------------------
                | PILIH
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

                confirmSection.classList.remove(
                    'opacity-50',
                    'pointer-events-none'
                );


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
                        'Silakan pilih kelas, nama siswa, dan pertemuan terlebih dahulu.'
                    );

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | INITIAL STATE
    |--------------------------------------------------------------------------
    */

    resetMeetings();


    /*
    |--------------------------------------------------------------------------
    | RE-INIT ICON
    |--------------------------------------------------------------------------
    */

    lucide.createIcons();

</script>

</body>

</html>