<?php

namespace App\Http\Controllers\Backend;


class DashboardController extends BackendController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
