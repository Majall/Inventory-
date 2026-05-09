<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Models\AuditLog;
use App\Models\Customer;

class CustomersController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(Customer::query(), request(), ['name', 'email', 'phone'], ['name', 'created_at']);

        return CustomerResource::collection($this->paginate($query, request()));
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->validated());

        AuditLog::record($request->user(), 'customer.created', $customer);

        return new CustomerResource($customer);
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        AuditLog::record($request->user(), 'customer.updated', $customer);

        return new CustomerResource($customer);
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        AuditLog::record(request()->user(), 'customer.deleted', $customer);

        return response()->json(['message' => 'Customer deleted.']);
    }
}
