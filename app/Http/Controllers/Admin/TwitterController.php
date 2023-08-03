<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;

class TwitterController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingtwitter = \App\Twitter::find($id);

    return view('admin.twitter.index', [
      'folder' => 'pengaturansosmed',
      'menu' => 'twitter',
      'settingtwitter' => $settingtwitter
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'twitter' => 'required',
    ]);

    $id = 1;
    $settingtwitter = \App\Twitter::find($id);
    $settingtwitter->update($request->all());

    return redirect('/twitter')->with('sukses', 'Data berhasil diupdate');
  }
}
