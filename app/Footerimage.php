<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footerimage extends Model
{
  public $timestamps = false;
  protected $table = 'footerimage';
  protected $primaryKey = 'id_footerimage';
  protected $fillable = ['gambar'];


  public function getGambar()
  {
    if(!$this->gambar){
      return asset('assets/footerimage/default.png');
    }

    return asset('assets/footerimage/'.$this->gambar);
  }

}
