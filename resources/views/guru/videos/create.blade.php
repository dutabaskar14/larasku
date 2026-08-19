<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tambah Video — LARASKU</title>

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

            transition:
                margin-left .3s ease;
        }


        .container {
            width: min(
                820px,
                calc(100% - 40px)
            );

            margin: 0 auto;

            padding:
                34px 0 60px;
        }


        /* =====================================================
           BACK BUTTON
        ====================================================== */

        .back {
            display: inline-flex;
            align-items: center;

            gap: 7px;

            margin-bottom: 21px;

            color: #64748b;

            text-decoration: none;

            font-size: 12px;
            line-height: 1.4;
            font-weight: 800;

            transition:
                color .2s ease,
                transform .2s ease;
        }


        .back:hover {
            color: #0f172a;

            transform:
                translateX(-2px);
        }


        /* =====================================================
           PAGE HEADER
        ====================================================== */

        .heading {
            margin-bottom: 24px;
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
            margin: 9px 0 0;

            color: #64748b;

            font-size: 13px;
            line-height: 1.7;
            font-weight: 500;
        }


        /* =====================================================
           CARD
        ====================================================== */

        .card {
            padding: 27px;

            background: #ffffff;

            border: 1px solid #e2e8f0;
            border-radius: 18px;

            box-shadow:
                0 4px 18px rgba(
                    15,
                    23,
                    42,
                    .035
                );
        }


        /* =====================================================
           MEETING INFO
        ====================================================== */

        .meeting-info {
            margin-bottom: 24px;

            padding: 15px 16px;

            border: 1px solid #bfdbfe;
            border-radius: 12px;

            background: #eff6ff;
        }


        .meeting-info-title {
            color: #1e40af;

            font-size: 12px;
            line-height: 1.4;
            font-weight: 900;
        }


        .meeting-info-text {
            margin-top: 4px;

            color: #3b82f6;

            font-size: 11px;
            line-height: 1.6;
            font-weight: 600;
        }


        /* =====================================================
           FIELD
        ====================================================== */

        .field {
            margin-bottom: 20px;
        }


        label {
            display: block;

            margin-bottom: 7px;

            color: #334155;

            font-size: 12px;
            line-height: 1.4;
            font-weight: 850;
        }


        .required {
            color: #dc2626;
        }


        input,
        textarea,
        select {
            width: 100%;

            border: 1px solid #dbe2ea;
            border-radius: 11px;

            background: #ffffff;
            color: #0f172a;

            font-family: inherit;

            font-size: 13px;
            font-weight: 600;

            outline: none;

            transition:
                border-color .2s ease,
                box-shadow .2s ease;
        }


        input,
        select {
            height: 46px;

            padding: 0 13px;
        }


        textarea {
            min-height: 120px;

            padding: 12px 13px;

            resize: vertical;

            line-height: 1.65;
        }


        input::placeholder,
        textarea::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }


        input:focus,
        textarea:focus,
        select:focus {
            border-color: #60a5fa;

            box-shadow:
                0 0 0 3px
                rgba(
                    59,
                    130,
                    246,
                    .10
                );
        }


        /* =====================================================
           HINT / ERROR
        ====================================================== */

        .hint {
            margin-top: 6px;

            color: #94a3b8;

            font-size: 11px;
            line-height: 1.6;
            font-weight: 500;
        }


        .error {
            margin-top: 6px;

            color: #dc2626;

            font-size: 12px;
            line-height: 1.5;
            font-weight: 700;
        }


        /* =====================================================
           NO MEETINGS
        ====================================================== */

        .no-meetings {
            padding: 14px 15px;

            border: 1px solid #fecaca;
            border-radius: 11px;

            background: #fef2f2;
            color: #b91c1c;

            font-size: 12px;
            line-height: 1.6;
            font-weight: 700;
        }


        /* =====================================================
           PREVIEW
        ====================================================== */

        .preview-card {
            display: none;

            margin-top: 22px;

            overflow: hidden;

            border: 1px solid #e2e8f0;
            border-radius: 14px;

            background: #f8fafc;
        }


        .preview-header {
            padding: 14px 16px;

            border-bottom: 1px solid #e2e8f0;
        }


        .preview-title {
            color: #0f172a;

            font-size: 13px;
            line-height: 1.4;
            font-weight: 900;
        }


        .preview-frame {
            position: relative;

            width: 100%;

            padding-top: 56.25%;

            background: #0f172a;
        }


        .preview-frame iframe {
            position: absolute;

            inset: 0;

            width: 100%;
            height: 100%;

            border: 0;
        }


        /* =====================================================
           BUTTONS
        ====================================================== */

        .actions {
            display: flex;

            gap: 10px;

            margin-top: 26px;
        }


        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            min-height: 45px;

            padding: 0 18px;

            border-radius: 10px;

            font-family: inherit;

            font-size: 12px;
            line-height: 1;
            font-weight: 850;

            text-decoration: none;

            cursor: pointer;

            transition:
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }


        .cancel {
            flex: 0 0 auto;

            border: 1px solid #e2e8f0;

            background: #ffffff;
            color: #64748b;
        }


        .cancel:hover {
            background: #f8fafc;

            color: #334155;
        }


        .submit {
            flex: 1;

            border: 0;

            background: #0f172a;
            color: #ffffff;
        }


        .submit:hover {
            background: #1e293b;

            transform:
                translateY(-1px);
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }


        @media (max-width: 600px) {

            .container {
                width:
                    min(
                        calc(100% - 28px),
                        820px
                    );

                padding-top: 25px;
            }


            h1 {
                font-size: 27px;
            }


            .card {
                padding: 20px;
            }


            .actions {
                flex-direction: column-reverse;
            }


            .cancel,
            .submit {
                width: 100%;
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


        {{-- =====================================================
             HEADBAR GURU
        ====================================================== --}}

        @include('guru.partials.header')


        <div class="container">


            {{-- =================================================
                 KEMBALI
            ================================================== --}}

            <a
                href="{{ route('guru.videos.index', [
                    'pertemuan' => $pertemuan
                ]) }}"
                class="back"
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke Video

            </a>



            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="heading">

                <div class="eyebrow">
                    Panel Guru
                </div>


                <h1>
                    Tambah Video
                </h1>


                <p class="subtitle">
                    Tambahkan video pembelajaran YouTube untuk siswa.
                </p>

            </section>



            {{-- =================================================
                 FORM CARD
            ================================================== --}}

            <section class="card">


                {{-- =================================================
                     INFO PERTEMUAN
                ================================================== --}}

                <div class="meeting-info">

                    <div class="meeting-info-title">
                        Video Pertemuan {{ $pertemuan }}
                    </div>


                    <div class="meeting-info-text">
                        Video akan otomatis masuk ke
                        Pertemuan {{ $pertemuan }}.
                    </div>

                </div>



                {{-- =================================================
                     FORM
                ================================================== --}}

                <form
                    action="{{ route('guru.videos.store') }}"
                    method="POST"
                >

                    @csrf



                    {{-- =================================================
                         PERTEMUAN
                    ================================================== --}}

                    <div class="field">

                        <label for="pertemuan">

                            Pertemuan

                            <span class="required">
                                *
                            </span>

                        </label>


                        @if($meetings->isEmpty())

                            <div class="no-meetings">

                                Belum ada Pertemuan Video.
                                Silakan buat Pertemuan Video
                                terlebih dahulu sebelum menambahkan video.

                            </div>

                        @else

                            <select
                                id="pertemuan"
                                name="pertemuan"
                                required
                            >

                                @foreach($meetings as $meeting)

                                    <option
                                        value="{{ $meeting->pertemuan }}"
                                        {{
                                            (int) old(
                                                'pertemuan',
                                                $pertemuan
                                            ) ===
                                            (int) $meeting->pertemuan
                                                ? 'selected'
                                                : ''
                                        }}
                                    >

                                        Pertemuan
                                        {{ $meeting->pertemuan }}

                                    </option>

                                @endforeach

                            </select>

                        @endif


                        @error('pertemuan')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- =================================================
                         JUDUL
                    ================================================== --}}

                    <div class="field">

                        <label for="judul">

                            Judul Video

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="text"
                            id="judul"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Contoh: Mengenal Lagu Daerah Indonesia"
                            maxlength="255"
                            required
                        >


                        <div class="hint">
                            Gunakan judul yang singkat dan mudah
                            dipahami siswa.
                        </div>


                        @error('judul')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- =================================================
                         YOUTUBE URL
                    ================================================== --}}

                    <div class="field">

                        <label for="youtube_url">

                            Link YouTube

                            <span class="required">
                                *
                            </span>

                        </label>


                        <input
                            type="url"
                            id="youtube_url"
                            name="youtube_url"
                            value="{{ old('youtube_url') }}"
                            placeholder="https://www.youtube.com/watch?v=..."
                            maxlength="2000"
                            required
                        >


                        <div class="hint">
                            Tempel link video YouTube.
                            Preview akan muncul otomatis
                            jika link dikenali.
                        </div>


                        @error('youtube_url')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror



                        {{-- =================================================
                             PREVIEW
                        ================================================== --}}

                        <div
                            id="preview-card"
                            class="preview-card"
                        >

                            <div class="preview-header">

                                <div class="preview-title">
                                    Preview Video
                                </div>

                            </div>


                            <div class="preview-frame">

                                <iframe
                                    id="youtube-preview"
                                    src=""
                                    title="Preview YouTube"
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
                                ></iframe>

                            </div>

                        </div>

                    </div>



                    {{-- =================================================
                         DESKRIPSI
                    ================================================== --}}

                    <div class="field">

                        <label for="deskripsi">
                            Deskripsi
                        </label>


                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            maxlength="5000"
                            placeholder="Tambahkan penjelasan singkat tentang video..."
                        >{{ old('deskripsi') }}</textarea>


                        <div class="hint">
                            Opsional. Deskripsi akan ditampilkan
                            kepada siswa.
                        </div>


                        @error('deskripsi')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- =================================================
                         BUTTON
                    ================================================== --}}

                    <div class="actions">


                        <a
                            href="{{ route('guru.videos.index', [
                                'pertemuan' => $pertemuan
                            ]) }}"
                            class="button cancel"
                        >
                            Batal
                        </a>


                        <button
                            type="submit"
                            class="button submit"
                            @disabled($meetings->isEmpty())
                        >
                            Simpan Video
                        </button>

                    </div>


                </form>

            </section>

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


        const youtubeInput =
            document.getElementById(
                'youtube_url'
            );


        const previewCard =
            document.getElementById(
                'preview-card'
            );


        const previewFrame =
            document.getElementById(
                'youtube-preview'
            );


        /*
        |--------------------------------------------------------------------------
        | AMBIL YOUTUBE VIDEO ID
        |--------------------------------------------------------------------------
        */

        function getYoutubeId(url)
        {

            if (!url) {
                return null;
            }


            try {

                const parsed =
                    new URL(url);


                /*
                |--------------------------------------------------------------------------
                | youtube.com/watch?v=VIDEO_ID
                |--------------------------------------------------------------------------
                */

                if (
                    parsed.hostname.includes(
                        'youtube.com'
                    ) &&
                    parsed.searchParams.get('v')
                ) {

                    return parsed
                        .searchParams
                        .get('v');

                }


                /*
                |--------------------------------------------------------------------------
                | youtu.be/VIDEO_ID
                |--------------------------------------------------------------------------
                */

                if (
                    parsed.hostname ===
                    'youtu.be'
                ) {

                    return parsed
                        .pathname
                        .replace('/', '')
                        .split('/')[0];

                }


                /*
                |--------------------------------------------------------------------------
                | youtube.com/embed/VIDEO_ID
                |--------------------------------------------------------------------------
                */

                if (
                    parsed.hostname.includes(
                        'youtube.com'
                    ) &&
                    parsed.pathname.startsWith(
                        '/embed/'
                    )
                ) {

                    return parsed
                        .pathname
                        .split('/embed/')[1]
                        .split('/')[0];

                }


                /*
                |--------------------------------------------------------------------------
                | youtube.com/shorts/VIDEO_ID
                |--------------------------------------------------------------------------
                */

                if (
                    parsed.hostname.includes(
                        'youtube.com'
                    ) &&
                    parsed.pathname.startsWith(
                        '/shorts/'
                    )
                ) {

                    return parsed
                        .pathname
                        .split('/shorts/')[1]
                        .split('/')[0];

                }

            } catch (error) {

                return null;

            }


            return null;
        }



        /*
        |--------------------------------------------------------------------------
        | PREVIEW
        |--------------------------------------------------------------------------
        */

        function updatePreview()
        {

            if (
                !youtubeInput ||
                !previewCard ||
                !previewFrame
            ) {

                return;

            }


            const videoId =
                getYoutubeId(
                    youtubeInput.value.trim()
                );


            if (videoId) {

                previewFrame.src =
                    'https://www.youtube.com/embed/' +
                    encodeURIComponent(
                        videoId
                    );


                previewCard.style.display =
                    'block';

            } else {

                previewFrame.src = '';

                previewCard.style.display =
                    'none';

            }

        }



        if (youtubeInput) {

            youtubeInput.addEventListener(
                'input',
                updatePreview
            );


            youtubeInput.addEventListener(
                'change',
                updatePreview
            );

        }


        updatePreview();

    </script>


</body>

</html>