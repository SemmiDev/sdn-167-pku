<x-admin-layout>
    <form class="space-y-6 max-w-4xl mx-auto" action="{{route('admin.kekerasan.update', ['kekerasan' => $kekerasan->id])}}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="siswa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Siswa</label>
            <select name="id_siswa" id="siswa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('siswa') ? 'border-red-500' : '' }}" required>
                <option value="" disabled selected>Pilih Siswa</option>
                @foreach($daftarSiswa as $siswa)
                    <option value="{{ $siswa->id }}"
                    {{ $siswa->id == $kekerasan->id_siswa ? 'selected' : '' }}
                    >{{ $siswa->nama }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="atribut"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Atribut</label>
            <select name="id_atribut" id="atribut" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('atribut') ? 'border-red-500' : '' }}" required>
                <option value="" disabled selected>Pilih atribut</option>
                @foreach($daftarAtribut as $atribut)
                    <option
                        value="{{ $atribut->id }}"
                        {{ $atribut->id == $kekerasan->id_atribut ? 'selected' : '' }}>
                        {{ $atribut->nama . ' (' . $atribut->nama_komponen . ')' }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
            <textarea name="keterangan" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('keterangan') ? 'border-red-500' : '' }}" placeholder="Winner memukul kepala temannya">{{ $kekerasan->keterangan }}</textarea>
        </div>

        <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Simpan Perubahan
        </button>
    </form>

</x-admin-layout>
