<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        ...$roles
    ): Response {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        if (!$user->hasRoles($roles)) {

            if ($user->hasRoles(['superadmin'])) {
                return redirect()->route('home');
            }

            if ($user->hasRoles(['admin'])) {
                return redirect()->route('dashboard');
            }

            if ($user->hasRoles(['client'])) {
                return redirect()->route('homepage');
            }

            abort(403);
        }
        return $next($request);
    }
}