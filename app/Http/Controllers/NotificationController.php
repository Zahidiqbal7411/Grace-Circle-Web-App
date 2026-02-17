<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Create a new notification.
     * 
     * @param int $user_id The login user id (receiver)
     * @param int $type The type of notification (1 = friend request)
     * @param int $from_user_id The user id of the sender
     */
    public static function notification($user_id, $type, $from_user_id)
    {
        $sender = User::find($from_user_id);
        $text = "";

        if ($type == 1) {
            $senderName = $sender ? $sender->name : 'Someone';
            $text = "A " . $senderName . " friend request has been received";
        }

        return Notification::create([
            'user_id' => $user_id,
            'sender_id' => $from_user_id,
            'text' => $text,
            'type' => $type,
            'seen' => 0
        ]);
    }

    /**
     * Mark a notification as seen.
     */
    public function markAsSeen($id)
    {
        $notification = Notification::where('notification_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($notification) {
            $notification->update(['seen' => 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Clear all notifications for the current user.
     */
    public function clearAll()
    {
        Notification::where('user_id', Auth::id())->delete();
        return back()->with('success', 'All notifications cleared');
    }
}
