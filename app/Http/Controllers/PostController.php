<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function __constructor() {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    //
    public function index(){
        // Fetch user posts

        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(5);


        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post){
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'body' => 'required'
        ]);

        // This works, because in user model, we have defined the Relationship of hasmnay in the posts function
        $request->user()->posts()->create([
            'body' => $request->body
        ]);

        return back();
    }

    public function destroy(Post $post) {
        // This only works if you enable Post and PostPolicy in AuthServiceProvider
        $this->authorize('delete');
        $post->delete();

        return back();
    }
}
