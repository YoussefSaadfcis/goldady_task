<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('category', 'user')->where('user_id', Auth()->user()->id)->get();
        return response()->json(['data' => PostResource::collection($posts)]);
    }

    // Show specific post by id
    public function show($id)
    {
        $post = Post::with('category', 'user')->where('user_id', Auth()->user()->id)->where('id', $id)->first();
        if (is_null($post)) {
            return response()->json(['error' => 'Post not found'], 404);
        }
        return response()->json(['data' => new PostResource($post)], 200);
    }

    //create new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);
        $user_categories = Auth::user()->categories->pluck('id')->toArray();
        if (!in_array($request->category_id, $user_categories)) {
            return response()->json(['error' => 'category not found'], 404);
        }

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $request->image,
            'user_id' => Auth()->user()->id,
            'category_id' => $request->category_id
        ]);

        return response()->json(['data' => new PostResource($post)], 201);
    }

    //update post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $user_categories = Auth::user()->categories->pluck('id')->toArray();
        if (!in_array($request->category_id, $user_categories)) {
            return response()->json(['error' => 'category not found'], 404);
        }

        $post = Post::with('category', 'user')->where('user_id', Auth()->user()->id)->where('id', $id)->first();
        if (is_null($post)) {
            return response()->json(['error' => 'post not found'], 404);
        }

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        return response()->json(['data' => new PostResource($post)], 200);
    }

    //delete post by id
    public function destroy($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::user()->id)->first();
        if (is_null($post)) {
            return response()->json(['error' => 'post not found'], 404);
        }
        $post->delete();
        return response()->json(['message' => 'post deleted successfully'], 200);
    }
}
