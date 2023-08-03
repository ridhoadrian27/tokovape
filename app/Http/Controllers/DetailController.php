<?php

namespace App\Http\Controllers;
error_reporting(0);
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProfileToko;
use App\Marketplace;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
      $product = Product::where('slug', $slug)->first();
      $profiletoko = ProfileToko::findorfail('1');
      $marketplace = Marketplace::all();
      //return view('front.detail', compact('product'));
      return view('web.pages.product_detail', compact('product', 'marketplace', 'profiletoko'));
    }
}
