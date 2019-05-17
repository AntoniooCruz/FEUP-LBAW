<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Follow extends Pivot
{
    protected $table = 'follow';

    public $timestamps = false;

    protected $primaryKey = ['id_user1', 'id_user2'];

    public $incrementing = false;
}
