<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateLastLogin
{
    public function handle(Login $event): void
    {
        $user = $event->user;
        $user->last_login_at = Carbon::now();
        $user->save();

        \Log::info('Last login updated for user ID: ' . $user->id . ' at ' . Carbon::now());
    }
}