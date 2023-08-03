<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featproduct extends Model
{
  //public $timestamps = false;
  protected $table = 'featproduct';
  protected $fillable = ['title', 'subtitle', 'gambar', 'permalink', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/featproduct/default.png');
    }

    return asset('assets/featproduct/'.$this->gambar);
  }

}
