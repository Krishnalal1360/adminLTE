<?php

namespace App\Http\Controllers\Postman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ContactModel;
use Illuminate\Support\Facades\Hash;

class UserAPIController extends Controller
{
    // List all users
    public function index()
    {
        $users = ContactModel::all();
        return response()->json(['data' => $users], 200);
    }

    // Show single user
    public function show($id)
    {
        $user = ContactModel::findOrFail($id);
        return response()->json(['data' => $user], 200);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = ContactModel::findOrFail($id);

        if ($request->filled('name')) $user->name = $request->name;
        if ($request->filled('email')) $user->email = $request->email;
        if ($request->filled('message')) $user->message = $request->message;
        if ($request->filled('password')) $user->password = Hash::make($request->password);

        $user->save();

        return response()->json(['data' => $user, 'message' => 'User updated successfully'], 200);
    }

    // Delete user
    public function destroy($id)
    {
        $user = ContactModel::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    // Store (optional)
    public function store(Request $request)
    {
        $user = ContactModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'password' => isset($request->password) ? Hash::make($request->password) : null,
        ]);

        return response()->json(['data' => $user, 'message' => 'User created successfully'], 201);
    }
}
