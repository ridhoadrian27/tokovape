<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
  //public $timestamps = false;
  protected $table = 'skill';
  protected $fillable = ['keahlian', 'value', 'user'];

}
