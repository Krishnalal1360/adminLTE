<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\Admin\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the profile.
     */
    public function index()
    {
        $user = Auth::user();
        $baseUrl = config('app.api_url');

        // Call API to get profile
        $response = Http::get("{$baseUrl}/api/admin/profile/{$user->id}");

        if ($response->successful()) {
            $userData = $response->json('data');
            return view('admin.profile.index', [
                'user' => (object) $userData
            ]);
        }

        return back()->with('error', 'Unable to fetch profile.');
    }

    /**
     * Update profile via API.
     */
    public function update(ProfileRequest $request, string $id)
    {
        $baseUrl = config('app.api_url');

        $response = Http::attach(
            'image',
            $request->file('image') ? fopen($request->file('image')->getPathname(), 'r') : null,
            $request->file('image') ? $request->file('image')->getClientOriginalName() : null
        )->put("{$baseUrl}/api/admin/profile/{$id}", $request->except(['image']));

        if ($response->successful()) {
            return redirect()
                ->route('admin.dashboard')
                ->with('success', 'Admin Profile Updated!');
        }

        return back()->with('error', 'Unable to update profile.');
    }
}
