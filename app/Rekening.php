<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
  public $timestamps = false;
  protected $table = 'rekening';
  protected $primaryKey = 'id_rekening';
  protected $fillable = ['bank','rekening', 'atasnama'];

  public function bank()
  {
    return $this->belongsTo('App\Bank');
  }

  public function dbbank()
  {
    return $this->belongsTo('App\Dbbank');
  }
}
