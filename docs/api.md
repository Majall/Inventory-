# Inventory API

Base URL: `/api/v1`

## Authentication
- `POST /auth/login` – login, returns token
- `POST /auth/logout` – revoke current token
- `GET /auth/me` – current user

## Users & Roles
- `GET /users` / `POST /users` / `GET /users/{id}` / `PUT /users/{id}` / `DELETE /users/{id}`
- `GET /roles` / `POST /roles` / `PUT /roles/{id}` / `DELETE /roles/{id}`

## Catalog
- Categories: `GET /categories`, `POST /categories`, `GET /categories/{id}`, `PUT /categories/{id}`, `DELETE /categories/{id}`
- Products: `GET /products`, `POST /products`, `GET /products/{id}`, `PUT /products/{id}`, `DELETE /products/{id}`

## Warehouses
- `GET /warehouses`, `POST /warehouses`, `GET /warehouses/{id}`, `PUT /warehouses/{id}`, `DELETE /warehouses/{id}`

## Partners
- Suppliers: `GET /suppliers`, `POST /suppliers`, `GET /suppliers/{id}`, `PUT /suppliers/{id}`, `DELETE /suppliers/{id}`
- Customers: `GET /customers`, `POST /customers`, `GET /customers/{id}`, `PUT /customers/{id}`, `DELETE /customers/{id}`

## Inventory
- `GET /inventory` / `GET /inventory/{id}`
- `GET /stock-movements`
- Stock adjustments: `GET /stock-adjustments`, `POST /stock-adjustments`, `GET /stock-adjustments/{id}`, `POST /stock-adjustments/{id}/approve`
- Stock transfers: `GET /stock-transfers`, `POST /stock-transfers`, `GET /stock-transfers/{id}`, `POST /stock-transfers/{id}/approve`

## Purchases
- `GET /purchases`, `POST /purchases`, `GET /purchases/{id}`, `DELETE /purchases/{id}`
- `POST /purchases/{id}/approve`
- `POST /purchases/{id}/receive` (requires `warehouse_id`)

## Sales
- `GET /sales`, `POST /sales`, `GET /sales/{id}`, `DELETE /sales/{id}`
- `POST /sales/{id}/complete` (requires `warehouse_id`)

## Reports
- `GET /reports/stock-summary`
- `GET /reports/sales-summary`
- `GET /reports/low-stock`
- `GET /reports/export-stock`

## Notifications
- `GET /notifications`
- `POST /notifications/{id}/read`

## Audit Logs
- `GET /audit-logs`
