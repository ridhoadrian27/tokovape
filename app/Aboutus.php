<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aboutus extends Model
{
  //public $timestamps = false;
  protected $table = 'aboutus';
  protected $fillable = ['title', 'subtitle', 'deskripsi', 'konten', 'gambar', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/aboutus/default.png');
    }

    return asset('assets/aboutus/'.$this->gambar);
  }

}
