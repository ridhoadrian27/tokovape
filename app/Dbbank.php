<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dbbank extends Model
{
  public $timestamps = false;
  protected $table = 'bank';
  protected $primaryKey = 'id_bank';
  protected $fillable = ['nama_bank','gambar'];

  public function getGambar()
  {
    if(!$this->gambar){
      return asset('assets/bank/default.png');
    }

    return asset('assets/bank/'.$this->gambar);
  }
}
