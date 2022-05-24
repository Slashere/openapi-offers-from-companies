<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware(function ($request, $next) {
//            if(auth("sanctum")->check()){
//                return $next($request);
//            } else {
//                return response()->json();
//            }
//        });
//    }

    public function getUserData(Request $request)
    {
        if(auth("sanctum")->check()){
            return response()->json(auth("sanctum")->user());
        }
        return '';
    }

    public function getUserRoles(Request $request)
    {
        if(auth("sanctum")->check()){
            $userID = auth("sanctum")->user()->id;
            $user = User::find($userID);
            if ($user !== null) {
                $userRole = $user->roles;
                return response()->json($userRole);
            }
        }
        return '';
    }

    public function getUserPermissions(Request $request)
    {
        if(auth("sanctum")->check()){
            $userID = auth("sanctum")->user()->id;
            $user = User::find($userID);
            if ($user !== null) {
                $userPermissions = $user->permissions;
                return response()->json($userPermissions);
            }
        }
        return '';
    }
}
