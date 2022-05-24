<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * @param $request
     * @param Closure $next
     * @param $roles
     * @param null $permission
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if(!auth("sanctum")->user()->hasRole($roles)) {
            return response()->json(['msg' =>'You user doesnt\'t have right role for this route'], 403);
        }

        return $next($request);
    }
}
