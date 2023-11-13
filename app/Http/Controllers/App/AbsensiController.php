<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Base\Komponen;
use App\Models\Dokumentasi;
use App\Models\Guru;
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

        $dokumentasi = [];
        if (count($daftarAbsensi) != 0) {
            $firstItem = $daftarAbsensi->first();
            $dokumentasi = Dokumentasi::where('id_absensi', $firstItem->id)->get();
        }

        $daftarKomponen = Komponen::latest()->get();
        $daftarGuru = Guru::latest()->get();
        return view('app.absensi.index', compact('daftarAbsensi', 'daftarKomponen', 'daftarGuru', 'dokumentasi'));
    }

    public function create()
    {
        $daftarKomponen = Komponen::latest()->get();
        $daftarGuru = Guru::latest()->get();
        return view('app.absensi.create', compact('daftarKomponen', 'daftarGuru'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $id_komponen = $request->id_komponen;
            $id_atribut = $request->id_atribut;
            $kegiatan = $request->kegiatan;
            $tanggal = $request->tanggal;
            $guru_pembimbing = $request->guru_pembimbing;

            $siswa = $request->siswa;
            $status = $request->status;
            $keterangan = $request->keterangan;

            $daftarNamaFoto = [];
            $dokumentasi = $request->file('dokumentasi');
            foreach ($dokumentasi as $file) {
                $namaFoto = time() .'-' . uniqid() . '.' . $file->extension();
                $file->storeAs('public/absensi', $namaFoto);
                $daftarNamaFoto[] = $namaFoto;
            }


            foreach ($siswa as $k => $v) {
                $absensi = Absensi::create([
                    'id_siswa' => $v,
                    'id_komponen' => $id_komponen,
                    'id_atribut' => $id_atribut,
                    'kegiatan' => $kegiatan,
                    'status' => $status[$k],
                    'keterangan' => $keterangan[$k],
                    'tanggal' => date('Y-m-d', strtotime($tanggal)),
                    'id_guru_pembimbing' => $guru_pembimbing,
                ]);

                foreach ($daftarNamaFoto as $namaFoto) {
                    Dokumentasi::create([
                        'id_absensi' => $absensi->id,
                        'foto' => $namaFoto,
                    ]);
                }
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
