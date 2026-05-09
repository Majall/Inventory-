<?php

namespace App\Repositories;

use App\Models\Purchase;
use App\Models\PurchaseItem;

class PurchaseRepository
{
    public function createWithItems(array $data, array $items): Purchase
    {
        $purchase = Purchase::create($data);

        $total = 0;
        foreach ($items as $item) {
            $item['purchase_id'] = $purchase->id;
            $item['total_cost'] = $item['quantity'] * $item['unit_cost'];
            $total += $item['total_cost'];
            PurchaseItem::create($item);
        }

        $purchase->update(['total_cost' => $total]);

        return $purchase->refresh();
    }
}
