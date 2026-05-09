<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\StockAdjustment;
use App\Models\StockAdjustmentItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StockAdjustmentService
{
    public function __construct(protected InventoryService $inventoryService)
    {
    }

    public function createAdjustment(array $data, array $items, User $creator): StockAdjustment
    {
        return DB::transaction(function () use ($data, $items, $creator) {
            $adjustment = StockAdjustment::create([
                ...$data,
                'status' => 'pending',
                'created_by' => $creator->id,
            ]);

            foreach ($items as $item) {
                StockAdjustmentItem::create([
                    ...$item,
                    'stock_adjustment_id' => $adjustment->id,
                ]);
            }

            AuditLog::record($creator, 'stock_adjustment.created', $adjustment);

            return $adjustment->refresh();
        });
    }

    public function approveAdjustment(StockAdjustment $adjustment, User $approver): StockAdjustment
    {
        $adjustment->loadMissing('items.product', 'warehouse');

        return $this->inventoryService->applyAdjustment($adjustment, $approver);
    }
}
