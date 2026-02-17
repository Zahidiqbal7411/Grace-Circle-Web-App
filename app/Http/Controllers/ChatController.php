<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Friend;
use App\Models\Block;






use GuzzleHttp\Client;



class ChatController extends Controller
{
    // public function chat_create()
    // {
    //     $userId = Auth::id();

    //     // Get friend IDs from accepted friend relationships
    //     $friendIds = Friend::where('accept', 1)
    //         ->where(function ($query) use ($userId) {
    //             $query->where('request_from', $userId)
    //                 ->orWhere('request_to', $userId);
    //         })
    //         ->get()
    //         ->map(function ($friend) use ($userId) {
    //             return $friend->request_from == $userId ? $friend->request_to : $friend->request_from;
    //         })
    //         ->unique()
    //         ->values();

    //     // Get friend users
    //     $users = User::with('galleries')->whereIn('id', $friendIds)->get()->map(function ($user) use ($userId) {
    //         // Attach friend record
    //         $friend = Friend::where(function ($query) use ($userId, $user) {
    //             $query->where('request_from', $userId)
    //                 ->where('request_to', $user->id);
    //         })
    //             ->orWhere(function ($query) use ($userId, $user) {
    //                 $query->where('request_from', $user->id)
    //                     ->where('request_to', $userId);
    //             })
    //             ->first();

    //         // Attach friend_id
    //         $user->friend_id = $friend ? $friend->id : null;

    //         // Get latest chat timestamp between the two
    //         $lastMessage = Chat::where(function ($q) use ($userId, $user) {
    //             $q->where('sender_id', $userId)->where('receiver_id', $user->id);
    //         })->orWhere(function ($q) use ($userId, $user) {
    //             $q->where('sender_id', $user->id)->where('receiver_id', $userId);
    //         })->orderBy('created_at', 'desc')->first();

    //         $user->last_message_time = $lastMessage ? $lastMessage->created_at : now()->subYears(100);

    //         return $user;
    //     });

    //     // Sort users by last message time descending
    //     $users = $users->sortByDesc('last_message_time')->values();

    //     return view('chat.chat', compact('users'));
    // }

    public function chat_create()
    {
        $userId = Auth::id();

        // Get IDs of people I blocked or who blocked me
        $blockedIds = Block::where('block_by', $userId)->pluck('block_user')
            ->merge(Block::where('block_user', $userId)->pluck('block_by'))
            ->unique();

        $friendIds = Friend::where('accept', 1)
            ->where(function ($query) use ($userId) {
                $query->where('request_from', $userId)
                    ->orWhere('request_to', $userId);
            })
            ->get()
            ->map(function ($friend) use ($userId) {
                return $friend->request_from == $userId ? $friend->request_to : $friend->request_from;
            })
            ->filter(function($id) use ($blockedIds) {
                return !in_array($id, $blockedIds->toArray());
            })
            ->unique()
            ->values();

        $users = User::with('galleries')->whereIn('id', $friendIds)->get()->map(function ($user) use ($userId) {
            $friend = Friend::where(function ($query) use ($userId, $user) {
                $query->where('request_from', $userId)
                    ->where('request_to', $user->id);
            })->orWhere(function ($query) use ($userId, $user) {
                $query->where('request_from', $user->id)
                    ->where('request_to', $userId);
            })->first();

            $user->friend_id = $friend ? $friend->id : null;

            $lastMessage = Chat::where(function ($q) use ($userId, $user) {
                $q->where('sender_id', $userId)->where('receiver_id', $user->id);
            })->orWhere(function ($q) use ($userId, $user) {
                $q->where('sender_id', $user->id)->where('receiver_id', $userId);
            })->orderBy('created_at', 'desc')->first();

            $user->last_message_time = $lastMessage ? $lastMessage->created_at : now()->subYears(100);

            return $user;
        });

        $users = $users->sortByDesc('last_message_time')->values();

        $authUser = User::with(['images', 'galleries'])->find(Auth::id());
        $authImageUrl = $authUser->profile_image_url;

        return view('chat.chat', compact('users', 'authImageUrl'));
    }


    public function getMessages(Request $request)
    {
        $authUserId = $request->auth_user_id;
        $selectedUserId = $request->selected_user_id;
        $friendId = $request->friend_id;

        $messages = Chat::where('friend_id', $friendId)
            ->where(function ($query) use ($authUserId, $selectedUserId) {
                $query->where(function ($q) use ($authUserId, $selectedUserId) {
                    $q->where('sender_id', $authUserId)->where('receiver_id', $selectedUserId);
                })->orWhere(function ($q) use ($authUserId, $selectedUserId) {
                    $q->where('sender_id', $selectedUserId)->where('receiver_id', $authUserId);
                });
            })
            ->orderBy('sent_at', 'asc')
            ->get(['sender_id', 'receiver_id', 'message', 'sent_at']);

        return response()->json(['chats' => $messages]);
    }






    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'friend_id' => 'required|exists:friends,id',
    //         'user_id' => 'required|exists:users,id',
    //         'message' => 'required|string|max:5000',
    //     ]);

    //     $chat = Chat::create([
    //         'friend_id' => $request->friend_id,
    //         'sender_id' => Auth::user()->id,
    //         'receiver_id' => $request->user_id, // user_id is receiver in your form
    //         'message' => $request->message,
    //         'status' => 'sent',
    //         'sent_at' => Carbon::now(),  // explicitly set sent_at
    //     ]);

    //     return response()->json(['success' => true, 'chat' => $chat]);
    // }
    public function store(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|exists:friends,id',
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:5000',
        ]);

        $senderId = Auth::id();
        $receiverId = $request->user_id;

        // Security check: Don't allow messaging if blocked
        $isBlocked = Block::where(function($q) use ($senderId, $receiverId) {
            $q->where('block_by', $senderId)->where('block_user', $receiverId);
        })->orWhere(function($q) use ($senderId, $receiverId) {
            $q->where('block_by', $receiverId)->where('block_user', $senderId);
        })->exists();

        if ($isBlocked) {
            return response()->json(['success' => false, 'message' => 'Cannot send message to a blocked user.'], 403);
        }

        $chat = Chat::create([
            'friend_id' => $request->friend_id,
            'sender_id' => $senderId,
            'receiver_id' => $request->user_id,
            'message' => $request->message,
            'status' => 'sent',
            'sent_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'chat' => [
                'id' => $chat->id,
                'friend_id' => $chat->friend_id,
                'sender_id' => $chat->sender_id,
                'receiver_id' => $chat->receiver_id,
                'message' => $chat->message,
                'status' => $chat->status,
                'sent_at' => $chat->sent_at->toDateTimeString(),
            ]
        ]);
    }





    public function getStatuses(Request $request)
    {
        $userId = Auth::id();
        $friendIds = Friend::where('accept', 1)
            ->where(function ($query) use ($userId) {
                $query->where('request_from', $userId)->orWhere('request_to', $userId);
            })
            ->get()
            ->map(fn($f) => $f->request_from == $userId ? $f->request_to : $f->request_from)
            ->unique();

        $statuses = User::whereIn('id', $friendIds)->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'is_online' => $user->isOnline(),
                'last_seen' => $user->isOnline() ? 'Online' : ($user->last_seen ? 'Last seen ' . $user->last_seen->diffForHumans() : 'Offline')
            ];
        });

        return response()->json(['statuses' => $statuses]);
    }


    public function fetchChat(Request $request)
    {
        $request->validate([
            'friend_id' => 'required|integer',
            'auth_user_id' => 'required|integer',
            'selected_user_id' => 'required|integer'
        ]);

        $chats = Chat::where('friend_id', $request->friend_id)
            ->where(function ($q) use ($request) {
                $q->where('sender_id', $request->auth_user_id)
                    ->where('receiver_id', $request->selected_user_id);
            })
            ->orWhere(function ($q) use ($request) {
                $q->where('sender_id', $request->selected_user_id)
                    ->where('receiver_id', $request->auth_user_id);
            })
            ->orderBy('sent_at', 'asc')
            ->get();

        return response()->json(['chats' => $chats]);
    }


    private function formatDateTime($dateTime)
    {
        $now = Carbon::now();
        $messageDate = Carbon::parse($dateTime);

        // If the message was sent today
        if ($messageDate->isToday()) {
            return $messageDate->format('h:i A'); // e.g., "5:11 PM"
        }

        // If the message was sent yesterday
        if ($messageDate->isYesterday()) {
            return 'Yesterday';
        }

        // If the message was sent within the same week (but not today/yesterday)
        if ($now->isSameWeek($messageDate)) {
            return $messageDate->format('D, M d'); // e.g., "Mon, May 7"
        }

        // Older messages
        return $messageDate->format('M d, Y'); // e.g., "May 7, 2025"
    }
}
