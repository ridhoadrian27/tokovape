<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featpromo extends Model
{
  //public $timestamps = false;
  protected $table = 'featpromo';
  protected $fillable = ['title', 'subtitle', 'user'];

}
