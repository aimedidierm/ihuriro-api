<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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


Route::group(["prefix" => "user", "middleware" => ["auth:api", "isUser"], "as" => "user."], function () {
    Route::get('/', function () {
        return response()->json('Welcome User');
    });
});

Route::group(["prefix" => "law", "middleware" => ["auth:api", "isLaw"], "as" => "law."], function () {
    Route::get('/', function () {
        return response()->json('Welcome Law');
    });
});

Route::group(["prefix" => "government", "middleware" => ["auth:api", "isGovernment"], "as" => "government."], function () {
    Route::get('/', function () {
        return response()->json('Welcome Government');
    });
});
