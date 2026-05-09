# Inventory Backend API

Laravel backend API for inventory, purchasing, sales, and warehouse operations with role-based access control.

## Features
- Sanctum authentication with token-based login/logout
- Spatie Permission roles and permissions (Admin, Manager, Staff)
- CRUD for products, categories, warehouses, suppliers, customers
- Inventory tracking with stock movements, adjustments, and transfers
- Purchase and sales workflows with approvals
- Low stock notifications and inventory history logs
- Reports, analytics summaries, and CSV export

## Requirements
- PHP 8.3+
- Composer
- MySQL or PostgreSQL

## Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

If you hit GitHub API rate limiting during `composer install`, configure a GitHub token for Composer:
```bash
composer config -g github-oauth.github.com YOUR_TOKEN
```

## Authentication
- `POST /api/v1/auth/login` returns a Sanctum token.
- Use `Authorization: Bearer <token>` for protected routes.

## Roles & Permissions
Seed data creates roles and permissions aligned to Admin/Manager/Staff. Update the `RolePermissionSeeder` for customization.

## API Documentation
See `docs/api.md` for endpoint details.

## Notes
- Default seeded admin: `admin@example.com` / `password`.
- Update credentials and rotate passwords before production.
