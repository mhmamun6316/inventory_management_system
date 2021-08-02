<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public function employe(){
        return $this->belongsTo(Employe::class,'employee_id');
    }
}
