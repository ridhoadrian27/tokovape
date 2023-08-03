<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bannertext extends Model
{
  //public $timestamps = false;
  protected $table = 'bannertext';
  protected $fillable = ['title', 'subtitle', 'user'];

}
