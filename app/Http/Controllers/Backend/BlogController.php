<?php

namespace App\Http\Controllers\Backend;

use App\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BlogController extends BackendController
{
    protected $limit = 5;

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $posts = Post::with('category', 'author')->latest()->paginate($this->limit);
        $postCount = Post::count();

        return view("backend.blog.index", compact('posts', 'postCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {

        return redirect('/backend/blog/index');
    }


}
