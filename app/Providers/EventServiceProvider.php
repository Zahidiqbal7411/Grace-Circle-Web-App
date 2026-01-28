<?php



namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UserActivity;
use App\Listeners\UpdateUserLastSeen;
use App\Events\UserLoggedOut;
use App\Listeners\ClearUserLastSeen;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \Illuminate\Auth\Events\Registered::class => [
            \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        ],
        UserActivity::class => [
            UpdateUserLastSeen::class,
        ],
        UserLoggedOut::class => [
            ClearUserLastSeen::class,
        ],
    ];
}
