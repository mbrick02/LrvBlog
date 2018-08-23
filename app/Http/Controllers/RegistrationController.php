<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Mail; // ??? from laracast discussion
// Dont need because construct has middleware('auth'): use Auth;

use Mail;
// in RegistrationForm: use App\User;
// in RegistrationForm: use App\Mail\Welcome;
use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['create']);
        // must be signed in to see PostsController pages, except index and show
    }
    
    public function create() {
      return view('registration.create');
    }

    public function store(RegistrationForm $form) {
        $form->persist();

        session()->flash('message', 'Thanks so much for signing up'); // flash 1 page load
        // session() = request()->session();
        // May have achieved below in controller???
        // ?session($key, $defaultVal) or session(['val' => 'ary']) helper ret cur val or default

       // Redirect to the home page.
       return redirect()->home(); // or redirect('/');

    }
    
    function profile() {
        // passed in: $user = User::find($id);
        // $fieldVals = ['username' => 'readonly', 'other' => 'readonly'];
        $field = 'username';
        $type = 'type="text" ';
        $class = 'class="form-control" ';
        $read = 'readonly="readonly" ';
        $idName = 'id="'. $field .'" name="'. $field .'" ';
        $value = 'value="'. auth()->user()->$field;        
        $fieldVals = ['username' => $type . $class . $idName . $read . $value . '"'];
        
        
        
        $field = 'email';
        $type = 'type="' . $field . '" ';
        $class = 'class="form-control" ';
        $read = 'readonly="readonly" ';
        $idName = 'id="'. $field .'" name="'. $field .'" ';
        $value = 'value="'. auth()->user()->$field;
        $fieldVals['email'] = $type . $class . $idName . $read . $value . '"';

        /**************
         * 
  
            type="text" class="form-control" id="username"
            name="username" readonly="readonly" value="{{ $user->username }}
            name="username" readonly="{{ $fieldVals['username'] }}" value="{{ $user->username }}" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
            <div class="form-group">
        <label for="fname">First Name:</label>
        <input type="text" class="form-control" id="fname" name="fname" required />
      </div>
      <div class="form-group">
        <label for="lname">Last Name:</label>
        <input type="text" class="form-control" id="lname" name="lname" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" 
        name="password" required />
      </div>
      <div class="form-group">
        <label for="password_confirmation">Password Confirmation:</label>
        <input type="password" class="form-control" id="password_confirmation" 
        name="password_confirmation" required />
      </div>
        ************************/
        
        
        return view('registration.profile', compact('user', 'fieldVals'));
    }
    
    // public function update(RegistrationForm $from) {  
    // 8/20/18 can we use same form and lock out certain fields prepopulate
    //  $form->update();
    public function edit(User $user) {
       return view('registration.edit', compact('user'));
    }
}
