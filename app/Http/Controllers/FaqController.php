<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Mail\mailregister;
use App\Mail\reset;
use App\Register;
use App\Faq;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FaqController extends Controller
{
  public function index()
  {
    $faq = Faq::all();
    $segmen = request()->segment(1);
    if($segmen=='faq'){
      $faqmenu = "active";
    }else{
      $faqmenu = "";
    }
    return view('web.pages.faq', compact(
      'faq',
      'faqmenu'
    ));
  }

}
