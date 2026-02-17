<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\NotificationController;


class FriendController extends Controller
{
    public function add_friend($request_to_id)
    {
        $friend = new Friend();
        $friend->request_from  = Auth::user()->id;
        $friend->request_to  = $request_to_id;
        $friend->accept  = 0;
        $friend->save();

        // Create notification for the receiver
        NotificationController::notification($request_to_id, 1, Auth::id());

        return redirect()->route('member.details', $request_to_id);
    }

    public function cancel_request($id, $user_id)
    {
        $friend = Friend::findOrFail($id);
        
        // Correctly group the OR condition so it stays within type = 1
        Notification::where('type', 1)
            ->where(function ($query) use ($friend) {
                $query->where(function ($q) use ($friend) {
                    $q->where('user_id', $friend->request_to)
                      ->where('sender_id', $friend->request_from);
                })->orWhere(function ($q) use ($friend) {
                    $q->where('user_id', $friend->request_from)
                      ->where('sender_id', $friend->request_to);
                });
            })->delete();

        $friend->delete();
        return redirect()->route('member.details', $user_id);
    }

    public function accept_request($id, $user_id)
    {
        $friend = Friend::findOrFail($id);
        $friend->accept = 1;
        $friend->save();

        // Mark notification as seen/delete it
        Notification::where('user_id', Auth::id())
            ->where('sender_id', $user_id)
            ->where('type', 1)
            ->delete();

        return redirect()->route('chat')->with('success', 'Friend request accepted! You can now start chatting.');
    }
}
