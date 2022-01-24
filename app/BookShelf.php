<?php

namespace App;
/*
  |App version 1.0
  |@author shariful islam khan

 */


use Illuminate\Database\Eloquent\Model;

class BookShelf extends Model
{
    protected $table="bookshelf";
    protected $guarded=[];
    public $timestamps = false;
}
