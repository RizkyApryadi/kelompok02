<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $guru = Guru::orderBy('nama', 'asc')->get();
        $jurusan = Jurusan::orderBy('nama_jurusan', 'asc')->get();
        return view('pages.admin.kelas.index', compact('kelas', 'guru', 'jurusan'));
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

        $this->validate($request, [
            'nama_kelas' => 'required|unique:kelas',
            'guru_id' => 'required|unique:kelas',
            'jurusan_id' => 'required'
        ], [
            'nama_kelas.unique' => 'Nama Kelas sudah ada',
            'guru_id.unique' => 'Guru sudah memiliki kelas'
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $id = Crypt::decrypt($id);
        $kelas = Kelas::findOrFail($id);
        $guru = Guru::all();
        return view('pages.admin.kelas.edit', compact('kelas', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'nama_kelas' => 'required',
        'guru_id' => [
            'required',
            Rule::unique('kelas', 'guru_id')->ignore($id)
        ]
    ], [
        'nama_kelas.required' => 'Nama kelas tidak boleh kosong',
        'guru_id.required' => 'Wali kelas harus dipilih',
        'guru_id.unique' => 'Guru sudah menjadi wali kelas lain'
    ]);

    $data = $request->all();
    $kelas = Kelas::findOrFail($id);
    $kelas->update($data);

    return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::find($id)->delete();
        return back()->with('success', 'Data kelas berhasil dihapus!');
    }
}
