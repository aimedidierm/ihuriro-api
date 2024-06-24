<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\OrdinalUserRequest;
use App\Models\rc;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrdinalUserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt('password'),
            'role' => UserRole::USER->value,
        ]);

        return response()->json([
            'message' => 'User created',
            'user' => $user,
        ], Response::HTTP_OK);
    }
}
