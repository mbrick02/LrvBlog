@extends('layouts.simpleForm')
<!-- Tag create form -->
@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Create a new tag</h1>

        <hr>
        <!-- TODO: rework this tag create
       
		// TODO: rework this as tag create
       -->
        <form method="POST" action="/tags">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title"
            name="title" value="{{old('title')}}" required>
          </div>
          <div class="form-group">
          <!-- *** May not need tag cloud (below) for create page ?why would they come here if tag already exists???  -->
            <div class="tag-cloud">
                @php
              <fieldset class="tag-cloud">
                <legend class="tag-cloud">Tags to group by</legend>
                // 2 lines above wer above larvl php see posts/create 
                  // $lettercount = 0;
                  // $maxTagLetsPerLine = 30;
                  // had a "@foreach ($tags as $tag)" below see posts/create.blade.php 
                @endphp 

              <fieldset class="tag-button">
              	<!-- button to open tag create form holding form info in session var -->
              	<button class="button" 
              	onClick="window.open('/tags');">
              	<span class="icon">Open</span></button>
              </fieldset>
            </div>
          </div>

          <div class="form-group">
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control"
              value="{{old('body')}}" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
