<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Game Interaktif — LARASKU</title>

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
           MAIN CONTENT
        ====================================================== */

        #studentMainContent {

            margin-left: 256px;

            min-height: 100vh;

        }


        /* =====================================================
           TOPBAR
        ====================================================== */

        .topbar {

            height: 74px;

            background: #fff;

            border-bottom:
                1px solid #e5e7eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 34px;

            position: sticky;

            top: 0;

            z-index: 20;

        }


        .brand {

            font-size: 22px;

            font-weight: 900;

            letter-spacing: -.04em;

            color: #0f172a;

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

            border:
                1px solid #e2e8f0;

            border-radius: 10px;

            background: #f8fafc;

            color: #64748b;

            font-size: 12px;

            font-weight: 800;

        }


        /* =====================================================
           CONTAINER
        ====================================================== */

        .container {

            width:
                min(
                    1000px,
                    calc(100% - 36px)
                );

            margin: auto;

            padding: 38px 0 60px;

        }


        /* =====================================================
           HEADER
        ====================================================== */

        .eyebrow {

            margin-bottom: 7px;

            color: #2563eb;

            font-size: 11px;

            font-weight: 900;

            letter-spacing: .12em;

            text-transform: uppercase;

        }


        h1 {

            margin: 0;

            color: #0f172a;

            font-size: 34px;

            font-weight: 900;

            letter-spacing: -.04em;

        }


        .subtitle {

            margin-top: 9px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;

        }


        /* =====================================================
           GAME CARD
        ====================================================== */

        .game-card {

            margin-top: 28px;

            overflow: hidden;

            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 22px;

            box-shadow:
                0 8px 30px
                rgba(15, 23, 42, .045);

        }


        .game-header {

            padding: 30px;

            border-bottom:
                1px solid #f1f5f9;

        }


        .game-icon {

            width: 58px;

            height: 58px;

            border-radius: 16px;

            background: #eff6ff;

            color: #2563eb;

            display: flex;

            align-items: center;

            justify-content: center;

            margin-bottom: 17px;

        }


        .game-title {

            margin: 0;

            color: #0f172a;

            font-size: 24px;

            font-weight: 900;

        }


        .game-description {

            margin-top: 8px;

            color: #64748b;

            font-size: 14px;

            line-height: 1.7;

        }


        /* =====================================================
           GAME ACTION
        ====================================================== */

        .game-action {

            padding: 30px;

        }


        .play-box {

            padding: 25px;

            border:
                1px solid #dbeafe;

            border-radius: 17px;

            background:
                linear-gradient(
                    135deg,
                    #f8fbff,
                    #eff6ff
                );

            text-align: center;

        }


        .play-icon {

            width: 52px;

            height: 52px;

            margin: 0 auto 13px;

            border-radius: 50%;

            background: #2563eb;

            color: #fff;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .play-title {

            color: #0f172a;

            font-size: 17px;

            font-weight: 850;

        }


        .play-text {

            margin-top: 6px;

            color: #64748b;

            font-size: 13px;

            line-height: 1.6;

        }


        .play-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 9px;

            margin-top: 19px;

            padding: 13px 23px;

            border-radius: 11px;

            background: #2563eb;

            color: #fff;

            text-decoration: none;

            font-size: 14px;

            font-weight: 850;

            box-shadow:
                0 8px 20px
                rgba(37, 99, 235, .20);

            transition:
                transform .18s ease,
                background .18s ease;

        }


        .play-button:hover {

            background: #1d4ed8;

            transform:
                translateY(-1px);

        }


        /* =====================================================
           EMPTY
        ====================================================== */

        .empty-card {

            margin-top: 28px;

            padding: 55px 25px;

            background: #fff;

            border:
                1px solid #e5e7eb;

            border-radius: 20px;

            text-align: center;

        }


        .empty-icon {

            width: 58px;

            height: 58px;

            margin: 0 auto 15px;

            border-radius: 16px;

            background: #f1f5f9;

            color: #94a3b8;

            display: flex;

            align-items: center;

            justify-content: center;

        }


        .empty-title {

            color: #334155;

            font-size: 16px;

            font-weight: 850;

        }


        .empty-text {

            margin-top: 6px;

            color: #94a3b8;

            font-size: 13px;

        }


        /* =====================================================
           MOBILE
        ====================================================== */

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

                width:
                    calc(100% - 28px);

                padding-top: 27px;

            }


            h1 {

                font-size: 28px;

            }


            .game-header,
            .game-action {

                padding: 21px;

            }

        }

    </style>

</head>


<body>


{{-- =========================================================
     SIDEBAR SISWA
     
     Mengambil sidebar siswa yang sudah dibuat.
========================================================= --}}

@include('partials.sidebar')



{{-- =========================================================
     MAIN
========================================================= --}}

<div id="studentMainContent">


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


        <div class="badge">

            Game Interaktif

        </div>

    </header>



    {{-- =====================================================
         CONTENT
    ====================================================== --}}

    <main class="container">


        <div class="eyebrow">

            LARASKU

        </div>


        <h1>

            Game Interaktif

        </h1>


        <p class="subtitle">

            Bermain sambil belajar melalui
            permainan interaktif yang telah
            disiapkan oleh guru.

        </p>



        {{-- =================================================
             GAME DARI GURU
        ================================================== --}}

        @if($game && $game->link)


            <section class="game-card">


                <div class="game-header">


                    <div class="game-icon">

                        <i
                            data-lucide="gamepad-2"
                            class="w-7 h-7"
                        ></i>

                    </div>


                    <h2 class="game-title">

                        Game Interaktif

                    </h2>


                    <p class="game-description">

                        Klik tombol di bawah untuk
                        membuka dan memainkan game
                        interaktif yang telah disediakan
                        oleh guru.

                    </p>

                </div>



                <div class="game-action">


                    <div class="play-box">


                        <div class="play-icon">

                            <i
                                data-lucide="play"
                                class="w-6 h-6"
                                fill="currentColor"
                            ></i>

                        </div>


                        <div class="play-title">

                            Siap untuk bermain?

                        </div>


                        <div class="play-text">

                            Game akan dibuka di
                            halaman baru.

                        </div>


                        <a
                            href="{{ $game->link }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="play-button"
                        >

                            <i
                                data-lucide="external-link"
                                class="w-4 h-4"
                            ></i>


                            Klik di sini untuk bermain

                        </a>

                    </div>


                </div>


            </section>


        @else


            {{-- =================================================
                 JIKA GURU BELUM MENGISI LINK
            ================================================== --}}

            <section class="empty-card">


                <div class="empty-icon">

                    <i
                        data-lucide="gamepad-2"
                        class="w-7 h-7"
                    ></i>

                </div>


                <div class="empty-title">

                    Game belum tersedia

                </div>


                <div class="empty-text">

                    Guru belum memasukkan
                    link game interaktif.

                </div>


            </section>


        @endif


    </main>


</div>



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
