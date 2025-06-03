<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    // Menampilkan semua berita dalam format JSON
    public function index()
    {
        $news = News::all(); // Mengambil semua berita dari database
        return response()->json($news); // Mengembalikan data dalam format JSON
    }

    // Menampilkan form create
    public function create()
    {
        return view('createNews'); // Buat view createNews.blade.php
    }

    // Menyimpan data berita
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'date' => 'required|date',
        ]);

        // Upload foto
        $photoPath = $request->file('photo')->store('public/news');

        // Simpan data ke database
        News::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'photo' => $photoPath,
        ]);
        return redirect('/guest/home')->with('success', 'Berita berhasil ditambahkan!');

    }

    // Menampilkan form edit
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('pages.admin.guest.home.editNews', compact('news')); // Buat view editNews.blade.php
    }

    // Update data berita
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        // Validasi
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'date' => 'required|date',
        ]);

        // Jika ada file foto baru
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('public/news');
            $news->photo = $photoPath;
        }

        $news->title = $request->title;
        $news->description = $request->description;
        $news->date = $request->date;
        $news->save();

        return redirect('/guest/home')->with('success', 'Berita berhasil diperbarui!');
    }

    // Menghapus data berita
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect('/guest/home')->with('success', 'Berita berhasil dihapus!');
    }

}