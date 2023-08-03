<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Product;
use App\ProductCat;
use App\Banner;
use App\Brand;
use App\JenisProduk;
use App\Aboutus;
use App\Promo;
use App\Why;
use App\Featproduct;
use App\Testimoni;
use App\ProfileToko;
use App\Headerproduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $profiletoko = ProfileToko::findorfail('1');
    $aboutus = Aboutus::findorfail('1');
    $product = Product::limit(8)->get();
    $productcat = ProductCat::all();
    $banner = Banner::all();
    $brand = Brand::all();
    $jenisproduk = JenisProduk::all();
    $promo = Promo::all();
    $why = Why::all();
    $featproduct = Featproduct::all();
    $testimoni = Testimoni::all();
    $headerproduct = Headerproduct::findorfail('1');
    $segmen = request()->segment(1);
    if($segmen==''){
      $menuhome = "active";
    }else{
      $menuhome = "";
    }
    return view('web.pages.home', compact(
      'product',
      'productcat',
      'banner',
      'brand',
      'jenisproduk',
      'aboutus',
      'promo',
      'why',
      'featproduct',
      'headerproduct',
      'testimoni',
      'profiletoko',
      'menuhome'
    ));
  }
}
