@extends('layouts.simpleForm')
<!-- Tag create form also note: may need sess. above -->
@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Create a new tag</h1>

        <hr>
        <form method="POST" action="/tags/create">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="tagName">New Tag:</label>
            <input type="text" class="form-control" id="newTag" placeholder="New Tag Name"
            name="name" value="{{old('newTag')}}" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Create Tag</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
