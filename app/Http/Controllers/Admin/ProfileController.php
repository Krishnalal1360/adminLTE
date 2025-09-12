<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Admin\UserModel;

class ProfileController extends Controller
{
    /**
     * Display the profile.
     */
    public function index()
    {
        $user = Auth::user();

        // Directly get user data from DB
        return view('admin.profile.index', [
            'user' => $user
        ]);
    }

    /**
     * Update profile directly in DB.
     */
    public function update(ProfileRequest $request, string $id)
    {
        $user = UserModel::findOrFail($id);

        $data = $request->validated();

        // Handle profile image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('profiles', 'public');
        }

        $user->update($data);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Admin Profile Updated!');
    }
}
