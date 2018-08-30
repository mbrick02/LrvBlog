<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'fname', 'lname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts() {
      return $this->hasMany(Post::class);
    }

    public function publish(Post $post){
      $this->posts()->save($post);
      // Create a new post using the request data
      // Post::create([
      //   'title' => request('title'),
      //   'body' => request('body'),
      //   'user_id' => auth()->id() // = auth()->user()->id
      // ]);
    }
    
    public function setPassword($password)
    {
        $this->password = bcrypt($password);
        
        return $this;
    }
    
    /*
     * 
  Hashing Password:
     * saw this recommended but xxnot using yet:
    https://laracasts.com/discuss/channels/laravel/create-method-on-user-model-bcrypt?page=1
     public function setPassword($password)
    {
        $this->password = bcrypt($password);
    
        return $this;
    }
     * 
     * 
     * 
     
     found this (password mutator) at:
     https://scotch.io/tutorials/password-verification-using-laravel-form-request
     // note: code site above this warned against using mutators for fear you would hash multiple times
     // Only accept a valid password and 
// hash a password before saving
public function setPasswordAttribute($password)
{
    if ( $password !== null & $password !== "" )
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
     * 
     */
    
}
