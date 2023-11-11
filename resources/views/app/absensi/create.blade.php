<x-admin-layout>
    <form class="space-y-6" action="{{ route('app.absensi.store') }}" method="post"
    enctype="multipart/form-data"
    >
        @csrf

        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Tambah Absensi</h1>

        <div>
            <label for="komponen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Komponen Kegiatan
                <span class="text-red-500">*</span>
            </label>
            <select name="id_komponen" id="komponen"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
            {{ $errors->has('komponen') ? 'border-red-500' : '' }}"
                required>
                <option value="" disabled selected>Pilih Komponen Kegiatan</option>
                @foreach ($daftarKomponen as $komponen)
                    <option value="{{ $komponen->id }}">{{ $komponen->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="atribut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kegiatan
                <span class="text-red-500">*</span>
            </label>
            <select name="id_atribut" id="atribut"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
            {{ $errors->has('atribut') ? 'border-red-500' : '' }}"
                required>
                <option value="" disabled selected>Pilih Jenis Kegiatan</option>
            </select>
        </div>

        <div>
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kelas
                <span class="text-red-500">*</span>
            </label>
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
            <label for="kegiatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kegiatan
                <span class="text-red-500">*</span>
            </label>
            <input type="text" name="kegiatan" id="kegiatan" required
                placeholder="Perayaan maulid nabi tahun {{ date('Y') }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
            {{ $errors->has('kegiatan') ? 'border-red-500' : '' }}"
                value="{{ old('kegiatan') }}">
        </div>

        <div>
            <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                Pelaksanaan
                <span class="text-red-500">*</span>
            </label>
            <input type="date" name="tanggal" id="tanggal"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
            {{ $errors->has('tanggal') ? 'border-red-500' : '' }}"
                value="{{ old('tanggal') ?? date('Y-m-d') }}" required>
        </div>

        <div>
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Guru Pembimbing
                <span class="text-red-500">*</span>
            </label>
            <select name="guru_pembimbing" id="guru_pembimbing"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
            {{ $errors->has('guru_pembimbing') ? 'border-red-500' : '' }}"
                required>
                @foreach ($daftarGuru as $guru)
                    <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="dokumentasi" class="block text-sm text-gray-500 dark:text-gray-300">Dokumentasi Kegiatan
                <span class="text-red-500">*</span>
            </label>
            <input type="file" name="dokumentasi[]" accept="image/png, image/jpeg, image/jpg" required multiple
                class="block w-full px-3 py-2 pl-5 mt-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg file:bg-gray-200 file:text-gray-700 file:text-sm file:px-4 file:py-1 file:border-none file:rounded-full placeholder-gray-400/70 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 " />
        </div>


        <div id="daftar-siswa">
        </div>

        <button type="submit"
            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Simpan
        </button>

    </form>
    <div>
        <script type="text/javascript">
            $('#kelas').change(function() {
                var kelas = $(this).val();
                var url = "{{ route('app.ajax.daftar-siswa-by-kelas', ':kelas') }}";
                url = url.replace(':kelas', kelas);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);

                        const daftarSiswa = data.data;
                        const daftarSiswaElement = $('#daftar-siswa');

                        daftarSiswaElement.empty();

                        $.each(daftarSiswa, function(index, value) {
                            // Buat div container dengan class "flex" dan "justify-between"
                            const container = $(
                                '<div class="flex items-center justify-between mb-2"></div>');

                            // Tambahkan input checkbox dengan Tailwind CSS
                            const checkbox = $(
                                '<input type="checkbox" checked name="siswa[]" value="' + value
                                .id + '" class="mr-2">');
                            container.append(checkbox);

                            // Buat div untuk nama siswa
                            const namaSiswaDiv = $('<div class="w-1/3">' + value.nama + '</div>');
                            container.append(namaSiswaDiv);

                            // Buat select dengan opsi menggunakan Tailwind CSS
                            const select = $(
                                '<select name="status[]" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/4 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></select>'
                            );
                            select.append('<option value="Hadir">Hadir</option>');
                            select.append('<option value="Sakit">Sakit</option>');
                            select.append('<option value="Izin">Izin</option>');
                            select.append('<option value="Alfa">Alfa</option>');
                            container.append(select);

                            // Tambahkan input teks untuk keterangan
                            const keteranganInput = $(
                                '<input type="text" name="keterangan[]" placeholder="Keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-1/4 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">'
                            );
                            container.append(keteranganInput);

                            // Tambahkan container ke daftarSiswaElement
                            daftarSiswaElement.append(container);
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
                        atribut.append('<option value="" disabled selected>Pilih Jenis Kegiatan</option>');
                        $.each(data.data, function(index, value) {
                            atribut.append('<option value="' + value.id + '">' + value.nama +
                                '</option>');
                        });
                    }
                });
            });
        </script>
</x-admin-layout>
