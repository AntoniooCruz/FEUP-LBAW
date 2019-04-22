<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Event extends Model
{
    protected $table = 'event';

    public function getCategoryName() {
        $category = Category::where('id_category', $this->id_category)->get()->first();

        return $category->name;
    }
}
