<?php

namespace App\Models;
use App\Models\User;
use App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $guarded = [];
    protected $with = [];

    //shops belongsTo many users [user/shop]
    public function users () {
        return $this->belongsToMany(User::class);
    }

    //shops belongsTo a user 
    public function owner () {
        return $this->belongsTo(User::class,'owner', 'id');
    }

    //shops has many items rel.
    public function items () {
        return $this->hasMany(Item::class, 'shop_id');
    }
}
