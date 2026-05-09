<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Sale;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\SaleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleService
{
    public function __construct(
        protected SaleRepository $saleRepository,
        protected InventoryService $inventoryService
    ) {
    }

    public function createSale(array $data, array $items, User $creator): Sale
    {
        return DB::transaction(function () use ($data, $items, $creator) {
            $sale = $this->saleRepository->createWithItems([
                ...$data,
                'status' => 'pending',
                'created_by' => $creator->id,
            ], $items);

            AuditLog::record($creator, 'sale.created', $sale);

            return $sale;
        });
    }

    public function completeSale(Sale $sale, User $operator, int $warehouseId): Sale
    {
        if ($sale->status !== 'pending') {
            throw ValidationException::withMessages(['status' => 'Only pending sales can be completed.']);
        }

        return DB::transaction(function () use ($sale, $operator, $warehouseId) {
            $warehouse = Warehouse::findOrFail($warehouseId);
            $sale->loadMissing('items.product');

            foreach ($sale->items as $item) {
                $this->inventoryService->applyStockChange(
                    $item->product,
                    $warehouse,
                    -$item->quantity,
                    'sale',
                    $operator,
                    $sale
                );
            }

            $sale->update([
                'status' => 'paid',
                'completed_at' => now(),
            ]);

            AuditLog::record($operator, 'sale.completed', $sale);

            return $sale;
        });
    }
}
