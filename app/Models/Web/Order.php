<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'config_form_payment_id',
        'config_status_payment_id',
        'qty',
        'percent',
        'price_card',
        'price_cash',
        'subtotal',
        'discount',
        'freight',
        'tax',
        'weight',
        'width',
        'height',
        'length',
        'ip',
        'token'
    ];


    public function items()
    {
        return $this->belongsToMany(OrderItem::class);
    }
}
