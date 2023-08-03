<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Headerproduct extends Model
{
  //public $timestamps = false;
  protected $table = 'headerproduct';
  protected $fillable = ['title', 'subtitle', 'user'];

}
