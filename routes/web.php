<?php

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

// Route::get('/', function () {
//     return view('guest.welcome');
// })->name('guest.index');

Auth::routes();

Route::middleware('auth') 
    ->namespace('Admin')
    ->name('admin.') 
    ->prefix('admin') 
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
        
        // Route::get('/categories', 'CategoryController@index')->name('categories.index');
        // Route::get('/categories/{category}', 'CategoryController@show')->name('categories.show');
        Route::get('/myposts', 'PostController@indexUser')->name('posts.indexUser');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
        // Route::resource('posts', 'ProductController');
        
    });

    Route::get("{any?}", function () {
        return view("guest.welcome");
    })->where("any", ".*")->name('guest.index');