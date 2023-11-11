<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Admin') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        @include('sweetalert::alert')

        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <div class="px-3 py-3 lg:px-5 lg:pl-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-[#F2F7FF] focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                            <span class="sr-only">Open sidebar</span>
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <a class="flex ml-2 md:mr-24">
                            <img class="w-8 h-8 md:mr-3" src="{{ asset('storage/img/logo.png') }}" alt="Flowbite logo">
                            <span
                                class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SDN
                                167 Pekanbaru</span>
                        </a>
                    </div>
                    <div class="flex items-center">
                        <div class="flex items-center ml-3">
                            <div class="flex items-center gap-2">
                                <button type="button"
                                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                                    aria-expanded="false" data-dropdown-toggle="dropdown-user">
                                    <span class="sr-only">Open user menu</span>
                                    <img class="w-12 h-12 rounded-full"
                                        src="https://imgix3.ruangguru.com/assets/avatar/avatar_default_id.png?w=360"
                                        alt="user photo">
                                </button>
                            </div>
                            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                                id="dropdown-user">
                                <div class="px-4 py-3" role="none">
                                    <p class="text-gray-900 dark:text-white" role="none">
                                        {{ auth()->user()->name }}
                                    </p>
                                    <p class="font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                        {{ auth()->user()->email }}
                                    </p>
                                </div>
                                <ul class="py-1" role="none">
                                    <li>
                                        <a href="{{ route('profile.edit') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-[#F2F7FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                            role="menuitem">Profil Pengguna</a>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit"
                                                class="block px-4 py-2 text-gray-700 hover:bg-[#F2F7FF] dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                                role="menuitem">Keluar
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <aside id="logo-sidebar"
            class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Sidebar">
            <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
                <ul class="space-y-2 font-medium">
                    <li>
                        <a href="{{ route('app.dashboard') }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.dashboard') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 21 21">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path d="M9 4.025A7.5 7.5 0 1 0 16.975 12H9V4.025Z" />
                                    <path
                                        d="M12.5 1c-.169 0-.334.014-.5.025V9h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 12.5 1Z" />
                                </g>
                            </svg>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    @hasanyrole('OPERATOR_SEKOLAH')
                        <li>
                            <a href="{{ route('app.guru.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.guru.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                    ">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M14 3a3 3 0 1 1-1.614 5.53M15 12a4 4 0 0 1 4 4v1h-3.348M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM5 11h3a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Guru</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalGuru', 0) }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.siswa.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.siswa.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                    ">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Siswa</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalSiswa', 0) }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.users.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.users.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                    ">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4.109 17H1v-2a4 4 0 0 1 4-4h.87M10 4.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm7.95 2.55a2 2 0 0 1 0 2.829l-6.364 6.364-3.536.707.707-3.536 6.364-6.364a2 2 0 0 1 2.829 0Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Akun Pengguna</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalUser', 0) }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.komponen.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.komponen.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 5h6M9 8h6m-6 3h6M4.996 5h.01m-.01 3h.01m-.01 3h.01M2 1h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Komponen Kegiatan</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalKomponen', 0) }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.atribut.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.atribut.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1m6 0v3H6V2M5 5h8m-8 5h8m-8 4h8" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Jenis kegiatan</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalAtribut', 0) }}
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('app.pengumuman.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.pengumuman.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 21">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m9.046 3.59-.435-2.324m.435 2.324a5.338 5.338 0 0 1 6.033 4.333l.331 1.77c.439 2.344 2.383 2.587 2.599 3.76.11.586.22 1.171-.309 1.271L5 17.101c-.529.1-.639-.488-.749-1.074-.219-1.172 1.506-2.102 1.067-4.447l-.331-1.769a5.338 5.338 0 0 1 4.059-6.22Zm-7.13 4.602a8.472 8.472 0 0 1 2.17-5.048m2.646 13.633A3.472 3.472 0 0 0 13.46 16l.089-.5-6.817 1.277Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Pengumuman</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalPengumuman', 0) }}
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('app.kategori-pengaduan.index') }}"
                                class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-[#F2F7FF] dark:hover:bg-gray-700 group
                    {{ request()->routeIs('app.kategori-pengaduan.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                       ">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 19">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M19.287 5H15m3.852 3H15m3.384 3H15m-9.47-.764h-.972A14.755 14.755 0 0 1 4.445 8c-.019-.747.019-1.494.113-2.236h.972a.95.95 0 0 0 .946-.856l.188-1.877a.951.951 0 0 0-.946-1.046H3.791a1.127 1.127 0 0 0-1.067.75A16.11 16.11 0 0 0 2 8a16.737 16.737 0 0 0 .743 5.242c.154.463 1.255.773 1.743.773h1.232a.95.95 0 0 0 .946-1.046l-.188-1.877a.95.95 0 0 0-.946-.856ZM19.063 2H10v12h8.273l1.716-10.847A.981.981 0 0 0 19.063 2ZM20 18H9v-2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v2Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Kategori Pengaduan</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalKategoriPengaduan', 0) }}
                                </span>
                            </a>
                        </li>
                    @endhasanyrole
                </ul>
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    @hasanyrole('GURU_PEMBIMBING')
                    <li>
                        <a href="{{ route('app.absensi.index') }}"
                            class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-[#F2F7FF] dark:hover:bg-gray-700 dark:text-white group
                    {{ request()->routeIs('app.absensi.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 22 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 10a28.076 28.076 0 0 1-1.091 9M6.231 2.37a8.994 8.994 0 0 1 12.88 3.73M1.958 13S2 12.577 2 10a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088c.281.706.426 1.46.425 2.22a30 30 0 0 1-.464 6.231M5 10a6 6 0 0 1 9.352-4.974M3 19a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M6.5 17.336C8 15.092 8 12.846 8 10a3 3 0 1 1 6 0c0 .75 0 1.521-.031 2.311M11 10.001c0 3 0 6-2 9" />
                            </svg>
                            <span class="ml-3">Data Absensi</span>
                        </a>
                    </li>
                    @endhasanyrole

                    @hasanyrole('GURU_BK')
                        <li>
                            <a href="{{ route('app.kekerasan.index') }}"
                                class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-[#F2F7FF] dark:hover:bg-gray-700 dark:text-white group
                    {{ request()->routeIs('app.kekerasan.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}
                            ">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m13 7-6 6m0-6 6 6m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Data Kekerasan</span>
                                <span
                                    class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    {{ session('totalDataKekerasan', 0) }}
                                </span>
                            </a>
                        </li>
                    @endhasanyrole

                    @hasanyrole('GURU_BK|OPERATOR_SEKOLAH')
                    <li>
                        <a href="{{ route('app.pengaduan.index') }}"
                            class="flex items-center p-2 text-gray-900 transition duration-75 rounded-lg hover:bg-[#F2F7FF] dark:hover:bg-gray-700 dark:text-white group
                    {{ request()->routeIs('app.pengaduan.*') ? 'bg-[#F2F7FF] dark:bg-gray-700' : '' }}">
                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 17V2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M5 15V1m8 18v-4" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Data Pengaduan</span>
                            <span
                                class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ session('totalDataPengaduan', 0) }}
                            </span>
                        </a>
                    </li>
                    @endhasanyrole
                </ul>
            </div>
        </aside>

        <div class="p-4 sm:ml-64 bg-[#F2F7FF] min-h-screen">
            <div class="p-4 border-dashed rounded-lg dark:border-gray-700">
                {{ $slot }}
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
