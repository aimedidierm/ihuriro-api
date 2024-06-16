<?php

namespace App\Http\Controllers;

use App\Models\MessageUser;
use App\Models\Reported;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    public function governmentDashboard()
    {

        $reported = Reported::get()->count();
        $reports = $reported;
        $surveys = Survey::get()->count();
        $unread = MessageUser::where('is_read', false)
            ->where('user_id', Auth::id())
            ->get()->count();

        return response()->json([
            'reports' => $reports,
            'reported' => $reported,
            'surveys' => $surveys,
            'unread' => $unread,
        ], Response::HTTP_OK);
    }
}
