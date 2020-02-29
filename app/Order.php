<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_ref_no', 'item', 'quantity','received','user_id'
    ];

}
