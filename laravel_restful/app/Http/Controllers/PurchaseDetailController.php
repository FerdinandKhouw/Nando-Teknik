<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetail;

class PurchaseDetailController extends Controller
{
    public function getPurchaseDetails() {
        return response()->json(PurchaseDetail::with('product', 'purchase')->get(), 200);
    }

    public function getPurchaseDetailById($id) {
        $purchaseDetail = PurchaseDetail::with('product', 'purchase')->find($id);
        if (is_null($purchaseDetail)) {
            return response()->json(['message' => 'PurchaseDetail not found'], 404);
        }
        return response()->json($purchaseDetail, 200);
    }

    public function addPurchaseDetail(Request $request) {
        $validatedData = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $purchaseDetail = PurchaseDetail::create($validatedData);
        return response()->json($purchaseDetail, 201);
    }

    public function updatePurchaseDetail(Request $request, $id) {
        $purchaseDetail = PurchaseDetail::find($id);
        if (is_null($purchaseDetail)) {
            return response()->json(['message' => 'PurchaseDetail not found'], 404);
        }

        $validatedData = $request->validate([
            'purchase_id' => 'required|exists:purchases,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $purchaseDetail->update($validatedData);
        return response()->json($purchaseDetail, 200);
    }

    public function deletePurchaseDetail($id) {
        $purchaseDetail = PurchaseDetail::find($id);
        if (is_null($purchaseDetail)) {
            return response()->json(['message' => 'PurchaseDetail not found'], 404);
        }

        $purchaseDetail->delete();
        return response()->json(['message' => 'PurchaseDetail deleted'], 200);
    }
}