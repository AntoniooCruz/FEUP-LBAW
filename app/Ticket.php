<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ticket';

    protected $primaryKey = 'token';

    public $timestamps = false;

    protected $fillable = [
        'id_event', 'date_acquired','id_ticket_owner','checked_in'
    ];
}
