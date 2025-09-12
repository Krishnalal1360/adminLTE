<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BlogModel;
use App\Models\Admin\ContactModel;
//use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $contactCount = ContactModel::count();
        $blogCount    = BlogModel::count();

        // Get current admin user from session (Auth)
        $admin = Auth::user(); // instance of UserModel

        return view('admin.dashboard', [
            'contactCount' => $contactCount,
            'blogCount'    => $blogCount,
            'adminName'    => $admin ? $admin->name : 'Admin',
        ]);
    }
}
