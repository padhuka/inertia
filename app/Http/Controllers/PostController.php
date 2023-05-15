<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function index(): Response 
    {
        $posts = Post::all();
        return Inertia::render('Admin/Posts/PostIndex',[
            'posts' => PostResource::collection($posts)
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Post::class); //from postPolicy
        return Inertia::render('Admin/Posts/Create');
    }

    public function store(CreatePostRequest $request): RedirectResponse 
    {
        $this->authorize('create', Post::class); //from postPolicy
        Post::create($request->validated());
        return to_route('posts.index');
    }

    public function edit(Post $post): Response
    {
        $this->authorize('update', $post); //from postPolicy
        return inertia::render('Admin/Posts/Edit',[
            'post' => new PostResource($post)
        ]);

    }

    public function update(CreatePostRequest $request, Post $post): RedirectResponse
    {
          $this->authorize('update', $post); //from postPolicy
        $post->update($request->validated());
         return to_route('posts.index');
    }

    public function destroy(Post $post): RedirectResponse
    {
            $this->authorize('delete', $post); //from postPolicy
        $post->delete();
        return back();
    }

}
