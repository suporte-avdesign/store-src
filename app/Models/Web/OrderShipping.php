<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class OrderShipping extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'config_shipping_id',
        'indicate',
        'phone',
        'name'
    ];
}
