<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Models\Sale;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportsController extends ApiController
{
    public function stockSummary()
    {
        $inventories = Inventory::with('product')->get();

        $summary = $inventories->groupBy('product_id')->map(function ($items) {
            $product = $items->first()->product;
            return [
                'product_id' => $product?->id,
                'product_name' => $product?->name,
                'total_quantity' => $items->sum('quantity'),
            ];
        })->values();

        return response()->json(['data' => $summary]);
    }

    public function salesSummary()
    {
        $query = Sale::query()->where('status', 'paid');

        if ($from = request()->get('from')) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to = request()->get('to')) {
            $query->whereDate('created_at', '<=', $to);
        }

        return response()->json([
            'total_sales' => $query->sum('total_price'),
            'orders_count' => $query->count(),
        ]);
    }

    public function lowStock()
    {
        $inventories = Inventory::with(['product', 'warehouse'])->get()->filter(function ($inventory) {
            return $inventory->product
                && $inventory->product->reorder_level > 0
                && $inventory->quantity <= $inventory->product->reorder_level;
        })->values();

        return InventoryResource::collection($inventories);
    }

    public function exportStock(): StreamedResponse
    {
        $inventories = Inventory::with(['product', 'warehouse'])->get();

        return response()->streamDownload(function () use ($inventories) {
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Warehouse', 'Product', 'SKU', 'Quantity']);

            foreach ($inventories as $inventory) {
                fputcsv($output, [
                    $inventory->warehouse?->name,
                    $inventory->product?->name,
                    $inventory->product?->sku,
                    $inventory->quantity,
                ]);
            }

            fclose($output);
        }, 'stock-report.csv');
    }
}
