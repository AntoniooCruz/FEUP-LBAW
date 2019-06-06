<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','name', 'email', 'password','user_type','description', 'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The cards this user owns.
     */
     public function following() {
        return $this->belongsToMany('App\User', 'follow', 'id_user1', 'id_user2');
    }

    public function followers() {
        return $this->belongsToMany('App\User', 'follow', 'id_user2', 'id_user1');
    }

    public function tickets() {
        return $this->hasMany('App\Ticket', 'id_ticket_owner', 'id_user');
    }

    public function invited(){
        return $this->hasMany('App\Invite','id_invitee','id_user');
    }

    public function business(){
        return $this->hasOne('App\Business','id_user','id_user');
    }

    public function adminReports(){
        return $this->hasMany('App\Reports', 'id_admin', 'id_user');
    }

    public function scopeGoingToEvent($query, $id_event){
        
        return $query->whereExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('ticket')
                ->whereRaw('ticket.id_ticket_owner = users.id_user')
                ->where('ticket.id_event', $id_event);
        });
    }
}
