<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Quiz — LARASKU</title>

    {{-- Sidebar siswa --}}
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
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        #studentMainContent {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .topbar {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            color: #0f172a;
            font-size: 21px;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .brand span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 650;
        }

        .badge {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
        }

        .container {
            width: min(900px, calc(100% - 30px));
            margin: auto;
            padding: 30px 0 55px;
        }

        .heading {
            margin-bottom: 20px;
        }

        .eyebrow {
            margin-bottom: 6px;
            color: #2563eb;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #0f172a;
            font-size: 29px;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .subtitle {
            margin: 7px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        /* IDENTITAS */

        .identity-card {
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }

        .section-label {
            margin-bottom: 15px;
            color: #0f172a;
            font-size: 13px;
            font-weight: 900;
        }

        .section-label span {
            display: block;
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 650;
        }

        .identity-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 13px;
        }

        .field label {
            display: block;
            margin-bottom: 7px;
            color: #475569;
            font-size: 11px;
            font-weight: 850;
        }

        .field select {
            width: 100%;
            min-height: 43px;
            padding: 10px 12px;
            border: 1px solid #dbe2ea;
            border-radius: 10px;
            outline: none;
            background: #fff;
            color: #172033;
            font-family: inherit;
            font-size: 12px;
            cursor: pointer;
        }

        .field select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,.08);
        }

        .student-info {
            display: grid;
            grid-template-columns: 1fr 140px;
            gap: 10px;
            margin-top: 14px;
        }

        .info-box {
            padding: 12px 13px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            background: #f8fafc;
        }

        .info-label {
            margin-bottom: 4px;
            color: #94a3b8;
            font-size: 9px;
            font-weight: 850;
            letter-spacing: .05em;
            text-transform: uppercase;
        }

        .info-value {
            color: #0f172a;
            font-size: 13px;
            font-weight: 850;
        }

        .student-hint {
            margin-top: 10px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        /* PERTEMUAN */

        .meeting-card {
            margin-bottom: 20px;
            padding: 15px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
        }

        .meeting-label {
            margin-bottom: 10px;
            color: #64748b;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .07em;
            text-transform: uppercase;
        }

        .meetings {
            display: flex;
            gap: 7px;
            overflow-x: auto;
        }

        .meeting {
            flex: 0 0 auto;
            padding: 9px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            font-size: 12px;
            font-weight: 800;
        }

        .meeting:hover {
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .meeting.active {
            background: #0f172a;
            border-color: #0f172a;
            color: #fff;
        }

        /* ALERT */

        .success {
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #f0fdf4;
            color: #166534;
            font-size: 12px;
            font-weight: 750;
        }

        .error {
            margin-bottom: 16px;
            padding: 13px 14px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 12px;
            font-weight: 700;
        }

        /* QUIZ */

        .quiz-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            overflow: hidden;
        }

        .quiz-head {
            padding: 21px;
            border-bottom: 1px solid #edf0f4;
        }

        .quiz-title {
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
        }

        .quiz-description {
            margin-top: 5px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .quiz-meta {
            display: flex;
            gap: 7px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .meta {
            padding: 6px 9px;
            border-radius: 7px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 9px;
            font-weight: 850;
        }

        /* STATUS SELESAI */

        .completed-card {
            padding: 24px;
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-radius: 15px;
            text-align: center;
        }

        .completed-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            margin-bottom: 10px;
            border-radius: 50%;
            background: #dcfce7;
            color: #15803d;
            font-size: 22px;
            font-weight: 900;
        }

        .completed-title {
            color: #166534;
            font-size: 16px;
            font-weight: 900;
        }

        .completed-text {
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
            line-height: 1.6;
        }

        .completed-score {
            margin-top: 16px;
            color: #15803d;
            font-size: 32px;
            font-weight: 950;
            letter-spacing: -.05em;
        }

        .completed-detail {
            margin-top: 3px;
            color: #64748b;
            font-size: 11px;
        }

        /* QUESTION */

        .question {
            padding: 22px;
            border-bottom: 1px solid #edf0f4;
        }

        .question-number {
            margin-bottom: 9px;
            color: #2563eb;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .question-text {
            color: #0f172a;
            font-size: 14px;
            font-weight: 750;
            line-height: 1.65;
            white-space: pre-line;
        }

        .options {
            display: grid;
            gap: 8px;
            margin-top: 16px;
        }

        .option {
            position: relative;
        }

        .option input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .option label {
            display: block;
            padding: 12px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #475569;
            cursor: pointer;
            font-size: 12px;
            line-height: 1.5;
            transition: .18s ease;
        }

        .option label:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .option input:checked + label {
            border-color: #2563eb;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 800;
        }

        /* BUTTON */

        .submit-area {
            padding: 20px;
            background: #fafbfc;
            border-top: 1px solid #edf0f4;
        }

        .submit-button {
            width: 100%;
            padding: 13px 18px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #fff;
            font-family: inherit;
            font-size: 12px;
            font-weight: 850;
            cursor: pointer;
        }

        .submit-button:hover {
            background: #1e293b;
        }

        .completed-button {
            width: 100%;
            padding: 13px 18px;
            border: 1px solid #bbf7d0;
            border-radius: 10px;
            background: #dcfce7;
            color: #166534;
            font-family: inherit;
            font-size: 12px;
            font-weight: 850;
            cursor: default;
        }

        /* EMPTY */

        .empty {
            padding: 55px 20px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 10px;
            font-size: 28px;
        }

        .empty-title {
            color: #334155;
            font-size: 15px;
            font-weight: 850;
        }

        .empty-text {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        @media (max-width: 1023px) {

            #studentMainContent {
                margin-left: 0;
            }

        }

        @media (max-width: 600px) {

            .topbar {
                padding: 0 16px;
            }

            .badge {
                display: none;
            }

            .container {
                width: calc(100% - 24px);
                padding-top: 23px;
            }

            h1 {
                font-size: 25px;
            }

            .identity-grid {
                grid-template-columns: 1fr;
            }

            .student-info {
                grid-template-columns: 1fr;
            }

            .question {
                padding: 18px;
            }

            .quiz-head {
                padding: 18px;
            }

        }

    </style>

</head>


<body>

@include('partials.sidebar')

<div id="studentMainContent" class="lg:ml-64">

<header class="topbar">

    <div class="brand">

        LARASKU

        <span>
            Pembelajaran Seni Musik
        </span>

    </div>

    <div class="badge">
        Quiz
    </div>

</header>


<main class="container">


    <section class="heading">

        <div class="eyebrow">
            Evaluasi Pembelajaran
        </div>

        <h1>
            Quiz
        </h1>

        <p class="subtitle">
            Pilih kelas dan nama siswa sebelum mengerjakan quiz.
        </p>

    </section>


    {{-- NOTIFIKASI --}}

    @if(session('success'))

        <div class="success">
            ✓ {{ session('success') }}
        </div>

    @endif


    @if($errors->any())

        <div class="error">
            {{ $errors->first() }}
        </div>

    @endif


    {{-- IDENTITAS SISWA --}}

    <section class="identity-card">

        <div class="section-label">

            Identitas Siswa

            <span>
                Pilih kelas kemudian pilih nama siswa.
            </span>

        </div>


        <div class="identity-grid">


            {{-- KELAS --}}

            <div class="field">

                <label for="kelas">
                    Kelas
                </label>

                <select
                    id="kelas"
                    onchange="changeClass(this.value)"
                >

                    <option value="">
                        — Pilih Kelas —
                    </option>

                    @foreach($classes as $class)

                        <option
                            value="{{ $class }}"
                            {{ $kelas === $class ? 'selected' : '' }}
                        >
                            {{ $class }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- NAMA --}}

            <div class="field">

                <label for="student_id">
                    Nama Siswa
                </label>

                <select
                    id="student_id"
                    onchange="changeStudent(this.value)"
                    {{ $kelas === '' ? 'disabled' : '' }}
                >

                    @if($kelas === '')

                        <option value="">
                            — Pilih kelas dahulu —
                        </option>

                    @else

                        <option value="">
                            — Pilih Nama —
                        </option>

                        @foreach($students as $student)

                            <option
                                value="{{ $student->id }}"
                                {{ (string) $studentId === (string) $student->id ? 'selected' : '' }}
                            >
                                {{ $student->nama }}
                            </option>

                        @endforeach

                    @endif

                </select>

            </div>

        </div>


        @if($selectedStudent)

            <div class="student-info">

                <div class="info-box">

                    <div class="info-label">
                        Nama Siswa
                    </div>

                    <div class="info-value">
                        {{ $selectedStudent->nama }}
                    </div>

                </div>

                <div class="info-box">

                    <div class="info-label">
                        Nomor Absen
                    </div>

                    <div class="info-value">
                        {{ $selectedStudent->nomor_absen }}
                    </div>

                </div>

            </div>

            <div class="student-hint">
                Identitas siswa sudah dipilih. Nomor absen otomatis mengikuti data siswa.
            </div>

        @else

            <div class="student-hint">
                Pilih kelas dan nama siswa untuk melanjutkan.
            </div>

        @endif

    </section>


    {{-- PERTEMUAN --}}

    <section class="meeting-card">

        <div class="meeting-label">
            Pilih Pertemuan
        </div>

        <div class="meetings">

            @for($i = 1; $i <= 8; $i++)

                <a
                    href="{{ route('quiz.index', [
                        'kelas' => $kelas,
                        'student_id' => $studentId,
                        'pertemuan' => $i
                    ]) }}"
                    class="meeting {{ $pertemuan === $i ? 'active' : '' }}"
                >
                    Pertemuan {{ $i }}
                </a>

            @endfor

        </div>

    </section>


    {{-- BELUM PILIH SISWA --}}

    @if(!$selectedStudent)

        <section class="empty">

            <div class="empty-icon">
                👤
            </div>

            <div class="empty-title">
                Pilih Identitas Siswa
            </div>

            <div class="empty-text">
                Pilih kelas dan nama siswa terlebih dahulu.
                Setelah itu Quiz akan tersedia.
            </div>

        </section>


    @elseif(!$quiz)

        {{-- QUIZ TIDAK ADA --}}

        <section class="empty">

            <div class="empty-icon">
                📝
            </div>

            <div class="empty-title">
                Quiz belum tersedia
            </div>

            <div class="empty-text">
                Quiz untuk Pertemuan {{ $pertemuan }}
                belum tersedia atau belum diaktifkan oleh guru.
            </div>

        </section>


    @else


        {{-- =====================================================
             QUIZ
        ====================================================== --}}

        <section class="quiz-card">


            {{-- HEADER --}}

            <div class="quiz-head">

                <div class="quiz-title">
                    {{ $quiz->judul }}
                </div>

                @if($quiz->deskripsi)

                    <div class="quiz-description">
                        {{ $quiz->deskripsi }}
                    </div>

                @endif


                <div class="quiz-meta">

                    <div class="meta">
                        Pertemuan {{ $quiz->pertemuan }}
                    </div>

                    <div class="meta">
                        {{ $quiz->questions->count() }} Soal
                    </div>

                    <div class="meta">
                        {{ $selectedStudent->nama }}
                    </div>

                </div>

            </div>


            {{-- =================================================
                 SUDAH SELESAI
            ================================================== --}}

            @if($existingAttempt)

                <div style="padding:20px;">

                    <div class="completed-card">

                        <div class="completed-icon">
                            ✓
                        </div>

                        <div class="completed-title">
                            Quiz Telah Diselesaikan
                        </div>

                        <div class="completed-text">
                            Quiz Pertemuan {{ $pertemuan }}
                            sudah dikerjakan oleh
                            <strong>{{ $selectedStudent->nama }}</strong>.
                        </div>

                        <div class="completed-score">
                            {{ number_format((float) $existingAttempt->nilai, 0) }}
                        </div>

                        <div class="completed-detail">
                            {{ $existingAttempt->jumlah_benar }}
                            benar dari
                            {{ $existingAttempt->jumlah_soal }}
                            soal
                        </div>

                    </div>

                </div>


                {{-- BUTTON STATUS DI BAGIAN BAWAH --}}

                <div class="submit-area">

                    <button
                        type="button"
                        class="completed-button"
                        disabled
                    >
                        ✓ Quiz Telah Diselesaikan
                    </button>

                </div>


            @else


                {{-- =================================================
                     BELUM SELESAI — TAMPILKAN SOAL
                ================================================== --}}

                <form
                    method="POST"
                    action="{{ route('quiz.submit', $quiz) }}"
                >

                    @csrf


                    <input
                        type="hidden"
                        name="student_id"
                        value="{{ $selectedStudent->id }}"
                    >

                    <input
                        type="hidden"
                        name="pertemuan"
                        value="{{ $pertemuan }}"
                    >


                    @foreach($quiz->questions as $question)

                        <article class="question">

                            <div class="question-number">
                                Soal {{ $question->urutan }}
                            </div>

                            <div class="question-text">
                                {{ $question->pertanyaan }}
                            </div>


                            <div class="options">


                                {{-- A --}}

                                <div class="option">

                                    <input
                                        type="radio"
                                        id="q{{ $question->id }}_a"
                                        name="jawaban[{{ $question->id }}]"
                                        value="A"
                                        required
                                    >

                                    <label for="q{{ $question->id }}_a">
                                        <strong>A.</strong>
                                        {{ $question->opsi_a }}
                                    </label>

                                </div>


                                {{-- B --}}

                                <div class="option">

                                    <input
                                        type="radio"
                                        id="q{{ $question->id }}_b"
                                        name="jawaban[{{ $question->id }}]"
                                        value="B"
                                    >

                                    <label for="q{{ $question->id }}_b">
                                        <strong>B.</strong>
                                        {{ $question->opsi_b }}
                                    </label>

                                </div>


                                {{-- C --}}

                                <div class="option">

                                    <input
                                        type="radio"
                                        id="q{{ $question->id }}_c"
                                        name="jawaban[{{ $question->id }}]"
                                        value="C"
                                    >

                                    <label for="q{{ $question->id }}_c">
                                        <strong>C.</strong>
                                        {{ $question->opsi_c }}
                                    </label>

                                </div>


                                {{-- D --}}

                                <div class="option">

                                    <input
                                        type="radio"
                                        id="q{{ $question->id }}_d"
                                        name="jawaban[{{ $question->id }}]"
                                        value="D"
                                    >

                                    <label for="q{{ $question->id }}_d">
                                        <strong>D.</strong>
                                        {{ $question->opsi_d }}
                                    </label>

                                </div>


                            </div>

                        </article>

                    @endforeach


                    {{-- BUTTON KERJAKAN --}}

                    @if($quiz->questions->count())

                        <div class="submit-area">

                            <button
                                type="submit"
                                class="submit-button"
                                onclick="return confirm('Yakin semua jawaban sudah benar? Quiz hanya dapat dikerjakan satu kali untuk pertemuan ini.')"
                            >
                                Kerjakan Quiz &amp; Lihat Nilai
                            </button>

                        </div>

                    @endif


                </form>

            @endif


        </section>

    @endif


</main>

</div>

<script>

    function changeClass(kelas) {

        const url = new URL(
            window.location.href
        );

        url.searchParams.set(
            'pertemuan',
            '{{ $pertemuan }}'
        );

        if (kelas) {

            url.searchParams.set(
                'kelas',
                kelas
            );

        } else {

            url.searchParams.delete(
                'kelas'
            );

        }

        url.searchParams.delete(
            'student_id'
        );

        window.location.href =
            url.toString();
    }


    function changeStudent(studentId) {

        const url = new URL(
            window.location.href
        );

        url.searchParams.set(
            'pertemuan',
            '{{ $pertemuan }}'
        );


        @if($kelas !== '')

            url.searchParams.set(
                'kelas',
                @json($kelas)
            );

        @endif


        if (studentId) {

            url.searchParams.set(
                'student_id',
                studentId
            );

        } else {

            url.searchParams.delete(
                'student_id'
            );

        }

        window.location.href =
            url.toString();
    }

</script>


</body>

</html>