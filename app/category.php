<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = [
        'categories_name', 
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
