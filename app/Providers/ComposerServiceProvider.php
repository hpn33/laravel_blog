<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.sidebar', function ($view) {

//            dd(Category::with('posts')->get()->first());
//            dd(Category::with('posts')->get());

//            dd(Category::withPublishedPost()->get()->first()->posts->count());
            return $view->with('categories', Category::withPublishedPost()->get());

        });

    }
}
