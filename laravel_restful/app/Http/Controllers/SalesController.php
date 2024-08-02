<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\SalesDetail;

class SalesController extends Controller
{
    public function getSales() {
        return response()->json(Sales::with('details.product')->get(), 200);
    }

    public function getSalesById($id) {
        $sales = Sales::with('details')->find($id);
        if (is_null($sales)) {
            return response()->json(['message' => 'Sales not found'], 404);
        }
        return response()->json($sales, 200);
    }

    public function addSales(Request $request) {
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'sales_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'details' => 'required|array',
            'details.*.product_id' => 'required|exists:products,id',
            'details.*.quantity' => 'required|integer',
            'details.*.price' => 'required|numeric',
        ]);

        $sales = Sales::create([
            'customer_id' => $request->customer_id,
            'sales_date' => $request->sales_date,
            'total_amount' => $request->total_amount,
        ]);

        foreach ($request->details as $detail) {
            SalesDetail::create([
                'sales_id' => $sales->id,
                'product_id' => $detail['product_id'],
                'quantity' => $detail['quantity'],
                'price' => $detail['price'],
                'total' => $detail['quantity'] * $detail['price'],
            ]);
        }

        return response()->json($sales->load('details'), 201);
    }

    public function deleteSales(Request $request, $id) {
        $sales = Sales::find($id);
        if (is_null($sales)) {
            return response()->json(['message' => 'Sales not Found'], 404);
        }
        $sales->delete();
        return response()->json(null, 204);
    }
}
