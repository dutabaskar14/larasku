<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Refleksi Pembelajaran — LARASKU</title>

    {{-- =====================================================
         SIDEBAR SUPPORT
    ====================================================== --}}

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;

            background: #f5f7fb;

            color: #1e293b;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }


        /* =====================================================
           AREA KONTEN SETELAH SIDEBAR
        ====================================================== */

        #studentMainContent {
            margin-left: 256px;

            min-height: 100vh;
        }


        /* =====================================================
           TOPBAR
        ====================================================== */

        .topbar {
            height: 74px;

            background: #fff;

            border-bottom:
                1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 34px;

            position: sticky;

            top: 0;

            z-index: 20;
        }


        .brand {
            font-size: 22px;

            font-weight: 900;

            color: #0f172a;
        }


        .brand span {
            display: block;

            margin-top: 2px;

            font-size: 11px;

            font-weight: 600;

            color: #94a3b8;
        }


        .badge {
            padding: 8px 13px;

            background: #f8fafc;

            border:
                1px solid #e2e8f0;

            border-radius: 10px;

            font-size: 12px;

            font-weight: 750;

            color: #64748b;
        }


        .container {
            width:
                min(
                    1000px,
                    calc(100% - 36px)
                );

            margin: auto;

            padding: 35px 0 60px;
        }


        .header {
            margin-bottom: 25px;
        }


        .eyebrow {
            color: #2563eb;

            font-size: 12px;

            font-weight: 850;

            text-transform: uppercase;

            letter-spacing: .1em;

            margin-bottom: 7px;
        }


        .title {
            margin: 0;

            font-size: 34px;

            font-weight: 900;

            letter-spacing: -.04em;

            color: #0f172a;
        }


        .description {
            margin-top: 8px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;
        }


        .meetings {
            display: flex;

            gap: 8px;

            overflow-x: auto;

            padding-bottom: 5px;

            margin-bottom: 22px;
        }


        .meeting {
            flex: 0 0 auto;

            text-decoration: none;

            padding: 10px 15px;

            border-radius: 11px;

            background: #fff;

            border:
                1px solid #e2e8f0;

            color: #64748b;

            font-size: 13px;

            font-weight: 750;
        }


        .meeting.active {
            background: #0f172a;

            border-color: #0f172a;

            color: #fff;
        }


        .card {
            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 20px;

            box-shadow:
                0 5px 22px
                rgba(15, 23, 42, .035);

            overflow: hidden;
        }


        .card-header {
            padding: 26px 28px;

            border-bottom:
                1px solid #f1f5f9;
        }


        .meeting-label {
            display: inline-flex;

            padding: 6px 10px;

            border-radius: 8px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 11px;

            font-weight: 850;

            text-transform: uppercase;
        }


        .meeting-title {
            margin: 12px 0 0;

            font-size: 22px;

            font-weight: 850;

            color: #0f172a;
        }


        .form {
            padding: 28px;
        }


        /* =========================================================
           IDENTITAS SISWA
        ========================================================= */

        .student-box {
            padding: 20px;

            margin-bottom: 28px;

            background: #f8fafc;

            border:
                1px solid #e2e8f0;

            border-radius: 16px;
        }


        .student-box-title {
            margin-bottom: 16px;

            color: #0f172a;

            font-size: 14px;

            font-weight: 850;
        }


        .identity {
            display: grid;

            grid-template-columns:
                1fr 180px;

            gap: 15px;
        }


        .field label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 13px;

            font-weight: 800;
        }


        input,
        textarea,
        select {
            width: 100%;

            border:
                1px solid #dbe2ea;

            border-radius: 11px;

            padding: 12px 13px;

            background: #fff;

            color: #0f172a;

            font-family: inherit;

            font-size: 14px;

            outline: none;

            transition: .18s ease;
        }


        input:focus,
        textarea:focus,
        select:focus {
            border-color: #60a5fa;

            box-shadow:
                0 0 0 3px
                rgba(59, 130, 246, .10);
        }


        input[readonly] {
            background: #f1f5f9;

            color: #475569;

            cursor: default;
        }


        .search-box {
            position: relative;
        }


        .search-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            color: #94a3b8;

            pointer-events: none;
        }


        .search-box input {
            padding-left: 38px;
        }


        .student-results {
            margin-top: 10px;

            display: none;

            max-height: 240px;

            overflow-y: auto;

            background: #fff;

            border:
                1px solid #e2e8f0;

            border-radius: 12px;

            box-shadow:
                0 10px 25px
                rgba(15, 23, 42, .08);

            position: relative;

            z-index: 100;
        }


        .student-result {
            width: 100%;

            border: 0;

            border-bottom:
                1px solid #f1f5f9;

            background: #fff;

            padding: 13px 15px;

            text-align: left;

            cursor: pointer;

            transition: .15s ease;
        }


        .student-result:last-child {
            border-bottom: 0;
        }


        .student-result:hover {
            background: #f8fafc;
        }


        .student-name {
            display: block;

            color: #0f172a;

            font-size: 14px;

            font-weight: 800;
        }


        .student-info {
            display: block;

            margin-top: 3px;

            color: #64748b;

            font-size: 12px;
        }


        .selected-student {
            display: none;

            margin-top: 12px;

            padding: 13px 15px;

            background: #eff6ff;

            border:
                1px solid #bfdbfe;

            border-radius: 11px;

            color: #1e3a8a;

            font-size: 13px;

            font-weight: 700;
        }


        .selected-student strong {
            color: #1e40af;
        }


        .question {
            padding: 20px 0;

            border-top:
                1px solid #f1f5f9;
        }


        .question:first-child {
            border-top: 0;
        }


        .question-number {
            color: #2563eb;

            font-size: 12px;

            font-weight: 850;

            margin-bottom: 6px;
        }


        .question-text {
            margin-bottom: 11px;

            color: #1e293b;

            font-size: 15px;

            line-height: 1.65;

            font-weight: 750;
        }


        textarea {
            min-height: 125px;

            resize: vertical;

            line-height: 1.7;
        }


        .submit-area {
            margin-top: 12px;

            padding-top: 22px;

            border-top:
                1px solid #f1f5f9;
        }


        .submit-button {
            width: 100%;

            border: 0;

            border-radius: 12px;

            padding: 13px 18px;

            background: #0f172a;

            color: #fff;

            font-family: inherit;

            font-size: 14px;

            font-weight: 800;

            cursor: pointer;

            transition: .18s ease;
        }


        .submit-button:hover:not(:disabled) {
            background: #1e293b;

            transform:
                translateY(-1px);
        }


        .submit-button:disabled {
            background: #cbd5e1;

            cursor: not-allowed;

            transform: none;
        }


        .success {
            margin-bottom: 20px;

            padding: 13px 15px;

            border-radius: 11px;

            background: #ecfdf5;

            border:
                1px solid #bbf7d0;

            color: #166534;

            font-size: 13px;

            font-weight: 700;
        }


        .error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 12px;
        }


        .empty-state {
            padding: 18px;

            text-align: center;

            color: #94a3b8;

            font-size: 13px;
        }


        .student-required {
            margin-bottom: 20px;

            padding: 12px 14px;

            border-radius: 10px;

            background: #fff7ed;

            border:
                1px solid #fed7aa;

            color: #9a3412;

            font-size: 13px;

            font-weight: 700;
        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 1023px) {

            #studentMainContent {
                margin-left: 0;
            }

        }


        @media (max-width: 700px) {

            .topbar {
                height: 64px;

                padding: 0 17px;
            }


            .badge {
                display: none;
            }


            .container {
                width:
                    min(
                        calc(100% - 28px),
                        1000px
                    );

                padding: 25px 0 45px;
            }


            .title {
                font-size: 28px;
            }


            .card-header,
            .form {
                padding: 21px;
            }


            .identity {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     SIDEBAR SISWA
     MENGGUNAKAN FILE SIDEBAR YANG SUDAH KAMU BUAT
========================================================= --}}

@include('partials.sidebar')


{{-- =========================================================
     KONTEN UTAMA
========================================================= --}}

<div id="studentMainContent">


<header class="topbar">

    <div class="brand">

        LARASKU

        <span>
            Pembelajaran Seni Musik
        </span>

    </div>


    <div class="badge">

        Refleksi Pembelajaran

    </div>

</header>



<main class="container">


    <section class="header">

        <div class="eyebrow">

            LARASKU

        </div>


        <h1 class="title">

            Refleksi Pembelajaran

        </h1>


        <p class="description">

            Tuliskan pengalaman,
            pemahaman, dan pendapatmu
            setelah mengikuti pembelajaran.

        </p>

    </section>



    {{-- =====================================================
         TAB PERTEMUAN
    ====================================================== --}}

    <div class="meetings">

        @for($i = 1; $i <= 8; $i++)

            <a
                href="{{ route('reflections.index', [
                    'pertemuan' => $i,
                    'kelas' => $kelas ?? '',
                    'student_id' => $selectedStudent->id ?? ''
                ]) }}"
                class="
                    meeting
                    {{ $pertemuan === $i ? 'active' : '' }}
                "
            >

                Pertemuan {{ $i }}

            </a>

        @endfor

    </div>



    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif



    <section class="card">


        <div class="card-header">

            <div class="meeting-label">

                Pertemuan {{ $pertemuan }}

            </div>


            <h2 class="meeting-title">

                @switch($pertemuan)

                    @case(1)

                        Mengenal Lagu Daerah

                        @break


                    @case(2)

                        Ragam dan Ciri-Ciri Lagu Daerah

                        @break


                    @case(3)

                        Teknik Dasar Bernyanyi Lagu Daerah

                        @break


                    @case(4)

                        Intonasi, Artikulasi,
                        Tempo, dan Frasering

                        @break


                    @case(5)

                        Mengenal Alat Musik
                        Tradisional Indonesia

                        @break


                    @case(6)

                        Jenis dan Cara Memainkan
                        Alat Musik Tradisional

                        @break


                    @case(7)

                        Pengelompokan
                        Alat Musik Tradisional

                        @break


                    @case(8)

                        Pelestarian
                        Alat Musik Tradisional

                        @break

                @endswitch

            </h2>

        </div>



        <form
            action="{{ route('reflections.store') }}"
            method="POST"
            class="form"
        >

            @csrf


            <input
                type="hidden"
                name="pertemuan"
                value="{{ $pertemuan }}"
            >



            {{-- =================================================
                 IDENTITAS SISWA
            ================================================== --}}

            <div class="student-box">


                <div class="student-box-title">

                    Identitas Siswa

                </div>



                {{-- KELAS --}}

                <div
                    class="field"
                    style="margin-bottom: 15px;"
                >

                    <label for="kelas">

                        Pilih Kelas

                    </label>


                    <select
                        id="kelas"
                        onchange="ubahKelas(this.value)"
                    >

                        <option value="">

                            — Pilih Kelas —

                        </option>


                        @foreach($classes as $class)

                            <option
                                value="{{ $class }}"
                                {{ ($kelas ?? '') === $class
                                    ? 'selected'
                                    : ''
                                }}
                            >

                                {{ $class }}

                            </option>

                        @endforeach

                    </select>

                </div>



                {{-- NAMA + ABSEN --}}

                <div class="identity">


                    <div class="field">

                        <label for="cari_siswa">

                            Cari Nama Siswa

                        </label>


                        <div class="search-box">

                            <span class="search-icon">

                                🔍

                            </span>


                            <input
                                type="text"
                                id="cari_siswa"
                                placeholder="{{
                                    ($kelas ?? '')
                                    ? 'Ketik nama siswa...'
                                    : 'Pilih kelas terlebih dahulu'
                                }}"
                                {{ ($kelas ?? '')
                                    ? ''
                                    : 'disabled'
                                }}
                                autocomplete="off"
                            >

                        </div>



                        <div
                            id="student-results"
                            class="student-results"
                        >

                            @if(
                                ($kelas ?? '')
                                &&
                                $students->count()
                            )

                                @foreach($students as $student)

                                    <button
                                        type="button"
                                        class="student-result"
                                        data-id="{{ $student->id }}"
                                        data-name="{{ $student->nama }}"
                                        data-absen="{{ $student->nomor_absen }}"
                                        data-kelas="{{ $student->kelas }}"
                                        onclick="pilihSiswa(this)"
                                    >

                                        <span class="student-name">

                                            {{ $student->nama }}

                                        </span>


                                        <span class="student-info">

                                            No. Absen
                                            {{ $student->nomor_absen }}

                                            •
                                            {{ $student->kelas }}

                                        </span>

                                    </button>

                                @endforeach

                            @elseif(($kelas ?? ''))

                                <div class="empty-state">

                                    Tidak ada siswa
                                    pada kelas ini.

                                </div>

                            @endif

                        </div>



                        @error('student_id')

                            <div class="error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>



                    <div class="field">

                        <label for="nomor_absen">

                            Nomor Absen

                        </label>


                        <input
                            type="text"
                            id="nomor_absen"
                            value="{{ $selectedStudent->nomor_absen ?? '' }}"
                            placeholder="Otomatis"
                            readonly
                        >

                    </div>

                </div>



                {{-- SISWA TERPILIH --}}

                <div
                    id="selected-student"
                    class="selected-student"
                    style="{{
                        isset($selectedStudent)
                        && $selectedStudent
                            ? 'display:block;'
                            : ''
                    }}"
                >

                    Siswa terpilih:

                    <strong>

                        {{ $selectedStudent->nama ?? '' }}

                    </strong>


                    <span>

                        — No. Absen

                        <strong>

                            {{ $selectedStudent->nomor_absen ?? '' }}

                        </strong>

                    </span>

                </div>



                {{-- ID SISWA --}}

                <input
                    type="hidden"
                    name="student_id"
                    id="student_id"
                    value="{{ $selectedStudent->id ?? '' }}"
                >

            </div>



            {{-- =================================================
                 PESAN JIKA BELUM PILIH SISWA
            ================================================== --}}

            <div
                id="student-required"
                class="student-required"
                style="{{
                    isset($selectedStudent)
                    && $selectedStudent
                        ? 'display:none;'
                        : ''
                }}"
            >

                Pilih kelas dan siswa terlebih dahulu
                sebelum mengisi refleksi.

            </div>



            {{-- =================================================
                 PERTANYAAN
            ================================================== --}}

            <div id="questions-area">

                @foreach($questions as $index => $question)

                    <div class="question">


                        <div class="question-number">

                            PERTANYAAN {{ $index + 1 }}

                        </div>


                        <div class="question-text">

                            {{ $question }}

                        </div>


                        <textarea
                            name="jawaban_{{ $index + 1 }}"
                            placeholder="Tuliskan jawabanmu di sini..."
                            required
                            {{
                                isset($selectedStudent)
                                && $selectedStudent
                                    ? ''
                                    : 'disabled'
                            }}
                        >{{ old(
                            'jawaban_' . ($index + 1),
                            $existingReflection->{'jawaban_' . ($index + 1)}
                            ?? ''
                        ) }}</textarea>


                        @error(
                            'jawaban_' . ($index + 1)
                        )

                            <div class="error">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                @endforeach

            </div>



            {{-- =================================================
                 SUBMIT
            ================================================== --}}

            <div class="submit-area">

                <button
                    type="submit"
                    class="submit-button"
                    id="submit-button"
                    {{
                        isset($selectedStudent)
                        && $selectedStudent
                            ? ''
                            : 'disabled'
                    }}
                >

                    Kirim Refleksi

                </button>

            </div>


        </form>

    </section>


</main>

</div>



<script>

    /*
    |--------------------------------------------------------------------------
    | Ganti kelas
    |--------------------------------------------------------------------------
    */

    function ubahKelas(kelas)
    {

        const url = new URL(
            "{{ route('reflections.index') }}",
            window.location.origin
        );


        url.searchParams.set(
            'pertemuan',
            "{{ $pertemuan }}"
        );


        if (kelas) {

            url.searchParams.set(
                'kelas',
                kelas
            );

        }


        window.location.href =
            url.toString();

    }



    /*
    |--------------------------------------------------------------------------
    | Cari siswa
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById(
            'cari_siswa'
        );


    const results =
        document.getElementById(
            'student-results'
        );


    if (searchInput) {

        searchInput.addEventListener(
            'input',
            function () {

                const keyword =
                    this.value
                        .toLowerCase()
                        .trim();


                const students =
                    results.querySelectorAll(
                        '.student-result'
                    );


                let visible = 0;


                students.forEach(
                    function (student) {

                        const name =
                            student.dataset.name
                                .toLowerCase();


                        const absen =
                            String(
                                student.dataset.absen
                            ).toLowerCase();


                        const match =
                            name.includes(keyword) ||
                            absen.includes(keyword);


                        student.style.display =
                            match
                                ? 'block'
                                : 'none';


                        if (match) {

                            visible++;

                        }

                    }
                );


                if (
                    keyword &&
                    visible > 0
                ) {

                    results.style.display =
                        'block';

                } else if (!keyword) {

                    results.style.display =
                        'block';

                } else {

                    results.style.display =
                        'none';

                }

            }
        );


        searchInput.addEventListener(
            'focus',
            function () {

                if (
                    results.querySelector(
                        '.student-result'
                    )
                ) {

                    results.style.display =
                        'block';

                }

            }
        );

    }



    /*
    |--------------------------------------------------------------------------
    | Pilih siswa
    |--------------------------------------------------------------------------
    */

    function pilihSiswa(button)
    {

        const id =
            button.dataset.id;


        const name =
            button.dataset.name;


        const absen =
            button.dataset.absen;


        const kelas =
            button.dataset.kelas;


        document.getElementById(
            'student_id'
        ).value =
            id;


        document.getElementById(
            'cari_siswa'
        ).value =
            name;


        document.getElementById(
            'nomor_absen'
        ).value =
            absen;


        const selected =
            document.getElementById(
                'selected-student'
            );


        selected.innerHTML =

            'Siswa terpilih: ' +

            '<strong>' +

            name +

            '</strong> ' +

            '<span>— No. Absen <strong>' +

            absen +

            '</strong></span>';


        selected.style.display =
            'block';


        document.getElementById(
            'student-results'
        ).style.display =
            'none';


        document.getElementById(
            'student-required'
        ).style.display =
            'none';


        document.getElementById(
            'submit-button'
        ).disabled =
            false;


        document
            .querySelectorAll(
                '#questions-area textarea'
            )
            .forEach(
                function (textarea) {

                    textarea.disabled =
                        false;

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Simpan pilihan siswa ke URL
        |--------------------------------------------------------------------------
        */

        const url =
            new URL(
                window.location.href
            );


        url.searchParams.set(
            'kelas',
            kelas
        );


        url.searchParams.set(
            'student_id',
            id
        );


        url.searchParams.set(
            'pertemuan',
            "{{ $pertemuan }}"
        );


        window.history.replaceState(
            {},
            '',
            url.toString()
        );

    }



    /*
    |--------------------------------------------------------------------------
    | Tutup daftar siswa ketika klik di luar
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'click',
        function (event) {

            const searchBox =
                document.querySelector(
                    '.search-box'
                );


            const studentResults =
                document.getElementById(
                    'student-results'
                );


            if (
                searchBox &&
                studentResults &&
                !searchBox.contains(
                    event.target
                ) &&
                !studentResults.contains(
                    event.target
                )
            ) {

                studentResults.style.display =
                    'none';

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Lucide sidebar
    |--------------------------------------------------------------------------
    */

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