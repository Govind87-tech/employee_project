<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginActivityModel extends Model
{
     protected $table='login_activity';
    public $timestamps=false;
    protected $fillable=['role','username','status','ip','browser','device','os','description','created_at'];
}
