<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardSettingsRequest;
use App\Models\DashboardSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dashboardDetails = DashboardSetting::where('user_id', Auth::id())->first();
        return response()->json([
            'dashboard_details' => $dashboardDetails,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DashboardSettingsRequest $request, string $id)
    {
        $dashboardDetails = DashboardSetting::find($id);

        if ($dashboardDetails) {
            $dashboardDetails->update([
                'option_1' => $request->input('option_1'),
                'option_2' => $request->input('option_2'),
                'option_3' => $request->input('option_3'),
                'option_4' => $request->input('option_4'),
            ]);

            return response()->json([
                'message' => 'Dashboard details updated',
                'dashboard_details' => $dashboardDetails,
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Dashboard details not found',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
