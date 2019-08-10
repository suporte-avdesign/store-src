<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class PaymentCash extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'company_name',
        'method_payment',
        'status',
        'status_label',
        'reference',
        'code',
        'value',
        'date'
    ];
}
