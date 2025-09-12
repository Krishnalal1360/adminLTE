<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BlogListExport;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\BlogModel;
use App\Http\Requests\Admin\BlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogLists = BlogModel::orderBy('created_at', 'asc')->paginate(10);
        //
        return view('admin.blog.index', compact('blogLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(BlogRequest $request)
{
    // Handle file upload
    $filePath = null;
    if ($request->hasFile('blog_image')) {
        // This will store the file in storage/app/public/blogs with a hashed name
        $filePath = $request->file('blog_image')->store('blogs', 'public');
    }

    // Save blog with file path
    BlogModel::create([
        'title'       => $request->title,
        'description' => $request->description,
        'file'        => $filePath, // save relative path e.g. blogs/abc123.jpg
    ]);

    return redirect()->route('admin.blog.index')
                     ->with('success', 'Blog created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $blogList = BlogModel::findOrFail($id);
        return view('admin.blog.edit', compact('blogList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        //
        $blogList = BlogModel::findOrFail($id);
        //
        $blogList->title = $request->title ?? $blogList->title;
        $blogList->description = $request->description ?? $blogList->description;
        //
        if ($request->hasFile('blog_image')) {
            $filePath = $request->file('blog_image')->store('blogs', 'public');
            $blogList->file = $filePath;
        }
        //
        $blogList->save();
        //
        return redirect()->route('admin.blog.index')
                     ->with('success', 'Blog updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $blogList = BlogModel::findOrFail($id);
        $blogList->delete();
        //
        return redirect()->route('admin.blog.index')->with('success', 'Blog deleted successfully.');
    }
    //
    // Export blogs
public function export($type)
{
    // Fetch all blogs (you can add filters if needed)
    $blogLists = BlogModel::all();

    switch ($type) {
        case 'pdf':
            $pdf = PDF::loadView('admin.blog.export_pdf', compact('blogLists'));
            return $pdf->download('blogs.pdf');

        case 'excel':
            return Excel::download(new BlogListExport($blogLists), 'blogs.xlsx', \Maatwebsite\Excel\Excel::XLSX);

        case 'csv':
            return Excel::download(new BlogListExport($blogLists), 'blogs.csv', \Maatwebsite\Excel\Excel::CSV);

        case 'print':
            return view('admin.blog.export_print', compact('blogLists'));

        default:
            return redirect()->route('admin.blog.index')->with('error', 'Invalid export type.');
    }
}
//
}
