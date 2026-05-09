<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends ApiController
{
    public function index()
    {
        $query = $this->applyQueryParameters(User::query(), request(), ['name', 'email'], ['name', 'email', 'created_at']);

        return UserResource::collection(
            $this->paginate($query->with(['roles', 'warehouse']), request())
        );
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();
        $roles = $data['roles'] ?? [];
        unset($data['roles']);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($roles) {
            $user->syncRoles($roles);
        }

        AuditLog::record($request->user(), 'user.created', $user);

        return new UserResource($user->load(['roles', 'permissions', 'warehouse']));
    }

    public function show(User $user)
    {
        return new UserResource($user->load(['roles', 'permissions', 'warehouse']));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $roles = $data['roles'] ?? null;
        unset($data['roles']);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        if (is_array($roles)) {
            $user->syncRoles($roles);
        }

        AuditLog::record($request->user(), 'user.updated', $user);

        return new UserResource($user->load(['roles', 'permissions', 'warehouse']));
    }

    public function destroy(User $user)
    {
        $user->delete();

        AuditLog::record(request()->user(), 'user.deleted', $user);

        return response()->json(['message' => 'User deleted.']);
    }
}
