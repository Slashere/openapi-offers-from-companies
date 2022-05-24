<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function getCities(Request $request)
    {
        City::all();
    }

    public function updateCity(Request $request)
    {
        $cityID = $request->input('id');

        $city = City::find($cityID);

        $city->name = $request->input('name');
        $city->coordinates = $request->input('coordinates');

        $res = $city->update();

        if ($res) {
            $data = [
                'msg' => 'updated',
                'status' => '1',
            ];
        } else {
            $data = [
                'msg' => 'not updated',
                'status' => '0',
            ];
        }

        return response()->json($data);
    }

    public function deleteCity(Request $request)
    {
        $cityID = $request->input('id');

        $city = City::find($cityID);
        $res = $city->delete();

        if ($res) {
            $data = [
                'msg' => 'deleted',
                'status' => '1',
            ];
        } else {
            $data = [
                'msg' => 'not deleted',
                'status' => '0',
            ];
        }

        return response()->json($data);
    }
}
