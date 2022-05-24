<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OfferController extends Controller
{

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Offer::class);
        return response()->json(Offer::all());
    }

    public function showAllActiveInCity($id): JsonResponse
    {
        $cityID = $id;
        $user = auth("sanctum")->user();
        $userCity = $user->city->id;
        // Делаем проверку совпадает ли город клиента с городом получения постов
        // Либо пользователь имеет роль админ
        $now = date('Y-m-d H:i:s');
        if ($userCity == $cityID || $user->hasRole(['admin'])) {
            $offers = Offer::whereHas('company', function ($query) use ($cityID) {
                return $query->where('city_id', '=', $cityID);
            })->where('enabled', true)
                ->where('active_from', '<=', $now)
                ->where('active_until', '>=', $now)
                ->get();
            if ($offers) {
                return response()->json($offers);
            } else {
                return response()->json([
                    'message' => 'Offer not found.'
                ], 404);
            }
        }
        return response()->json([
            'message' => 'You are not allowed to view this city offers.'
        ], 404);
    }

    public function showMyOffers(): JsonResponse
    {
        $user = auth("sanctum")->user();
        $userOffers = $user->company->offers;

        if ($userOffers) {
            return response()->json($userOffers);
        } else {
            return response()->json([
                'message' => 'Offer not found.'
            ], 404);
        }
    }

    public function show($id): JsonResponse
    {
        $offerID = $id;
        $offer = Offer::find($offerID);
        if ($offer) {
            $this->authorize('view',$offer);
            return response()->json($offer);
        } else {
            return response()->json([
                'message' => 'Offer not found.'
            ], 404);
        }
    }

    public function create(Request $request): JsonResponse
    {

        $this->authorize('create', Offer::class);

        $offer = new Offer();

        $input = $request->all();
        $offerSaved = $offer->fill($input)->save();

        if ($offerSaved) return response()->json([
            'offer' => $offer,
            'message' => 'Offer created successfully.'
        ], 200);

        return response()->json([
            'offer' => $offer,
            'message' => 'Offer didn\'t created.'
        ], 400);
    }

    public function update(Request $request): JsonResponse
    {

        $offerID = $request->route('id');
        $offer = Offer::find($offerID);

        if ($offer) {
            $this->authorize('update', $offer);

            $input = $request->all();

            if ($request->has('enabled')) {
                $companyID = $offer->company->id;
                $alreadyHas = $this->checkIfHasEnabledAlready($companyID);

                if ($alreadyHas) return response()->json([
                    'message' => 'You already have activated offer.'
                ], 400);
            }

            $offerUpdated = $offer->fill($input)->save();

            if ($offerUpdated) return response()->json([
                'offer' => $offer,
                'message' => 'Offer updated successfully.'
            ], 200);

            return response()->json([
                'offer' => $offer,
                'message' => 'Offer didn\'t updated.'
            ], 400);
        }
        return response()->json([
            'offer' => $offer,
            'message' => 'Offer not found.'
        ], 404);
    }

    public function destroy($id): JsonResponse
    {
        $offerID = $id;
        $offer = Offer::find($offerID);

        if ($offer) {
            $this->authorize('delete',$offer);
            $offerDeleted = $offer->delete();

            if ($offerDeleted) return response()->json([
                'offer' => $offer,
                'message' => 'Offer deleted successfully.'
            ], 200);

            return response()->json([
                'offer' => $offer,
                'message' => 'Offer didn\'t deleted.'
            ], 400);

        }

        return response()->json([
            'offer' => $offer,
            'message' => 'Offer not found.'
        ], 404);
    }

    protected function checkIfHasEnabledAlready($companyID): bool
    {
        $enabled = Offer::where('company_id', $companyID)->where('enabled', 1)->exists();
        if ($enabled) {
            return true;
        } else {
            return false;
        }
    }
}
