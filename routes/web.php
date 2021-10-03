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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login');
        Route::post('/login', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {//middleware routes with authorization required
        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    
        /**
         * Posts Routes
         */
        Route::get('posts', 'PostsController@posts')->name('posts');
        Route::post('posts', 'PostsController@postPost')->name('posts.post');
        Route::get('posts/{id}', 'PostsController@show')->name('posts.show');
        Route::get('post', 'PostsController@show_create')->name('post');
        Route::post('post', 'PostsController@create_post')->name('post.perform');
        Route::get('post/{id}/{user_id}', 'PostsController@destroy')->name('post.delete');
        Route::post('edit_post', 'PostsController@edit_post')->name('edit_post');
        Route::get('post_edit/{auth_id}/{post_id}', 'PostsController@select_post')->name('post_edit');
    });
});
