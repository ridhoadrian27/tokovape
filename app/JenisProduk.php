<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisProduk extends Model
{
  public $timestamps = false;
  protected $table = 'jenisproduk';
  protected $fillable = ['nama', 'slug', 'gambar', 'user'];
}
