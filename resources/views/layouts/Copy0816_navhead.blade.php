  <div class="blog-masthead">
    <div class="container">
      <nav class="nav">
        <a class="nav-link active" href="/">Home</a>
        <a class="nav-link" href="#">New features</a>
        <a class="nav-link" href="#">Press</a>
        <a class="nav-link" href="#">New hires</a>
        <a class="nav-link" href="#">About</a>
        @if (Auth::check())
          <a class="nav-link ml-auto" href="#">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</a>
          <!-- ml=margin left -->
        @endif
      </nav>
    </div>
  </div>