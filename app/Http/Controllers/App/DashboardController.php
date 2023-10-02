<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Kekerasan;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year', date('Y'));

        $kekerasanPerBulan = Kekerasan::selectRaw('DATE_FORMAT(created_at, "%m-%Y") as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->get();

        $pengaduanPerBulan = Pengaduan::selectRaw('DATE_FORMAT(created_at, "%m-%Y") as bulan, COUNT(*) as total')
            ->whereYear('created_at', $year)
            ->groupBy('bulan')
            ->get();

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = date('m-Y', mktime(0, 0, 0, $i, 1, $year));
        }

        $statisticKekerasan = [];
        $statisticPengaduan = [];
        foreach ($months as $month) {
            $statisticKekerasan[] = [
                'bulan' => $month,
                'total' => $kekerasanPerBulan->where('bulan', $month)->first()->total ?? 0,
            ];

            $statisticPengaduan[] = [
                'bulan' => $month,
                'total' => $pengaduanPerBulan->where('bulan', $month)->first()->total ?? 0,
            ];
        }

        $data = [
            'statisticKekerasan' => json_encode($statisticKekerasan),
            'statisticPengaduan' => json_encode($statisticPengaduan),
        ];

        return view('app.dashboard.index')->with($data);
    }
}
