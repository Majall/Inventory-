<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockAdjustment;
use App\Models\StockMovement;
use App\Models\StockTransfer;
use App\Models\User;
use App\Models\Warehouse;
use App\Notifications\LowStockNotification;
use App\Repositories\InventoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class InventoryService
{
    public function __construct(protected InventoryRepository $inventoryRepository)
    {
    }

    public function applyStockChange(
        Product $product,
        Warehouse $warehouse,
        float $quantity,
        string $type,
        ?User $actor = null,
        ?Model $reference = null,
        ?User $approver = null,
        ?string $notes = null
    ): Inventory {
        $inventory = $this->inventoryRepository->getOrCreate($warehouse->id, $product->id);
        $newQuantity = $inventory->quantity + $quantity;

        if ($newQuantity < 0) {
            throw ValidationException::withMessages([
                'quantity' => "Insufficient stock for {$product->name} in {$warehouse->name}.",
            ]);
        }

        $this->inventoryRepository->adjustQuantity($inventory, $quantity);

        StockMovement::create([
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'type' => $type,
            'quantity' => $quantity,
            'reference_type' => $reference?->getMorphClass(),
            'reference_id' => $reference?->getKey(),
            'notes' => $notes,
            'created_by' => $actor?->id,
            'approved_by' => $approver?->id,
            'approved_at' => $approver ? now() : null,
        ]);

        AuditLog::record($actor, 'stock_movement.recorded', $reference, [
            'product_id' => $product->id,
            'warehouse_id' => $warehouse->id,
            'quantity' => $quantity,
            'type' => $type,
        ]);

        $this->notifyLowStock($inventory->refresh());

        return $inventory;
    }

    public function applyAdjustment(StockAdjustment $adjustment, User $approver): StockAdjustment
    {
        return DB::transaction(function () use ($adjustment, $approver) {
            foreach ($adjustment->items as $item) {
                $quantity = $item->type === 'increase' ? $item->quantity : -$item->quantity;
                $this->applyStockChange(
                    $item->product,
                    $adjustment->warehouse,
                    $quantity,
                    'adjustment',
                    $adjustment->creator,
                    $adjustment,
                    $approver,
                    $adjustment->reason
                );
            }

            $adjustment->update([
                'status' => 'approved',
                'approved_by' => $approver->id,
                'approved_at' => now(),
            ]);

            AuditLog::record($approver, 'stock_adjustment.approved', $adjustment);

            return $adjustment;
        });
    }

    public function applyTransfer(StockTransfer $transfer, User $approver): StockTransfer
    {
        return DB::transaction(function () use ($transfer, $approver) {
            foreach ($transfer->items as $item) {
                $this->applyStockChange(
                    $item->product,
                    $transfer->fromWarehouse,
                    -$item->quantity,
                    'transfer_out',
                    $transfer->creator,
                    $transfer,
                    $approver
                );

                $this->applyStockChange(
                    $item->product,
                    $transfer->toWarehouse,
                    $item->quantity,
                    'transfer_in',
                    $transfer->creator,
                    $transfer,
                    $approver
                );
            }

            $transfer->update([
                'status' => 'approved',
                'approved_by' => $approver->id,
                'approved_at' => now(),
                'dispatched_at' => $transfer->dispatched_at ?? now(),
            ]);

            AuditLog::record($approver, 'stock_transfer.approved', $transfer);

            return $transfer;
        });
    }

    protected function notifyLowStock(Inventory $inventory): void
    {
        $product = $inventory->product;

        if ($product->reorder_level <= 0 || $inventory->quantity > $product->reorder_level) {
            return;
        }

        $users = User::role(['admin', 'manager'])->get();

        if ($users->isEmpty()) {
            return;
        }

        Notification::send($users, new LowStockNotification($product, $inventory->warehouse, (float) $inventory->quantity));
    }
}
