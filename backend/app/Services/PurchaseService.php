<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\PurchaseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchaseService
{
    public function __construct(
        protected PurchaseRepository $purchaseRepository,
        protected InventoryService $inventoryService
    ) {
    }

    public function createPurchase(array $data, array $items, User $creator): Purchase
    {
        return DB::transaction(function () use ($data, $items, $creator) {
            $purchase = $this->purchaseRepository->createWithItems([
                ...$data,
                'status' => 'pending',
                'created_by' => $creator->id,
            ], $items);

            AuditLog::record($creator, 'purchase.created', $purchase);

            return $purchase;
        });
    }

    public function approvePurchase(Purchase $purchase, User $approver): Purchase
    {
        if ($purchase->status !== 'pending') {
            throw ValidationException::withMessages(['status' => 'Only pending purchases can be approved.']);
        }

        $purchase->update([
            'status' => 'approved',
            'approved_by' => $approver->id,
            'approved_at' => now(),
        ]);

        AuditLog::record($approver, 'purchase.approved', $purchase);

        return $purchase;
    }

    public function receivePurchase(Purchase $purchase, User $receiver, int $warehouseId): Purchase
    {
        if (! in_array($purchase->status, ['approved', 'pending'], true)) {
            throw ValidationException::withMessages(['status' => 'Only approved purchases can be received.']);
        }

        return DB::transaction(function () use ($purchase, $receiver, $warehouseId) {
            $warehouse = Warehouse::findOrFail($warehouseId);
            $purchase->loadMissing('items.product');

            foreach ($purchase->items as $item) {
                $this->inventoryService->applyStockChange(
                    $item->product,
                    $warehouse,
                    $item->quantity,
                    'purchase',
                    $purchase->creator,
                    $purchase,
                    $receiver
                );
            }

            $purchase->update([
                'status' => 'received',
                'approved_by' => $purchase->approved_by ?? $receiver->id,
                'approved_at' => $purchase->approved_at ?? now(),
                'received_at' => now(),
            ]);

            AuditLog::record($receiver, 'purchase.received', $purchase);

            return $purchase;
        });
    }
}
