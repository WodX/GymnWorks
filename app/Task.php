<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
	protected $guarded = [];

    public function plan(){
    	return $this.belongsTo(Plan::class);
    }
}
