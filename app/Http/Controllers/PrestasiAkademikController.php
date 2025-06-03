<?php

namespace App\Http\Controllers;

use App\Models\PrestasiAkademik; // Import model PrestasiAkademik
use Illuminate\Http\Request;
use App\Models\PrestasiNonAkademik; // Menambahkan impor untuk model PrestasiNonAkademik


class PrestasiAkademikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data prestasi akademik dan prestasi non-akademik
        $prestasi = PrestasiAkademik::all();
        $prestasiNon = PrestasiNonAkademik::all();

        // Cek jika permintaan berasal dari API (untuk JSON) atau browser (untuk Blade)
        if ($request->wantsJson()) {
            // Kembalikan JSON untuk API
            return response()->json([
                'prestasi' => $prestasi,
                'prestasiNon' => $prestasiNon,
            ]);
        }

        // Kembalikan tampilan Blade jika permintaan dari browser
        return view('pages.admin.guest.galeri.index', compact('prestasi', 'prestasiNon'));
    }

    // Fungsi untuk menampilkan form tambah prestasi akademik
    public function create()
    {
        return view('pages.admin.guest.galeri.createAkam'); // Pastikan nama view sesuai dengan yang kamu buat
    }

    // Fungsi untuk menyimpan data prestasi akademik
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
        PrestasiAkademik::create($validatedData);

        // Redirect atau beri notifikasi sukses
        return redirect()->route('guest.prestasi.index')->with('success', 'Data prestasi akademik berhasil disimpan!');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $prestasi = PrestasiAkademik::findOrFail($id);
        return view('pages.admin.guest.galeri.editAkam', compact('prestasi'));
    }

    // Menyimpan hasil edit
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

        $prestasi = PrestasiAkademik::findOrFail($id);
        $prestasi->update($validatedData);

        return redirect()->route('guest.prestasi.index')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data
    public function destroy($id)
    {
        // Mencari data berdasarkan ID
        $prestasi = PrestasiAkademik::find($id);

        // Jika data tidak ditemukan
        if (!$prestasi) {
            return redirect()->route('guest.prestasi.index')->with('error', 'Data tidak ditemukan!');
        }

        // Menghapus data
        $prestasi->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('guest.prestasi.index')->with('success', 'Data berhasil dihapus!');
    }
}
