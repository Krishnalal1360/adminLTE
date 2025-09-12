<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\UserListExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Admin\ContactModel;

class ContactController extends Controller
{
    // Show all contacts (with pagination)
    public function index()
    {
        $contacts = ContactModel::latest()->paginate(10); // 10 per page
        return view('admin.contact.index', [
            'userLists' => $contacts 
        ]);
    }

    // Show create form
    public function create()
    {
        return view('admin.contact.create');
    }

    // Store new contact
    public function store(ContactRequest $request)
    {
        ContactModel::create($request->validated());

        return redirect()->route('admin.contact.index')
                         ->with('success', 'Contact created successfully.');
    }

    // Show a single contact
public function show($id)
{
    $userList = ContactModel::findOrFail($id); // or UserModel
    return view('admin.contact.view', compact('userList'));
}

    // Show edit form
    public function edit($id)
    {
        $contact = ContactModel::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }

    // Update contact
    public function update(ContactRequest $request, $id)
    {
        $contact = ContactModel::findOrFail($id);
        $contact->update($request->validated());

        return redirect()->route('admin.contact.index')
                         ->with('success', 'Contact updated successfully.');
    }

    // Delete contact
    public function destroy($id)
    {
        $contact = ContactModel::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.contact.index')
                         ->with('success', 'Contact deleted successfully.');
    }

    // Export contacts
    public function export($type)
    {
        $contacts = ContactModel::all();

        switch ($type) {
            case 'pdf':
                $pdf = Pdf::loadView('admin.contact.export_pdf', compact('contacts'));
                return $pdf->download('contacts.pdf');

            case 'excel':
                return Excel::download(new UserListExport($contacts), 'contacts.xlsx', \Maatwebsite\Excel\Excel::XLSX);

            case 'csv':
                return Excel::download(new UserListExport($contacts), 'contacts.csv', \Maatwebsite\Excel\Excel::CSV);

            default:
                return redirect()->route('admin.contact.index')->with('error', 'Invalid export type.');
        }
    }
}
