<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the default login method to provide a custom login attempt.
     */
    public function login(Request $request)
    {
        // Validasi input form
        $this->validateLogin($request);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika email tidak ditemukan, beri pesan kesalahan
            throw ValidationException::withMessages([
                'email' => ['Email yang Anda masukkan tidak terdaftar.'],
            ]);
        }

        // Cek apakah password salah
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Jika password salah, beri pesan kesalahan
            throw ValidationException::withMessages([
                'password' => ['Password yang Anda masukkan salah.'],
            ]);
        }

        // Jika login berhasil, redirect sesuai dengan role pengguna
        return $this->authenticated($request, Auth::user());
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->roles == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->roles == 'guru') {
            return redirect()->route('guru.dashboard');
        } else {
            return redirect()->route('siswa.dashboard');
        }
    }
}
