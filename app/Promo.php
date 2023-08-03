<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
  //public $timestamps = false;
  protected $table = 'promo';
  protected $fillable = ['nama', 'detail', 'gambar', 'permalink', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/promo/default.png');
    }

    return asset('assets/promo/'.$this->gambar);
  }

}
