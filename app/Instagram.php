<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
  public $timestamps = false;
  protected $table = 'instagram';
  protected $primaryKey = 'id_instagram';
  protected $fillable = ['instagram'];
}
