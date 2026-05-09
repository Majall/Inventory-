<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\AuditLog;
use App\Models\Supplier;

class SuppliersController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(Supplier::query(), request(), ['name', 'email', 'phone'], ['name', 'created_at']);

        return SupplierResource::collection($this->paginate($query, request()));
    }

    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        AuditLog::record($request->user(), 'supplier.created', $supplier);

        return new SupplierResource($supplier);
    }

    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        AuditLog::record($request->user(), 'supplier.updated', $supplier);

        return new SupplierResource($supplier);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        AuditLog::record(request()->user(), 'supplier.deleted', $supplier);

        return response()->json(['message' => 'Supplier deleted.']);
    }
}
