<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\AuditLogResource;
use App\Models\AuditLog;

class AuditLogsController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(AuditLog::query(), request(), ['action', 'auditable_type'], ['created_at']);

        if ($userId = request()->get('user_id')) {
            $query->where('user_id', $userId);
        }

        return AuditLogResource::collection(
            $this->paginate($query, request())
        );
    }
}
