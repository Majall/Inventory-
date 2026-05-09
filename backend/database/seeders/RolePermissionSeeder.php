<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'users.manage',
            'roles.manage',
            'products.view',
            'products.manage',
            'categories.view',
            'categories.manage',
            'warehouses.view',
            'warehouses.manage',
            'suppliers.view',
            'suppliers.manage',
            'customers.view',
            'customers.manage',
            'inventory.view',
            'stock_adjustments.manage',
            'stock_adjustments.approve',
            'stock_transfers.manage',
            'stock_transfers.approve',
            'purchases.manage',
            'purchases.approve',
            'sales.manage',
            'reports.view',
            'notifications.view',
            'audit.view',
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        $admin = Role::findOrCreate('admin');
        $manager = Role::findOrCreate('manager');
        $staff = Role::findOrCreate('staff');

        $admin->syncPermissions($permissions);

        $manager->syncPermissions([
            'products.view',
            'products.manage',
            'categories.view',
            'categories.manage',
            'warehouses.view',
            'warehouses.manage',
            'suppliers.view',
            'suppliers.manage',
            'customers.view',
            'customers.manage',
            'inventory.view',
            'stock_adjustments.manage',
            'stock_adjustments.approve',
            'stock_transfers.manage',
            'stock_transfers.approve',
            'purchases.manage',
            'purchases.approve',
            'sales.manage',
            'reports.view',
            'notifications.view',
        ]);

        $staff->syncPermissions([
            'products.view',
            'categories.view',
            'inventory.view',
            'stock_adjustments.manage',
            'sales.manage',
            'notifications.view',
        ]);
    }
}
