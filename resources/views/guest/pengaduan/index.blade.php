<x-guest-layout>
    <div class="flex justify-between">
        <div>
            <h1 class="text-3xl text-black pb-6">Data Pengaduan</h1>

        </div>
        <div>
            <a href="{{ route('guest.pengaduan.create') }}"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Tambah
            </a>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Foto
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Nama Pelapor
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Kategori
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Kronologis
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Tanggal Kejadian
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($daftarPengaduan as $pengaduan)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            @if (str_contains($pengaduan->foto, 'http'))
                                <img src="{{ $pengaduan->foto }}" alt="foto"
                                    class="w-48 h-48 object-cover rounded-xl enlarge-image"
                                    data-src="{{ asset('storage/pengaduan/' . $pengaduan->foto) }}">
                            @else
                                <img src="{{ asset('storage/pengaduan/' . $pengaduan->foto) }}" alt="foto"
                                    class="w-48 h-48 object-cover rounded-xl enlarge-image"
                                    data-src="{{ asset('storage/pengaduan/' . $pengaduan->foto) }}">
                            @endif

                        </th>
                        <td class="px-6 py-4 text-center">
                            {{ $pengaduan->nama }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span
                                class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">
                                {{ $pengaduan->kategori_pengaduan->kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pengaduan->keterangan }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            {{ $pengaduan->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div>
                                {{ $pengaduan->status }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="image-modal"
        class="fixed top-0 left-0 w-full h-full flex items-center justify-center z-50 bg-black bg-opacity-80 hidden">
        <div id="image-container" class="relative max-w-screen-xl mx-auto">
            <img id="modal-image" src="" alt="Enlarged Image" class="max-h-full max-w-full">
        </div>
    </div>

    <script type="text/javascript">
        document.addEventListener("change", function(e) {
            if (e.target && e.target.id == "status") {
                const form = e.target.closest("form");
                form.submit();
            }
        });

        // JavaScript to open the lightbox when an image is clicked
        document.addEventListener("click", function(e) {
            if (e.target && e.target.classList.contains("enlarge-image")) {
                const imageSrc = e.target.src;
                const modalImage = document.getElementById("modal-image");
                modalImage.src = imageSrc;

                const imageModal = document.getElementById("image-modal");
                imageModal.style.display = "flex";
            }
        });

        // JavaScript to close the lightbox when the close button is clicked
        document.addEventListener("click", function(e) {
            if (e.target && e.target.id == "modal-image") {
                const imageModal = document.getElementById("image-modal");
                imageModal.style.display = "none";
            }
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
