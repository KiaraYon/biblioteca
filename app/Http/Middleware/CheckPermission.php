<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        if (Auth::check()) {
            Log::info('User is authenticated', ['user_id' => Auth::id()]);

            if ($request->user()->hasPermission($permission)) {
                Log::info('User has permission', ['user_id' => Auth::id(), 'permission' => $permission]);
                return $next($request);
            } else {
                Log::info('User does not have permission', ['user_id' => Auth::id(), 'permission' => $permission]);
            }
        } else {
            Log::info('User is not authenticated');
        }

        return redirect('/home')->with('error', 'No tienes permiso para acceder a esta sección.');
    }
}