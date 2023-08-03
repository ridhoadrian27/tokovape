<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);

use App\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulsubscribeController extends Controller
{
  public function index()
  {
    $subscribe = Subscribe::all();

    return view('admin.subscribe', [
      'folder' => 'modulsubscribe',
      'menu' => 'modulsubscribe',
      'subscribe' => $subscribe
    ]);
  }



}
