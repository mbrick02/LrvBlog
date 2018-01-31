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
    $lookupFld = 'email';
    $lookupFld2 = 'username';
    $mbAuth = false;
    // Attempt to authenticate the user by email or username, and password
    if((!auth()->attempt(request([$lookupFld, 'password']))) && (!auth()->attempt(request([$lookupFld2, 'password'])))) {
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
