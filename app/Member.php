<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Member extends Authenticatable
{
  use Notifiable;

  protected $table = 'member';
  protected $primaryKey = 'id';
  protected $fillable = [
      'name', 'email', 'password', 'telepon'
  ];

  protected $hidden = [
      'password', 'remember_token',
  ];

  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

  public function getUser()
    {
      if(!$this->foto){
        return asset('assets/user/noimage.png');
      }

      return asset('assets/user/'.$this->foto);
    }
}
