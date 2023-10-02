<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $daftarSiswa = Siswa::orderBy('kelas')->get();
        return view('app.siswa.index', compact('daftarSiswa'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required|in:1,2,3,4,5,6',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'nullable',
                'nama_ortu' => 'nullable',
                'no_telepon_ortu' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
                'kelas.required' => 'Kelas harus diisi',
                'kelas.in' => 'Kelas harus 1, 2, 3, 4, 5, atau 6',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            ]);

            Siswa::create([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'nama_ortu' => $request->nama_ortu,
                'no_telepon_ortu' => $request->no_telepon_ortu,
            ]);
            return redirect()->route('app.siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data siswa gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Siswa $siswa)
    {
        try {
            $siswa->delete();
            return redirect()->route('app.siswa.index')->with('success', 'Data siswa berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data siswa gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Siswa $siswa)
    {
        try {
            $request->validate([
                'nama' => 'required',
                'kelas' => 'required|in:1,2,3,4,5,6',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'nullable',
                'nama_ortu' => 'nullable',
                'no_telepon_ortu' => 'nullable',
            ], [
                'nama.required' => 'Nama harus diisi',
                'kelas.required' => 'Kelas harus diisi',
                'kelas.in' => 'Kelas harus 1, 2, 3, 4, 5, atau 6',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
            ]);

            $siswa->update([
                'nama' => $request->nama,
                'kelas' => $request->kelas,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'nama_ortu' => $request->nama_ortu,
                'no_telepon_ortu' => $request->no_telepon_ortu,
            ]);
            return redirect()->route('app.siswa.index')->with('success', 'Data siswa berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data siswa gagal diubah, karena ' . $e->getMessage());
        }
    }
}
