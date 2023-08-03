<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
  //public $timestamps = false;
  protected $table = 'marketplace';
  protected $fillable = ['nama', 'gambar', 'permalink', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/marketplace/default.png');
    }

    return asset('assets/marketplace/'.$this->gambar);
  }

}
