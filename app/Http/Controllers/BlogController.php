<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;

class BlogController extends Controller
{

    protected $limit = 3;


    function index()
    {

        $categories = Category::with('posts')->orderBy('title', 'asc')->get();

        $posts = Post::forIndexPage($this->limit);

    	return view('blog.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);

    }

    function show(Post $post)
    {

        $categories = Category::orderBy('title', 'asc')->get();

        return view('blog.show', compact('post', 'categories'));

    }


    function category(Category $category)
    {

        $categories = Category::withAvailablePost()->get();
        $posts = Post::filterBy($category)->forIndexPage($this->limit);
//        dd($posts);

        return view('blog.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);

    }
}
