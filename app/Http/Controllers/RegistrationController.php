<?php

namespace App\Http\Controllers;
// use Illuminate\Support\Facades\Mail; // ??? from laracast discussion
// Dont need because construct has middleware('auth'): use Auth;

use Mail;
// in RegistrationForm: 
use App\User;
// in RegistrationForm: use App\Mail\Welcome;
use App\Http\Requests\RegistrationForm;

class objFrmField {
    
    var $field;
    var $aclass;
    var $read;
    var $idName;
    var $value;
    var $fieldVals;
    
    public function __construct($field, $aclass, $read='', $type='text') {
                         $this->field = $field;
                         $this->type = 'type="' . $type . '" ';
                         $this->aclass = 'class="'. $aclass .'" ';
                         if ($read != ''){
                            $this->read = 'readonly="'. $read . '" ';
                         }
                         $this->idName = 'id="'. $field .'" name="'. $field .'" ';
                         if ((auth()->user()) && (auth()->user()->$field)) {
                            $this->value = 'value="'. auth()->user()->$field . '"';
                         } else {
                             $this->value = '';
                         }
                         $this->fieldVals =  $this->type . $this->aclass . $this->idName . $this->read . $this->value;
    }
    
//     example of html for above:     
//     <div class="form-group">
//     <label for="password_confirmation">Password_confirmation: </label>
//     <input type="password" class="form-control" id="password_confirmation" 
//      name="password_confirmation" readonly="readonly" value="xxxu7VU5EEIMaDO2W5F2wPjgP2lSFkxxx" />
//     </div>
}

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['create']);
        // must be signed in to see RegistrationController pages, create
    }
    
    public function create() {
        $aryTxtFlds = array('username', 'fname', 'lname');
        
        $aryAllFlds = array('username', 'email', 'fname', 'lname', 'password', 'password_confirmation');
        
        foreach ($aryAllFlds as $field) {
            if (in_array($field, $aryTxtFlds)) {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control');
            } elseif($field == "password_confirmation") {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', '', 'password');
            } else { // $field names the type
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', '', $field);
            }
            $fieldVals[$field] = $aryFldObjs[$field]->fieldVals;
        }
        
        return view('registration.create', compact('fieldVals'));
    }

    public function store(RegistrationForm $form) {
        $form->persist();

        session()->flash('message', 'Thanks so much for signing up'); // message shows and fades

       // Redirect to the home page.
       return redirect()->home(); // or redirect('/');
    }
    
    function profile(User $user) {
        $aryTxtFlds = array('username', 'fname', 'lname');

        $aryAllFlds = array('username', 'email', 'fname', 'lname');
        
        // display example
        
        foreach ($aryAllFlds as $field) {
            $this->value = 'value="'. auth()->user()->$field . '"';
            if (in_array($field, $aryTxtFlds)) {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', 'readonly');
            } elseif($field == "password_confirmation") {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', 'readonly', 'password');
            } else { // $field names the type
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', 'readonly', $field);
            }
            
            $fieldVals[$field] = $aryFldObjs[$field]->fieldVals;
        }
        
        $method = "post";
        
        return view('registration.profile', compact('user', 'fieldVals', 'method'));
    }
    
    public function edit(User $user) {
        $aryTxtFlds = array('username', 'fname', 'lname');
        
        $aryAllFlds = array('username', 'email', 'fname', 'lname');
        // add these BUT make optional with Change Password button: , 'password', 'password_confirmation'
        
        foreach ($aryAllFlds as $field) {
            $this->value = 'value="'. auth()->user()->$field . '"';
            if (in_array($field, $aryTxtFlds)) {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control');
            } elseif($field == "password_confirmation") {
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', '', 'password');
            } else { // $field names the type
                $aryFldObjs[$field] = new objFrmField($field, 'form-control', '', $field);
            }
            
            $fieldVals[$field] = $aryFldObjs[$field]->fieldVals;
        }
        
        $method = "patch";
        
        return view('registration.editprofile', compact('user', 'fieldVals', 'method'));
    }
    
    public function update(RegistrationForm $form) {
        $form->patch();
        
        session()->flash('message', 'Profile has been updated'); // flash 1 page load

        // Redirect to profile.
        return redirect()->route('home'); // or 'profile', ['id' => Auth::user()->id] redirect('/');
    }
}
