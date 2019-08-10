<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'config_form_payment_id',
        'config_status_payment_id',
        'config_shipping_id',
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

    public function configFormPayment()
    {
        return $this->belongsTo(ConfigFormPayment::class);
    }

    public function configShipping()
    {
        return $this->belongsTo(ConfigShipping::class);
    }

    public function paymentCash()
    {
        return $this->hasOne(PaymentCash::class);
    }


    public function paymentBillet()
    {
        return $this->hasOne(PaymentBillet::class);
    }

    public function paymentCard()
    {
        return $this->hasOne(PaymentCard::class);
    }


}
