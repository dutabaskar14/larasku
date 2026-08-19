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


        {{-- DASHBOARD --}}

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

            <span>
                Dashboard
            </span>

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

            <span>
                Absensi
            </span>

        </a>

        {{-- MATERI PEMBELAJARAN --}}

<a
    href="{{ route('materials.index') }}"
    title="Materi Pembelajaran"
    class="
        student-sidebar-link
        flex
        items-center
        gap-3
        px-3
        py-2.5
        rounded-xl
        text-sm
        {{ request()->routeIs('materials.*')
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



        {{-- VIDEO --}}

        <a
            href="{{ route('videos.index') }}"
            title="Video Pembelajaran"
            class="
                student-sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('videos.*')
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



        {{-- QUIZ --}}

        <a
            href="{{ route('quiz.index') }}"
            title="Quiz"
            class="
                student-sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('quiz.*')
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



        {{-- GAME INTERAKTIF --}}

        <a
            href="{{ route('game.index') }}"
            title="Game Interaktif"
            class="
                student-sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('game.*')
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



        {{-- REFLEKSI --}}

        <a
            href="{{ route('reflections.index') }}"
            title="Refleksi"
            class="
                student-sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('reflections.*')
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
            href="{{ route('lkpd.index') }}"
            title="LKPD"
            class="
                student-sidebar-link
                flex
                items-center
                gap-3
                px-3
                py-2.5
                rounded-xl
                text-sm
                {{ request()->routeIs('lkpd.*')
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