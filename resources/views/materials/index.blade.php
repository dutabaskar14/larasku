<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Materi Pembelajaran — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
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


        /* =========================================================
           MAIN
        ========================================================== */

        .material-main {
            min-height: 100vh;
            margin-left: 240px;
        }


        .material-content {
            width: min(1050px, calc(100% - 32px));
            margin: 0 auto;
            padding: 25px 0 40px;
        }


        /* =========================================================
           TOPBAR
        ========================================================== */

        .material-topbar {
            height: 62px;

            background: rgba(255, 255, 255, .94);

            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 25px;

            position: sticky;
            top: 0;

            z-index: 20;

            backdrop-filter: blur(12px);
        }


        .material-topbar-title {
            font-size: 14px;
            font-weight: 800;
            color: #334155;
        }


        .material-topbar-badge {
            padding: 6px 10px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 8px;

            font-size: 10px;
            font-weight: 800;

            color: #64748b;
        }


        /* =========================================================
           HEADER
        ========================================================== */

        .page-header {
            margin-bottom: 18px;
        }


        .eyebrow {
            color: #2563eb;

            font-size: 9px;
            font-weight: 900;

            text-transform: uppercase;
            letter-spacing: .12em;

            margin-bottom: 4px;
        }


        .page-title {
            margin: 0;

            font-size: 27px;
            line-height: 1.15;

            font-weight: 900;
            letter-spacing: -.045em;

            color: #0f172a;
        }


        .page-description {
            margin: 5px 0 0;

            color: #64748b;

            font-size: 11px;
            line-height: 1.5;
        }


        /* =========================================================
           PERTEMUAN
        ========================================================== */

        .meeting-section {
            margin-bottom: 15px;
        }


        .meeting-heading {
            display: flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 8px;
        }


        .meeting-heading-icon {
            width: 30px;
            height: 30px;

            border-radius: 8px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .meeting-heading-text h2 {
            margin: 0;

            font-size: 12px;
            font-weight: 850;

            color: #0f172a;
        }


        .meeting-heading-text p {
            margin: 1px 0 0;

            font-size: 9px;

            color: #94a3b8;
        }


        .meeting-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }


        .meeting-card {
            position: relative;

            display: flex;
            align-items: center;
            gap: 7px;

            min-width: 105px;

            padding: 8px 10px;

            border-radius: 9px;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            color: #475569;

            text-decoration: none;

            transition:
                transform .15s ease,
                border-color .15s ease,
                box-shadow .15s ease,
                background .15s ease;
        }


        .meeting-card:hover {
            transform: translateY(-1px);

            border-color: #bfdbfe;

            background: #f8fbff;

            box-shadow:
                0 5px 14px
                rgba(15, 23, 42, .05);
        }


        .meeting-card.active {
            border-color: #2563eb;

            background: #eff6ff;

            color: #1d4ed8;

            box-shadow:
                0 5px 14px
                rgba(37, 99, 235, .08);
        }


        .meeting-number {
            width: 27px;
            height: 27px;

            min-width: 27px;

            border-radius: 7px;

            background: #f1f5f9;

            color: #64748b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 10px;
            font-weight: 900;
        }


        .meeting-card.active .meeting-number {
            background: #2563eb;
            color: #ffffff;
        }


        .meeting-info {
            min-width: 0;
        }


        .meeting-info strong {
            display: block;

            font-size: 10px;
            font-weight: 850;

            color: #334155;
        }


        .meeting-card.active .meeting-info strong {
            color: #1d4ed8;
        }


        .meeting-info span {
            display: block;

            margin-top: 1px;

            font-size: 8px;

            color: #94a3b8;
        }


        .meeting-card.active .meeting-info span {
            color: #60a5fa;
        }


        .meeting-arrow {
            margin-left: auto;

            color: #cbd5e1;
        }


        .meeting-card.active .meeting-arrow {
            color: #2563eb;
        }


        /* =========================================================
           SELECTED MEETING
        ========================================================== */

        .selected-meeting {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 12px;

            margin-bottom: 12px;

            padding: 11px 13px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 10px;
        }


        .selected-left {
            display: flex;
            align-items: center;
            gap: 9px;
        }


        .selected-icon {
            width: 31px;
            height: 31px;

            border-radius: 8px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .selected-text small {
            display: block;

            font-size: 8px;
            font-weight: 800;

            text-transform: uppercase;
            letter-spacing: .08em;

            color: #94a3b8;
        }


        .selected-text strong {
            display: block;

            margin-top: 1px;

            font-size: 13px;
            font-weight: 850;

            color: #0f172a;
        }


        .selected-count {
            padding: 5px 8px;

            border-radius: 7px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            color: #64748b;

            font-size: 9px;
            font-weight: 750;

            white-space: nowrap;
        }


        /* =========================================================
           MATERIAL LIST
        ========================================================== */

        .material-list {
            display: grid;
            gap: 11px;
        }


        .material-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            overflow: hidden;

            box-shadow:
                0 3px 13px
                rgba(15, 23, 42, .025);

            transition:
                transform .15s ease,
                box-shadow .15s ease;
        }


        .material-card:hover {
            transform: translateY(-1px);

            box-shadow:
                0 8px 20px
                rgba(15, 23, 42, .05);
        }


        .material-head {
            padding: 13px 15px;

            border-bottom: 1px solid #f1f5f9;
        }


        .material-meta {
            display: flex;
            align-items: center;

            flex-wrap: wrap;

            gap: 5px;

            margin-bottom: 6px;
        }


        .material-meeting {
            display: inline-flex;
            align-items: center;

            padding: 3px 7px;

            border-radius: 6px;

            background: #eff6ff;
            color: #2563eb;

            font-size: 8px;
            font-weight: 850;
        }


        .material-category {
            display: inline-flex;
            align-items: center;

            padding: 3px 7px;

            border-radius: 6px;

            background: #f8fafc;
            color: #64748b;

            font-size: 8px;
            font-weight: 750;
        }


        .material-title {
            margin: 0;

            font-size: 16px;
            line-height: 1.3;

            font-weight: 850;
            letter-spacing: -.02em;

            color: #0f172a;
        }


        /* =========================================================
           MATERIAL CONTENT
        ========================================================== */

        .material-body {
            padding: 15px;
        }


        .material-body-content {
            color: #475569;

            font-size: 12px;
            line-height: 1.7;
        }


        .material-body-content h1 {
            margin: 0 0 12px;

            font-size: 23px;
            line-height: 1.25;

            font-weight: 900;

            color: #0f172a;
        }


        .material-body-content h2 {
            margin: 22px 0 9px;

            font-size: 18px;
            line-height: 1.3;

            font-weight: 850;

            color: #0f172a;
        }


        .material-body-content h3 {
            margin: 18px 0 7px;

            font-size: 15px;
            line-height: 1.4;

            font-weight: 800;

            color: #1e293b;
        }


        .material-body-content h4 {
            margin: 15px 0 6px;

            font-size: 13px;

            font-weight: 800;

            color: #334155;
        }


        .material-body-content p {
            margin: 0 0 11px;
        }


        .material-body-content strong {
            color: #1e293b;
            font-weight: 800;
        }


        .material-body-content ul,
        .material-body-content ol {
            margin: 9px 0 13px;
            padding-left: 22px;
        }


        .material-body-content li {
            margin-bottom: 5px;
        }


        .material-body-content ul li::marker {
            color: #3b82f6;
        }


        .material-body-content blockquote {
            margin: 15px 0;

            padding: 11px 14px;

            border-left: 3px solid #3b82f6;

            background: #f8fafc;

            color: #475569;

            border-radius: 0 8px 8px 0;
        }


        /* =========================================================
           TABLE
        ========================================================== */

        .material-body-content table {
            width: 100%;

            border-collapse: separate;
            border-spacing: 0;

            margin: 16px 0;

            overflow: hidden;

            border: 1px solid #e2e8f0;

            border-radius: 9px;

            font-size: 11px;
        }


        .material-body-content th,
        .material-body-content td {
            padding: 8px 10px;

            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;

            text-align: left;
            vertical-align: top;
        }


        .material-body-content th:last-child,
        .material-body-content td:last-child {
            border-right: 0;
        }


        .material-body-content tr:last-child td {
            border-bottom: 0;
        }


        .material-body-content th {
            background: #f8fafc;

            color: #0f172a;

            font-weight: 800;
        }


        .material-body-content tr:hover td {
            background: #fafcff;
        }


        /* =========================================================
           IMAGE
        ========================================================== */

        .material-body-content img {
            display: block;

            max-width: 100%;
            height: auto;

            margin: 15px auto;

            border-radius: 9px;
        }


        /* =========================================================
           VIDEO / AUDIO DARI RICH TEXT
        ========================================================== */

        .material-body-content iframe {
            max-width: 100%;
            border: 0;
            border-radius: 9px;
        }


        .material-body-content video {
            display: block;

            width: 100%;
            max-width: 800px;

            margin: 14px auto;

            border-radius: 9px;
        }


        .material-body-content audio {
            width: 100%;
            max-width: 700px;

            margin: 10px auto;

            display: block;
        }


        /* =========================================================
           FOOTER
        ========================================================== */

        .material-footer {
            padding: 10px 15px;

            border-top: 1px solid #f1f5f9;

            display: flex;
            justify-content: flex-end;
        }


        .open-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            padding: 8px 11px;

            border-radius: 8px;

            background: #0f172a;
            color: #ffffff;

            text-decoration: none;

            font-size: 10px;
            font-weight: 800;

            transition: .15s ease;
        }


        .open-button:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }


        /* =========================================================
           EMPTY
        ========================================================== */

        .empty {
            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 12px;

            padding: 35px 18px;

            text-align: center;
        }


        .empty-icon {
            width: 42px;
            height: 42px;

            margin: 0 auto 10px;

            border-radius: 11px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }


        .empty-title {
            font-size: 14px;
            font-weight: 850;

            color: #0f172a;
        }


        .empty-text {
            max-width: 500px;

            margin: 5px auto 0;

            color: #94a3b8;

            font-size: 10px;
            line-height: 1.5;
        }


        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1023px) {

            .material-main {
                margin-left: 0;
            }

            .material-content {
                width: calc(100% - 28px);
            }

            .meeting-grid {
                gap: 6px;
            }

        }


        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 600px) {

            .material-topbar {
                height: 56px;
                padding: 0 13px;
            }


            .material-topbar-title {
                font-size: 12px;
            }


            .material-topbar-badge {
                display: none;
            }


            .material-content {
                width: calc(100% - 16px);
                padding: 15px 0 30px;
            }


            .page-header {
                margin-bottom: 12px;
            }


            .page-title {
                font-size: 22px;
            }


            .page-description {
                font-size: 10px;
            }


            .meeting-section {
                margin-bottom: 11px;
            }


            .meeting-heading {
                margin-bottom: 6px;
            }


            .meeting-heading-icon {
                width: 27px;
                height: 27px;
            }


            .meeting-heading-text h2 {
                font-size: 10px;
            }


            .meeting-heading-text p {
                font-size: 8px;
            }


            .meeting-grid {
                display: flex;
                flex-wrap: nowrap;

                overflow-x: auto;

                gap: 5px;

                padding-bottom: 2px;

                scrollbar-width: none;
            }


            .meeting-grid::-webkit-scrollbar {
                display: none;
            }


            .meeting-card {
                min-width: 88px;

                padding: 7px 8px;

                border-radius: 8px;

                gap: 6px;
            }


            .meeting-number {
                width: 24px;
                height: 24px;
                min-width: 24px;

                border-radius: 6px;

                font-size: 9px;
            }


            .meeting-info strong {
                font-size: 9px;
            }


            .meeting-info span {
                font-size: 7px;
            }


            .selected-meeting {
                margin-bottom: 9px;
                padding: 9px 10px;
                border-radius: 9px;
            }


            .selected-icon {
                width: 27px;
                height: 27px;
            }


            .selected-text small {
                font-size: 7px;
            }


            .selected-text strong {
                font-size: 11px;
            }


            .selected-count {
                padding: 4px 7px;
                font-size: 8px;
            }


            .material-list {
                gap: 8px;
            }


            .material-card {
                border-radius: 10px;
            }


            .material-head {
                padding: 10px 11px;
            }


            .material-title {
                font-size: 13px;
            }


            .material-meeting,
            .material-category {
                padding: 3px 6px;
                font-size: 7px;
            }


            .material-body {
                padding: 11px;
            }


            .material-body-content {
                font-size: 10px;
                line-height: 1.6;
            }


            .material-body-content h1 {
                font-size: 19px;
                margin-bottom: 9px;
            }


            .material-body-content h2 {
                font-size: 15px;
                margin: 17px 0 7px;
            }


            .material-body-content h3 {
                font-size: 13px;
                margin: 14px 0 6px;
            }


            .material-body-content p {
                margin-bottom: 8px;
            }


            .material-body-content ul,
            .material-body-content ol {
                padding-left: 19px;
                margin: 7px 0 10px;
            }


            .material-body-content table {
                display: block;

                overflow-x: auto;

                white-space: nowrap;

                font-size: 9px;
            }


            .material-body-content th,
            .material-body-content td {
                padding: 6px 8px;
            }


            .material-body-content img {
                margin: 10px auto;
                border-radius: 7px;
            }


            .material-footer {
                padding: 8px 11px;
            }


            .open-button {
                padding: 7px 9px;
                font-size: 9px;
            }


            .empty {
                padding: 28px 14px;
            }


            .empty-icon {
                width: 38px;
                height: 38px;
            }


            .empty-title {
                font-size: 12px;
            }


            .empty-text {
                font-size: 9px;
            }

        }

    </style>

</head>


<body>

    {{-- =========================================================
         SIDEBAR SISWA
    ========================================================== --}}

    @include('partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="material-main">


        {{-- =====================================================
             TOPBAR
        ====================================================== --}}

        <header class="material-topbar">

            <div class="material-topbar-title">
                Materi Pembelajaran
            </div>

            <div class="material-topbar-badge">
                LARASKU
            </div>

        </header>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="material-content">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="page-header">

                <div class="eyebrow">
                    Pembelajaran Seni Musik
                </div>

                <h1 class="page-title">
                    Materi Pembelajaran
                </h1>

                <p class="page-description">
                    Pilih pertemuan untuk melihat materi
                    yang akan dipelajari.
                </p>

            </section>


            {{-- =================================================
                 PERTEMUAN
                 DATA DARI material_meetings
            ================================================== --}}

            <section class="meeting-section">


                <div class="meeting-heading">

                    <div class="meeting-heading-icon">

                        <i
                            data-lucide="book-open"
                            style="width:16px;height:16px;"
                        ></i>

                    </div>


                    <div class="meeting-heading-text">

                        <h2>
                            Pertemuan Pembelajaran
                        </h2>

                        <p>
                            Pilih pertemuan sesuai kegiatan pembelajaran.
                        </p>

                    </div>

                </div>


                <div class="meeting-grid">

                    @forelse($meetings as $meeting)

                        <a
                            href="{{ route('materials.index', [
                                'pertemuan' => $meeting->pertemuan
                            ]) }}"
                            class="
                                meeting-card
                                {{ (int) $pertemuan === (int) $meeting->pertemuan ? 'active' : '' }}
                            "
                        >

                            <div class="meeting-number">
                                {{ $meeting->pertemuan }}
                            </div>


                            <div class="meeting-info">

                                <strong>
                                    Pertemuan {{ $meeting->pertemuan }}
                                </strong>

                                <span>
                                    Materi pembelajaran
                                </span>

                            </div>


                            <div class="meeting-arrow">

                                <i
                                    data-lucide="chevron-right"
                                    style="width:14px;height:14px;"
                                ></i>

                            </div>

                        </a>

                    @empty

                        <div
                            style="
                                width:100%;
                                padding:12px;
                                border:1px solid #e2e8f0;
                                border-radius:9px;
                                background:#fff;
                                color:#94a3b8;
                                font-size:10px;
                                text-align:center;
                            "
                        >
                            Belum ada pertemuan materi yang tersedia.
                        </div>

                    @endforelse

                </div>

            </section>


            {{-- =================================================
                 BELUM ADA PERTEMUAN
            ================================================== --}}

            @if($pertemuan === null)

                <div class="empty">

                    <div class="empty-icon">

                        <i
                            data-lucide="book-open"
                            style="width:20px;height:20px;"
                        ></i>

                    </div>


                    <div class="empty-title">
                        Pilih Pertemuan
                    </div>


                    <div class="empty-text">
                        Silakan pilih salah satu pertemuan
                        untuk melihat materi yang tersedia.
                    </div>

                </div>


            {{-- =================================================
                 ADA MATERI
            ================================================== --}}

            @elseif($materials->count())


                {{-- =================================================
                     PERTEMUAN TERPILIH
                ================================================== --}}

                <div class="selected-meeting">

                    <div class="selected-left">

                        <div class="selected-icon">

                            <i
                                data-lucide="graduation-cap"
                                style="width:17px;height:17px;"
                            ></i>

                        </div>


                        <div class="selected-text">

                            <small>
                                Pertemuan Terpilih
                            </small>

                            <strong>
                                Pertemuan {{ $pertemuan }}
                            </strong>

                        </div>

                    </div>


                    <div class="selected-count">

                        {{ $materials->count() }}

                        {{ $materials->count() === 1 ? 'Materi' : 'Materi' }}

                    </div>

                </div>


                {{-- =================================================
                     DAFTAR MATERIAL
                ================================================== --}}

                <div class="material-list">

                    @foreach($materials as $material)

                        <article class="material-card">


                            {{-- =====================================
                                 HEADER MATERIAL
                            ====================================== --}}

                            <div class="material-head">

                                <div class="material-meta">

                                    <span class="material-meeting">

                                        Pertemuan
                                        {{ $material->pertemuan }}

                                    </span>


                                    @if($material->kategori)

                                        <span class="material-category">

                                            {{ $material->kategori }}

                                        </span>

                                    @endif

                                </div>


                                <h2 class="material-title">

                                    {{ $material->judul }}

                                </h2>

                            </div>


                            {{-- =====================================
                                 ISI MATERIAL
                            ====================================== --}}

                            <div class="material-body">

                                <div class="material-body-content">

                                    {!! $material->isi !!}

                                </div>


                                {{-- =================================
                                     VIDEO MATERIAL
                                ================================== --}}

                                @if($material->video_url)

                                    <div
                                        style="
                                            margin-top:12px;
                                            padding:10px;
                                            border:1px solid #e2e8f0;
                                            border-radius:9px;
                                            background:#f8fafc;
                                        "
                                    >

                                        <div
                                            style="
                                                margin-bottom:6px;
                                                color:#64748b;
                                                font-size:8px;
                                                font-weight:850;
                                                text-transform:uppercase;
                                                letter-spacing:.08em;
                                            "
                                        >
                                            Video Materi
                                        </div>

                                        <a
                                            href="{{ $material->video_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="open-button"
                                        >

                                            <i
                                                data-lucide="play-circle"
                                                style="width:13px;height:13px;"
                                            ></i>

                                            Buka Video

                                        </a>

                                    </div>

                                @endif


                                {{-- =================================
                                     AUDIO MATERIAL
                                ================================== --}}

                                @if($material->audio_url)

                                    <div
                                        style="
                                            margin-top:9px;
                                            padding:10px;
                                            border:1px solid #e2e8f0;
                                            border-radius:9px;
                                            background:#f8fafc;
                                        "
                                    >

                                        <div
                                            style="
                                                margin-bottom:6px;
                                                color:#64748b;
                                                font-size:8px;
                                                font-weight:850;
                                                text-transform:uppercase;
                                                letter-spacing:.08em;
                                            "
                                        >
                                            Audio Materi
                                        </div>

                                        <audio
                                            controls
                                            preload="metadata"
                                            style="width:100%;"
                                        >

                                            <source
                                                src="{{ $material->audio_url }}"
                                            >

                                            Browser Anda tidak mendukung
                                            pemutar audio.

                                        </audio>

                                    </div>

                                @endif


                                {{-- =================================
                                     GAMBAR MATERIAL
                                ================================== --}}

                                @if($material->gambar)

                                    <div
                                        style="
                                            margin-top:10px;
                                            text-align:center;
                                        "
                                    >

                                        <img
                                            src="{{ asset('storage/' . $material->gambar) }}"
                                            alt="{{ $material->judul }}"
                                            style="
                                                max-width:100%;
                                                height:auto;
                                                border-radius:9px;
                                            "
                                        >

                                    </div>

                                @endif

                            </div>


                            {{-- =====================================
                                 FOOTER
                            ====================================== --}}

                            <div class="material-footer">

                                <a
                                    href="{{ route('materials.show', $material) }}"
                                    class="open-button"
                                >

                                    <i
                                        data-lucide="book-open"
                                        style="width:13px;height:13px;"
                                    ></i>

                                    Buka Materi

                                    <i
                                        data-lucide="arrow-right"
                                        style="width:13px;height:13px;"
                                    ></i>

                                </a>

                            </div>


                        </article>

                    @endforeach

                </div>


            {{-- =================================================
                 PERTEMUAN TANPA MATERI
            ================================================== --}}

            @else

                <div class="empty">

                    <div class="empty-icon">

                        <i
                            data-lucide="book-open"
                            style="width:20px;height:20px;"
                        ></i>

                    </div>


                    <div class="empty-title">
                        Materi Belum Tersedia
                    </div>


                    <div class="empty-text">
                        Belum ada materi aktif untuk
                        Pertemuan {{ $pertemuan }}.
                    </div>

                </div>

            @endif


        </div>

    </main>


    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                if (
                    typeof lucide !== 'undefined'
                    &&
                    typeof lucide.createIcons === 'function'
                ) {

                    lucide.createIcons();

                }

            }
        );

    </script>

</body>

</html>