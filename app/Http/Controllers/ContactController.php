<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Contact;
use App\ProfileToko;
use App\Marketplace;
use App\Time;
use App\Twitter;
use App\Facebook;
use App\Instagram;
use App\Youtube;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  public function index()
  {
    $contact = Contact::all();
    $profiletoko = ProfileToko::findorfail('1');
    $marketplace = Marketplace::all();
    $time = Time::all();
    $twitter = Twitter::findorfail('1');
    $facebook = Facebook::findorfail('1');
    $instagram = Instagram::findorfail('1');
    $youtube = Youtube::findorfail('1');
    $segmen = request()->segment(1);
    if($segmen=='contact'){
      $menucontact = "active";
    }else{
      $menucontact = "";
    }

    return view('web.pages.contact', compact(
      'contact',
      'marketplace',
      'profiletoko',
      'twitter',
      'facebook',
      'instagram',
      'youtube',
      'time',
      'menucontact'
    ));
  }

  public function success()
  {

    $segmen = request()->segment(1);
    if($segmen=='contact'){
      $menucontact = "active";
    }else{
      $menucontact = "";
    }
    return view('web.pages.kontaksukses', compact(
      'menucontact'
    ));
  }

  public function insert(Request $request)
  {
      //dd($request->all());
      //$post = Post::create($request->all());
    //  $kelebihan = Kelebihan::all();
      // $this->validate($request,[
      //   'nama' => 'required',
      //   'tb_kategoriproduk_id' => 'required',
      //   'berat' => 'required',
      //   'stok' => 'required',
      //   'harga' => 'required',
      //   'harga_coret' => 'required',
      //   'deskripsi1' => 'required',
      //   'deskripsi2' => 'required',
      //   'gambar1' => 'required',
      //   'gambar2' => 'required',
      //   'gambar3' => 'required',
      //   'gambar4' => 'required',
      //   'gambar5' => 'required',
      //   'meta_title' => 'required',
      //   'meta_deskripsi' => 'required',
      //   'meta_keyword' => 'required',
      // ]);

      $contact = Contact::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'message' => $request->message
      ]);

      return redirect()->route('contact');
  }
}
