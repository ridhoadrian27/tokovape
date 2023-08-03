<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FooterimageController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingfooterimage = \App\Footerimage::find($id);

    return view('admin.footerimage.index', [
      'folder' => 'footerimage',
      'menu' => 'footerimage',
      'settingfooterimage' => $settingfooterimage
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $id = 1;
    $settingfooterimage = \App\Footerimage::find($id);
    $settingfooterimage->update($request->all());

    if($request->hasFile('upload_utama')){
      // $request->file('upload_utama')->move('public/assets/footerimage/', $request->file('upload_utama')->getClientOriginalName());
      $request->file('upload_utama')->move('assets/footerimage/', $request->file('upload_utama')->getClientOriginalName());
      $settingfooterimage->gambar = $request->file('upload_utama')->getClientOriginalName();
      $settingfooterimage->save();
    }

    return redirect('/footerimage')->with('sukses', 'Data berhasil diupdate');
  }

  function hapusfooterimage()
	{
    DB::table('footerimage')->where('id_footerimage', 1)->update([
      'footerimage' => ''
    ]);
    return redirect('/footerimage')->with('sukses', 'Footerimage berhasil dihapus');
	}

  function hapusfavicon()
	{
    DB::table('footerimage')->where('id_footerimage', 1)->update([
      'favicon' => ''
    ]);
    return redirect('/footerimage')->with('sukses', 'Favicon berhasil dihapus');
	}
}
