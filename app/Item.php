<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function areas(){
        return $this->hasOne('App\Area','id','areas_id');
    }
}
