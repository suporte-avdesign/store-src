<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'config_form_payment_id',
        'config_status_payment_id',
        'company',
        'status_label',
        'qty',
        'percent',
        'price_card',
        'price_cash',
        'subtotal',
        'total',
        'coupon',
        'discount',
        'freight',
        'tax',
        'ip',
        'code',
        'token'
    ];


    /**
     * Order Items
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
