<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulmemberController extends Controller
{
  public function index()
  {
    $member = Member::all();
    return view('admin.member', [
      'folder' => 'modulmember',
      'menu' => 'modulmember',
      'member' => $member
    ]);
  }



}
