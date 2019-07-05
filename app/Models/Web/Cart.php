<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session',
        'product_id',
        'image_color_id',
        'grid_product_id',
        'key',
        'grid',
        'quantity',
        'image',
        'color',
        'code',
        'profile',
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
        'weight',
        'width',
        'height',
        'length',
        'cost',
        'ip'
    ];
}
