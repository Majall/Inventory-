<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Models\SaleItem;

class SaleRepository
{
    public function createWithItems(array $data, array $items): Sale
    {
        $sale = Sale::create($data);

        $total = 0;
        foreach ($items as $item) {
            $item['sale_id'] = $sale->id;
            $item['total_price'] = $item['quantity'] * $item['unit_price'];
            $total += $item['total_price'];
            SaleItem::create($item);
        }

        $sale->update(['total_price' => $total]);

        return $sale->refresh();
    }
}
