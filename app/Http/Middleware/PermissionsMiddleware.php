<?php

namespace App\Http\Middleware;

use Closure;

class PermissionsMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $role
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permission)
    {

        $doesntHavePermission = !auth("sanctum")->user()->hasPermission($permission);
        if($doesntHavePermission) {
            return response()->json(['msg' =>'You role doesnt\'t have permissions ' . implode(',',$permission)], 403);
        }

        return $next($request);
    }
}
