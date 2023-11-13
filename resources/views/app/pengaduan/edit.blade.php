<x-admin-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('app.pengaduan.update', $pengaduan->id) }}"
          class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800 p-5">
        @csrf
        @method('PUT')

        <div class="flex justify-between items-center">
            <h1 class="text-3xl text-black mb-5">Detail Pengaduan</h1>
            @if($pengaduan->sanksi != null && $pengaduan->penyelesaian != null)
                @php
                   $message = "Kami telah menindaklanjuti pengaduan yang anda laporkan pada tanggal " . date('d F Y', strtotime($pengaduan->created_at)) . ". Berikut adalah hasil penindakan kami terhadap pengaduan anda:\n\nSanksi: " . $pengaduan->sanksi . "\n\nPenyelesaian: " . $pengaduan->penyelesaian . "\n\nTerima kasih telah menggunakan layanan pengaduan kami.";
                @endphp
                <a href="https://wa.me/{{ $pengaduan->wa }}?text={{ urlencode($message) }}"
                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-xl inline-flex items-center">
                    <img src="https://salonmobilextreme.com/wp-content/uploads/2015/02/WA-icon.png"
                         class="w-5 h-5 mr-2" alt="WA
                Logo">
                    <span class="mr-2">
                    Kirim Pesan
                </span>
                </a>
            @endif
        </div>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Pelapor</label>
            <input
                type="text" name="nama" placeholder="Ucup Sirucup" id="nama"
                readonly
                value="{{ $pengaduan->nama }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                autofocus
                required>
        </div>

        <div class="mb-6">
            <label for="wa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No Telepon</label>
            <input type="tel" name="wa" placeholder="082387325991" id="wa"
                   readonly
                   value="{{ $pengaduan->wa }}"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
            <select name="id_kategori" id="kategori"
                    readonly
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('id_kategori') ? 'border-red-500' : '' }}"
                    required>
                <option value="" disabled selected>Pilih Kategori / Jenis Pengaduan</option>
                @foreach ($daftarKategoriPengaduan as $kategori)
                    <option value="{{ $kategori->id }}"
                            @if ($kategori->id == $pengaduan->id_kategori)
                                selected
                        @endif
                    >{{ $kategori->kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="text"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan dan Kronologis
                Kejadian</label>
            <textarea name="keterangan" cols="30" rows="5" id="keterangan"
                      readonly
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('keterangan') ? 'border-red-500' : '' }}"
                      placeholder="Naufal Abdurahman Madani kelas 6 melakukan kekerasan terhadap anak saya"
                      required>{{ $pengaduan->keterangan }}</textarea>
        </div>

        @php
            date_default_timezone_set('Asia/Jakarta');
        @endphp

        <div class="mb-6">
            <label for="tanggal_kejadian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                Kejadian</label>
            <input type="date"
                   value="{{ $pengaduan->tanggal_kejadian }}"
                   readonly
                   name="tanggal_kejadian" placeholder="Ucup Sirucup" id="tanggal_kejadian"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jam Kejadian</label>
            <input type="time"
                   value="{{ $pengaduan->jam_kejadian }}"
                   readonly
                   name="jam_kejadian" placeholder="Ucup Sirucup" id="jam_kejadian"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                   required>
        </div>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bukti
                Kejadian</label>
            <img src="{{ asset('storage/pengaduan/' . $pengaduan->foto) }}" alt="foto"
                 class="w-full h-72 object-cover rounded-xl enlarge-image"
                 data-src="{{ asset('storage/pengaduan/' . $pengaduan->foto) }}">
        </div>

        <h1 class="text-3xl text-black mb-5">Bentuk Penyelesaian</h1>

        <div class="mb-6">
            <label for="text"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sanksi</label>
            <textarea name="sanksi" cols="30" rows="5" id="sanksi"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('sanksi') ? 'border-red-500' : '' }}"
                      required>{{ $pengaduan->sanksi }}</textarea>
        </div>

        <div class="mb-6">
            <label for="text"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyelesaian</label>
            <textarea name="penyelesaian" cols="30" rows="5" id="penyelesaian"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('penyelesaian') ? 'border-red-500' : '' }}"
                      required>{{ $pengaduan->penyelesaian }}</textarea>
        </div>

        <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Simpan Perubahan
        </button>
    </form>
</x-admin-layout>
