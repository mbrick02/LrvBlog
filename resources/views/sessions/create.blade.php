@extends('layouts.master')

@section('content')
  <div class="col-md-8">
    <h1>Sign In</h1>
  </div>

  <form method="POST" action="/login">
    {{ csrf_field() }}
    <div class="form-group">
    <h1>Username Or Email</h1>
    </div>
    
    <div class="form-group">
      <label for="email">Username (Or):</label>
      <input type="email" class="form-control" id="username" name="username" required />
    </div>
    <div class="form-group">
      <label for="email">(Or) Email:</label>
      <input type="email" class="form-control" id="email" name="email" required />
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" name="password" required />
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Sign In</button>
    </div>
    <div class="form-group">
      @include('layouts.errors')
    </div>

  </form>
@endsection
