<x-guest-layout>
    <h1 class="text-3xl text-black pb-6">Data Pengumuman</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        NO
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Judul
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Keterangan
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($daftarPengumuman as $pengumuman)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $pengumuman->judul }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 flex-wrap font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <textarea readonly
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                cols="70" rows="10">{{ $pengumuman->keterangan }}</textarea>
                        </th>
                        <td class="px-6 py-4"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-guest-layout>
