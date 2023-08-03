<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MerkController extends Controller
{
  public function index($slug)
  {
    //dd($request->all());
    $brand = $slug;
    $getbrand = DB::table('brand')->where('slug', $brand)->first();
    $idBrand = $getbrand->id;
    $search = DB::table('produk')->where('brand', $idBrand)->get();
    $ceksearch = DB::table('produk')->where('brand', $idBrand)->count();

    return view('web.pages.brand', compact('search', 'brand', 'ceksearch'));
  }
}
