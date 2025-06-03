<?php

namespace App\Http\Controllers;

use App\Models\PrestasiNonAkademik; // Import model PrestasiNonAkademik
use Illuminate\Http\Request;

class PrestasiNonAkademikController extends Controller
{
    public function index()
    {
        $prestasiNon = PrestasiNonAkademik::all();
        return response()->json([
            'prestasiNon' => $prestasiNon,
        ]);
    }

    // Fungsi untuk menampilkan form tambah prestasi non-akademik
    public function create()
    {
        return view('pages.admin.guest.galeri.createNakam'); // Pastikan nama view sesuai dengan yang kamu buat
    }

    // Fungsi untuk menyimpan data prestasi non-akademik
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'kejuruan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
        ]);

        // Simpan data ke database
        PrestasiNonAkademik::create($validatedData);

        // Redirect atau beri notifikasi sukses
        return redirect()->route('guest.prestasi.index')->with('success', 'Data prestasi non-akademik berhasil disimpan!');
    }

    // Fungsi untuk menampilkan form edit prestasi non-akademik
    public function edit($id)
    {
        $prestasiNon = PrestasiNonAkademik::findOrFail($id);
        return view('pages.admin.guest.galeri.editNakam', compact('prestasiNon')); // Pastikan nama view sesuai
    }

    // Fungsi untuk memperbarui data prestasi non-akademik
    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_pelaksanaan' => 'required|date',
            'kejuruan' => 'required|string|max:255',
            'tingkat' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
        ]);

        // Temukan data berdasarkan ID dan update
        $prestasiNon = PrestasiNonAkademik::findOrFail($id);
        $prestasiNon->update($validatedData);

        // Redirect atau beri notifikasi sukses
        return redirect()->route('guest.prestasi.index')->with('success', 'Data prestasi non-akademik berhasil diperbarui!');
    }

    // Fungsi untuk menghapus data prestasi non-akademik
    public function destroy($id)
    {
        // Temukan data berdasarkan ID dan hapus
        $prestasiNon = PrestasiNonAkademik::findOrFail($id);
        $prestasiNon->delete();

        // Redirect atau beri notifikasi sukses
        return redirect()->route('guest.prestasi.index')->with('success', 'Data prestasi non-akademik berhasil dihapus!');
    }
}
