<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SummaryCountAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response =  $next($request);

        $totalGuru = \App\Models\Guru::count();
        $totalSiswa = \App\Models\Siswa::count();
        $totalUser = \App\Models\User::count();
        $totalKomponen = \App\Models\Komponen::count();
        $totalAtribut = \App\Models\Atribut::count();
        $totalPengumuman = \App\Models\Pengumuman::count();
        $totalKategoriPengaduan = \App\Models\KategoriPengaduan::count();

        session()->put('totalUser', $totalUser - 1);

        session()->put('totalGuru', $totalGuru);
        session()->put('totalSiswa', $totalSiswa);
        session()->put('totalKomponen', $totalKomponen);
        session()->put('totalAtribut', $totalAtribut);
        session()->put('totalPengumuman', $totalPengumuman);
        session()->put('totalKategoriPengaduan', $totalKategoriPengaduan);

        return $response;
    }
}
