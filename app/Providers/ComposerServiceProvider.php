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

            return $view->with('categories', Category::withPublishedPost()->get());

        });

    }
}
