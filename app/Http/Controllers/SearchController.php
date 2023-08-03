<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SearchController extends Controller
{
  public function index(Request $request)
  {
    //dd($request->all());
    $keyword = $request->search;
    $search = DB::table('produk')->where('nama', 'like', '%'.$request->search.'%')->get();
    $ceksearch = DB::table('produk')->where('nama', 'like', '%'.$request->search.'%')->count();

    return view('web.pages.search', compact('search', 'keyword', 'ceksearch'));
  }
}
