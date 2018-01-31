<div class="blog-post">

  <h2 class="blog-post-title">
    <a href="/posts/{{ $post->id }}">
    {{ $post->title }}
  </a>
  </h2>
  <h3>by {{ $post->user->fname }} {{ $post->user->lname }}</h3>

  <p class="blog-post-meta">
    {{ $post->created_at->toformattedDateString() }} by <a href="#">{{ $post->user->name }}</a></p>

  <p>{{ $post->body }}</p>
</div><!-- /.blog-post -->
