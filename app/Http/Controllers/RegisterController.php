<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __invoke(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:255|confirmed'
        ]);


        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'email_verified_at' => Carbon::now()->toDateTimeString(),
            'password' => Hash::make($data['password']),
        ]);

        if ($user) {
            event(new Registered($user));
            $token = $user->createToken('access_token')->plainTextToken;
            return response()->json(["token" => $token , "type" => "Bearer"]);
        } else {
            return response()->json(["message" => 'user has not created', "errors" => ['user'  => 'not created']]);
        }
    }
}
