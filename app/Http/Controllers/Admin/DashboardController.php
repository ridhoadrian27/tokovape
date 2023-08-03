<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = "Halaman Dashboard";
      //return view('admin.dashboard', compact('data'));
      return view('admin.dashboard', [
        'folder' => 'dashboard',
        'menu' => 'dashboard',
        'data' => $data
      ]);
    }

}
