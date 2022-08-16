<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garden extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function _list(){
        return $this->hasMany('App\Calendar');
    }

    public function disable(){
        return $this->hasMany('App\Disable');
    }
}
