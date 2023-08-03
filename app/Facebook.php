<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facebook extends Model
{
  public $timestamps = false;
  protected $table = 'facebook';
  protected $primaryKey = 'id_facebook';
  protected $fillable = ['facebook'];
}
