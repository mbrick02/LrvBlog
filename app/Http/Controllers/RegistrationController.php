<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Mail; // ??? from laracast discussion

use Mail;
// in RegistrationForm: use App\User;
// in RegistrationForm: use App\Mail\Welcome;
use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    public function create() {
      return view('registration.create');
    }

    public function store(RegistrationForm $form) {
        $form->persist();

        session()->flash('message', 'Thanks so much for signing up'); // flash 1 page load
        // session() = request()->session();
        // session($key, $defaultVal) or session(['val' => 'ary']) helper func ret cur val or default

       // Redirect to the home page.
       return redirect()->home(); // or redirect('/');

    }
}
