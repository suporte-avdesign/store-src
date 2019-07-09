<?php

namespace AVD\Models\Web;

use AVD\Events\UserRegisteredEvent;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{

    protected $fillable = [
        'profile_id',
        'type_id',
        'first_name',
        'last_name',
        'email',
        'document1',
        'document2',
        'phone',
        'cell',
        'admin',
        'token',
        'password',
        'client',
        'date',
        'active',
        'newsletter',
        'ip',
        'visits',
        'last_login',
        'logout'
    ];

    protected $dispatchesEvents = [
        'created' => UserRegisteredEvent::class,
    ];


    /**
     *
     * @param array $attributes
     * @return $this
     */
    public function fill(array $attributes)
    {
        !isset($attributes['password']) ?: $attributes['password'] = bcrypt($attributes['password']);
        !isset($attributes['email']) ?: $attributes['email'] = strtolower($attributes['email']);

        return parent::fill($attributes);
    }

}
