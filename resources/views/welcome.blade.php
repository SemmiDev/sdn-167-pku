<x-guest-layout>
    <div class="flex gap-5 flex-wrap">
        <a href="{{ route('guest.kekerasan.index') }}" class="bg-white text-black p-5 rounded-xl max-w-xl hover:bg-gray-50 gap-4 flex">
            <img src="{{ asset('storage/img/kekerasan.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Kekerasan</span>
                <span class="text-black font-semibold">
                    {{ session('totalDataKekerasan') }} Kasus
                </span>
            </div>
        </a>

        <a href="{{ route('guest.pengumuman.index') }}" class="bg-white text-black p-5 rounded-xl max-w-xl hover:bg-gray-50 gap-4 flex">
            <img src="{{ asset('storage/img/pengumuman.png') }}" alt="attendance"
                class="w-20 rounded-md shrink-0 object-cover">
            <div class="flex gal-3 flex-col">
                <span class="text-xl text-[#8894A0] break-all">Data Pengumuman</span>
                <span class="text-black font-semibold">
                    {{ session('totalPengumuman') }} Item
                </span>
            </div>
        </a>
    </div>

    <form action="{{ route('dashboard') }}" id="form-filter" method="GET">
        <div class="flex gap-5 mt-5 justify-end">
            <div class="flex flex-col gap-2">
                <select name="year" id="year" class="w-36 rounded-md border border-gray-300 p-2">
                    @php
                        $years = range(2001, date('Y'));
                        $years = array_reverse($years);
                        $selectedYear = request()->get('year', date('Y'));
                    @endphp
                    @foreach ($years as $year)
                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                            {{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <canvas id="myChart" width="400" height="150"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.getElementById('year').addEventListener('change', function() {
                document.getElementById('form-filter').submit();
            });

            // Ambil data JSON dari Blade template
            var dataKekerasan = JSON.parse(@json($statisticKekerasan));
            var dataPengaduan = JSON.parse(@json($statisticPengaduan));

            // Inisialisasi Canvas
            var ctx = document.getElementById('myChart').getContext('2d');

            // make bar chart

            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dataPengaduan.map(function(item) {
                        return item.bulan;
                    }),
                    datasets: [{
                        label: 'Kekerasan',
                        data: dataKekerasan.map(function(item) {
                            return item.total;
                        }),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        yAxisID: 'right-y-axis'
                    }, {
                        label: 'Pengaduan',
                        data: dataPengaduan.map(function(item) {
                            return item.total;
                        }),
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1,
                        yAxisID: 'left-y-axis'
                    }]
                },
                options: {
                    scales: {
                        'left-y-axis': {
                            type: 'linear',
                            position: 'left',
                            beginAtZero: true
                        },
                        'right-y-axis': {
                            type: 'linear',
                            position: 'right',
                            beginAtZero: true
                        },

                    }
                }
            });
        });
    </script>
</x-guest-layout>
