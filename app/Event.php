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
}
