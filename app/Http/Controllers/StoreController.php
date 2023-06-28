<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
class StoreController extends Controller
{
    //
    public function index(Request $request)
    {
        $games = Game::all();
        $tags = Tag::orderBy('name')->get();

        $perPage = 3;
        $discountedGames = Store::getDiscountedGames($perPage);
        $newGames = Store::getNewGames($perPage);
        $topSellers = Store::getTopSellers($perPage);

        $discountedGames->setPath(route('get.store.discounts', ['perPage' => $perPage]));
        $newGames->setPath(route('get.store.new', ['perPage' => $perPage]));
        $topSellers->setPath(route('get.store.top', ['perPage' => $perPage]));

        return view('store.index', compact('games', 'tags', 'discountedGames', 'newGames', 'topSellers'));
    }

    public function getDiscounts($perPage = 5): JsonResponse
    {
        $discountedGames = Store::getDiscountedGames($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $discountedGames])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $discountedGames->nextPageUrl()]);
    }

    public function getNew($perPage = 5): JsonResponse
    {
        $newGames = Store::getNewGames($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $newGames])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $newGames->nextPageUrl()]);
    }

    public function getTopSellers($perPage = 5): JsonResponse
    {
        $topSellers = Store::getTopSellers($perPage);

        $view = view('components.scroller.load', ['view' => 'games', 'data' => $topSellers])->render();

        return Response::json(['view' => $view, 'nextPageUrl' => $topSellers->nextPageUrl()]);
    }

    public function purchase(Request $request)
    {
        $user = Auth::user();
        $game = Game::find($request->game);

        try {
            $user->buyGame($game);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }

        return redirect()->back()->with('success_message', 'You have successfully purchased this game.');
    }

    public function balance()
    {
        return view('store.balance');
    }

    public function addBalance(Request $request)
    {
        $user = Auth::user();
        $amount = $request->amount;

        try {
            $user->addMoney($amount);
        } catch (\Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }

        return redirect()->back()->with('success_message', 'You have successfully added balance to your account.');
    }

    public function purchaseHistory()
    {
        $user = Auth::user();
        // games with pivot data ordered by acquisition date
        $games = $user->games()->withPivot('acquisition_date', 'purchase_cost')->orderByDesc('pivot_acquisition_date')->get();

        return view('store.history', compact('games'));
    }
}
