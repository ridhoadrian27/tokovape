<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimoni extends Model
{
  //public $timestamps = false;
  protected $table = 'testimoni';
  protected $fillable = ['nama', 'gambar', 'testimoni', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/testimoni/default.png');
    }

    return asset('assets/testimoni/'.$this->gambar);
  }

}
