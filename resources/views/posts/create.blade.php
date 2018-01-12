@extends('layouts.master')
<!-- note: may need masterSess. above to set vals -->
@section('content')
<script type="text/javascript">

	function retrievTitleNOpenTagsForm() {
		// purpose is to set tile (and body) (?to session) to repopulate fields after new tag added 1/18 
		$title = document.postCreateForm.elements["title"].value;

		// below is to set title if none given but that may not be necessary
		if ((!$title)) { //  || ((typeof $title) == undefined) || ($title == undefined) || ($title == null) || ($title == "")
			$title = "No Title Given";
		}
		// test: alert(typeof $title);
		// test: alert('title now is: ' + $title); // . " -- type: " . typeof($title));
		window.open('/tags/create');
		return true;
	}
//
</script>
    <div class="col-sm-8 blog-main">
        <h1>Publish a Post</h1>

        <hr>

        <form method="POST" action="/posts" name="postCreateForm">

          {{ csrf_field() }}

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title"
            name="title" value="{{old('title')}}" required>
          </div>
          <div class="form-group">
            <div class="tag-cloud">
              <fieldset class="tag-cloud">
                <legend class="tag-cloud">Tags to group by</legend>
                @php
                  $lettercount = 0;
                  $maxTagLetsPerLine = 30;
                @endphp
                @foreach ($tags as $tag)
                 @if ($lettercount > $maxTagLetsPerLine)
                  <br />
                  $lettercount = 0;
                 @endif
                  <div class="tag-item">
                    <input type="checkbox" name="tags[]" value="{{$tag->name}}"
                    id="{{$tag->name}}">
                    <label for="{{$tag->name}}">{{$tag->name}}</label>
                  </div>
                  @php
                    $lettercount = $lettercount + strlen("{{$tag->name}}");
                  @endphp
                @endforeach
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
              value="{{old('body')}}" required></textarea>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary">Publish</button>
          </div>
          @include('layouts.errors')
        </form>
    </div>
@endsection
