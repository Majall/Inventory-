<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\InventoryResource;
use App\Models\Inventory;

class InventoryController extends ApiController
{
    public function index()
    {
        $query = Inventory::query();

        $warehouseId = request()->get('warehouse_id');
        $user = request()->user();
        if (! $warehouseId && $user && $user->hasRole('staff')) {
            $warehouseId = $user->warehouse_id;
        }

        if ($warehouseId) {
            $query->where('warehouse_id', $warehouseId);
        }

        if ($productId = request()->get('product_id')) {
            $query->where('product_id', $productId);
        }

        return InventoryResource::collection(
            $this->paginate($query->with(['warehouse', 'product']), request())
        );
    }

    public function show(Inventory $inventory)
    {
        return new InventoryResource($inventory->load(['warehouse', 'product']));
    }
}
