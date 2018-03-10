<?php

namespace App\Http\Controllers;
use App\Tag;
use App\Post;
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
        // DEL 3/7/18 cut $form_type = $request->form_type;
      
        $title = Input::get('title') ?: '';
        $request->session()->put('postTitle', $title); // did NOT work: session(['postTitle', $title]); 
        $body = Input::get('body') ?: '';
        $request->session()->put('postBody', $body);
        // TODO: test without below
        session()->save();  // ??***??? is this important ??????????????
        
        return view('tags.create', compact('tags', 'title', 'body')); // DEL cut: 'form_type',
    }
    
    public function createWPost(Request $request, Post $post){ // *** better name createFromEditPost ???
    	$tags = Tag::orderBy('name', 'desc')->get(); // ??may not list all tags if form adds a new tag??
    	// DEL 3/7/18 cut $form_type = $request->form_type;
    	
    	$title = Input::get('title') ?: '';
    	$request->session()->put('postTitle', $title); // did NOT work: session(['postTitle', $title]);
    	$body = Input::get('body') ?: '';
    	$request->session()->put('postBody', $body);
    	// TODO: test without below
    	session()->save();  // ??***??? is this important ??????????????
    	$postid = $post->id;
    	
    	return view('tags.create', compact('tags', 'title', 'body', 'postid')); // 3/7 DEL cut: 'form_type', 
    }
    
    public function store() {
        // Validation
        $this->validate(request(), [
            'name' => 'required|min:2|max:20',
        ]);
        
        // TODO: may verify name does not already exist to avoid db error/blowup
        Tag::create([
          'name' => request('name'),
        ]);
        // TODO: if (post/edit) { return redirect('posts/edit'); } else {
        // ... editPostForm vs createPostForm
        return view('/posts/create'); 
    }
    
    public function storeWPost(Post $post) {
        // Validation
        $this->validate(request(), [
            'name' => 'required|min:2|max:20',
        ]);
        
        // TODO: may verify name does not already exist to avoid db error/blowup
        Tag::create([
            'name' => request('name'),
        ]);
        // TODO: if (post/edit) { return redirect('posts/edit'); } else {
        // ... editPostForm vs createPostForm
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('posts.edit', compact('post'), compact('tags'));
    }
}
