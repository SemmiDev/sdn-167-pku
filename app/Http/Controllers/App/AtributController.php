<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Atribut;
use App\Models\Komponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AtributController extends Controller
{
    public function index()
    {
        $daftarKomponen = Komponen::all();

        $daftarAtribut = DB::table('atribut')
            ->join('komponen', 'atribut.id_komponen', '=', 'komponen.id')
            ->select('atribut.*', 'komponen.nama as nama_komponen')
            ->orderBy('komponen.nama', 'asc')
            ->get();

        return view('app.atribut.index', compact('daftarAtribut', 'daftarKomponen'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'id_komponen' => 'required|exists:komponen,id',
                'keterangan' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
                'id_komponen.required' => 'Komponen harus diisi',
            ]);

            Atribut::create([
                'nama' => $request->nama,
                'id_komponen' => $request->id_komponen,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('app.atribut.index')->with('success', 'Data atribut berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data atribut gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Atribut $atribut)
    {
        try {
            $atribut->delete();
            return redirect()->route('app.atribut.index')->with('success', 'Data atribut berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data atribut gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Atribut $atribut)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'id_komponen' => 'required|exists:komponen,id',
                'keterangan' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
                'id_komponen.required' => 'Komponen harus diisi',
            ]);

            $atribut->update([
                'nama' => $request->nama,
                'id_komponen' => $request->id_komponen,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('app.atribut.index')->with('success', 'Data atribut berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data atribut gagal diubah, karena ' . $e->getMessage());
        }
    }
}
