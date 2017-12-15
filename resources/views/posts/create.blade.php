@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
        <h1>Publish a Post</h1>

        <hr>

        <form method="POST" action="/posts">

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
              	<!-- button to open tag create form holding form info in session var 
              	<button class="button" onClick="window.open('/tags rather than http://www.site.com');"><span class="icon">Open</span></button> -->
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
