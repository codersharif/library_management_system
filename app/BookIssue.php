<?php

namespace App;
/*
  |App version 1.0
  |@author shariful islam khan

 */


use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $table="book_issue";
    protected $guarded=[];
    public $timestamps = false;
}
