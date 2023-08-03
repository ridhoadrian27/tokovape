<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headercontact extends Model
{
  //public $timestamps = false;
  protected $table = 'headercontact';
  protected $fillable = ['title', 'subtitle', 'user'];

}
