<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanUser extends Model
{
    public $table = 'plan_user';
    public $fillable = ['user_id', 'plan_id'];
}
