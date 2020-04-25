<?php

namespace App\Http\Controllers;

use App\Post;

class BlogController extends Controller
{

    protected $limit = 3;


    function index()
    {

    	$posts = Post::forIndexPage($this->limit);

    	return view('blog.index', compact('posts'));

    }

    function show(Post $post)
    {

        return view('blog.show', compact('post'));

    }
}
