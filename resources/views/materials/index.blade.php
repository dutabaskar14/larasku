<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Materi Pembelajaran — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #1e293b;

            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;
        }

        /* =========================================================
           MATERIAL PAGE
        ========================================================= */

        .material-main {
            min-height: 100vh;
        }

        .material-content {
            max-width: 1180px;
            margin: 0 auto;

            padding: 34px;
        }

        /* =========================================================
           TOPBAR
        ========================================================= */

        .material-topbar {
            height: 74px;

            background: rgba(255, 255, 255, .92);

            border-bottom: 1px solid #e5e7eb;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 34px;

            position: sticky;
            top: 0;

            z-index: 20;

            backdrop-filter: blur(12px);
        }

        .material-topbar-title {
            font-size: 15px;
            font-weight: 800;
            color: #334155;
        }

        .material-topbar-badge {
            padding: 8px 13px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            border-radius: 10px;

            font-size: 12px;
            font-weight: 700;

            color: #64748b;
        }

        /* =========================================================
           PAGE HEADER
        ========================================================= */

        .page-header {
            margin-bottom: 28px;
        }

        .eyebrow {
            color: #2563eb;

            font-size: 12px;
            font-weight: 850;

            text-transform: uppercase;
            letter-spacing: .1em;

            margin-bottom: 7px;
        }

        .page-title {
            margin: 0;

            font-size: 34px;
            line-height: 1.15;

            font-weight: 900;
            letter-spacing: -.04em;

            color: #0f172a;
        }

        .page-description {
            margin-top: 9px;

            color: #64748b;

            font-size: 14px;
            line-height: 1.7;
        }

        /* =========================================================
           PERTEMUAN
        ========================================================= */

        .meeting-section {
            margin-bottom: 28px;
        }

        .meeting-heading {
            display: flex;
            align-items: center;
            gap: 10px;

            margin-bottom: 13px;
        }

        .meeting-heading-icon {
            width: 36px;
            height: 36px;

            border-radius: 10px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .meeting-heading-text h2 {
            margin: 0;

            font-size: 15px;
            font-weight: 800;

            color: #0f172a;
        }

        .meeting-heading-text p {
            margin: 2px 0 0;

            font-size: 11px;

            color: #94a3b8;
        }

        .meeting-grid {
            display: grid;

            grid-template-columns:
                repeat(4, minmax(0, 1fr));

            gap: 12px;
        }

        .meeting-card {
            position: relative;

            display: flex;
            align-items: center;
            gap: 13px;

            min-height: 70px;

            padding: 13px 15px;

            border-radius: 15px;

            background: #ffffff;

            border: 1px solid #e2e8f0;

            color: #475569;

            text-decoration: none;

            transition:
                transform .18s ease,
                border-color .18s ease,
                box-shadow .18s ease,
                background .18s ease;
        }

        .meeting-card:hover {
            transform: translateY(-2px);

            border-color: #bfdbfe;

            background: #f8fbff;

            box-shadow:
                0 8px 22px
                rgba(15, 23, 42, .06);
        }

        .meeting-card.active {
            border-color: #2563eb;

            background: #eff6ff;

            color: #1d4ed8;

            box-shadow:
                0 8px 22px
                rgba(37, 99, 235, .10);
        }

        .meeting-number {
            width: 40px;
            height: 40px;

            min-width: 40px;

            border-radius: 11px;

            background: #f1f5f9;

            color: #64748b;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
            font-weight: 900;
        }

        .meeting-card.active .meeting-number {
            background: #2563eb;
            color: #ffffff;
        }

        .meeting-info {
            min-width: 0;
        }

        .meeting-info strong {
            display: block;

            font-size: 13px;
            font-weight: 800;

            color: #334155;
        }

        .meeting-card.active .meeting-info strong {
            color: #1d4ed8;
        }

        .meeting-info span {
            display: block;

            margin-top: 2px;

            font-size: 10px;

            color: #94a3b8;
        }

        .meeting-card.active .meeting-info span {
            color: #60a5fa;
        }

        .meeting-arrow {
            margin-left: auto;

            color: #cbd5e1;
        }

        .meeting-card.active .meeting-arrow {
            color: #2563eb;
        }

        /* =========================================================
           SELECTED MEETING
        ========================================================= */

        .selected-meeting {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;

            padding: 18px 21px;

            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 16px;
        }

        .selected-left {
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .selected-icon {
            width: 42px;
            height: 42px;

            border-radius: 12px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .selected-text small {
            display: block;

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: .08em;

            color: #94a3b8;
        }

        .selected-text strong {
            display: block;

            margin-top: 2px;

            font-size: 16px;
            font-weight: 850;

            color: #0f172a;
        }

        .selected-count {
            padding: 7px 11px;

            border-radius: 9px;

            background: #f8fafc;

            border: 1px solid #e2e8f0;

            color: #64748b;

            font-size: 11px;
            font-weight: 750;

            white-space: nowrap;
        }

        /* =========================================================
           MATERIAL CARD
        ========================================================= */

        .material-list {
            display: grid;
            gap: 20px;
        }

        .material-card {
            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 20px;

            overflow: hidden;

            box-shadow:
                0 4px 18px
                rgba(15, 23, 42, .035);

            transition:
                transform .2s ease,
                box-shadow .2s ease;
        }

        .material-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 12px 30px
                rgba(15, 23, 42, .07);
        }

        .material-head {
            padding: 24px 26px 21px;

            border-bottom: 1px solid #f1f5f9;
        }

        .material-meta {
            display: flex;
            align-items: center;

            flex-wrap: wrap;

            gap: 6px;

            margin-bottom: 10px;
        }

        .material-meeting {
            display: inline-flex;
            align-items: center;

            padding: 5px 10px;

            border-radius: 8px;

            background: #eff6ff;
            color: #2563eb;

            font-size: 11px;
            font-weight: 850;
        }

        .material-category {
            display: inline-flex;
            align-items: center;

            padding: 5px 10px;

            border-radius: 8px;

            background: #f8fafc;
            color: #64748b;

            font-size: 11px;
            font-weight: 750;
        }

        .material-title {
            margin: 0;

            font-size: 23px;
            line-height: 1.3;

            font-weight: 850;
            letter-spacing: -.025em;

            color: #0f172a;
        }

        .material-body {
            padding: 26px;
        }

        /* =========================================================
           CONTENT TYPOGRAPHY
        ========================================================= */

        .material-body-content {
            color: #475569;

            font-size: 15px;
            line-height: 1.85;
        }

        .material-body-content h1 {
            margin: 0 0 18px;

            font-size: 30px;
            line-height: 1.25;

            font-weight: 900;

            color: #0f172a;
        }

        .material-body-content h2 {
            margin: 30px 0 12px;

            font-size: 22px;
            line-height: 1.35;

            font-weight: 850;

            color: #0f172a;
        }

        .material-body-content h3 {
            margin: 25px 0 10px;

            font-size: 18px;
            line-height: 1.45;

            font-weight: 800;

            color: #1e293b;
        }

        .material-body-content h4 {
            margin: 20px 0 8px;

            font-size: 16px;

            font-weight: 800;

            color: #334155;
        }

        .material-body-content p {
            margin: 0 0 15px;
        }

        .material-body-content strong {
            color: #1e293b;
            font-weight: 800;
        }

        .material-body-content em {
            color: #64748b;
        }

        .material-body-content ul,
        .material-body-content ol {
            margin: 12px 0 18px;

            padding-left: 26px;
        }

        .material-body-content li {
            margin-bottom: 7px;
        }

        .material-body-content ul li::marker {
            color: #3b82f6;
        }

        .material-body-content blockquote {
            margin: 20px 0;

            padding: 15px 18px;

            border-left: 4px solid #3b82f6;

            background: #f8fafc;

            color: #475569;

            border-radius: 0 10px 10px 0;
        }

        /* =========================================================
           TABLE
        ========================================================= */

        .material-body-content table {
            width: 100%;

            border-collapse: separate;
            border-spacing: 0;

            margin: 22px 0;

            overflow: hidden;

            border: 1px solid #e2e8f0;

            border-radius: 12px;

            font-size: 14px;
        }

        .material-body-content th,
        .material-body-content td {
            padding: 11px 13px;

            border-right: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;

            text-align: left;
            vertical-align: top;
        }

        .material-body-content th:last-child,
        .material-body-content td:last-child {
            border-right: 0;
        }

        .material-body-content tr:last-child td {
            border-bottom: 0;
        }

        .material-body-content th {
            background: #f8fafc;

            color: #0f172a;

            font-weight: 800;
        }

        .material-body-content tr:hover td {
            background: #fafcff;
        }

        /* =========================================================
           IMAGE
        ========================================================= */

        .material-body-content img {
            display: block;

            max-width: 100%;
            height: auto;

            margin: 22px auto;

            border-radius: 14px;
        }

        /* =========================================================
           FOOTER
        ========================================================= */

        .material-footer {
            padding: 18px 26px;

            border-top: 1px solid #f1f5f9;

            display: flex;
            justify-content: flex-end;
        }

        .open-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            padding: 10px 15px;

            border-radius: 10px;

            background: #0f172a;
            color: #ffffff;

            text-decoration: none;

            font-size: 13px;
            font-weight: 750;

            transition: .18s ease;
        }

        .open-button:hover {
            background: #1e293b;

            transform: translateY(-1px);
        }

        /* =========================================================
           EMPTY STATE
        ========================================================= */

        .empty {
            background: #ffffff;

            border: 1px solid #e5e7eb;

            border-radius: 20px;

            padding: 60px 25px;

            text-align: center;
        }

        .empty-icon {
            width: 54px;
            height: 54px;

            margin: 0 auto 15px;

            border-radius: 16px;

            background: #eff6ff;
            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-title {
            font-size: 20px;
            font-weight: 850;

            color: #0f172a;
        }

        .empty-text {
            margin-top: 7px;

            color: #94a3b8;

            font-size: 14px;
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 1023px) {

            .material-content {
                padding: 24px 17px 40px;
            }

            .material-topbar {
                padding: 0 18px;

                height: 64px;
            }

            .page-title {
                font-size: 28px;
            }

            .meeting-grid {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));
            }

        }

        @media (max-width: 600px) {

            .meeting-grid {
                grid-template-columns: 1fr;
            }

            .selected-meeting {
                align-items: flex-start;

                flex-direction: column;

                gap: 12px;
            }

            .material-head,
            .material-body {
                padding: 20px;
            }

            .material-title {
                font-size: 21px;
            }

            .material-body-content {
                font-size: 14px;
            }

            .material-body-content table {
                display: block;

                overflow-x: auto;

                white-space: nowrap;
            }

            .material-footer {
                padding: 16px 20px;
            }

        }

    </style>

</head>


<body>

<div class="min-h-screen bg-slate-50">


    {{-- =========================================================
         SIDEBAR UTAMA SISWA
    ========================================================== --}}

    @include('partials.sidebar')


    {{-- =========================================================
         MAIN CONTENT
    ========================================================== --}}

    <main
        class="
            material-main
            lg:ml-[240px]
        "
    >


        {{-- =====================================================
             TOPBAR
        ====================================================== --}}

        <header class="material-topbar">

            <div class="material-topbar-title">
                Materi Pembelajaran
            </div>

            <div class="material-topbar-badge">
                LARASKU
            </div>

        </header>


        {{-- =====================================================
             CONTENT
        ====================================================== --}}

        <div class="material-content">


            {{-- =================================================
                 HEADER
            ================================================== --}}

            <section class="page-header">

                <div class="eyebrow">
                    Pembelajaran Seni Musik
                </div>

                <h1 class="page-title">
                    Materi Pembelajaran
                </h1>

                <p class="page-description">
                    Pilih pertemuan untuk melihat materi
                    yang akan dipelajari.
                </p>

            </section>


            {{-- =================================================
                 PERTEMUAN 1–8
            ================================================== --}}

            <section class="meeting-section">


                <div class="meeting-heading">

                    <div class="meeting-heading-icon">

                        <i
                            data-lucide="book-open"
                            class="w-5 h-5"
                        ></i>

                    </div>

                    <div class="meeting-heading-text">

                        <h2>
                            Pertemuan Pembelajaran
                        </h2>

                        <p>
                            Pilih pertemuan sesuai kegiatan pembelajaran.
                        </p>

                    </div>

                </div>


                <div class="meeting-grid">

                    @for($i = 1; $i <= 8; $i++)

                        <a
                            href="{{ route('materials.index', ['pertemuan' => $i]) }}"
                            class="
                                meeting-card
                                {{ (int) $pertemuan === $i ? 'active' : '' }}
                            "
                        >

                            <div class="meeting-number">
                                {{ $i }}
                            </div>


                            <div class="meeting-info">

                                <strong>
                                    Pertemuan {{ $i }}
                                </strong>

                                <span>
                                    Materi pembelajaran
                                </span>

                            </div>


                            <div class="meeting-arrow">

                                <i
                                    data-lucide="chevron-right"
                                    class="w-4 h-4"
                                ></i>

                            </div>

                        </a>

                    @endfor

                </div>

            </section>


            {{-- =================================================
                 BELUM MEMILIH PERTEMUAN
            ================================================== --}}

            @if($pertemuan === null)

                <div class="empty">

                    <div class="empty-icon">

                        <i
                            data-lucide="book-open"
                            class="w-6 h-6"
                        ></i>

                    </div>

                    <div class="empty-title">
                        Pilih Pertemuan
                    </div>

                    <div class="empty-text">
                        Silakan pilih Pertemuan 1 sampai 8
                        untuk melihat materi yang akan dipelajari.
                    </div>

                </div>


            {{-- =================================================
                 ADA MATERI
            ================================================== --}}

            @elseif($materials->count())


                {{-- =================================================
                     INFORMASI PERTEMUAN TERPILIH
                ================================================== --}}

                <div class="selected-meeting">

                    <div class="selected-left">

                        <div class="selected-icon">

                            <i
                                data-lucide="graduation-cap"
                                class="w-5 h-5"
                            ></i>

                        </div>


                        <div class="selected-text">

                            <small>
                                Pertemuan Terpilih
                            </small>

                            <strong>
                                Pertemuan {{ $pertemuan }}
                            </strong>

                        </div>

                    </div>


                    <div class="selected-count">

                        {{ $materials->count() }}

                        {{ $materials->count() === 1 ? 'Materi' : 'Materi' }}

                    </div>

                </div>


                {{-- =================================================
                     DAFTAR MATERI
                ================================================== --}}

                <div class="material-list">

                    @foreach($materials as $material)

                        <article class="material-card">


                            {{-- HEADER MATERI --}}

                            <div class="material-head">

                                <div class="material-meta">

                                    <span class="material-meeting">

                                        Pertemuan
                                        {{ $material->pertemuan }}

                                    </span>


                                    @if($material->kategori)

                                        <span class="material-category">

                                            {{ $material->kategori }}

                                        </span>

                                    @endif

                                </div>


                                <h2 class="material-title">

                                    {{ $material->judul }}

                                </h2>

                            </div>


                            {{-- ISI MATERI --}}

                            <div class="material-body">

                                <div class="material-body-content">

                                    {!! $material->isi !!}

                                </div>

                            </div>


                            {{-- FOOTER --}}

                            <div class="material-footer">

                                <a
                                    href="{{ route('materials.show', $material) }}"
                                    class="open-button"
                                >

                                    Buka Materi

                                    <i
                                        data-lucide="arrow-right"
                                        class="w-4 h-4"
                                    ></i>

                                </a>

                            </div>


                        </article>

                    @endforeach

                </div>


            {{-- =================================================
                 PERTEMUAN TANPA MATERI
            ================================================== --}}

            @else

                <div class="empty">

                    <div class="empty-icon">

                        <i
                            data-lucide="book-open"
                            class="w-6 h-6"
                        ></i>

                    </div>

                    <div class="empty-title">

                        Materi Belum Tersedia

                    </div>

                    <div class="empty-text">

                        Belum ada materi aktif untuk
                        Pertemuan {{ $pertemuan }}.

                    </div>

                </div>

            @endif


        </div>

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