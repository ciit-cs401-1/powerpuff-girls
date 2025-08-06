@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="max-w-4xl mx-auto py-10 bg-white py-5 px-8 rounded-sm shadow-sm">
         <div class="flex justify-between ">
        <h1 class="text-2xl font-bold">{{ $post->title }}</h1>
                <div class="flex items-center gap-2">
                        <a href="{{ route('editpost', $post) }}" class="text-blue-500 hover:underline text-sm"><i
                                        class="bi bi-pencil-fill"></i></a>

                        <form action="{{ route('deletepost', $post) }}" method="POST"
                                onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 cursor-pointer hover:underline text-sm"><i class="bi bi-trash"></i></button>
                        </form>
                </div>
            </div>
        <p class="text-sm text-gray-500 mb-4">{{ $post->created_at->format('M d, Y h:i A') }}</p>
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>
    </div>
@endsection
