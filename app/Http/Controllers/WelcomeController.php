<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Kekerasan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class WelcomeController extends Controller
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

        return view('welcome')->with($data);
    }


    public function pengaduanIndex()
    {
        $daftarPengaduan = Pengaduan::with('kategori_pengaduan')->latest()->get();
        return view('guest.pengaduan.index', compact('daftarPengaduan'));
    }

    public function pengaduanCreate()
    {
        $daftarKategoriPengaduan = KategoriPengaduan::all();
        return view('guest.pengaduan.create', compact('daftarKategoriPengaduan'));
    }

    public function pengaduanStore(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'foto' => 'required|image|max:3072',
            'keterangan' => 'required',
        ], [
            'nama' => 'Nama harus diisi',
            'id_kategori.required' => 'Kategori harus dipilih',
            'foto.required' => 'Foto harus diisi',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.max' => 'Foto maksimal 3MB',
            'keterangan.required' => 'Keterangan harus diisi',
        ]);

        $foto = $request->file('foto');
        $namaFoto = time() . '.' . $foto->extension();
        $foto->storeAs('public/pengaduan', $namaFoto);

        Pengaduan::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'foto' => $namaFoto,
            'keterangan' => $request->keterangan,
            'status' => 'belum',
        ]);

        return redirect()->route('guest.pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan');
    }
}
