<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function getPurchase() {
        return response()->json(Purchase::with('details.product')->get(), 200);
    }

    public function getPurchaseById($id) {
        $purchase = Purchase::with('details')->find($id);
        if (is_null($purchase)) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }
        return response()->json($purchase, 200);
    }
// 
    public function addPurchase(Request $request) {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer',
            'details.*.price' => 'required|numeric',
        ]);
    
        $purchase = Purchase::create([
            'supplier_id' => $request->supplier_id,
            'purchase_date' => $request->purchase_date,
            'total_amount' => $request->total_amount,
        ]);
    
        foreach ($request->details as $detail) {
            PurchaseDetail::create([
                'purchase_id' => $purchase->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $detail['quantity'] * $detail['price'],
            ]);
    
            // Update product stock
            $product = Product::find($detail['product_id']);
            $product->stock += $detail['quantity'];
            $product->save();
        }

        return response()->json($purchase->load('details'), 201);
    }
// 
public function deletePurchase(Request $request, $id) {
    $purchase = Purchase::with('details')->find($id);
    
    if (is_null($purchase)) {
        return response()->json(['message' => 'Purchase not Found'], 404);
    }

    // Start transaction
    DB::beginTransaction();
    
    try {
        // Update stock for each product in the purchase
        foreach ($purchase->details as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $product->stock -= $detail->quantity;
                $product->save();
            }
        }

        // Delete the purchase
        $purchase->delete();
        
        // Commit transaction
        DB::commit();
    } catch (\Exception $e) {
        // Rollback transaction if something goes wrong
        DB::rollBack();
        return response()->json(['message' => 'Failed to delete purchase'], 500);
    }

    return response()->json(null, 204);
}
}