<?php
// app/Http/Middleware/TrackUserActivity.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Events\UserActivity;

class TrackUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Dispatch event instead of directly updating
            event(new UserActivity(Auth::user()));
        }

        return $next($request);
    }
}
