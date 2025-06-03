<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;


class AlumniController extends Controller
{
    public function index()
    {

        $alumnis = Alumni::all();
        return view('pages.admin.guest.alumni.index', compact('alumnis'));
    }

    public function ApiGet()
    {
        $alumnis = Alumni::all();
        return response()->json($alumnis);
    }
    public function create()
    {
        return view('pages.admin.guest.alumni.create'); // Mengarahkan ke view create.blade.php
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Menyimpan data alumni ke database
        $alumni = new Alumni();
        $alumni->nama = $request->nama;
        $alumni->angkatan = $request->angkatan;
        $alumni->keterangan = $request->keterangan;

        // Menangani upload foto
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('public/foto_alumni');
            $alumni->foto = basename($imagePath); // Menyimpan nama file foto
        }

        $alumni->save(); // Simpan data ke database

        return redirect('/alumni')->with('success', 'Aktivitas berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $alumni = Alumni::findOrFail($id);
        return view('pages.admin.guest.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $alumni = Alumni::findOrFail($id);
        $alumni->nama = $request->nama;
        $alumni->angkatan = $request->angkatan;
        $alumni->keterangan = $request->keterangan;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto && \Storage::exists('public/foto_alumni/' . $alumni->foto)) {
                \Storage::delete('public/foto_alumni/' . $alumni->foto);
            }

            $imagePath = $request->file('foto')->store('public/foto_alumni');
            $alumni->foto = basename($imagePath);
        }

        $alumni->save();

        return redirect('/alumni')->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $alumni = Alumni::findOrFail($id);

        // Hapus foto jika ada
        if ($alumni->foto && \Storage::exists('public/foto_alumni/' . $alumni->foto)) {
            \Storage::delete('public/foto_alumni/' . $alumni->foto);
        }

        $alumni->delete();

        return redirect('/alumni')->with('success', 'Data alumni berhasil dihapus!');
    }

}
