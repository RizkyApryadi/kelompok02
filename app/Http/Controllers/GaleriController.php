<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;


class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galeris = Galeri::orderBy('judul', 'asc')->get();

        return view('pages.admin.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('file/materi', $namaFile, 'public');
        }

        $galeri = new Galeri;
        $galeri->judul = $request->judul;
        $galeri->deskripsi = $request->deskripsi;

        if (isset($filePath)) {
            $galeri->file_path = $filePath;
        }

        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil diperbaharui!');
    }

    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function show(Galeri $galeri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $galeri = Galeri::findOrFail($id);

        return view('pages.admin.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        
        $this->validate($request, [
            $this->validate($request, [
                'judul' => 'required|string|max:255',
                'deskripsi' => 'required|string',
                'file' => 'mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048', 
            ])
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('file/materi', $namaFile, 'public');

            if ($galeri->file_path) {
                $oldFile = storage_path('app/public/' . $galeri->file_path);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $galeri->file_path = $filePath;
        }

        $galeri->judul = $request->input('judul');
        $galeri->deskripsi = $request->input('deskripsi');
        $galeri->save();

        return redirect()->route('galeri.index')->with('success', 'Data materi berhasil diubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Galeri  $galeri
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $galeri = Galeri::find($id);
        $lokasi = 'file/materi/' . $galeri->file;
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }

            // Hapus pengumuman
            $galeri->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('galeri.index')->with('success', 'Data galeri berhasil dihapus');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->route('galeri.index')->with('error', 'Terjadi kesalahan saat menghapus pengumuman');
        }
    }
    public function guru()
    {
        $guru = Guru::where('nip', Auth::user()->nip)->first();
        $galeri = Galeri::all();
        return view('pages.guru.galeri.index', compact('galeri', 'guru'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        $galeri = Galeri::all();
        return view('pages.siswa.galeri.index', compact('galeri', 'siswa'));
    }
    public function downloadGaleri($id)
{
    $galeri = Galeri::findOrFail($id);

    // Periksa apakah file_path ada
    if (!$galeri->file_path) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    $path = storage_path('app/public/' . $galeri->file_path);

    // Periksa apakah file benar-benar ada di jalur tersebut
    if (!File::exists($path)) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    return Response::download($path);
}


}
