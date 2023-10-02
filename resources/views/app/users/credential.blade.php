<x-admin-layout>
    <div id="alert-additional-content-4"
        class="p-4 mb-4 text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
        role="alert">
        <div class="flex items-center">
            <svg class="flex-shrink-0 w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <h3 class="text-lg font-medium">Perhatian</h3>
        </div>
        <div class="mt-2 mb-4 text-sm">Silahkan simpan data akun ini dengan aman. <b class="font-semibold">Password</b>
            tidak dapat dilihat kembali.
        </div>
        <div>
            <p id="email" class="font-normal text-gray-700 dark:text-gray-400">Email: <span class="font-semibold">
                    <code>
                        {{ $email }}
                    </code>
                </span>
            </p>
            <p id="password" class="font-normal text-gray-700 dark:text-gray-400">Password: <span
                    class="font-semibold">
                    <code>
                        {{ $password }}
                    </code>
                </span></p>
        </div>

        <div class="flex mt-3">
            <a href="{{ route('app.users.index') }}"
                class="text-white bg-yellow-800 hover:bg-yellow-900 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 text-center inline-flex items-center dark:bg-yellow-300 dark:text-gray-800 dark:hover:bg-yellow-400 dark:focus:ring-yellow-800">
                <svg class="-ml-0.5 mr-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 14">
                    <path
                        d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                </svg>
                Kembali
            </a>
        </div>
    </div>
</x-admin-layout>
