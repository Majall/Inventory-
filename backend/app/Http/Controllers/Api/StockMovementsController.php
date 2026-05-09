<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\StockMovementResource;
use App\Models\StockMovement;

class StockMovementsController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(StockMovement::query(), request(), [], ['created_at']);

        if ($warehouseId = request()->get('warehouse_id')) {
            $query->where('warehouse_id', $warehouseId);
        }

        if ($productId = request()->get('product_id')) {
            $query->where('product_id', $productId);
        }

        return StockMovementResource::collection(
            $this->paginate($query->with(['warehouse', 'product']), request())
        );
    }
}
