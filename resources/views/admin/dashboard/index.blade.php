<x-admin-layout>
    <div class="flex gap-5 flex-wrap">
        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/wisuda.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Kehadiran</span>
                <span class="text-black font-semibold">180.000</span>
            </div>
        </div>

        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/wisuda-merah.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Ketidakhadiran</span>
                <span class="text-black font-semibold">180.000</span>
            </div>
        </div>

        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/wisuda.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Pelanggaran</span>
                <span class="text-black font-semibold">180.000</span>
            </div>
        </div>

        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/kekerasan.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Kekerasan</span>
                <span class="text-black font-semibold">180.000</span>
            </div>
        </div>

        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/pengaduan.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Pengaduan</span>
                <span class="text-black font-semibold">180.000</span>
            </div>
        </div>

        <div class="bg-white text-black p-5 rounded-xl w-64 gap-4 flex">
            <img src="{{ asset('storage/img/pengumuman.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Pengumuman</span>
                <span class="text-black font-semibold">
                    {{ session('totalPengumuman') }}
                </span>
            </div>
        </div>
    </div>


    <div class="bg-white rounded-xl p-5 mt-5">
        <div class="w-full h-96">
            <canvas id="myChart" style="width: 400px; height: 400px;">
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            // Request data pengumuman per bulan
            $.get("{{ route('admin.dashboard.pengumuman-statistics') }}", function(data) {
                // Buat data series
                const series = [{
                    data: data.data,
                    name: 'Pengumuman',
                }];

                // Buat konfigurasi grafik
                const config = {
                    type: 'line',
                    data: {
                        series: series
                    },
                    options: {
                        title: 'Grafik Pengumuman',
                        xaxis: {
                            categories: data.data.map(item => item.bulan)
                        },
                        yaxis: {
                            title: 'Jumlah Pengumuman'
                        }
                    }
                };

                // Tampilkan grafik
                new Chart(document.querySelector('#myChart'), config);
            });
        });
    </script>
</x-admin-layout>
