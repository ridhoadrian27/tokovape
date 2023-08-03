<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
  public $timestamps = false;
  protected $table = 'youtube';
  protected $primaryKey = 'id_youtube';
  protected $fillable = ['youtube'];
}
