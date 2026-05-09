<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\WarehouseRequest;
use App\Http\Resources\WarehouseResource;
use App\Models\AuditLog;
use App\Models\Warehouse;

class WarehousesController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(Warehouse::query(), request(), ['name', 'code'], ['name', 'code', 'created_at']);

        return WarehouseResource::collection($this->paginate($query, request()));
    }

    public function store(WarehouseRequest $request)
    {
        $warehouse = Warehouse::create($request->validated());

        AuditLog::record($request->user(), 'warehouse.created', $warehouse);

        return new WarehouseResource($warehouse);
    }

    public function show(Warehouse $warehouse)
    {
        return new WarehouseResource($warehouse);
    }

    public function update(WarehouseRequest $request, Warehouse $warehouse)
    {
        $warehouse->update($request->validated());

        AuditLog::record($request->user(), 'warehouse.updated', $warehouse);

        return new WarehouseResource($warehouse);
    }

    public function destroy(Warehouse $warehouse)
    {
        $warehouse->delete();

        AuditLog::record(request()->user(), 'warehouse.deleted', $warehouse);

        return response()->json(['message' => 'Warehouse deleted.']);
    }
}
