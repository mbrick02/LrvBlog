@extends('layouts.master')
@section('title')
	User Profile
@endsection
@section('content')
  <div class="col-sm-8">
    <h1>Register</h1>

    <form method="xxPOST" action="/profile">
      {{ csrf_field() }}

      <div class="form-group">
        <label for="username">Username:</label><!--  *** NOT Editable ***?  -->
       <!-- <input type="text" class="form-control" id="username" 
        name="username" 
        readonly="{x{ $fieldVals['username'] }x}" 
        value="{x{ Auth::user()->username }x}" required /> -->
        <input {!! $fieldVals['username'] !!} />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input {!! $fieldVals['email'] !!} />
        <!-- type="email" class="form-control" id="email" name="email" required / > --> 
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

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Edit</button>
        <p>Make link to Cancel Exit without editing</p>
      </div>
      <div class="form-group">
        @include('layouts.errors')
      </div>

    </form>
  </div>

@endsection