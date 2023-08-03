<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
  public $timestamps = false;
  protected $table = 'twitter';
  protected $primaryKey = 'id_twitter';
  protected $fillable = ['twitter'];
}
