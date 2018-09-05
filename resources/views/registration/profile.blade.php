@extends('layouts.master')
@section('title')
	User Profile
@endsection
@section('content')
  <div class="col-sm-8">
    <h1>Register</h1>

    <form method="POST" action="/profile/{{ Auth::user()->id }}/edit">
	{{ csrf_field() }}
	@if ($method == 'patch')
		{{ method_field('PATCH') }} <!--  run in "edit/patch" mode -->
	@endif
      
    @foreach ($fieldVals as $key => $fieldVal)
    <div class="form-group">
    	<label for="{{ $key }}">{{ ucfirst($key) }}: </label>
    	<input {!! $fieldVal !!} />
    </div>
    @endforeach
      
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
        @if  ($method == 'patch')
        	Save
        @else
        	Edit
		@endif        
        </button>
        <a class="btn btn-primary" href="{{ url()->previous() }}" role="button">Cancel</a>
        
    </div>
    <div class="form-group">
        @include('layouts.errors')
    </div>

    </form>
  </div>

@endsection