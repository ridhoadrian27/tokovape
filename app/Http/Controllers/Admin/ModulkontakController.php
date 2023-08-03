<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModulkontakController extends Controller
{
  public function index()
  {
    $contact = Contact::all();

    return view('admin.contact', [
      'folder' => 'modulkontak',
      'menu' => 'modulkontak',
      'contact' => $contact
    ]);
  }



}
