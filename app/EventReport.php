<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class EventReport extends Model
{
    public $timestamps  = false;
    protected $table = 'report_event';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_report','id_reporter', 'id_event'
    ];

    public function report(){
        return $this->hasOne('App\Report', 'id_report', 'id_report');
    }

    public function reporter(){
        return $this->hasOne('App\User', 'id_user', 'id_reporter');
    }

    public function event(){
        return $this->hasOne('App\Event', 'id_event', 'id_event');
    }
}
