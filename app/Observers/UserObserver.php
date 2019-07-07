<?php

namespace AVD\Observers;


use AVD\Mail\UserRegistered;

class UserObserver
{
    public function creating($user){
        //
    }

    public function created($user){
        \Mail::to($user)->send(new UserRegistered($user));
    }
    public function updating($user){
        //
    }
    public function updated($user){
       //
    }
    public function saving($user){
        //
    }
    public function saved($user){
        //
    }

}