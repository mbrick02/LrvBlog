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
      // show list of post avail. for tag
      $posts = $tag->posts;
    
      return view('posts.index', compact('posts'));
    }
    
    
    public function create() {
        // TODO: send to tag create form
        $tags = Tag::orderBy('name', 'desc')->get(); // may not list all tags since the form just adds a new tag
        $form_type = 'Tag';
        // if (Input::has('title')) -- **this is just test to hold post create form data
        $title = "No Title passed by Form or _Sess";
        // if Form->post xxx???app('request')->exists('title') ? Input::get('title') : 'No title';
        // if _Sesstion('postTitle') ??...
        
        return view('tags.create', compact('tags', 'form_type', 'title'));
    }
    
    public function store() {
        // Validation
        $this->validate(request(), [
            'tag' => 'required|min:2',
        ]);
        
        // TODO after store, return to posts/create(.blade.php) 
        //         with session content of post create form for reopening
        // redirect to home page Note 1/18: may be able to reload parent via javascript see notes
        return redirect('/posts/createwithPreviousContent');
    }
}
