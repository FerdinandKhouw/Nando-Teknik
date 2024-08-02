<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategory() {
        return response()->json(Category::all(), 200);
    }

    public function getCategoryById($id) {
        $categories = Category::find($id);
        if(is_null($categories)){
            return response()->json(['message' => 'Category not Found'], 404);
        }
        return response()->json($categories::find($id), 200);
    }

    public function addCategory(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);
        $categories = Category::create($validatedData);
        return response($categories, 201);
    }

    public function updateCategory(Request $request, $id){
        $categories = Category::find($id);
        if(is_null($categories)){
            return response()->json(['message' => 'Category not Found'], 404);
        }
        $categories->update($request->all());
        return response()->json($categories::find($id), 200);
    }

    public function deleteCategory(Request $request, $id){
        $categories = Category::find($id);
        if(is_null($categories)){
            return response()->json(['message' => 'Category not Found'], 404);
        }
        $categories->delete();
        return response()->json(null, 204);
    }
}  
