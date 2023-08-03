<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modtestimoni extends Model
{
  //public $timestamps = false;
  protected $table = 'modtestimoni';
  protected $fillable = ['title', 'subtitle', 'user'];

}
