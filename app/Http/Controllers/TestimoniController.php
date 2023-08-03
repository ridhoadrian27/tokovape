<?php

namespace App\Http\Controllers;

use App\Testimoni;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
  public function index()
  {
    $testimoni = Testimoni::all();
    return view('web.pages.testimoni', compact('testimoni'));
  }
}
