<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function getSale() {
        return response()->json(Sale::with('details.product')->get(), 200);
    }

    public function getSaleById($id) {
        $sale = Sale::with('details')->find($id);
        if (is_null($sale)) {
            return response()->json(['message' => 'Sale not found'], 404);
        }
        return response()->json($sale, 200);
    }

    public function addSale(Request $request) {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer',
            'details.*.price' => 'required|numeric',
        ]);
    
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'sale_date' => $request->sale_date,
            'total_amount' => $request->total_amount,
        ]);
    
        foreach ($request->details as $detail) {
            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $detail['quantity'] * $detail['price'],
            ]);
    
            // Update product stock
            $product = Product::find($detail['product_id']);
            $product->stock -= $detail['quantity'];
            $product->save();
        }

        return response()->json($sale->load('details'), 201);
    }

    public function deleteSale(Request $request, $id) {
        $sale = Sale::with('details')->find($id);
        
        if (is_null($sale)) {
            return response()->json(['message' => 'Sale not Found'], 404);
        }

        // Start transaction
        DB::beginTransaction();
        
        try {
            // Update stock for each product in the sale
            foreach ($sale->details as $detail) {
                $product = Product::find($detail->product_id);
                if ($product) {
                    $product->stock += $detail->quantity; // Return stock
                    $product->save();
                }
            }

            // Delete the sale
            $sale->delete();
            
            // Commit transaction
            DB::commit();
        } catch (\Exception $e) {
            // Rollback transaction if something goes wrong
            DB::rollBack();
            return response()->json(['message' => 'Failed to delete sale'], 500);
        }

        return response()->json(null, 204);
    }
}
