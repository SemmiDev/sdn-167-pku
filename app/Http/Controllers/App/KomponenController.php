<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Komponen;
use Illuminate\Http\Request;

class KomponenController extends Controller
{
    public function index()
    {
        $daftarKomponen = Komponen::latest()->get();
        return view('app.komponen.index', compact('daftarKomponen'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'keterangan' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
            ]);

            Komponen::create([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('app.komponen.index')->with('success', 'Data komponen berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data komponen gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Komponen $komponen)
    {
        try {
            $komponen->delete();
            return redirect()->route('app.komponen.index')->with('success', 'Data komponen berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data komponen gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Komponen $komponen)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'keterangan' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
            ]);

            $komponen->update([
                'nama' => $request->nama,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('app.komponen.index')->with('success', 'Data komponen berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data komponen gagal diubah, karena ' . $e->getMessage());
        }
    }
}
