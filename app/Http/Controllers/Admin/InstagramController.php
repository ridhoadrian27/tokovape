<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;

class InstagramController extends Controller
{
  public function index()
  {
    $id = 1;
    $settinginstagram = \App\Instagram::find($id);

    return view('admin.instagram.index', [
      'folder' => 'pengaturansosmed',
      'menu' => 'instagram',
      'settinginstagram' => $settinginstagram
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'instagram' => 'required',
    ]);

    $id = 1;
    $settinginstagram = \App\Instagram::find($id);
    $settinginstagram->update($request->all());

    return redirect('/instagram')->with('sukses', 'Data berhasil diupdate');
  }
}
