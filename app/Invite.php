<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite';
    protected $primaryKey = 'id_invite';
    public $timestamps = false;

    protected $fillable = [
        'id_invite', 'id_event', 'id_inviter', 'id_invitee'
    ];

    public function inviter(){
        return $this->hasOne('App\User', 'id_user', 'id_inviter');
    }

    public function invitee(){
        return $this->hasOne('App\User', 'id_user', 'id_invitee');
    }
}
