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

            $view->with('categories', Category::withPublishedPost()->get());
            $view->with('popularPost', Post::byPopularity()->published()->take(3)->get());

            return $view;

        });

    }
}
