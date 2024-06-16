<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LawMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role == UserRole::LAW->value) {
            return $next($request);
        }

        return response()->json([
            'success' => false,
            'message' => 'This action is restricted to law users only.'
        ], Response::HTTP_UNAUTHORIZED);
    }
}
