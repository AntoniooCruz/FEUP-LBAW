<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps  = false;
    protected $table = 'report';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_report','reason', 'veridict','report_type','id_admin'
    ];

    public function reporter(){
    
        return $this->belongsTo('App\User', 'id_user', 'other_key');
    }

    public function admin(){
        return $this->hasOne('App\User', 'id_user', 'id_admin');
    }
}
