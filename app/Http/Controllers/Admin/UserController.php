<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserListExport;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    // List all users
    public function index()
    {
        //
        $userLists = UserModel::where('role', 0)->paginate(10);
        return view('admin.user.index', compact('userLists'));
    }

    // Show create user form
    public function create()
    {
        //
        return view('admin.user.create');
    }

public function store(UserRequest $request)
{
    UserModel::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 0,
    ]);
    //
    return redirect()->route('admin.user.index')
                     ->with('success', 'User created successfully.');
}

    // Show edit form
    public function edit($id)
    {
        $userList = UserModel::findOrFail($id);
        return view('admin.user.edit', compact('userList'));
    }

public function update(UserRequest $request, $id)
{
    $userList = UserModel::findOrFail($id);
    //
    $userList->name = $request->name;
    $userList->email = $request->email;
    //
    if ($request->filled('password')) {
        $userList->password = Hash::make($request->password);
    }
    //
    $userList->save();
    //
    return redirect()->route('admin.user.index')
                     ->with('success', 'User updated successfully.');
}

    // Delete user
    public function destroy($id)
    {
        $userList = UserModel::findOrFail($id);
        $userList->delete();
        //
        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }

    // Export users
    public function export($type)
    {
        $userLists = UserModel::where('role', 0)->get();
        //
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
