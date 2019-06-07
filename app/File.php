<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';
    protected $primaryKey = 'id_file';
    
    public $timestamps  = false;    

    protected $fillable = [
        'name', 'id_post'
    ];
}
