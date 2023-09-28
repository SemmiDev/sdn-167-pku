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
        session()->put('totalGuru', $totalGuru);
        session()->put('totalSiswa', $totalSiswa);

        return $response;
    }
}
