<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login Guru — LARASKU</title>

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
        }

        .glass {
            background: rgba(255,255,255,.88);

            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);

            border:
                1px solid
                rgba(255,255,255,.9);

            box-shadow:
                0 30px 80px
                rgba(15,23,42,.10);
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

        <div class="w-full max-w-md">


            {{-- =====================================================
                 LOGO
            ====================================================== --}}

            <div class="text-center mb-8">

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
                        text-3xl
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
                        text-slate-500
                        mt-2
                    "
                >
                    Portal Pembelajaran
                </p>

            </div>



            {{-- =====================================================
                 LOGIN CARD
            ====================================================== --}}

            <section
                class="
                    glass
                    rounded-3xl
                    p-6
                    md:p-8
                "
            >

                <div class="mb-7">

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
                            mb-4
                        "
                    >

                        <i
                            data-lucide="shield-check"
                            class="w-3.5 h-3.5"
                        ></i>

                        Akses Guru

                    </div>


                    <h2
                        class="
                            text-2xl
                            font-black
                            text-slate-900
                        "
                    >
                        Selamat Datang
                    </h2>


                    <p
                        class="
                            text-sm
                            text-slate-500
                            mt-2
                            leading-relaxed
                        "
                    >
                        Masuk menggunakan username dan
                        password Guru.
                    </p>

                </div>



                {{-- =================================================
                     ERROR
                ================================================== --}}

                @if($errors->any())

                    <div
                        class="
                            mb-5
                            rounded-xl
                            border
                            border-red-200
                            bg-red-50
                            px-4
                            py-3
                            text-sm
                            text-red-700
                        "
                    >

                        <div
                            class="
                                flex
                                items-start
                                gap-2
                            "
                        >

                            <i
                                data-lucide="circle-alert"
                                class="w-4 h-4 mt-0.5 shrink-0"
                            ></i>


                            <div>

                                @foreach($errors->all() as $error)

                                    <p>
                                        {{ $error }}
                                    </p>

                                @endforeach

                            </div>

                        </div>

                    </div>

                @endif



                {{-- =================================================
                     FORM LOGIN
                ================================================== --}}

                <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="space-y-5"
                >

                    @csrf


                    {{-- USERNAME --}}

                    <div>

                        <label
                            for="username"
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Username
                        </label>


                        <div class="relative">

                            <i
                                data-lucide="user-round"
                                class="
                                    absolute
                                    left-4
                                    top-1/2
                                    -translate-y-1/2
                                    w-4
                                    h-4
                                    text-slate-400
                                "
                            ></i>


                            <input
                                id="username"
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                autocomplete="username"
                                required
                                autofocus
                                placeholder="Masukkan username"
                                class="
                                    w-full
                                    border
                                    border-slate-200
                                    rounded-xl
                                    pl-11
                                    pr-4
                                    py-3.5
                                    text-sm
                                    text-slate-700
                                    bg-white
                                    outline-none
                                    transition
                                    focus:border-blue-500
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >

                        </div>

                    </div>



                    {{-- PASSWORD --}}

                    <div>

                        <label
                            for="password"
                            class="
                                block
                                text-sm
                                font-bold
                                text-slate-700
                                mb-2
                            "
                        >
                            Password
                        </label>


                        <div class="relative">

                            <i
                                data-lucide="lock-keyhole"
                                class="
                                    absolute
                                    left-4
                                    top-1/2
                                    -translate-y-1/2
                                    w-4
                                    h-4
                                    text-slate-400
                                "
                            ></i>


                            <input
                                id="password"
                                type="password"
                                name="password"
                                autocomplete="current-password"
                                required
                                placeholder="Masukkan password"
                                class="
                                    w-full
                                    border
                                    border-slate-200
                                    rounded-xl
                                    pl-11
                                    pr-12
                                    py-3.5
                                    text-sm
                                    text-slate-700
                                    bg-white
                                    outline-none
                                    transition
                                    focus:border-blue-500
                                    focus:ring-4
                                    focus:ring-blue-100
                                "
                            >


                            <button
                                type="button"
                                id="togglePassword"
                                class="
                                    absolute
                                    right-3
                                    top-1/2
                                    -translate-y-1/2
                                    w-9
                                    h-9
                                    rounded-lg
                                    flex
                                    items-center
                                    justify-center
                                    text-slate-400
                                    hover:text-slate-700
                                    hover:bg-slate-50
                                "
                                title="Tampilkan password"
                            >

                                <i
                                    data-lucide="eye"
                                    class="w-4 h-4"
                                ></i>

                            </button>

                        </div>

                    </div>



                    {{-- SUBMIT --}}

                    <button
                        type="submit"
                        class="
                            w-full
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            px-5
                            py-3.5
                            rounded-xl
                            bg-blue-600
                            hover:bg-blue-700
                            text-white
                            text-sm
                            font-black
                            shadow-lg
                            shadow-blue-100
                            transition
                        "
                    >

                        <i
                            data-lucide="log-in"
                            class="w-4 h-4"
                        ></i>

                        Masuk sebagai Guru

                    </button>

                </form>



                {{-- =================================================
                     KEMBALI
                ================================================== --}}

                <div
                    class="
                        text-center
                        mt-6
                        pt-5
                        border-t
                        border-slate-100
                    "
                >

                    <a
                        href="{{ route('home') }}"
                        class="
                            inline-flex
                            items-center
                            gap-2
                            text-xs
                            font-bold
                            text-slate-500
                            hover:text-blue-600
                            transition
                        "
                    >

                        <i
                            data-lucide="arrow-left"
                            class="w-3.5 h-3.5"
                        ></i>

                        Kembali ke halaman utama

                    </a>

                </div>

            </section>



            <p
                class="
                    text-center
                    text-xs
                    text-slate-400
                    mt-6
                "
            >
                LARASKU • Portal Pembelajaran
            </p>

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


                const password =
                    document.getElementById(
                        'password'
                    );


                const toggle =
                    document.getElementById(
                        'togglePassword'
                    );


                if (
                    password &&
                    toggle
                ) {

                    toggle.addEventListener(
                        'click',
                        function () {

                            const isPassword =
                                password.type === 'password';


                            password.type =
                                isPassword
                                    ? 'text'
                                    : 'password';


                            toggle.innerHTML =
                                isPassword
                                    ? '<i data-lucide="eye-off" class="w-4 h-4"></i>'
                                    : '<i data-lucide="eye" class="w-4 h-4"></i>';


                            if (
                                typeof lucide !== 'undefined'
                            ) {

                                lucide.createIcons();

                            }

                        }
                    );

                }

            }
        );

    </script>


</body>

</html>