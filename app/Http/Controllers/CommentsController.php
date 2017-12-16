<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request; //?? Need this for auth middleware???

use App\Post;
use App\Comment;

class CommentsController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		// must be signed in to see Comments pages
		// exceptions? but what pub pages have comments: ->except(['index', 'show'])
	}
    public function store(Post $post){
      $this->validate(request(), ['body' => 'required|min:2']);
      $post->addComment(request('body'));

      /* replace below with above
      // add a comment
      Comment::create([
        'body' => request('body'),
        'post_id' => $post->id
      ]);
      */

      return back();
      // rather than return redirect('/posts/$post->id') (previous page)
    }
}
