<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_user extends Model
{
  protected $table = 'tb_user';
  protected $primaryKey = 'id_user';
  protected $fillable = ['username', 'password', 'nama', 'email','hp', 'telp', 'level', 'gambar_utama', 'tanggal', 'keterangan'];

  public function getUser()
    {
      if(!$this->gambar_utama){
        return asset('images/user/noimage.png');
      }

      return asset('images/user/'.$this->gambar_utama);
    }
}
