<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\User;
use App\Ticket;
use App\Post;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id_event';

    public function category(){
        return $this->hasOne('App\Category', 'id_category', 'id_category');
    }

    public function owner(){
        return $this->hasOne('App\User', 'id_user', 'id_owner');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket', 'id_event', 'id_event');
    }

    public function posts() {
        return $this->hasMany('App\Post', 'id_event', 'id_event');
    }
}
