<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelebihan extends Model
{
  //public $timestamps = false;
  protected $table = 'kelebihan';
  protected $fillable = ['title', 'detail', 'user'];

}
