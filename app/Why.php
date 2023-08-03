<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Why extends Model
{
  //public $timestamps = false;
  protected $table = 'why';
  protected $fillable = ['title', 'detail', 'user'];

}
