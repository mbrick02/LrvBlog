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

/* Ep.s 7-9 Eloquent, Controllers, and Route Model Binding
    Task example
use App\Task; // allows us to not always ref App\

Route::get('/', function () {
    // return view('welcome', ['name' => 'World1']);
    // return view('welcome')->with('name', 'MBer');
    // $name = 'Jeffrey'; return view('welcome', ['name' => $name]);
    // $tasks = ['1st item on list','2nd finish book','make a million'];
    $tasks = DB::table('tasks')->get();  // Laravel Query Builder more specific: DB::table('tasks')->latest()->get();
    // $tasks = Task::get();

  	// return $tasks; --  creates JSON formatted list of tasks from DB use Chrome app, JSON formatter -> view
    return view('welcome', compact('tasks'));
});
Route::get('/tasks', 'TasksController@index');
// method responsible for displaying all of a resource you will generally call it (by convention) an 'index'

Route::get('/tasks/{task}', 'TasksController@show');
// method responsible for showing a single resource is, by convention called 'show'
// wild card name must match route model binding arg in controller
*/

/*
Route::get('/tasks/{task}', function($id) {  // {} signify wildcard which will replace arg in function
	// dd($id); -- great debug helper function "dump and die"
// $task = DB::table('tasks')->find($id);
    $task = Task::find($id);

	return view('tasks/show', compact('task')); // OR view('tasks.show'...
});

Route::get('/tasks', function () {
	$tasks = DB::table('tasks')->latest()->get();

	return view('tasks.index', compact('tasks'));
});
*/
