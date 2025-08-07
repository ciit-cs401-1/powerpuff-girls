<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\Comment;

class PostInteractionController extends Controller
{
    public function like(Request $request, Post $post)
    {
        $ip = $request->ip();

        $existing = $post->likes()->where('ip_address', $ip)->first();
        if (!$existing) {
            $post->likes()->create(['ip_address' => $ip]);
        }

        return redirect()->back();
    }

    public function comment(Request $request, Post $post)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string|max:1000',
        ]);

        $post->comments()->create($validated);

        return redirect()->back()->with('success', 'Comment added!');
    }
}
