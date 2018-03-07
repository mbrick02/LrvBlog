<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Tag;
use Carbon\Carbon;

class PostsController extends Controller
{     // controller actions (methods)
  public function __construct(){
      $this->middleware('auth')->except(['index', 'show']);
    // must be signed in to see PostsController pages, except index and show
  }
  public function index(){

// app/Repositories example: $posts = (new \App\Repositories\Posts)->all();
    $posts = Post::latest()
      ->filter(request(['month', 'year']))
      ->get();

    // temporary unclean solution for archives of past posts
    // $archives = Post::archives();  // in app/Providers/AppServiceProvider view

    return view('posts.index', compact('posts'));
    }

    public function show(Post $post) {  // wildcard binding -- not 'show($id)'
      // $post = Post::find($id);  -- use Laravel wildcard binding above

      return view('posts.show', compact('post'));
      // like return view('posts.index')->with('posts', $posts);
    }
    
    public function create() {
    	$tags = Tag::orderBy('name', 'asc')->get();
    	return view('posts.create', compact('tags'));
    }
    
    public function edit(Post $post) {
    	$tags = Tag::orderBy('name', 'asc')->get();
        return view('posts.edit', compact('post'), compact('tags'));
    }

    public function store() {
      // Validation
      $this->validate(request(), [
        'title' => 'required|min:2',
        'body' => 'required|min:2'
      ]);

      // TODO: store checked tags
      // $tagsChecked = $request->input('tagCheckboxArrayChecked???NOTSURE***');
      // Note: in posts/create.blade.php, the "tags" checkboxes are named "tags[]" 
      // so $request should have the checked values in that array so ...
      //  ??... foreach ($request->tags[] as $tag) { $post->tags()->attach($tag); } ...** 
      
      // refactor designating post by user rather than Post::create
      auth()->user()->publish(
        new Post(request(['title', 'body']))
      );

      session()->flash('message', 'Your post has now been published.');

      // redirect to home page
      return redirect('/');
    }
    
    public function patch(Post $post, Request $request) {
        // Validation
        $this->validate(request(), [
            'title' => 'required|min:2',
            'body' => 'required|min:2'
        ]);
        
        // TODO: store checked tags
        // $tagsChecked = $request->input('tagCheckboxArrayChecked???NOTSURE***');
        // Note: in posts/create.blade.php, the "tags" checkboxes are named "tags[]"
        // so $request should have the checked values in that array so ...
        //  ??... foreach ($request->tags[] as $tag) { if(NotPostTag) { $post->tags()->attach($tag); } } ...**
        // e.g.:  "tags" => array[ 0 => "Ascension" ]
        
        $postUpdate = Post::find($post->id);
        $post->title = $request->title;
        $post->body = $request->body;
        // dd($post);
        $post->update();
      
        
        session()->flash('message', 'Your post has now been updated.');
        
        // redirect to home page
        return redirect('/');
    }
}
