<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\WarehouseActionRequest;
use App\Http\Resources\SaleResource;
use App\Models\AuditLog;
use App\Models\Sale;
use App\Services\SaleService;

class SalesController extends ApiController
{
    public function __construct(protected SaleService $saleService)
    {
    }

    public function index()
    {
        $query = $this->applyQueryParameters(Sale::query(), request(), [], ['created_at', 'total_price']);

        if ($status = request()->get('status')) {
            $query->where('status', $status);
        }

        if ($customerId = request()->get('customer_id')) {
            $query->where('customer_id', $customerId);
        }

        return SaleResource::collection(
            $this->paginate($query->with(['customer', 'items.product']), request())
        );
    }

    public function store(SaleRequest $request)
    {
        $sale = $this->saleService->createSale(
            $request->safe()->except('items'),
            $request->validated()['items'],
            $request->user()
        );

        return new SaleResource($sale->load(['customer', 'items.product']));
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale->load(['customer', 'items.product']));
    }

    public function complete(WarehouseActionRequest $request, Sale $sale)
    {
        $sale = $this->saleService->completeSale(
            $sale,
            $request->user(),
            $request->validated()['warehouse_id']
        );

        return new SaleResource($sale->load(['customer', 'items.product']));
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        AuditLog::record(request()->user(), 'sale.deleted', $sale);

        return response()->json(['message' => 'Sale deleted.']);
    }
}
