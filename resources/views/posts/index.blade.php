<!DOCTYPE div SYSTEM "div.dtd">@extends('layouts.master')

@section('content')
    <div class="col-sm-8 blog-main">
      @foreach ($posts as $post)
        @include('posts.post')
      @endforeach
      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="#">Older</a>
        <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
      </nav>

    </div><!-- /.blog-main -->
@endsection

@section('sidebar')
<!--  <aside class="col-sm-3 ml-sm-auto blog-sidebar">
    <div class="sideb..." ... -->
@endsection
