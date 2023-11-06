<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Base\Komponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    public function index(Request $request)
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

        $daftarKomponen = Komponen::latest()->get();
        return view('app.absensi.index', compact('daftarAbsensi', 'daftarKomponen'));
    }

    public function create()
    {
        $daftarKomponen = Komponen::latest()->get();
        return view('app.absensi.create', compact('daftarKomponen'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $id_komponen = $request->id_komponen;
            $id_atribut = $request->id_atribut;
            $kegiatan = $request->kegiatan;
            $tanggal = $request->tanggal;

            $siswa = $request->siswa;
            $status = $request->status;
            $keterangan = $request->keterangan;

            foreach ($siswa as $k => $v) {
                Absensi::create([
                    'id_siswa' => $v,
                    'id_komponen' => $id_komponen,
                    'id_atribut' => $id_atribut,
                    'kegiatan' => $kegiatan,
                    'status' => $status[$k],
                    'keterangan' => $keterangan[$k],
                    'tanggal' => date('Y-m-d', strtotime($tanggal))
                ]);
            }

            DB::commit();
            return redirect()
                ->route('app.absensi.index')
                ->with('success', 'Data absensi berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data absensi gagal ditambahkan, karena ' . $e->getMessage());
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();

            $siswa = $request->siswa;
            $status = $request->status;
            $keterangan = $request->keterangan;

            foreach ($siswa as $k => $v) {
                Absensi::updateOrCreate(
                    ['id' => $v],
                    ['status' => $status[$k], 'keterangan' => $keterangan[$k]]
                );
            }

            DB::commit();
            return redirect()
                ->route('app.absensi.index')
                ->with('success', 'Data absensi berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Data absensi gagal diperbarui, karena ' . $e->getMessage());
        }
    }
}
