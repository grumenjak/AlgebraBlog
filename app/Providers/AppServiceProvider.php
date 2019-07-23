<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Pri startupu da pokrene funkciju iz PostController.php
        //inject u layouts/sidebar.blade.php i onda pozovi callback funkciju
        view()->composer('layouts.sidebar', function($view){
            $view->with('postsByViews', Post::orderBy('views', 'desc')->get()); 
        });
    }
}
