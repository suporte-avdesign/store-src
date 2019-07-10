<?php

namespace AVD\Models\Web;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'subject_id',
        'user_id',
        'subject',
        'name',
        'email',
        'phone',
        'cell',
        'type',
        'message',
        'return',
        'ip',
        'city',
        'state',
        'zip_code',
        'latitude',
        'longitude',
        'admin',
        'date_return',
        'send',
        'client',
        'status'
    ];

    /**
     *
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        !isset($attributes['email']) ?: $attributes['email'] = strtolower($attributes['email']);

        return parent::fill($attributes);
    }
}
