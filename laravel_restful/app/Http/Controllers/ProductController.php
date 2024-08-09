<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;


class ProductController extends Controller
{
    public function getProducts() {
        return response()->json(Product::with('category')->get(), 200);
    }

    public function getProductById($id) {
        $product = Product::with('category')->find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not Found'], 404);
        }
        return response()->json($product, 200);
    }

    public function addProduct(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product = Product::create($validatedData);
        return response($product, 201);
    }

    public function updateProduct(Request $request, $id){
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not Found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($validatedData);
        return response()->json($product, 200);
    }

    public function deleteProduct(Request $request, $id){
        $product = Product::find($id);
        if (is_null($product)) {
            return response()->json(['message' => 'Product not Found'], 404);
        }
        $product->delete();
        return response()->json(null, 204);
    }
}
