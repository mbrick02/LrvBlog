@extends('layouts.master')
@section('title')
	User Profile
@endsection
@section('content')
  <div class="col-sm-8">
    <h1>Register</h1>

    <form method="POST" action="/profile/{{ Auth::user()->id }}/edit">
	{{ csrf_field() }}
	@if (strpos(Request::url(), 'edit') == true)
		{{ method_field('PATCH') }}
	@endif
      
      @foreach ($fieldVals as $key => $fieldVal)
      	<div class="form-group">
      		<label for="{{ $key }}">{{ ucfirst($key) }}: </label>
      		<input {!! $fieldVal !!} />
      	</div>
      @endforeach

      <div class="form-group">
        <button type="submit" class="btn btn-primary">Edit</button>
        <a class="btn btn-primary" href="/" role="button">Cancel</a>
        
      </div>
      <div class="form-group">
        @include('layouts.errors')
      </div>

    </form>
  </div>

@endsection