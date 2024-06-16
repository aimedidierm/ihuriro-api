<?php

namespace App\Http\Controllers;

use App\Models\Reported;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReportedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reported = Reported::all();
        $reported->load('user');
        return response()->json([
            'reported' => $reported
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reported $reported)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reported $reported)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reported $reported)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reported $reported)
    {
        //
    }
}
