<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Mail\mailregister;
use App\Mail\reset;
use App\Register;
use App\Time;
use App\ProfileToko;
use App\Aboutus;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
  public function index()
  {
    $profiletoko = ProfileToko::findorfail('1');
    $aboutus = Aboutus::findorfail('1');
    $time = Time::all();
    $segmen = request()->segment(1);
    if($segmen=='about'){
      $menuabout = "active";
    }else{
      $menuabout = "";
    }
    return view('web.pages.about', compact(
      'profiletoko',
      'aboutus',
      'time',
      'menuabout'
    ));
  }

}
