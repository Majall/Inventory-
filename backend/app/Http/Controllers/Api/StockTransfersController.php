<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StockTransferRequest;
use App\Http\Resources\StockTransferResource;
use App\Models\StockTransfer;
use App\Services\StockTransferService;

class StockTransfersController extends ApiController
{
    public function __construct(protected StockTransferService $stockTransferService)
    {
    }

    public function index()
    {
        $query = $this->applyQueryParameters(StockTransfer::query(), request(), [], ['created_at']);

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        return StockTransferResource::collection(
            $this->paginate($query->with(['fromWarehouse', 'toWarehouse', 'items.product']), request())
        );
    }

    public function store(StockTransferRequest $request)
    {
        $transfer = $this->stockTransferService->createTransfer(
            $request->safe()->except('items'),
            $request->validated()['items'],
            $request->user()
        );

        return new StockTransferResource($transfer->load(['fromWarehouse', 'toWarehouse', 'items.product']));
    }

    public function show(StockTransfer $stockTransfer)
    {
        return new StockTransferResource($stockTransfer->load(['fromWarehouse', 'toWarehouse', 'items.product']));
    }

    public function approve(StockTransfer $stockTransfer)
    {
        $transfer = $this->stockTransferService->approveTransfer($stockTransfer, request()->user());

        return new StockTransferResource($transfer->load(['fromWarehouse', 'toWarehouse', 'items.product']));
    }
}
