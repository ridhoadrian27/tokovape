<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
  //public $timestamps = false;
  protected $table = 'time';
  protected $fillable = ['waktu', 'konten', 'user'];

}
