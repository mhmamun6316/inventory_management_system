<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name', 'email','phone' , 'address','photo','shop_name',
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
