<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index()
    {
        $daftarPengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('daftarPengumuman'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'keterangan' => 'required',
            ], [
                'judul.required' => 'Judul harus diisi',
                'keterangan.required' => 'Keterangan harus diisi',
            ]);

            Pengumuman::create([
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Pengumuman gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Pengumuman $pengumuman) {
        try {
            $pengumuman->delete();
            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengumuman gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Pengumuman $pengumuman) {
        try {
            $request->validate([
                'judul' => 'required',
                'keterangan' => 'required',
            ], [
                'judul.required' => 'Judul harus diisi',
                'keterangan.required' => 'Keterangan harus diisi',
            ]);

            $pengumuman->update([
                'judul' => $request->judul,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Pengumuman gagal diubah, karena ' . $e->getMessage());
        }
    }
}
