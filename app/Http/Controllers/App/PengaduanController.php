<?php

namespace App\Http\Controllers\App;

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
        return view('app.pengaduan.index', compact('daftarPengaduan'));
    }

    public function create()
    {
        $daftarKategoriPengaduan = KategoriPengaduan::all();
        return view('app.pengaduan.create', compact('daftarKategoriPengaduan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_kategori' => 'required',
            'foto' => 'required|image|max:3072',
            'jam_kejadian' => 'nullable',
            'tanggal_kejadian' => 'nullable',
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
        $jamKejadian = $request->jam_kejadian;
        $tanggalKejadian = $request->tanggal_kejadian;

        Pengaduan::create([
            'nama' => $request->nama,
            'id_kategori' => $request->id_kategori,
            'foto' => $namaFoto,
            'keterangan' => $request->keterangan,
            'jam_kejadian' => $jamKejadian,
            'tanggal_kejadian' => $tanggalKejadian,
        ]);

        return redirect()->back()->with('success', 'Pengaduan berhasil ditambahkan');
    }

    public function edit(Pengaduan $pengaduan)
    {
        $daftarKategoriPengaduan = KategoriPengaduan::all();
        return view('app.pengaduan.edit', compact('pengaduan', 'daftarKategoriPengaduan'));
    }

    public function update(Request $request, Pengaduan $pengaduan)
    {
        $pengaduan->sanksi = $request->sanksi;
        $pengaduan->penyelesaian = $request->penyelesaian;

        $pengaduan->save();
        return redirect()->back()->with('success', 'Pengaduan berhasil diperbarui');
    }

    public function destroy(Pengaduan $pengaduan)
    {
        $pengaduan->delete();
        return redirect()->route('app.pengaduan.index')->with('success', 'Pengaduan berhasil dihapus');
    }
}
