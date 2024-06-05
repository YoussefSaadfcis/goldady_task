<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function getCategories()
    {
        $categories = Category::with('posts')->get();
        return response()->json(['data' => CategoryResource::collection($categories)]);
    }
}
