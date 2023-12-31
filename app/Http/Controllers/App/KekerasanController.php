<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Base\Siswa;
use App\Models\Kekerasan;
use App\Models\Guru;
use App\Models\Komponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KekerasanController extends Controller
{
    public function index()
    {
        $daftarKekerasan = DB::table('kekerasan')
            ->join('siswa', 'kekerasan.id_siswa', '=', 'siswa.id')
            ->join('komponen', 'kekerasan.id_komponen', '=', 'komponen.id')
            ->join('atribut', 'kekerasan.id_atribut', '=', 'atribut.id')
            ->select('kekerasan.*', 'siswa.nama as nama_siswa', 'siswa.kelas as kelas', 'komponen.nama as nama_komponen', 'atribut.nama as nama_atribut')
            ->orderBy('kekerasan.created_at', 'desc')
            ->get();

        $daftarKomponen = Komponen::all();
        return view('app.kekerasan.index', compact('daftarKekerasan', 'daftarKomponen'));
    }


    public function edit(Kekerasan $kekerasan)
    {
        $detailKekerasan = DB::table('kekerasan')
            ->join('siswa', 'kekerasan.id_siswa', '=', 'siswa.id')
            ->join('komponen', 'kekerasan.id_komponen', '=', 'komponen.id')
            ->join('atribut', 'kekerasan.id_atribut', '=', 'atribut.id')
            ->select('kekerasan.*', 'siswa.nama as nama_siswa', 'siswa.kelas as kelas', 'komponen.nama as nama_komponen', 'atribut.nama as nama_atribut')
            ->where('kekerasan.id', '=', $kekerasan->id)
            ->first();

        $daftarSiswa = Siswa::where('kelas', '=', $detailKekerasan->kelas)->get();

        $daftarAtribut = DB::table('atribut')
            ->join('komponen', 'atribut.id_komponen', '=', 'komponen.id')
            ->select('atribut.*', 'komponen.nama as nama_komponen')
            ->get();

        return view('app.kekerasan.edit', compact('kekerasan', 'detailKekerasan', 'daftarSiswa', 'daftarAtribut'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_siswa' => 'required',
                'id_komponen' => 'required',
                'id_atribut' => 'required',
                'keterangan' => 'nullable',
            ], [
                'id_siswa.required' => 'Siswa harus diisi',
                'id_komponen.required' => 'Komponen harus diisi',
                'id_atribut.required' => 'Atribut harus diisi',
            ]);

            Kekerasan::create([
                'id_siswa' => $request->id_siswa,
                'id_komponen' => $request->id_komponen,
                'id_atribut' => $request->id_atribut,
                'keterangan' => $request->keterangan,
            ]);
            return redirect()->route('app.kekerasan.index')->with('success', 'Data kekerasan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data kekerasan gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Kekerasan $kekerasan)
    {
        try {
            $kekerasan->delete();
            return redirect()->route('app.kekerasan.index')->with('success', 'Data kekerasan berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data kekerasan gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Kekerasan $kekerasan)
    {
        try {
            $request->validate([
                'id_siswa' => 'required',
                'id_atribut' => 'required',
                'keterangan' => 'nullable',
            ], [
                'id_siswa.required' => 'Siswa harus diisi',
                'id_atribut.required' => 'Atribut harus diisi',
            ]);

            $kekerasan->update([
                'id_siswa' => $request->id_siswa,
                'id_atribut' => $request->id_atribut,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('app.kekerasan.index')->with('success', 'Data kekerasan berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data kekerasan gagal diubah, karena ' . $e->getMessage());
        }
    }
}
