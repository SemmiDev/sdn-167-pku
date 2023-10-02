<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use Illuminate\Http\Request;

class KategoriPengaduanController extends Controller
{
    public function index()
    {
        $daftarKategoriPengaduan = KategoriPengaduan::latest()->get();
        return view('app.kategori-pengaduan.index', compact('daftarKategoriPengaduan'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'kategori' => 'required',
            ], [
                'kategori.required' => 'Kategori harus diisi',
            ]);

            KategoriPengaduan::create([
                'kategori' => $request->kategori,
            ]);
            return redirect()->route('app.kategori-pengaduan.index')->with('success', 'Kategori Pengaduan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Kategori Pengaduan gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(KategoriPengaduan $kategoriPengaduan)
    {
        try {
            $kategoriPengaduan->delete();
            return redirect()->route('app.kategori-pengaduan.index')->with('success', 'Kategori Pengaduan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Kategori Pengaduan gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, KategoriPengaduan $kategoriPengaduan)
    {
        try {
            $request->validate([
                'kategori' => 'required',
            ], [
                'kategori.required' => 'Kategori harus diisi',
            ]);

            $kategoriPengaduan->update([
                'kategori' => $request->kategori,
            ]);
            return redirect()->route('app.kategori-pengaduan.index')->with('success', 'Kategori Pengaduan berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Kategori Pengaduan gagal diubah, karena ' . $e->getMessage());
        }
    }
}
