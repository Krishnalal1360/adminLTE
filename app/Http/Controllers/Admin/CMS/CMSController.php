<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Facades\Hash;

class CMSController extends Controller
{
    /**
     * Show CMS Home Page
     */
    public function home()
    {
        return view('admin.cms.home', ['currentPage' => 'home']);
    }

    /**
     * Show paginated list of blogs
     */
    public function index(Request $request)
    {
        $apiBase = rtrim(env('API_URL', config('app.url')), '/');
        $page    = $request->query('page', 1);

        $response = Http::get($apiBase . '/api/admin/blogs', ['page' => $page]);

        $blogLists = new LengthAwarePaginator(collect([]), 0, 10, 1, ['path' => url()->current()]);

        if ($response->ok()) {
            $body       = $response->json();
            $pagination = $body['data'] ?? [];

            if (isset($pagination['current_page']) && isset($pagination['data'])) {
                $blogData = collect($pagination['data'])->map(function ($item) {
                    $item = (array) $item;

                    if (!empty($item['file']) && !str_starts_with($item['file'], 'blogs/')) {
                        $item['file'] = $item['file']; // keep seeded data
                    }

                    return (object) $item;
                });

                $blogLists = new LengthAwarePaginator(
                    $blogData,
                    $pagination['total'] ?? count($blogData),
                    $pagination['per_page'] ?? 10,
                    $pagination['current_page'] ?? 1,
                    [
                        'path'  => url()->current(),
                        'query' => $request->except('page'),
                    ]
                );
            }
        }

        return view('admin.cms.blog', ['blogLists' => $blogLists, 'currentPage' => 'blog']);
    }

    /**
     * Show create blog form (Contact page)
     */
    public function create()
    {
        return view('admin.cms.contact', ['currentPage' => 'contact']);
    }

    /**
     * Store new blog via API
     */
public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'blog_image'  => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
    ]);

    $apiBase = rtrim(env('API_URL', config('app.url')), '/');

    $file = $request->file('blog_image');

    $response = Http::attach(
        'blog_image', // key must match API
        fopen($file->getPathname(), 'r'),
        $file->getClientOriginalName()
    )->post($apiBase . '/api/admin/blogs', [
        'title'       => $request->title,
        'description' => $request->description,
    ]);

    if ($response->successful()) {
        return redirect()->route('admin.cms.index')
                         ->with('success', 'Blog created successfully!');
    }

    $errorMessage = $response->json('message') ?? 'Failed to create blog.';
    return back()->withInput()->with('error', $errorMessage);
}

    /**
     * Store Contact details via API
    */

/**
 * Store Contact details via API
 */
public function contactStore(ContactRequest $request)
{
    $apiBase = rtrim(env('API_URL', config('app.url')), '/');

    // send validated data to API
    $response = Http::post($apiBase . '/api/cms/contact', [
        'name'     => $request->name,
        'email'    => $request->email,
        //'password' => bcrypt($request->password), // hash password
        //'password' => Hash::make($request->password),
        'password' => $request->password,
        'message'  => $request->message,
    ]);
    //
    if ($response->successful()) {
        return redirect()->route('cms.index')
                         ->with('success', 'Contact created successfully!');
    }
    //
    $errorMessage = $response->json('message') ?? 'Failed to create contact.';
    return back()->withInput()->with('error', $errorMessage);
}


    /**
     * Show a single blog
     */
    public function show(string $id)
    {
        $apiBase  = rtrim(env('API_URL', config('app.url')), '/');
        $response = Http::get($apiBase . "/api/admin/blogs/{$id}");

        if ($response->ok()) {
            $blog = (object) $response->json()['data'];

            if (!empty($blog->file) && !str_starts_with($blog->file, 'blogs/')) {
                $blog->file = $blog->file;
            }

            return view('admin.cms.blog_details', ['blog' => $blog, 'currentPage' => 'blog_details']);
        }

        return redirect()->route('admin.cms.index')->with('error', 'Blog not found.');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
