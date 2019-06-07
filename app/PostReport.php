<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PostReport extends Model
{
    public $timestamps  = false;
    protected $table = 'report_post';
    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_report','id_reporter', 'id_post'
    ];

    public function report(){
        return $this->hasOne('App\Report', 'id_report', 'id_report');
    }

    public function reporter(){
        return $this->hasOne('App\User', 'id_user', 'id_reporter');
    }

    public function post(){
        return $this->hasOne('App\Post', 'id_post', 'id_post');
    }
}
