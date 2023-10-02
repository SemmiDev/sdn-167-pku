<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-3xl text-black pb-6">Data Kekerasan</h1>
        <div>
            <button data-modal-target="tambah-kekerasan-modal" data-modal-toggle="tambah-kekerasan-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah
            </button>
        </div>
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
                    <th scope="col" class="px-6 py-3 text-center">
                        Aksi
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
                        <td class="px-6 py-4 text-center">
                            <div class="flex gap-2 items-center justify-center">

                                <a href="{{ route('app.kekerasan.edit', $kekerasan->id) }}"
                                    class="edit-kekerasan w-20 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                                    Edit
                                </a>

                                <form action="{{ route('app.kekerasan.destroy', $kekerasan->id) }}" method="post"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-20 confirm-button focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="tambah-kekerasan-modal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="tambah-kekerasan-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="px-6 py-6 lg:px-8">
                        <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Masukkan Data Kekerasan</h3>
                        <form class="space-y-6" action="{{ route('app.kekerasan.store') }}" method="post">
                            @csrf
                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas</label>
                                <select name="kelas" id="kelas"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('kelas') ? 'border-red-500' : '' }}"
                                    required>
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    <option value="1" {{ old('kelas') == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('kelas') == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('kelas') == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('kelas') == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ old('kelas') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ old('kelas') == 6 ? 'selected' : '' }}>6</option>
                                </select>
                            </div>

                            <div>
                                <label for="siswa"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">siswa</label>
                                <select name="id_siswa" id="siswa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('siswa') ? 'border-red-500' : '' }}"
                                    required>
                                    <option value="" disabled selected>Pilih Siswa</option>
                                </select>
                            </div>

                            <div>
                                <label for="komponen"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Komponen</label>
                                <select name="id_komponen" id="komponen"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('komponen') ? 'border-red-500' : '' }}"
                                    required>
                                    <option value="" disabled selected>Pilih Komponen</option>
                                    @foreach ($daftarKomponen as $komponen)
                                        <option value="{{ $komponen->id }}">{{ $komponen->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="atribut"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atribut</label>
                                <select name="id_atribut" id="atribut"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('atribut') ? 'border-red-500' : '' }}"
                                    required>
                                    <option value="" disabled selected>Pilih atribut</option>
                                </select>
                            </div>

                            <div>
                                <label for="text"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                <textarea name="keterangan" id="keterangan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('keterangan') ? 'border-red-500' : '' }}"
                                    placeholder="Winner memukul kepala temannya "></textarea>
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#kelas').change(function() {
            var kelas = $(this).val();
            var url = "{{ route('app.ajax.daftar-siswa-by-kelas', ':kelas') }}";
            url = url.replace(':kelas', kelas);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    var siswa = $('#siswa');
                    siswa.empty();
                    siswa.append('<option value="" disabled selected>Pilih Siswa</option>');
                    $.each(data.data, function(index, value) {
                        siswa.append('<option value="' + value.id + '">' + value.nama +
                            '</option>');
                    });
                }
            });
        });

        $('#komponen').change(function() {
            var komponen = $(this).val();
            var url = "{{ route('app.ajax.daftar-atribut-by-komponen', ':komponen') }}";
            url = url.replace(':komponen', komponen);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    var atribut = $('#atribut');
                    atribut.empty();
                    atribut.append('<option value="" disabled selected>Pilih Atribut</option>');
                    $.each(data.data, function(index, value) {
                        atribut.append('<option value="' + value.id + '">' + value.nama +
                            '</option>');
                    });
                }
            });
        });

        $('.confirm-button').click(function(event) {
            var form = $(this).closest("form");
            event.preventDefault();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4F46E5',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
</x-admin-layout>
