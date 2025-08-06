<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpModel extends Model
{
    protected $table='employee';
    public $timestamps=false;
    protected $fillable=[ 'emp_username','emp_name','email','address','qualification','certification','achievement','skill','image','resume','created_at'];
}
