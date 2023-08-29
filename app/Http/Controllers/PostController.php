<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DB::connection()->enableQueryLog();
        // $posts = BlogPost::with('comments')->get();

        // foreach ($posts as $post) {
        //     foreach ($post->comments as $comment) {
        //         echo $comment->content;
        //     }
        // }
        // dd(DB::getQueryLog()); 
        return view(
            'posts.index',
            ['posts' => BlogPost::withCount('comments')->get()]
        );
        // return view('posts.index ', compact('posts'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function show(Request $request, $id)
    {
        // $request->session()reflash();
        // dd(BlogPost::find($id));
        return view('posts.show', ['posts' => BlogPost::withCount('comments')->get()]);
    }

    public function create()
    {
        return view('posts.create');
    }


    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $blogPost = BlogPost::create($validatedData);
        session()->flash('status', 'Blog Post was created Successfully!');

        return redirect()->route('post.show', ['post' => $blogPost->id]);
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validatedData = $request->validated();
        $post->fill($validatedData);
        $post->save();
        session()->flash('status', 'Blog Post was Updated Successfully!');
        return redirect()->route('post.show', ['post' => $post->id]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();
        // BlogPost::destory($id);
        session()->flash('status', 'Blog Post was Deleted Successfully!');
        return redirect()->route('post.index');
    }
}
