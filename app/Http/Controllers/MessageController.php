<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class MessageController extends Controller
{
    public function index($role)
    {
        $user = Auth::user();
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
        })->with(['sender', 'receiver'])->get();

        $users = User::where('role', '!=', $user->role)->get();
        return view('dashboard', compact('messages', 'users', 'role', 'siswa', 'guru', 'mapel', 'kelas', 'materi', 'tugas', 'jadwal', 'hari', 'dataSiswa', 'dataGuru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Message sent!');
    }
}