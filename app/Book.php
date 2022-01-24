<?php

namespace App;
/*
  |App version 1.0
  |@author shariful islam khan

 */


use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table="books";
    protected $guarded=[];
    public $timestamps = false;
}
