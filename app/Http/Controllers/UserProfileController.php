<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function profile_edit($id)
    {
        $user = User::with('galleries')->findOrFail($id);

        return view('user_profile.edit_profile', get_defined_vars());
    }




    public function autoSave(Request $request)
    {
        $user = Auth::user();

        // Get field and value
        $field = $request->input('field');
        $value = $request->input('value');

        // For 'languages' field, handle JSON (optional)
        if ($field == 'languages') {
            $value_array = array_map('trim', explode(',', $value));  // Split string to array
            $user->$field = json_encode($value_array);
        } else {
            $user->$field = $value;
        }

        $user->save();

        // Prepare the response based on the field being updated
        $responseData = [];

        if ($field == 'name') {
            $responseData['name'] = $user->name;  // updated name
        } elseif ($field == 'age') {
            $responseData['age'] = $user->age;  // updated age
        } elseif ($field == 'country') {
            $responseData['country'] = $user->country;  // updated country
        } elseif ($field == 'city') {
            $responseData['city'] = $user->city;  // updated city
        }

        return response()->json([
            'message' => ucfirst($field) . ' saved successfully',
            'data' => $responseData
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_type' => 'required|in:profile,cover,gallery',
            'user_id' => 'required|exists:users,id',
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Save in /public/uploads/gallery (make sure folder exists)
        $destinationPath = public_path('uploads/gallery');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);
        $relativeImagePath = 'uploads/gallery/' . $imageName;

        // Check if image already exists for user and image_type
        $gallery = Gallery::where('user_id', $request->user_id)
            ->where('image_type', $request->image_type)
            ->first();

        if ($gallery) {
            // Optional: Delete old image file (cleanup)
            $oldImagePath = public_path($gallery->image_path);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Update existing record
            $gallery->image_path = $relativeImagePath;
            $gallery->status = 1;
            $gallery->block = 0;
            $gallery->save();
        } else {
            // Create new record
            $gallery = new Gallery();
            $gallery->user_id = $request->user_id;
            $gallery->image_type = $request->image_type;
            $gallery->image_path = $relativeImagePath;
            $gallery->status = 1;
            $gallery->block = 0;
            $gallery->save();
        }

        return response()->json([
            'message' => 'Image uploaded successfully!',
            'new_image_url' => asset($relativeImagePath)
        ]);
    }
    public function user_block($block_user)
    {
        $block = new Block();
        $block->block_by = Auth::user()->id;
        $block->block_user = $block_user;
        $block->remarks = "no remarks";
        $block->save();
        return redirect()->route('members')->with('success', 'User Block Successfully');
    }


    public function unblock($user_id)
    {
        Block::where('block_by', Auth::id())->where('block_user', $user_id)->delete();
        return back()->with('success', 'User unblocked successfully');
    }
}
