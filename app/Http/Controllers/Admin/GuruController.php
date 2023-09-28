<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $daftarGuru = Guru::latest()->get();
        return view('admin.guru.index', compact('daftarGuru'));
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nama' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required',
                'no_telepon' => 'required|starts_with:08',
            ], [
                'nama.required' => 'Nama harus diisi',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'alamat.required' => 'Alamat harus diisi',
                'no_telepon.required' => 'Nomor telepon harus diisi',
                'no_telepon.starts_with' => 'Nomor telepon harus diawali dengan 08',
            ]);

            Guru::create([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
            ]);
            return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data guru gagal ditambahkan, karena ' . $e->getMessage());
        }
    }

    public function destroy(Guru $guru) {
        try {
            $guru->delete();
            return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data guru gagal dihapus, karena ' . $e->getMessage());
        }
    }

    public function update(Request $request, Guru $guru) {
        try {
            $request->validate([
                'nama' => 'required',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required',
                'no_telepon' => 'required|starts_with:08',
            ], [
                'nama.required' => 'Nama harus diisi',
                'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan',
                'alamat.required' => 'Alamat harus diisi',
                'no_telepon.required' => 'Nomor telepon harus diisi',
                'no_telepon.starts_with' => 'Nomor telepon harus diawali dengan 08',
            ]);

            $guru->update([
                'nama' => $request->nama,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'no_telepon' => $request->no_telepon,
            ]);
            return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diubah');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Data guru gagal diubah, karena ' . $e->getMessage());
        }
    }
}
