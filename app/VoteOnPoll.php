<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteOnPoll extends Model
{   
    public $timestamps  = false;

    protected $table = 'vote_on_poll';

    protected $primaryKey = 'id_vote';

    protected $fillable = [
        'id_vote','id_user','id_poll', 'id_poll_option'
    ];
}
