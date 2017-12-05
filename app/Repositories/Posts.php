<?php
namespace App\Repositories;

use App\Post;

use App\Redis;

class Posts{
  // ** example assuming a Redis instance to be read ***prob. DELETE next 4 li
  protected $redis;

  public function __construct(Redis $redis){
    $this->redis = $redis;
  }

  public function all(){
    // return all posts - in real life more useful if more selective than all
    return Post::all();

  }

  // possible benefit to find, but dont want to duplicate Laravel
  public function find(){

  }
}
