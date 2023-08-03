<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  //public $timestamps = false;
  protected $table = 'page';
  protected $fillable = ['nama', 'slug', 'gambar', 'konten', 'meta_title', 'meta_deskripsi', 'meta_keyword', 'user'];

  public function getImage()
  {
    if(!$this->gambar){
      return asset('assets/page/default.png');
    }

    return asset('assets/page/'.$this->gambar);
  }

}
