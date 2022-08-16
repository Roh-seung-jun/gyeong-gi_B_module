<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    public function file(){
        return $this->hasMany('App\Review_file');
    }
}
