<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function getCustomers() {
        return response()->json(Customer::all(), 200);
    }

    public function getCustomerById($id) {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer, 200);
    }

    public function addCustomer(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255'
        ]);

        $customer = Customer::create($validatedData);

        return response()->json($customer, 201);
    }

    public function updateCustomer(Request $request, $id) {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'address' => 'sometimes|required|string|max:255'
        ]);

        $customer->update($validatedData);

        return response()->json($customer, 200);
    }

    public function deleteCustomer($id) {
        $customer = Customer::find($id);
        if (is_null($customer)) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        $customer->delete();
        return response()->json(null, 204);
    }
}
