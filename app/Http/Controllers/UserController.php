<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\OrdinalUserRequest;
use App\Models\DashboardSetting;
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

        DashboardSetting::create([
            'option_1' => true,
            'option_2' => true,
            'option_3' => true,
            'option_4' => true,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'User created',
            'user' => $user,
        ], Response::HTTP_OK);
    }
}
