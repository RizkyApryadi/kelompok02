<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;




class PengumumanController extends Controller
{
    public function index()
    {
        // Mengurutkan berdasarkan 'judul' bukan 'nama_pengumuman'
        $pengumumans = Pengumuman::orderBy('judul', 'asc')->get();

        return view('pages.admin.pengumuman.index', compact('pengumumans'));
    }

    // Metode lainnya...



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
        $this->validate($request, [
            'file' => 'required|mimes:pdf,doc,docx,ppt,pptx,png,jpg,jpeg|max:2048',
            'judul' => 'required|string|max:255',  // Validasi untuk 'judul'
            'deskripsi' => 'required|string',       // Validasi untuk 'deskripsi'
        ]);
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('file/materi', $namaFile, 'public'); // Menyimpan file di disk 'public'
        }
    
        $pengumuman = new Pengumuman;
        $pengumuman->judul = $request->judul;
        $pengumuman->deskripsi = $request->deskripsi;
    
        if (isset($filePath)) {
            $pengumuman->file_path = $filePath; // Mengasumsikan Anda memiliki kolom file_path di tabel Anda
        }
    
        $pengumuman->save();
    
        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil diperbaharui!');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $pengumuman = Pengumuman::findOrFail($id);

        return view('pages.admin.pengumuman.edit', compact('pengumuman'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        
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

            if ($pengumuman->file_path) {
                $oldFile = storage_path('app/public/' . $pengumuman->file_path);
                if (File::exists($oldFile)) {
                    File::delete($oldFile);
                }
            }

            $pengumuman->file_path = $filePath;
        }

        $pengumuman->judul = $request->input('judul');
        $pengumuman->deskripsi = $request->input('deskripsi');
        $pengumuman->save();

        return redirect()->route('pengumuman.index')->with('success', 'Data materi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pengumuman = Pengumuman::find($id);
        $lokasi = 'file/materi/' . $pengumuman->file;
        if (File::exists($lokasi)) {
            File::delete($lokasi);
        }

            // Hapus pengumuman
            $pengumuman->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi kesalahan
            return redirect()->route('pengumuman.index')->with('error', 'Terjadi kesalahan saat menghapus pengumuman');
        }
 
    }
    public function guru()
    {
        $guru = Guru::where('nip', Auth::user()->nip)->first();
        $pengumuman = Pengumuman::all();
        return view('pages.guru.pengumuman.index', compact('pengumuman', 'guru'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();
        $pengumuman = Pengumuman::all();
        return view('pages.siswa.pengumuman.index', compact('pengumuman', 'siswa'));
    }
    public function downloadPengumuman($id)
{
    $pengumuman = Pengumuman::findOrFail($id);

    // Periksa apakah file_path ada
    if (!$pengumuman->file_path) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    $path = storage_path('app/public/' . $pengumuman->file_path);

    // Periksa apakah file benar-benar ada di jalur tersebut
    if (!File::exists($path)) {
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }

    return Response::download($path);
}


    }
