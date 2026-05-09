<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationsController extends ApiController
{
    public function index(Request $request)
    {
        return NotificationResource::collection(
            $request->user()->notifications()->paginate(20)
        );
    }

    public function markRead(Request $request, string $notificationId)
    {
        $notification = $request->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        return new NotificationResource($notification);
    }
}
