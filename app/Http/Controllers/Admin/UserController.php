<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use App\Models\Admin\UserListModel;
use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserListExport;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        //$userLists = UserListModel::with('admin')->where('adminID', Auth::id())->paginate(10);
        $userLists = UserModel::where('status', 0)->paginate(10);
        return view('admin.user.index', compact('userLists'));
    }

    // Show create user form
    public function create()
    {
        return view('admin.user.create');
    }

// Store new user
public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email', // ✅ unique check in user_lists only
        'password' => 'required|string|min:6',
    ]);

    // Insert directly into UserModel
    UserModel::create([
        //'adminID'  => Auth::id(), // ✅ logged-in user id from users table
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'status' => 0,
    ]);

    return redirect()
        ->route('admin.user.index')
        ->with('success', 'User created successfully.');
}


    // Show edit form
    public function edit($id)
    {
        $userList = UserModel::findOrFail($id);
        return view('admin.user.edit', compact('userList'));
    }

    // Update user
    public function update(Request $request, $id)
    {
        $userList = UserModel::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => "required|email|unique:users,email,{$userList->id}",
            'password' => 'nullable|string|min:6',
        ]);

        $userList->name = $request->name;

        $userList->email = $request->email;

        if($request->filled('password')){
            $userList->password = Hash::make($request->password);
        }

        /*$userList->update([
            'name'     => $request->name,
            'email'    => $request->email,
            //'password' => Hash::make($request->password),
        ]);*/

        $userList->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $userList = UserModel::findOrFail($id);
        $userList->delete();

        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }

    // Export users
    public function export($type)
    {
        $userLists = UserModel::with('admin')->get();

        switch($type) {
            case 'pdf':
                $pdf = PDF::loadView('admin.user.export_pdf', compact('userLists'));
                return $pdf->download('users.pdf');

            case 'excel':
            return Excel::download(new UserListExport($userLists), 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);

            case 'csv':
            return Excel::download(new UserListExport($userLists), 'users.csv', \Maatwebsite\Excel\Excel::CSV);

            case 'print':
                return view('admin.user.export_print', compact('userLists'));

            default:
                return redirect()->route('admin.user.index')->with('error', 'Invalid export type.');
        }
    }
}
