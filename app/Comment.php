<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    protected $primaryKey = 'id_comment';

    public $timestamps  = false;    

    protected $fillable = [
        'text', 'id_post', 'id_parent_comment', 'id_author', 'date'
    ];

    public function post() {

        return $this->belongsTo('App\Post', 'id_post', 'id_post');
    }

    
}
