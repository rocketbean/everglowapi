<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Shop;
class ItemController extends Controller
{
    /**
     * Create Item [item] [shop]
     */
    public function create (Request $request, Shop $shop) {
        return Item::create([
            'name'          => $request->name,
            'shop_id'       => $shop->id,
            'price'         => $request->price,
            'description'   => $request->description,
        ]);
        
    }
}
