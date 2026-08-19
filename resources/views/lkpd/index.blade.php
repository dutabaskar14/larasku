<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>LKPD — LARASKU</title>

    {{-- Tailwind untuk sidebar siswa --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Lucide untuk icon sidebar --}}
    <script src="https://unpkg.com/lucide@latest"></script>


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            background: #f5f7fb;
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


        .topbar {
            height: 74px;

            background: #fff;

            border-bottom:
                1px solid #e6eaf0;

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

            letter-spacing: -.04em;

            color: #0f172a;
        }


        .brand span {
            display: block;

            margin-top: 3px;

            color: #94a3b8;

            font-size: 11px;

            font-weight: 650;

            letter-spacing: 0;
        }


        .badge {
            padding: 8px 13px;

            border:
                1px solid #e2e8f0;

            border-radius: 10px;

            background: #f8fafc;

            color: #64748b;

            font-size: 12px;

            font-weight: 800;
        }


        .container {
            width: min(
                1000px,
                calc(100% - 36px)
            );

            margin: auto;

            padding: 34px 0 60px;
        }


        .heading {
            margin-bottom: 24px;
        }


        .eyebrow {
            margin-bottom: 6px;

            color: #2563eb;

            font-size: 11px;

            font-weight: 900;

            letter-spacing: .12em;

            text-transform: uppercase;
        }


        h1 {
            margin: 0;

            color: #0f172a;

            font-size: 34px;

            font-weight: 900;

            letter-spacing: -.04em;
        }


        .subtitle {
            margin: 8px 0 0;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;
        }


        /* =========================================================
           PERTEMUAN
        ========================================================= */

        .meetings {
            display: flex;

            gap: 8px;

            overflow-x: auto;

            padding-bottom: 5px;

            margin-bottom: 20px;
        }


        .meeting {
            flex: 0 0 auto;

            padding: 10px 15px;

            border:
                1px solid #e2e8f0;

            border-radius: 11px;

            background: #fff;

            color: #64748b;

            text-decoration: none;

            font-size: 13px;

            font-weight: 800;

            transition: .18s ease;
        }


        .meeting:hover {
            border-color: #cbd5e1;

            color: #0f172a;
        }


        .meeting.active {
            border-color: #0f172a;

            background: #0f172a;

            color: #fff;
        }


        /* =========================================================
           CARD
        ========================================================= */

        .card {
            overflow: hidden;

            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 20px;

            box-shadow:
                0 6px 25px
                rgba(15, 23, 42, .035);
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

            font-weight: 900;

            text-transform: uppercase;
        }


        .card-title {
            margin: 11px 0 0;

            color: #0f172a;

            font-size: 22px;

            font-weight: 900;
        }


        .form {
            padding: 28px;
        }


        /* =========================================================
           IDENTITAS
        ========================================================= */

        .student-box {
            margin-bottom: 25px;

            padding: 20px;

            border:
                1px solid #e2e8f0;

            border-radius: 16px;

            background: #f8fafc;
        }


        .student-box-title {
            margin-bottom: 16px;

            color: #0f172a;

            font-size: 14px;

            font-weight: 850;
        }


        .field {
            margin-bottom: 15px;
        }


        .field:last-child {
            margin-bottom: 0;
        }


        label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 12px;

            font-weight: 800;
        }


        select,
        input[type="text"],
        input[type="file"] {
            width: 100%;

            border:
                1px solid #dbe2ea;

            border-radius: 11px;

            background: #fff;

            color: #0f172a;

            font-family: inherit;

            font-size: 14px;

            outline: none;
        }


        select,
        input[type="text"] {
            height: 44px;

            padding: 0 13px;
        }


        input[type="file"] {
            padding: 10px 12px;
        }


        select:focus,
        input:focus {
            border-color: #60a5fa;

            box-shadow:
                0 0 0 3px
                rgba(59, 130, 246, .10);
        }


        input[readonly] {
            background: #f1f5f9;

            color: #475569;
        }


        .identity {
            display: grid;

            grid-template-columns:
                1fr 180px;

            gap: 15px;
        }


        /* =========================================================
           SEARCH SISWA
        ========================================================= */

        .search-box {
            position: relative;
        }


        .search-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform:
                translateY(-50%);

            pointer-events: none;

            color: #94a3b8;
        }


        .search-box input {
            padding-left: 38px;
        }


        .student-results {
            display: none;

            max-height: 230px;

            overflow-y: auto;

            margin-top: 8px;

            border:
                1px solid #e2e8f0;

            border-radius: 12px;

            background: #fff;

            box-shadow:
                0 10px 25px
                rgba(15, 23, 42, .08);
        }


        .student-result {
            display: block;

            width: 100%;

            padding: 13px 15px;

            border: 0;

            border-bottom:
                1px solid #f1f5f9;

            background: #fff;

            text-align: left;

            cursor: pointer;
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

            padding: 12px 14px;

            border:
                1px solid #bfdbfe;

            border-radius: 10px;

            background: #eff6ff;

            color: #1e3a8a;

            font-size: 13px;

            font-weight: 700;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status-card {
            margin-top: 15px;

            padding: 15px;

            border-radius: 12px;
        }


        .status-belum {
            border:
                1px solid #e2e8f0;

            background: #f8fafc;
        }


        .status-menunggu {
            border:
                1px solid #fde68a;

            background: #fffbeb;
        }


        .status-disetujui {
            border:
                1px solid #bbf7d0;

            background: #ecfdf5;
        }


        .status-title {
            margin-bottom: 5px;

            color: #334155;

            font-size: 12px;

            font-weight: 850;
        }


        .status-text {
            color: #64748b;

            font-size: 12px;

            line-height: 1.5;
        }


        .status-time {
            margin-top: 6px;

            color: #94a3b8;

            font-size: 11px;
        }


        /* =========================================================
           TUGAS
        ========================================================= */

        .task-card {
            margin-bottom: 24px;

            padding: 22px;

            border:
                1px solid #dbeafe;

            border-radius: 16px;

            background:
                linear-gradient(
                    135deg,
                    #f8fbff,
                    #f1f5ff
                );
        }


        .task-label {
            margin-bottom: 9px;

            color: #2563eb;

            font-size: 11px;

            font-weight: 900;

            letter-spacing: .08em;

            text-transform: uppercase;
        }


        .task-text {
            color: #1e293b;

            font-size: 15px;

            line-height: 1.8;

            font-weight: 650;
        }


        /* =========================================================
           UPLOAD
        ========================================================= */

        .upload-card {
            padding: 20px;

            border:
                1px solid #e2e8f0;

            border-radius: 16px;

            background: #fff;
        }


        .upload-title {
            margin-bottom: 5px;

            color: #0f172a;

            font-size: 15px;

            font-weight: 850;
        }


        .upload-description {
            margin-bottom: 15px;

            color: #64748b;

            font-size: 12px;

            line-height: 1.6;
        }


        .preview {
            display: none;

            margin-top: 15px;
        }


        .preview img {
            display: block;

            width: 100%;

            max-height: 420px;

            object-fit: contain;

            border:
                1px solid #e2e8f0;

            border-radius: 12px;

            background: #f8fafc;
        }


        .existing {
            margin-top: 15px;

            padding: 14px;

            border:
                1px solid #bbf7d0;

            border-radius: 12px;

            background: #ecfdf5;
        }


        .existing-title {
            margin-bottom: 9px;

            color: #166534;

            font-size: 12px;

            font-weight: 850;
        }


        .existing img {
            display: block;

            width: 100%;

            max-height: 360px;

            object-fit: contain;

            border-radius: 9px;

            background: #fff;
        }


        /* =========================================================
           BUTTON
        ========================================================= */

        .submit-area {
            margin-top: 22px;
        }


        .submit-button {
            width: 100%;

            height: 46px;

            border: 0;

            border-radius: 11px;

            background: #0f172a;

            color: #fff;

            font-family: inherit;

            font-size: 14px;

            font-weight: 850;

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
        }


        .success {
            margin-bottom: 20px;

            padding: 13px 15px;

            border:
                1px solid #bbf7d0;

            border-radius: 11px;

            background: #ecfdf5;

            color: #166534;

            font-size: 13px;

            font-weight: 750;
        }


        .error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 12px;
        }


        .required {
            margin-bottom: 20px;

            padding: 12px 14px;

            border:
                1px solid #fed7aa;

            border-radius: 10px;

            background: #fff7ed;

            color: #9a3412;

            font-size: 13px;

            font-weight: 700;
        }


        .empty {
            padding: 18px;

            text-align: center;

            color: #94a3b8;

            font-size: 13px;
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
                        100% - 28px,
                        1000px
                    );

                padding-top: 25px;
            }


            h1 {
                font-size: 28px;
            }


            .form,
            .card-header {
                padding: 21px;
            }


            .identity {
                grid-template-columns: 1fr;
            }

        }


        /*
        |--------------------------------------------------------------------------
        | RUANG SIDEBAR DESKTOP
        |--------------------------------------------------------------------------
        */

        @media (min-width: 1024px) {

            .student-main {
                margin-left: 256px;
            }

        }


        @media (max-width: 1023px) {

            .student-main {
                margin-left: 0;
            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     SIDEBAR SISWA
     Memakai sidebar yang sudah ada.
========================================================= --}}

@include('partials.sidebar')


{{-- =========================================================
     KONTEN SISWA
========================================================= --}}

<div class="student-main min-h-screen">


    <header class="topbar">

        <div class="brand">

            LARASKU

            <span>
                Pembelajaran Seni Musik
            </span>

        </div>


        <div class="badge">
            LKPD
        </div>

    </header>



    <main class="container">

        <section class="heading">

            <div class="eyebrow">
                LARASKU
            </div>


            <h1>
                LKPD
            </h1>


            <p class="subtitle">
                Kerjakan tugas sesuai pertemuan,
                kemudian foto hasil pekerjaanmu dan kirimkan.
            </p>

        </section>



        {{-- =========================================================
             PERTEMUAN
        ========================================================== --}}

        <div class="meetings">

            @for($i = 1; $i <= 8; $i++)

                <a
                    href="{{ route('lkpd.index', [
                        'pertemuan' => $i,
                        'kelas' => $kelas ?? '',
                        'student_id' => $selectedStudent->id ?? ''
                    ]) }}"
                    class="meeting {{ $pertemuan === $i ? 'active' : '' }}"
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


                <h2 class="card-title">
                    Lembar Kerja Peserta Didik
                </h2>

            </div>



            <form
                action="{{ route('lkpd.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="form"
            >

                @csrf


                <input
                    type="hidden"
                    name="pertemuan"
                    value="{{ $pertemuan }}"
                >



                {{-- =====================================================
                     IDENTITAS SISWA
                ====================================================== --}}

                <div class="student-box">

                    <div class="student-box-title">
                        Identitas Siswa
                    </div>



                    {{-- KELAS --}}

                    <div class="field">

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
                                    {{ ($kelas ?? '') === $class ? 'selected' : '' }}
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
                                    placeholder="{{ ($kelas ?? '') ? 'Ketik nama siswa...' : 'Pilih kelas terlebih dahulu' }}"
                                    {{ ($kelas ?? '') ? '' : 'disabled' }}
                                    autocomplete="off"
                                    value="{{ $selectedStudent->nama ?? '' }}"
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

                                    <div class="empty">

                                        Tidak ada siswa pada kelas ini.

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
                        style="{{ isset($selectedStudent) && $selectedStudent ? 'display:block;' : '' }}"
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



                    {{-- =================================================
                         STATUS LKPD
                    ================================================== --}}

                    @if(isset($selectedStudent) && $selectedStudent)

                        @if(!$existingLkpd)

                            <div class="status-card status-belum">

                                <div class="status-title">

                                    Status Tugas —
                                    {{ $selectedStudent->nama }}

                                </div>


                                <div class="status-text">

                                    ⚪ Belum mengumpulkan tugas

                                </div>

                            </div>

                        @elseif($existingLkpd->disetujui)

                            <div class="status-card status-disetujui">

                                <div class="status-title">

                                    Status Tugas —
                                    {{ $selectedStudent->nama }}

                                </div>


                                <div class="status-text">

                                    🟢 Tugas sudah disetujui guru

                                </div>


                                @if($existingLkpd->disetujui_at)

                                    <div class="status-time">

                                        Disetujui pada

                                        {{
                                            $existingLkpd
                                                ->disetujui_at
                                                ->format('d/m/Y H:i')
                                        }}

                                    </div>

                                @endif

                            </div>

                        @else

                            <div class="status-card status-menunggu">

                                <div class="status-title">

                                    Status Tugas —
                                    {{ $selectedStudent->nama }}

                                </div>


                                <div class="status-text">

                                    🟡 Tugas sudah dikirim
                                    dan menunggu persetujuan guru

                                </div>


                                <div class="status-time">

                                    Tugas sudah diterima sistem
                                    dan sedang diperiksa.

                                </div>

                            </div>

                        @endif

                    @endif



                    <input
                        type="hidden"
                        name="student_id"
                        id="student_id"
                        value="{{ $selectedStudent->id ?? '' }}"
                    >

                </div>



                {{-- =====================================================
                     TUGAS
                ====================================================== --}}

                <div class="task-card">

                    <div class="task-label">

                        Tugas Pertemuan {{ $pertemuan }}

                    </div>


                    <div class="task-text">

                        {{ $task }}

                    </div>

                </div>



                {{-- PESAN BELUM PILIH SISWA --}}

                <div
                    id="student-required"
                    class="required"
                    style="{{ isset($selectedStudent) && $selectedStudent ? 'display:none;' : '' }}"
                >

                    Pilih kelas dan siswa terlebih dahulu
                    sebelum mengirim tugas.

                </div>



                {{-- =====================================================
                     UPLOAD FOTO
                ====================================================== --}}

                <div class="upload-card">

                    <div class="upload-title">
                        Upload Foto Tugas
                    </div>


                    <div class="upload-description">

                        Foto harus terlihat jelas dan seluruh
                        bagian tugas dapat dibaca.

                        Format JPG, JPEG, PNG, atau WEBP.
                        Maksimal 5 MB.

                    </div>


                    <input
                        type="file"
                        name="foto"
                        id="foto"
                        accept="image/jpeg,image/png,image/webp"
                        {{ isset($selectedStudent) && $selectedStudent ? '' : 'disabled' }}
                        required
                    >


                    @error('foto')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror



                    {{-- PREVIEW FOTO BARU --}}

                    <div
                        id="preview"
                        class="preview"
                    >

                        <img
                            id="preview-image"
                            src=""
                            alt="Preview tugas"
                        >

                    </div>



                    {{-- FOTO YANG SUDAH DIKIRIM --}}

                    @if($existingLkpd)

                        <div class="existing">

                            <div class="existing-title">

                                Tugas sebelumnya sudah dikirim

                            </div>


                            <img
                                src="{{ asset('storage/' . $existingLkpd->foto) }}"
                                alt="Tugas yang sudah dikirim"
                            >

                        </div>

                    @endif

                </div>



                {{-- =====================================================
                     SUBMIT
                ====================================================== --}}

                <div class="submit-area">

                    <button
                        type="submit"
                        id="submit-button"
                        class="submit-button"
                        {{ isset($selectedStudent) && $selectedStudent ? '' : 'disabled' }}
                    >

                        {{ $existingLkpd
                            ? 'Kirim Ulang Tugas'
                            : 'Kirim Tugas'
                        }}

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

        const url =
            new URL(
                "{{ route('lkpd.index') }}",
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
    | Elemen
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


    const fileInput =
        document.getElementById(
            'foto'
        );



    /*
    |--------------------------------------------------------------------------
    | Cari siswa
    |--------------------------------------------------------------------------
    */

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


                if (visible > 0) {

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



        results.style.display =
            'none';



        document.getElementById(
            'student-required'
        ).style.display =
            'none';



        document.getElementById(
            'foto'
        ).disabled =
            false;


        document.getElementById(
            'foto'
        ).required =
            true;


        document.getElementById(
            'submit-button'
        ).disabled =
            false;



        /*
        |--------------------------------------------------------------------------
        | Simpan pilihan ke URL
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
    | Preview foto
    |--------------------------------------------------------------------------
    */

    if (fileInput) {

        fileInput.addEventListener(
            'change',
            function () {

                const file =
                    this.files[0];


                if (!file) {
                    return;
                }


                if (
                    file.size >
                    5 * 1024 * 1024
                ) {

                    alert(
                        'Ukuran foto maksimal 5 MB.'
                    );


                    this.value =
                        '';


                    return;

                }


                const reader =
                    new FileReader();


                reader.onload =
                    function (event) {

                        document.getElementById(
                            'preview-image'
                        ).src =
                            event.target.result;


                        document.getElementById(
                            'preview'
                        ).style.display =
                            'block';

                    };


                reader.readAsDataURL(
                    file
                );

            }
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


            if (
                searchBox &&
                results &&
                !searchBox.contains(
                    event.target
                ) &&
                !results.contains(
                    event.target
                )
            ) {

                results.style.display =
                    'none';

            }

        }
    );



    /*
    |--------------------------------------------------------------------------
    | Icon sidebar
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