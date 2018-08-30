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
      
      
	<div class="pwFields form-group">
        <a class="btn btn-primary" id="chPW" href="#" role="button">
        	Change Password
        </a>
        <div class="hidePW form-group">
    		<label for="password">Old Password: </label>
    		<input type="password" class="form-control" id="old_password" 
    		name="old_password" />
    	</div>
        <div class="hidePW form-group">
    		<label for="password">New Password: </label>
    		<input type="password" class="form-control" id="password" value="{{ old('password') }}"
    		name="password" />
    	</div>
    	<div class="hidePW form-group">
    		<label for="password_confirmation">Confirm New Password: </label>
    		<input type="password" class="form-control" id="password_confirmation" 
    		name="password_confirmation" />
    	</div>
    </div>
      
      

      <div class="form-group">
        <button type="submit" class="btn btn-primary">
        @if  ($method == 'patch')
        	Save
        @else
        	Edit
		@endif        
        </button>
        <a class="btn btn-primary" href="/" role="button">Cancel</a>
        
      </div>
      <div class="form-group">
        @include('layouts.errors')
      </div>

    </form>
  </div>
  
  <script>
  $(function () {
      $("#chPW").click(function () {
          $('.hidePW').toggle()
      });
  });
  </script>

@endsection