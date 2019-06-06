<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Event;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $primaryKey = 'token';

    public $timestamps = false;

    protected $fillable = [
        'id_event', 'date_acquired','id_ticket_owner','checked_in'
    ];

    public function owner(){
        return $this->Belongsto('App\User','id_ticket_owner', 'id_user');
    }

    public function event(){
        return $this->Belongsto('App\Event','id_event', 'id_event');
    }
}
