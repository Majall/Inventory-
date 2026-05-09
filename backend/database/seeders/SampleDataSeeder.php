<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $warehouse = Warehouse::firstOrCreate(
            ['code' => 'WH-001'],
            ['name' => 'Main Warehouse', 'address' => 'Head Office']
        );

        $category = Category::firstOrCreate(['name' => 'General']);

        Product::firstOrCreate([
            'sku' => 'SKU-001',
        ], [
            'name' => 'Sample Product',
            'category_id' => $category->id,
            'price' => 10,
            'cost' => 6,
            'reorder_level' => 5,
        ]);

        Supplier::firstOrCreate([
            'name' => 'Default Supplier',
        ], [
            'email' => 'supplier@example.com',
        ]);

        Customer::firstOrCreate([
            'name' => 'Walk-in Customer',
        ]);
    }
}
