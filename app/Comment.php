<?php

namespace App;

// my Model instead: use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // $comment->post;
    public function post() {
      return $this->belongsTo(Post::class);  // same as App\Post
    }

    public function user() { // $comment->user->name
      return $this->belongsTo(User::class);
    }
}
