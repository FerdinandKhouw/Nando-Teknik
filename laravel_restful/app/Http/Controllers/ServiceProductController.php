<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceProduct;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ServiceProductController extends Controller
{   
    public function getAllServiceProducts() {
        $serviceProducts = ServiceProduct::with('product', 'customer')->get();
        return response()->json($serviceProducts, 200);
    }

    public function getServiceProductById($id) {
        $serviceProduct = ServiceProduct::with('product', 'customer')->find($id);
        if (is_null($serviceProduct)) {
            return response()->json(['message' => 'Service Product not Found'], 404);
        }
        return response()->json($serviceProduct, 200);
    }

    public function addServiceProduct(Request $request) {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'quantity' => 'required|integer',
            'customer_id' => 'nullable|exists:customers,id',
            'remarks' => 'nullable|string',
        ]);
    
        $serviceProduct = ServiceProduct::create($validatedData);
    
        // Update product stock
        $product = Product::find($request->product_id);
        $product->stock -= $request->quantity;
        $product->save();
    
        return response()->json($serviceProduct, 201);
    }

    public function updateServiceProduct(Request $request, $id) {
        $serviceProduct = ServiceProduct::find($id);
        if (is_null($serviceProduct)) {
            return response()->json(['message' => 'Service Product not Found'], 404);
        }

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'date' => 'required|date',
            'quantity' => 'required|integer',
            'customer_id' => 'nullable|exists:customers,id',
            'remarks' => 'nullable|string',
        ]);

        $serviceProduct->update($validatedData);
        return response()->json($serviceProduct, 200);
    }

    public function deleteServiceProduct($id) {
        $serviceProduct = ServiceProduct::find($id);
        
        if (is_null($serviceProduct)) {
            return response()->json(['message' => 'Service Product not Found'], 404);
        }

        // Start transaction
        DB::beginTransaction();
        
        try {
            // Update stock for the product in the service
            $product = Product::find($serviceProduct->product_id);
            if ($product) {
                $product->stock += $serviceProduct->quantity; // Return stock
                $product->save();
            }

            // Delete the service product
            $serviceProduct->delete();
            
            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete service product'], 500);
        }

        return response()->json(null, 204);
    }
}
