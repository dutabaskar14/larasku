<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $material->judul }} — LARASKU
    </title>


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


        /* =====================================================
           PAGE
        ====================================================== */

        .page {

            min-height: 100vh;

        }


        /* =====================================================
           TOPBAR
        ====================================================== */

        .topbar {

            height: 62px;

            background: rgba(255, 255, 255, .96);

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


        .brand {

            font-size: 19px;

            font-weight: 900;

            letter-spacing: -.04em;

            color: #0f172a;

        }


        .brand span {

            display: block;

            margin-top: 1px;

            font-size: 9px;

            font-weight: 650;

            letter-spacing: 0;

            color: #94a3b8;

        }


        .topbar-badge {

            padding: 6px 10px;

            border: 1px solid #e2e8f0;

            border-radius: 8px;

            background: #f8fafc;

            color: #64748b;

            font-size: 9px;

            font-weight: 800;

        }


        /* =====================================================
           CONTAINER
        ====================================================== */

        .container {

            width: min(
                1000px,
                calc(100% - 32px)
            );

            margin: 0 auto;

            padding: 25px 0 45px;

        }


        /* =====================================================
           BACK BUTTON
        ====================================================== */

        .back-button {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            margin-bottom: 13px;

            padding: 7px 10px;

            border: 1px solid #e2e8f0;

            border-radius: 8px;

            background: #fff;

            color: #64748b;

            text-decoration: none;

            font-size: 10px;

            font-weight: 800;

            transition: .15s ease;

        }


        .back-button:hover {

            color: #0f172a;

            border-color: #cbd5e1;

            transform: translateX(-1px);

        }


        /* =====================================================
           HEADER MATERIAL
        ====================================================== */

        .material-header {

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 13px;

            padding: 18px 20px;

            margin-bottom: 11px;

            box-shadow:
                0 4px 16px
                rgba(15, 23, 42, .025);

        }


        .category {

            display: inline-flex;

            align-items: center;

            padding: 4px 8px;

            border-radius: 6px;

            background: #eff6ff;

            color: #2563eb;

            font-size: 8px;

            font-weight: 850;

            text-transform: uppercase;

            letter-spacing: .06em;

            margin-bottom: 7px;

        }


        .title {

            margin: 0;

            color: #0f172a;

            font-size: 23px;

            line-height: 1.2;

            font-weight: 900;

            letter-spacing: -.035em;

        }


        .meta {

            margin-top: 5px;

            color: #94a3b8;

            font-size: 9px;

        }


        /* =====================================================
           CONTENT MATERIAL
        ====================================================== */

        .material-content {

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 13px;

            padding: 20px 22px;

            box-shadow:
                0 4px 16px
                rgba(15, 23, 42, .025);

            color: #475569;

            font-size: 12px;

            line-height: 1.7;

        }


        .material-content h1 {

            margin: 0 0 13px;

            color: #0f172a;

            font-size: 22px;

            line-height: 1.25;

            font-weight: 900;

        }


        .material-content h2 {

            margin: 23px 0 9px;

            color: #0f172a;

            font-size: 17px;

            line-height: 1.35;

            font-weight: 850;

        }


        .material-content h3 {

            margin: 18px 0 7px;

            color: #1e293b;

            font-size: 14px;

            line-height: 1.4;

            font-weight: 800;

        }


        .material-content h4 {

            margin: 15px 0 6px;

            color: #334155;

            font-size: 12px;

            font-weight: 800;

        }


        .material-content p {

            margin: 0 0 10px;

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

            margin: 9px 0 13px;

            padding-left: 21px;

        }


        .material-content li {

            margin-bottom: 5px;

        }


        .material-content ul li::marker {

            color: #2563eb;

        }


        .material-content ol li::marker {

            color: #2563eb;

            font-weight: 800;

        }


        .material-content blockquote {

            margin: 15px 0;

            padding: 11px 14px;

            border-left: 3px solid #2563eb;

            background: #f8fafc;

            border-radius: 0 8px 8px 0;

        }


        /* =====================================================
           TABLE
        ====================================================== */

        .table-wrap {

            width: 100%;

            overflow-x: auto;

            margin: 16px 0;

            border: 1px solid #e2e8f0;

            border-radius: 9px;

        }


        .material-content table {

            width: 100%;

            min-width: 500px;

            border-collapse: collapse;

            margin: 0;

            font-size: 10px;

        }


        .material-content th,
        .material-content td {

            padding: 8px 10px;

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
           IMAGE
        ====================================================== */

        .material-content img {

            display: block;

            max-width: 100%;

            height: auto;

            margin: 15px auto;

            border-radius: 9px;

        }


        /* =====================================================
           MEDIA
        ====================================================== */

        .media-section {

            margin-top: 11px;

            display: grid;

            gap: 9px;

        }


        .media-card {

            background: #fff;

            border: 1px solid #e5e7eb;

            border-radius: 10px;

            padding: 12px;

        }


        .media-title {

            margin-bottom: 7px;

            color: #0f172a;

            font-size: 10px;

            font-weight: 850;

        }


        .media-card video {

            display: block;

            width: 100%;

            max-height: 520px;

            border-radius: 8px;

            background: #0f172a;

        }


        .media-card audio {

            display: block;

            width: 100%;

        }


        .media-link {

            display: inline-flex;

            align-items: center;

            gap: 5px;

            color: #2563eb;

            font-size: 10px;

            font-weight: 750;

            text-decoration: none;

            word-break: break-word;

        }


        .media-link:hover {

            text-decoration: underline;

        }


        /* =====================================================
           BOTTOM NAVIGATION
        ====================================================== */

        .bottom-navigation {

            display: flex;

            justify-content: space-between;

            gap: 8px;

            margin-top: 12px;

        }


        .nav-button {

            display: inline-flex;

            align-items: center;

            gap: 6px;

            padding: 8px 11px;

            background: #fff;

            border: 1px solid #e2e8f0;

            border-radius: 8px;

            color: #475569;

            text-decoration: none;

            font-size: 10px;

            font-weight: 800;

            transition: .15s ease;

        }


        .nav-button:hover {

            border-color: #cbd5e1;

            color: #0f172a;

            transform: translateY(-1px);

        }


        /* =====================================================
           MOBILE
        ====================================================== */

        @media (max-width: 700px) {

            .topbar {

                height: 56px;

                padding: 0 13px;

            }


            .brand {

                font-size: 17px;

            }


            .brand span {

                font-size: 8px;

            }


            .topbar-badge {

                display: none;

            }


            .container {

                width: calc(100% - 16px);

                padding: 15px 0 30px;

            }


            .back-button {

                margin-bottom: 9px;

                padding: 6px 8px;

                font-size: 9px;

            }


            .material-header {

                padding: 13px 12px;

                border-radius: 10px;

                margin-bottom: 8px;

            }


            .category {

                padding: 3px 6px;

                font-size: 7px;

                margin-bottom: 5px;

            }


            .title {

                font-size: 18px;

            }


            .meta {

                font-size: 8px;

            }


            .material-content {

                padding: 14px 12px;

                border-radius: 10px;

                font-size: 10px;

                line-height: 1.65;

            }


            .material-content h1 {

                font-size: 18px;

                margin-bottom: 9px;

            }


            .material-content h2 {

                font-size: 15px;

                margin: 17px 0 7px;

            }


            .material-content h3 {

                font-size: 13px;

                margin: 14px 0 6px;

            }


            .material-content h4 {

                font-size: 11px;

                margin: 12px 0 5px;

            }


            .material-content p {

                margin-bottom: 8px;

            }


            .material-content ul,
            .material-content ol {

                margin: 7px 0 10px;

                padding-left: 18px;

            }


            .material-content li {

                margin-bottom: 4px;

            }


            .material-content blockquote {

                margin: 11px 0;

                padding: 9px 11px;

            }


            .table-wrap {

                margin: 12px 0;

            }


            .material-content table {

                min-width: 450px;

                font-size: 9px;

            }


            .material-content th,
            .material-content td {

                padding: 6px 7px;

            }


            .material-content img {

                margin: 10px auto;

                border-radius: 7px;

            }


            .media-section {

                margin-top: 8px;

                gap: 7px;

            }


            .media-card {

                padding: 9px;

                border-radius: 8px;

            }


            .media-title {

                margin-bottom: 5px;

                font-size: 9px;

            }


            .media-link {

                font-size: 9px;

            }


            .bottom-navigation {

                margin-top: 9px;

            }


            .nav-button {

                padding: 7px 9px;

                font-size: 9px;

            }

        }


        /* =====================================================
           SMALL PHONE
        ====================================================== */

        @media (max-width: 380px) {

            .container {

                width: calc(100% - 12px);

            }


            .title {

                font-size: 17px;

            }


            .material-content {

                padding: 12px 10px;

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


        {{-- =================================================
             KEMBALI
        ================================================== --}}

        <a
            href="{{ route('materials.index', [
                'pertemuan' => $material->pertemuan
            ]) }}"
            class="back-button"
        >

            ← Kembali ke Pertemuan {{ $material->pertemuan }}

        </a>



        {{-- =================================================
             HEADER MATERIAL
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

                Pertemuan {{ $material->pertemuan }}
                · Materi Pembelajaran LARASKU

            </div>

        </section>



        {{-- =================================================
             ISI MATERIAL
        ================================================== --}}

        <article class="material-content">

            {!! $material->isi !!}

        </article>



        {{-- =================================================
             VIDEO / AUDIO
        ================================================== --}}

        @if(
            $material->video_url
            ||
            $material->audio_url
        )

            <section class="media-section">


                {{-- =========================================
                     VIDEO
                ========================================== --}}

                @if($material->video_url)

                    <div class="media-card">

                        <div class="media-title">

                            Video Pembelajaran

                        </div>


                        @php

                            $videoUrl =
                                trim(
                                    $material->video_url
                                );

                            $youtubeId = null;

                            try {

                                $parsed =
                                    parse_url(
                                        $videoUrl
                                    );

                                $host =
                                    strtolower(
                                        $parsed['host']
                                        ?? ''
                                    );

                                $path =
                                    $parsed['path']
                                    ?? '';

                                $query =
                                    $parsed['query']
                                    ?? '';


                                if (
                                    str_contains(
                                        $host,
                                        'youtu.be'
                                    )
                                ) {

                                    $youtubeId =
                                        trim(
                                            $path,
                                            '/'
                                        );

                                } elseif (
                                    str_contains(
                                        $host,
                                        'youtube.com'
                                    )
                                ) {

                                    if (
                                        str_contains(
                                            $path,
                                            '/embed/'
                                        )
                                    ) {

                                        $youtubeId =
                                            explode(
                                                '/embed/',
                                                $path
                                            )[1]
                                            ?? null;

                                    } elseif (
                                        str_contains(
                                            $path,
                                            '/shorts/'
                                        )
                                    ) {

                                        $youtubeId =
                                            explode(
                                                '/shorts/',
                                                $path
                                            )[1]
                                            ?? null;

                                    } elseif (
                                        str_contains(
                                            $query,
                                            'v='
                                        )
                                    ) {

                                        parse_str(
                                            $query,
                                            $queryData
                                        );

                                        $youtubeId =
                                            $queryData['v']
                                            ?? null;
                                    }
                                }

                            } catch (
                                \Throwable $e
                            ) {

                                $youtubeId = null;

                            }

                        @endphp


                        @if($youtubeId)

                            <div
                                style="
                                    position:relative;
                                    width:100%;
                                    padding-top:56.25%;
                                    overflow:hidden;
                                    border-radius:8px;
                                    background:#0f172a;
                                "
                            >

                                <iframe
                                    src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    title="{{ $material->judul }}"
                                    loading="lazy"
                                    allow="
                                        accelerometer;
                                        autoplay;
                                        clipboard-write;
                                        encrypted-media;
                                        gyroscope;
                                        picture-in-picture;
                                        web-share
                                    "
                                    allowfullscreen
                                    style="
                                        position:absolute;
                                        inset:0;
                                        width:100%;
                                        height:100%;
                                        border:0;
                                    "
                                ></iframe>

                            </div>

                        @else

                            <a
                                href="{{ $material->video_url }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="media-link"
                            >

                                Buka video pembelajaran →

                            </a>

                        @endif

                    </div>

                @endif



                {{-- =========================================
                     AUDIO
                ========================================== --}}

                @if($material->audio_url)

                    <div class="media-card">

                        <div class="media-title">

                            Audio Pembelajaran

                        </div>


                        <audio
                            controls
                            preload="metadata"
                        >

                            <source
                                src="{{ $material->audio_url }}"
                            >

                            Browser Anda tidak mendukung
                            pemutar audio.

                        </audio>

                    </div>

                @endif


            </section>

        @endif



        {{-- =================================================
             NAVIGASI
        ================================================== --}}

        <div class="bottom-navigation">


            <a
                href="{{ route('materials.index', [
                    'pertemuan' => $material->pertemuan
                ]) }}"
                class="nav-button"
            >

                ← Semua Materi

            </a>


            <a
                href="#"
                onclick="
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    return false;
                "
                class="nav-button"
            >

                ↑ Kembali ke atas

            </a>


        </div>


    </main>

</div>


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