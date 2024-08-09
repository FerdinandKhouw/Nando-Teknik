<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\ServiceProduct;

class ReportController extends Controller
{
    public function getReport(Request $request) {
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $validatedData['start_date'];
        $endDate = $validatedData['end_date'];

        $purchases = Purchase::with('details.product')
            ->whereBetween('purchase_date', [$startDate, $endDate])
            ->get()
            ->map(function($purchase) {
                return $purchase->details->map(function($detail) {
                    return [
                        'type' => 'purchase',
                        'product_name' => $detail->product->name,
                        'quantity' => $detail->quantity,
                    ];
                });
            })->flatten();

        $sales = Sale::with('details.product')
            ->whereBetween('sale_date', [$startDate, $endDate])
            ->get()
            ->map(function($sale) {
                return $sale->details->map(function($detail) {
                    return [
                        'type' => 'sale',
                        'product_name' => $detail->product->name,
                        'quantity' => $detail->quantity,
                    ];
                });
            });

        $serviceProducts = ServiceProduct::with('product')
            ->whereBetween('date', [$startDate, $endDate])
            ->get()
            ->map(function($serviceProduct) {
                return [
                    'type' => 'service',
                    'product_name' => $serviceProduct->product->name,
                    'quantity' => $serviceProduct->quantity,
                ];
            });

       // Gabungkan semua data
       $report = $purchases->merge($sales)->merge($serviceProducts);

       // Periksa apakah laporan kosong
       if ($report->isEmpty()) {
           return response()->json([], 200);
       }

       return response()->json($report, 200);
    }
}
