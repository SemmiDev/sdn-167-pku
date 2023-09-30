<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function pengumumanStatistic()
    {
        $pengumumanPerBulan = Pengumuman::selectRaw('DATE_FORMAT(created_at, "%m-%Y") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->get();

        $data = [];
        foreach ($pengumumanPerBulan as $pengumuman) {
            $data[] = [
                'bulan' => $pengumuman->bulan,
                'total' => $pengumuman->total
            ];
        }

        return response()->json([
            'data' => $data
        ]);
    }
}
