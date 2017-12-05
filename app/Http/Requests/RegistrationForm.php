<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

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
        return [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required|confirmed'
        ];
    }

    public function persist()  // after form validated and authorized
    {
      //  Create and save the user.
      // obj. is req., so use below: $user = User::create(request(['name', 'email', 'password']));
      // note: request([]) = request()->only([])
      // was (password not encrypted) 11/18/17: $user = User::create($this->only(['name', 'email', 'password']));
      $user = User::create([
        'name' => $this->get('name'),
        'email' => $this->get('email'),
        'password' => Hash::make($this->get('password')) // same as bcrypt()?
      ]);

/* ??? this is from /app/Http/Controllers/Auth/RegisterController:

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
}
