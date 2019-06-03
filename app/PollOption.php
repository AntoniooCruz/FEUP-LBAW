<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $table = 'poll_option';

    public function votesOnPollOption() {

        return $this->hasMany('App\VoteOnPoll', 'id_poll_option', 'id_poll_option');
    }

    public function poll() {

        return $this->belongsTo('App\Poll', 'id_poll', 'id_poll');
    }
}
