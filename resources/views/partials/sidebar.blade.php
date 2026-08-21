{{-- resources/views/partials/sidebar.blade.php --}}

<style>

    #studentSidebar {
        width: 240px;
    }

    .student-sidebar-link {
        transition:
            background .2s ease,
            color .2s ease,
            transform .2s ease;
    }

    .student-sidebar-link:hover {
        background: #f8fafc;
        transform: translateX(1px);
    }

    .student-sidebar-link.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }



    /* =========================================================
       DROPDOWN
    ========================================================== */

    .student-sidebar-section {
        margin: 5px 0;
    }

    .student-sidebar-divider {
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

    .student-sidebar-dropdown-button {
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

    .student-sidebar-dropdown-button:hover {
        background: #f8fafc;
        color: #334155;
    }

    .student-sidebar-dropdown-button.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }

    .student-sidebar-dropdown-button.active::before {
        content: "";
        position: absolute;
        left: 0;
        top: 9px;
        bottom: 9px;
        width: 3px;
        border-radius: 0 4px 4px 0;
        background: #2563eb;
    }

    .student-sidebar-dropdown-chevron {
        width: 14px;
        height: 14px;
        margin-left: auto;
        color: #94a3b8;
        transition:
            transform .2s ease,
            color .2s ease;
    }

    .student-sidebar-dropdown.open
    .student-sidebar-dropdown-chevron {
        transform: rotate(180deg);
        color: #2563eb;
    }

    .student-sidebar-dropdown-content {
        display: none;
        padding: 3px 0 4px 28px;
    }

    .student-sidebar-dropdown.open
    .student-sidebar-dropdown-content {
        display: block;
    }

    .student-sidebar-sub-link {
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

    .student-sidebar-sub-link:hover {
        background: #f8fafc;
        color: #475569;
    }

    .student-sidebar-sub-link.active {
        background: #f1f5f9;
        color: #2563eb;
        font-weight: 600;
    }

    .student-sidebar-sub-link.active::before {
        content: "";
        position: absolute;
        left: -7px;
        top: 9px;
        bottom: 9px;
        width: 2px;
        border-radius: 999px;
        background: #2563eb;
    }


    /*
     * MOBILE
     */

    #studentSidebarOverlay {
        display: none;
    }

    @media (max-width: 1023px) {

        #studentSidebar {
            width: 240px;
            transform: translateX(-100%);
            transition: transform .3s ease;
        }

        #studentSidebar.mobile-open {
            transform: translateX(0);
        }

        #studentSidebarOverlay.mobile-visible {
            display: block;
        }

    }

</style>


{{-- =========================================================
     MOBILE OVERLAY
========================================================= --}}

<div
    id="studentSidebarOverlay"
    class="
        fixed
        inset-0
        bg-slate-900/40
        backdrop-blur-sm
        z-40
        lg:hidden
    "
    onclick="toggleStudentSidebar(false)"
></div>



{{-- =========================================================
     SIDEBAR SISWA
========================================================= --}}

<aside
    id="studentSidebar"
    class="
        fixed
        inset-y-0
        left-0
        bg-white
        border-r
        border-slate-200
        flex
        flex-col
        z-50
        shadow-sm
    "
>


    {{-- =====================================================
         BRAND
    ====================================================== --}}

    <div
        class="
            flex
            items-center
            gap-3
            px-5
            py-5
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


        <div>

            <h1
                class="
                    font-bold
                    text-xl
                    text-slate-900
                    tracking-tight
                "
            >
                LARASKU
            </h1>

            <p class="text-xs text-slate-400">
                Panel Siswa
            </p>

        </div>


        {{-- TOMBOL CLOSE KHUSUS MOBILE --}}

        <button
            type="button"
            onclick="toggleStudentSidebar(false)"
            class="
                ml-auto
                flex
                lg:hidden
                w-8
                h-8
                rounded-lg
                items-center
                justify-center
                text-slate-400
                hover:text-red-500
                hover:bg-red-50
            "
            aria-label="Tutup menu"
        >

            <i
                data-lucide="x"
                class="w-5 h-5"
            ></i>

        </button>

    </div>



    {{-- =====================================================
         MENU SISWA
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
             DASHBOARD
        ================================================== --}}

        <div class="sidebar-section">

            <a
                href="{{ route('student.dashboard') }}"
                title="Dashboard"
                class="
                    student-sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('student.dashboard')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >
                <i
                    data-lucide="layout-dashboard"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>Dashboard</span>
            </a>


            {{-- ABSENSI --}}

            <a
                href="{{ route('attendance.index') }}"
                title="Absensi"
                class="
                    student-sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('attendance.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >
                <i
                    data-lucide="clipboard-check"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>Absensi</span>
            </a>

        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="student-sidebar-divider"></div>


        {{-- =================================================
             DAFTAR PEMBELAJARAN
        ================================================== --}}

        @php

            $learningOpen =
                request()->routeIs('materials.*')
                ||
                request()->routeIs('videos.*')
                ||
                request()->routeIs('game.*');

        @endphp


        <div
            class="
                student-sidebar-section
                student-sidebar-dropdown
                {{ $learningOpen ? 'open' : '' }}
            "
            data-student-sidebar-dropdown="learning"
        >

            <button
                type="button"
                class="
                    student-sidebar-dropdown-button
                    {{ $learningOpen ? 'active' : '' }}
                "
                onclick="toggleStudentSidebarDropdown('learning')"
            >

                <i
                    data-lucide="book-open"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>Daftar Pembelajaran</span>

                <i
                    data-lucide="chevron-down"
                    class="student-sidebar-dropdown-chevron"
                ></i>

            </button>


            <div class="student-sidebar-dropdown-content">

                {{-- MATERI PEMBELAJARAN --}}

                <a
                    href="{{ route('materials.index') }}"
                    title="Materi Pembelajaran"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('materials.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="book-open-text"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Materi Pembelajaran</span>

                </a>


                {{-- VIDEO --}}

                <a
                    href="{{ route('videos.index') }}"
                    title="Video Pembelajaran"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('videos.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="play-circle"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Video</span>

                </a>


                {{-- GAME INTERAKTIF --}}

                <a
                    href="{{ route('game.index') }}"
                    title="Game Interaktif"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('game.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="gamepad-2"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Game Interaktif</span>

                </a>

            </div>

        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="student-sidebar-divider"></div>


        {{-- =================================================
             TUGAS SISWA
        ================================================== --}}

        @php

            $taskOpen =
                request()->routeIs('assignments.*')
                ||
                request()->routeIs('reflections.*')
                ||
                request()->routeIs('quiz.*')
                ||
                request()->routeIs('lkpd.*');

        @endphp


        <div
            class="
                student-sidebar-section
                student-sidebar-dropdown
                {{ $taskOpen ? 'open' : '' }}
            "
            data-student-sidebar-dropdown="tasks"
        >

            <button
                type="button"
                class="
                    student-sidebar-dropdown-button
                    {{ $taskOpen ? 'active' : '' }}
                "
                onclick="toggleStudentSidebarDropdown('tasks')"
            >

                <i
                    data-lucide="clipboard-list"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>Tugas Siswa</span>

                <i
                    data-lucide="chevron-down"
                    class="student-sidebar-dropdown-chevron"
                ></i>

            </button>


            <div class="student-sidebar-dropdown-content">

                {{-- PRAKTIK --}}

                <a
                    href="{{ route('assignments.index') }}"
                    title="Praktik"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('assignments.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="clipboard-pen-line"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Praktik</span>

                </a>


                {{-- REFLEKSI --}}

                <a
                    href="{{ route('reflections.index') }}"
                    title="Refleksi"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('reflections.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="message-square-heart"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Refleksi</span>

                </a>


                {{-- QUIZ --}}

                <a
                    href="{{ route('quiz.index') }}"
                    title="Quiz"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('quiz.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="help-circle"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>Quiz</span>

                </a>


                {{-- LKPD --}}

                <a
                    href="{{ route('lkpd.index') }}"
                    title="LKPD"
                    class="
                        student-sidebar-sub-link
                        {{ request()->routeIs('lkpd.*')
                            ? 'active'
                            : '' }}
                    "
                >

                    <i
                        data-lucide="file-check-2"
                        class="w-3.5 h-3.5"
                    ></i>

                    <span>LKPD</span>

                </a>

            </div>

        </div>


        {{-- =================================================
             PEMBATAS
        ================================================== --}}

        <div class="student-sidebar-divider"></div>


        {{-- =================================================
             RANKING SISWA
        ================================================== --}}

        <div class="sidebar-section">

            <a
                href="{{ route('student.ranking.index') }}"
                title="Ranking Siswa"
                class="
                    student-sidebar-link
                    flex
                    items-center
                    gap-3
                    px-3
                    py-2.5
                    rounded-xl
                    text-sm
                    {{ request()->routeIs('student.ranking.*')
                        ? 'active'
                        : 'text-slate-500' }}
                "
            >

                <i
                    data-lucide="trophy"
                    class="w-4 h-4 min-w-[16px]"
                ></i>

                <span>Ranking Siswa</span>

            </a>

        </div>


    </nav>



    {{-- =====================================================
         FOOTER / IDENTITAS
    ====================================================== --}}

    <div
        class="
            px-3
            pb-4
            pt-3
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


                <div>

                    <p
                        class="
                            text-sm
                            font-semibold
                            text-slate-800
                        "
                    >
                        Siswa
                    </p>

                    <p
                        class="
                            text-xs
                            text-slate-400
                        "
                    >
                        Peserta Didik
                    </p>

                </div>

            </div>

        </div>

    </div>

</aside>



{{-- =========================================================
     MOBILE MENU BUTTON
========================================================= --}}

<button
    id="studentMobileMenuButton"
    type="button"
    onclick="toggleStudentSidebar(true)"
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
    aria-label="Buka menu"
>

    <i
        data-lucide="menu"
        class="w-5 h-5"
    ></i>

</button>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

    function toggleStudentSidebarDropdown(name)
    {
        const dropdown =
            document.querySelector(
                '[data-student-sidebar-dropdown="' +
                name +
                '"]'
            );

        if (!dropdown) {
            return;
        }

        const currentlyOpen =
            dropdown.classList.contains('open');

        document
            .querySelectorAll(
                '#studentSidebar .student-sidebar-dropdown'
            )
            .forEach(
                function (item) {

                    item.classList.remove('open');

                }
            );

        if (!currentlyOpen) {

            dropdown.classList.add('open');

        }
    }


    function toggleStudentSidebar(open = null)
    {

        const sidebar =
            document.getElementById(
                'studentSidebar'
            );


        const overlay =
            document.getElementById(
                'studentSidebarOverlay'
            );


        if (!sidebar) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Desktop:
        | SIDEBAR SELALU FIX.
        |--------------------------------------------------------------------------
        */

        if (window.innerWidth >= 1024) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Mobile
        |--------------------------------------------------------------------------
        */

        const shouldOpen =
            open !== null
                ? open
                : !sidebar.classList.contains(
                    'mobile-open'
                );


        sidebar.classList.toggle(
            'mobile-open',
            shouldOpen
        );


        if (overlay) {

            overlay.classList.toggle(
                'mobile-visible',
                shouldOpen
            );

        }

    }


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