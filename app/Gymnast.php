<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gymnast extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'gymnasts_id', 'id');
    }
}
