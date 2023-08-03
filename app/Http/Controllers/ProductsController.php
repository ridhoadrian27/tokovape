<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Product;
use App\ProfileToko;
use App\Marketplace;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
  public function index()
  {
    $product = Product::all();
    $profiletoko = ProfileToko::findorfail('1');
    $marketplace = Marketplace::all();
    $segmen = request()->segment(1);
    if($segmen=='products'){
      $menuproduct = "active";
    }else{
      $menuproduct = "";
    }

    return view('web.pages.products', compact('product', 'marketplace', 'profiletoko', 'menuproduct'));
  }
}
