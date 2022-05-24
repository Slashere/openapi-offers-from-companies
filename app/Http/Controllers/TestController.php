<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index(Request $request)
    {
        $company = Company::find(1);
        $user = User::find(21);
        $city = City::find(1);
//        $city = Company::find(1);
//        dd($offer->company->city_id);
        dd($company->city);
//        dd($user->company);

    }

}
