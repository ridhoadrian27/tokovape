<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  //public $timestamps = false;
  protected $table = 'produk';
  protected $fillable = ['kode_produk', 'kategoriproduk_id', 'jenisproduk', 'brand', 'subkategori', 'tag', 'ukuran', 'nama', 'slug', 'satuan', 'harga', 'stok', 'berat', 'harga_coret', 'deskripsi1', 'deskripsi2', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5', 'dilihat', 'rating', 'video', 'atribut', 'meta_title', 'meta_deskripsi', 'meta_keyword', 'user'];

  public function kategoriproduk()
  {
    return $this->belongsTo('App\ProductCat');
  }

  public function getGambar1()
  {
    if(!$this->gambar1){
      return asset('assets/product/default.png');
    }

    return asset('assets/product/'.$this->gambar1);
  }

  public function getGambar2()
  {
    if(!$this->gambar2){
      return asset('assets/product/default.png');
    }

    return asset('assets/product/'.$this->gambar2);
  }

  public function getGambar3()
  {
    if(!$this->gambar3){
      return asset('assets/product/default.png');
    }

    return asset('assets/product/'.$this->gambar3);
  }

  public function getGambar4()
  {
    if(!$this->gambar4){
      return asset('assets/product/default.png');
    }

    return asset('assets/product/'.$this->gambar4);
  }

  public function getGambar5()
  {
    if(!$this->gambar5){
      return asset('assets/product/default.png');
    }

    return asset('assets/product/'.$this->gambar5);
  }

}
