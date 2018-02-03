<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SessionsController extends Controller
{
  public function __construct() {
    $this->middleware('guest', ['except' => 'destroy']);
    // filter only guests access pages (can't login twice)
  }
  public function create() {
    return view('sessions.create');
  }

  public function store() {
    $field = filter_var(request()->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
    $this->validate(request(), [
        'login' => 'required',
        'password' => 'required'
    ]);
    
    // TODO: have login option on username or email
    request()->merge([$field => request()->input('login')]);  // create a request field based on wheter email or login
    
    // TODO: DELETE should be unusede now: $mbAuth = false;
    // Attempt to authenticate the user by email or username, and password
    if(!auth()->attempt(request([$field, 'password']))) {
        // If neither works, redirect back.
        return back()->withErrors([
          'message' => 'Please check credentials and try again.'
        ]);
    }

    // auth() signs them in.

    // Redirect to home page
    return redirect()->home();
  }

  public function destroy() {
      auth()->logout();
      return redirect()->home();
  }

}
