<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ContactModel;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'message' => 'nullable|string|max:1000',
        ]);

        $contact = ContactModel::create($validated);

        return response()->json([
            'message' => 'Contact created successfully.',
            'data'    => $contact,
        ], 201);
    }
}
