<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberDetailController extends Controller
{
    public function member_details($id)
    {
        $authUser = Auth::user();

        // Check if either party blocked the other
        $isBlocked = Block::where(function ($query) use ($authUser, $id) {
            $query->where('block_by', $authUser->id)
                ->where('block_user', $id);
        })->orWhere(function ($query) use ($authUser, $id) {
            $query->where('block_by', $id)
                ->where('block_user', $authUser->id);
        })->exists();

        if ($isBlocked) {
            return redirect()->route('members'); // redirect if blocked
        }

        $user = User::with('galleries')->findOrFail($id);
        return view('member_detail.members_detail', get_defined_vars());
    }

    public function members()
    {
        $oppositeGender = Auth::user()->gender === 'male' ? 'female' : 'male';

        $users = User::with('galleries')
            ->where('id', '!=', Auth::id())
            ->where('gender', $oppositeGender)
            ->get();


        return view('member_detail.members', get_defined_vars());
    }
    public function search(Request $request)
    {
        $iAm = $request->i_am;
        $seeking = $request->seeking;
        $fromAge = $request->from_age;
        $toAge = $request->to_age;

        // Fetch users based on search criteria, including the galleries relationship
        $users = User::where('gender', strtolower($seeking))
            ->whereBetween('age', [$fromAge, $toAge])
            ->with('galleries')  // Eager load galleries
            ->get();

        // Return users as a JSON response
        return response()->json($users);
    }
}
