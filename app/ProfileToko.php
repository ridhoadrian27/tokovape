<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileToko extends Model
{
  public $timestamps = false;
  protected $table = 'profiltoko';
  protected $primaryKey = 'id_profiltoko';
  protected $fillable = ['nama', 'profile', 'email', 'alamat', 'propinsi', 'kota', 'telepon', 'handphone', 'whatsapp', 'maps', 'user'];
}
