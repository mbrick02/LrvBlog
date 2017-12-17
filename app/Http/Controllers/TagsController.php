<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth')->except(['index']);;
        // must be signed in to TagsController page,
    }
    
    public function index(Tag $tag) {
      // show list of tags available for post
      $posts = $tag->posts;
    
      return view('posts.index', compact('posts'));
    }
    
    
    public function create() {
        // TODO: send to tag create form
        $tags = Tag::all(); // may not list all tags since the form just adds a new tag
        return view('tags.create', compact('tags'));
    }
    
    public function store() {
        // Validation
        $this->validate(request(), [
            'tag' => 'required|min:2',
        ]);
        
        // TODO after store, return to posts/create(.blade.php) with session content
        // redirect to home page
        return redirect('/posts/createwithPreviousContent');
    }
}
