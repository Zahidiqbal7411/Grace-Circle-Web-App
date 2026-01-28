<?php
namespace App\Listeners;

use App\Events\UserActivity;
use Carbon\Carbon;

class UpdateUserLastSeen
{
    public function handle(UserActivity $event)
    {
        $event->user->update([
            'last_seen' => Carbon::now()
        ]);
    }
}
