<?php

namespace App\Providers;

use App\Models\Question;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share questions and notifications with the header layout
        View::composer('layouts.header', function ($view) {
            $questions = \App\Models\Question::active()->ordered()->get();
            $notifications = [];
            if (auth()->check()) {
                $notifications = \App\Models\Notification::with(['sender.images', 'sender.galleries'])
                    ->where('user_id', auth()->id())
                    ->where('seen', 0)
                    ->orderBy('created_at', 'desc')
                    ->get();
            }
            $view->with([
                'questions' => $questions,
                'notifications' => $notifications
            ]);
        });
    }
}

