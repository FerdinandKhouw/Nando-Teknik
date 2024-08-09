<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaleDetail;

class SaleDetailController extends Controller
{
    public function getSaleDetail() {
        return response()->json(SaleDetail::with('product', 'sale')->get(), 200);
    }

    public function getSaleDetailById($id) {
        $saleDetail = SaleDetail::with('product', 'sale')->find($id);
        if (is_null($saleDetail)) {
            return response()->json(['message' => 'SaleDetail not found'], 404);
        }
        return response()->json($saleDetail, 200);
    }

    public function addSaleDetail(Request $request) {
        $validatedData = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $saleDetail = SaleDetail::create($validatedData);
        return response()->json($saleDetail, 201);
    }

    public function updateSaleDetail(Request $request, $id) {
        $saleDetail = SaleDetail::find($id);
        if (is_null($saleDetail)) {
            return response()->json(['message' => 'SaleDetail not found'], 404);
        }

        $validatedData = $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        $saleDetail->update($validatedData);
        return response()->json($saleDetail, 200);
    }

    public function deleteSaleDetail($id) {
        $saleDetail = SaleDetail::find($id);
        if (is_null($saleDetail)) {
            return response()->json(['message' => 'SaleDetail not found'], 404);
        }

        $saleDetail->delete();
        return response()->json(['message' => 'SaleDetail deleted'], 200);
    }
}
