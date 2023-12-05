<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuthAccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();
        if ($user) {
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                Gate::define($permission->permission_slug, function ($user) use ($permission) {
                    return $user->hasPermission($permission->permission_slug);
                });
            }
        }
        return $next($request);
    }
}
