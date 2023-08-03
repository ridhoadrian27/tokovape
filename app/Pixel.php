<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pixel extends Model
{
  public $timestamps = false;
  protected $table = 'pixel';
  protected $primaryKey = 'id_pixel';
  protected $fillable = ['pixel'];
}
