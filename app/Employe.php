<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
        'name', 'email', 'address','salary','nid','joining_date','photo',
    ];

    public function salary()
    {
        return $this->hasMany(Salary::class);
    }
}
