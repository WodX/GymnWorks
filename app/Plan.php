<?php

namespace App;

use App\PlanUser;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public static function boot() {
        parent::boot();

        static::deleting(function($plan) {
            foreach($plan->tasks as $task) {
                $task->delete();
            }

            foreach(PlanUser::where('plan_id', $plan->id)->get() as $planUser) {
                $planUser->delete();
            }
        });
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function tasks(){
    	return $this->hasMany(Task::class);
    }

    public function addTask($task){
    	
    	$this->tasks()->create($task);
	
    	/*return Task::create([

			'plan_id' => $this->id,

			'description' => $description

		]);*/

    }

    public function attachedUsers(){
        return $this->belongsToMany(Plan::class, 'plan_user', 'plan_id', 'user_id');
    }
}
