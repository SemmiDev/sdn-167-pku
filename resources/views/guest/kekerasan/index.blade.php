<x-guest-layout>
    <div class="flex justify-between">
        <h1 class="text-3xl text-black pb-6">Data Kekerasan</h1>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        NO
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Kelas
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Nama Siswa
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Komponen
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Atribut
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Keterangan
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($daftarKekerasan as $kekerasan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $kekerasan->kelas }}
                        </th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $kekerasan->nama_siswa }}
                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $kekerasan->nama_komponen }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $kekerasan->nama_atribut }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $kekerasan->keterangan }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-guest-layout>
