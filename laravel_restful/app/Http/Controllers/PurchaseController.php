<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

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
        }

        return response()->json($purchase->load('details'), 201);
    }

    public function deletePurchase(Request $request, $id){
        $purchase = Purchase::find($id);
        if (is_null($purchase)) {
            return response()->json(['message' => 'Purchasenot Found'], 404);
        }
        $purchase->delete();
        return response()->json(null, 204);
    }
}