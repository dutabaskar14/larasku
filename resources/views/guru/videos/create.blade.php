<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Video — LARASKU</title>

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
            width: min(800px, calc(100% - 36px));
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
            transition: .2s;
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
            line-height: 1.6;
        }

        .card {
            padding: 27px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 4px 18px rgba(15, 23, 42, .03);
        }

        .meeting-info {
            margin-bottom: 23px;
            padding: 15px 16px;
            border: 1px solid #dbeafe;
            border-radius: 12px;
            background: #eff6ff;
        }

        .meeting-info-title {
            color: #1e40af;
            font-size: 12px;
            font-weight: 850;
        }

        .meeting-info-text {
            margin-top: 4px;
            color: #3b82f6;
            font-size: 11px;
        }

        .field {
            margin-bottom: 19px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
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
            background: #fff;
            color: #0f172a;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        input,
        select {
            height: 45px;
            padding: 0 13px;
        }

        textarea {
            min-height: 120px;
            padding: 12px 13px;
            resize: vertical;
            line-height: 1.6;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
        }

        .hint {
            margin-top: 6px;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
        }

        .error {
            margin-top: 6px;
            color: #dc2626;
            font-size: 12px;
            font-weight: 650;
        }

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
            font-weight: 850;
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

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 45px;
            padding: 0 18px;
            border-radius: 10px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 850;
            text-decoration: none;
            cursor: pointer;
        }

        .cancel {
            flex: 0 0 auto;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #64748b;
        }

        .cancel:hover {
            background: #f8fafc;
        }

        .submit {
            flex: 1;
            border: 0;
            background: #0f172a;
            color: #fff;
        }

        .submit:hover {
            background: #1e293b;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 600px) {

            .container {
                width: min(100% - 28px, 800px);
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

        <div class="container">


            {{-- KEMBALI --}}

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



            {{-- HEADER --}}

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



            {{-- FORM --}}

            <section class="card">


                <div class="meeting-info">

                    <div class="meeting-info-title">
                        Video Pertemuan {{ $pertemuan }}
                    </div>

                    <div class="meeting-info-text">
                        Video akan otomatis masuk ke Pertemuan {{ $pertemuan }}.
                    </div>

                </div>



                <form
                    action="{{ route('guru.videos.store') }}"
                    method="POST"
                >

                    @csrf


                    {{-- PERTEMUAN --}}

                    <div class="field">

                        <label for="pertemuan">
                            Pertemuan
                            <span class="required">*</span>
                        </label>

                        <select
                            id="pertemuan"
                            name="pertemuan"
                            required
                        >

                            @for($i = 1; $i <= 8; $i++)

                                <option
                                    value="{{ $i }}"
                                    {{ (int) old('pertemuan', $pertemuan) === $i ? 'selected' : '' }}
                                >
                                    Pertemuan {{ $i }}
                                </option>

                            @endfor

                        </select>


                        @error('pertemuan')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- JUDUL --}}

                    <div class="field">

                        <label for="judul">
                            Judul Video
                            <span class="required">*</span>
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
                            Gunakan judul yang singkat dan mudah dipahami siswa.
                        </div>


                        @error('judul')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- YOUTUBE URL --}}

                    <div class="field">

                        <label for="youtube_url">
                            Link YouTube
                            <span class="required">*</span>
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
                            Tempel link video YouTube. Preview akan muncul otomatis jika link dikenali.
                        </div>


                        @error('youtube_url')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror



                        {{-- PREVIEW --}}

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
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen
                                ></iframe>

                            </div>

                        </div>

                    </div>



                    {{-- DESKRIPSI --}}

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
                            Opsional. Deskripsi akan ditampilkan kepada siswa.
                        </div>


                        @error('deskripsi')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>



                    {{-- BUTTON --}}

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
                        >
                            Simpan Video
                        </button>

                    </div>

                </form>

            </section>

        </div>

    </main>



    <script>

        document.addEventListener('DOMContentLoaded', function () {

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

        });


        const youtubeInput =
            document.getElementById('youtube_url');

        const previewCard =
            document.getElementById('preview-card');

        const previewFrame =
            document.getElementById('youtube-preview');


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

                const parsed = new URL(url);


                // youtube.com/watch?v=VIDEO_ID

                if (
                    parsed.hostname.includes('youtube.com') &&
                    parsed.searchParams.get('v')
                ) {

                    return parsed.searchParams.get('v');

                }


                // youtu.be/VIDEO_ID

                if (
                    parsed.hostname === 'youtu.be'
                ) {

                    return parsed.pathname
                        .replace('/', '')
                        .split('/')[0];

                }


                // youtube.com/embed/VIDEO_ID

                if (
                    parsed.hostname.includes('youtube.com') &&
                    parsed.pathname.startsWith('/embed/')
                ) {

                    return parsed.pathname
                        .split('/embed/')[1]
                        .split('/')[0];

                }


                // youtube.com/shorts/VIDEO_ID

                if (
                    parsed.hostname.includes('youtube.com') &&
                    parsed.pathname.startsWith('/shorts/')
                ) {

                    return parsed.pathname
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
            const videoId =
                getYoutubeId(
                    youtubeInput.value.trim()
                );


            if (videoId) {

                previewFrame.src =
                    'https://www.youtube.com/embed/' +
                    encodeURIComponent(videoId);

                previewCard.style.display =
                    'block';

            } else {

                previewFrame.src = '';

                previewCard.style.display =
                    'none';

            }
        }


        youtubeInput.addEventListener(
            'input',
            updatePreview
        );


        youtubeInput.addEventListener(
            'change',
            updatePreview
        );


        updatePreview();

    </script>

</body>
</html>