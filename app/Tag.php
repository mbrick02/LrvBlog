<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  public function posts() {
      // (any post may have many tags and...)
      // any tag may be applied to many posts
      return $this->belongsToMany(Post::class);
  }

  public function getRouteKeyName() {
      return 'name';
  }
}
