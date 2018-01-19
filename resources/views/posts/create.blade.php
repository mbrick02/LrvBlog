@extends('layouts.master')
<!-- note: may need masterSess. above to set vals -->
@section('content')
<script type="text/javascript">

	function retrievTitleNOpenTagsForm() {
		// purpose is to set tile (and body) (?to session) to repopulate fields after new tag added 1/18 
		$postTitle = document.postCreateForm.elements["title"].value;
		$postBody = document.postCreateForm.elements["body"].value;
		
		

		// set title if given
		if ($postTitle) { //  || ((typeof $title) == undefined) || ($title == undefined) || ($title == null) || ($title == "")
			sessionStorage.setItem("postTitle", $postTitle);
		}

		if ($postBody) { //  || ((typeof $title) == undefined) || ($title == undefined) || ($title == null) || ($title == "")
			sessionStorage.setItem("postBody", $postBody);
		}
		
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
		  	$curBody = session('postBody', 'empty') ?: (session('postBody') ?: old('body'));
		  	// **???*** if (isset(_SESSION["postBody"])) { $curBody = _SESSION["postBody"]; }
		  	$curTitle = session('postTitle', '') ?: (session('postTitle') ?: old('title'));  
		  	// ***Use in title body tag below
		  	session()->forget('postTitle'); // clear
		  	session()->forget('postBody');
		  @endphp
          <div class="form-group">
            <label for="title">Title {{ Session::has('postTitle') ? Session::get('postTitle') : '*Debug* No Session post Title' }}</label>
            <input type="text" class="form-control" id="title" placeholder="Title"
            name="title" value="{{$curTitle}}" required>
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
            <label for="body">Body</label>
            <textarea id="body" name="body" class="form-control"
              value="{{$curBody}}" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
