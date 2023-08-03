<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
  public $timestamps = false;
  protected $table = 'seo';
  protected $primaryKey = 'id_seo';
  protected $fillable = ['title', 'deskripsi', 'keyword'];
}
