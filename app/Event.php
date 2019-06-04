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

    public $timestamps  = false;

    protected $fillable = [
        'title', 'date_created', 'date', 'location', 'description', 'price', 'capacity', 'is_private', 'city', 'id_owner','id_category',
        'zip_code','country'
    ];

    public function category(){
        return $this->belongsTo('App\Category', 'id_category', 'id_category');
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

    public function invited(){
        return $this->belongsToMany('App\User','invite','id_event','id_invitee');
    }
}
