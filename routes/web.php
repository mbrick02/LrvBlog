<?php

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

// Route::get('/', 'PostsController@index');
Route::get('/', 'PostsController@index')->name('home');

Route::get('/posts/create', 'PostsController@create');
// having a resource of "posts" route to GET "/posts" to view all posts
//  GET /posts/create to go to form to create a post
//      submitting create form will store the form in db: POST (to) /posts
// Edit: GET /posts/{id}/edit => PATCH /posts/{id}

Route::post('/posts', 'PostsController@store');

// *** SHOW individual post:
Route::get('/posts/{post}', 'PostsController@show');

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::post('/posts/{post}/comments', 'CommentsController@store');
   // new controller w/common action name OR: 'PostController@storeComment'

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/tags/create', 'TagsController@create');
// TODO set up TagsController@create 
/* @todo set up TagsController@create */

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');
    // **CHANGE: best practice is to make logout a post() so others cant log u out
