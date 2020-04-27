<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('/index', [
    'uses' => 'BlogController@index',
    'as' => 'blog'
]);


Route::get('/posts/{post:slug}', [
    'uses' => 'BlogController@show',
    'as' => 'blog.show'
]);


Route::get('/category/{category:slug}', [
    'uses' => 'BlogController@category',
    'as' => 'category'
]);

Route::get('/author/{author:slug}', [
    'uses' => 'BlogController@author',
    'as' => 'author'
]);
