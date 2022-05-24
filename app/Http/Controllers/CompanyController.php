<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        return response()->json(Company::all());
    }

    public function show($id): JsonResponse
    {
        $companyID = $id;
        $company = Company::find($companyID);
        if ($company) {
            $this->authorize($company);
            return response()->json($company);
        } else {
            return response()->json([
                'message' => 'Company not found.'
            ], 404);
        }
    }

    public function userCompanyExists(): JsonResponse
    {
        $user = auth("sanctum")->user();
        $companyExists = $user->company;

        if ($companyExists) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function create(Request $request): JsonResponse
    {

        $this->authorize('create', Company::class);

        $company = new Company();

        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->coordinates = $request->input('coordinates');
        $company->image_src = $request->input('image_src');
        $company->city_id = $request->input('city_id');

        $companySaved = $company->save();

        if ($companySaved) return response()->json([
            'company' => $company,
            'message' => 'Company created successfully.'
        ], 200);

        return response()->json([
            'company' => $company,
            'message' => 'Company didn\'t created.'
        ], 400);
    }

    public function update(Request $request): JsonResponse
    {

        $companyID = $request->input('id');

        $company = Company::find($companyID);

        $this->authorize('update', $company);

        $company->name = $request->input('name');
        $company->address = $request->input('address');
        $company->coordinates = $request->input('coordinates');
        $company->image_src = $request->input('image_src');
        $company->city_id = $request->input('city_id');

        $companyUpdated = $company->update();

        if ($companyUpdated) return response()->json([
                'company' => $company,
                'message' => 'Company updated successfully.'
            ], 200);

        return response()->json([
            'company' => $company,
            'message' => 'Company didn\'t updated.'
        ], 400);
    }

    public function destroy(Request $request): JsonResponse
    {
        $companyID = $request->input('id');
        $company = Company::find($companyID);

        if ($company) {
            $this->authorize('delete',$company);
            $companyDeleted = $company->delete();

            if ($companyDeleted) return response()->json([
                    'company' => $company,
                    'message' => 'Company deleted successfully.'
                ], 200);

            return response()->json([
                'company' => $company,
                'message' => 'Company didn\'t deleted.'
            ], 400);

        }

        return response()->json([
            'company' => $company,
            'message' => 'Company not found.'
        ], 404);
    }
}
