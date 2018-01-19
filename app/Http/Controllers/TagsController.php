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
        // TODO: send to tag create form
        $tags = Tag::orderBy('name', 'desc')->get(); // ??may not list all tags if form adds a new tag??
        $form_type = 'Tag';
      
        $title = Input::get('title') ?: '';
        session(['postTitle', $title]); // or $request->session()->put('postTitle', $title);
        $body = Input::get('body') ?: '';
        session(['postBody', $body]);
        
        return view('tags.create', compact('tags', 'form_type', 'title', 'body'));
    }
    
    public function store() {
        $title = session('postTitle', '');
        $body = session('postBody', '');

        session(['postTitle', $title]);
        session(['postBody', $body]);
        // Validation
        /* $this->validate(request(), [
            'name' => 'required|min:2|max:20',
        ]);
        
        Tag::create([
          'name' => request('name'),
        ]); */
        // TODO after store, return to posts/create(.blade.php) 
        //         ? with session content of post create form for reopening
        // redirect to back to caller (post/create)
        // Note 1/18: may be able to reload parent via javascript see notes if endtered data disappears
        
        return redirect('/posts/create')->with('title', $title); // compact('title', 'body') //  return back(); // -- but need to restorePreviousContent');
    }
}
