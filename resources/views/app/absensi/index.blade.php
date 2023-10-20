<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-3xl text-black pb-6">Data Absensi</h1>
        <div>
            <a href="{{ route('app.absensi.create') }}"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah
            </a>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <form method="GET" action="{{ route('app.absensi.index') }}" class="py-4 px-6">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal:</label>
                    <input type="date" name="tanggal" id="tanggal"
                    value="{{ request()->get('tanggal') }}"
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas:</label>
                    <select name="kelas" id="kelas"
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Kelas</option>
                        <option value="1"
                            {{ request()->get('kelas') == 1 ? 'selected' : '' }}>
                        1
                        </option>
                        <option value="2"
                            {{ request()->get('kelas') == 2 ? 'selected' : '' }}>
                        2</option>
                        <option value="3"
                            {{ request()->get('kelas') == 3 ? 'selected' : '' }}>
                        3</option>
                        <option value="4"
                            {{ request()->get('kelas') == 4 ? 'selected' : '' }}>
                        4</option>
                        <option value="5"
                            {{ request()->get('kelas') == 5 ? 'selected' : '' }}>
                        5</option>
                        <option value="6"
                            {{ request()->get('kelas') == 6 ? 'selected' : '' }}>
                        6</option>
                    </select>
                </div>
                <div>
                    <label for="komponen" class="block text-sm font-medium text-gray-700">Komponen:</label>
                    <select name="id_komponen" id="komponen"
                        class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Komponen</option>
                        @foreach ($daftarKomponen as $komponen)
                            <option
                            {{ request()->get('id_komponen') == $komponen->id ? 'selected' : '' }}
                            value="{{ $komponen->id }}">{{ $komponen->nama }}</option>
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
            </div>
            <div class="mt-4">
                <button type="submit"
                    class="bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Terapkan Filter
                </button>
            </div>
        </form>


        <div id="daftar-siswa">
            <form method="post" action="{{ route('app.absensi.update') }}">
                @csrf
                @method('PUT')
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($daftarAbsensi as $absensi)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text"
                                    class="hidden"
                                    name="siswa[]" value="{{ $absensi->id }}">

                                    <input
                                    type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    readonly value="{{ $absensi->siswa }}"
                                    >
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="status[]"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                        <option value="Hadir" @if ($absensi->status === 'Hadir') selected @endif>Hadir
                                        </option>
                                        <option value="Sakit" @if ($absensi->status === 'Sakit') selected @endif>Sakit
                                        </option>
                                        <option value="Izin" @if ($absensi->status === 'Izin') selected @endif>Izin
                                        </option>
                                        <option value="Alfa" @if ($absensi->status === 'Alfa') selected @endif>Alfa
                                        </option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="text" name="keterangan[]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    value="{{ $absensi->keterangan }}">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-center text-gray-500">
                                        Belum di absen
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if(count($daftarAbsensi) > 0)
                <button type="submit"
                    class="m-5 bg-blue-700 text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover-bg-blue-700 dark:focus:ring-blue-800">
                    Simpan Perubahan
                </button>
                @endif
            </form>
        </div>

    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var komponen = $('#komponen').val();
            if (komponen) {
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
                            if ({{ request()->get('id_atribut', 0) }} == value.id) {
                                atribut.append('<option value="' + value.id + '" selected>' + value.nama +
                                    '</option>');
                            } else {
                                atribut.append('<option value="' + value.id + '">' + value.nama +
                                    '</option>');
                            }
                        });
                    }
                });
            }
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
    </script>
</x-admin-layout>
