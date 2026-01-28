<?php

namespace App\Listeners;

use App\Events\UserLoggedOut;

class ClearUserLastSeen
{
    public function handle(UserLoggedOut $event)
    {
        $event->user->update([
            'last_seen' => null,
        ]);
    }
}
