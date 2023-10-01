<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Psy\Util\Str;

class PengaduanController extends Controller
{
    public function index()
    {
        $daftarPengaduan = Pengaduan::with('kategori_pengaduan')->latest()->get();
        return view('admin.pengaduan.index', compact('daftarPengaduan'));
    }

    public function create() {
        $daftarKategoriPengaduan = KategoriPengaduan::all();
        return view('admin.pengaduan.create', compact('daftarKategoriPengaduan'));
    }

    public function store(Request $request)
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

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil ditambahkan');
    }

    public function update(Request $request, Pengaduan $pengaduan) {
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil diubah');
    }

    public function destroy(Pengaduan $pengaduan) {
        $pengaduan->delete();
        return redirect()->route('admin.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
