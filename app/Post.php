<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'id_post';
    
    public $timestamps  = false;    

    protected $fillable = [
        'date', 'text', 'id_event', 'id_author', 'post_type'
    ];

    public function author() {

        return $this->hasOne('App\User', 'id_user', 'id_author');
    }

    public function event() {

        return $this->belongsTo('App\Event', 'id_event', 'id_event');
    }

    public function poll() {
        return $this->hasOne('App\Poll', 'id_post', 'id_post');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'id_post', 'id_post');
    }
}
