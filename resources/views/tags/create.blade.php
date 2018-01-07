@extends('layouts.simpleForm')
<!-- Tag create form -->
@section('content')
<script type="text/javascript">
<!--
	window.onload = function(){
	alert('Tag window open captured title is {{$title}}');
	};
//-->
</script>
    <div class="col-sm-8 blog-main">
        <h1>Create a new tag</h1>

        <hr>
        <!-- TODO: rework this tag create
       
		// TODO: rework this as tag create -- make sure tag DOES NOT already exist
       -->
        <form method="POST" action="/tags">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">New Tag</label>
            <input type="text" class="form-control" id="newTag" placeholder="NewTag"
            name="title" value="{{old('newTag')}}" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Tag</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
