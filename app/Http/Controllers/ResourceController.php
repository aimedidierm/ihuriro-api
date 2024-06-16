<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResourceRequest;
use App\Models\Resource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::get();
        return response()->json([
            'resources' => $resources
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ResourceRequest $request)
    {
        $resource = Resource::create([
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
        ]);

        return response()->json([
            'message' => 'Resource created',
            'resource' => $resource,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::find($id);

        if ($resource) {
            $resource->delete();
            return response()->json([
                'message' => 'Resource deleted',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Resource not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
