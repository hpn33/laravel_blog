<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends BackendController
{
    /**
     * Show the application dashboard.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        return view('backend.home');

    }
}
