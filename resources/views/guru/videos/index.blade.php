<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Video Pembelajaran — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>


    <style>

        /* =====================================================
           GLOBAL
        ====================================================== */

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

            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }


        .main-content {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }


        .container {
            width: min(1080px, calc(100% - 56px));
            margin: 0 auto;
            padding: 30px 0 60px;
        }


        /* =====================================================
           PAGE HEADER
        ====================================================== */

        .heading {
            margin-bottom: 26px;
        }


        .eyebrow {
            margin-bottom: 7px;

            color: #2563eb;

            font-size: 11px;
            line-height: 1.2;
            font-weight: 900;

            letter-spacing: .12em;
            text-transform: uppercase;
        }


        h1 {
            margin: 0;

            color: #0f172a;

            font-size: 30px;
            line-height: 1.15;
            font-weight: 900;

            letter-spacing: -.035em;
        }


        .subtitle {
            max-width: 720px;

            margin: 9px 0 0;

            color: #64748b;

            font-size: 13px;
            line-height: 1.7;
            font-weight: 500;
        }


        /* =====================================================
           SUCCESS
        ====================================================== */

        .success {
            margin-bottom: 20px;
            padding: 13px 15px;

            border: 1px solid #bbf7d0;
            border-radius: 12px;

            background: #ecfdf5;
            color: #166534;

            font-size: 13px;
            line-height: 1.5;
            font-weight: 800;
        }


        /* =====================================================
           PERTEMUAN CARD
        ====================================================== */

        .meeting-card {
            margin-bottom: 25px;
            padding: 20px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 18px;

            box-shadow:
                0 2px 8px rgba(15, 23, 42, .025);
        }


        .meeting-label {
            margin-bottom: 13px;

            color: #334155;

            font-size: 12px;
            line-height: 1.3;
            font-weight: 900;

            letter-spacing: .04em;
            text-transform: uppercase;
        }


        .meeting-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 14px;
        }


        .meetings {
            display: flex;
            align-items: center;

            gap: 8px;

            min-width: 0;

            overflow-x: auto;

            padding: 2px 2px 5px;

            scrollbar-width: thin;
        }


        .meeting {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            flex: 0 0 auto;

            min-height: 40px;

            padding: 0 15px;

            border: 1px solid #e2e8f0;
            border-radius: 10px;

            background: #ffffff;
            color: #64748b;

            text-decoration: none;

            font-size: 12px;
            line-height: 1;
            font-weight: 850;

            white-space: nowrap;

            transition:
                background .2s ease,
                border-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .meeting:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #0f172a;

            transform: translateY(-1px);
        }


        .meeting.active {
            border-color: #0f172a;
            background: #0f172a;
            color: #ffffff;

            box-shadow:
                0 4px 10px rgba(15, 23, 42, .12);
        }


        /* =====================================================
           MEETING ITEM + STATUS
        ====================================================== */

        .meeting-item {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            flex: 0 0 auto;
            padding: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
        }

        .meeting-item .meeting {
            border: 0;
            min-height: 36px;
            padding: 0 12px;
        }

        .meeting-item .meeting.active {
            border: 0;
        }

        .meeting-status {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            min-height: 30px;
            padding: 0 9px;
            border-radius: 8px;
            font-size: 10px;
            line-height: 1;
            font-weight: 900;
            white-space: nowrap;
        }

        .meeting-status.on { background: #ecfdf5; color: #15803d; }
        .meeting-status.off { background: #f1f5f9; color: #64748b; }

        .meeting-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-height: 30px;
            padding: 0 9px;
            border: 0;
            border-radius: 8px;
            font-size: 10px;
            line-height: 1;
            font-weight: 900;
            cursor: pointer;
            transition: .2s ease;
        }

        .meeting-toggle.on { background: #fef2f2; color: #dc2626; }
        .meeting-toggle.on:hover { background: #fee2e2; }
        .meeting-toggle.off { background: #eff6ff; color: #2563eb; }
        .meeting-toggle.off:hover { background: #dbeafe; }


        /* =====================================================
           MEETING BUTTON
        ====================================================== */

        .meeting-add,
        .meeting-delete {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            flex: 0 0 auto;

            height: 40px;

            padding: 0 13px;

            border-radius: 10px;

            font-size: 11px;
            line-height: 1;
            font-weight: 850;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .meeting-add {
            border: 1px solid #bfdbfe;

            background: #eff6ff;
            color: #2563eb;
        }


        .meeting-add:hover {
            border-color: #93c5fd;
            background: #dbeafe;

            transform: translateY(-1px);
        }


        .meeting-delete {
            border: 1px solid #fecaca;

            background: #fef2f2;
            color: #dc2626;
        }


        .meeting-delete:hover {
            border-color: #fca5a5;
            background: #fee2e2;

            transform: translateY(-1px);
        }


        /* =====================================================
           MEETING DELETE AREA
        ====================================================== */

        .meeting-delete-area {
            display: flex;
            justify-content: flex-end;

            margin-top: 14px;
            padding-top: 14px;

            border-top: 1px solid #f1f5f9;
        }


        /* =====================================================
           CONTENT HEADER
        ====================================================== */

        .content-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 18px;

            margin-bottom: 15px;
        }


        .content-title {
            color: #0f172a;

            font-size: 19px;
            line-height: 1.3;
            font-weight: 900;

            letter-spacing: -.02em;
        }


        .counter {
            margin-top: 4px;

            color: #64748b;

            font-size: 12px;
            line-height: 1.4;
            font-weight: 700;
        }


        /* =====================================================
           ADD VIDEO BUTTON
        ====================================================== */

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 7px;

            height: 42px;

            padding: 0 16px;

            border: 1px solid #0f172a;
            border-radius: 10px;

            background: #0f172a;
            color: #ffffff;

            text-decoration: none;

            font-size: 12px;
            line-height: 1;
            font-weight: 850;

            white-space: nowrap;

            transition:
                background .2s ease,
                transform .2s ease,
                box-shadow .2s ease;
        }


        .add-button:hover {
            background: #1e293b;

            transform: translateY(-1px);

            box-shadow:
                0 5px 14px rgba(15, 23, 42, .12);
        }


        /* =====================================================
           VIDEO LIST
        ====================================================== */

        .video-list {
            display: grid;
            gap: 12px;
        }


        .video-card {
            padding: 20px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 16px;

            transition:
                border-color .2s ease,
                box-shadow .2s ease,
                transform .2s ease;
        }


        .video-card:hover {
            border-color: #d7dee8;

            box-shadow:
                0 8px 24px rgba(15, 23, 42, .055);

            transform: translateY(-1px);
        }


        .video-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 18px;
        }


        .video-main {
            min-width: 0;
            flex: 1;
        }


        .video-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            width: 31px;
            height: 31px;

            margin-right: 9px;

            border-radius: 9px;

            background: #eff6ff;
            color: #2563eb;

            font-size: 11px;
            line-height: 1;
            font-weight: 900;

            vertical-align: middle;
        }


        .video-title {
            display: inline;

            color: #0f172a;

            font-size: 15px;
            line-height: 1.5;
            font-weight: 900;

            letter-spacing: -.01em;
        }


        .video-description {
            margin: 10px 0 0 40px;

            color: #64748b;

            font-size: 12px;
            line-height: 1.7;
            font-weight: 500;
        }


        .youtube-link {
            display: inline-block;

            margin: 11px 0 0 40px;

            max-width: calc(100% - 40px);

            overflow: hidden;

            color: #2563eb;

            font-size: 12px;
            line-height: 1.5;
            font-weight: 700;

            text-decoration: none;
            text-overflow: ellipsis;
            white-space: nowrap;
        }


        .youtube-link:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }


        /* =====================================================
           VIDEO ACTION
        ====================================================== */

        .actions {
            display: flex;
            align-items: center;

            gap: 7px;

            flex: 0 0 auto;
        }


        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 5px;

            min-width: 66px;
            height: 35px;

            padding: 0 10px;

            border-radius: 9px;

            font-size: 11px;
            line-height: 1;
            font-weight: 850;

            text-decoration: none;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease;
        }


        .edit {
            border: 1px solid #bfdbfe;

            background: #eff6ff;
            color: #2563eb;
        }


        .edit:hover {
            border-color: #93c5fd;
            background: #dbeafe;
        }


        .delete {
            border: 1px solid #fecaca;

            background: #fef2f2;
            color: #dc2626;
        }


        .delete:hover {
            border-color: #fca5a5;
            background: #fee2e2;
        }


        /* =====================================================
           EMPTY
        ====================================================== */

        .empty {
            padding: 62px 20px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 16px;

            text-align: center;
        }


        .empty-icon {
            display: flex;
            align-items: center;
            justify-content: center;

            width: 58px;
            height: 58px;

            margin: 0 auto 15px;

            border-radius: 17px;

            background: #f1f5f9;
        }


        .empty-title {
            margin-bottom: 6px;

            color: #334155;

            font-size: 15px;
            line-height: 1.4;
            font-weight: 900;
        }


        .empty-text {
            max-width: 440px;
            margin: 0 auto;

            color: #94a3b8;

            font-size: 12px;
            line-height: 1.7;
            font-weight: 500;
        }


        .limit {
            margin-top: 12px;

            color: #94a3b8;

            font-size: 11px;
            line-height: 1.5;
            font-weight: 650;

            text-align: right;
        }


        /* =====================================================
           MODAL
        ====================================================== */

        .modal-overlay {
            position: fixed;
            inset: 0;

            z-index: 100;

            display: none;
            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgba(15, 23, 42, .48);

            backdrop-filter: blur(5px);
        }


        .modal-overlay.active {
            display: flex;
        }


        .modal {
            width: min(430px, 100%);

            padding: 25px;

            border: 1px solid #e2e8f0;
            border-radius: 18px;

            background: #ffffff;

            box-shadow:
                0 25px 60px rgba(15, 23, 42, .18);
        }


        .modal-title {
            color: #0f172a;

            font-size: 18px;
            line-height: 1.35;
            font-weight: 900;

            letter-spacing: -.02em;
        }


        .modal-description {
            margin-top: 7px;

            color: #64748b;

            font-size: 12px;
            line-height: 1.65;
            font-weight: 500;
        }


        .modal-label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 12px;
            line-height: 1.4;
            font-weight: 850;
        }


        .modal-input {
            width: 100%;
            height: 43px;

            padding: 0 12px;

            border: 1px solid #e2e8f0;
            border-radius: 10px;

            outline: none;

            background: #ffffff;
            color: #0f172a;

            font-size: 13px;
            font-weight: 650;
        }


        .modal-input:focus {
            border-color: #93c5fd;

            box-shadow:
                0 0 0 3px rgba(59, 130, 246, .10);
        }


        .modal-actions {
            display: flex;
            justify-content: flex-end;

            gap: 8px;

            margin-top: 19px;
        }


        .modal-cancel,
        .modal-submit {
            height: 39px;

            padding: 0 14px;

            border-radius: 9px;

            font-size: 11px;
            line-height: 1;
            font-weight: 850;

            cursor: pointer;
        }


        .modal-cancel {
            border: 1px solid #e2e8f0;

            background: #ffffff;
            color: #64748b;
        }


        .modal-cancel:hover {
            background: #f8fafc;
        }


        .modal-submit {
            border: 1px solid #0f172a;

            background: #0f172a;
            color: #ffffff;
        }


        .modal-submit:hover {
            background: #1e293b;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }


        @media (max-width: 700px) {

            .container {
                width: min(100% - 28px, 1080px);

                padding-top: 25px;
            }


            h1 {
                font-size: 27px;
            }


            .meeting-toolbar {
                align-items: stretch;
                flex-direction: column;
            }


            .meetings {
                width: 100%;
                flex-wrap: wrap;
                overflow-x: visible;
            }

            .meeting-item {
                max-width: 100%;
                flex-wrap: wrap;
            }

            .meeting-item .meeting {
                flex: 1 1 auto;
            }


            .meeting-add {
                width: 100%;
            }


            .meeting-delete-area {
                justify-content: stretch;
            }


            .meeting-delete {
                width: 100%;
            }


            .content-header {
                align-items: flex-start;
                flex-direction: column;
            }


            .add-button {
                width: 100%;
            }


            .video-top {
                flex-direction: column;
            }


            .actions {
                width: 100%;
            }


            .action {
                flex: 1;
            }


            .limit {
                text-align: left;
            }

        }
.content-header {
    width: min(100%, 1020px);
    margin-left: auto;
    margin-right: auto;
    padding-left: 16px;
    padding-right: 16px;
}

/* =====================================================
   RAPIKAN POSISI CONTENT VIDEO
   Supaya tabel & Pertemuan tidak terlalu ke kanan
===================================================== */

.main-content {
    padding-right: 24px;
}


/* Container utama */

.container {
    width: min(
        100%,
        1080px
    );

    margin-left: auto;
    margin-right: auto;

    padding-left: 20px;
    padding-right: 20px;
}


/* =====================================================
   BAGIAN PERTEMUAN VIDEO
===================================================== */

.meeting-section,
.meetings-wrapper,
.meeting-toolbar {
    width: min(
        100%,
        1040px
    );

    margin-left: auto;
    margin-right: auto;
}


/* =====================================================
   CONTENT HEADER
===================================================== */

.content-header {
    width: min(
        100%,
        1040px
    );

    margin-left: auto;
    margin-right: auto;

    padding-left: 12px;
    padding-right: 12px;
}


/* =====================================================
   DAFTAR / TABEL VIDEO
===================================================== */

.video-table,
.video-list,
.table-wrapper,
.videos-table {
    width: min(
        100%,
        1040px
    );

    margin-left: auto;
    margin-right: auto;
}


/* Jika tabel berada dalam card */

.card,
.table-card {
    width: min(
        100%,
        1040px
    );

    margin-left: auto;
    margin-right: auto;
}


/* =====================================================
   AREA VIDEO
===================================================== */

.video-card,
.video-item {
    max-width: 1040px;

    margin-left: auto;
    margin-right: auto;
}


/* =====================================================
   PERTEMUAN BUTTON
===================================================== */

.meetings {
    max-width: 1040px;

    margin-left: auto;
    margin-right: auto;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 1023px) {

    .main-content {
        padding-right: 0;
    }

}


@media (max-width: 640px) {

    .container {
        width: 100%;

        padding-left: 14px;
        padding-right: 14px;
    }


    .content-header,
    .meeting-section,
    .meetings-wrapper,
    .meeting-toolbar,
    .video-table,
    .video-list,
    .table-wrapper,
    .videos-table,
    .card,
    .table-card,
    .video-card,
    .video-item,
    .meetings {
        width: 100%;

        padding-left: 0;
        padding-right: 0;
    }

}
    </style>

</head>


<body>


    {{-- =========================================================
         SIDEBAR GLOBAL
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="main-content">


        {{-- =========================================================
             HEADBAR GURU
        ========================================================== --}}

        @include('guru.partials.header')


        <div class="container">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="heading">

                <div class="eyebrow">
                    Panel Guru
                </div>

                <h1>
                    Video Pembelajaran
                </h1>

                <p class="subtitle">
                    Kelola video pembelajaran berdasarkan pertemuan.
                    Setiap pertemuan dapat memiliki maksimal 10 video.
                </p>

            </section>



            {{-- =================================================
                 SUCCESS
            ================================================== --}}

            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif



            {{-- =================================================
                 PERTEMUAN VIDEO
            ================================================== --}}

            <section class="meeting-card">

                <div class="meeting-label">
                    Pertemuan Video
                </div>


                <div class="meeting-toolbar">


                    {{-- =================================================
                         DAFTAR PERTEMUAN
                    ================================================== --}}

                    <div class="meetings">

                        @forelse($meetings as $meeting)

                            <div class="meeting-item">

                                <a
                                    href="{{ route('guru.videos.index', [
                                        'pertemuan' => $meeting->pertemuan
                                    ]) }}"
                                    class="
                                        meeting
                                        {{
                                            (int) $pertemuan ===
                                            (int) $meeting->pertemuan
                                                ? 'active'
                                                : ''
                                        }}
                                    "
                                >
                                    Pertemuan {{ $meeting->pertemuan }}
                                </a>

                                @if($meeting->aktif)
                                    <span class="meeting-status on">
                                        <i data-lucide="eye" class="w-3 h-3"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="meeting-status off">
                                        <i data-lucide="eye-off" class="w-3 h-3"></i>
                                        Nonaktif
                                    </span>
                                @endif

                                <form
                                    method="POST"
                                    action="{{ route('guru.videos.meetings.toggle', $meeting) }}"
                                    onsubmit="return confirm('{{ $meeting->aktif ? 'Nonaktifkan' : 'Aktifkan' }} Pertemuan {{ $meeting->pertemuan }} untuk siswa?');"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="meeting-toggle {{ $meeting->aktif ? 'on' : 'off' }}"
                                    >
                                        <i data-lucide="{{ $meeting->aktif ? 'power-off' : 'power' }}" class="w-3 h-3"></i>
                                        {{ $meeting->aktif ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>

                            </div>

                        @empty

                            <span
                                class="
                                    text-sm
                                    text-slate-400
                                    py-2
                                    font-medium
                                "
                            >
                                Belum ada Pertemuan Video.
                            </span>

                        @endforelse

                    </div>



                    {{-- =================================================
                         TAMBAH PERTEMUAN
                    ================================================== --}}

                    <button
                        type="button"
                        class="meeting-add"
                        onclick="openMeetingModal()"
                    >

                        <i
                            data-lucide="plus"
                            class="w-3.5 h-3.5"
                        ></i>

                        Tambah Pertemuan

                    </button>

                </div>



                {{-- =================================================
                     HAPUS PERTEMUAN AKTIF
                ================================================== --}}

                @if(
                    $meetings->isNotEmpty() &&
                    $meetings->contains(
                        'pertemuan',
                        (int) $pertemuan
                    )
                )

                    <div class="meeting-delete-area">

                        <form
                            method="POST"
                            action="{{ route(
                                'guru.videos.meetings.destroy',
                                $meetings->firstWhere(
                                    'pertemuan',
                                    (int) $pertemuan
                                )
                            ) }}"
                            onsubmit="
                                return confirm(
                                    'Hapus Pertemuan {{ $pertemuan }} beserta seluruh video di dalamnya?'
                                );
                            "
                        >

                            @csrf

                            @method('DELETE')

                            <button
                                type="submit"
                                class="meeting-delete"
                            >

                                <i
                                    data-lucide="trash-2"
                                    class="w-3.5 h-3.5"
                                ></i>

                                Hapus Pertemuan Ini

                            </button>

                        </form>

                    </div>

                @endif

            </section>



            {{-- =================================================
     CONTENT HEADER
================================================== --}}

<div
    class="
        content-header
        max-w-5xl
        mx-auto
        px-2
        lg:px-4
        flex
        items-center
        justify-between
        gap-4
    "
>

    <div>

        <div class="content-title">
            Video Pertemuan {{ $pertemuan }}
        </div>

        <div class="counter">
            {{ $videos->count() }} dari 10 video
        </div>

    </div>


    @if(
        $meetings->isNotEmpty() &&
        $videos->count() < 10
    )

        <a
            href="{{ route('guru.videos.create', [
                'pertemuan' => $pertemuan
            ]) }}"
            class="add-button flex-shrink-0"
        >

            <i
                data-lucide="plus"
                class="w-4 h-4"
            ></i>

            Tambah Video

        </a>

    @endif

</div>


            {{-- =================================================
                 DAFTAR VIDEO
            ================================================== --}}

            @if($videos->count())

                <section class="video-list">

                    @foreach($videos as $video)

                        <article class="video-card">

                            <div class="video-top">


                                {{-- =================================================
                                     INFORMASI VIDEO
                                ================================================== --}}

                                <div class="video-main">

                                    <span class="video-number">
                                        {{ $video->urutan }}
                                    </span>

                                    <span class="video-title">
                                        {{ $video->judul }}
                                    </span>


                                    @if($video->deskripsi)

                                        <div class="video-description">
                                            {{ $video->deskripsi }}
                                        </div>

                                    @endif


                                    <a
                                        href="{{ $video->youtube_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="youtube-link"
                                    >

                                        {{ $video->youtube_url }}

                                    </a>

                                </div>



                                {{-- =================================================
                                     ACTION
                                ================================================== --}}

                                <div class="actions">

                                    <a
                                        href="{{ route(
                                            'guru.videos.edit',
                                            $video
                                        ) }}"
                                        class="action edit"
                                    >

                                        <i
                                            data-lucide="pencil"
                                            class="w-3.5 h-3.5"
                                        ></i>

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route(
                                            'guru.videos.destroy',
                                            $video
                                        ) }}"
                                        method="POST"
                                        onsubmit="
                                            return confirm(
                                                'Hapus video ini?'
                                            );
                                        "
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="action delete"
                                        >

                                            <i
                                                data-lucide="trash-2"
                                                class="w-3.5 h-3.5"
                                            ></i>

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </section>

            @else

                <section class="empty">

                    <div class="empty-icon">

                        <i
                            data-lucide="video"
                            class="w-6 h-6 text-slate-400"
                        ></i>

                    </div>


                    <div class="empty-title">

                        @if($meetings->isEmpty())

                            Belum ada Pertemuan Video

                        @else

                            Belum ada video

                        @endif

                    </div>


                    <div class="empty-text">

                        @if($meetings->isEmpty())

                            Silakan tambahkan Pertemuan Video
                            terlebih dahulu.

                        @else

                            Belum ada video pembelajaran untuk
                            Pertemuan {{ $pertemuan }}.
                            Silakan tambahkan video YouTube.

                        @endif

                    </div>

                </section>

            @endif



            {{-- =================================================
                 LIMIT
            ================================================== --}}

            @if($meetings->isNotEmpty())

                <div class="limit">
                    Maksimal 10 video untuk setiap pertemuan.
                </div>

            @endif

        </div>

    </main>



    {{-- =========================================================
         MODAL TAMBAH PERTEMUAN
    ========================================================== --}}

    <div
        id="meetingModal"
        class="modal-overlay"
    >

        <div class="modal">

            <div class="modal-title">
                Tambah Pertemuan Video
            </div>


            <div class="modal-description">
                Pertemuan Video berdiri sendiri dan tidak
                bergantung pada Material.
            </div>


            <form
                method="POST"
                action="{{ route('guru.videos.meetings.store') }}"
            >

                @csrf


                <div class="mt-5">

                    <label
                        for="pertemuan"
                        class="modal-label"
                    >
                        Nomor Pertemuan
                    </label>


                    <input
                        id="pertemuan"
                        type="number"
                        name="pertemuan"
                        min="1"
                        max="255"
                        required
                        class="modal-input"
                        placeholder="Contoh: 1"
                    >

                </div>


                <div class="modal-actions">

                    <button
                        type="button"
                        class="modal-cancel"
                        onclick="closeMeetingModal()"
                    >
                        Batal
                    </button>


                    <button
                        type="submit"
                        class="modal-submit"
                    >
                        Tambah Pertemuan
                    </button>

                </div>

            </form>

        </div>

    </div>



    {{-- =========================================================
         SCRIPT
    ========================================================== --}}

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


        function openMeetingModal()
        {
            const modal =
                document.getElementById(
                    'meetingModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.add('active');


            const input =
                document.getElementById(
                    'pertemuan'
                );


            if (input) {
                input.focus();
            }
        }


        function closeMeetingModal()
        {
            const modal =
                document.getElementById(
                    'meetingModal'
                );


            if (!modal) {
                return;
            }


            modal.classList.remove('active');
        }


        document
            .getElementById('meetingModal')
            ?.addEventListener(
                'click',
                function (event) {

                    if (
                        event.target === this
                    ) {

                        closeMeetingModal();

                    }

                }
            );


        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape'
                ) {

                    closeMeetingModal();

                }

            }
        );

    </script>


</body>

</html>