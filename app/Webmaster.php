<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Webmaster extends Model
{
  public $timestamps = false;
  protected $table = 'webmaster';
  protected $primaryKey = 'id_webmaster';
  protected $fillable = ['webmaster'];
}
