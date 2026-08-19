<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $material->judul }} — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            background:
                radial-gradient(
                    circle at 75% 0%,
                    rgba(37, 99, 235, .055),
                    transparent 28%
                ),
                #f5f7fb;

            color: #172033;

            font-family:
                "DM Sans",
                "Inter",
                sans-serif;
        }

        .main-content {
            min-height: 100vh;
        }

        /* =========================================================
           HEADER
        ========================================================== */

        .top-header {
            height: 66px;
            background: rgba(255, 255, 255, .94);
            border-bottom: 1px solid #e7ebf2;
            backdrop-filter: blur(16px);
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            color: white;
            font-size: 13px;
            font-weight: 800;

            box-shadow:
                0 6px 18px rgba(37, 99, 235, .20);
        }

        /* =========================================================
           PAGE
        ========================================================== */

        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 28px 24px 50px;
        }

        /* =========================================================
           BREADCRUMB
        ========================================================== */

        .breadcrumb {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;

            margin-bottom: 18px;

            font-size: 11px;
            font-weight: 700;
        }

        .breadcrumb a {
            color: #94a3b8;
            text-decoration: none;
            transition: .18s ease;
        }

        .breadcrumb a:hover {
            color: #2563eb;
        }

        .breadcrumb-current {
            color: #2563eb;
        }

        .breadcrumb-separator {
            color: #cbd5e1;
        }

        /* =========================================================
           HERO
        ========================================================== */

        .hero-card {
            position: relative;
            overflow: hidden;

            background: #fff;

            border:
                1px solid
                #e4e9f1;

            border-radius: 22px;

            box-shadow:
                0 12px 40px rgba(15, 23, 42, .045);

            margin-bottom: 22px;
        }

        .hero-card::before {
            content: "";

            position: absolute;

            width: 320px;
            height: 320px;

            right: -140px;
            top: -190px;

            border-radius: 999px;

            background:
                radial-gradient(
                    circle,
                    rgba(59, 130, 246, .13),
                    transparent 68%
                );

            pointer-events: none;
        }

        .hero-line {
            height: 4px;

            background:
                linear-gradient(
                    90deg,
                    #2563eb 0%,
                    #3b82f6 45%,
                    #60a5fa 100%
                );
        }

        .hero-body {
            position: relative;
            z-index: 2;

            padding: 27px 29px;
        }

        .hero-layout {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;

            gap: 28px;
        }

        .hero-main {
            min-width: 0;
        }

        /* =========================================================
           BADGES
        ========================================================== */

        .badges {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 7px;

            margin-bottom: 13px;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;

            min-height: 29px;

            padding:
                0 10px;

            border-radius: 9px;

            font-size: 10px;
            font-weight: 800;
        }

        .badge-meeting {
            background: #eff6ff;
            color: #2563eb;
            border: 1px solid #dbeafe;
        }

        .badge-category {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e9eef5;
        }

        .badge-active {
            background: #ecfdf5;
            color: #15803d;
            border: 1px solid #d1fae5;
        }

        .badge-inactive {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }

        .status-dot {
            width: 6px;
            height: 6px;

            border-radius: 999px;

            background: currentColor;
        }

        /* =========================================================
           TITLE
        ========================================================== */

        .hero-title {
            margin: 0;

            max-width: 790px;

            color: #0f172a;

            font-size: clamp(
                26px,
                4vw,
                40px
            );

            line-height: 1.13;

            letter-spacing: -.035em;

            font-weight: 900;
        }

        .hero-meta {
            display: flex;
            align-items: center;
            flex-wrap: wrap;

            gap: 8px;

            margin-top: 12px;

            color: #94a3b8;

            font-size: 11px;
            font-weight: 600;
        }

        .meta-dot {
            width: 3px;
            height: 3px;

            background: #cbd5e1;

            border-radius: 50%;
        }

        /* =========================================================
           EDIT BUTTON
        ========================================================== */

        .edit-button {
            flex-shrink: 0;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 43px;

            padding:
                0 16px;

            border-radius: 11px;

            color: #fff;

            background:
                linear-gradient(
                    135deg,
                    #2563eb,
                    #1d4ed8
                );

            text-decoration: none;

            font-size: 12px;
            font-weight: 800;

            box-shadow:
                0 7px 20px rgba(37, 99, 235, .18);

            transition:
                transform .18s ease,
                box-shadow .18s ease;
        }

        .edit-button:hover {
            transform: translateY(-1px);

            box-shadow:
                0 10px 25px rgba(37, 99, 235, .24);
        }

        /* =========================================================
           CONTENT GRID
        ========================================================== */

        .content-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                320px;

            gap: 22px;

            align-items: start;
        }

        /* =========================================================
           CARD
        ========================================================== */

        .card {
            background: #fff;

            border:
                1px solid
                #e4e9f1;

            border-radius: 20px;

            box-shadow:
                0 10px 32px rgba(15, 23, 42, .04);

            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 12px;

            padding:
                18px 22px;

            border-bottom:
                1px solid
                #edf1f6;
        }

        .card-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 11px;
        }

        .card-icon-blue {
            color: #2563eb;
            background: #eff6ff;
        }

        .card-icon-purple {
            color: #7c3aed;
            background: #f5f3ff;
        }

        .card-icon-slate {
            color: #475569;
            background: #f1f5f9;
        }

        .card-title {
            color: #0f172a;

            font-size: 13px;
            font-weight: 850;
        }

        .card-subtitle {
            margin-top: 2px;

            color: #94a3b8;

            font-size: 10px;
            font-weight: 600;
        }

        .card-body {
            padding: 24px;
        }

        /* =========================================================
           RICH CONTENT
        ========================================================== */

        .material-content {
            color: #334155;

            font-family:
                "DM Sans",
                "Inter",
                sans-serif;

            font-size: 15px;

            line-height: 1.85;

            overflow-wrap: anywhere;
        }

        .material-content > :first-child {
            margin-top: 0 !important;
        }

        .material-content > :last-child {
            margin-bottom: 0 !important;
        }

        .material-content h1 {
            margin:
                26px 0 13px;

            color: #0f172a;

            font-size: 30px;
            line-height: 1.25;

            font-weight: 900;

            letter-spacing: -.025em;
        }

        .material-content h2 {
            margin:
                25px 0 12px;

            color: #0f172a;

            font-size: 24px;
            line-height: 1.3;

            font-weight: 850;
        }

        .material-content h3 {
            margin:
                21px 0 10px;

            color: #172033;

            font-size: 19px;
            line-height: 1.4;

            font-weight: 800;
        }

        .material-content h4 {
            margin:
                18px 0 9px;

            color: #1e293b;

            font-size: 16px;

            font-weight: 800;
        }

        .material-content p {
            margin:
                0 0 14px;
        }

        .material-content strong {
            color: #172033;
            font-weight: 800;
        }

        .material-content em {
            color: #475569;
        }

        .material-content a {
            color: #2563eb;
            text-decoration: underline;
            text-decoration-color: #bfdbfe;
            text-underline-offset: 3px;
        }

        .material-content ul,
        .material-content ol {
            margin:
                12px 0 18px;

            padding-left: 25px;
        }

        .material-content li {
            margin-bottom: 6px;
        }

        .material-content blockquote {
            margin:
                20px 0;

            padding:
                15px 18px;

            border-left:
                4px solid
                #3b82f6;

            border-radius:
                0 12px 12px 0;

            background:
                linear-gradient(
                    90deg,
                    #f8fbff,
                    #fff
                );

            color: #475569;

            font-style: italic;
        }

        .material-content pre {
            margin:
                18px 0;

            padding: 16px;

            border-radius: 12px;

            background: #0f172a;

            color: #e2e8f0;

            overflow-x: auto;

            font-family:
                "SFMono-Regular",
                Consolas,
                monospace;

            font-size: 13px;

            line-height: 1.7;
        }

        .material-content code {
            padding:
                2px 5px;

            border-radius: 5px;

            background: #f1f5f9;

            color: #334155;

            font-family:
                "SFMono-Regular",
                Consolas,
                monospace;

            font-size: .9em;
        }

        .material-content pre code {
            padding: 0;
            background: transparent;
            color: inherit;
        }

        .material-content img {
            display: block;

            max-width: 100%;
            height: auto;

            margin:
                18px auto;

            border-radius: 13px;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, .08);

            object-fit: contain;
        }

        .material-content img[style*="float:left"],
        .material-content img[style*="float: left"] {
            margin-right: 20px;
        }

        .material-content img[style*="float:right"],
        .material-content img[style*="float: right"] {
            margin-left: 20px;
        }

        .material-content iframe {
            width: 100%;
            max-width: 100%;

            min-height: 380px;

            margin:
                18px 0;

            border: 0;

            border-radius: 14px;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, .08);
        }

        .material-content video {
            display: block;

            width: 100%;

            max-height: 550px;

            margin:
                18px auto;

            border-radius: 14px;
        }

        .material-content audio {
            width: 100%;

            margin:
                18px 0;
        }

        /* =========================================================
           EMPTY STATE
        ========================================================== */

        .empty-state {
            padding:
                55px 20px;

            text-align: center;
        }

        .empty-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            margin:
                0 auto 12px;

            border-radius: 15px;

            background: #f1f5f9;

            color: #94a3b8;
        }

        .empty-title {
            color: #475569;

            font-size: 13px;
            font-weight: 800;
        }

        .empty-description {
            margin-top: 4px;

            color: #94a3b8;

            font-size: 11px;
        }

        /* =========================================================
           MEDIA
        ========================================================== */

        .media-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .media-link {
            display: flex;
            align-items: center;
            gap: 11px;

            padding: 11px;

            border:
                1px solid
                #edf1f6;

            border-radius: 13px;

            text-decoration: none;

            transition:
                background .18s ease,
                border .18s ease,
                transform .18s ease;
        }

        .media-link:hover {
            transform: translateY(-1px);
        }

        .media-image {
            background: #f8fafc;
        }

        .media-image:hover {
            background: #f1f5f9;
            border-color: #dbeafe;
        }

        .media-video {
            background: #fff7f7;
            border-color: #fee2e2;
        }

        .media-video:hover {
            background: #fef2f2;
        }

        .media-audio {
            background: #faf7ff;
            border-color: #ede9fe;
        }

        .media-audio:hover {
            background: #f5f3ff;
        }

        .media-icon {
            width: 38px;
            height: 38px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 10px;

            background: #fff;
        }

        .media-title {
            font-size: 11px;
            font-weight: 800;
        }

        .media-description {
            margin-top: 2px;

            font-size: 9px;
            font-weight: 600;
        }

        /* =========================================================
           INFO
        ========================================================== */

        .info-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .info-row {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            padding:
                12px 0;

            border-bottom:
                1px solid
                #f1f5f9;
        }

        .info-row:first-child {
            padding-top: 0;
        }

        .info-row:last-child {
            padding-bottom: 0;
            border-bottom: 0;
        }

        .info-label {
            color: #94a3b8;

            font-size: 10px;
            font-weight: 650;
        }

        .info-value {
            color: #334155;

            font-size: 11px;
            font-weight: 800;

            text-align: right;
        }

        .info-active {
            color: #16a34a;
        }

        .info-inactive {
            color: #94a3b8;
        }

        /* =========================================================
           ACTIONS
        ========================================================== */

        .bottom-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 12px;

            margin-top: 22px;
        }

        .action-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            gap: 8px;

            min-height: 43px;

            padding:
                0 16px;

            border-radius: 11px;

            font-size: 11px;
            font-weight: 800;

            text-decoration: none;

            transition:
                transform .18s ease,
                background .18s ease,
                box-shadow .18s ease;
        }

        .back-button {
            color: #475569;

            background: #fff;

            border:
                1px solid
                #e2e8f0;

            box-shadow:
                0 5px 16px rgba(15, 23, 42, .025);
        }

        .back-button:hover {
            background: #f8fafc;
            transform: translateY(-1px);
        }

        .delete-button {
            color: #dc2626;

            background: #fff1f2;

            border:
                1px solid
                #ffe4e6;
        }

        .delete-button:hover {
            background: #ffe4e6;
            transform: translateY(-1px);
        }

        /* =========================================================
           FOOTER
        ========================================================== */

        .footer {
            margin-top: 28px;

            text-align: center;

            color: #a1adbd;

            font-size: 9px;
            font-weight: 600;
        }

        /* =========================================================
           RESPONSIVE
        ========================================================== */

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0 !important;
            }

        }

        @media (max-width: 900px) {

            .content-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 700px) {

            .page {
                padding:
                    20px 15px 40px;
            }

            .hero-body {
                padding:
                    22px 20px;
            }

            .hero-layout {
                flex-direction: column;
            }

            .edit-button {
                width: 100%;
            }

            .card-body {
                padding: 19px;
            }

            .card-header {
                padding:
                    16px 19px;
            }

            .bottom-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .action-button {
                width: 100%;
            }

            .material-content {
                font-size: 14px;
                line-height: 1.8;
            }

            .material-content h1 {
                font-size: 25px;
            }

            .material-content h2 {
                font-size: 21px;
            }

            .material-content h3 {
                font-size: 17px;
            }

            .material-content iframe {
                min-height: 240px;
            }

        }
    </style>
</head>


<body class="min-h-screen">

    {{-- =========================================================
         SIDEBAR
    ========================================================== --}}

    @include('guru.partials.sidebar')


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main
        id="mainContent"
        class="
            main-content
            lg:ml-64
        "
    >

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <header
            class="
                top-header
                sticky
                top-0
                z-30
                flex
                items-center
                justify-between
                px-5
                lg:px-8
            "
        >

            <div>

                <p
                    class="
                        text-[10px]
                        font-semibold
                        text-slate-400
                    "
                >
                    Panel Guru
                </p>

                <h2
                    class="
                        text-sm
                        font-extrabold
                        text-slate-900
                    "
                >
                    Detail Materi
                </h2>

            </div>


            <div class="avatar">
                G
            </div>

        </header>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="page">


            {{-- =================================================
                 BREADCRUMB
            ================================================== --}}

            <nav class="breadcrumb">

                <a
                    href="{{ route('guru.materials.index') }}"
                >
                    Materi
                </a>

                <span class="breadcrumb-separator">
                    /
                </span>

                <span class="breadcrumb-current">
                    Pertemuan {{ $material->pertemuan }}
                </span>

                <span class="breadcrumb-separator">
                    /
                </span>

                <span class="breadcrumb-current">
                    Detail
                </span>

            </nav>


            {{-- =================================================
                 HERO
            ================================================== --}}

            <section class="hero-card">

                <div class="hero-line"></div>

                <div class="hero-body">

                    <div class="hero-layout">


                        <div class="hero-main">

                            {{-- BADGES --}}

                            <div class="badges">

                                <span class="badge badge-meeting">

                                    <i
                                        data-lucide="layers"
                                        class="w-3.5 h-3.5"
                                    ></i>

                                    Pertemuan
                                    {{ $material->pertemuan }}

                                </span>


                                @if($material->kategori)

                                    <span class="badge badge-category">

                                        {{ $material->kategori }}

                                    </span>

                                @endif


                                @if($material->aktif)

                                    <span class="badge badge-active">

                                        <span class="status-dot"></span>

                                        Aktif

                                    </span>

                                @else

                                    <span class="badge badge-inactive">

                                        <span class="status-dot"></span>

                                        Nonaktif

                                    </span>

                                @endif

                            </div>


                            {{-- TITLE --}}

                            <h1 class="hero-title">

                                {{ $material->judul }}

                            </h1>


                            {{-- META --}}

                            <div class="hero-meta">

                                <span>
                                    Dibuat
                                    {{ $material->created_at?->locale('id')->translatedFormat('d F Y') }}
                                </span>

                                @if($material->updated_at && $material->updated_at != $material->created_at)

                                    <span class="meta-dot"></span>

                                    <span>
                                        Diperbarui
                                        {{ $material->updated_at?->locale('id')->translatedFormat('d F Y') }}
                                    </span>

                                @endif

                            </div>

                        </div>


                        {{-- EDIT --}}

                        <a
                            href="{{ route('guru.materials.edit', $material) }}"
                            class="edit-button"
                        >

                            <i
                                data-lucide="pencil"
                                class="w-4 h-4"
                            ></i>

                            Edit Materi

                        </a>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 CONTENT GRID
            ================================================== --}}

            <div class="content-grid">


                {{-- =================================================
                     ISI MATERI
                ================================================== --}}

                <section class="card">

                    <div class="card-header">

                        <div class="card-icon card-icon-purple">

                            <i
                                data-lucide="file-text"
                                class="w-5 h-5"
                            ></i>

                        </div>

                        <div>

                            <div class="card-title">
                                Isi Materi
                            </div>

                            <div class="card-subtitle">
                                Konten pembelajaran
                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        @if(
                            $material->isi &&
                            trim(strip_tags($material->isi)) !== ''
                        )

                            <article class="material-content">

                                {!! $material->isi !!}

                            </article>

                        @else

                            <div class="empty-state">

                                <div class="empty-icon">

                                    <i
                                        data-lucide="file-text"
                                        class="w-5 h-5"
                                    ></i>

                                </div>

                                <div class="empty-title">
                                    Belum ada isi materi
                                </div>

                                <div class="empty-description">
                                    Tambahkan isi materi melalui
                                    menu Edit Materi.
                                </div>

                            </div>

                        @endif

                    </div>

                </section>


                {{-- =================================================
                     SIDEBAR DETAIL
                ================================================== --}}

                <aside class="space-y-5">



                    {{-- =================================================
                         INFORMASI
                    ================================================== --}}

                    <section class="card">

                        <div class="card-header">

                            <div class="card-icon card-icon-slate">

                                <i
                                    data-lucide="info"
                                    class="w-5 h-5"
                                ></i>

                            </div>

                            <div>

                                <div class="card-title">
                                    Informasi Materi
                                </div>

                                <div class="card-subtitle">
                                    Detail pembelajaran
                                </div>

                            </div>

                        </div>


                        <div class="card-body">

                            <div class="info-list">


                                {{-- PERTEMUAN --}}

                                <div class="info-row">

                                    <span class="info-label">
                                        Pertemuan
                                    </span>

                                    <span class="info-value">
                                        {{ $material->pertemuan }}
                                    </span>

                                </div>


                                {{-- KATEGORI --}}

                                <div class="info-row">

                                    <span class="info-label">
                                        Kategori
                                    </span>

                                    <span class="info-value">

                                        {{ $material->kategori ?: '-' }}

                                    </span>

                                </div>


                                {{-- STATUS --}}

                                <div class="info-row">

                                    <span class="info-label">
                                        Status
                                    </span>

                                    @if($material->aktif)

                                        <span
                                            class="
                                                info-value
                                                info-active
                                            "
                                        >
                                            Aktif
                                        </span>

                                    @else

                                        <span
                                            class="
                                                info-value
                                                info-inactive
                                            "
                                        >
                                            Nonaktif
                                        </span>

                                    @endif

                                </div>


                                {{-- DIBUAT --}}

                                <div class="info-row">

                                    <span class="info-label">
                                        Dibuat
                                    </span>

                                    <span class="info-value">

                                        {{ $material->created_at?->locale('id')->translatedFormat('d M Y') }}

                                    </span>

                                </div>


                                {{-- DIPERBARUI --}}

                                <div class="info-row">

                                    <span class="info-label">
                                        Diperbarui
                                    </span>

                                    <span class="info-value">

                                        {{ $material->updated_at?->locale('id')->translatedFormat('d M Y') }}

                                    </span>

                                </div>

                            </div>

                        </div>

                    </section>

                </aside>

            </div>


            {{-- =================================================
                 ACTION
            ================================================== --}}

            <div class="bottom-actions">


                <a
                    href="{{ route(
                        'guru.materials.index',
                        [
                            'pertemuan' =>
                                $material->pertemuan
                        ]
                    ) }}"
                    class="
                        action-button
                        back-button
                    "
                >

                    <i
                        data-lucide="arrow-left"
                        class="w-4 h-4"
                    ></i>

                    Kembali ke Materi

                </a>


                <form
                    method="POST"
                    action="{{ route(
                        'guru.materials.destroy',
                        $material
                    ) }}"
                    onsubmit="
                        return confirm(
                            'Yakin ingin menghapus materi ini?'
                        )
                    "
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="
                            action-button
                            delete-button
                        "
                    >

                        <i
                            data-lucide="trash-2"
                            class="w-4 h-4"
                        ></i>

                        Hapus Materi

                    </button>

                </form>

            </div>


            {{-- =================================================
                 FOOTER
            ================================================== --}}

            <div class="footer">

                LARASKU · Panel Guru

            </div>

        </div>

    </main>


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

    </script>

</body>

</html>