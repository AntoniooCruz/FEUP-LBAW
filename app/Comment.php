<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

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

    public function owner(){
        return $this->Belongsto('App\User','id_author', 'id_user');
    }

    
}
