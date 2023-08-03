<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;

class FacebookController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingfacebook = \App\Facebook::find($id);

    return view('admin.facebook.index', [
      'folder' => 'pengaturansosmed',
      'menu' => 'facebook',
      'settingfacebook' => $settingfacebook
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'facebook' => 'required',
    ]);

    $id = 1;
    $settingfacebook = \App\Facebook::find($id);
    $settingfacebook->update($request->all());

    return redirect('/facebook')->with('sukses', 'Data berhasil diupdate');
  }
}
