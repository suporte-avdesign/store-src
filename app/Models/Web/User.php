<?php

namespace AVD\Models\Web;

//use AVD\Events\UserRegisteredEvent;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
use AVD\Mail\ResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable
{

    use Notifiable;


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

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    protected $dispatchesEvents = [
        'created' => UserRegisteredEvent::class,
    ];
    */

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



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function profile()
    {
        return $this->belongsTo(ConfigProfileClient::class, 'profile_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function adresses()
    {
        return $this->hasMany(UserAddress::class);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transport()
    {
        return $this->hasMany(UserTransport::class);
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->type_id == 1 ? $name = $this->last_name : $name = $this->first_name;

        \Mail::to($this->email)->send(new ResetPassword($name, $token));
    }





}
