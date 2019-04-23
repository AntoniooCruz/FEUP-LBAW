<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $table = 'post';

    public function pollOptions() {

        return $this->hasMany('App\PollOption', 'id_poll', 'id_poll');
    }
}
