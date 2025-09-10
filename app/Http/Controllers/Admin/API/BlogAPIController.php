<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use App\Models\Admin\BlogModel;
use App\Http\Requests\Admin\BlogRequest;
use Illuminate\Support\Facades\Storage;

class BlogAPIController extends Controller
{
    public function index()
    {
        $blogs = BlogModel::orderBy('created_at', 'asc')->paginate(10);

        return response()->json([
            'success' => true,
            'data'    => $blogs,
        ], 200);
    }

    public function store(BlogRequest $request)
    {
        $filePath = null;

        // Case 1: multipart/form-data upload
        if ($request->hasFile('blog_image')) {
            $filePath = $request->file('blog_image')->store('blogs', 'public');
        } 
        // Case 2: JSON string / base64 / file path
        elseif ($request->filled('file')) {
            $file = $request->input('file');

            if (str_starts_with($file, 'data:image')) {
                // Decode and store base64 image
                $filePath = $this->saveBase64Image($file);
            } else {
                $filePath = $file; // existing path string
            }
        }

        $blog = BlogModel::create([
            'title'       => $request->input('title'),
            'description' => $request->input('description'),
            'file'        => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully.',
            'data'    => $blog,
        ], 201);
    }

    public function show(string $id)
    {
        $blog = BlogModel::find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $blog,
        ], 200);
    }

    public function update(BlogRequest $request, $id)
    {
        $blog = BlogModel::findOrFail($id);

        $filePath = $blog->file; // keep old if nothing new

        // Case 1: multipart/form-data upload
        if ($request->file('blog_image')) {
            $filePath = $request->file('blog_image')->store('blogs', 'public');
        } 
        // Case 2: base64 or file path JSON
        elseif ($request->filled('file')) {
            $file = $request->input('file');

            if (str_starts_with($file, 'data:image')) {
                $filePath = $this->saveBase64Image($file);
            } else {
                $filePath = $file;
            }
        }

        //Handling PUT/PATCH
        $titleValue = null;
        $descriptionValue = null;
        //
        if($request->filled('title')){
            //
            $titleValue = $request->input('title');
        }else{
            //
            $titleValue = $blog->title;
        }
        //
        if($request->filled('description')){
            //
            $descriptionValue = $request->input('description');
        }else{
            //
            $descriptionValue = $blog->description;
        }

        $blog->update([
            'title'       => $titleValue,
            'description' => $descriptionValue,
            'file'        => $filePath,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully.',
            'data'    => $blog,
        ]);
    }

    public function destroy(string $id)
    {
        $blog = BlogModel::find($id);

        if (!$blog) {
            return response()->json([
                'success' => false,
                'message' => 'Blog not found',
            ], 404);
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.',
        ], 200);
    }

    /**
     * Helper function to save base64 images
     */
    protected function saveBase64Image($base64Image)
    {
        // Extract extension
        $extension = explode('/', explode(';', explode(':', $base64Image)[1])[0])[1];

        // Generate 40-character SHA1 hash filename
        //$fileName  = uniqid() . "." . $extension;
        $fileName = sha1(uniqid('', true) . microtime()) . '.' . $extension;

        $filePath = "blogs/" . $fileName;

        // Decode base64 image
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Store in public disk
        Storage::disk('public')->put($filePath, $imageData);

        return $filePath;
    }
}
