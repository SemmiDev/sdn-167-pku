<x-guest-layout>
    <form method="POST" enctype="multipart/form-data" action="{{ route('guest.pengaduan.store') }}"
        class="max-w-2xl mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800 p-5">
        @csrf

        <h1 class="text-3xl text-black pb-6">Form Pengaduan</h1>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                Pengadu</label>
            <input type="text" name="nama" placeholder="Ucup" id="nama"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required>
        </div>

        <div class="mb-6">
            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
            <select name="id_kategori" id="kategori"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white {{ $errors->has('id_kategori') ? 'border-red-500' : '' }}"
                required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($daftarKategoriPengaduan as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label for="text"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
            <textarea name="keterangan" cols="30" rows="5" id="keterangan"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                {{ $errors->has('keterangan') ? 'border-red-500' : '' }}"
                placeholder="Naufal Abdurahman Madani kelas 6 melakukan kekerasan terhadap anak saya" required></textarea>
        </div>

        <div class="flex items-center justify-center w-full mb-5">
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <img id="image-preview" src="" alt="Image Preview"
                    style="display: none; max-width: 100%; max-height: 100%;">
                <div id="zone" class="flex flex-col items-center justify-center pt-6 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Tekan untuk
                            upload</span>
                        atau seret file ke sini</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG atau JPG</p>
                </div>
                <input id="dropzone-file" name="foto" accept="image/png, image/jpeg" type="file" class="hidden" />
            </label>
        </div>

        <a href="{{ route('guest.pengaduan.index') }}"
            class="text-white bg-gray-400 hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Kembali</a>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Kirim Pengaduan
        </button>
    </form>

    <script>
        function handleFileInputChange(input) {
            const file = input.files[0];
            const preview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Show the preview image
                };
                reader.readAsDataURL(file);

                // hidden the id zone
                const zone = document.getElementById('zone');
                zone.style.display = 'none';
            } else {
                // Clear the preview when no file is selected
                preview.src = '';
                preview.style.display = 'none'; // Hide the preview image
            }
        }

        // Attach an event listener to the file input
        const fileInput = document.getElementById('dropzone-file');
        fileInput.addEventListener('change', function() {
            handleFileInputChange(this);
        });
    </script>
</x-guest-layout>
