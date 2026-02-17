<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberDetailController extends Controller
{
    public function member_details($id)
    {
        $authUser = Auth::user();

        // If viewing own self, redirect to profile edit
        if ($id == $authUser->id) {
            return redirect()->route('user.profile.edit', $id);
        }

        // Check if I am blocked by the other user
        $blockedByThem = Block::where('block_by', $id)
            ->where('block_user', $authUser->id)
            ->exists();

        // Check if I have blocked THEM
        $blockedByMe = Block::where('block_by', $authUser->id)
            ->where('block_user', $id)
            ->exists();

        $user = User::with(['galleries', 'images'])->findOrFail($id);
        return view('member_detail.members_detail', get_defined_vars());
    }

    public function members()
    {
        $user = Auth::user();
        $oppositeGender = $user->gender === 'male' ? 'female' : 'male';
        $userCountry = $user->country;

        $query = User::with(['galleries', 'images'])
            ->where('id', '!=', Auth::id())
            ->where('gender', $oppositeGender);

        if ($userCountry) {
            // Prioritize same country
            $users = $query->orderByRaw("CASE WHEN country = ? THEN 0 ELSE 1 END", [$userCountry])
                ->get();
        } else {
            $users = $query->get();
        }

        return view('member_detail.members', get_defined_vars());
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $query = User::query()->where('id', '!=', $user->id);

        // Gender filter: The user is seeking a specific gender
        if ($request->filled('seeking')) {
            $query->where('gender', strtolower($request->seeking));
        }

        // Age filter: From
        if ($request->filled('from_age')) {
            $query->where('age', '>=', $request->from_age);
        }

        // Age filter: To
        if ($request->filled('to_age')) {
            $query->where('age', '<=', $request->to_age);
        }

        // Country filter
        if ($request->filled('country')) {
            $query->where('country', 'LIKE', '%' . $request->country . '%');
        }

        // City filter
        if ($request->filled('city')) {
            $query->where('city', 'LIKE', '%' . $request->city . '%');
        }

        // If no country filter provided, still prioritize home country in results
        if (!$request->filled('country') && $user->country) {
            $query->orderByRaw("CASE WHEN country = ? THEN 0 ELSE 1 END", [$user->country]);
        }

        $users = $query->with(['galleries', 'images'])->get();

        return response()->json($users);
    }
}
