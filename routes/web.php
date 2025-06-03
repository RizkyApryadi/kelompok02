<?php

use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\FasilitasController;
use App\Models\Aktivitas;
use App\Http\Controllers\PrestasiAkademikController;
use App\Http\Controllers\PrestasiNonAkademikController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



// ------------------------ storage-Link ------------------------ //
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage linked successfully.';
});

// Debug route
Route::get('/debug', function () {
    try {
        $reactPath = public_path('react/index.html');
        $exists = File::exists($reactPath);
        
        return [
            'status' => 'ok',
            'react_file_exists' => $exists,
            'react_path' => $reactPath,
            'laravel_version' => app()->version(),
            'php_version' => phpversion(),
        ];
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ];
    }
});



// Route::get('{any}', function () {
//     return file_get_contents(public_path('index.html'));
// })->where('any', '.*');


// Serve the React frontend
Route::get('/', function () {
    try {
        $path = public_path('react/index.html');
        if (File::exists($path)) {
            return File::get($path);
        }
        return response()->json(['error' => 'React build not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

// Add routes to serve React assets
Route::get('/assets/{file}', function ($file) {
    $path = public_path('react/assets/' . $file);
    if (File::exists($path)) {
        $mimeType = File::mimeType($path);
        return response()->file($path, ['Content-Type' => $mimeType]);
    }
    abort(404);
});

// Add a catch-all route for React's client-side routing
Route::get('/{any}', function () {
    try {
        $path = public_path('react/index.html');
        if (File::exists($path)) {
            return File::get($path);
        }
        return response()->json(['error' => 'React build not found'], 404);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
})->where('any', '^(?!api|assets|storage|debug|debug-detailed|storage-link|login|register|password|home|guru|siswa|admin|guest|about|prestasi-akademik|prestasi-non-akademik|fasilitas|alumni|message|quiz).*$');
// Route::get('/homepage', function () {
//     return view('pages.homepage');
// });
// Route::get('/section2', function () {
//     return view('pages.section2');
// });
// Route::get('/section3', function () {
//     return view('pages.section3');
// });
// Route::get('/section4', function () {
//     return view('pages.section4');
// });


Route::get('/login', function () {
    return view('login');
})->middleware('auth');



Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/update-profile', [UserController::class, 'update'])->name('update.profile');
    Route::get('/edit-password', [UserController::class, 'editPassword'])->name('ubah-password');
    Route::patch('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
});

Route::group(['middleware' => ['auth', 'checkRole:guru']], function () {
    Route::get('/guru/dashboard', [HomeController::class, 'guru'])->name('guru.dashboard');
    Route::resource('materi', MateriController::class);
    Route::resource('tugas', TugasController::class);
    Route::get('/jawaban-download/{id}', [TugasController::class, 'downloadJawaban'])->name('guru.jawaban.download');
    Route::get('/guru/pengumuman', [PengumumanController::class, 'guru'])->name('guru.pengumuman');
    Route::get('/pengumuman.download/{id}', [PengumumanController::class, 'downloadPengumuman'])->name('guru.pengumuman.download');
    Route::get('/guru/galeri', [GaleriController::class, 'guru'])->name('guru.galeri');
    Route::get('/galeri.download/{id}', [GaleriController::class, 'downloadGaleri'])->name('guru.galeri.download');
    Route::get('/guru/kuis', [QuizController::class, 'index'])->name('guru.kuis');
    Route::get('/guru/Createkuis', [QuizController::class, 'create'])->name('quis.create');
    Route::middleware(['auth', 'checkRole:guru'])->group(function () {
        Route::get('/guru/kuis', [QuizController::class, 'index'])->name('guru.kuis.index');
        Route::get('/guru/kuis/create', [QuizController::class, 'create'])->name('guru.kuis.create');
        Route::post('/guru/kuis', [QuizController::class, 'store'])->name('guru.kuis.store');
    });
});
Route::group(['middleware' => ['auth', 'checkRole:siswa']], function () {
    Route::get('/siswa/dashboard', [HomeController::class, 'siswa'])->name('siswa.dashboard');
    Route::get('/siswa/materi', [MateriController::class, 'siswa'])->name('siswa.materi');
    Route::get('/materi-download/{id}', [MateriController::class, 'download'])->name('siswa.materi.download');
    Route::get('/siswa/tugas', [TugasController::class, 'siswa'])->name('siswa.tugas');
    Route::get('/tugas-download/{id}', [TugasController::class, 'download'])->name('siswa.tugas.download');
    Route::post('/kirim-jawaban', [TugasController::class, 'kirimJawaban'])->name('kirim-jawaban');
    Route::get('/siswa/pengumuman', [PengumumanController::class, 'siswa'])->name('siswa.pengumuman');
    Route::get('/pengumuman-download/{id}', [PengumumanController::class, 'downloadPengumuman'])->name('siswa.pengumuman.download');
    Route::get('/siswa/galeri', [GaleriController::class, 'siswa'])->name('siswa.galeri');
    Route::get('/galeri-download/{id}', [GaleriController::class, 'downloadGaleri'])->name('siswa.galeri.download');
    Route::middleware(['auth', 'checkRole:siswa'])->group(function () {
        Route::get('/siswa/quiz', [QuizController::class, 'siswa'])->name('siswa.quiz');
        Route::get('/siswa/kuis/{quiz}', [QuizController::class, 'kerjakan'])->name('siswa.kuis.kerjakan');
        Route::post('/siswa/kuis/{quiz}/submit', [QuizController::class, 'submit'])->name('siswa.kuis.submit');
        Route::get('/siswa/kuis/{quiz}/hasil', [QuizController::class, 'showResults'])->name('siswa.kuis.hasil');
    });
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mapel', MapelController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('user', UserController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('aktivitas', AktivitasController::class);
});

Route::post('/message/send', [HomeController::class, 'store'])->name('message.send');
Route::delete('/message/{id}', [HomeController::class, 'delete'])->name('message.delete');
Route::post('/message/mark-as-read', [App\Http\Controllers\HomeController::class, 'markAsRead'])->name('message.markAsRead');

// Menambahkan route untuk guest
Route::get('/guest/home', [GuestController::class, 'home'])->name('pages.guest.home.index');
Route::get('/guest/tentang', [GuestController::class, 'tentang'])->name('pages.guest.tentang.index');
Route::get('/guest/galeri', [GuestController::class, 'galeri'])->name('pages.guest.galeri.index');
Route::get('/guest/fasilitas', [GuestController::class, 'fasilitas'])->name('pages.guest.fasilitas.index');
Route::get('/guest/contact', [GuestController::class, 'contact'])->name('pages.guest.contact.index');
Route::get('/guest/alumni', [GuestController::class, 'alumni'])->name('pages.guest.alumni.index');


Route::resource('hero', HeroController::class);
// Route::resource('news', NewsController::class);


Route::get('/guest/home/create', function () {
    return view('pages.admin.guest.home.createHero');
})->name('home.createHero');


Route::get('/guest/home/createNews', function () {
    return view('pages.admin.guest.home.createNews');
})->name('home.createNews');

Route::post('/home/store', action: [NewsController::class, 'store'])->name('home.store');
Route::get('/guest/home/editNews/{id}', [NewsController::class, 'edit'])->name('home.editNews');
Route::put('/home/update/{id}', [NewsController::class, 'update'])->name('home.update');
Route::delete('/home/destroy/{id}', [NewsController::class, 'destroy'])->name('home.destroy');


Route::get('/guest/tentang/create', function () {
    return view('pages.admin.guest.tentang.create');
})->name('tentang.create');

Route::get('/guest/prestasi/create/prestasi/akademik', function () {
    return view('pages.admin.guest.galeri.createAkam');
})->name('prestasi.create.prestasi.akademik');

Route::get('/guest/prestasi/create/prestasi/non-akademik', function () {
    return view('pages.admin.guest.galeri.createNakam');
})->name('prestasi.create.prestasi.non-akademik');

Route::post('/home/storeHero', [HeroController::class, 'store'])->name('home.storeHero');
// Route::post('/home/store', action: [NewsController::class, 'store'])->name('home.store');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');
Route::post('/about', [AboutController::class, 'store'])->name('about.store');
Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('about.edit');
Route::put('/about/{id}', [AboutController::class, 'update'])->name('about.update');
Route::delete('/about/{id}', [AboutController::class, 'destroy'])->name('about.destroy');


// Routing untuk menampilkan form tambah data
Route::get('/prestasi-akademik/create', [PrestasiAkademikController::class, 'create'])->name('prestasi-akademik.create');

// Routing untuk menyimpan data
Route::post('/prestasi-akademik', [PrestasiAkademikController::class, 'store'])->name('prestasi-akademik.store');

// Routing untuk menampilkan daftar prestasi akademik (halaman index)
Route::get('/guest/prestasi', [PrestasiAkademikController::class, 'index'])->name('guest.prestasi.index');

// Halaman form edit
Route::get('/prestasi-akademik/{id}/edit', [PrestasiAkademikController::class, 'edit'])->name('prestasi-akademik.edit');

// Proses update data
Route::put('/prestasi-akademik/{id}', [PrestasiAkademikController::class, 'update'])->name('prestasi-akademik.update');

// Proses hapus data
Route::delete('/prestasi-akademik/{id}', [PrestasiAkademikController::class, 'destroy'])->name('prestasi-akademik.destroy');



Route::resource('prestasi-non-akademik', PrestasiNonAkademikController::class);
// Route::get('/guest/prestasi/non-akademik', action: [PrestasiNonAkademikController::class, 'index'])->name('prestasi-non-akademik.index');

Route::resource('fasilitas', FasilitasController::class);


Route::get('/alumni', [AlumniController::class, 'index'])->name('pages.guest.alumni.index');
Route::get('/alumni/create', [AlumniController::class, 'create'])->name('alumni.create');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni.store');
Route::get('/alumni/{id}/edit', [AlumniController::class, 'edit'])->name('alumni.edit');
Route::put('/alumni/{id}', [AlumniController::class, 'update'])->name('alumni.update');
Route::delete('/alumni/{id}', [AlumniController::class, 'destroy'])->name('alumni.destroy');

Route::get('/{role}/dashboard', [MessageController::class, 'index'])->name('dashboard');
Route::post('/message/send', [MessageController::class, 'store'])->name('message.send');


Route::post('/quiz/store', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/guru/kuis', [QuizController::class, 'index'])->name('pages.guru.kuis.index');
Route::get('/siswa/quiz', [QuizController::class, 'siswa'])->name('siswa.quiz');
Route::get('/quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
Route::put('/quiz/{id}', [QuizController::class, 'update'])->name('quiz.update');
Route::delete('/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');
Route::get('/guru/kuis/{quizId}/hasil', [QuizController::class, 'hasil'])->name('quiz.hasil');


Route::prefix('admin')->middleware(['auth', 'checkRole:admin'])->group(function () {
    // Student (Siswa) routes
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.siswa.index');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('admin.siswa.create');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.siswa.store');
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('admin.siswa.show');
    Route::get('/siswa/{siswa}/edit', [SiswaController::class, 'edit'])->name('admin.siswa.edit');
    Route::put('/siswa/{siswa}', [SiswaController::class, 'update'])->name('admin.siswa.update');
    Route::delete('/siswa/{siswa}', [SiswaController::class, 'destroy'])->name('admin.siswa.destroy');
});
