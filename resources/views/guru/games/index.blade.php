<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Game Interaktif — Guru — LARASKU</title>

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
        }

        .container {
            width: min(850px, calc(100% - 36px));
            margin: auto;
            padding: 34px 0 60px;
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
            margin-top: 8px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .success {
            margin-top: 22px;
            padding: 13px 15px;
            border: 1px solid #bbf7d0;
            border-radius: 12px;
            background: #ecfdf5;
            color: #166534;
            font-size: 13px;
            font-weight: 750;
        }

        .card {
            margin-top: 24px;
            padding: 28px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, .035);
        }

        .game-heading {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 25px;
        }

        .game-icon {
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            background: #eff6ff;
            color: #2563eb;
        }

        .game-title {
            color: #0f172a;
            font-size: 17px;
            font-weight: 900;
        }

        .game-description {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 12px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 12px;
            font-weight: 850;
        }

        input[type="url"] {
            width: 100%;
            height: 47px;
            padding: 0 14px;
            border: 1px solid #dbe2ea;
            border-radius: 11px;
            outline: none;
            background: #fff;
            color: #0f172a;
            font-family: inherit;
            font-size: 14px;
        }

        input[type="url"]:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .10);
        }

        .hint {
            margin-top: 7px;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.6;
        }

        .error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 12px;
            font-weight: 700;
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
        }

        .toggle-title {
            color: #334155;
            font-size: 13px;
            font-weight: 850;
        }

        .toggle-description {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 11px;
        }

        .switch {
            position: relative;
            width: 45px;
            height: 25px;
            flex: 0 0 45px;
        }

        .switch input {
            display: none;
        }

        .slider {
            position: absolute;
            inset: 0;
            cursor: pointer;
            border-radius: 999px;
            background: #cbd5e1;
            transition: .2s;
        }

        .slider::before {
            content: "";
            position: absolute;
            width: 19px;
            height: 19px;
            left: 3px;
            top: 3px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .18);
            transition: .2s;
        }

        .switch input:checked + .slider {
            background: #2563eb;
        }

        .switch input:checked + .slider::before {
            transform: translateX(20px);
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 24px;
        }

        .save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 45px;
            padding: 0 20px;
            border: 0;
            border-radius: 10px;
            background: #0f172a;
            color: #fff;
            font-family: inherit;
            font-size: 13px;
            font-weight: 850;
            cursor: pointer;
        }

        .save:hover {
            background: #1e293b;
        }

        .preview {
            margin-top: 25px;
            padding: 17px;
            border: 1px solid #dbeafe;
            border-radius: 13px;
            background: #eff6ff;
        }

        .preview-label {
            color: #1e40af;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .preview-link {
            display: block;
            margin-top: 7px;
            overflow: hidden;
            color: #2563eb;
            font-size: 12px;
            text-overflow: ellipsis;
            white-space: nowrap;
            text-decoration: none;
        }

        .preview-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }

        @media (max-width: 600px) {
            .container {
                width: min(100% - 28px, 850px);
                padding-top: 25px;
            }

            h1 {
                font-size: 27px;
            }

            .card {
                padding: 20px;
            }

            .actions {
                display: block;
            }

            .save {
                width: 100%;
            }
        }
    </style>
</head>


<body>

    {{-- SIDEBAR GLOBAL --}}

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

        <div class="eyebrow">
            Panel Guru
        </div>

        <h1>
            Game Interaktif
        </h1>

        <p class="subtitle">
            Atur satu link game interaktif yang akan dimainkan oleh siswa.
        </p>


        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


            <section class="card">

                <div class="game-heading">

                    <div class="game-icon">

                        <i
                            data-lucide="gamepad-2"
                            class="w-6 h-6"
                        ></i>

                    </div>

                    <div>

                        <div class="game-title">
                            Game Interaktif
                        </div>

                        <div class="game-description">
                            Satu link game untuk seluruh siswa.
                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('guru.games.update') }}"
                >

                    @csrf
                    @method('PUT')


                    <div class="field">

                        <label for="link">
                            Link Game
                        </label>

                        <input
                            type="url"
                            id="link"
                            name="link"
                            value="{{ old('link', $game?->link) }}"
                            placeholder="https://contoh-website-game.com/..."
                            required
                        >

                        <div class="hint">
                            Masukkan URL lengkap website game yang akan dibuka oleh siswa.
                        </div>


                        @error('link')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    <div class="toggle-row">

                        <div>

                            <div class="toggle-title">
                                Game Aktif
                            </div>

                            <div class="toggle-description">
                                Jika aktif, siswa dapat membuka game.
                            </div>

                        </div>


                        <label class="switch">

                            <input
                                type="checkbox"
                                name="aktif"
                                value="1"
                                {{ old('aktif', $game?->aktif ?? true) ? 'checked' : '' }}
                            >

                            <span class="slider"></span>

                        </label>

                    </div>


                    @if($game?->link)

                        <div class="preview">

                            <div class="preview-label">
                                Link saat ini
                            </div>

                            <a
                                href="{{ $game->link }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="preview-link"
                            >
                                {{ $game->link }}
                            </a>

                        </div>

                    @endif


                    <div class="actions">

                        <button
                            type="submit"
                            class="save"
                        >

                            <i
                                data-lucide="save"
                                class="w-4 h-4"
                            ></i>

                            Simpan Link Game

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
    </script>

</body>
</html>