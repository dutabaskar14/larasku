<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $material->judul }} — LARASKU</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #1e293b;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .page {
            min-height: 100vh;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 74px;
            background: rgba(255,255,255,.95);
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 34px;
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(12px);
        }

        .brand {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -.04em;
            color: #0f172a;
        }

        .brand span {
            display: block;
            margin-top: 2px;
            font-size: 11px;
            font-weight: 650;
            letter-spacing: 0;
            color: #94a3b8;
        }

        .topbar-badge {
            padding: 8px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 750;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

        .container {
            width: min(1050px, calc(100% - 40px));
            margin: 0 auto;
            padding: 38px 0 60px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
            padding: 9px 13px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
            transition: .18s ease;
        }

        .back-button:hover {
            color: #0f172a;
            border-color: #cbd5e1;
            transform: translateX(-2px);
        }

        /* =====================================================
           HEADER MATERI
        ===================================================== */

        .material-header {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 32px 36px;
            margin-bottom: 20px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, .035);
        }

        .category {
            display: inline-flex;
            align-items: center;
            padding: 6px 11px;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            font-weight: 850;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 13px;
        }

        .title {
            margin: 0;
            color: #0f172a;
            font-size: 34px;
            line-height: 1.2;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .meta {
            margin-top: 10px;
            color: #94a3b8;
            font-size: 13px;
        }

        /* =====================================================
           ISI MATERI
        ===================================================== */

        .material-content {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 22px;
            padding: 38px 42px;
            box-shadow: 0 5px 22px rgba(15, 23, 42, .035);

            color: #475569;
            font-size: 16px;
            line-height: 1.9;
        }

        .material-content h1 {
            margin: 0 0 20px;
            color: #0f172a;
            font-size: 31px;
            line-height: 1.3;
            font-weight: 900;
        }

        .material-content h2 {
            margin: 34px 0 13px;
            color: #0f172a;
            font-size: 23px;
            line-height: 1.35;
            font-weight: 850;
        }

        .material-content h3 {
            margin: 27px 0 10px;
            color: #1e293b;
            font-size: 19px;
            line-height: 1.45;
            font-weight: 800;
        }

        .material-content h4 {
            margin: 22px 0 8px;
            color: #334155;
            font-size: 16px;
            font-weight: 800;
        }

        .material-content p {
            margin: 0 0 17px;
        }

        .material-content strong {
            color: #1e293b;
            font-weight: 800;
        }

        .material-content em {
            color: #64748b;
        }

        .material-content ul,
        .material-content ol {
            margin: 12px 0 20px;
            padding-left: 28px;
        }

        .material-content li {
            margin-bottom: 8px;
        }

        .material-content ul li::marker {
            color: #2563eb;
        }

        .material-content ol li::marker {
            color: #2563eb;
            font-weight: 800;
        }

        .material-content blockquote {
            margin: 22px 0;
            padding: 16px 20px;
            border-left: 4px solid #2563eb;
            background: #f8fafc;
            border-radius: 0 12px 12px 0;
        }

        /* =====================================================
           TABLE
        ===================================================== */

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            margin: 24px 0;
            border: 1px solid #e2e8f0;
            border-radius: 13px;
        }

        .material-content table {
            width: 100%;
            min-width: 560px;
            border-collapse: collapse;
            margin: 0;
            font-size: 14px;
        }

        .material-content th,
        .material-content td {
            padding: 12px 14px;
            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
            vertical-align: top;
        }

        .material-content th:last-child,
        .material-content td:last-child {
            border-right: 0;
        }

        .material-content tr:last-child td {
            border-bottom: 0;
        }

        .material-content th {
            background: #f8fafc;
            color: #0f172a;
            font-weight: 800;
        }

        .material-content tr:hover td {
            background: #fafcff;
        }

        /* =====================================================
           GAMBAR
        ===================================================== */

        .material-content img {
            display: block;
            max-width: 100%;
            height: auto;
            margin: 25px auto;
            border-radius: 15px;
        }

        /* =====================================================
           MEDIA
        ===================================================== */

        .media-section {
            margin-top: 20px;
            display: grid;
            gap: 15px;
        }

        .media-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            padding: 20px;
        }

        .media-title {
            margin-bottom: 12px;
            color: #0f172a;
            font-size: 14px;
            font-weight: 800;
        }

        .media-card video,
        .media-card audio {
            width: 100%;
        }

        .media-link {
            color: #2563eb;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            word-break: break-word;
        }

        /* =====================================================
           FOOTER
        ===================================================== */

        .bottom-navigation {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 22px;
        }

        .nav-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 11px;
            color: #475569;
            text-decoration: none;
            font-size: 13px;
            font-weight: 750;
            transition: .18s ease;
        }

        .nav-button:hover {
            border-color: #cbd5e1;
            color: #0f172a;
            transform: translateY(-1px);
        }

        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 700px) {

            .topbar {
                height: 64px;
                padding: 0 17px;
            }

            .brand {
                font-size: 19px;
            }

            .topbar-badge {
                display: none;
            }

            .container {
                width: min(100% - 28px, 1050px);
                padding: 24px 0 45px;
            }

            .material-header {
                padding: 23px 20px;
                border-radius: 17px;
            }

            .title {
                font-size: 27px;
            }

            .material-content {
                padding: 25px 20px;
                border-radius: 17px;
                font-size: 15px;
                line-height: 1.8;
            }

            .material-content h1 {
                font-size: 26px;
            }

            .material-content h2 {
                font-size: 21px;
            }

            .material-content h3 {
                font-size: 18px;
            }

            .bottom-navigation {
                flex-direction: column;
            }

            .nav-button {
                justify-content: center;
            }
        }
    </style>
</head>

<body>

<div class="page">

    {{-- =====================================================
         TOPBAR
    ====================================================== --}}

    <header class="topbar">

        <div class="brand">
            LARASKU

            <span>
                Pembelajaran Seni Musik
            </span>
        </div>

        <div class="topbar-badge">
            Materi Pembelajaran
        </div>

    </header>


    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <main class="container">

        <a
            href="{{ route('materials.index') }}"
            class="back-button"
        >
            ← Kembali ke Materi
        </a>


        {{-- =================================================
             HEADER
        ================================================== --}}

        <section class="material-header">

            @if($material->kategori)
                <div class="category">
                    {{ $material->kategori }}
                </div>
            @endif

            <h1 class="title">
                {{ $material->judul }}
            </h1>

            <div class="meta">
                Materi Pembelajaran LARASKU
            </div>

        </section>


        {{-- =================================================
             ISI MATERI
        ================================================== --}}

        <article class="material-content">

            {!! $material->isi !!}

        </article>


        {{-- =================================================
             VIDEO / AUDIO
        ================================================== --}}

        @if($material->video_url || $material->audio_url)

            <section class="media-section">

                @if($material->video_url)

                    <div class="media-card">

                        <div class="media-title">
                            Video Pembelajaran
                        </div>

                        <a
                            href="{{ $material->video_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="media-link"
                        >
                            Buka video pembelajaran →
                        </a>

                    </div>

                @endif


                @if($material->audio_url)

                    <div class="media-card">

                        <div class="media-title">
                            Audio Pembelajaran
                        </div>

                        <a
                            href="{{ $material->audio_url }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="media-link"
                        >
                            Buka audio pembelajaran →
                        </a>

                    </div>

                @endif

            </section>

        @endif


        {{-- =================================================
             NAVIGASI
        ================================================== --}}

        <div class="bottom-navigation">

            <a
                href="{{ route('materials.index') }}"
                class="nav-button"
            >
                ← Semua Materi
            </a>

            <a
                href="#"
                onclick="window.scrollTo({top: 0, behavior: 'smooth'}); return false;"
                class="nav-button"
            >
                ↑ Kembali ke atas
            </a>

        </div>

    </main>

</div>

</body>
</html>