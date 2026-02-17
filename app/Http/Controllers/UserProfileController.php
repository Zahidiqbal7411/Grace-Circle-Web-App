<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Question;
use Illuminate\Support\Facades\DB;
use App\Models\Friend;


class UserProfileController extends Controller
{
    /**
     * Get all active questions grouped by category.
     */
    public function getQuestions()
    {
        $questions = Question::where('is_active', true)
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');

        return response()->json([
            'success' => true,
            'questions' => $questions
        ]);
    }

    /**
     * Save profile questions and update status.
     */
    public function completeProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'questions' => 'required|array',
        ]);

        $answers = [];
        foreach ($request->questions as $questionId => $answer) {
            if (!empty($answer)) {
                $answers[$questionId] = ['answer_text' => $answer];
            }
        }

        // Use a transaction to ensure both updates happen
        DB::transaction(function () use ($user, $answers) {
            $user->questions()->sync($answers);
            $user->update(['profile_status' => 1]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Profile completed successfully!'
        ]);
    }

    public function profile_edit($id)
    {
        $user = User::with(['galleries', 'images'])->findOrFail($id);

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
            $value_array = array_map('trim', explode(',', $value));
            $user->$field = json_encode($value_array);
        } else {
            $user->$field = $value;
        }

        $user->save();

        // Prepare the response based on the field being updated
        $responseData = [];

        if ($field == 'name') {
            $responseData['name'] = $user->name;
        } elseif ($field == 'age') {
            $responseData['age'] = $user->age;
        } elseif ($field == 'country') {
            $responseData['country'] = $user->country;
        } elseif ($field == 'city') {
            $responseData['city'] = $user->city;
        }

        return response()->json([
            'message' => ucfirst($field) . ' saved successfully',
            'data' => $responseData
        ]);
    }

    /**
     * Upload image (profile, cover, or random) and save to `images` table.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_type' => 'required|in:profile,cover,random',
            'user_id' => 'required|exists:users,id',
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

        // Save in /public/uploads/images/{type}
        $subFolder = $request->image_type;
        $destinationPath = public_path('uploads/images/' . $subFolder);
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $image->move($destinationPath, $imageName);
        $relativeImageLink = 'uploads/images/' . $subFolder . '/' . $imageName;

        // For profile and cover, replace existing; for random, always create new
        if (in_array($request->image_type, ['profile', 'cover'])) {
            $existing = Image::where('user_id', $request->user_id)
                ->where('image_type', $request->image_type)
                ->first();

            if ($existing) {
                // Delete old file
                $oldPath = public_path($existing->image_link);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }

                $existing->image_link = $relativeImageLink;
                $existing->save();
            } else {
                Image::create([
                    'user_id' => $request->user_id,
                    'image_type' => $request->image_type,
                    'image_link' => $relativeImageLink,
                ]);
            }
        } else {
            // Random images — always create new records
            Image::create([
                'user_id' => $request->user_id,
                'image_type' => 'random',
                'image_link' => $relativeImageLink,
            ]);
        }

        return response()->json([
            'message' => 'Image uploaded successfully!',
            'new_image_url' => asset($relativeImageLink),
            'image_link' => $relativeImageLink,
        ]);
    }

    /**
     * Delete a random image.
     */
    public function deleteImage($imageId)
    {
        $image = Image::where('image_id', $imageId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Delete file from disk
        $filePath = public_path($image->image_link);
        if (file_exists($filePath)) {
            @unlink($filePath);
        }

        $image->delete();

        return response()->json(['message' => 'Image deleted successfully!']);
    }

    public function user_block($block_user)
    {
        $userId = Auth::id();

        // Delete any existing friend relationship
        Friend::where(function ($query) use ($userId, $block_user) {
            $query->where('request_from', $userId)
                  ->where('request_to', $block_user);
        })->orWhere(function ($query) use ($userId, $block_user) {
            $query->where('request_from', $block_user)
                  ->where('request_to', $userId);
        })->delete();

        // Also delete any pending notifications between these two users
        \App\Models\Notification::where('type', 1)
            ->where(function ($query) use ($userId, $block_user) {
                $query->where(function ($q) use ($userId, $block_user) {
                    $q->where('user_id', $userId)->where('sender_id', $block_user);
                })->orWhere(function ($q) use ($userId, $block_user) {
                    $q->where('user_id', $block_user)->where('sender_id', $userId);
                });
            })->delete();

        $block = new Block();
        $block->block_by = $userId;
        $block->block_user = $block_user;
        $block->remarks = "no remarks";
        $block->save();
        
        return back()->with('success', 'User Blocked Successfully');
    }

    public function unblock($user_id)
    {
        Block::where('block_by', Auth::id())->where('block_user', $user_id)->delete();
        return back()->with('success', 'User unblocked successfully');
    }
}
