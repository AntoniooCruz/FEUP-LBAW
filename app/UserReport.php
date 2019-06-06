<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    public $timestamps  = false;
    protected $table = 'report_user';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_report','id_reporter', 'id_reported_user'
    ];

    public function report(){
        return $this->hasOne('App\Report', 'id_report', 'id_report');
    }
}
