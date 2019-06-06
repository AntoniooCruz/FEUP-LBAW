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
}
