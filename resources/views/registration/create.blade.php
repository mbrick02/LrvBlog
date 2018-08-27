@extends('layouts.master')
@section('title')
	Register User
@endsection
@section('content')
  <div class="col-sm-8">
    <h1>Register</h1>

    <form method="POST" action="/register">
      {{ csrf_field() }}

	@foreach ($fieldVals as $key => $fieldVal)
      	<div class="form-group">
      		<label for="{{ $key }}">{{ ucfirst($key) }}: </label>
      		<input {!! $fieldVal !!} />
      	</div>
	@endforeach

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Register</button>
      </div>
      <div class="form-group">
        @include('layouts.errors')
      </div>

    </form>
  </div>

@endsection
