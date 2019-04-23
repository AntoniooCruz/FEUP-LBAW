<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post';

    public function author() {

        return $this->hasOne('App\User', 'id_user', 'id_author');
    }

    public function event() {

        return $this->belongsTo('App\Event', 'id_event', 'id_event');
    }

    public function poll() {
        return $this->hasOne('App\Poll', 'id_post', 'id_post');
    }
}
