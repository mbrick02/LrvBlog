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


// TODO: Need to have 'catch-all' through http or laravel so bad addresses arent errors
// Route::get('/', 'PostsController@index');
// TODO: 08/18 combine most Route::get/post/edit/show into Route::resource() 
Route::get('/', 'PostsController@index')->name('home');
Route::get('/posts', 'PostsController@index');

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
   // as new controller w/common action name (or could have added: 'PostController@storeComment')
   
   // TODO at some point, I need to ADD edit forms for user, post (?and tags?)
   		// STARTING WITH edit for post
Route::get('/posts/{post}/edit', 'PostsController@edit');
Route::patch('/posts/{post}/edit', 'PostsController@patch');

Route::get('/tags/create', 'TagsController@create');
Route::get('/tags/{post}/create', 'TagsController@createWPost');

Route::post('/tags/create', 'TagsController@store');
Route::post('/tags/{post}/create', 'TagsController@storeWPost');

    // **CHANGE: best practice is to make logout a post() so others cant log u out
Route::get('/product', 'ProductController@getIndex')->name('product.index');
Route::get('/shopping-cart', 'ProductController@getCart')->name('product.shoppingCart');

Route::get('/reduce/{id}', 'ProductController@getReduceByOne')->name('product.reduceByOne');
 // added this for vid #9
 
Route::group(['middleware' => 'guest'], function() { 	// only guest/unauthenticated users may signup
    // Route::get('/signup', 'UserController@getSignup')->name('user.signup');
    Route::get('/register', 'RegistrationController@create')->name('signup');
    Route::post('/register', 'RegistrationController@store')->name('signup');
    Route::get('/login', 'SessionsController@create')->name('login');
    Route::post('/login', 'SessionsController@store')->name('login');
});

Route::group(['middleware' => 'auth'], function() { 	// only authenticated users
    Route::get('/profile/{user}', 'RegistrationController@profile')->name('profile');
    Route::get('/logout', 'SessionsController@destroy')->name('logout');
});

