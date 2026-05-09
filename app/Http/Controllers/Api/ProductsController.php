<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\AuditLog;
use App\Models\Product;

class ProductsController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(Product::query(), request(), ['name', 'sku', 'barcode'], ['name', 'sku', 'created_at']);

        if ($categoryId = request()->get('category_id')) {
            $query->where('category_id', $categoryId);
        }

        return ProductResource::collection(
            $this->paginate($query->with('category'), request())
        );
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        AuditLog::record($request->user(), 'product.created', $product);

        return new ProductResource($product->load('category'));
    }

    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        AuditLog::record($request->user(), 'product.updated', $product);

        return new ProductResource($product->load('category'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        AuditLog::record(request()->user(), 'product.deleted', $product);

        return response()->json(['message' => 'Product deleted.']);
    }
}
