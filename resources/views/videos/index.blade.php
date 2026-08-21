<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Video Pembelajaran — LARASKU</title>

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
            color: #172033;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        #studentMainContent {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .25s ease;
        }

        /* =========================================================
           TOPBAR
        ========================================================== */

        .topbar {
            height: 68px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            color: #0f172a;
            font-size: 20px;
            font-weight: 900;
            letter-spacing: -.04em;
        }

        .brand span {
            display: block;
            margin-top: 1px;
            color: #94a3b8;
            font-size: 10px;
            font-weight: 650;
            letter-spacing: 0;
        }

        .badge {
            padding: 6px 11px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #f8fafc;
            color: #64748b;
            font-size: 11px;
            font-weight: 800;
        }

        /* =========================================================
           CONTAINER
        ========================================================== */

        .container {
            width: min(1000px, calc(100% - 32px));
            margin: auto;
            padding: 25px 0 45px;
        }

        .heading {
            margin-bottom: 16px;
        }

        .eyebrow {
            margin-bottom: 4px;
            color: #2563eb;
            font-size: 10px;
            font-weight: 900;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            font-weight: 900;
            letter-spacing: -.04em;
            line-height: 1.15;
        }

        .subtitle {
            max-width: 680px;
            margin: 6px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        /* =========================================================
           PERTEMUAN
        ========================================================== */

        .meeting-card {
            margin-bottom: 16px;
            padding: 13px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
        }

        .meeting-label {
            margin-bottom: 8px;
            color: #64748b;
            font-size: 10px;
            font-weight: 850;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .meetings {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding-bottom: 1px;
            scrollbar-width: thin;
        }

        .meeting {
            flex: 0 0 auto;
            min-width: 42px;
            padding: 8px 11px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            text-align: center;
            font-size: 11px;
            font-weight: 800;
            transition: .15s ease;
        }

        .meeting:hover {
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .meeting.active {
            background: #0f172a;
            border-color: #0f172a;
            color: #fff;
        }

        /* =========================================================
           VIDEO LIST
        ========================================================== */

        .video-list {
            display: grid;
            gap: 12px;
        }

        .video-card {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
        }

        .video-header {
            padding: 13px 15px;
        }

        .video-heading {
            display: flex;
            align-items: center;
            min-width: 0;
        }

        .video-number {
            display: inline-flex;
            flex: 0 0 auto;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            margin-right: 8px;
            border-radius: 7px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 10px;
            font-weight: 900;
        }

        .video-title {
            min-width: 0;
            color: #0f172a;
            font-size: 14px;
            font-weight: 850;
            line-height: 1.35;
        }

        .video-description {
            margin: 6px 0 0 33px;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
        }

        /*
        |--------------------------------------------------------------------------
        | VIDEO FRAME
        |--------------------------------------------------------------------------
        |
        | Tetap 16:9 agar nyaman ditonton.
        | Container dibatasi supaya tidak terlalu besar di laptop.
        |
        */

        .video-frame {
            position: relative;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding-top: 50%;
            background: #0f172a;
        }

        .video-frame iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* =========================================================
           EMPTY
        ========================================================== */

        .empty {
            padding: 40px 18px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 13px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 8px;
            font-size: 28px;
        }

        .empty-title {
            color: #334155;
            font-size: 14px;
            font-weight: 850;
        }

        .empty-text {
            max-width: 500px;
            margin: 5px auto 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================================================
           DESKTOP
        ========================================================== */

        @media (min-width: 1100px) {

            .video-frame {
                max-width: 860px;
                padding-top: 48.375%;
            }
        }

        /* =========================================================
           TABLET
        ========================================================== */

        @media (max-width: 1023px) {

            #studentMainContent {
                margin-left: 0;
            }

            .container {
                width: min(1000px, calc(100% - 28px));
            }
        }

        /* =========================================================
           MOBILE
        ========================================================== */

        @media (max-width: 650px) {

            .topbar {
                height: 58px;
                padding: 0 14px;
            }

            .brand {
                font-size: 18px;
            }

            .brand span {
                font-size: 9px;
            }

            .badge {
                display: none;
            }

            .container {
                width: calc(100% - 20px);
                padding: 17px 0 30px;
            }

            .heading {
                margin-bottom: 12px;
            }

            .eyebrow {
                font-size: 9px;
            }

            h1 {
                font-size: 23px;
            }

            .subtitle {
                margin-top: 5px;
                font-size: 11px;
                line-height: 1.45;
            }

            .meeting-card {
                margin-bottom: 11px;
                padding: 10px;
                border-radius: 11px;
            }

            .meeting-label {
                margin-bottom: 6px;
                font-size: 9px;
            }

            .meetings {
                gap: 5px;
            }

            .meeting {
                min-width: 39px;
                padding: 7px 9px;
                border-radius: 7px;
                font-size: 10px;
            }

            .video-list {
                gap: 9px;
            }

            .video-card {
                border-radius: 10px;
            }

            .video-header {
                padding: 10px 11px;
            }

            .video-number {
                width: 22px;
                height: 22px;
                margin-right: 6px;
                border-radius: 6px;
                font-size: 9px;
            }

            .video-title {
                font-size: 12px;
                line-height: 1.3;
            }

            .video-description {
                margin: 5px 0 0 28px;
                font-size: 10px;
                line-height: 1.4;
            }

            .video-frame {
                padding-top: 56.25%;
            }

            .empty {
                padding: 30px 14px;
                border-radius: 10px;
            }

            .empty-icon {
                font-size: 25px;
            }

            .empty-title {
                font-size: 13px;
            }

            .empty-text {
                font-size: 10px;
            }
        }

        /* =========================================================
           VERY SMALL PHONE
        ========================================================== */

        @media (max-width: 380px) {

            .container {
                width: calc(100% - 16px);
            }

            h1 {
                font-size: 21px;
            }

            .video-title {
                font-size: 11px;
            }

            .video-description {
                font-size: 9px;
            }
        }
    </style>
</head>

<body>

{{-- =========================================================
     SIDEBAR SISWA
========================================================= --}}

@include('partials.sidebar')

<div
    id="studentMainContent"
    class="lg:ml-64"
>

    {{-- =========================================================
         TOPBAR
    ========================================================== --}}

    <header class="topbar">

        <div class="brand">
            LARASKU

            <span>
                Pembelajaran Seni Musik
            </span>
        </div>

        <div class="badge">
            Video Pembelajaran
        </div>

    </header>


    {{-- =========================================================
         MAIN
    ========================================================== --}}

    <main class="container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <section class="heading">

            <div class="eyebrow">
                LARASKU
            </div>

            <h1>
                Video Pembelajaran
            </h1>

            <p class="subtitle">
                Saksikan video pembelajaran sesuai dengan pertemuan
                yang sedang dipelajari.
            </p>

        </section>


        {{-- =====================================================
             PILIH PERTEMUAN
             Mengikuti video_meetings dari controller.
             Tidak lagi hard-code 1–8.
        ====================================================== --}}

        <section class="meeting-card">

            <div class="meeting-label">
                Pilih Pertemuan
            </div>

            <div class="meetings">

                @forelse($meetings as $meeting)

                    <a
                        href="{{ route('videos.index', [
                            'pertemuan' => $meeting->pertemuan
                        ]) }}"
                        class="meeting {{ $pertemuan === (int) $meeting->pertemuan ? 'active' : '' }}"
                    >
                        P{{ $meeting->pertemuan }}
                    </a>

                @empty

                    <span
                        style="
                            color:#94a3b8;
                            font-size:11px;
                            padding:5px 0;
                        "
                    >
                        Belum ada pertemuan.
                    </span>

                @endforelse

            </div>

        </section>


        {{-- =====================================================
             DAFTAR VIDEO
        ====================================================== --}}

        @if($videos->count())

            <section class="video-list">

                @foreach($videos as $video)

                    @php

                        $youtubeId = null;

                        try {

                            $url = parse_url(
                                $video->youtube_url
                            );

                            $host =
                                $url['host'] ?? '';

                            $path =
                                $url['path'] ?? '';

                            $query =
                                $url['query'] ?? '';


                            /*
                            |--------------------------------------------------------------------------
                            | youtube.com/watch?v=...
                            |--------------------------------------------------------------------------
                            */

                            if (
                                str_contains(
                                    $host,
                                    'youtube.com'
                                )
                                &&
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


                            /*
                            |--------------------------------------------------------------------------
                            | youtu.be/...
                            |--------------------------------------------------------------------------
                            */

                            elseif (
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
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | youtube.com/embed/...
                            |--------------------------------------------------------------------------
                            */

                            elseif (
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
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | youtube.com/shorts/...
                            |--------------------------------------------------------------------------
                            */

                            elseif (
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
                            }

                        } catch (\Throwable $e) {

                            $youtubeId = null;
                        }

                    @endphp


                    {{-- =================================================
                         VIDEO CARD
                    ================================================== --}}

                    <article class="video-card">

                        <div class="video-header">

                            <div class="video-heading">

                                <span class="video-number">
                                    {{ $video->urutan }}
                                </span>

                                <span class="video-title">
                                    {{ $video->judul }}
                                </span>

                            </div>


                            @if($video->deskripsi)

                                <div class="video-description">
                                    {{ $video->deskripsi }}
                                </div>

                            @endif

                        </div>


                        {{-- =================================================
                             VIDEO YOUTUBE
                        ================================================== --}}

                        @if($youtubeId)

                            <div class="video-frame">

                                <iframe
                                    src="https://www.youtube.com/embed/{{ $youtubeId }}"
                                    title="{{ $video->judul }}"
                                    loading="lazy"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>

                            </div>

                        @else

                            <div class="empty">

                                <div class="empty-icon">
                                    ⚠️
                                </div>

                                <div class="empty-title">
                                    Video tidak dapat ditampilkan
                                </div>

                                <div class="empty-text">
                                    Link YouTube untuk video ini tidak valid.
                                </div>

                            </div>

                        @endif

                    </article>

                @endforeach

            </section>

        @else

            {{-- =================================================
                 BELUM ADA VIDEO
            ================================================== --}}

            <section class="empty">

                <div class="empty-icon">
                    🎬
                </div>

                <div class="empty-title">
                    Belum ada video
                </div>

                <div class="empty-text">
                    Belum ada video pembelajaran untuk
                    Pertemuan {{ $pertemuan }}.
                </div>

            </section>

        @endif

    </main>

</div>


<script>
    /*
    |--------------------------------------------------------------------------
    | LUCIDE ICON
    |--------------------------------------------------------------------------
    */

    if (
        typeof lucide !== 'undefined'
        &&
        typeof lucide.createIcons === 'function'
    ) {
        lucide.createIcons();
    }
</script>

</body>

</html>