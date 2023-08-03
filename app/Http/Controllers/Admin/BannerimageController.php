<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BannerimageController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingbannerimage = \App\Bannerimage::find($id);

    return view('admin.bannerimage.index', [
      'folder' => 'bannerimage',
      'menu' => 'bannerimage',
      'settingbannerimage' => $settingbannerimage
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $id = 1;
    $settingbannerimage = \App\Bannerimage::find($id);
    $settingbannerimage->update($request->all());

    if($request->hasFile('upload_utama')){
      // $request->file('upload_utama')->move('public/assets/bannerimage/', $request->file('upload_utama')->getClientOriginalName());
      $request->file('upload_utama')->move('assets/bannerimage/', $request->file('upload_utama')->getClientOriginalName());
      $settingbannerimage->gambar = $request->file('upload_utama')->getClientOriginalName();
      $settingbannerimage->save();
    }

    return redirect('/bannerimage')->with('sukses', 'Data berhasil diupdate');
  }

  function hapusbannerimage()
	{
    DB::table('bannerimage')->where('id_bannerimage', 1)->update([
      'bannerimage' => ''
    ]);
    return redirect('/bannerimage')->with('sukses', 'Bannerimage berhasil dihapus');
	}

  function hapusfavicon()
	{
    DB::table('bannerimage')->where('id_bannerimage', 1)->update([
      'favicon' => ''
    ]);
    return redirect('/bannerimage')->with('sukses', 'Favicon berhasil dihapus');
	}
}
