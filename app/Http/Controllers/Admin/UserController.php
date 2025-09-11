<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Exports\UserListExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\ContactModel;

class UserController extends Controller
{
    // Show user edit form
    public function edit($id)
    {
        $baseUrl = config('app.api_url');
        $response = Http::get("{$baseUrl}/api/admin/user/{$id}");

        if ($response->successful()) {
            $userData = $response->json('data');
            return view('admin.user.edit', ['userList' => (object)$userData]);
        }

        return back()->with('error', 'Unable to fetch user data.');
    }

    // Update user via API
    public function update(UserRequest $request, $id)
    {
        $baseUrl = config('app.api_url');

        $payload = $request->only(['name', 'email', 'password', 'message']);

        if (empty($payload['password'])) {
            unset($payload['password']); // do not send empty password
        }

        $response = Http::put("{$baseUrl}/api/admin/user/{$id}", $payload);

        if ($response->successful()) {
            return redirect()->route('admin.user.index')
                             ->with('success', 'User updated successfully.');
        }

        return back()->with('error', 'Unable to update user.');
    }

// UserController@index
public function index()
{
    $baseUrl = config('app.api_url');
    $response = Http::get("{$baseUrl}/api/admin/user");

    if ($response->successful()) {
        $users = collect($response->json('data'))->map(fn($u) => (object) $u);

        // Manual pagination
        $page = request()->get('page', 1);
        $perPage = 10;
        $pagedData = new LengthAwarePaginator(
            $users->forPage($page, $perPage),
            $users->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.user.index', ['userLists' => $pagedData]);
    }

    return back()->with('error', 'Unable to fetch users.');
}

    // Delete user via API
    public function destroy($id)
    {
        $baseUrl = config('app.api_url');
        $response = Http::delete("{$baseUrl}/api/admin/user/{$id}");

        if ($response->successful()) {
            return redirect()->route('admin.user.index')
                             ->with('success', 'User deleted successfully.');
        }

        return back()->with('error', 'Unable to delete user.');
    }

    public function export($type)
    {
    // Fetch all blogs (you can add filters if needed)
    $userLists = ContactModel::all();

    switch ($type) {
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
