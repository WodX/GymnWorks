<?php

namespace App;

use App\PlanUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            foreach($user->plans as $plan) {
                $plan->delete();
            }

            foreach($user->posts as $post) {
                $post->delete();
            }

            foreach(PlanUser::where('user_id', $user->id)->get() as $planUser) {
                $planUser->delete();
            }
        });
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function plans(){
        return $this->hasMany('App\Plan');
    }

    public function attachedPlans(){
        return $this->belongsToMany(Plan::class, 'plan_user', 'user_id', 'plan_id');
    }

    public function gymnasts(){
        return $this->hasMany('App\Gymnast');
    }
}
