<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero; // Pastikan model Hero digunakan
use App\Models\News; // Model News
use App\Models\About;
use App\Models\Aktivitas;
use App\Models\PrestasiAkademik;
use App\Models\PrestasiNonAkademik;
use App\Models\Fasilitas;
use App\Models\Alumni;


class GuestController extends Controller
{
    public function home()
    {
        $heroes = Hero::all(); // Mengambil semua data dari tabel heroes
        $news = News::all(); // Mengambil semua data dari tabel heroes
        $aktivitas = Aktivitas::all(); // Tambahkan ini

        return view('pages.admin.guest.home.index', compact('heroes', 'news','aktivitas',));
    }

    public function tentang()
    {
        $abouts = About::all();
        return view('pages.admin.guest.tentang.index', compact('abouts'));
    }
    
    public function fasilitas()
    {
        $fasilitas = Fasilitas::all();

        // Anda dapat mengganti dengan tampilan yang sesuai
        return view('pages.admin.guest.fasilitas.index', compact('fasilitas'));
    }
    public function galeri()
{
    // Ambil data prestasi dari model Prestasi
    $prestasi = PrestasiAkademik::all();
    $prestasiNon = PrestasiNonAkademik::all();


    // Kirimkan data ke view
    return view('pages.admin.guest.galeri.index', compact('prestasi', 'prestasiNon'));
}

    public function contact()
    {
        // Anda dapat mengganti dengan tampilan yang sesuai
        return view('pages.admin.guest.contact.index');
    }
    public function alumni()
    {
        $alumni =Alumni::all();
        return view('pages.admin.guest.alumni.index', compact('alumni'));
    }
}
