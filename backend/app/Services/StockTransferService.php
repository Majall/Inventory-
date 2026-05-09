<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\StockTransfer;
use App\Models\StockTransferItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StockTransferService
{
    public function __construct(protected InventoryService $inventoryService)
    {
    }

    public function createTransfer(array $data, array $items, User $creator): StockTransfer
    {
        return DB::transaction(function () use ($data, $items, $creator) {
            $transfer = StockTransfer::create([
                ...$data,
                'status' => 'pending',
                'created_by' => $creator->id,
            ]);

            foreach ($items as $item) {
                StockTransferItem::create([
                    ...$item,
                    'stock_transfer_id' => $transfer->id,
                ]);
            }

            AuditLog::record($creator, 'stock_transfer.created', $transfer);

            return $transfer->refresh();
        });
    }

    public function approveTransfer(StockTransfer $transfer, User $approver): StockTransfer
    {
        $transfer->loadMissing('items.product', 'fromWarehouse', 'toWarehouse');

        return $this->inventoryService->applyTransfer($transfer, $approver);
    }
}
