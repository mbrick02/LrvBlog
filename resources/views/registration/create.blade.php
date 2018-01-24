@extends('layouts.master')

@section('content')
  <div class="col-sm-8">
    <h1>Register</h1>

    <form method="POST" action="/register">
      {{ csrf_field() }}

      <div class="form-group"><!--  **** DELETE *** Original Name field -->
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" required />
      </div>
      <div class="form-group"><!--  *** NEW FIELD 1/18  -->
        <label for="name">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required />
      </div>
            <div class="form-group">
        <label for="name">First Name:</label><!--  *** NEW FIELD 1/18 -->
        <input type="text" class="form-control" id="fname" name="fname" required />
      </div>
      <div class="form-group">
        <label for="name">Last Name:</label><!--  *** NEW FIELD 1/18 -->
        <input type="text" class="form-control" id="lname" name="lname" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required />
      </div>
      <div class="form-group">
        <label for="password_confirmation">Password Confirmation:</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required />
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
      <div class="form-group">
        @include('layouts.errors')
      </div>

    </form>
  </div>

@endsection
