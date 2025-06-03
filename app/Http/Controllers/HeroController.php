<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{

    // app/Http/Controllers/HeroController.php
    public function index()
    {
        $heroes = Hero::all();  // Ambil semua data sambutan
        return response()->json($heroes);  // Kembalikan data dalam format JSON

    }

    // Menampilkan form create
    public function create()
    {
        return view('pages.admin.guest.home.createHero'); // Buat view createHero.blade.php
    }

    // Menyimpan data sambutan
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'required|string|max:1000',
            'headmaster_name' => 'required|string|max:255',
        ]);

        // Upload foto
        $photoPath = $request->file('photo')->store('public/heroes');

        // Simpan data ke database
        Hero::create([
            'headmaster_name' => $request->headmaster_name,
            'message' => $request->message,
            'photo' => $photoPath,
        ]);
        return redirect('/guest/home')->with('success', 'Aktivitas berhasil ditambahkan!');

    }


    // Menampilkan form edit
    public function edit($id)
    {
        $hero = Hero::findOrFail($id);
        return view('pages.admin.guest.home.editHero', compact('hero'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'required|string|max:1000',
            'headmaster_name' => 'required|string|max:255',
        ]);

        $hero = Hero::findOrFail($id);
        $hero->headmaster_name = $request->headmaster_name;
        $hero->message = $request->message;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/heroes');
            $hero->photo = $path;
        }

        $hero->save();

        return redirect('/guest/home')->with('success', 'Sambutan berhasil diperbarui!');
    }

    // Menghapus data sambutan
    public function destroy($id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return redirect('/guest/home')->with('success', 'Sambutan berhasil dihapus!');
    }

}