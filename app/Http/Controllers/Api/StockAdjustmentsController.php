<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StockAdjustmentRequest;
use App\Http\Resources\StockAdjustmentResource;
use App\Models\StockAdjustment;
use App\Services\StockAdjustmentService;

class StockAdjustmentsController extends ApiController
{
    public function __construct(protected StockAdjustmentService $stockAdjustmentService)
    {
    }

    public function index()
    {
        $query = $this->applyQueryParameters(StockAdjustment::query(), request(), [], ['created_at']);

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        if ($warehouseId = request()->get('warehouse_id')) {
            $query->where('warehouse_id', $warehouseId);
        }

        return StockAdjustmentResource::collection(
            $this->paginate($query->with(['warehouse', 'items.product']), request())
        );
    }

    public function store(StockAdjustmentRequest $request)
    {
        $adjustment = $this->stockAdjustmentService->createAdjustment(
            $request->safe()->except('items'),
            $request->validated()['items'],
            $request->user()
        );

        return new StockAdjustmentResource($adjustment->load(['warehouse', 'items.product']));
    }

    public function show(StockAdjustment $stockAdjustment)
    {
        return new StockAdjustmentResource($stockAdjustment->load(['warehouse', 'items.product']));
    }

    public function approve(StockAdjustment $stockAdjustment)
    {
        $adjustment = $this->stockAdjustmentService->approveAdjustment($stockAdjustment, request()->user());

        return new StockAdjustmentResource($adjustment->load(['warehouse', 'items.product']));
    }
}
