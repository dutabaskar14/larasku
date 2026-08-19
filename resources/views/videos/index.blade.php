<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Video Pembelajaran — LARASKU</title>

    {{-- Sidebar siswa memakai Tailwind + Lucide --}}
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

        #studentMainContent {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .topbar {
            height: 74px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 34px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand {
            color: #0f172a;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: -.04em;
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
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
        }

        .container {
            width: min(1050px, calc(100% - 36px));
            margin: auto;
            padding: 34px 0 60px;
        }

        .heading {
            margin-bottom: 23px;
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
            line-height: 1.6;
        }

        /* =========================================================
           PERTEMUAN
        ========================================================== */

        .meeting-card {
            margin-bottom: 25px;
            padding: 17px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
        }

        .meeting-label {
            margin-bottom: 11px;
            color: #64748b;
            font-size: 11px;
            font-weight: 850;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .meetings {
            display: flex;
            gap: 8px;
            overflow-x: auto;
        }

        .meeting {
            flex: 0 0 auto;
            padding: 10px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            font-weight: 800;
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
           VIDEO
        ========================================================== */

        .video-list {
            display: grid;
            gap: 20px;
        }

        .video-card {
            overflow: hidden;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
        }

        .video-header {
            padding: 20px 21px;
        }

        .video-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 29px;
            height: 29px;
            margin-right: 8px;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 900;
            vertical-align: middle;
        }

        .video-title {
            color: #0f172a;
            font-size: 17px;
            font-weight: 900;
            vertical-align: middle;
        }

        .video-description {
            margin-top: 9px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.7;
        }

        .video-frame {
            position: relative;
            width: 100%;
            padding-top: 56.25%;
            background: #0f172a;
        }

        .video-frame iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .empty {
            padding: 60px 20px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
            text-align: center;
        }

        .empty-icon {
            margin-bottom: 10px;
            font-size: 32px;
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
        }

        @media (max-width: 1023px) {

            #studentMainContent {
                margin-left: 0;
            }

        }

        @media (max-width: 650px) {

            .topbar {
                height: 64px;
                padding: 0 17px;
            }

            .badge {
                display: none;
            }

            .container {
                width: min(100% - 28px, 1050px);
                padding-top: 25px;
            }

            h1 {
                font-size: 27px;
            }

            .video-header {
                padding: 17px;
            }

            .video-title {
                font-size: 15px;
            }
        }
    </style>
</head>

<body>

{{-- =========================================================
     SIDEBAR SISWA
     Tetap memakai sidebar final:
     resources/views/partials/sidebar.blade.php
========================================================= --}}

@include('partials.sidebar')

<div
    id="studentMainContent"
    class="lg:ml-64"
>

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


<main class="container">

    <section class="heading">

        <div class="eyebrow">
            LARASKU
        </div>

        <h1>
            Video Pembelajaran
        </h1>

        <p class="subtitle">
            Saksikan video pembelajaran sesuai dengan pertemuan yang sedang dipelajari.
        </p>

    </section>


    {{-- =========================================================
         PILIH PERTEMUAN
    ========================================================== --}}

    <section class="meeting-card">

        <div class="meeting-label">
            Pilih Pertemuan
        </div>

        <div class="meetings">

            @for($i = 1; $i <= 8; $i++)

                <a
                    href="{{ route('videos.index', [
                        'pertemuan' => $i
                    ]) }}"
                    class="meeting {{ $pertemuan === $i ? 'active' : '' }}"
                >
                    Pertemuan {{ $i }}
                </a>

            @endfor

        </div>

    </section>


    {{-- =========================================================
         DAFTAR VIDEO
    ========================================================== --}}

    @if($videos->count())

        <section class="video-list">

            @foreach($videos as $video)

                @php

                    $youtubeId = null;

                    try {

                        $url = parse_url($video->youtube_url);

                        $host = $url['host'] ?? '';
                        $path = $url['path'] ?? '';
                        $query = $url['query'] ?? '';

                        /*
                        | youtube.com/watch?v=...
                        */

                        if (
                            str_contains($host, 'youtube.com') &&
                            str_contains($query, 'v=')
                        ) {

                            parse_str($query, $queryData);

                            $youtubeId =
                                $queryData['v'] ?? null;
                        }

                        /*
                        | youtu.be/...
                        */

                        elseif (
                            str_contains($host, 'youtu.be')
                        ) {

                            $youtubeId =
                                trim($path, '/');
                        }

                        /*
                        | youtube.com/embed/...
                        */

                        elseif (
                            str_contains($path, '/embed/')
                        ) {

                            $youtubeId =
                                explode(
                                    '/embed/',
                                    $path
                                )[1] ?? null;
                        }

                        /*
                        | youtube.com/shorts/...
                        */

                        elseif (
                            str_contains($path, '/shorts/')
                        ) {

                            $youtubeId =
                                explode(
                                    '/shorts/',
                                    $path
                                )[1] ?? null;
                        }

                    } catch (\Throwable $e) {

                        $youtubeId = null;

                    }

                @endphp


                <article class="video-card">

                    <div class="video-header">

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

                    </div>


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

        <section class="empty">

            <div class="empty-icon">
                🎬
            </div>

            <div class="empty-title">
                Belum ada video
            </div>

            <div class="empty-text">
                Belum ada video pembelajaran untuk Pertemuan {{ $pertemuan }}.
            </div>

        </section>

    @endif

</main>

</div>

</body>

</html>