<x-admin-layout>
    <div
        class="mx-auto max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Akun Berhasil Dibuat</h5>

        <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
             role="alert">
            <span class="font-medium">Peringatan</span> Silahkan simpan data akun ini dengan aman. <b
                class="font-semibold">Password</b> tidak dapat dilihat kembali.
        </div>

        <div class="mb-5">
            <p id="email" class="mb-3 font-normal text-gray-700 dark:text-gray-400">Email: <span
                    class="font-semibold">{{$email}}</span></p>
            <p id="password" class="mb-3 font-normal text-gray-700 dark:text-gray-400">Password: <span
                    class="font-semibold">{{$password}}</span></p>
        </div>
    </div>
</x-admin-layout>
