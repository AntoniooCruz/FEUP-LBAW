<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public $timestamps  = false;
    protected $table = 'business';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user','verification', 'website'
    ];

    public function user(){
        return $this->hasOne('App\User', 'id_user', 'id_user');
    }

}
