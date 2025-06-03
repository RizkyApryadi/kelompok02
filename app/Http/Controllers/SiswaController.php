<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::orderBy('nama', 'asc')->get();
        $kelas = Kelas::all();
        return view('pages.admin.siswa.index', compact('siswa', 'kelas'));
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required',
                'nis' => 'required|unique:siswas|unique:users,nis',
                'telp' => 'required',
                'alamat' => 'required',
                'kelas_id' => 'required|exists:kelas,id',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'required|confirmed|min:6',
            ], [
                'nis.unique' => 'NIS sudah terdaftar',
                'kelas_id.exists' => 'Kelas tidak valid',
            ]);
    
            // Simpan foto jika ada
            $foto = null;
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $namaFoto = time() . '.' . $file->getClientOriginalExtension();
                $foto = $file->storeAs('images/siswa', $namaFoto, 'public');
            }
    
            // Simpan user untuk login siswa
            $user = new User();
            $user->name = $request->nama;
            $user->email = strtolower(Str::slug($request->nama)) . '@siswa.sch.id';
            $user->password = Hash::make($request->password);
            $user->roles = 'siswa';
            $user->nis = $request->nis;
            $user->save();
    
            // Simpan data siswa
            $siswa = new Siswa();
            $siswa->user_id = $user->id;
            $siswa->nama = $request->nama;
            $siswa->nis = $request->nis;
            $siswa->telp = $request->telp;
            $siswa->alamat = $request->alamat;
            $siswa->kelas_id = $request->kelas_id;
            $siswa->foto = $foto;
            $siswa->save();
    
            return redirect()->route('siswa.index')->with('success', 'Data siswa & akun berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan siswa: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data siswa.');
        }
    }
    

    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $siswa = Siswa::findOrFail($id);
        return view('pages.admin.siswa.profile', compact('siswa'));
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $kelas = Kelas::all();
        $siswa = Siswa::findOrFail($id);
        return view('pages.admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        if ($request->nis != $siswa->nis) {
            $request->validate([
                'nis' => 'unique:siswas|unique:users,nis',
            ], [
                'nis.unique' => 'NIS sudah terdaftar',
            ]);
        }

        $siswa->nama = $request->nama;
        $siswa->nis = $request->nis;
        $siswa->telp = $request->telp;
        $siswa->alamat = $request->alamat;
        $siswa->kelas_id = $request->kelas_id;

        if ($request->hasFile('foto')) {
            $lokasi = 'storage/' . $siswa->foto;
            if (File::exists($lokasi)) {
                File::delete($lokasi);
            }
            $foto = $request->file('foto');
            $namaFoto = time() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('images/siswa', $namaFoto, 'public');
            $siswa->foto = $fotoPath;
        }

        $siswa->save();

        // Update juga user jika ingin
        if ($siswa->user) {
            $siswa->user->name = $request->nama;
            $siswa->user->nis = $request->nis;
            $siswa->user->save();
        }

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diubah');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // Hapus foto
        $lokasi = 'storage/' . $siswa->foto;
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }

        // Hapus user terkait
        if ($siswa->user) {
            $siswa->user->delete();
        }

        // Hapus siswa
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }
}