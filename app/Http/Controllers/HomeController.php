<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Message;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        // Menghitung jumlah entitas
        $siswa = Siswa::count();
        $guru = Guru::count();
        $kelas = Kelas::count();
        $mapel = Mapel::count();

        // Mengambil data siswa dan guru dengan eager loading untuk relasi
        $dataSiswa = Siswa::with('kelas')->select('id', 'nama', 'kelas_id', 'nis')->get();
        $dataGuru = Guru::with('mapel')->select('id', 'nama', 'nip', 'mapel_id')->get();

        // Messaging data
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->with(['sender', 'receiver'])->get();
        $users = User::where('roles', '!=', $user->roles)->get();

        $users = User::where('roles', '!=', $user->roles)
            ->whereIn('roles', ['guru', 'siswa'])
            ->get();

        return view('pages.admin.dashboard', compact(
            'siswa',
            'guru',
            'kelas',
            'mapel',
            'dataSiswa',
            'dataGuru',
            'messages',
            'users'
        ));
    }

    public function guru()
    {
        $guru = Guru::where('user_id', Auth::user()->id)->first();
        $materi = Materi::where('guru_id', $guru->id)->count();
        $jadwal = Jadwal::where('mapel_id', $guru->mapel_id)->get();
        $tugas = Tugas::where('guru_id', $guru->id)->count();
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');

        // Messaging data
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->with(['sender', 'receiver'])->get();
        $users = User::where('roles', '!=', $user->roles)->get();

        $users = User::where('roles', '!=', 'admin')
            ->whereIn('roles', ['guru', 'siswa'])
            ->get();

        return view('pages.guru.dashboard', compact('guru', 'materi', 'jadwal', 'hari', 'tugas', 'messages', 'users'));
    }

    public function siswa()
    {
        $siswa = Siswa::where('nis', Auth::user()->nis)->first();

        // Check if student record exists
        if (!$siswa) {
            // Option 1: Redirect with an error message
            return redirect()->route('login')->with('error', 'Student record not found. Please contact administrator.');

            // Option 2: Show a custom error page
            // return view('errors.student-not-found');
        }

        $kelas = Kelas::findOrFail($siswa->kelas_id);
        $materi = Materi::where('kelas_id', $kelas->id)->limit(3)->get();
        $tugas = Tugas::where('kelas_id', $kelas->id)->limit(3)->get();
        $jadwal = Jadwal::where('kelas_id', $kelas->id)->get();
        $hari = Carbon::now()->locale('id')->isoFormat('dddd');

        // Messaging data
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->with(['sender', 'receiver'])->get();

        $users = User::where('roles', '!=', 'admin')
            ->whereIn('roles', ['guru', 'siswa'])
            ->get();

        return view('pages.siswa.dashboard', compact('siswa', 'kelas', 'materi', 'jadwal', 'hari', 'tugas', 'messages', 'users'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Validate role restrictions
        $receiver = User::findOrFail($request->receiver_id);
        if ($user->roles === 'admin') {
            // Admin can message guru and siswa
            if (!in_array($receiver->roles, ['guru', 'siswa'])) {
                return redirect()->back()->with('error', 'You can only send messages to guru or siswa.');
            }
        } else {
            // Guru and siswa can message guru and siswa, but not admin
            if ($receiver->roles === 'admin') {
                return redirect()->back()->with('error', 'You cannot send messages to admin.');
            }
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // Include the receiver's name in the success message
        return redirect()->back()->with('success', 'Message sent to ' . $receiver->name . '!');
    }

    public function delete($id)
    {
        $message = Message::findOrFail($id);

        // Ensure the authenticated user is the sender
        if ($message->sender_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You can only delete your own messages.');
        }

        $receiverName = $message->receiver->name; // Store receiver name before deletion
        $message->delete();

        return redirect()->back()->with('success', 'Message to ' . $receiverName . ' deleted successfully!');
    }

    public function markAsRead(Request $request)
    {
        $user = Auth::user();
        Message::where('receiver_id', $user->id)
            ->whereNull('read_at')
            ->update(['read_at' => Carbon::now()]);

        return response()->json(['success' => true]);
    }

}