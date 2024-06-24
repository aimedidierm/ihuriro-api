<?php

namespace App\Http\Controllers;

use App\Enums\ReportedStatus;
use App\Enums\UserRole;
use App\Http\Requests\ReportedRequest;
use App\Models\Reported;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ReportedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == UserRole::USER->value) {
            $reported = Reported::where('user_id', Auth::id())->get();
            $reported->load('user');
            return response()->json([
                'reported' => $reported
            ], Response::HTTP_OK);
        } else {
            $reported = Reported::all();
            $reported->load('user');
            return response()->json([
                'reported' => $reported
            ], Response::HTTP_OK);
        }
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
    public function store(ReportedRequest $request)
    {
        $reported = Reported::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'type' => $request->input('type'),
            'status' => ReportedStatus::ACTIVE->value,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Reported created',
            'reported' => $reported,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource as annymous in storage.
     */
    public function annonymous(ReportedRequest $request)
    {
        $reported = Reported::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'location' => $request->input('location'),
            'type' => $request->input('type'),
            'status' => ReportedStatus::ACTIVE->value,
        ]);

        return response()->json([
            'message' => 'Reported created',
            'reported' => $reported,
        ], Response::HTTP_OK);
    }
}
