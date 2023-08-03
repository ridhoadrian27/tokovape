<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
  //public $timestamps = false;
  protected $table = 'banner';
  protected $fillable = ['nama', 'text1', 'text2', 'text3', 'button_text', 'customlink', 'gambar', 'foto', 'user'];

  public function getBanner()
  {
    if(!$this->gambar){
      return asset('assets/banner/default.png');
    }

    return asset('assets/banner/'.$this->gambar);
  }

  public function getFoto()
  {
    if(!$this->foto){
      return asset('assets/banner/default.png');
    }

    return asset('assets/banner/'.$this->foto);
  }

}
