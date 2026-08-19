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
    "
>

    <div>

        <p
            class="
                text-xs
                text-slate-400
            "
        >
            Panel Guru
        </p>

        <h2
            class="
                font-bold
                text-slate-900
            "
        >
            {{ $pageTitle ?? 'Dashboard' }}
        </h2>

    </div>


    <div class="flex items-center gap-3">

        <span
            class="
                hidden
                sm:block
                text-xs
                font-semibold
                text-slate-500
            "
        >
            {{ auth()->user()->name ?? 'Guru' }}
        </span>


        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="
                    inline-flex
                    items-center
                    justify-center
                    gap-2
                    h-10
                    px-3
                    rounded-xl
                    border
                    border-red-200
                    bg-white
                    text-red-600
                    hover:bg-red-50
                    hover:border-red-300
                    transition
                    text-xs
                    font-bold
                "
                title="Logout"
            >

                <i
                    data-lucide="log-out"
                    class="w-4 h-4"
                ></i>

                <span class="hidden sm:inline">
                    Logout
                </span>

            </button>

        </form>

    </div>

</header>