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
        }

        .main-content {
            margin-left: 256px;
            min-height: 100vh;
            transition: margin-left .3s ease;
        }

        .container {
            width: min(1100px, calc(100% - 40px));
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

        /* PERTEMUAN */

        .meeting-card {
            margin-bottom: 22px;
            padding: 18px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 17px;
        }

        .meeting-label {
            margin-bottom: 12px;
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
            padding-bottom: 2px;
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
            transition: .2s;
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

        /* HEADER */

        .content-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 15px;
        }

        .content-title {
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
        }

        .counter {
            margin-top: 3px;
            color: #64748b;
            font-size: 12px;
            font-weight: 750;
        }

        .add-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 42px;
            padding: 0 16px;
            border-radius: 10px;
            background: #0f172a;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 850;
            transition: .2s;
        }

        .add-button:hover {
            background: #1e293b;
            transform: translateY(-1px);
        }

        /* VIDEO */

        .video-list {
            display: grid;
            gap: 12px;
        }

        .video-card {
            padding: 19px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            transition: .2s;
        }

        .video-card:hover {
            border-color: #d7dee8;
            box-shadow: 0 8px 24px rgba(15, 23, 42, .05);
        }

        .video-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 15px;
        }

        .video-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            margin-right: 9px;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 900;
            vertical-align: middle;
        }

        .video-title {
            display: inline;
            color: #0f172a;
            font-size: 15px;
            font-weight: 850;
        }

        .video-description {
            margin: 10px 0 0 39px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.65;
        }

        .youtube-link {
            display: inline-block;
            margin: 11px 0 0 39px;
            max-width: calc(100% - 39px);
            overflow: hidden;
            color: #2563eb;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-decoration: none;
        }

        .youtube-link:hover {
            text-decoration: underline;
        }

        /* ACTION */

        .actions {
            display: flex;
            gap: 7px;
            flex: 0 0 auto;
        }

        .action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            min-width: 65px;
            height: 34px;
            padding: 0 10px;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 800;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        .edit {
            border: 1px solid #dbeafe;
            background: #eff6ff;
            color: #2563eb;
        }

        .edit:hover {
            background: #dbeafe;
        }

        .delete {
            border: 1px solid #fee2e2;
            background: #fef2f2;
            color: #dc2626;
        }

        .delete:hover {
            background: #fee2e2;
        }

        /* EMPTY */

        .empty {
            padding: 60px 20px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            text-align: center;
        }

        .empty-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 14px;
            border-radius: 16px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-title {
            margin-bottom: 5px;
            color: #334155;
            font-size: 15px;
            font-weight: 850;
        }

        .empty-text {
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.6;
        }

        .limit {
            margin-top: 12px;
            color: #94a3b8;
            font-size: 11px;
            text-align: right;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 650px) {

            .container {
                width: min(100% - 28px, 1100px);
                padding-top: 25px;
            }

            h1 {
                font-size: 27px;
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

        <div class="container">


            {{-- HEADER --}}

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



            {{-- SUCCESS --}}

            @if(session('success'))

                <div class="success">
                    {{ session('success') }}
                </div>

            @endif



            {{-- =================================================
                 PILIH PERTEMUAN
            ================================================== --}}

            <section class="meeting-card">

                <div class="meeting-label">
                    Pilih Pertemuan
                </div>


                <div class="meetings">

                    @for($i = 1; $i <= 8; $i++)

                        <a
                            href="{{ route('guru.videos.index', [
                                'pertemuan' => $i
                            ]) }}"
                            class="meeting {{ (int) $pertemuan === $i ? 'active' : '' }}"
                        >
                            Pertemuan {{ $i }}
                        </a>

                    @endfor

                </div>

            </section>



            {{-- =================================================
                 CONTENT HEADER
            ================================================== --}}

            <div class="content-header">

                <div>

                    <div class="content-title">
                        Video Pertemuan {{ $pertemuan }}
                    </div>

                    <div class="counter">
                        {{ $videos->count() }} dari 10 video
                    </div>

                </div>


                @if($videos->count() < 10)

                    <a
                        href="{{ route('guru.videos.create', [
                            'pertemuan' => $pertemuan
                        ]) }}"
                        class="add-button"
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

                                <div class="min-w-0">

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



                                {{-- ACTION --}}

                                <div class="actions">

                                    <a
                                        href="{{ route('guru.videos.edit', $video) }}"
                                        class="action edit"
                                    >

                                        <i
                                            data-lucide="pencil"
                                            class="w-3.5 h-3.5"
                                        ></i>

                                        Edit

                                    </a>


                                    <form
                                        action="{{ route('guru.videos.destroy', $video) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus video ini?');"
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
                        Belum ada video
                    </div>

                    <div class="empty-text">
                        Belum ada video pembelajaran untuk Pertemuan
                        {{ $pertemuan }}.
                        Silakan tambahkan video YouTube.
                    </div>

                </section>

            @endif



            <div class="limit">
                Maksimal 10 video untuk setiap pertemuan.
            </div>

        </div>

    </main>



    <script>
        document.addEventListener('DOMContentLoaded', function () {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        });
    </script>

</body>
</html>