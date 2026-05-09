<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository
{
    public function getOrCreate(int $warehouseId, int $productId): Inventory
    {
        return Inventory::firstOrCreate(
            ['warehouse_id' => $warehouseId, 'product_id' => $productId],
            ['quantity' => 0]
        );
    }

    public function adjustQuantity(Inventory $inventory, float $quantity): Inventory
    {
        $inventory->quantity = $inventory->quantity + $quantity;
        $inventory->save();

        return $inventory;
    }
}
