<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Refleksi — LARASKU</title>

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

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
            }
        }

        .answer-box {
            white-space: pre-wrap;
            word-break: break-word;
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
             TOPBAR
        ====================================================== --}}

        <header
            class="
                h-16
                bg-white
                border-b
                border-slate-200
                flex
                items-center
                justify-between
                px-5
                lg:px-8
                sticky
                top-0
                z-20
            "
        >

            <div>

                <p class="text-xs text-slate-400">
                    Panel Guru
                </p>

                <h2 class="font-bold text-slate-900">
                    Detail Refleksi
                </h2>

            </div>


            <div
                class="
                    w-9
                    h-9
                    rounded-full
                    bg-blue-600
                    text-white
                    flex
                    items-center
                    justify-center
                    font-bold
                "
            >
                G
            </div>

        </header>



        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div
            class="
                max-w-4xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


            {{-- =================================================
                 BACK
            ================================================== --}}

            <a
                href="{{ route('guru.reflections.index') }}"
                class="
                    inline-flex
                    items-center
                    gap-2
                    mb-6
                    text-sm
                    font-bold
                    text-slate-500
                    hover:text-blue-600
                    transition
                "
            >

                <i
                    data-lucide="arrow-left"
                    class="w-4 h-4"
                ></i>

                Kembali ke Rekap Refleksi

            </a>



            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="mb-6">

                <div
                    class="
                        inline-flex
                        items-center
                        gap-2
                        px-3
                        py-1.5
                        rounded-full
                        bg-blue-50
                        text-blue-600
                        text-xs
                        font-bold
                        mb-3
                    "
                >

                    <i
                        data-lucide="message-square"
                        class="w-3.5 h-3.5"
                    ></i>

                    Panel Guru

                </div>


                <h1
                    class="
                        text-3xl
                        lg:text-4xl
                        font-black
                        tracking-tight
                        text-slate-900
                    "
                >
                    Detail Refleksi
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Jawaban refleksi siswa berdasarkan
                    pertemuan pembelajaran.
                </p>

            </section>



            {{-- =================================================
                 INFORMASI SISWA
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-5
                    lg:p-6
                    mb-5
                "
            >

                <div
                    class="
                        flex
                        flex-col
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                        gap-4
                    "
                >

                    <div>

                        <div
                            class="
                                text-xl
                                font-black
                                text-slate-900
                            "
                        >
                            {{ $reflection->student->nama ?? 'Siswa tidak ditemukan' }}
                        </div>


                        <div
                            class="
                                text-sm
                                text-slate-500
                                mt-1
                            "
                        >

                            No. Absen:

                            <strong class="text-slate-700">
                                {{ $reflection->student->nomor_absen ?? '-' }}
                            </strong>


                            <span class="mx-2 text-slate-300">
                                •
                            </span>


                            Kelas:

                            <strong class="text-slate-700">
                                {{ $reflection->student->kelas ?? '-' }}
                            </strong>

                        </div>

                    </div>


                    <div
                        class="
                            self-start
                            sm:self-auto
                            inline-flex
                            items-center
                            px-3
                            py-2
                            rounded-xl
                            bg-blue-50
                            text-blue-600
                            text-xs
                            font-bold
                        "
                    >

                        Pertemuan {{ $reflection->pertemuan }}

                    </div>

                </div>


                <div
                    class="
                        flex
                        flex-wrap
                        gap-x-4
                        gap-y-1
                        mt-5
                        text-xs
                        text-slate-400
                    "
                >

                    <span>

                        Dikirim:

                        {{ $reflection->created_at->format('d/m/Y H:i') }}

                    </span>


                    @if($reflection->updated_at != $reflection->created_at)

                        <span>

                            Diperbarui:

                            {{ $reflection->updated_at->format('d/m/Y H:i') }}

                        </span>

                    @endif

                </div>

            </section>



            {{-- =================================================
                 JAWABAN
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    overflow-hidden
                "
            >

                <div
                    class="
                        px-5
                        lg:px-6
                        py-5
                        border-b
                        border-slate-100
                    "
                >

                    <h2
                        class="
                            text-base
                            font-black
                            text-slate-900
                        "
                    >
                        Jawaban Refleksi
                    </h2>


                    <p
                        class="
                            text-xs
                            text-slate-400
                            mt-1
                        "
                    >
                        Lima pertanyaan refleksi siswa
                    </p>

                </div>



                @php

                    $questions = match ((int) $reflection->pertemuan) {

                        1 => [
                            'Apa yang kamu pahami tentang pengertian lagu daerah setelah mengikuti pembelajaran hari ini?',
                            'Sebutkan satu lagu daerah yang kamu ketahui dan jelaskan dari daerah mana lagu tersebut berasal.',
                            'Menurut pendapatmu, mengapa lagu daerah perlu dilestarikan oleh generasi muda?',
                            'Apa hal baru yang kamu ketahui tentang lagu daerah pada pembelajaran hari ini?',
                            'Setelah mempelajari lagu daerah, bagaimana perasaanmu terhadap keberagaman budaya musik di Indonesia?',
                        ],

                        2 => [
                            'Apa ciri-ciri lagu daerah yang kamu pahami setelah pembelajaran hari ini?',
                            'Lagu daerah apa yang paling menarik perhatianmu? Jelaskan alasanmu.',
                            'Apa perbedaan yang kamu rasakan antara lagu daerah dari satu daerah dengan daerah lainnya?',
                            'Bagian materi lagu daerah apa yang masih membuatmu bingung atau belum kamu pahami?',
                            'Menurutmu, bagaimana cara yang dapat dilakukan siswa untuk ikut melestarikan lagu daerah?',
                        ],

                        3 => [
                            'Apa yang kamu pahami tentang teknik pernapasan dalam bernyanyi?',
                            'Teknik bernyanyi apa yang menurutmu paling sulit untuk dilakukan? Mengapa?',
                            'Apa yang kamu rasakan ketika mencoba menerapkan teknik pernapasan saat bernyanyi?',
                            'Kesalahan apa yang kamu lakukan saat berlatih bernyanyi dan bagaimana cara kamu memperbaikinya?',
                            'Setelah mengikuti pembelajaran hari ini, perubahan apa yang kamu rasakan dalam kemampuan bernyanyimu?',
                        ],

                        4 => [
                            'Apa yang kamu pahami tentang intonasi, artikulasi, tempo, dan frasering?',
                            'Dari keempat teknik tersebut, teknik mana yang paling sulit kamu kuasai? Jelaskan alasannya.',
                            'Mengapa ketepatan intonasi penting ketika menyanyikan lagu daerah?',
                            'Bagaimana cara kamu berlatih agar pengucapan lirik lagu daerah menjadi lebih jelas?',
                            'Setelah melakukan latihan bernyanyi, apa kemampuan yang ingin kamu tingkatkan pada latihan berikutnya?',
                        ],

                        5 => [
                            'Apa yang kamu pahami tentang pengertian alat musik tradisional?',
                            'Sebutkan alat musik tradisional yang kamu ketahui dan jelaskan daerah asalnya.',
                            'Alat musik tradisional apa yang paling menarik perhatianmu? Mengapa?',
                            'Apa hal baru yang kamu ketahui tentang alat musik tradisional Indonesia hari ini?',
                            'Menurutmu, mengapa setiap daerah di Indonesia memiliki alat musik tradisional yang berbeda-beda?',
                        ],

                        6 => [
                            'Apa saja cara memainkan alat musik tradisional yang kamu pelajari hari ini?',
                            'Dari alat musik yang dipukul, dipetik, digesek, dan ditiup, mana yang paling menarik bagimu? Jelaskan alasannya.',
                            'Sebutkan satu alat musik tradisional yang cara memainkannya baru kamu ketahui.',
                            'Mengapa cara memainkan alat musik dapat memengaruhi karakter bunyi yang dihasilkan?',
                            'Jika kamu diberi kesempatan mempelajari satu alat musik tradisional, alat musik apa yang ingin kamu pelajari? Mengapa?',
                        ],

                        7 => [
                            'Apa yang kamu pahami tentang pengelompokan alat musik berdasarkan sumber bunyinya?',
                            'Apa perbedaan alat musik kordofon, aerofon, membranofon, dan idiofon yang kamu pahami?',
                            'Alat musik apa yang menurutmu paling mudah untuk dikelompokkan? Jelaskan alasannya.',
                            'Apa kesulitan yang kamu alami ketika mengelompokkan alat musik tradisional?',
                            'Menurutmu, mengapa penting bagi kita mengetahui jenis dan sumber bunyi alat musik tradisional?',
                        ],

                        8 => [
                            'Apa pengetahuan baru tentang alat musik tradisional yang paling berkesan bagimu selama pembelajaran?',
                            'Dari seluruh alat musik tradisional yang telah dipelajari, alat musik mana yang paling kamu sukai? Jelaskan alasannya.',
                            'Menurutmu, apa yang akan terjadi jika generasi muda tidak mau mempelajari alat musik tradisional?',
                            'Apa yang dapat kamu lakukan sebagai pelajar untuk membantu melestarikan alat musik tradisional Indonesia?',
                            'Setelah mengikuti pembelajaran selama 8 pertemuan, apa perubahan pemahaman atau sikap yang kamu rasakan terhadap musik tradisional Indonesia?',
                        ],

                        default => [],
                    };

                @endphp



                @foreach($questions as $index => $question)

                    @php
                        $field = 'jawaban_' . ($index + 1);
                    @endphp


                    <div
                        class="
                            px-5
                            lg:px-6
                            py-6
                            border-b
                            border-slate-100
                            last:border-b-0
                        "
                    >

                        <div
                            class="
                                text-[11px]
                                font-black
                                uppercase
                                tracking-wider
                                text-blue-600
                                mb-2
                            "
                        >
                            Pertanyaan {{ $index + 1 }}
                        </div>


                        <div
                            class="
                                text-sm
                                font-bold
                                leading-relaxed
                                text-slate-800
                                mb-4
                            "
                        >
                            {{ $question }}
                        </div>


                        <div
                            class="
                                answer-box
                                p-4
                                rounded-xl
                                bg-slate-50
                                border
                                border-slate-200
                                text-sm
                                leading-7
                                text-slate-700
                            "
                        >
                            {{ $reflection->{$field} ?: 'Tidak ada jawaban.' }}
                        </div>

                    </div>

                @endforeach

            </section>



            {{-- =================================================
                 ACTION
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    sm:flex-row
                    gap-3
                    mt-5
                "
            >

                <a
                    href="{{ route('guru.reflections.index', [
                        'kelas' => $reflection->student->kelas ?? '',
                        'pertemuan' => $reflection->pertemuan
                    ]) }}"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        gap-2
                        px-5
                        py-3
                        rounded-xl
                        bg-slate-900
                        hover:bg-slate-800
                        text-white
                        text-sm
                        font-bold
                        transition
                    "
                >

                    <i
                        data-lucide="arrow-left"
                        class="w-4 h-4"
                    ></i>

                    Kembali ke Rekap

                </a>

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