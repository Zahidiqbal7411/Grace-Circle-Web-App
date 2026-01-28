<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function add_friend($request_to_id)
    {
        $friend = new Friend();
        $friend->request_from  = Auth::user()->id;
        $friend->request_to  = $request_to_id;
        $friend->accept  = 0;

        $friend->save();
        return redirect()->route('member.details',$request_to_id);
    }
    public function cancel_request($id,$user_id)
    {
        $friend = Friend::findOrFail($id);
        $friend->delete();
        return redirect()->route('member.details',$user_id);
    }
    public function accept_request($id,$user_id)
    {
        $friend = Friend::findOrFail($id);
        $friend->accept = 1;
        $friend->save();
        return redirect()->route('member.details',$user_id);
    }
}
