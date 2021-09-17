<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);
        return response()->view('posts/index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:127',
            'content' => 'required|string',
            'image' => 'required|image|dimensions:max_width:1000,max_height:1000'
        ]);
        $post = new Post($request->all());
        $user = Auth::user();
        $post->user()->associate($user);
        $post->save();

        $temp = $request->file('image')->store('public');
        $temp = Storage::path($temp);
        $media = $post->addMedia($temp)->toMediaCollection();

        $post->thumbnail = $media->getUrl(Post::MEDIA_CONVERSION_NAME);
        $post->save();

        return response()->redirectToRoute('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return response()->view('posts/show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response()->view('posts/edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:127',
            'content' => 'required|string',
            'image' => 'required|image|dimensions:max_width:1000,max_height:1000'
        ]);

        $user = Auth::user();
        $post->user()->associate($user);
        $post->update($request->all());

        $media = $post->getFirstMedia();
        $post->deleteMedia($media->id);

        $temp = $request->file('image')->store('public');
        $temp = Storage::path($temp);
        $media = $post->addMedia($temp)->toMediaCollection();

        $post->thumbnail = $media->getUrl(Post::MEDIA_CONVERSION_NAME);
        $post->save();

        return response()->redirectToRoute('posts.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->redirectToRoute('posts.index');
    }
}
