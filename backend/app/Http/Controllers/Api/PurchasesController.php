<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\WarehouseActionRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\AuditLog;
use App\Models\Purchase;
use App\Services\PurchaseService;

class PurchasesController extends ApiController
{
    public function __construct(protected PurchaseService $purchaseService)
    {
    }

    public function index()
    {
        $query = $this->applyQueryParameters(Purchase::query(), request(), [], ['created_at', 'total_cost']);

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        if ($supplierId = request()->get('supplier_id')) {
            $query->where('supplier_id', $supplierId);
        }

        return PurchaseResource::collection(
            $this->paginate($query->with(['supplier', 'items.product']), request())
        );
    }

    public function store(PurchaseRequest $request)
    {
        $purchase = $this->purchaseService->createPurchase(
            $request->safe()->except('items'),
            $request->validated()['items'],
            $request->user()
        );

        return new PurchaseResource($purchase->load(['supplier', 'items.product']));
    }

    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase->load(['supplier', 'items.product']));
    }

    public function approve(Purchase $purchase)
    {
        $purchase = $this->purchaseService->approvePurchase($purchase, request()->user());

        return new PurchaseResource($purchase->load(['supplier', 'items.product']));
    }

    public function receive(WarehouseActionRequest $request, Purchase $purchase)
    {
        $purchase = $this->purchaseService->receivePurchase(
            $purchase,
            $request->user(),
            $request->validated()['warehouse_id']
        );

        return new PurchaseResource($purchase->load(['supplier', 'items.product']));
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        AuditLog::record(request()->user(), 'purchase.deleted', $purchase);

        return response()->json(['message' => 'Purchase deleted.']);
    }
}
