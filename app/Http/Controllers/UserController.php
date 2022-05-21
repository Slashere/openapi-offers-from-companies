<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function __invoke(Request $request)
    {
        if(auth("sanctum")->check()){
            $response = response()->json(auth("sanctum")->user());
            $data = $response->getData();
            $user = User::find($data->id);
            if ($user !== null) {
                $userPermissions = $user->permissions;
                $userRole = $user->roles;
                $data->permissions = $userPermissions;
                $data->roles = $userRole;
            }
            $response->setData($data);

            return $response;
        }
    }
}
