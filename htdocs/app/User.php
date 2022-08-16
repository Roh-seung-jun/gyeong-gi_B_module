<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $guarded = [];
    protected $keyType = 'string';


    public function calendar(){
        return $this->hasMany('App\Calendar')->where('start_date','>',date('Y-m-d'))->get();
    }
    public function history(){
        return $this->hasMany('App\Calendar')->where('end_date','<',date('Y-m-d'))->get();
    }

    public function admin(){
        return $this->hasOne('App\Garden');
    }
}
