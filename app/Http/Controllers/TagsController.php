<?php

namespace App\Http\Controllers;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
    
    
    public function create(Request $request) {
        $tags = Tag::orderBy('name', 'desc')->get(); // ??may not list all tags if form adds a new tag??
        $form_type = 'Tag';
      
        $title = Input::get('title') ?: '';
        $request->session()->put('postTitle', $title); // did NOT work: session(['postTitle', $title]); 
        $body = Input::get('body') ?: '';
        $request->session()->put('postBody', $body);
        // TODO: test without below
        session()->save();  // ??***??? is this important ??????????????
        
        return view('tags.create', compact('tags', 'form_type', 'title', 'body'));
    }
    
    public function store() {
        // Validation
        $this->validate(request(), [
            'name' => 'required|min:2|max:20',
        ]);
        
        Tag::create([
          'name' => request('name'),
        ]);
        
        return redirect('/posts/create'); 
    }
}
