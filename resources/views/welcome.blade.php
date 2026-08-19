<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>LARASKU — Portal Pembelajaran</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background:
                radial-gradient(
                    circle at top left,
                    rgba(37, 99, 235, .12),
                    transparent 35%
                ),
                radial-gradient(
                    circle at bottom right,
                    rgba(14, 165, 233, .10),
                    transparent 35%
                ),
                #f8fafc;

            color: #0f172a;
        }

        .glass {
            background: rgba(255,255,255,.82);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border:
                1px solid
                rgba(255,255,255,.9);

            box-shadow:
                0 25px 70px
                rgba(15,23,42,.08);
        }

        .role-card {
            transition:
                transform .25s ease,
                box-shadow .25s ease,
                border-color .25s ease;
        }

        .role-card:hover {
            transform: translateY(-5px);

            box-shadow:
                0 22px 50px
                rgba(15,23,42,.12);
        }

        .role-icon {
            transition: transform .25s ease;
        }

        .role-card:hover .role-icon {
            transform: scale(1.08);
        }

    </style>

</head>


<body>


    <main
        class="
            min-h-screen
            flex
            items-center
            justify-center
            px-5
            py-10
        "
    >

        <div
            class="
                w-full
                max-w-5xl
            "
        >


            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="text-center mb-10">

                <div
                    class="
                        inline-flex
                        items-center
                        justify-center
                        w-16
                        h-16
                        rounded-2xl
                        bg-blue-600
                        text-white
                        shadow-lg
                        shadow-blue-200
                        mb-5
                    "
                >

                    <i
                        data-lucide="graduation-cap"
                        class="w-8 h-8"
                    ></i>

                </div>


                <h1
                    class="
                        text-4xl
                        md:text-5xl
                        font-black
                        tracking-tight
                        text-slate-900
                    "
                >
                    LARASKU
                </h1>


                <p
                    class="
                        text-sm
                        md:text-base
                        text-slate-500
                        mt-3
                        max-w-xl
                        mx-auto
                        leading-relaxed
                    "
                >
                    Portal pembelajaran dan evaluasi
                    untuk mendukung kegiatan belajar
                    secara terintegrasi.
                </p>

            </div>



            {{-- =====================================================
                 LOGIN ROLE
            ====================================================== --}}

            <section
                class="
                    glass
                    rounded-3xl
                    p-6
                    md:p-8
                "
            >

                <div
                    class="
                        text-center
                        mb-7
                    "
                >

                    <p
                        class="
                            text-xs
                            font-black
                            uppercase
                            tracking-[.2em]
                            text-blue-600
                        "
                    >
                        Selamat Datang
                    </p>


                    <h2
                        class="
                            text-xl
                            md:text-2xl
                            font-black
                            text-slate-900
                            mt-2
                        "
                    >
                        Pilih Akses Anda
                    </h2>


                    <p
                        class="
                            text-sm
                            text-slate-400
                            mt-2
                        "
                    >
                        Pilih sesuai peran untuk melanjutkan.
                    </p>

                </div>



                <div
                    class="
                        grid
                        grid-cols-1
                        md:grid-cols-2
                        gap-5
                    "
                >


                    {{-- =================================================
                         GURU
                    ================================================== --}}

                    <a
                        href="{{ route('login') }}"
                        class="
                            role-card
                            group
                            block
                            rounded-2xl
                            border
                            border-slate-200
                            bg-white
                            p-6
                            no-underline
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div
                                class="
                                    role-icon
                                    w-14
                                    h-14
                                    rounded-2xl
                                    bg-blue-50
                                    text-blue-600
                                    flex
                                    items-center
                                    justify-center
                                "
                            >

                                <i
                                    data-lucide="shield-check"
                                    class="w-7 h-7"
                                ></i>

                            </div>


                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-xl
                                    bg-slate-50
                                    text-slate-400
                                    flex
                                    items-center
                                    justify-center
                                    group-hover:bg-blue-50
                                    group-hover:text-blue-600
                                    transition
                                "
                            >

                                <i
                                    data-lucide="arrow-up-right"
                                    class="w-4 h-4"
                                ></i>

                            </div>

                        </div>


                        <h3
                            class="
                                text-xl
                                font-black
                                text-slate-900
                                mt-5
                            "
                        >
                            Guru
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                leading-relaxed
                            "
                        >
                            Masuk ke panel guru untuk
                            mengelola siswa, kelas, absensi,
                            materi, Quiz, LKPD, refleksi,
                            dan evaluasi pembelajaran.
                        </p>


                        <div
                            class="
                                inline-flex
                                items-center
                                gap-2
                                mt-5
                                text-sm
                                font-bold
                                text-blue-600
                            "
                        >

                            Masuk sebagai Guru

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </div>

                    </a>



                    {{-- =================================================
                         SISWA
                    ================================================== --}}

                    <a
                        href="{{ route('attendance.index') }}"
                        class="
                            role-card
                            group
                            block
                            rounded-2xl
                            border
                            border-slate-200
                            bg-white
                            p-6
                            no-underline
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                justify-between
                                gap-4
                            "
                        >

                            <div
                                class="
                                    role-icon
                                    w-14
                                    h-14
                                    rounded-2xl
                                    bg-emerald-50
                                    text-emerald-600
                                    flex
                                    items-center
                                    justify-center
                                "
                            >

                                <i
                                    data-lucide="user-round"
                                    class="w-7 h-7"
                                ></i>

                            </div>


                            <div
                                class="
                                    w-9
                                    h-9
                                    rounded-xl
                                    bg-slate-50
                                    text-slate-400
                                    flex
                                    items-center
                                    justify-center
                                    group-hover:bg-emerald-50
                                    group-hover:text-emerald-600
                                    transition
                                "
                            >

                                <i
                                    data-lucide="arrow-up-right"
                                    class="w-4 h-4"
                                ></i>

                            </div>

                        </div>


                        <h3
                            class="
                                text-xl
                                font-black
                                text-slate-900
                                mt-5
                            "
                        >
                            Siswa
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-500
                                mt-2
                                leading-relaxed
                            "
                        >
                            Masuk ke halaman siswa untuk
                            melakukan absensi dan melanjutkan
                            aktivitas pembelajaran.
                        </p>


                        <div
                            class="
                                inline-flex
                                items-center
                                gap-2
                                mt-5
                                text-sm
                                font-bold
                                text-emerald-600
                            "
                        >

                            Masuk ke Absensi

                            <i
                                data-lucide="arrow-right"
                                class="w-4 h-4"
                            ></i>

                        </div>

                    </a>

                </div>

            </section>



            {{-- =====================================================
                 FOOTER
            ====================================================== --}}

            <div
                class="
                    text-center
                    mt-7
                    text-xs
                    text-slate-400
                "
            >

                LARASKU
                <span class="mx-1">•</span>
                Portal Pembelajaran

            </div>

        </div>

    </main>



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