<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Rekap Refleksi — LARASKU</title>

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
                    Rekap Refleksi
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
                max-w-6xl
                mx-auto
                px-5
                lg:px-8
                py-8
            "
        >


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
                    Rekap Refleksi
                </h1>


                <p
                    class="
                        text-sm
                        text-slate-500
                        mt-2
                    "
                >
                    Lihat dan tinjau jawaban refleksi siswa
                    dari setiap pertemuan.
                </p>

            </section>



            {{-- =================================================
                 FILTER
            ================================================== --}}

            <section
                class="
                    bg-white
                    border
                    border-slate-200
                    rounded-2xl
                    shadow-sm
                    p-5
                    mb-5
                "
            >

                <form
                    action="{{ route('guru.reflections.index') }}"
                    method="GET"
                >

                    <div
                        class="
                            grid
                            grid-cols-1
                            md:grid-cols-[1fr_220px_auto]
                            gap-4
                            items-end
                        "
                    >


                        {{-- KELAS --}}

                        <div>

                            <label
                                for="kelas"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Kelas
                            </label>


                            <select
                                id="kelas"
                                name="kelas"
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                <option value="">
                                    Semua Kelas
                                </option>


                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        @selected($kelas == $class)
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>



                        {{-- PERTEMUAN --}}

                        <div>

                            <label
                                for="pertemuan"
                                class="
                                    block
                                    text-xs
                                    font-bold
                                    text-slate-600
                                    mb-2
                                "
                            >
                                Pertemuan
                            </label>


                            <select
                                id="pertemuan"
                                name="pertemuan"
                                class="
                                    w-full
                                    h-11
                                    px-3
                                    border
                                    border-slate-200
                                    rounded-xl
                                    bg-white
                                    text-sm
                                    text-slate-800
                                    outline-none
                                    focus:border-blue-400
                                    focus:ring-4
                                    focus:ring-blue-50
                                "
                            >

                                <option value="">
                                    Semua Pertemuan
                                </option>


                                @for($i = 1; $i <= 8; $i++)

                                    <option
                                        value="{{ $i }}"
                                        @selected((string) $pertemuan === (string) $i)
                                    >
                                        Pertemuan {{ $i }}
                                    </option>

                                @endfor

                            </select>

                        </div>



                        {{-- BUTTON --}}

                        <button
                            type="submit"
                            class="
                                h-11
                                px-5
                                rounded-xl
                                bg-slate-900
                                hover:bg-slate-800
                                text-white
                                text-sm
                                font-bold
                                transition
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                            "
                        >

                            <i
                                data-lucide="filter"
                                class="w-4 h-4"
                            ></i>

                            Terapkan Filter

                        </button>

                    </div>

                </form>

            </section>



            {{-- =================================================
                 SUMMARY
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    gap-2
                    mb-3
                    text-sm
                    text-slate-500
                "
            >

                <div>

                    Total refleksi:

                    <strong class="text-slate-900">
                        {{ $reflections->count() }}
                    </strong>

                </div>


                @if($kelas)

                    <div>

                        Kelas:

                        <strong class="text-slate-900">
                            {{ $kelas }}
                        </strong>

                    </div>

                @endif

            </div>



            {{-- =================================================
                 TABLE
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

                @if($reflections->count())


                    <div class="overflow-x-auto">

                        <table
                            class="
                                w-full
                                min-w-[850px]
                            "
                        >

                            <thead class="bg-slate-50">

                                <tr>

                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        No
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Siswa
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Absen
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Pertemuan
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Waktu
                                    </th>


                                    <th
                                        class="
                                            px-5
                                            py-4
                                            text-left
                                            text-[11px]
                                            font-black
                                            uppercase
                                            tracking-wider
                                            text-slate-500
                                        "
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($reflections as $index => $reflection)

                                    <tr
                                        class="
                                            border-t
                                            border-slate-100
                                            hover:bg-slate-50
                                            transition
                                        "
                                    >


                                        {{-- NO --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-sm
                                                font-bold
                                                text-slate-500
                                            "
                                        >
                                            {{ $index + 1 }}
                                        </td>



                                        {{-- SISWA --}}

                                        <td class="px-5 py-4">

                                            <div
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-900
                                                "
                                            >
                                                {{ $reflection->student->nama ?? 'Siswa tidak ditemukan' }}
                                            </div>


                                            <div
                                                class="
                                                    text-xs
                                                    text-slate-400
                                                    mt-1
                                                "
                                            >
                                                {{ $reflection->student->kelas ?? '-' }}
                                            </div>

                                        </td>



                                        {{-- ABSEN --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-sm
                                                font-bold
                                                text-slate-600
                                            "
                                        >

                                            {{ $reflection->student->nomor_absen ?? '-' }}

                                        </td>



                                        {{-- PERTEMUAN --}}

                                        <td class="px-5 py-4">

                                            <span
                                                class="
                                                    inline-flex
                                                    items-center
                                                    px-3
                                                    py-1.5
                                                    rounded-lg
                                                    bg-blue-50
                                                    text-blue-600
                                                    text-xs
                                                    font-bold
                                                "
                                            >

                                                Pertemuan
                                                {{ $reflection->pertemuan }}

                                            </span>

                                        </td>



                                        {{-- WAKTU --}}

                                        <td
                                            class="
                                                px-5
                                                py-4
                                                text-xs
                                                font-semibold
                                                text-slate-500
                                                whitespace-nowrap
                                            "
                                        >

                                            {{ $reflection->created_at->format('d/m/Y H:i') }}

                                        </td>



                                        {{-- AKSI --}}

                                        <td class="px-5 py-4">

                                            <a
                                                href="{{ route(
                                                    'guru.reflections.show',
                                                    $reflection
                                                ) }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    gap-2
                                                    px-3
                                                    py-2
                                                    rounded-xl
                                                    bg-slate-900
                                                    hover:bg-slate-800
                                                    text-white
                                                    text-xs
                                                    font-bold
                                                    transition
                                                "
                                            >

                                                <i
                                                    data-lucide="eye"
                                                    class="w-3.5 h-3.5"
                                                ></i>

                                                Lihat

                                            </a>

                                        </td>


                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                @else


                    {{-- =================================================
                         EMPTY
                    ================================================== --}}

                    <div
                        class="
                            px-5
                            py-16
                            text-center
                        "
                    >

                        <div
                            class="
                                w-14
                                h-14
                                rounded-2xl
                                bg-slate-100
                                flex
                                items-center
                                justify-center
                                mx-auto
                                mb-4
                            "
                        >

                            <i
                                data-lucide="message-square-off"
                                class="w-7 h-7 text-slate-400"
                            ></i>

                        </div>


                        <h3
                            class="
                                text-base
                                font-black
                                text-slate-700
                            "
                        >
                            Belum ada refleksi
                        </h3>


                        <p
                            class="
                                text-sm
                                text-slate-400
                                mt-2
                            "
                        >
                            Belum ada jawaban refleksi yang
                            sesuai dengan filter.
                        </p>

                    </div>

                @endif

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