<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\AuditLog;
use App\Models\Category;

class CategoriesController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(Category::query(), request(), ['name'], ['name', 'created_at']);

        return CategoryResource::collection($this->paginate($query, request()));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());

        AuditLog::record($request->user(), 'category.created', $category);

        return new CategoryResource($category);
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        AuditLog::record($request->user(), 'category.updated', $category);

        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        AuditLog::record(request()->user(), 'category.deleted', $category);

        return response()->json(['message' => 'Category deleted.']);
    }
}
