<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'company_name',
        'method_payment',
        'status',
        'status_label',
        'brand',
        'card_number',
        'date_month',
        'date_year',
        'card_cvv',
        'parcels',
        'parcels_value',
        'reference',
        'code',
        'value',
        'date'
    ];
}
