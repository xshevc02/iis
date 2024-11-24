<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Support\Facades\DB;

class UpdateSessionWithRole
{
    public function __construct()
    {
        //
    }

    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;

        // Обновляем роль в сессии в базе данных
        DB::table('sessions')
            ->where('user_id', $user->id)
            ->update(['role_id' => $user->role_id]);
    }
}
