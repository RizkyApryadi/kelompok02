<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AktivitasController extends Controller
{
    // Menampilkan daftar aktivitas
    public function index()
    {
        $aktivitas = Aktivitas::all(); // Atau kasih orderBy('created_at', 'desc');
        return response()->json($aktivitas);
    }



    // Menampilkan form untuk membuat aktivitas baru
    public function create()
    {
        return view('pages.admin.guest.home.createAktifitas'); // Mengarah ke halaman create
    }

    // Menyimpan data aktivitas baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'tanggal' => 'required|date',
        ]);

        $aktivitas = new Aktivitas();
        $aktivitas->judul = $request->judul;
        $aktivitas->deskripsi = $request->deskripsi;
        $aktivitas->tanggal = $request->tanggal;

        // Handle upload gambar
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('aktivitas', 'public');
            $aktivitas->gambar = $path;
        }

        $aktivitas->save();

        return redirect('/guest/home')->with('success', 'Aktivitas berhasil ditambahkan!');

    }

    public function edit($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        return view('pages.admin.guest.home.editAktifitas', compact('aktivitas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg,gif',
            'tanggal' => 'required|date',
        ]);

        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->judul = $request->judul;
        $aktivitas->deskripsi = $request->deskripsi;
        $aktivitas->tanggal = $request->tanggal;

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('aktivitas', 'public');
            $aktivitas->gambar = $path;
        }

        $aktivitas->save();

        return redirect('/guest/home')->with('success', 'Aktivitas berhasil diperbarui!');
    }


    // Menghapus data aktivitas
    public function destroy($id)
    {
        $aktivitas = Aktivitas::findOrFail($id);
        $aktivitas->delete();

        return redirect('/guest/home')->with('success', 'Aktivitas berhasil dihapus!');
    }

}