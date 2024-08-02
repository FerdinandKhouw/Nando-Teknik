<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function getSuppliers() {
        return response()->json(Supplier::all(), 200);
    }   

    public function getSupplierById($id) {
        $supplier = Supplier::find($id);
        if (is_null($supplier)) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        return response()->json($supplier, 200);
    }

    public function addSupplier(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'shipment' => 'nullable|string',
        ]);

        $supplier = Supplier::create($validatedData);
        return response()->json($supplier, 201);
    }

    public function updateSupplier(Request $request, $id) {
        $supplier = Supplier::find($id);
        if (is_null($supplier)) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'shipment' => 'nullable|string',
        ]);

        $supplier->update($validatedData);
        return response()->json($supplier, 200);
    }

    public function deleteSupplier($id) {
        $supplier = Supplier::find($id);
        if (is_null($supplier)) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }

        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted'], 200);
    }
}
