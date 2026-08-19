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

        .container {
            width: min(950px, calc(100% - 36px));
            margin: auto;
            padding: 34px 0 60px;
        }

        .back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
        }

        .back:hover {
            color: #0f172a;
        }

        .heading {
            margin-bottom: 22px;
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
            font-size: 32px;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .subtitle {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        /* STUDENT */

        .student-card {
            margin-bottom: 20px;
            padding: 22px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
        }

        .student-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .student-name {
            color: #0f172a;
            font-size: 20px;
            font-weight: 900;
        }

        .student-meta {
            margin-top: 5px;
            color: #64748b;
            font-size: 13px;
        }

        .meeting {
            flex: 0 0 auto;
            padding: 8px 12px;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 850;
        }

        .sent {
            margin-top: 14px;
            color: #94a3b8;
            font-size: 11px;
        }

        /* TASK */

        .task-card {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dbeafe;
            border-radius: 16px;
            background: #f8fbff;
        }

        .task-label {
            margin-bottom: 7px;
            color: #2563eb;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .task-text {
            color: #334155;
            font-size: 14px;
            line-height: 1.75;
        }

        /* PHOTO */

        .photo-card {
            overflow: hidden;
            margin-bottom: 20px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
        }

        .photo-header {
            padding: 20px 22px;
            border-bottom: 1px solid #f1f5f9;
        }

        .photo-title {
            color: #0f172a;
            font-size: 16px;
            font-weight: 850;
        }

        .photo-subtitle {
            margin-top: 4px;
            color: #94a3b8;
            font-size: 12px;
        }

        .photo-area {
            padding: 20px;
            background: #f8fafc;
        }

        .photo-area img {
            display: block;
            width: 100%;
            max-height: 720px;
            object-fit: contain;
            margin: auto;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
        }

        /* APPROVAL */

        .approval-card {
            padding: 22px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
        }

        .approval-title {
            color: #0f172a;
            font-size: 16px;
            font-weight: 850;
        }

        .approval-description {
            margin-top: 5px;
            margin-bottom: 17px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.6;
        }

        .approval-option {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: .18s ease;
        }

        .approval-option:hover {
            background: #f8fafc;
        }

        .approval-option.approved {
            border-color: #bbf7d0;
            background: #f0fdf4;
        }

        .approval-option input {
            width: 19px;
            height: 19px;
            margin: 1px 0 0;
            accent-color: #16a34a;
            cursor: pointer;
            flex: 0 0 auto;
        }

        .approval-text strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            font-weight: 850;
        }

        .approval-text span {
            display: block;
            margin-top: 4px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .approval-time {
            margin-top: 10px;
            color: #15803d;
            font-size: 11px;
            font-weight: 750;
        }

        .submit {
            width: 100%;
            height: 46px;
            margin-top: 15px;
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

        .submit:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        .success {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 11px;
            background: #ecfdf5;
            color: #166534;
            font-size: 13px;
            font-weight: 750;
        }

        .error {
            margin-bottom: 20px;
            padding: 13px 15px;
            border: 1px solid #fecaca;
            border-radius: 11px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 13px;
            font-weight: 750;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 650px) {

            .container {
                width: min(100% - 28px, 950px);
                padding-top: 25px;
            }

            h1 {
                font-size: 27px;
            }

            .student-top {
                align-items: flex-start;
                flex-direction: column;
            }

            .meeting {
                width: fit-content;
            }

            .photo-area {
                padding: 12px;
            }
        }
    </style>
</head>


<body>

<div class="min-h-screen">

    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main
        id="mainContent"
        class="
            main-content
            lg:ml-64
            transition-all
            duration-300
        "
    >

        {{-- =====================================================
             TOPBAR
        ====================================================== --}}

        <header
            class="
                h-[74px]
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
                    Detail LKPD
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


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="container">

            {{-- BACK --}}
            <a
                href="{{ route('guru.lkpd.index', [
                    'kelas' => $lkpd->student->kelas ?? '',
                    'pertemuan' => $lkpd->pertemuan
                ]) }}"
                class="back"
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke Rekap LKPD

            </a>


            {{-- HEADER --}}
            <section class="heading">

                <div class="eyebrow">
                    Pemeriksaan Tugas
                </div>

                <h1>
                    Detail LKPD
                </h1>

                <p class="subtitle">
                    Periksa hasil tugas siswa dan berikan persetujuan.
                </p>

            </section>


            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="success">

                    <div class="flex items-center gap-2">

                        <i
                            data-lucide="circle-check"
                            class="w-4 h-4"
                        ></i>

                        {{ session('success') }}

                    </div>

                </div>

            @endif


            {{-- ERROR --}}
            @if($errors->any())

                <div class="error">

                    <div class="font-bold mb-1">
                        Terjadi kesalahan:
                    </div>

                    <ul class="list-disc pl-5">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            @endif


            {{-- =================================================
                 INFORMASI SISWA
            ================================================== --}}

            <section class="student-card">

                <div class="student-top">

                    <div>

                        <div class="student-name">
                            {{ $lkpd->student->nama ?? 'Siswa tidak ditemukan' }}
                        </div>


                        <div class="student-meta">

                            No. Absen:

                            <strong>
                                {{ $lkpd->student->nomor_absen ?? '-' }}
                            </strong>

                            &nbsp; • &nbsp;

                            Kelas:

                            <strong>
                                {{ $lkpd->student->kelas ?? '-' }}
                            </strong>

                        </div>

                    </div>


                    <div class="meeting">

                        <div class="flex items-center gap-1.5">

                            <i
                                data-lucide="calendar-days"
                                class="w-3.5 h-3.5"
                            ></i>

                            Pertemuan {{ $lkpd->pertemuan }}

                        </div>

                    </div>

                </div>


                <div class="sent flex items-center gap-1.5">

                    <i
                        data-lucide="clock-3"
                        class="w-3.5 h-3.5"
                    ></i>

                    Dikumpulkan:

                    {{ $lkpd->created_at->format('d/m/Y H:i') }}

                </div>

            </section>


            {{-- =================================================
                 TUGAS
            ================================================== --}}

            @php

                $task = match ((int) $lkpd->pertemuan) {

                    1 =>
                        'Pilih satu lagu daerah yang kamu ketahui. Tuliskan identitas lagu tersebut pada buku tugas, meliputi nama lagu dan daerah asalnya. Setelah selesai, foto hasil pekerjaanmu dan unggah di sini.',

                    2 =>
                        'Pilih satu lagu daerah. Identifikasi dan tuliskan ciri-ciri lagu tersebut berdasarkan materi yang telah dipelajari. Foto hasil pekerjaanmu dan unggah di sini.',

                    3 =>
                        'Lakukan latihan teknik dasar bernyanyi dengan memperhatikan sikap tubuh dan teknik pernapasan. Tuliskan hasil pengalaman latihanmu pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

                    4 =>
                        'Latih satu bagian lagu daerah dengan memperhatikan intonasi, artikulasi, tempo, dan frasering. Tuliskan hasil latihan atau catatan kesulitanmu pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

                    5 =>
                        'Pilih tiga alat musik tradisional Indonesia. Tuliskan nama alat musik dan daerah asalnya. Foto hasil pekerjaanmu dan unggah di sini.',

                    6 =>
                        'Pilih empat alat musik tradisional yang dimainkan dengan cara berbeda. Tuliskan nama alat musik dan cara memainkannya. Foto hasil pekerjaanmu dan unggah di sini.',

                    7 =>
                        'Pilih empat alat musik tradisional dan kelompokkan berdasarkan sumber bunyinya: kordofon, aerofon, membranofon, atau idiofon. Foto hasil pekerjaanmu dan unggah di sini.',

                    8 =>
                        'Buatlah tulisan singkat tentang cara yang dapat dilakukan generasi muda untuk melestarikan alat musik tradisional Indonesia. Kerjakan pada buku tugas, kemudian foto hasil pekerjaanmu dan unggah di sini.',

                    default =>
                        'Tugas LKPD pertemuan ini.',
                };

            @endphp


            <section class="task-card">

                <div class="task-label">
                    Tugas Pertemuan {{ $lkpd->pertemuan }}
                </div>

                <div class="task-text">
                    {{ $task }}
                </div>

            </section>


            {{-- =================================================
                 FOTO TUGAS
            ================================================== --}}

            <section class="photo-card">

                <div class="photo-header">

                    <div class="photo-title flex items-center gap-2">

                        <i
                            data-lucide="image"
                            class="w-5 h-5 text-blue-600"
                        ></i>

                        Foto Hasil Tugas

                    </div>

                    <div class="photo-subtitle">
                        Dokumentasi tugas yang dikirim oleh siswa.
                    </div>

                </div>


                <div class="photo-area">

                    @if($lkpd->foto)

                        <img
                            src="{{ asset('storage/' . $lkpd->foto) }}"
                            alt="Foto tugas {{ $lkpd->student->nama ?? 'siswa' }}"
                        >

                    @else

                        <div
                            class="
                                py-20
                                text-center
                                text-slate-400
                            "
                        >

                            <i
                                data-lucide="image-off"
                                class="
                                    w-10
                                    h-10
                                    mx-auto
                                    mb-3
                                "
                            ></i>

                            <p class="font-semibold">
                                Foto tugas tidak tersedia
                            </p>

                        </div>

                    @endif

                </div>

            </section>


            {{-- =================================================
                 PERSETUJUAN
            ================================================== --}}

            <section class="approval-card">

                <div class="approval-title flex items-center gap-2">

                    <i
                        data-lucide="shield-check"
                        class="w-5 h-5 text-blue-600"
                    ></i>

                    Pemeriksaan Guru

                </div>


                <div class="approval-description">

                    Jika tugas sudah sesuai dan dapat diterima,
                    centang persetujuan di bawah lalu simpan.

                </div>


                <form
                    action="{{ route('guru.lkpd.approve', $lkpd) }}"
                    method="POST"
                >

                    @csrf


                    <label
                        class="
                            approval-option
                            {{ $lkpd->disetujui ? 'approved' : '' }}
                        "
                        id="approval-option"
                    >

                        <input
                            type="checkbox"
                            name="disetujui"
                            value="1"
                            id="disetujui"
                            {{ $lkpd->disetujui ? 'checked' : '' }}
                        >


                        <div class="approval-text">

                            <strong>
                                Setujui Tugas
                            </strong>

                            <span>
                                Saya menyatakan bahwa tugas LKPD ini telah
                                diperiksa dan dapat diterima.
                            </span>

                        </div>

                    </label>


                    @if($lkpd->disetujui && $lkpd->disetujui_at)

                        <div class="approval-time flex items-center gap-1.5">

                            <i
                                data-lucide="circle-check"
                                class="w-4 h-4"
                            ></i>

                            Disetujui pada
                            {{ $lkpd->disetujui_at->format('d/m/Y H:i') }}

                        </div>

                    @endif


                    <button
                        type="submit"
                        class="submit"
                    >

                        <span
                            class="
                                flex
                                items-center
                                justify-center
                                gap-2
                            "
                        >

                            <i
                                data-lucide="save"
                                class="w-4 h-4"
                            ></i>

                            Simpan Persetujuan

                        </span>

                    </button>

                </form>

            </section>

        </div>

    </main>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        const checkbox =
            document.getElementById('disetujui');

        const option =
            document.getElementById('approval-option');

        if (checkbox && option) {

            checkbox.addEventListener(
                'change',
                function () {

                    if (this.checked) {
                        option.classList.add('approved');
                    } else {
                        option.classList.remove('approved');
                    }

                }
            );

        }

    });
</script>

</body>
</html>