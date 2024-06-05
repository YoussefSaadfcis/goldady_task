<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //return all categories
    public function index()
    {
        $categories = Category::where('user_id', Auth()->user()->id)->get();
        // $categories = Category::all();
        return response()->json(['data' => CategoryResource::collection($categories)]);
    }
    //show specific category by id
    public function show($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth()->user()->id)->first();
        // $category = Category::where('id', $id)->first();
        if (is_null($category)) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json(['data' => new CategoryResource($category)], 200);
    }


    //create new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'user_id' => Auth()->user()->id
        ]);
        return response()->json(['data' => new CategoryResource($category)], 201);
    }

    //update category

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $category = Category::where('id', $id)->where('user_id', Auth()->user()->id)->first();
        if (is_null($category)) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $category->name = $request->name;
        $category->save();

        return response()->json(['data' => new CategoryResource($category)], 200);
    }

    //delete category by id
    public function destroy($id)
    {
        $category = Category::where('id', $id)->where('user_id', Auth()->user()->id)->first();
        if (is_null($category)) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
