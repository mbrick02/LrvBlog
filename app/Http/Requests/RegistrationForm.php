<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
        
            case 'POST':
            {
                return [
                  'username' => 'required',
                  'fname' => 'required',
                  'lname' => 'required',
                  'email' => 'required|email',
                  'password' => 'required|confirmed|min:7'
                ];
            }
            
            case 'PATCH':
            {
                if (strlen(request('password')) > 0) {
                    return [
                        'username' => 'required|min:4',
                        'fname' => 'required',
                        'lname' => 'required',
                        'email' => 'required|email',
                        //?? 'old_password' => 'Hash::check(request('old_password'), $user->password)',
                        'old_password' => 'required',
                        'password' => 'required|confirmed|required_with:password_confirmation|min:7',
                    ];
                }else {  // no password change
                    return [
                        'username' => 'required',
                        'fname' => 'required',
                        'lname' => 'required',
                        'email' => 'required|email',
                    ];
                }
            }
            default:break;
        }
    }
    
    public function withValidator($validator)  // force error on password check
    {
        // checks user current password
        // before making changes
        $validator->after(function ($validator) {
            if ( !Hash::check($this->old_password, $this->user()->password) ) {
                $validator->errors()->add('current_password', 'Your old password entry is incorrect.');
            }
        });
            return;
    }
    
    public function messages() {
        return [
            'username.required' => 'Please supply a username',
            'password.confirmed' => 'new password did not match confirmation password',
        ];
    }

    public function persist()  // after form validated and authorized
    {
      //  Create and save the user. called by RegistrationController@store
      // obj. is req., so use below: $user = User::create(request(['name', 'email', 'password']));
      // note: request([]) = request()->only([])
      $user = User::create([
        'username' => $this->get('username'),
        'fname' => $this->get('fname'),
        'lname' => $this->get('lname'),
        'email' => $this->get('email'),
        'password' =>  User::setPassword($this->get('password')),
        // old (pre 8/29/18 see belod: 'password' => \Hash::make($this->get('password')) // same as bcrypt()?
      ]);

        /* from old ver of /app/Http/Controllers/Auth/RegisterController:

        create(array $data)
        {
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
             ]);
                'n'
        **********************from RegisterController    */


      // Sign them in.
      auth()->login($user);
        // -- if you use helper func dont have to import class above

      \Mail::to($user)->send(new Welcome($user));
    }
    
    public function patch()
    {
        $user = User::find($this->user()->id);
        // May NOT WANT username changed: $user->username = request('name');
        $user->fname = request('fname');
        $user->lname = request('lname');
        $user->email = request('email');
        
        if (strlen(request('password')) > 0) {
            // ONLY IF new password & old password verified
            if (Hash::check(request('old_password'), $user->password)) {
                $user->password =>  User::setPassword($this->get('password'));
                // $user->password = \Hash::make($this->get('password'));
            } else {  // should now be handled in withValidator
                // ***DEBUG
                // dd('Old PW did NOT hash');
                // $validator->errors()->add('current_password', 'Your old password entry is incorrect.');
                session()->flash('message', 'Old Password did not match');
                
                // return redirect('/');
                // redirect back to page
                // return back();
                // return redirect()->route('profileedit', ['user' => $user->id]);
            }
        }
        
        // $user->save();
        
        // \Mail::to($user)->send(new Update($user));
    }
}
