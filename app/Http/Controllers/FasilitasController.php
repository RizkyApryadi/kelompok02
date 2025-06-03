<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fasilitas;



class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        // return response()->json($fasilitas);  // Kembalikan data dalam format JSON

        return view('pages.admin.guest.fasilitas.index', compact('fasilitas'));
    }

     public function apiGet()
    {
        $fasilitas = Fasilitas::all();
        return response()->json($fasilitas);
    }

    public function create()
    {
        return view('pages.admin.guest.fasilitas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fasilitas', 'public');
        }

        Fasilitas::create($validated);
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit($id)
{
    $fasilitas = Fasilitas::findOrFail($id);
    return view('pages.admin.guest.fasilitas.edit', compact('fasilitas'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $fasilitas = Fasilitas::findOrFail($id);

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika perlu (opsional)
        if ($fasilitas->foto && \Storage::disk('public')->exists($fasilitas->foto)) {
            \Storage::disk('public')->delete($fasilitas->foto);
        }

        // Simpan foto baru
        $validated['foto'] = $request->file('foto')->store('fasilitas', 'public');
    }

    $fasilitas->update($validated);

    return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui');
}


    public function destroy($id)
    {
        // Cari fasilitas berdasarkan ID
        $fasilitas = Fasilitas::findOrFail($id);

        // Hapus fasilitas dari database
        $fasilitas->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('fasilitas.index')->with('success', 'Fasilitas berhasil dihapus');
    }
}
