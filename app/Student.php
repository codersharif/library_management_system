<?php

namespace App;
/*
  |App version 1.0
  |@author shariful islam khan

 */


use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table="students";
    protected $guarded=[];
    public $timestamps = false;
}
