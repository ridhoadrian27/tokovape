<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
  //public $timestamps = false;
  protected $table = 'video';
  protected $fillable = ['nama', 'embed', 'user'];

}
