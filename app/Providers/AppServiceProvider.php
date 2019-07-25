<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Post;
use App\Tag;

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
            $tags = Tag::has('posts')->pluck('name');   //funkcija pluck će dati array iz column name i 
            //samo one ^^ (has)postovve okji imaju tag(taokl da ne dobijemo prazne tagove)
            $postsByViews = Post::popular();  //ovako pozivamo funkciju popular iz Post.php i predajemo postove

            $view->with(compact('postsByViews', 'tags'));

        });
    }

}
