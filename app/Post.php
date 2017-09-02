<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    ///***
//    /// if your table name or primary key doesnt follow the standard set it like below
//    protected $table = 'my_posts';
//    protected $primaryKey = 'post_id'

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['title', 'content'];



    public function user(){
        return $this->belongsTo('App\User');
    }




    //polymorphic relations posts
    public function photos(){
        return $this->morphToMany('App\Photo', 'imageable');
    }



}
