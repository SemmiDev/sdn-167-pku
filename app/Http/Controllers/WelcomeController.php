<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengaduan;
use App\Models\Kekerasan;
use App\Models\Komponen;
use App\Models\Pengaduan;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function pengumumanIndex()
    {
        $daftarPengumuman = Pengumuman::latest()->get();
        return view('guest.pengumuman.index', compact('daftarPengumuman'));
    }

    public function kekerasanIndex()
    {
        $daftarKekerasan = DB::table('kekerasan')
            ->join('siswa', 'kekerasan.id_siswa', '=', 'siswa.id')
            ->join('komponen', 'kekerasan.id_komponen', '=', 'komponen.id')
            ->join('atribut', 'kekerasan.id_atribut', '=', 'atribut.id')
            ->select('kekerasan.*', 'siswa.nama as nama_siswa', 'siswa.kelas as kelas', 'komponen.nama as nama_komponen', 'atribut.nama as nama_atribut')
            ->orderBy('kekerasan.created_at', 'desc')
            ->get();

        $daftarKomponen = Komponen::all();
        return view('guest.kekerasan.index', compact('daftarKekerasan', 'daftarKomponen'));
    }

    public function absensiIndex(Request $request)
    {
        $kelas = $request->kelas ?? 1;
        $id_komponen = $request->id_komponen;
        $id_atribut = $request->id_atribut;
        $tanggal = $request->tanggal ?? date('Y-m-d');

        $daftarAbsensi = DB::table('absensi')
            ->whereDate('absensi.tanggal', $tanggal)
            ->join('komponen', 'absensi.id_komponen', '=', 'komponen.id')
            ->join('atribut', 'absensi.id_atribut', '=', 'atribut.id')
            ->join('siswa', 'absensi.id_siswa', '=', 'siswa.id')
            ->when($id_komponen, function ($query, $id_komponen) {
                return $query->where('absensi.id_komponen', $id_komponen);
            })
            ->when($id_atribut, function ($query, $id_atribut) {
                return $query->where('absensi.id_atribut', $id_atribut);
            })
            ->when($kelas, function ($query, $kelas) {
                return $query->where('siswa.kelas', $kelas);
            })
            ->select('absensi.*', 'komponen.nama as komponen', 'siswa.nama as siswa', 'atribut.nama as atribut')
            ->get();

        $daftarKomponen = \App\Models\Base\Komponen::latest()->get();

        return view('guest.absensi.index', compact('daftarAbsensi', 'daftarKomponen'));
    }
}
