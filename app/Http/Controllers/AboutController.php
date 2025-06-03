<?php

// app/Http/Controllers/AboutController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all(); // Fetch all records
        return view('pages.admin.guest.tentang.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Point to the correct view path based on your file structure
        return view('pages.admin.guest.tentang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required|string',
        ]);

        About::create([
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('about.index')->with('success', 'Deskripsi berhasil disimpan!');
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('pages.admin.guest.tentang.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi' => 'required',
        ]);

        $about = About::findOrFail($id);
        $about->deskripsi = $request->deskripsi;
        $about->save();

        return redirect()->route('about.index')->with('success', 'Data berhasil diupdate');
    }

        public function destroy($id)
        {
            $about = About::findOrFail($id);
            $about->delete();

            return redirect()->route('about.index')->with('success', 'Data berhasil dihapus');
        }

    // Untuk React
    public function apiGet()
    {
        $about = About::latest()->first();
        return response()->json($about);
    }

    public function list()
    {
        $abouts = About::latest()->get();
        return view('about.list', compact('abouts'));
    }
}