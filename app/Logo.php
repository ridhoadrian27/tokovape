<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
  public $timestamps = false;
  protected $table = 'logo';
  protected $primaryKey = 'id_logo';
  protected $fillable = ['logo', 'favicon'];


  public function getLogo()
  {
    if(!$this->logo){
      return asset('assets/logo/default.png');
    }

    return asset('assets/logo/'.$this->logo);
  }

  public function getFavicon()
  {
    if(!$this->favicon){
      return asset('assets/favicon/default.png');
    }

    return asset('assets/favicon/'.$this->favicon);
  }
}
