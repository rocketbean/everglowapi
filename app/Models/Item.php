<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Shop;
class Item extends Model
{
    protected $guarded = [];

    public function shop () {
        return $this->belongsTo(Shop::class);
    }    

}
