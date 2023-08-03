<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
  public $timestamps = false;
  protected $table = 'kategoriproduk';
  protected $fillable = ['nama', 'slug', 'gambar', 'user'];
}
