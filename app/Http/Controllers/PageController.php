<?php

namespace App\Http\Controllers;
error_reporting(0);
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProfileToko;
use App\Marketplace;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug)
    {
      $page = Page::where('slug', $slug)->first();
      $profiletoko = ProfileToko::findorfail('1');
      $marketplace = Marketplace::all();
      //return view('front.detail', compact('product'));
      return view('web.pages.page_detail', compact('page', 'marketplace', 'profiletoko'));
    }
}
