<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getBasketContentAttribute()
    {
        return unserialize(DB::table('shoppingcart')->where('identifier', $this->stored_basket_id)->first()->content);
    }
}
