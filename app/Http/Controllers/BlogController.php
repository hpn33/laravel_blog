<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class BlogController extends Controller
{

    protected $limit = 3;


    function index()
    {

        return view('blog.index', [
            'posts' => Post::forIndexPage($this->limit)
        ]);

    }

    function show(Post $post)
    {

        return view('blog.show', compact('post'));

    }


    function category(Category $category)
    {

        return view('blog.index', [
            'posts' => $category->posts()->forIndexPage($this->limit)
        ]);

    }
}
