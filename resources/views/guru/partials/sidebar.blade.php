<style>

    /* =========================================================
       SIDEBAR GURU
       SIMPLE • MINIMAL • PREMIUM
    ========================================================== */

    #guruSidebar {
        width: 220px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        display: flex;
        flex-direction: column;
        background: #ffffff;
        border-right: 1px solid #e2e8f0;
        box-shadow: 5px 0 22px rgba(15, 23, 42, .035);
        z-index: 50;
        overflow: hidden;
    }


    /* =========================================================
       LINK
    ========================================================== */

    .sidebar-link {
        position: relative;
        width: 100%;
        transition:
            background .18s ease,
            color .18s ease;
    }


    .sidebar-link:hover {
        background: #f8fafc;
        color: #334155;
    }


    .sidebar-link.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }


    .sidebar-link.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 9px;
        bottom: 9px;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: #2563eb;
    }


    /* =========================================================
       DROPDOWN
    ========================================================== */

    .sidebar-dropdown-button {
        position: relative;
        width: 100%;
        min-height: 40px;

        display: flex;
        align-items: center;
        gap: 12px;

        padding: 0 12px;

        border: 0;
        border-radius: 11px;

        background: transparent;
        color: #64748b;

        font-family: inherit;
        font-size: .875rem;
        font-weight: 500;

        text-align: left;
        cursor: pointer;

        transition:
            background .18s ease,
            color .18s ease;
    }


    .sidebar-dropdown-button:hover {
        background: #f8fafc;
        color: #334155;
    }


    .sidebar-dropdown-button.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }


    .sidebar-dropdown-button.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 9px;
        bottom: 9px;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: #2563eb;
    }


    .sidebar-dropdown-chevron {
        width: 14px;
        height: 14px;
        margin-left: auto;
        color: #94a3b8;
        transition: transform .2s ease;
    }


    .sidebar-dropdown.open
    .sidebar-dropdown-chevron {
        transform: rotate(180deg);
        color: #2563eb;
    }


    .sidebar-dropdown-content {
        display: none;
        padding: 3px 0 4px 28px;
    }


    .sidebar-dropdown.open
    .sidebar-dropdown-content {
        display: block;
    }


    /* =========================================================
       SUB MENU
    ========================================================== */

    .sidebar-sub-link {
        position: relative;

        min-height: 35px;

        display: flex;
        align-items: center;
        gap: 9px;

        padding: 0 10px;

        margin: 1px 0;

        border-radius: 9px;

        color: #94a3b8;

        text-decoration: none;

        font-size: .75rem;
        font-weight: 500;

        transition:
            background .18s ease,
            color .18s ease;
    }


    .sidebar-sub-link:hover {
        background: #f8fafc;
        color: #475569;
    }


    .sidebar-sub-link.active {
        background: #f1f5f9;
        color: #2563eb;
        font-weight: 600;
    }


    .sidebar-sub-link.active::before {
        content: "";
        position: absolute;
        left: -7px;
        top: 9px;
        bottom: 9px;
        width: 2px;
        border-radius: 999px;
        background: #2563eb;
    }


    /* =========================================================
       SECTION
    ========================================================== */

    .sidebar-section {
        margin: 5px 0;
    }


    .sidebar-divider {
        height: 1px;
        margin: 10px 8px;

        background:
            linear-gradient(
                90deg,
                transparent,
                #e7edf5 18%,
                #e7edf5 82%,
                transparent
            );
    }


    /* =========================================================
       EXPORT NILAI
    ========================================================== */

    .sidebar-export-link {
        position: relative;
        width: 100%;

        display: flex;
        align-items: center;
        gap: 12px;

        min-height: 40px;
        padding: 0 12px;

        border-radius: 11px;

        color: #64748b;

        text-decoration: none;

        font-size: .875rem;
        font-weight: 500;

        transition:
            background .18s ease,
            color .18s ease;
    }


    .sidebar-export-link:hover {
        background: #f8fafc;
        color: #334155;
    }


    .sidebar-export-link.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }


    .sidebar-export-link.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 9px;
        bottom: 9px;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: #2563eb;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 1023px) {

        #guruSidebar {
            width: 220px;
            transform: translateX(-100%);
            transition: transform .25s ease;
        }


        #guruSidebar.mobile-open {
            transform: translateX(0);
        }

    }

</style>


{{-- =========================================================
     MOBILE OVERLAY
========================================================== --}}

<div
    id="guruSidebarOverlay"
    class="
        fixed
        inset-0
        bg-slate-900/40
        backdrop-blur-sm
        z-40
        hidden
        lg:hidden
    "
    onclick="closeGuruSidebar()"
></div>


{{-- =========================================================
     SIDEBAR
========================================================== --}}

<aside
    id="guruSidebar"
>


    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div
        class="
            flex
            items-center
            gap-3
            px-4
            py-4
            shrink-0
        "
    >

        <div
            class="
                w-10
                h-10
                min-w-[40px]
                rounded-xl
                bg-blue-600
                flex
                items-center
                justify-center
                shadow-sm
            "
        >

            <i
                data-lucide="graduation-cap"
                class="w-5 h-5 text-white"
            ></i>

        </div>


        <div class="min-w-0">

            <h1
                class="
                    font-bold
                    text-lg
                    text-slate-900
                    tracking-tight
                "
            >
                LARASKU
            </h1>

            <p class="text-xs text-slate-400">
                Panel Guru
            </p>

        </div>

    </div>


    {{-- =====================================================
         MENU
    ====================================================== --}}

    <nav
        class="
            flex-1
            px-3
            overflow-y-auto
            space-y-1
        "
    >


        {{-- =================================================
             DASHBOARD / SISWA / KELAS / ABSENSI
        ================================================== --}}

        <div class="sidebar-section">


            {{-- DASHBOARD --}}

            <a
                href="{{ route('guru.dashboard') }}"
                class="
                    sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('guru.dashboard')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="layout-dashboard"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>
                    Dashboard
                </span>

            </a>


            {{-- DATA SISWA --}}

            <a
                href="{{ route('guru.students.index') }}"
                class="
                    sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('guru.students.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="users"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>
                    Data Siswa
                </span>

            </a>


            {{-- KELOLA KELAS --}}

            <a
                href="{{ route('guru.classes.index') }}"
                class="
                    sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('guru.classes.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="school"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>
                    Kelola Kelas
                </span>

            </a>


            {{-- ABSENSI DROPDOWN --}}

            @php
                $attendanceOpen =
                    request()->routeIs(
                        'guru.attendance.*'
                    );
            @endphp


            <div
                class="
                    sidebar-dropdown
                    {{ $attendanceOpen ? 'open' : '' }}
                "
                data-sidebar-dropdown="attendance"
            >

                <button
                    type="button"
                    class="
                        sidebar-dropdown-button
                        {{ $attendanceOpen ? 'active' : '' }}
                    "
                    onclick="toggleSidebarDropdown('attendance')"
                >

                    <i
                        data-lucide="clipboard-check"
                        class="w-4 h-4 min-w-[16px]"
                    ></i>


                    <span>
                        Absensi
                    </span>


                    <i
                        data-lucide="chevron-down"
                        class="sidebar-dropdown-chevron"
                    ></i>

                </button>


                <div class="sidebar-dropdown-content">


                    {{-- ABSENSI --}}

                    <a
                        href="{{ route('guru.attendance.index') }}"
                        class="
                            sidebar-sub-link
                            {{ request()->routeIs('guru.attendance.index')
                                ? 'active'
                                : '' }}
                        "
                    >

                        <i
                            data-lucide="clipboard-check"
                            class="w-3.5 h-3.5"
                        ></i>

                        <span>
                            Absensi
                        </span>

                    </a>


                    {{-- REKAP ABSENSI --}}

                    <a
                        href="{{ route('guru.attendance.rekap') }}"
                        class="
                            sidebar-sub-link
                            {{ request()->routeIs('guru.attendance.rekap')
                                ? 'active'
                                : '' }}
                        "
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="w-3.5 h-3.5"
                        ></i>

                        <span>
                            Rekap Absensi
                        </span>

                    </a>


                </div>

            </div>


        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="sidebar-divider"></div>


        {{-- =================================================
             DAFTAR PEMBELAJARAN
        ================================================== --}}

        @php

            $learningOpen =
                request()->routeIs(
                    'guru.materials.*'
                )
                ||
                request()->routeIs(
                    'guru.videos.*'
                )
                ||
                request()->routeIs(
                    'guru.games.*'
                );

        @endphp


        <div
            class="
                sidebar-section
                sidebar-dropdown
                {{ $learningOpen ? 'open' : '' }}
            "
            data-sidebar-dropdown="learning"
        >


            <button
                type="button"
                class="
                    sidebar-dropdown-button
                    {{ $learningOpen ? 'active' : '' }}
                "
                onclick="toggleSidebarDropdown('learning')"
            >

                <i
                    data-lucide="book-open"
                    class="w-4 h-4 min-w-[16px]"
                ></i>


                <span>
                    Daftar Pembelajaran
                </span>


                <i
                    data-lucide="chevron-down"
                    class="sidebar-dropdown-chevron"
                ></i>

            </button>


            <div class="sidebar-dropdown-content">


                {{-- MATERI --}}

                <a
                    href="{{ route('guru.materials.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.materials.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="book-open-text"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Materi
                    </span>

                </a>


                {{-- VIDEO --}}

                <a
                    href="{{ route('guru.videos.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.videos.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="play-circle"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Video
                    </span>

                </a>


                {{-- GAME INTERAKTIF --}}

                <a
                    href="{{ route('guru.games.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.games.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="gamepad-2"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Game Interaktif
                    </span>

                </a>


            </div>

        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="sidebar-divider"></div>


        {{-- =================================================
             DAFTAR TUGAS
        ================================================== --}}

        @php

            $taskOpen =
                request()->routeIs(
                    'guru.assignments.*'
                )
                ||
                request()->routeIs(
                    'guru.reflections.*'
                )
                ||
                request()->routeIs(
                    'guru.quizzes.*'
                )
                ||
                request()->routeIs(
                    'guru.lkpd.*'
                );

        @endphp


        <div
            class="
                sidebar-section
                sidebar-dropdown
                {{ $taskOpen ? 'open' : '' }}
            "
            data-sidebar-dropdown="tasks"
        >


            <button
                type="button"
                class="
                    sidebar-dropdown-button
                    {{ $taskOpen ? 'active' : '' }}
                "
                onclick="toggleSidebarDropdown('tasks')"
            >

                <i
                    data-lucide="clipboard-list"
                    class="w-4 h-4 min-w-[16px]"
                ></i>


                <span>
                    Daftar Tugas
                </span>


                <i
                    data-lucide="chevron-down"
                    class="sidebar-dropdown-chevron"
                ></i>

            </button>


            <div class="sidebar-dropdown-content">


                {{-- PRAKTIK --}}

                <a
                    href="{{ route('guru.assignments.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.assignments.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="clipboard-pen-line"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Praktik
                    </span>

                </a>


                {{-- REFLEKSI --}}

                <a
                    href="{{ route('guru.reflections.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.reflections.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="message-square-heart"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Refleksi
                    </span>

                </a>


                {{-- QUIZ --}}

                <a
                    href="{{ route('guru.quizzes.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.quizzes.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="help-circle"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        Quiz
                    </span>

                </a>


                {{-- LKPD --}}

                <a
                    href="{{ route('guru.lkpd.index') }}"
                    class="
                        sidebar-sub-link
                        {{ request()->routeIs('guru.lkpd.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="file-check-2"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>
                        LKPD
                    </span>

                </a>


            </div>

        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="sidebar-divider"></div>


        {{-- =================================================
             PERINGKAT
        ================================================== --}}

        <div class="sidebar-section">

            <a
                href="{{ route('guru.quiz-ranking.index') }}"
                class="
                    sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('guru.quiz-ranking.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="trophy"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>
                    Peringkat
                </span>

            </a>

        </div>


        {{-- =================================================
             ⭐ EXPORT NILAI
        ================================================== --}}

        <div class="sidebar-section">

            <a
                href="{{ route('guru.exports.index') }}"
                class="
                    sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('guru.exports.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="file-spreadsheet"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>
                    Export Nilai
                </span>

            </a>

        </div>


    </nav>


    {{-- =====================================================
         USER
    ====================================================== --}}

    <div
        class="
            px-3
            pb-4
            pt-3
            shrink-0
        "
    >

        <div
            class="
                border-t
                border-slate-100
                pt-4
            "
        >

            <div
                class="
                    flex
                    items-center
                    gap-3
                    px-2
                "
            >

                <div
                    class="
                        w-9
                        h-9
                        min-w-[36px]
                        rounded-full
                        bg-blue-100
                        flex
                        items-center
                        justify-center
                    "
                >

                    <i
                        data-lucide="user-round"
                        class="w-4 h-4 text-blue-600"
                    ></i>

                </div>


                <div class="min-w-0">

                    <p
                        class="
                            text-sm
                            font-semibold
                            text-slate-800
                        "
                    >
                        Guru
                    </p>


                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Panel Pengajar
                    </p>

                </div>

            </div>

        </div>

    </div>


</aside>


{{-- =========================================================
     MOBILE MENU BUTTON
========================================================== --}}

<button
    id="guruMobileMenuButton"
    type="button"
    onclick="openGuruSidebar()"
    class="
        fixed
        left-4
        top-4
        z-30
        lg:hidden
        w-10
        h-10
        rounded-xl
        bg-white
        border
        border-slate-200
        shadow-sm
        flex
        items-center
        justify-center
        text-slate-600
    "
>

    <i
        data-lucide="menu"
        class="w-5 h-5"
    ></i>

</button>


<script>

    /* =========================================================
       DROPDOWN SIDEBAR
    ========================================================== */

    function toggleSidebarDropdown(name) {

        const dropdown =
            document.querySelector(
                '[data-sidebar-dropdown="' +
                name +
                '"]'
            );


        if (!dropdown) {
            return;
        }


        const currentlyOpen =
            dropdown.classList.contains(
                'open'
            );


        /*
        |--------------------------------------------------------------------------
        | Tutup dropdown lainnya
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll(
                '#guruSidebar .sidebar-dropdown'
            )
            .forEach(
                function (item) {

                    item.classList.remove(
                        'open'
                    );

                }
            );


        /*
        |--------------------------------------------------------------------------
        | Buka dropdown yang dipilih
        |--------------------------------------------------------------------------
        */

        if (!currentlyOpen) {

            dropdown.classList.add(
                'open'
            );

        }

    }


    /* =========================================================
       MOBILE SIDEBAR
    ========================================================== */

    function openGuruSidebar() {

        const sidebar =
            document.getElementById(
                'guruSidebar'
            );


        const overlay =
            document.getElementById(
                'guruSidebarOverlay'
            );


        if (!sidebar) {
            return;
        }


        sidebar.classList.add(
            'mobile-open'
        );


        if (overlay) {

            overlay.classList.remove(
                'hidden'
            );

        }

    }


    function closeGuruSidebar() {

        const sidebar =
            document.getElementById(
                'guruSidebar'
            );


        const overlay =
            document.getElementById(
                'guruSidebarOverlay'
            );


        if (!sidebar) {
            return;
        }


        sidebar.classList.remove(
            'mobile-open'
        );


        if (overlay) {

            overlay.classList.add(
                'hidden'
            );

        }

    }


    /* =========================================================
       LUCIDE ICON
    ========================================================== */

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