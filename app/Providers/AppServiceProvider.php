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
        // Share questions with the header layout for registration modal
        View::composer('layouts.header', function ($view) {
            $questions = Question::active()->ordered()->get();
            $view->with('questions', $questions);
        });
    }
}

