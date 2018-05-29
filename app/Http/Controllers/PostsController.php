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
        // 4/27/18 code below from TagsController@storeWPost 
        //  in answer to error: Undefin var: postTagNames
        //  ?If this works, I probably need to refactor a function postTagNames in Post

        $postTagNames = array();
        
        foreach ($post->tags as $postTag) {
            array_push($postTagNames, $postTag->name);
        }
        
    	$tags = Tag::orderBy('name', 'asc')->get();
        // return view('posts.edit', compact('post'), compact('tags'));
    	return view('posts.edit', compact(['postTagNames', 'post', 'tags']));
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
        
        // store checked tags -- in posts/edit.blade.php, "tags" checkboxes = "tags[]"
        // e.g.:  "tags" => array[ 0 => "Ascension" ]
        $tagsChecked = $request->input('tags');

        $curTags = array();
        foreach ($post->tags as $tag) { // look thru all db post's tags -- remove unchecked
            if (!(in_array($tag->name, $tagsChecked))) { // old tag is Now unchecked so remove
                $post->tags()->detach($tag->id);
            } else {        // (previously and) currently checked
                array_push($curTags, $tag->name); 
            }
        }
        
        // rather than go thru all tags, just go thru checked
        foreach ($tagsChecked as $tagName) {
            if (!in_array($tagName, $curTags)) {
                $tag = Tag::where('name', $tagName)->first();
                if (isset($tag)) { // if tag exists (?is_object) attach to post tags (post_tag table)
                    $post->tags()->attach($tag->id);  // previously checked attached/in db
                }  else {   // tag not found -- should NOT be possible
                    session()->flash('message', 'Tag not found');
                    // redirect back to page -- ?make sure message var in page? 
                    return back();
                }
            }
        }
        
        $post->title = $request->title;
        $post->body = $request->body;

        $post->update();      
        
        session()->flash('message', 'Your post has now been updated.');
        
        // redirect to home page
        return redirect('/');
    }
}
