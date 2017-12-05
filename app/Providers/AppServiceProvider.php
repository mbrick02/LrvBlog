<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

       // listen for when the sidebar is being composed and bind to that view
       // helper func. or with view facade: \View::composer();
       //    register callback function to bind anything to that view
       //    here we pass a closure/callback but could bind a class path
       //    with a dedicated class for your composer
       view()->composer('layouts.sidebar', function ($view) {
         $archives = \App\Post::archives();
         $tags = \App\Tag::has('posts')->pluck('name');
         $view->with(compact('archives', 'tags'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
