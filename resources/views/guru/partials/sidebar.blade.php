<style>

    /* =========================================================
       SIDEBAR GURU — FIXED PERMANENT
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

        z-index: 50;

        overflow: hidden;
    }


    /* =========================================================
       SIDEBAR LINK
    ========================================================== */

    .sidebar-link {
        transition:
            background .2s ease,
            color .2s ease;
    }


    .sidebar-link:hover {
        background: #f8fafc;
    }


    .sidebar-link.active {
        background: #eff6ff;
        color: #2563eb;
        font-weight: 600;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 1023px) {

        #guruSidebar {
            width: 220px;

            transform: translateX(-100%);

            transition:
                transform .25s ease;
        }


        #guruSidebar.mobile-open {
            transform: translateX(0);
        }

    }

</style>



{{-- =========================================================
     MOBILE OVERLAY
========================================================= --}}

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
========================================================= --}}

<aside
    id="guruSidebar"
    class="
        fixed
        inset-y-0
        left-0
        w-[220px]
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

{{-- =========================================================
     KELOLA KELAS
========================================================= --}}

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

        {{-- ABSENSI --}}

        <a
            href="{{ route('guru.attendance.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.attendance.index')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="clipboard-check"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Absensi
            </span>

        </a>



        {{-- REKAP ABSENSI --}}

        <a
            href="{{ route('guru.attendance.rekap') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.attendance.rekap')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="clipboard-list"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Rekap Absensi
            </span>

        </a>



        {{-- MATERI --}}

        <a
            href="{{ route('guru.materials.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.materials.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="book-open"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Materi
            </span>

        </a>



        {{-- TUGAS PENGUMPULAN --}}

        <a
            href="{{ route('guru.assignments.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.assignments.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="clipboard-pen-line"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Tugas
            </span>

        </a>


        {{-- VIDEO --}}

        <a
            href="{{ route('guru.videos.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.videos.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="play-circle"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Video
            </span>

        </a>

{{-- GAME INTERAKTIF --}}

        <a
            href="{{ route('guru.games.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.games.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="gamepad-2"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Game Interaktif
            </span>

        </a>


        {{-- QUIZ --}}

        <a
            href="{{ route('guru.quizzes.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.quizzes.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="help-circle"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Quiz
            </span>

        </a>


        {{-- REFLEKSI --}}

        <a
            href="{{ route('guru.reflections.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.reflections.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="message-square-heart"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                Refleksi
            </span>

        </a>



        {{-- LKPD --}}

        <a
            href="{{ route('guru.lkpd.index') }}"
            class="
                sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('guru.lkpd.*')
                    ? 'active'
                    : 'text-slate-500' }}
            "
        >

            <i
                data-lucide="file-check-2"
                class="w-4 h-4 min-w-[16px]"
            ></i>

            <span>
                LKPD
            </span>

        </a>
{{-- PERINGKAT --}}

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
========================================================= --}}

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