<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  public $timestamps = false;
  protected $table = 'brand';
  protected $fillable = ['nama', 'slug', 'gambar', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/brand/default.png');
    }

    return asset('assets/brand/'.$this->gambar);
  }

}
