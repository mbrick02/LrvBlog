<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Blog Template for Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
  </head>
  <body>
    <header>
    @include('layouts.navhead')

    @if($flash = session('message'))
    <div id="mbflash-message" class="alert alert-success" role="alert">
      {{$flash}}
    </div>
    @endif

      <div class="blog-header">
        <div class="container">
          <h1 class="blog-title">Michael B's Bootstrap Blog</h1>
          <p class="lead blog-description">An example blog template
             built with Bootstrap.</p>
        </div>
      </div>
    </header>

    <main role="main" class="container">
      <div class="row">
        @yield('content')
        @include('layouts.sidebar')
      </div><!-- /.row -->
    </main><!-- /.container -->
    @include('layouts.footer')
