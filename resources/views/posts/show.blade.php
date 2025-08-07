@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-4xl mx-auto bg-white py-9 px-8 rounded-sm shadow-sm">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('editpost', $post) }}" class="text-[#2e7d32] hover:underline text-sm">
                    <i class="bi bi-pencil-fill"></i>
                </a>

                <form action="{{ route('deletepost', $post) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-amber-500 cursor-pointer hover:underline text-sm">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>

        <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('M d, Y h:i A') }}</p>
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>

        {{-- 👍 LIKE BUTTON --}}
        <form action="{{ route('posts.like', $post) }}" method="POST" class="mb-6">
            @csrf
            <button type="submit" class="cursor-pointer bg-[#2e7d32]/10 text-[#2e7d32] px-4 py-1 rounded hover:bg-[#2e7d32]/20">
                👍 Like ({{ $post->likes->count() }})
            </button>
        </form>

        {{-- 💬 COMMENTS SECTION --}}
        <h3 class="text-lg font-semibold mb-2 text-[#2e7d32]">Comments ({{ $post->comments->count() }})</h3>

        <ul class="mb-6">
            @forelse ($post->comments as $comment)
                <li class="mb-3 border-b border-gray-200 pb-2">
                    <p class="font-semibold text-gray-700">{{ $comment->name }}</p>
                    <p class="text-gray-700">{{ $comment->body }}</p>
                    <p class="text-xs text-gray-500">{{ $comment->created_at->format('M d, Y h:i A') }}</p>
                </li>
            @empty
                <li class="text-gray-500">No comments yet.</li>
            @endforelse
        </ul>

        {{-- 📝 COMMENT FORM --}}
        <h4 class="text-md font-semibold mb-2 text-[#2e7d32]">Add a Comment</h4>

        @if(session('success'))
            <p class="text-green-600 text-sm mb-2">{{ session('success') }}</p>
        @endif

        <form action="{{ route('posts.comment', $post) }}" method="POST" class="space-y-3">
            @csrf
            <div>
                <input type="text" name="name" placeholder="Your name" required
                    class="w-full px-3 py-2 border border-gray-300 shadow-sm rounded-md focus:outline-none focus:ring focus:ring-blue-300">
            </div>
            <div>
                <textarea name="body" placeholder="Your comment" required
                    class="w-full px-3 py-2 border border-gray-300 shadow-sm rounded-md focus:outline-none focus:ring focus:ring-blue-300"></textarea>
            </div>
            <button type="submit"
                class="bg-[#2e7d32] text-white px-4 py-2 rounded hover:bg-[#2e7d32]/80 cursor-pointer">Submit</button>
        </form>
    </div>
@endsection
