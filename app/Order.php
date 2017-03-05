<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function contact(){

        return $this->belongsTo('App\Contact');

    }
    public function orderType(){

        return $this->belongsTo('App\OrderType', 'orderType_id', 'id');

    }
}
