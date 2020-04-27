<?php

namespace App\Providers;

use App\Category;
use App\Post;
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

            return $view->with('categories', Category::withPublishedPost()->get());

        });


        view()->composer('layouts.sidebar', function ($view) {

            return $view->with('popularPost', Post::byPopularity()->published()->take(3)->get());

        });

    }
}
