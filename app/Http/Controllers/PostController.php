<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
public function index() {
    // Show only 'home' posts on homepage
    $posts = Post::where('post_type', 'home')->latest()->get();
    return view('home', compact('posts'));
}

public function devlog() {
    // Show only 'devlog' posts on devlog page
    $posts = Post::where('post_type', 'devlog')->latest()->get();
    return view('devlog', compact('posts'));
}

    // Show add post form
    public function create()
    {
        return view('addpost');
    }

    // Handle post creation
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'post_type' => 'required|in:home,devlog', // validate the dropdown
    ]);

    Post::create($validated); // saves title, content, and post_type

    return redirect()->route('home')->with('success', 'Post created successfully!');
}

public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

    public function edit(Post $post)
    {
        return view('editpost', compact('post'));
    }

    // Handle update
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('home')->with('success', 'Post updated successfully!');
    }

    // Handle delete
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }
}
