<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ContactRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Admin\ContactModel;
use Illuminate\Support\Facades\Route;

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
    public function blogs(Request $request)
    {
        $apiBase = rtrim(env('API_URL', config('app.url')), '/');
        $page    = $request->query('page', 1);

        $response = Http::get($apiBase . '/api/cms/blog', ['page' => $page]);

        $blogLists = new LengthAwarePaginator(
            collect([]),
            0,
            10,
            1,
            ['path' => url()->current()]
        );

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

        return view('admin.cms.blog', [
            'blogLists'   => $blogLists,
            'currentPage' => 'blog'
        ]);
    }

    /**
     * Show a single blog
     */
    public function blogDetail(string $id)
    {
        $apiBase  = rtrim(env('API_URL', config('app.url')), '/');
        $response = Http::get($apiBase . "/api/cms/blog/{$id}");

        if ($response->ok()) {
            $blogData = data_get($response->json(), 'data');

            if ($blogData) {
                $blog = (object) $blogData;

                if (!empty($blog->file) && !str_starts_with($blog->file, 'blogs/')) {
                    $blog->file = $blog->file;
                }

                return view('admin.cms.blog_details', [
                    'blog'        => $blog,
                    'currentPage' => 'blog_details'
                ]);
            }
        }

        return redirect()
            ->route('cms.index')
            ->with('error', 'Blog not found.');
    }

    /**
     * Show create contact form
     */
    public function contactCreate()
    {
        return view('admin.cms.contact', ['currentPage' => 'contact']);
    }

    /**
     * Store Contact details via API
     */
public function contactStore(ContactRequest $request)
{
    $internalRequest = Request::create(
        '/api/cms/contact',
        'POST',
        $request->validated()
    );

    $response = Route::dispatch($internalRequest);

    /*dd([
    'status'  => $response->getStatusCode(),
    'content' => $response->getContent(),
    ]);*/


    if (in_array($response->getStatusCode(), [200, 201])) {
        return redirect()
            ->route('cms.contact.create')
            ->with('success', 'Contact created successfully!');
    }

    if ($response->getStatusCode() === 422) {
        return back()
            ->withErrors(json_decode($response->getContent(), true)['errors'] ?? [])
            ->withInput();
    }

    $errorMessage = json_decode($response->getContent(), true)['message'] ?? 'Failed to create contact.';
    return back()->with('error', $errorMessage);
}

}
