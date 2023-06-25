<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
class StoreController extends Controller
{
    //
    public function index(Request $request)
    {
        $games = Game::all();

        $count = 5;
        $discountedGames = Store::getDiscountedGames($count);
        $newGames = Store::getNewGames($count);
        $topSellers = Store::getTopSellers($count);

        return view('store', compact('games', 'discountedGames', 'newGames', 'topSellers'));
    }

    public function getDiscounts(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage' , 10);

        $discountedGames = Store::getDiscountedGames($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $discountedGames])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $discountedGames->nextPageUrl()]);
    }

    public function getNew(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage' , 10);

        $newGames = Store::getNewGames($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $newGames])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $newGames->nextPageUrl()]);
    }

    public function getTopSellers(Request $request): JsonResponse
    {
        $perPage = $request->input('perPage' , 10);

        $topSellers = Store::getTopSellers($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $topSellers])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $topSellers->nextPageUrl()]);
    }
}
