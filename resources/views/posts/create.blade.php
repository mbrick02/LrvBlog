@extends('layouts.master')
<!-- note: may need masterSess. above to set vals -->
@section('content')
<script type="text/javascript">

	function retrievTitleNOpenTagsForm() {		
		// window.open('/tags/create');  -- instead we POST to tags/create route
		document.postCreateForm.method = "get";  // want to open (web.php) Route::get('/tags/create', 'TagsController@create'); 
		document.postCreateForm.action ="/tags/create";
		document.postCreateForm.submit();
		
		return true;
	}
//
</script>
    <div class="col-sm-8 blog-main">
        <h1>Publish a Post</h1>

        <hr>

        <form method="POST" action="/posts" name="postCreateForm">

          {{ csrf_field() }}

		  @php
		  	$restoreBody = session('postBody', '') ?: (session('postBody') ?: old('body'));
		  	$restoreTitle = session('postTitle', '') ?: (session('postTitle') ?: old('title'));  
		  	
		  	session()->forget('postTitle'); // clear old to get new field val if we leave the page
		  	session()->forget('postBody');
		  @endphp
          <div class="form-group">
          	<input type="hidden" name="form_type" value="createPostForm">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" placeholder="Title"
            name="title" value="{{$restoreTitle}}" required>
          </div>
          <div class="form-group">
            <div class="tag-cloud">
              <fieldset class="tag-cloud">
                <legend class="tag-cloud">Tags to group by</legend>                
                <div class="tag-item clearfix">
                    @foreach ($tags as $tag)
                     <span class="tag-item">
                        <input type="checkbox" name="tags[]" value="{{$tag->name}}"
                        id="{{$tag->name}}">
                        <label for="{{$tag->name}}">{{$tag->name}}</label>
                     </span>
                    @endforeach
                </div>
              </fieldset>
              <fieldset class="tag-button">
              	<!-- button to open tag create form holding form info in session var -->
              	<button class="button" type="button" 
              	onClick="return retrievTitleNOpenTagsForm();">
              	<span class="icon">Create New Tag</span></button>
              </fieldset>
            </div>
          </div>

          <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="body" name="body" class="form-control"
               required>
               {{$restoreBody}}</textarea> 
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
