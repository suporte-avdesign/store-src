<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'grid',
        'quantity',
        'image',
        'color',
        'code',
        'offer',
        'percent',
        'price_card',
        'price_cash',
        'slug',
        'kit',
        'kit_name',
        'name',
        'category',
        'section',
        'brand',
        'unit',
        'measure',
        'declare',
        'weight',
        'width',
        'height',
        'length',
        'cost'
    ];
}
