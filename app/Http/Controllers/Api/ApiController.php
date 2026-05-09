<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ApiController extends Controller
{
    protected function applyQueryParameters(
        Builder $query,
        Request $request,
        array $searchable = [],
        array $sortable = []
    ): Builder {
        $search = trim((string) $request->get('search', ''));
        if ($search !== '') {
            $search = addcslashes(mb_substr($search, 0, 100), '%_');
            $query->where(function (Builder $builder) use ($search, $searchable) {
                foreach ($searchable as $field) {
                    $builder->orWhere($field, 'like', "%{$search}%");
                }
            });
        }

        $sort = $request->get('sort');
        if ($sort && in_array($sort, $sortable, true)) {
            $direction = strtolower($request->get('direction', 'asc')) === 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $direction);
        }

        return $query;
    }

    protected function paginate(Builder $query, Request $request): LengthAwarePaginator
    {
        $perPage = min((int) $request->get('per_page', 15), 100);

        return $query->paginate($perPage);
    }
}
