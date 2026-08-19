<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LKPD — LARASKU</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            color: #172033;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .main-content {
            min-height: 100vh;
        }

        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0 !important;
            }
        }
    </style>
</head>


<body>

<div class="min-h-screen">

    @include('guru.partials.sidebar')


    {{-- =====================================================
         MAIN
    ====================================================== --}}

    <main
        class="main-content lg:ml-64 transition-all duration-300"
    >


        {{-- =====================================================
             HEADBAR GURU
        ====================================================== --}}

        @include('guru.partials.header')


        <div
            class="p-5 lg:p-8 max-w-[1200px] mx-auto"
        >
            {{-- HEADER --}}
            <section class="mb-7">

                <div class="mb-2">

                    <span
                        class="inline-flex items-center gap-2
                               text-xs font-semibold text-blue-600
                               bg-blue-50 px-3 py-1.5 rounded-full"
                    >

                        <i
                            data-lucide="clipboard-list"
                            class="w-3.5 h-3.5"
                        ></i>

                        Panel Guru

                    </span>

                </div>


                <div
                    class="flex flex-col lg:flex-row
                           lg:items-end lg:justify-between gap-4"
                >

                    <div>

                        <h1
                            class="text-3xl font-bold text-slate-900"
                        >
                            LKPD
                        </h1>

                        <p class="text-sm text-slate-500 mt-2">
                            Kelola LKPD, soal, dan penilaian siswa.
                        </p>

                    </div>


                    <a
                        href="{{ route('guru.lkpd.create') }}"
                        class="inline-flex items-center justify-center
                               gap-2 px-5 py-3 rounded-xl
                               bg-slate-900 hover:bg-slate-800
                               text-white text-sm font-bold
                               transition"
                    >

                        <i
                            data-lucide="plus"
                            class="w-4 h-4"
                        ></i>

                        Buat LKPD

                    </a>

                </div>

            </section>


            {{-- FLASH MESSAGE --}}
            @if(session('success'))

                <div
                    class="mb-6 px-4 py-3 rounded-xl
                           border border-emerald-200
                           bg-emerald-50 text-emerald-700
                           text-sm font-semibold"
                >
                    {{ session('success') }}
                </div>

            @endif


            @if(session('error'))

                <div
                    class="mb-6 px-4 py-3 rounded-xl
                           border border-red-200
                           bg-red-50 text-red-700
                           text-sm font-semibold"
                >
                    {{ session('error') }}
                </div>

            @endif


            {{-- FILTER --}}
            <section
                class="bg-white border border-slate-200
                       rounded-2xl p-5 mb-6 shadow-sm"
            >

                <form
                    action="{{ route('guru.lkpd.index') }}"
                    method="GET"
                >

                    <div
                        class="grid grid-cols-1 md:grid-cols-4
                               gap-4 items-end"
                    >

                        {{-- KELAS --}}
                        <div>

                            <label
                                class="block text-xs font-semibold
                                       text-slate-600 mb-2"
                            >
                                Kelas
                            </label>

                            <select
                                name="kelas"
                                class="w-full h-[43px] px-3
                                       border border-slate-200
                                       rounded-xl bg-white
                                       text-sm outline-none
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >

                                <option value="">
                                    Semua Kelas
                                </option>

                                @foreach($classes as $class)

                                    <option
                                        value="{{ $class }}"
                                        {{ ($kelas ?? '') == $class ? 'selected' : '' }}
                                    >
                                        {{ $class }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- PERTEMUAN --}}
                        <div>

                            <label
                                class="block text-xs font-semibold
                                       text-slate-600 mb-2"
                            >
                                Pertemuan
                            </label>

                            <select
                                name="pertemuan"
                                class="w-full h-[43px] px-3
                                       border border-slate-200
                                       rounded-xl bg-white
                                       text-sm outline-none
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >

                                <option value="">
                                    Semua Pertemuan
                                </option>

                                @foreach($pertemuans as $item)

                                    <option
                                        value="{{ $item }}"
                                        {{ (string)($pertemuan ?? '') === (string)$item ? 'selected' : '' }}
                                    >
                                        Pertemuan {{ $item }}
                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- STATUS --}}
                        <div>

                            <label
                                class="block text-xs font-semibold
                                       text-slate-600 mb-2"
                            >
                                Status Penilaian
                            </label>

                            <select
                                name="status"
                                class="w-full h-[43px] px-3
                                       border border-slate-200
                                       rounded-xl bg-white
                                       text-sm outline-none
                                       focus:border-blue-500
                                       focus:ring-4
                                       focus:ring-blue-100"
                            >

                                <option value="">
                                    Semua Status
                                </option>

                                <option
                                    value="dinilai"
                                    {{ ($status ?? '') === 'dinilai' ? 'selected' : '' }}
                                >
                                    Sudah Dinilai
                                </option>

                                <option
                                    value="belum_dinilai"
                                    {{ ($status ?? '') === 'belum_dinilai' ? 'selected' : '' }}
                                >
                                    Belum Dinilai
                                </option>

                            </select>

                        </div>


                        {{-- BUTTON --}}
                        <button
                            type="submit"
                            class="h-[43px] px-5 rounded-xl
                                   bg-slate-900 hover:bg-slate-800
                                   text-white text-sm font-semibold
                                   inline-flex items-center
                                   justify-center gap-2"
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


            {{-- SUMMARY --}}
            <div
                class="flex flex-wrap items-center
                       justify-between gap-3 mb-4"
            >

                <div class="text-sm text-slate-500">

                    Total LKPD:

                    <strong class="text-slate-900">
                        {{ $lkpds->count() }}
                    </strong>

                </div>

                <div class="text-xs text-slate-400">
                    LKPD berdiri sendiri berdasarkan pertemuan
                </div>

            </div>


            {{-- TABLE --}}
            <section
                class="bg-white border border-slate-200
                       rounded-2xl overflow-hidden shadow-sm"
            >

                @if($lkpds->count())

                    <div class="overflow-x-auto">

                        <table class="w-full min-w-[1050px]">

                            <thead>

                                <tr>

                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        No
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        LKPD
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        Pertemuan
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        Jenis Soal
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        Soal
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-left text-xs
                                               font-bold text-slate-500"
                                    >
                                        Status
                                    </th>


                                    <th
                                        class="px-5 py-4 bg-slate-50
                                               border-b border-slate-200
                                               text-right text-xs
                                               font-bold text-slate-500"
                                    >
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @foreach($lkpds as $index => $lkpd)

                                    @php

                                        $pgCount = $lkpd->questions
                                            ->where(
                                                'jenis',
                                                'pilihan_ganda'
                                            )
                                            ->count();

                                        $essayCount = $lkpd->questions
                                            ->where(
                                                'jenis',
                                                'essay'
                                            )
                                            ->count();

                                        $hasEssay = $essayCount > 0;

                                        $hasAnswers =
                                            $lkpd->answers->count() > 0;

                                        $essayAnswers = $lkpd->answers
                                            ->filter(
                                                fn ($answer) =>
                                                    $answer->question &&
                                                    $answer->question->jenis === 'essay'
                                            );

                                        $essayPending = $essayAnswers
                                            ->contains(
                                                fn ($answer) =>
                                                    $answer->nilai === null
                                            );

                                    @endphp


                                    <tr
                                        class="border-b border-slate-100
                                               last:border-0
                                               hover:bg-slate-50 transition"
                                    >

                                        {{-- NO --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="text-sm font-semibold
                                                       text-slate-400"
                                            >
                                                {{ $index + 1 }}
                                            </span>

                                        </td>


                                        {{-- LKPD --}}
                                        <td class="px-5 py-4">

                                            <div
                                                class="font-bold text-slate-900"
                                            >
                                                {{ $lkpd->judul }}
                                            </div>

                                            @if($lkpd->deskripsi)

                                                <div
                                                    class="mt-1 text-xs
                                                           text-slate-400
                                                           max-w-[320px]
                                                           truncate"
                                                >
                                                    {{ $lkpd->deskripsi }}
                                                </div>

                                            @endif

                                        </td>


                                        {{-- PERTEMUAN --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="inline-flex px-2.5 py-1.5
                                                       rounded-lg bg-blue-50
                                                       text-blue-600 text-xs
                                                       font-bold"
                                            >
                                                Pertemuan {{ $lkpd->pertemuan }}
                                            </span>

                                        </td>


                                        {{-- JENIS --}}
                                        <td class="px-5 py-4">

                                            <div class="flex flex-wrap gap-1.5">

                                                @if($pgCount > 0)

                                                    <span
                                                        class="inline-flex
                                                               items-center gap-1
                                                               px-2.5 py-1.5
                                                               rounded-lg
                                                               bg-violet-50
                                                               text-violet-700
                                                               text-xs font-bold"
                                                    >

                                                        <i
                                                            data-lucide="list-checks"
                                                            class="w-3.5 h-3.5"
                                                        ></i>

                                                        PG {{ $pgCount }}

                                                    </span>

                                                @endif


                                                @if($essayCount > 0)

                                                    <span
                                                        class="inline-flex
                                                               items-center gap-1
                                                               px-2.5 py-1.5
                                                               rounded-lg
                                                               bg-amber-50
                                                               text-amber-700
                                                               text-xs font-bold"
                                                    >

                                                        <i
                                                            data-lucide="file-pen-line"
                                                            class="w-3.5 h-3.5"
                                                        ></i>

                                                        Essay {{ $essayCount }}

                                                    </span>

                                                @endif

                                            </div>

                                        </td>


                                        {{-- JUMLAH SOAL --}}
                                        <td class="px-5 py-4">

                                            <span
                                                class="text-sm font-bold
                                                       text-slate-700"
                                            >
                                                {{ $lkpd->questions->count() }}
                                                soal
                                            </span>

                                        </td>


                                        {{-- STATUS --}}
                                        <td class="px-5 py-4">

                                            @if(!$hasAnswers)

                                                <span
                                                    class="inline-flex
                                                           items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-lg
                                                           bg-slate-100
                                                           text-slate-500
                                                           text-xs font-bold"
                                                >
                                                    Belum ada jawaban
                                                </span>

                                            @elseif($hasEssay && $essayPending)

                                                <span
                                                    class="inline-flex
                                                           items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-lg
                                                           bg-orange-50
                                                           text-orange-700
                                                           text-xs font-bold"
                                                >

                                                    <i
                                                        data-lucide="clock-3"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Menunggu Penilaian Essay

                                                </span>

                                            @else

                                                <span
                                                    class="inline-flex
                                                           items-center gap-1.5
                                                           px-3 py-2
                                                           rounded-lg
                                                           bg-emerald-50
                                                           text-emerald-700
                                                           text-xs font-bold"
                                                >

                                                    <i
                                                        data-lucide="circle-check"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Sudah Dinilai

                                                </span>

                                            @endif

                                        </td>


                                        {{-- AKSI --}}
                                        <td class="px-5 py-4">

                                            <div
                                                class="flex items-center
                                                       justify-end gap-2"
                                            >

                                                {{-- DETAIL --}}
                                                <a
                                                    href="{{ route('guru.lkpd.show', $lkpd) }}"
                                                    class="inline-flex items-center
                                                           justify-center gap-2
                                                           px-3 py-2 rounded-lg
                                                           bg-slate-900
                                                           hover:bg-slate-800
                                                           text-white text-xs
                                                           font-bold transition"
                                                >

                                                    <i
                                                        data-lucide="eye"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Detail

                                                </a>


                                                {{-- EDIT --}}
                                                <a
                                                    href="{{ route('guru.lkpd.edit', $lkpd) }}"
                                                    class="inline-flex items-center
                                                           justify-center gap-2
                                                           px-3 py-2 rounded-lg
                                                           bg-blue-50
                                                           hover:bg-blue-100
                                                           text-blue-600
                                                           text-xs font-bold
                                                           transition"
                                                >

                                                    <i
                                                        data-lucide="pencil"
                                                        class="w-3.5 h-3.5"
                                                    ></i>

                                                    Edit

                                                </a>


                                                {{-- HAPUS --}}
                                                <form
                                                    action="{{ route('guru.lkpd.destroy', $lkpd) }}"
                                                    method="POST"
                                                    class="inline"
                                                    onsubmit="return confirm(
                                                        'Hapus LKPD Pertemuan {{ $lkpd->pertemuan }}?\n\nSemua soal dan jawaban siswa yang terkait akan ikut dihapus jika relasinya menggunakan cascade.\n\nTindakan ini tidak dapat dibatalkan.'
                                                    )"
                                                >

                                                    @csrf

                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="inline-flex items-center
                                                               justify-center gap-2
                                                               px-3 py-2 rounded-lg
                                                               bg-red-50
                                                               hover:bg-red-100
                                                               text-red-600
                                                               text-xs font-bold
                                                               transition"
                                                    >

                                                        <i
                                                            data-lucide="trash-2"
                                                            class="w-3.5 h-3.5"
                                                        ></i>

                                                        Hapus

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                @else

                    <div class="px-5 py-16 text-center">

                        <div
                            class="w-14 h-14 mx-auto rounded-2xl
                                   bg-slate-100 flex items-center
                                   justify-center mb-4"
                        >

                            <i
                                data-lucide="clipboard-list"
                                class="w-6 h-6 text-slate-400"
                            ></i>

                        </div>


                        <div
                            class="text-base font-bold text-slate-700"
                        >
                            Belum ada LKPD
                        </div>


                        <div
                            class="text-sm text-slate-400 mt-1"
                        >
                            Buat LKPD pertama untuk memulai.
                        </div>


                        <a
                            href="{{ route('guru.lkpd.create') }}"
                            class="inline-flex items-center gap-2
                                   mt-5 px-4 py-2.5 rounded-xl
                                   bg-slate-900 text-white
                                   text-sm font-bold"
                        >

                            <i
                                data-lucide="plus"
                                class="w-4 h-4"
                            ></i>

                            Buat LKPD

                        </a>

                    </div>

                @endif

            </section>

        </div>

    </main>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

});

</script>

</body>
</html>