<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\LawUsersRequest;
use App\Models\DashboardSetting;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class LawUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lawUsers = User::where('role', UserRole::LAW->value)->get();
        return response()->json([
            'users' => $lawUsers
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LawUsersRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => UserRole::LAW->value,
            'password' => bcrypt('password')
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json([
                'message' => 'User deleted',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'User not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
