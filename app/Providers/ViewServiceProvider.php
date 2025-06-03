<?php

namespace App\Providers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('partials.nav', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $messages = Message::where(function ($query) use ($user) {
                    $query->where('sender_id', $user->id)->orWhere('receiver_id', $user->id);
                })->with(['sender', 'receiver'])->get();

                // Apply role-based restrictions
                if ($user->roles === 'admin') {
                    $users = User::where('roles', '!=', $user->roles)
                                 ->whereIn('roles', ['guru', 'siswa'])
                                 ->get();
                } else {
                    $users = User::where('roles', '!=', 'admin')
                                 ->whereIn('roles', ['guru', 'siswa'])
                                 ->get();
                }

                // Calculate unread message count based on read_at
                $unreadCount = Message::where('receiver_id', $user->id)
                                      ->whereNull('read_at')
                                      ->count();

                // Debug logging
                Log::info('Unread count for user ' . $user->id . ': ' . $unreadCount);

                $view->with('messages', $messages)
                     ->with('users', $users)
                     ->with('unreadCount', $unreadCount);
            }
        });
    }
}