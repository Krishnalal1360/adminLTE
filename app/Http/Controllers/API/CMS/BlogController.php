<?php

namespace App\Http\Controllers\API\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BlogModel;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    /**
     * List blogs with pagination (API)
     */
    public function index(Request $request): JsonResponse
    {
        $perPage   = $request->query('per_page', 10);
        $blogLists = BlogModel::paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $blogLists
        ]);
    }

    /**
     * Show a single blog (API)
     */
    public function show(string $id): JsonResponse
    {
        $blog = BlogModel::find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $blog
        ]);
    }
}
