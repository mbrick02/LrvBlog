@extends('layouts.master')

@section('content')
	<script type="text/javascript">

    	function openTagsForm() {
    		document.postEditForm.method = "get";  // want to open (web.php) Route::get('/tags/create', 'TagsController@create'); 
    		document.postEditForm.action ="/tags/{{ $post->id }}/create";
    		document.postEditForm.submit();
    		
    		return true;
    	}
	</script>
  <div class="col-sm-8 blog-main">
    <h1>Edit a Post</h1>
    
    <hr>
    <form method="POST" action="/posts/{{ $post->id }}/edit" name="postEditForm">
        {{ csrf_field() }}
        {{ method_field('PATCH') }} 
        @php
          $restoreBody = session('postBody', '') ?: (session('postBody') ?: $post->body); // ?should $post->body be old('body')
          $restoreTitle = session('postTitle', '') ?: (session('postTitle') ?: $post->title);
          $restoreCheckedTags = session('postTags.tag', '') ?: (session('postTags.tag') ?: $post->tags);
          	
          session()->forget('postTitle'); // clear old to get new field val if we leave the page
          session()->forget('postBody');
          session()->forget('postTags'); // ?will this remove postTags.tag & subdirs
        @endphp
    
        <div class="form-group">
        <!--  DEL NO LONGER using: input type="hidden" name="form_type" value="editPostForm" -->
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" placeholder="Title"
        name="title" value="{{ $restoreTitle }}" required>
        </div>
        <div class="form-group">
        <div class="tag-cloud">
        <fieldset class="tag-cloud">
        <legend class="tag-cloud">Tags to group by</legend>
        <div class="tag-item clearfix">
       
        @if (count($restoreCheckedTags)) {{-- TODO: test for existing tags 2/16/18 --}}
      		@php	$postTags = array(); @endphp
        	@if ($postTagNames) { {{-- names are stored in postTagNames -- restoreCheckedTags is objects --}}
            	@foreach ($postTagNames as $setTag)
            		@php
            			array_push($postTags, $setTag);
            		@endphp
            	@endforeach
        	@else {{-- names are stored in restoreCheckedTags is objects --}}
            	@foreach ($restoreCheckedTags as $setTag)
            		@php
            			array_push($postTags, $setTag);
            		@endphp
            	@endforeach        	
        	@endif
        @endif
        
        @foreach ($tags as $tag)
        	<!--  DEL *** @ php $postTagChecked = false; @ endphp ***DEL -->
            <span class="tag-item">
            <!-- DEL **** was after tag->name @ php $tagName = {{ $tag->name }}; @ endphp  < ? php echo $tagName ? > *****DEL  --> 
           <!-- DEL **** ...  <h3>Post Tag Name: [<[< $postTag->name >]>]</h3>    <h3>Tag Name: [<[< $tag->name  >]>]</h3> *****DEL  -->
    				<!-- DEL **** @ php $postTagChecked = false; @ endphp *****DEL  -->
            <input type="checkbox" name="tags[]" value="{{$tag->name}}"
            id="{{$tag->name}}"
            	@foreach ($postTags as $postTag)
    				@if (is_object($postTag))
    					@if ($postTag->name == $tag->name)
    						checked
    					@endif
    				@else
     					@if (in_array($tag->name, $postTag))
    						checked
    					@endif   				
    				@endif
    			@endforeach
            >
            <!-- DEL **** @ if(isset($postTags))
    			   {{-- ??? && $postTagCheckedcheck -- was based on if already in post-tags --}}
    			 checked
    			@ endif ****DEL  -->
            <label for="{{$tag->name}}">{{$tag->name}}</label>
            </span>
         @endforeach
            </div>
            </fieldset>
            <fieldset class="tag-button">
            <!-- button to open tag create form holding form info in session var -->
            <button class="button" type="button"
                onClick="return openTagsForm();">
            <span class="icon">Add Tags</span></button>
            </fieldset>
            </div>
            </div>
            
            <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="body" name="body" class="form-control"
                required>{{$restoreBody}}</textarea>
            </div>
            
            <div class="form-group">
            <button type="submit" class="btn btn-primary">Update</button>
            </div>
            <div class="form-group">
              @include('layouts.errors')
            </div>
	</form>
  </div>
@endsection