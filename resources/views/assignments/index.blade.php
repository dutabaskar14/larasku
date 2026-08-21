<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tugas Praktik — LARASKU</title>

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
            margin-left: 240px;
            min-height: 100vh;
        }

        .page-container {
            width: 100%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .meeting-scroll {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .meeting-scroll::-webkit-scrollbar {
            height: 5px;
        }

        .meeting-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .meeting-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .student-scroll {
            max-height: 430px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .student-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .student-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .student-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .group-scroll {
            max-height: 430px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }

        .group-scroll::-webkit-scrollbar {
            width: 5px;
        }

        .group-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .group-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 999px;
        }

        .item-card {
            transition:
                transform .16s ease,
                box-shadow .16s ease,
                border-color .16s ease,
                background-color .16s ease;
        }

        .item-card:hover {
            transform: translateY(-1px);
            box-shadow:
                0 8px 25px rgba(15, 23, 42, .06);
        }

        .item-card:active {
            transform: translateY(0);
        }

        .detail-card {
            animation: detailIn .18s ease;
        }

        @keyframes detailIn {

            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        .link-input {
            transition:
                border-color .18s ease,
                box-shadow .18s ease;
        }

        .link-input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow:
                0 0 0 3px rgba(99, 102, 241, .10);
        }

        .class-select {
            appearance: none;
            background-image:
                url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position:
                right 14px center;
            background-size: 16px;
        }

        .score-box {
            min-width: 70px;
        }

        .student-search-wrap {
            position: relative;
        }

        .student-search-input {
            width: 100%;
            min-height: 46px;
            padding: 0 16px 0 44px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
            outline: none;
            transition:
                border-color .18s ease,
                box-shadow .18s ease,
                background-color .18s ease;
        }

        .student-search-input::placeholder {
            color: #94a3b8;
            font-weight: 600;
        }

        .student-search-input:focus {
            border-color: #818cf8;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, .08);
        }

        .student-search-hint {
            margin: 7px 2px 0;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        .student-search-results {
            min-height: 92px;
        }

        .student-search-placeholder {
            min-height: 150px;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: 1px dashed #e2e8f0;
            border-radius: 16px;
            background: #f8fafc;
        }

        .student-search-placeholder-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            color: #94a3b8;
        }

        .student-search-placeholder-title {
            color: #475569;
            font-size: 13px;
            font-weight: 800;
        }

        .student-search-placeholder-text {
            margin-top: 3px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.5;
        }

        .student-search-result {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 58px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #fff;
            text-decoration: none;
            transition:
                transform .16s ease,
                border-color .16s ease,
                box-shadow .16s ease,
                background-color .16s ease;
        }

        .student-search-result + .student-search-result {
            margin-top: 8px;
        }

        .student-search-result:hover {
            transform: translateY(-1px);
            border-color: #c7d2fe;
            box-shadow: 0 8px 22px rgba(15, 23, 42, .06);
        }

        .student-search-result:active {
            transform: translateY(0);
        }

        .student-search-result.is-selected {
            border-color: #a5b4fc;
            background: #eef2ff;
        }

        .student-result-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            border-radius: 11px;
            background: #f1f5f9;
            color: #64748b;
        }

        .student-result-icon-selected {
            background: #4f46e5;
            color: #fff;
        }

        .student-result-name {
            display: block;
            overflow: hidden;
            color: #334155;
            font-size: 13px;
            font-weight: 800;
            line-height: 1.35;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .student-result-meta {
            display: block;
            margin-top: 2px;
            color: #94a3b8;
            font-size: 10px;
            line-height: 1.4;
        }

        .student-search-data {
            display: none !important;
        }

        .student-search-no-result {
            min-height: 120px;
            padding: 20px 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            border: 1px dashed #fecdd3;
            border-radius: 16px;
            background: #fff7f7;
        }

        .student-search-no-result-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 9px;
            border-radius: 11px;
            background: #ffe4e6;
            color: #e11d48;
        }

        .student-search-no-result-title {
            color: #9f1239;
            font-size: 12px;
            font-weight: 800;
        }

        .student-search-no-result-text {
            margin-top: 3px;
            color: #be7b8b;
            font-size: 10px;
        }

        @media (max-width: 1023px) {

            .main-content {
                margin-left: 0;
            }

        }

        @media (max-width: 639px) {

            .page-container {
                padding-left: 12px !important;
                padding-right: 12px !important;
                padding-top: 16px !important;
                padding-bottom: 30px !important;
            }

            .mobile-tight {
                padding: 14px !important;
            }

            .meeting-button {
                min-width: 48px;
            }

        }

    </style>

</head>


<body>

    @include('guru.partials.sidebar')


    <main
        id="mainContent"
        class="main-content"
    >

        @include('guru.partials.header')


        <div
            class="
                page-container
                px-5
                lg:px-8
                py-7
            "
        >


            {{-- =========================================================
                 NOTIFIKASI SUKSES
            ========================================================== --}}

            @if(session('success'))

                <div
                    class="
                        mb-5
                        flex
                        items-start
                        gap-3
                        p-4
                        rounded-2xl
                        bg-emerald-50
                        border
                        border-emerald-100
                        text-emerald-700
                    "
                >

                    <div
                        class="
                            w-9
                            h-9
                            rounded-xl
                            bg-emerald-100
                            flex
                            items-center
                            justify-center
                            shrink-0
                        "
                    >

                        <i
                            data-lucide="circle-check"
                            class="w-4 h-4"
                        ></i>

                    </div>


                    <div class="pt-0.5">

                        <p
                            class="
                                text-sm
                                font-bold
                            "
                        >
                            Berhasil
                        </p>

                        <p
                            class="
                                text-xs
                                mt-0.5
                                leading-5
                            "
                        >
                            {{ session('success') }}
                        </p>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                 NOTIFIKASI ERROR
            ========================================================== --}}

            @if($errors->any())

                <div
                    class="
                        mb-5
                        flex
                        items-start
                        gap-3
                        p-4
                        rounded-2xl
                        bg-rose-50
                        border
                        border-rose-100
                        text-rose-700
                    "
                >

                    <div
                        class="
                            w-9
                            h-9
                            rounded-xl
                            bg-rose-100
                            flex
                            items-center
                            justify-center
                            shrink-0
                        "
                    >

                        <i
                            data-lucide="triangle-alert"
                            class="w-4 h-4"
                        ></i>

                    </div>


                    <div>

                        <p
                            class="
                                text-sm
                                font-bold
                            "
                        >
                            Pengumpulan belum dapat diproses.
                        </p>


                        <ul
                            class="
                                mt-1.5
                                space-y-1
                                text-xs
                                leading-5
                            "
                        >

                            @foreach($errors->all() as $error)

                                <li>
                                    • {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            @endif


            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <section class="mb-6">

                <div
                    class="
                        flex
                        flex-col
                        lg:flex-row
                        lg:items-end
                        lg:justify-between
                        gap-4
                    "
                >

                    <div>

                        <div
                            class="
                                inline-flex
                                items-center
                                gap-2
                                px-3
                                py-1.5
                                rounded-full
                                bg-indigo-50
                                text-indigo-600
                                text-[10px]
                                font-black
                                uppercase
                                tracking-wider
                                mb-3
                            "
                        >

                            <i
                                data-lucide="clipboard-check"
                                class="w-3.5 h-3.5"
                            ></i>

                            Tugas Praktik

                        </div>


                        <h1
                            class="
                                text-3xl
                                sm:text-4xl
                                font-black
                                tracking-tight
                                text-slate-900
                            "
                        >
                            Tugas Praktik
                        </h1>


                        <p
                            class="
                                mt-2
                                text-sm
                                text-slate-500
                            "
                        >
                            Pilih pertemuan dan kelas untuk melihat pengumpulan tugas.
                        </p>

                    </div>


                    {{-- =====================================================
                         FILTER KELAS
                    ====================================================== --}}

                    @if($classes->isNotEmpty())

                        <div
                            class="
                                w-full
                                sm:w-auto
                                lg:min-w-[210px]
                            "
                        >

                            <label
                                class="
                                    block
                                    text-[10px]
                                    font-black
                                    uppercase
                                    tracking-wider
                                    text-slate-400
                                    mb-2
                                "
                            >
                                Kelas
                            </label>


                            <form
                                method="GET"
                                action="{{ route('assignments.index') }}"
                                id="classFilterForm"
                            >

                                <input
                                    type="hidden"
                                    name="pertemuan"
                                    value="{{ $pertemuan ?? '' }}"
                                >


                                <select
                                    name="kelas"
                                    id="kelas"
                                    onchange="this.form.submit()"
                                    class="
                                        class-select
                                        w-full
                                        px-4
                                        py-3
                                        pr-10
                                        rounded-xl
                                        bg-white
                                        border
                                        border-slate-200
                                        text-sm
                                        font-bold
                                        text-slate-700
                                        shadow-sm
                                        cursor-pointer
                                    "
                                >

                                    <option value="">
                                        Pilih kelas
                                    </option>


                                    @foreach($classes as $class)

                                        <option
                                            value="{{ $class }}"
                                            @selected($kelas === $class)
                                        >
                                            {{ $class }}
                                        </option>

                                    @endforeach

                                </select>

                            </form>

                        </div>

                    @endif

                </div>

            </section>


            {{-- =========================================================
                 PERTEMUAN P1 P2 P3
            ========================================================== --}}

            @if($kelas !== '' && $meetings->isNotEmpty())

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-4
                        mb-6
                    "
                >

                    <div
                        class="
                            flex
                            items-center
                            justify-between
                            gap-3
                            mb-3
                        "
                    >

                        <div
                            class="
                                flex
                                items-center
                                gap-2
                            "
                        >

                            <div
                                class="
                                    w-8
                                    h-8
                                    rounded-lg
                                    bg-indigo-50
                                    text-indigo-600
                                    flex
                                    items-center
                                    justify-center
                                "
                            >

                                <i
                                    data-lucide="layers"
                                    class="w-4 h-4"
                                ></i>

                            </div>


                            <div>

                                <p
                                    class="
                                        text-xs
                                        font-black
                                        text-slate-700
                                    "
                                >
                                    Pertemuan
                                </p>

                                <p
                                    class="
                                        text-[10px]
                                        text-slate-400
                                    "
                                >
                                    {{ $kelas }}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div
                        class="
                            meeting-scroll
                            flex
                            gap-2
                            overflow-x-auto
                            pb-1
                        "
                    >

                        @foreach($meetings as $meeting)

                            <a
                                href="{{ route('assignments.index', [
                                    'kelas' => $kelas,
                                    'pertemuan' => $meeting->pertemuan,
                                ]) }}"
                                class="
                                    meeting-button
                                    shrink-0
                                    inline-flex
                                    items-center
                                    justify-center
                                    px-4
                                    py-2.5
                                    rounded-xl
                                    text-xs
                                    font-black
                                    transition
                                    {{ (int) $pertemuan === (int) $meeting->pertemuan
                                        ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100'
                                        : 'bg-slate-50 text-slate-600 border border-slate-100 hover:bg-slate-100'
                                    }}
                                "
                            >

                                P{{ $meeting->pertemuan }}

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif


            {{-- =========================================================
                 BELUM PILIH KELAS
            ========================================================== --}}

            @if($kelas === '')

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-10
                        sm:p-14
                        text-center
                    "
                >

                    <div
                        class="
                            w-16
                            h-16
                            rounded-2xl
                            bg-indigo-50
                            text-indigo-500
                            flex
                            items-center
                            justify-center
                            mx-auto
                            mb-5
                        "
                    >

                        <i
                            data-lucide="school"
                            class="w-8 h-8"
                        ></i>

                    </div>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-800
                        "
                    >
                        Pilih kelas terlebih dahulu
                    </h2>


                    <p
                        class="
                            max-w-md
                            mx-auto
                            mt-2
                            text-sm
                            leading-6
                            text-slate-400
                        "
                    >
                        Pilih nama kelas di bagian atas untuk melihat
                        pertemuan dan tugas praktik kelas tersebut.
                    </p>

                </section>


            @elseif($meetings->isEmpty())

                {{-- =====================================================
                     BELUM ADA PERTEMUAN
                ====================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-10
                        sm:p-14
                        text-center
                    "
                >

                    <div
                        class="
                            w-16
                            h-16
                            rounded-2xl
                            bg-slate-100
                            text-slate-400
                            flex
                            items-center
                            justify-center
                            mx-auto
                            mb-5
                        "
                    >

                        <i
                            data-lucide="calendar-x-2"
                            class="w-8 h-8"
                        ></i>

                    </div>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-700
                        "
                    >
                        Belum ada pertemuan
                    </h2>


                    <p
                        class="
                            max-w-md
                            mx-auto
                            mt-2
                            text-sm
                            leading-6
                            text-slate-400
                        "
                    >
                        Belum ada pertemuan tugas praktik aktif
                        untuk kelas {{ $kelas }}.
                    </p>

                </section>


            @elseif($assignments->isEmpty())

                {{-- =====================================================
                     BELUM ADA TUGAS
                ====================================================== --}}

                <section
                    class="
                        bg-white
                        border
                        border-slate-200
                        rounded-2xl
                        shadow-sm
                        p-10
                        sm:p-14
                        text-center
                    "
                >

                    <div
                        class="
                            w-16
                            h-16
                            rounded-2xl
                            bg-slate-100
                            text-slate-400
                            flex
                            items-center
                            justify-center
                            mx-auto
                            mb-5
                        "
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="w-8 h-8"
                        ></i>

                    </div>


                    <h2
                        class="
                            text-lg
                            font-black
                            text-slate-700
                        "
                    >
                        Belum ada tugas
                    </h2>


                    <p
                        class="
                            max-w-md
                            mx-auto
                            mt-2
                            text-sm
                            leading-6
                            text-slate-400
                        "
                    >
                        Belum ada tugas praktik pada Pertemuan
                        {{ $pertemuan }} untuk kelas {{ $kelas }}.
                    </p>

                </section>


            @else

                {{-- =====================================================
                     DAFTAR TUGAS
                ====================================================== --}}

                <div class="space-y-6">

                    @foreach($assignments as $assignment)

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

                            {{-- =================================================
                                 HEADER TUGAS
                            ================================================== --}}

                            <div
                                class="
                                    px-5
                                    py-5
                                    border-b
                                    border-slate-100
                                "
                            >

                                <div
                                    class="
                                        flex
                                        flex-col
                                        sm:flex-row
                                        sm:items-start
                                        sm:justify-between
                                        gap-4
                                    "
                                >

                                    <div>

                                        <div
                                            class="
                                                flex
                                                flex-wrap
                                                items-center
                                                gap-2
                                                mb-2
                                            "
                                        >

                                            @if(
                                                $assignment->mode_pengumpulan === 'kelompok'
                                            )

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-2.5
                                                        py-1
                                                        rounded-lg
                                                        bg-violet-50
                                                        text-violet-700
                                                        text-[10px]
                                                        font-black
                                                        uppercase
                                                    "
                                                >

                                                    <i
                                                        data-lucide="users"
                                                        class="w-3 h-3"
                                                    ></i>

                                                    Kelompok

                                                </span>

                                            @else

                                                <span
                                                    class="
                                                        inline-flex
                                                        items-center
                                                        gap-1.5
                                                        px-2.5
                                                        py-1
                                                        rounded-lg
                                                        bg-blue-50
                                                        text-blue-700
                                                        text-[10px]
                                                        font-black
                                                        uppercase
                                                    "
                                                >

                                                    <i
                                                        data-lucide="user"
                                                        class="w-3 h-3"
                                                    ></i>

                                                    Individu

                                                </span>

                                            @endif


                                            <span
                                                class="
                                                    px-2.5
                                                    py-1
                                                    rounded-lg
                                                    bg-slate-100
                                                    text-slate-500
                                                    text-[10px]
                                                    font-bold
                                                "
                                            >
                                                P{{ $assignment->pertemuan }}
                                            </span>

                                        </div>


                                        <h2
                                            class="
                                                text-lg
                                                sm:text-xl
                                                font-black
                                                text-slate-900
                                            "
                                        >
                                            {{ $assignment->judul }}
                                        </h2>


                                        @if($assignment->instruksi)

                                            <div
                                                class="
                                                    mt-3
                                                    text-sm
                                                    leading-6
                                                    text-slate-500
                                                "
                                            >
                                                {!! nl2br(e($assignment->instruksi)) !!}
                                            </div>

                                        @endif

                                    </div>


                                   @if($assignment->batas_waktu)

    <div
        class="
            shrink-0
            inline-flex
            items-center
            gap-2
            px-3
            py-2
            rounded-xl
            bg-slate-50
            text-slate-500
            text-[10px]
            font-bold
        "
    >

        <i
            data-lucide="clock"
            class="w-3.5 h-3.5 shrink-0"
        ></i>

        <span class="whitespace-nowrap">
            Batas Akhir Pengumpulan
        </span>

        <span
            class="
                h-4
                w-px
                bg-slate-200
                shrink-0
            "
        ></span>

        <span class="whitespace-nowrap">
            {{ $assignment->batas_waktu->format('d M Y, H:i') }}
        </span>

    </div>

@endif
                                </div>

                            </div>


                            {{-- =================================================
                                 INDIVIDU
                            ================================================== --}}

                            @if(
                                $assignment->mode_pengumpulan === 'individu'
                            )

                                <div class="p-5">

                                    <div
                                        class="
                                            flex
                                            flex-col
                                            sm:flex-row
                                            sm:items-center
                                            sm:justify-between
                                            gap-3
                                            mb-4
                                        "
                                    >

                                        <div>

                                            <p
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                Pengumpulan Individu
                                            </p>

                                            <p
                                                class="
                                                    text-[10px]
                                                    text-slate-400
                                                    mt-0.5
                                                "
                                            >
                                                Cari nama siswa untuk melihat status dan detail pengumpulan.
                                            </p>

                                        </div>


                                        <span
                                            class="
                                                self-start
                                                sm:self-auto
                                                shrink-0
                                                px-2.5
                                                py-1.5
                                                rounded-lg
                                                bg-slate-100
                                                text-slate-500
                                                text-[10px]
                                                font-bold
                                            "
                                        >
                                            {{ $assignment->student_items->count() }} siswa
                                        </span>

                                    </div>


                                    {{-- =================================================
                                         PENCARIAN SISWA
                                    ================================================== --}}

                                    <div class="student-search-wrap mb-4">

                                        <div class="relative">

                                            <i
                                                data-lucide="search"
                                                class="
                                                    absolute
                                                    left-4
                                                    top-1/2
                                                    -translate-y-1/2
                                                    w-4
                                                    h-4
                                                    text-slate-400
                                                    pointer-events-none
                                                "
                                            ></i>

                                            <input
                                                type="search"
                                                class="student-search-input"
                                                id="studentSearch-{{ $assignment->id }}"
                                                data-assignment-id="{{ $assignment->id }}"
                                                placeholder="Cari nama siswa..."
                                                autocomplete="off"
                                                spellcheck="false"
                                            >

                                        </div>

                                        <p class="student-search-hint">
                                            Ketik nama siswa untuk menampilkan hasil pencarian.
                                        </p>

                                    </div>


                                    {{-- =================================================
                                         HASIL PENCARIAN
                                    ================================================== --}}

                                    <div
                                        id="studentResults-{{ $assignment->id }}"
                                        class="student-search-results"
                                    >

                                        <div class="student-search-placeholder">

                                            <div class="student-search-placeholder-icon">
                                                <i
                                                    data-lucide="search"
                                                    class="w-5 h-5"
                                                ></i>
                                            </div>

                                            <p class="student-search-placeholder-title">
                                                Cari nama siswa
                                            </p>

                                            <p class="student-search-placeholder-text">
                                                Daftar siswa akan muncul setelah Anda mengetik nama.
                                            </p>

                                        </div>

                                    </div>


                                    {{-- =================================================
                                         DATA SISWA UNTUK PENCARIAN
                                    ================================================== --}}

                                    <div
                                        id="studentData-{{ $assignment->id }}"
                                        class="student-search-data"
                                        aria-hidden="true"
                                    >

                                        @foreach(
                                            $assignment->student_items
                                            as $item
                                        )

                                            @php
                                                $isSelected =
                                                    $selectedStudentId &&
                                                    (int) $selectedStudentId ===
                                                    (int) $item->student->id &&
                                                    !$selectedGroupId;
                                            @endphp

                                            <a
                                                href="{{ route('assignments.index', [
                                                    'kelas' => $kelas,
                                                    'pertemuan' => $pertemuan,
                                                    'student_id' => $item->student->id,
                                                ]) }}#detail"
                                                class="student-search-result {{ $isSelected ? 'is-selected' : '' }}"
                                                data-student-name="{{ strtolower($item->student->nama) }}"
                                                data-student-absen="{{ strtolower((string) ($item->student->nomor_absen ?? '')) }}"
                                            >

                                                <span
                                                    class="
                                                        student-result-icon
                                                        {{ $isSelected
                                                            ? 'student-result-icon-selected'
                                                            : ''
                                                        }}
                                                    "
                                                >
                                                    <i
                                                        data-lucide="user"
                                                        class="w-4 h-4"
                                                    ></i>
                                                </span>

                                                <span class="min-w-0 flex-1">

                                                    <span class="student-result-name">
                                                        {{ $item->student->nama }}
                                                    </span>

                                                    <span class="student-result-meta">
                                                        @if($item->student->nomor_absen)
                                                            No. {{ $item->student->nomor_absen }}
                                                        @else
                                                            {{ $item->student->kelas }}
                                                        @endif
                                                    </span>

                                                </span>

                                                <i
                                                    data-lucide="chevron-right"
                                                    class="
                                                        w-4
                                                        h-4
                                                        text-slate-300
                                                        shrink-0
                                                    "
                                                ></i>

                                            </a>

                                        @endforeach

                                    </div>


                                    {{-- =================================================
                                         DETAIL SISWA TERPILIH
                                    ================================================== --}}

                                    @if(
                                        $selectedStudent &&
                                        !$selectedGroupId
                                    )

                                        @php

                                            $selectedItem = null;

                                            foreach (
                                                $assignment->student_items
                                                as $studentItem
                                            ) {

                                                if (
                                                    (int) $studentItem->student->id ===
                                                    (int) $selectedStudent->id
                                                ) {

                                                    $selectedItem =
                                                        $studentItem;

                                                    break;
                                                }
                                            }

                                        @endphp


                                        @if($selectedItem)

                                            <div
                                                id="detail"
                                                class="
                                                    detail-card
                                                    mt-5
                                                    border
                                                    border-indigo-100
                                                    rounded-2xl
                                                    overflow-hidden
                                                    bg-indigo-50/30
                                                "
                                            >

                                                {{-- DETAIL HEADER --}}

                                                <div
                                                    class="
                                                        px-5
                                                        py-4
                                                        bg-white
                                                        border-b
                                                        border-indigo-100
                                                    "
                                                >

                                                    <div
                                                        class="
                                                            flex
                                                            items-center
                                                            justify-between
                                                            gap-3
                                                        "
                                                    >

                                                        <div
                                                            class="
                                                                flex
                                                                items-center
                                                                gap-3
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    w-10
                                                                    h-10
                                                                    rounded-xl
                                                                    bg-indigo-100
                                                                    text-indigo-600
                                                                    flex
                                                                    items-center
                                                                    justify-center
                                                                "
                                                            >

                                                                <i
                                                                    data-lucide="user-round"
                                                                    class="w-5 h-5"
                                                                ></i>

                                                            </div>


                                                            <div>

                                                                <p
                                                                    class="
                                                                        text-sm
                                                                        font-black
                                                                        text-slate-800
                                                                    "
                                                                >
                                                                    {{ $selectedItem->student->nama }}
                                                                </p>

                                                                <p
                                                                    class="
                                                                        text-[10px]
                                                                        text-slate-400
                                                                        mt-0.5
                                                                    "
                                                                >

                                                                    Kelas
                                                                    {{ $selectedItem->student->kelas }}

                                                                    @if($selectedItem->student->nomor_absen)
                                                                        • No. {{ $selectedItem->student->nomor_absen }}
                                                                    @endif

                                                                </p>

                                                            </div>

                                                        </div>


                                                        <a
                                                            href="{{ route('assignments.index', [
                                                                'kelas' => $kelas,
                                                                'pertemuan' => $pertemuan,
                                                            ]) }}"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                gap-1.5
                                                                px-3
                                                                py-2
                                                                rounded-lg
                                                                bg-slate-100
                                                                text-slate-500
                                                                text-[10px]
                                                                font-bold
                                                                hover:bg-slate-200
                                                            "
                                                        >

                                                            <i
                                                                data-lucide="x"
                                                                class="w-3.5 h-3.5"
                                                            ></i>

                                                            Tutup

                                                        </a>

                                                    </div>

                                                </div>


                                                {{-- DETAIL STATUS --}}

                                                <div class="p-5">

                                                    @if(
                                                        $selectedItem->status === 'selesai'
                                                    )

                                                        <div
                                                            class="
                                                                p-4
                                                                rounded-xl
                                                                bg-emerald-50
                                                                border
                                                                border-emerald-100
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    flex
                                                                    items-start
                                                                    gap-3
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        w-9
                                                                        h-9
                                                                        rounded-xl
                                                                        bg-emerald-100
                                                                        text-emerald-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                        shrink-0
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="badge-check"
                                                                        class="w-4 h-4"
                                                                    ></i>

                                                                </div>


                                                                <div>

                                                                    <p
                                                                        class="
                                                                            text-sm
                                                                            font-black
                                                                            text-emerald-700
                                                                        "
                                                                    >
                                                                        Sudah dinilai
                                                                    </p>

                                                                    <p
                                                                        class="
                                                                            text-xs
                                                                            text-emerald-600
                                                                            mt-0.5
                                                                        "
                                                                    >
                                                                        Tugas sudah diperiksa oleh guru.
                                                                    </p>

                                                                </div>


                                                                @if(
                                                                    $selectedItem->nilai !== null
                                                                )

                                                                    <div
                                                                        class="
                                                                            score-box
                                                                            ml-auto
                                                                            text-center
                                                                        "
                                                                    >

                                                                        <div
                                                                            class="
                                                                                inline-flex
                                                                                items-center
                                                                                justify-center
                                                                                min-w-[70px]
                                                                                px-3
                                                                                py-2
                                                                                rounded-xl
                                                                                bg-emerald-600
                                                                                text-white
                                                                                text-lg
                                                                                font-black
                                                                            "
                                                                        >

                                                                            {{ number_format(
                                                                                (float) $selectedItem->nilai,
                                                                                0
                                                                            ) }}

                                                                        </div>

                                                                        <p
                                                                            class="
                                                                                text-[9px]
                                                                                uppercase
                                                                                tracking-wider
                                                                                font-bold
                                                                                text-emerald-600
                                                                                mt-1
                                                                            "
                                                                        >
                                                                            Nilai
                                                                        </p>

                                                                    </div>

                                                                @endif

                                                            </div>


                                                            @if(
                                                                $selectedItem->submission &&
                                                                $selectedItem->submission->link
                                                            )

                                                                <div
                                                                    class="
                                                                        mt-4
                                                                        pt-4
                                                                        border-t
                                                                        border-emerald-100
                                                                    "
                                                                >

                                                                    <p
                                                                        class="
                                                                            text-[10px]
                                                                            uppercase
                                                                            tracking-wider
                                                                            font-black
                                                                            text-emerald-600
                                                                        "
                                                                    >
                                                                        Link Pengumpulan
                                                                    </p>


                                                                    <a
                                                                        href="{{ $selectedItem->submission->link }}"
                                                                        target="_blank"
                                                                        rel="noopener noreferrer"
                                                                        class="
                                                                            block
                                                                            mt-1
                                                                            text-sm
                                                                            font-semibold
                                                                            text-indigo-600
                                                                            hover:underline
                                                                            break-all
                                                                        "
                                                                    >
                                                                        {{ $selectedItem->submission->link }}
                                                                    </a>

                                                                </div>

                                                            @endif


                                                            @if(
                                                                $selectedItem->catatan_guru
                                                            )

                                                                <div
                                                                    class="
                                                                        mt-4
                                                                        pt-4
                                                                        border-t
                                                                        border-emerald-100
                                                                    "
                                                                >

                                                                    <p
                                                                        class="
                                                                            text-[10px]
                                                                            uppercase
                                                                            tracking-wider
                                                                            font-black
                                                                            text-emerald-600
                                                                        "
                                                                    >
                                                                        Catatan Guru
                                                                    </p>

                                                                    <p
                                                                        class="
                                                                            mt-1
                                                                            text-xs
                                                                            leading-5
                                                                            text-slate-600
                                                                        "
                                                                    >
                                                                        {!! nl2br(e($selectedItem->catatan_guru)) !!}
                                                                    </p>

                                                                </div>

                                                            @endif


                                                            <div
                                                                class="
                                                                    mt-4
                                                                    flex
                                                                    items-center
                                                                    gap-2
                                                                    text-[10px]
                                                                    font-semibold
                                                                    text-emerald-600
                                                                "
                                                            >

                                                                <i
                                                                    data-lucide="lock"
                                                                    class="w-3.5 h-3.5"
                                                                ></i>

                                                                Link sudah dikunci setelah dinilai.

                                                            </div>

                                                        </div>


                                                    @elseif(
                                                        $selectedItem->status === 'belum_dinilai'
                                                    )

                                                        <div
                                                            class="
                                                                p-4
                                                                rounded-xl
                                                                bg-amber-50
                                                                border
                                                                border-amber-100
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    flex
                                                                    items-start
                                                                    gap-3
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        w-9
                                                                        h-9
                                                                        rounded-xl
                                                                        bg-amber-100
                                                                        text-amber-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                        shrink-0
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="clock-3"
                                                                        class="w-4 h-4"
                                                                    ></i>

                                                                </div>


                                                                <div>

                                                                    <p
                                                                        class="
                                                                            text-sm
                                                                            font-black
                                                                            text-amber-700
                                                                        "
                                                                    >
                                                                        Menunggu penilaian
                                                                    </p>

                                                                    <p
                                                                        class="
                                                                            text-xs
                                                                            text-amber-600
                                                                            mt-0.5
                                                                        "
                                                                    >
                                                                        Tugas sudah dikumpulkan dan sedang menunggu penilaian guru.
                                                                    </p>

                                                                </div>

                                                            </div>


                                                            @if(
                                                                $selectedItem->submission &&
                                                                $selectedItem->submission->link
                                                            )

                                                                <div
                                                                    class="
                                                                        mt-4
                                                                        pt-4
                                                                        border-t
                                                                        border-amber-100
                                                                    "
                                                                >

                                                                    <p
                                                                        class="
                                                                            text-[10px]
                                                                            uppercase
                                                                            tracking-wider
                                                                            font-black
                                                                            text-amber-600
                                                                        "
                                                                    >
                                                                        Link Pengumpulan
                                                                    </p>


                                                                    <a
                                                                        href="{{ $selectedItem->submission->link }}"
                                                                        target="_blank"
                                                                        rel="noopener noreferrer"
                                                                        class="
                                                                            block
                                                                            mt-1
                                                                            text-sm
                                                                            font-semibold
                                                                            text-indigo-600
                                                                            hover:underline
                                                                            break-all
                                                                        "
                                                                    >
                                                                        {{ $selectedItem->submission->link }}
                                                                    </a>

                                                                </div>

                                                            @endif


                                                            @if(
                                                                $selectedItem->submission &&
                                                                $selectedItem->submission->submitted_at
                                                            )

                                                                <p
                                                                    class="
                                                                        mt-3
                                                                        text-[10px]
                                                                        text-slate-400
                                                                    "
                                                                >

                                                                    Dikirim:

                                                                    {{
                                                                        $selectedItem->submission->submitted_at
                                                                            ->format('d M Y, H:i')
                                                                    }}

                                                                </p>

                                                            @endif

                                                        </div>


                                                    @else

                                                        <div
                                                            class="
                                                                p-4
                                                                rounded-xl
                                                                bg-rose-50
                                                                border
                                                                border-rose-100
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    flex
                                                                    items-start
                                                                    gap-3
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        w-9
                                                                        h-9
                                                                        rounded-xl
                                                                        bg-rose-100
                                                                        text-rose-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                        shrink-0
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="circle-alert"
                                                                        class="w-4 h-4"
                                                                    ></i>

                                                                </div>


                                                                <div>

                                                                    <p
                                                                        class="
                                                                            text-sm
                                                                            font-black
                                                                            text-rose-700
                                                                        "
                                                                    >
                                                                        Belum mengumpulkan
                                                                    </p>

                                                                    <p
                                                                        class="
                                                                            text-xs
                                                                            text-rose-600
                                                                            mt-0.5
                                                                        "
                                                                    >
                                                                        Siswa belum mengirimkan link tugas.
                                                                    </p>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    @endif


                                                    {{-- =================================================
                                                         FORM INDIVIDU
                                                    ================================================== --}}

                                                    @if(
                                                        $selectedItem->status !== 'selesai'
                                                    )

                                                        <div
                                                            class="
                                                                mt-5
                                                                p-4
                                                                rounded-xl
                                                                bg-white
                                                                border
                                                                border-slate-200
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    flex
                                                                    items-center
                                                                    gap-2
                                                                    mb-4
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        w-8
                                                                        h-8
                                                                        rounded-lg
                                                                        bg-indigo-50
                                                                        text-indigo-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="link-2"
                                                                        class="w-4 h-4"
                                                                    ></i>

                                                                </div>


                                                                <div>

                                                                    <p
                                                                        class="
                                                                            text-xs
                                                                            font-black
                                                                            text-slate-700
                                                                        "
                                                                    >
                                                                        {{
                                                                            $selectedItem->submission
                                                                                ? 'Edit Link Pengumpulan'
                                                                                : 'Kumpulkan Tugas'
                                                                        }}
                                                                    </p>

                                                                    <p
                                                                        class="
                                                                            text-[10px]
                                                                            text-slate-400
                                                                        "
                                                                    >
                                                                        Link dapat diedit sampai tugas dinilai.
                                                                    </p>

                                                                </div>

                                                            </div>


                                                            <form
                                                                method="POST"
                                                                action="{{ route(
                                                                    'assignments.submit',
                                                                    $assignment
                                                                ) }}"
                                                            >

                                                                @csrf


                                                                <input
                                                                    type="hidden"
                                                                    name="student_id"
                                                                    value="{{ $selectedItem->student->id }}"
                                                                >


                                                                <div>

                                                                    <label
                                                                        class="
                                                                            block
                                                                            text-[10px]
                                                                            font-black
                                                                            uppercase
                                                                            tracking-wider
                                                                            text-slate-400
                                                                            mb-2
                                                                        "
                                                                    >
                                                                        Link Tugas
                                                                    </label>


                                                                    <input
                                                                        type="url"
                                                                        name="link"
                                                                        required
                                                                        value="{{ old(
                                                                            'link',
                                                                            $selectedItem->submission->link ?? ''
                                                                        ) }}"
                                                                        placeholder="https://drive.google.com/..."
                                                                        class="
                                                                            link-input
                                                                            w-full
                                                                            px-4
                                                                            py-3
                                                                            rounded-xl
                                                                            border
                                                                            border-slate-200
                                                                            text-sm
                                                                            text-slate-700
                                                                        "
                                                                    >

                                                                </div>


                                                                <div class="mt-3">

                                                                    <label
                                                                        class="
                                                                            block
                                                                            text-[10px]
                                                                            font-black
                                                                            uppercase
                                                                            tracking-wider
                                                                            text-slate-400
                                                                            mb-2
                                                                        "
                                                                    >
                                                                        Catatan Siswa
                                                                    </label>


                                                                    <textarea
                                                                        name="catatan_siswa"
                                                                        rows="3"
                                                                        placeholder="Catatan tambahan..."
                                                                        class="
                                                                            link-input
                                                                            w-full
                                                                            px-4
                                                                            py-3
                                                                            rounded-xl
                                                                            border
                                                                            border-slate-200
                                                                            text-sm
                                                                            text-slate-700
                                                                            resize-y
                                                                        "
                                                                    >{{ old(
                                                                        'catatan_siswa',
                                                                        $selectedItem->submission->catatan_siswa ?? ''
                                                                    ) }}</textarea>

                                                                </div>


                                                                <div
                                                                    class="
                                                                        mt-4
                                                                        flex
                                                                        justify-end
                                                                    "
                                                                >

                                                                    <button
                                                                        type="submit"
                                                                        class="
                                                                            inline-flex
                                                                            items-center
                                                                            justify-center
                                                                            gap-2
                                                                            px-5
                                                                            py-3
                                                                            rounded-xl
                                                                            bg-indigo-600
                                                                            hover:bg-indigo-700
                                                                            text-white
                                                                            text-xs
                                                                            font-black
                                                                            transition
                                                                        "
                                                                    >

                                                                        @if(
                                                                            $selectedItem->submission
                                                                        )

                                                                            <i
                                                                                data-lucide="pencil"
                                                                                class="w-4 h-4"
                                                                            ></i>

                                                                            Edit Link

                                                                        @else

                                                                            <i
                                                                                data-lucide="send"
                                                                                class="w-4 h-4"
                                                                            ></i>

                                                                            Kumpulkan

                                                                        @endif

                                                                    </button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    @endif

                                                </div>

                                            </div>

                                        @endif

                                    @endif

                                </div>


                            {{-- =================================================
                                 KELOMPOK
                            ================================================== --}}

                            @else

                                <div class="p-5">

                                    <div
                                        class="
                                            flex
                                            items-center
                                            justify-between
                                            gap-3
                                            mb-4
                                        "
                                    >

                                        <div>

                                            <p
                                                class="
                                                    text-sm
                                                    font-black
                                                    text-slate-800
                                                "
                                            >
                                                Pengumpulan Kelompok
                                            </p>

                                            <p
                                                class="
                                                    text-[10px]
                                                    text-slate-400
                                                    mt-0.5
                                                "
                                            >
                                                Klik kelompok untuk melihat anggota dan detail pengumpulan.
                                            </p>

                                        </div>


                                        <span
                                            class="
                                                shrink-0
                                                px-2.5
                                                py-1.5
                                                rounded-lg
                                                bg-violet-50
                                                text-violet-600
                                                text-[10px]
                                                font-bold
                                            "
                                        >
                                            {{ $assignment->group_items->count() }}
                                            kelompok
                                        </span>

                                    </div>


                                    @if($assignment->group_items->isNotEmpty())

                                        <div
                                            class="
                                                group-scroll
                                                grid
                                                grid-cols-1
                                                sm:grid-cols-2
                                                lg:grid-cols-3
                                                gap-2
                                            "
                                        >

                                            @foreach(
                                                $assignment->group_items
                                                as $groupItem
                                            )

                                                @php

                                                    $isSelectedGroup =
                                                        $selectedGroupId &&
                                                        (int) $selectedGroupId ===
                                                        (int) $groupItem->group->id;

                                                @endphp


                                                <a
                                                    href="{{ route('assignments.index', [
                                                        'kelas' => $kelas,
                                                        'pertemuan' => $pertemuan,
                                                        'group_id' => $groupItem->group->id,
                                                    ]) }}#group-detail"
                                                    class="
                                                        item-card
                                                        block
                                                        rounded-xl
                                                        border
                                                        p-3.5
                                                        {{ $isSelectedGroup
                                                            ? 'border-violet-300 bg-violet-50/70'
                                                            : 'border-slate-200 bg-white hover:border-violet-200'
                                                        }}
                                                    "
                                                >

                                                    <div
                                                        class="
                                                            flex
                                                            items-center
                                                            gap-3
                                                        "
                                                    >

                                                        <div
                                                            class="
                                                                w-9
                                                                h-9
                                                                rounded-xl
                                                                flex
                                                                items-center
                                                                justify-center
                                                                shrink-0
                                                                {{ $isSelectedGroup
                                                                    ? 'bg-violet-600 text-white'
                                                                    : 'bg-violet-50 text-violet-600'
                                                                }}
                                                            "
                                                        >

                                                            <i
                                                                data-lucide="users"
                                                                class="w-4 h-4"
                                                            ></i>

                                                        </div>


                                                        <div class="min-w-0 flex-1">

                                                            <p
                                                                class="
                                                                    text-sm
                                                                    font-black
                                                                    text-slate-700
                                                                "
                                                            >
                                                                Kelompok
                                                                {{ $groupItem->group->nomor_kelompok }}
                                                            </p>


                                                            <p
                                                                class="
                                                                    text-[10px]
                                                                    text-slate-400
                                                                    mt-0.5
                                                                "
                                                            >
                                                                {{ $groupItem->members->count() }}
                                                                anggota
                                                            </p>

                                                        </div>


                                                        <div class="shrink-0">

                                                            @if(
                                                                $groupItem->status === 'selesai'
                                                            )

                                                                <span
                                                                    class="
                                                                        w-7
                                                                        h-7
                                                                        rounded-lg
                                                                        bg-emerald-50
                                                                        text-emerald-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="check"
                                                                        class="w-3.5 h-3.5"
                                                                    ></i>

                                                                </span>

                                                            @elseif(
                                                                $groupItem->status === 'belum_dinilai'
                                                            )

                                                                <span
                                                                    class="
                                                                        w-7
                                                                        h-7
                                                                        rounded-lg
                                                                        bg-amber-50
                                                                        text-amber-600
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="clock-3"
                                                                        class="w-3.5 h-3.5"
                                                                    ></i>

                                                                </span>

                                                            @else

                                                                <span
                                                                    class="
                                                                        w-7
                                                                        h-7
                                                                        rounded-lg
                                                                        bg-slate-100
                                                                        text-slate-400
                                                                        flex
                                                                        items-center
                                                                        justify-center
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="minus"
                                                                        class="w-3.5 h-3.5"
                                                                    ></i>

                                                                </span>

                                                            @endif

                                                        </div>


                                                        <i
                                                            data-lucide="chevron-right"
                                                            class="
                                                                w-4
                                                                h-4
                                                                text-slate-300
                                                                shrink-0
                                                            "
                                                        ></i>

                                                    </div>

                                                </a>

                                            @endforeach

                                        </div>


                                        {{-- =================================================
                                             DETAIL KELOMPOK
                                        ================================================== --}}

                                        @if($selectedGroup)

                                            <div
                                                id="group-detail"
                                                class="
                                                    detail-card
                                                    mt-5
                                                    border
                                                    border-violet-100
                                                    rounded-2xl
                                                    overflow-hidden
                                                    bg-violet-50/30
                                                "
                                            >

                                                {{-- DETAIL HEADER --}}

                                                <div
                                                    class="
                                                        px-5
                                                        py-4
                                                        bg-white
                                                        border-b
                                                        border-violet-100
                                                    "
                                                >

                                                    <div
                                                        class="
                                                            flex
                                                            items-center
                                                            justify-between
                                                            gap-3
                                                        "
                                                    >

                                                        <div
                                                            class="
                                                                flex
                                                                items-center
                                                                gap-3
                                                            "
                                                        >

                                                            <div
                                                                class="
                                                                    w-10
                                                                    h-10
                                                                    rounded-xl
                                                                    bg-violet-100
                                                                    text-violet-600
                                                                    flex
                                                                    items-center
                                                                    justify-center
                                                                "
                                                            >

                                                                <i
                                                                    data-lucide="users"
                                                                    class="w-5 h-5"
                                                                ></i>

                                                            </div>


                                                            <div>

                                                                <p
                                                                    class="
                                                                        text-sm
                                                                        font-black
                                                                        text-slate-800
                                                                    "
                                                                >
                                                                    Kelompok
                                                                    {{ $selectedGroup->group->nomor_kelompok }}
                                                                </p>

                                                                <p
                                                                    class="
                                                                        text-[10px]
                                                                        text-slate-400
                                                                        mt-0.5
                                                                    "
                                                                >
                                                                    {{ $selectedGroup->members->count() }}
                                                                    anggota
                                                                </p>

                                                            </div>

                                                        </div>


                                                        <a
                                                            href="{{ route('assignments.index', [
                                                                'kelas' => $kelas,
                                                                'pertemuan' => $pertemuan,
                                                            ]) }}"
                                                            class="
                                                                inline-flex
                                                                items-center
                                                                gap-1.5
                                                                px-3
                                                                py-2
                                                                rounded-lg
                                                                bg-slate-100
                                                                text-slate-500
                                                                text-[10px]
                                                                font-bold
                                                                hover:bg-slate-200
                                                            "
                                                        >

                                                            <i
                                                                data-lucide="x"
                                                                class="w-3.5 h-3.5"
                                                            ></i>

                                                            Tutup

                                                        </a>

                                                    </div>

                                                </div>


                                                <div class="p-5">

                                                    {{-- =================================================
                                                         ANGGOTA
                                                    ================================================== --}}

                                                    <div>

                                                        <p
                                                            class="
                                                                text-[10px]
                                                                font-black
                                                                uppercase
                                                                tracking-wider
                                                                text-slate-400
                                                                mb-3
                                                            "
                                                        >
                                                            Anggota Kelompok
                                                        </p>


                                                        <div
                                                            class="
                                                                grid
                                                                grid-cols-1
                                                                sm:grid-cols-2
                                                                gap-2
                                                            "
                                                        >

                                                            @foreach(
                                                                $selectedGroup->members
                                                                as $member
                                                            )

                                                                <a
                                                                    href="{{ route('assignments.index', [
                                                                        'kelas' => $kelas,
                                                                        'pertemuan' => $pertemuan,
                                                                        'group_id' => $selectedGroup->group->id,
                                                                        'student_id' => $member->student_id,
                                                                    ]) }}#group-detail"
                                                                    class="
                                                                        flex
                                                                        items-center
                                                                        gap-3
                                                                        px-3.5
                                                                        py-3
                                                                        rounded-xl
                                                                        bg-white
                                                                        border
                                                                        border-slate-200
                                                                        hover:border-violet-200
                                                                        transition
                                                                    "
                                                                >

                                                                    <div
                                                                        class="
                                                                            w-8
                                                                            h-8
                                                                            rounded-lg
                                                                            bg-violet-50
                                                                            text-violet-600
                                                                            flex
                                                                            items-center
                                                                            justify-center
                                                                            text-[10px]
                                                                            font-black
                                                                            shrink-0
                                                                        "
                                                                    >
                                                                        {{ $loop->iteration }}
                                                                    </div>


                                                                    <div class="min-w-0 flex-1">

                                                                        <p
                                                                            class="
                                                                                text-xs
                                                                                font-bold
                                                                                text-slate-700
                                                                                truncate
                                                                            "
                                                                        >
                                                                            {{ $member->student->nama ?? 'Siswa' }}
                                                                        </p>


                                                                        <p
                                                                            class="
                                                                                text-[9px]
                                                                                text-slate-400
                                                                                mt-0.5
                                                                            "
                                                                        >

                                                                            @if(
                                                                                $member->student &&
                                                                                $member->student->nomor_absen
                                                                            )

                                                                                No.
                                                                                {{ $member->student->nomor_absen }}

                                                                            @else

                                                                                Anggota kelompok

                                                                            @endif

                                                                        </p>

                                                                    </div>


                                                                    @if(
                                                                        $selectedStudentId &&
                                                                        (int) $selectedStudentId ===
                                                                        (int) $member->student_id
                                                                    )

                                                                        <span
                                                                            class="
                                                                                px-2
                                                                                py-1
                                                                                rounded-md
                                                                                bg-violet-50
                                                                                text-violet-600
                                                                                text-[9px]
                                                                                font-black
                                                                            "
                                                                        >
                                                                            Dipilih
                                                                        </span>

                                                                    @endif

                                                                </a>

                                                            @endforeach

                                                        </div>

                                                    </div>


                                                    {{-- =================================================
                                                         STATUS KELOMPOK
                                                    ================================================== --}}

                                                    <div class="mt-5">

                                                        @if(
                                                            $selectedGroup->status === 'selesai'
                                                        )

                                                            <div
                                                                class="
                                                                    p-4
                                                                    rounded-xl
                                                                    bg-emerald-50
                                                                    border
                                                                    border-emerald-100
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-start
                                                                        gap-3
                                                                    "
                                                                >

                                                                    <div
                                                                        class="
                                                                            w-9
                                                                            h-9
                                                                            rounded-xl
                                                                            bg-emerald-100
                                                                            text-emerald-600
                                                                            flex
                                                                            items-center
                                                                            justify-center
                                                                            shrink-0
                                                                        "
                                                                    >

                                                                        <i
                                                                            data-lucide="badge-check"
                                                                            class="w-4 h-4"
                                                                        ></i>

                                                                    </div>


                                                                    <div>

                                                                        <p
                                                                            class="
                                                                                text-sm
                                                                                font-black
                                                                                text-emerald-700
                                                                            "
                                                                        >
                                                                            Sudah dinilai
                                                                        </p>

                                                                        <p
                                                                            class="
                                                                                text-xs
                                                                                text-emerald-600
                                                                                mt-0.5
                                                                            "
                                                                        >
                                                                            Pengumpulan kelompok sudah diperiksa guru.
                                                                        </p>

                                                                    </div>


                                                                    @if(
                                                                        $selectedGroup->nilai !== null
                                                                    )

                                                                        <div
                                                                            class="
                                                                                ml-auto
                                                                                text-center
                                                                            "
                                                                        >

                                                                            <div
                                                                                class="
                                                                                    inline-flex
                                                                                    items-center
                                                                                    justify-center
                                                                                    min-w-[70px]
                                                                                    px-3
                                                                                    py-2
                                                                                    rounded-xl
                                                                                    bg-emerald-600
                                                                                    text-white
                                                                                    text-lg
                                                                                    font-black
                                                                                "
                                                                            >

                                                                                {{ number_format(
                                                                                    (float) $selectedGroup->nilai,
                                                                                    0
                                                                                ) }}

                                                                            </div>

                                                                            <p
                                                                                class="
                                                                                    text-[9px]
                                                                                    uppercase
                                                                                    tracking-wider
                                                                                    font-bold
                                                                                    text-emerald-600
                                                                                    mt-1
                                                                                "
                                                                            >
                                                                                Nilai
                                                                            </p>

                                                                        </div>

                                                                    @endif

                                                                </div>


                                                                @if(
                                                                    $selectedGroup->submission &&
                                                                    $selectedGroup->submission->link
                                                                )

                                                                    <div
                                                                        class="
                                                                            mt-4
                                                                            pt-4
                                                                            border-t
                                                                            border-emerald-100
                                                                        "
                                                                    >

                                                                        <p
                                                                            class="
                                                                                text-[10px]
                                                                                uppercase
                                                                                tracking-wider
                                                                                font-black
                                                                                text-emerald-600
                                                                            "
                                                                        >
                                                                            Link Pengumpulan
                                                                        </p>


                                                                        <a
                                                                            href="{{ $selectedGroup->submission->link }}"
                                                                            target="_blank"
                                                                            rel="noopener noreferrer"
                                                                            class="
                                                                                block
                                                                                mt-1
                                                                                text-sm
                                                                                font-semibold
                                                                                text-indigo-600
                                                                                hover:underline
                                                                                break-all
                                                                            "
                                                                        >
                                                                            {{ $selectedGroup->submission->link }}
                                                                        </a>

                                                                    </div>

                                                                @endif


                                                                @if(
                                                                    $selectedGroup->catatan_guru
                                                                )

                                                                    <div
                                                                        class="
                                                                            mt-4
                                                                            pt-4
                                                                            border-t
                                                                            border-emerald-100
                                                                        "
                                                                    >

                                                                        <p
                                                                            class="
                                                                                text-[10px]
                                                                                uppercase
                                                                                tracking-wider
                                                                                font-black
                                                                                text-emerald-600
                                                                            "
                                                                        >
                                                                            Catatan Guru
                                                                        </p>


                                                                        <p
                                                                            class="
                                                                                mt-1
                                                                                text-xs
                                                                                leading-5
                                                                                text-slate-600
                                                                            "
                                                                        >
                                                                            {!! nl2br(e($selectedGroup->catatan_guru)) !!}
                                                                        </p>

                                                                    </div>

                                                                @endif


                                                                <div
                                                                    class="
                                                                        mt-4
                                                                        flex
                                                                        items-center
                                                                        gap-2
                                                                        text-[10px]
                                                                        font-semibold
                                                                        text-emerald-600
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="lock"
                                                                        class="w-3.5 h-3.5"
                                                                    ></i>

                                                                    Link sudah dikunci setelah dinilai.

                                                                </div>

                                                            </div>


                                                        @elseif(
                                                            $selectedGroup->status === 'belum_dinilai'
                                                        )

                                                            <div
                                                                class="
                                                                    p-4
                                                                    rounded-xl
                                                                    bg-amber-50
                                                                    border
                                                                    border-amber-100
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-start
                                                                        gap-3
                                                                    "
                                                                >

                                                                    <div
                                                                        class="
                                                                            w-9
                                                                            h-9
                                                                            rounded-xl
                                                                            bg-amber-100
                                                                            text-amber-600
                                                                            flex
                                                                            items-center
                                                                            justify-center
                                                                            shrink-0
                                                                        "
                                                                    >

                                                                        <i
                                                                            data-lucide="clock-3"
                                                                            class="w-4 h-4"
                                                                        ></i>

                                                                    </div>


                                                                    <div>

                                                                        <p
                                                                            class="
                                                                                text-sm
                                                                                font-black
                                                                                text-amber-700
                                                                            "
                                                                        >
                                                                            Menunggu penilaian
                                                                        </p>

                                                                        <p
                                                                            class="
                                                                                text-xs
                                                                                text-amber-600
                                                                                mt-0.5
                                                                            "
                                                                        >
                                                                            Kelompok sudah mengumpulkan tugas.
                                                                        </p>

                                                                    </div>

                                                                </div>


                                                                @if(
                                                                    $selectedGroup->submission &&
                                                                    $selectedGroup->submission->link
                                                                )

                                                                    <div
                                                                        class="
                                                                            mt-4
                                                                            pt-4
                                                                            border-t
                                                                            border-amber-100
                                                                        "
                                                                    >

                                                                        <p
                                                                            class="
                                                                                text-[10px]
                                                                                uppercase
                                                                                tracking-wider
                                                                                font-black
                                                                                text-amber-600
                                                                            "
                                                                        >
                                                                            Link Pengumpulan
                                                                        </p>


                                                                        <a
                                                                            href="{{ $selectedGroup->submission->link }}"
                                                                            target="_blank"
                                                                            rel="noopener noreferrer"
                                                                            class="
                                                                                block
                                                                                mt-1
                                                                                text-sm
                                                                                font-semibold
                                                                                text-indigo-600
                                                                                hover:underline
                                                                                break-all
                                                                            "
                                                                        >
                                                                            {{ $selectedGroup->submission->link }}
                                                                        </a>

                                                                    </div>

                                                                @endif


                                                                @if(
                                                                    $selectedGroup->submission &&
                                                                    $selectedGroup->submission->submitted_at
                                                                )

                                                                    <p
                                                                        class="
                                                                            mt-3
                                                                            text-[10px]
                                                                            text-slate-400
                                                                        "
                                                                    >

                                                                        Dikirim:

                                                                        {{
                                                                            $selectedGroup->submission->submitted_at
                                                                                ->format('d M Y, H:i')
                                                                        }}

                                                                    </p>

                                                                @endif

                                                            </div>


                                                        @else

                                                            <div
                                                                class="
                                                                    p-4
                                                                    rounded-xl
                                                                    bg-slate-50
                                                                    border
                                                                    border-slate-200
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-start
                                                                        gap-3
                                                                    "
                                                                >

                                                                    <div
                                                                        class="
                                                                            w-9
                                                                            h-9
                                                                            rounded-xl
                                                                            bg-slate-100
                                                                            text-slate-400
                                                                            flex
                                                                            items-center
                                                                            justify-center
                                                                            shrink-0
                                                                        "
                                                                    >

                                                                        <i
                                                                            data-lucide="upload"
                                                                            class="w-4 h-4"
                                                                        ></i>

                                                                    </div>


                                                                    <div>

                                                                        <p
                                                                            class="
                                                                                text-sm
                                                                                font-black
                                                                                text-slate-700
                                                                            "
                                                                        >
                                                                            Belum mengumpulkan
                                                                        </p>

                                                                        <p
                                                                            class="
                                                                                text-xs
                                                                                text-slate-400
                                                                                mt-0.5
                                                                            "
                                                                        >
                                                                            Kelompok ini belum mengirimkan link tugas.
                                                                        </p>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        @endif

                                                    </div>


                                                    {{-- =================================================
                                                         FORM KELOMPOK
                                                    ================================================== --}}

                                                    @if(
                                                        $selectedGroup->status !== 'selesai'
                                                    )

                                                        @php

                                                            $selectedMemberIsInGroup = false;

                                                            if ($selectedStudentId) {

                                                                foreach (
                                                                    $selectedGroup->members
                                                                    as $groupMember
                                                                ) {

                                                                    if (
                                                                        (int) $groupMember->student_id ===
                                                                        (int) $selectedStudentId
                                                                    ) {

                                                                        $selectedMemberIsInGroup = true;

                                                                        break;
                                                                    }
                                                                }

                                                            }

                                                        @endphp


                                                        @if(
                                                            $selectedMemberIsInGroup
                                                        )

                                                            <div
                                                                class="
                                                                    mt-5
                                                                    p-4
                                                                    rounded-xl
                                                                    bg-white
                                                                    border
                                                                    border-slate-200
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-center
                                                                        gap-2
                                                                        mb-4
                                                                    "
                                                                >

                                                                    <div
                                                                        class="
                                                                            w-8
                                                                            h-8
                                                                            rounded-lg
                                                                            bg-violet-50
                                                                            text-violet-600
                                                                            flex
                                                                            items-center
                                                                            justify-center
                                                                        "
                                                                    >

                                                                        <i
                                                                            data-lucide="link-2"
                                                                            class="w-4 h-4"
                                                                        ></i>

                                                                    </div>


                                                                    <div>

                                                                        <p
                                                                            class="
                                                                                text-xs
                                                                                font-black
                                                                                text-slate-700
                                                                            "
                                                                        >
                                                                            {{
                                                                                $selectedGroup->submission
                                                                                    ? 'Edit Link Kelompok'
                                                                                    : 'Kumpulkan Tugas Kelompok'
                                                                            }}
                                                                        </p>

                                                                        <p
                                                                            class="
                                                                                text-[10px]
                                                                                text-slate-400
                                                                            "
                                                                        >
                                                                            Satu pengumpulan berlaku untuk seluruh anggota kelompok.
                                                                        </p>

                                                                    </div>

                                                                </div>


                                                                <form
                                                                    method="POST"
                                                                    action="{{ route(
                                                                        'assignments.submit',
                                                                        $assignment
                                                                    ) }}"
                                                                >

                                                                    @csrf


                                                                    <input
                                                                        type="hidden"
                                                                        name="student_id"
                                                                        value="{{ $selectedStudentId }}"
                                                                    >


                                                                    <div>

                                                                        <label
                                                                            class="
                                                                                block
                                                                                text-[10px]
                                                                                font-black
                                                                                uppercase
                                                                                tracking-wider
                                                                                text-slate-400
                                                                                mb-2
                                                                            "
                                                                        >
                                                                            Link Tugas
                                                                        </label>


                                                                        <input
                                                                            type="url"
                                                                            name="link"
                                                                            required
                                                                            value="{{ old(
                                                                                'link',
                                                                                $selectedGroup->submission->link ?? ''
                                                                            ) }}"
                                                                            placeholder="https://drive.google.com/..."
                                                                            class="
                                                                                link-input
                                                                                w-full
                                                                                px-4
                                                                                py-3
                                                                                rounded-xl
                                                                                border
                                                                                border-slate-200
                                                                                text-sm
                                                                                text-slate-700
                                                                            "
                                                                        >

                                                                    </div>


                                                                    <div class="mt-3">

                                                                        <label
                                                                            class="
                                                                                block
                                                                                text-[10px]
                                                                                font-black
                                                                                uppercase
                                                                                tracking-wider
                                                                                text-slate-400
                                                                                mb-2
                                                                            "
                                                                        >
                                                                            Catatan Siswa
                                                                        </label>


                                                                        <textarea
                                                                            name="catatan_siswa"
                                                                            rows="3"
                                                                            placeholder="Catatan tambahan..."
                                                                            class="
                                                                                link-input
                                                                                w-full
                                                                                px-4
                                                                                py-3
                                                                                rounded-xl
                                                                                border
                                                                                border-slate-200
                                                                                text-sm
                                                                                text-slate-700
                                                                                resize-y
                                                                            "
                                                                        >{{ old(
                                                                            'catatan_siswa',
                                                                            $selectedGroup->submission->catatan_siswa ?? ''
                                                                        ) }}</textarea>

                                                                    </div>


                                                                    <div
                                                                        class="
                                                                            mt-4
                                                                            flex
                                                                            justify-end
                                                                        "
                                                                    >

                                                                        <button
                                                                            type="submit"
                                                                            class="
                                                                                inline-flex
                                                                                items-center
                                                                                justify-center
                                                                                gap-2
                                                                                px-5
                                                                                py-3
                                                                                rounded-xl
                                                                                bg-violet-600
                                                                                hover:bg-violet-700
                                                                                text-white
                                                                                text-xs
                                                                                font-black
                                                                                transition
                                                                            "
                                                                        >

                                                                            @if(
                                                                                $selectedGroup->submission
                                                                            )

                                                                                <i
                                                                                    data-lucide="pencil"
                                                                                    class="w-4 h-4"
                                                                                ></i>

                                                                                Edit Link

                                                                            @else

                                                                                <i
                                                                                    data-lucide="send"
                                                                                    class="w-4 h-4"
                                                                                ></i>

                                                                                Kumpulkan

                                                                            @endif

                                                                        </button>

                                                                    </div>

                                                                </form>

                                                            </div>

                                                        @else

                                                            <div
                                                                class="
                                                                    mt-5
                                                                    p-4
                                                                    rounded-xl
                                                                    bg-slate-50
                                                                    border
                                                                    border-slate-200
                                                                "
                                                            >

                                                                <div
                                                                    class="
                                                                        flex
                                                                        items-start
                                                                        gap-3
                                                                    "
                                                                >

                                                                    <i
                                                                        data-lucide="info"
                                                                        class="
                                                                            w-4
                                                                            h-4
                                                                            text-slate-400
                                                                            shrink-0
                                                                            mt-0.5
                                                                        "
                                                                    ></i>


                                                                    <p
                                                                        class="
                                                                            text-xs
                                                                            leading-5
                                                                            text-slate-500
                                                                        "
                                                                    >
                                                                        Pilih salah satu anggota kelompok di atas untuk membuka form pengumpulan.
                                                                    </p>

                                                                </div>

                                                            </div>

                                                        @endif

                                                    @endif

                                                </div>

                                            </div>

                                        @endif


                                    @else

                                        <div
                                            class="
                                                py-10
                                                text-center
                                                rounded-xl
                                                bg-slate-50
                                                border
                                                border-dashed
                                                border-slate-200
                                            "
                                        >

                                            <div
                                                class="
                                                    w-12
                                                    h-12
                                                    rounded-xl
                                                    bg-white
                                                    border
                                                    border-slate-200
                                                    text-slate-400
                                                    flex
                                                    items-center
                                                    justify-center
                                                    mx-auto
                                                    mb-3
                                                "
                                            >

                                                <i
                                                    data-lucide="users-round"
                                                    class="w-5 h-5"
                                                ></i>

                                            </div>


                                            <p
                                                class="
                                                    text-sm
                                                    font-bold
                                                    text-slate-600
                                                "
                                            >
                                                Belum ada kelompok
                                            </p>


                                            <p
                                                class="
                                                    text-xs
                                                    text-slate-400
                                                    mt-1
                                                "
                                            >
                                                Guru belum membuat kelompok untuk tugas ini.
                                            </p>

                                        </div>

                                    @endif

                                </div>

                            @endif

                        </section>

                    @endforeach

                </div>

            @endif

        </div>

    </main>


    <script>

        /*
        |--------------------------------------------------------------------------
        | PENCARIAN SISWA INDIVIDU
        |--------------------------------------------------------------------------
        | Daftar siswa tidak ditampilkan saat halaman pertama dibuka.
        | Siswa baru muncul setelah guru mengetik nama/nomor absen.
        */

        document.addEventListener(
            'DOMContentLoaded',
            function () {

                document
                    .querySelectorAll('.student-search-input')
                    .forEach(function (input) {

                        const assignmentId =
                            input.dataset.assignmentId;

                        const results =
                            document.getElementById(
                                'studentResults-' + assignmentId
                            );

                        const data =
                            document.getElementById(
                                'studentData-' + assignmentId
                            );

                        if (!results || !data) {
                            return;
                        }

                        const templates = Array.from(
                            data.querySelectorAll(
                                '.student-search-result'
                            )
                        );

                        const renderPlaceholder = function () {

                            results.innerHTML = `
                                <div class="student-search-placeholder">
                                    <div class="student-search-placeholder-icon">
                                        <i data-lucide="search" class="w-5 h-5"></i>
                                    </div>
                                    <p class="student-search-placeholder-title">
                                        Cari nama siswa
                                    </p>
                                    <p class="student-search-placeholder-text">
                                        Daftar siswa akan muncul setelah Anda mengetik nama.
                                    </p>
                                </div>
                            `;

                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }
                        };

                        const renderNoResult = function () {

                            results.innerHTML = `
                                <div class="student-search-no-result">
                                    <div class="student-search-no-result-icon">
                                        <i data-lucide="user-x" class="w-5 h-5"></i>
                                    </div>
                                    <p class="student-search-no-result-title">
                                        Siswa tidak ditemukan
                                    </p>
                                    <p class="student-search-no-result-text">
                                        Coba gunakan nama atau nomor absen yang berbeda.
                                    </p>
                                </div>
                            `;

                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }
                        };

                        input.addEventListener(
                            'input',
                            function () {

                                const keyword =
                                    this.value
                                        .trim()
                                        .toLowerCase();

                                if (keyword === '') {
                                    renderPlaceholder();
                                    return;
                                }

                                const matched = templates.filter(
                                    function (item) {

                                        const name =
                                            item.dataset.studentName || '';

                                        const absen =
                                            item.dataset.studentAbsen || '';

                                        return (
                                            name.includes(keyword) ||
                                            absen.includes(keyword)
                                        );
                                    }
                                );

                                if (matched.length === 0) {
                                    renderNoResult();
                                    return;
                                }

                                results.innerHTML = '';

                                matched.forEach(function (item) {
                                    results.appendChild(
                                        item.cloneNode(true)
                                    );
                                });

                                if (typeof lucide !== 'undefined') {
                                    lucide.createIcons();
                                }
                            }
                        );

                    });

            }
        );


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


        /*
        |--------------------------------------------------------------------------
        | AUTO SCROLL KE DETAIL
        |--------------------------------------------------------------------------
        */

        window.addEventListener(
            'load',
            function () {

                const hash =
                    window.location.hash;

                if (!hash) {
                    return;
                }


                const element =
                    document.querySelector(
                        hash
                    );


                if (!element) {
                    return;
                }


                setTimeout(
                    function () {

                        element.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                    },
                    120
                );

            }
        );

    </script>

</body>

</html>