<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    public function garden(){
        return $this->belongsTo('App\Garden');
    }

    public function review(){
        return $this->hasOne('App\Review');
    }
}
