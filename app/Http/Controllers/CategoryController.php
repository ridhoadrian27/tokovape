<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index($slug)
  {
    //dd($request->all());
    $kategori = $slug;
    $getkategori = DB::table('kategoriproduk')->where('slug', $kategori)->first();
    $idKategori = $getkategori->id;
    $namaKategori = $getkategori->nama;
    $search = DB::table('produk')->where('kategoriproduk_id', $idKategori)->get();
    $ceksearch = DB::table('produk')->where('kategoriproduk_id', $idKategori)->count();

    return view('web.pages.kategori', compact('search', 'namaKategori', 'kategori', 'ceksearch'));
  }
}
