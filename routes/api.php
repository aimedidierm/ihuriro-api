<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\LawUsersController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportedController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Ihuriro API'
    ], Response::HTTP_OK);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [UserController::class, 'store']);
Route::post('/report', [ReportedController::class, 'annonymous']);

Route::group(
    ["prefix" => "account", "middleware" => "auth:api", "as" => "account."],
    function () {
        Route::put('/settings', [AuthController::class, 'update']);
        Route::get('/settings', function () {
            return response()->json([
                'user' => Auth::user(),
            ], Response::HTTP_OK);
        });
        Route::get('/questions', [SurveyController::class, 'questionsList']);
    }
);

Route::group(["prefix" => "user", "middleware" => ["auth:api", "isUser"], "as" => "user."], function () {
    Route::get('/', [DashboardController::class, 'userDashboard']);
    Route::get('/settings', [DashboardSettingController::class, 'create']);
    Route::put('/settings/{id}', [DashboardSettingController::class, 'update']);
    Route::apiResource('/reported', ReportedController::class)->only('index', 'store');
    Route::apiResource('/resources', ResourceController::class)->only('index');
    Route::apiResource('/surveys', SurveyController::class)->only('index', 'store');
});

Route::group(["prefix" => "law", "middleware" => ["auth:api", "isLaw"], "as" => "law."], function () {
    Route::get('/', [DashboardController::class, 'lawDashboard']);
    Route::get('/settings', [DashboardSettingController::class, 'create']);
    Route::put('/settings/{id}', [DashboardSettingController::class, 'update']);
    Route::apiResource('/reported', ReportedController::class)->only('index');
    Route::apiResource('/resources', ResourceController::class)->only('index');
});

Route::group(["prefix" => "government", "middleware" => ["auth:api", "isGovernment"], "as" => "government."], function () {
    Route::get('/', [DashboardController::class, 'governmentDashboard']);
    Route::get('/settings', [DashboardSettingController::class, 'create']);
    Route::put('/settings/{id}', [DashboardSettingController::class, 'update']);
    Route::apiResource('/resources', ResourceController::class)->only('index', 'store', 'destroy');
    Route::apiResource('/surveys', SurveyController::class)->only('index');
    Route::apiResource('/reported', ReportedController::class)->only('index');
    Route::apiResource('/law-users', LawUsersController::class)->only('index', 'store', 'destroy');
});

Route::group(["prefix" => "chat", "middleware" => "auth:api"], function () {
    Route::get('/listing', [MessageController::class, 'index']);
    Route::get('/chat-room/{id}', [MessageController::class, 'chatRoom']);
    Route::post('/send-message/{id}', [MessageController::class, 'store']);
});
