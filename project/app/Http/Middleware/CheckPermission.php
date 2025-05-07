<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        $user = auth()->user();

        if (!$user || !$user->hasPermission($permission)) {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
