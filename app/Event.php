<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\User;
use App\Ticket;

class Event extends Model
{
    protected $table = 'event';

    protected $primaryKey = 'id_event';

    public function getCategoryName() {
        $category = Category::where('id_category', $this->id_category)->get()->first();

        return $category->name;
    }

    public function getCreator() {
        
        return User::where('id_user', $this->id_owner)->get()->first()->name;
        // dd($this->belongsTo('App\User', $this->id_owner));
        // return $this->belongsTo('App\User', $this->id_owner);
    }

    public function getSoldTickets() {

        return $ticketsSold = Ticket::where('id_event', $this->id_event)->count();
    }
}
