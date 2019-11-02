<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function category() {
        return $this->hasOne('app\Category', 'id', 'category_id');
    }
}
