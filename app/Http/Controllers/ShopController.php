<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\Item;
class ShopController extends Controller
{

    
    /*
        Get shop info
    */
    public function index (Request $request, Shop $shop) {
        return $shop->load(['owner', 'users']);
    }
    /*
        Get users list of shops
    */
    public function list (Request $request) {
        return $request->user()->shops;
    }

    /*
        save user's shop
    */
    public function create(Request $request) {
        return Shop::create([
            'name' => $request->name,
            'owner' => $request->user()->id,
            'avatar' => $request->avatar,
            'description' => $request->description,
        ])->users()->attach($request->user()->id);
        // return $request->user()->shops;
    }
}
