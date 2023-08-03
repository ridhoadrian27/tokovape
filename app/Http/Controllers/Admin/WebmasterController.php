<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;

class WebmasterController extends Controller
{
  public function index()
{
  $id = 1;
  $settingwebmaster = \App\Webmaster::find($id);

  return view('admin.webmaster.index', [
    'folder' => 'pengaturanseo',
    'menu' => 'webmaster',
    'settingwebmaster' => $settingwebmaster
  ]);
}

public function update(Request $request)
{
  //dd($request->all());
  // $this->validate($request,[
  //   'webmaster' => 'required'
  // ]);

  $id = 1;
  $settingwebmaster = \App\Webmaster::find($id);
  $settingwebmaster->update($request->all());

  return redirect('/webmaster')->with('sukses', 'Data berhasil diupdate');
}
}
