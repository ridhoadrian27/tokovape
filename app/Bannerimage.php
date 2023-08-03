<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bannerimage extends Model
{
  public $timestamps = false;
  protected $table = 'bannerimage';
  protected $primaryKey = 'id_bannerimage';
  protected $fillable = ['gambar'];


  public function getGambar()
  {
    if(!$this->gambar){
      return asset('assets/bannerimage/default.png');
    }

    return asset('assets/bannerimage/'.$this->gambar);
  }

}
