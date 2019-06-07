<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PollOption extends Model
{
    protected $table = 'poll_option';

     // Don't add create and update timestamps in database.
     public $timestamps  = false;

     protected $primaryKey = 'id_poll_option';

     protected $fillable = [
        'name', 'id_poll'
    ];

    public function votesOnPollOption() {

        return $this->hasMany('App\VoteOnPoll', 'id_poll_option', 'id_poll_option');
    }

    public function poll() {

        return $this->belongsTo('App\Poll', 'id_poll', 'id_poll');
    }
}
