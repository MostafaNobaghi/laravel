<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
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




    public function post(){
        return $this->hasOne('App\Post');
    }


    public function posts(){
        return $this->hasMany('App\Post');
    }


    public function roles(){
        return $this->belongsToMany('App\Role')->withPivot('created_at');

        // if you tables name doesnt following laravel convention, Define it like this
        // return $this->belongsToMany('App\Role', 'roles_users', 'user_id', 'role_id');
    }



    // Polymorphic relations
    public function photos(){
        return $this->morphToMany('App\Photo', 'imageable');
    }


}
