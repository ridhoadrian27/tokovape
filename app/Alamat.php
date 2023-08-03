<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
  public $timestamps = false;
  protected $table = 'alamat';
  protected $primaryKey = 'id_alamat';
  protected $fillable = ['nama_alamat', 'detail', 'propinsi', 'kota', 'status', 'kode_member'];
}
