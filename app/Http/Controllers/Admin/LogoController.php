<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LogoController extends Controller
{
  public function index()
  {
    $id = 1;
    $settinglogo = \App\Logo::find($id);

    return view('admin.logo.index', [
      'folder' => 'pengaturanwebsite',
      'menu' => 'logo',
      'settinglogo' => $settinglogo
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $id = 1;
    $settinglogo = \App\Logo::find($id);
    $settinglogo->update($request->all());

    if($request->hasFile('upload_utama')){
      // $request->file('upload_utama')->move('public/assets/logo/', $request->file('upload_utama')->getClientOriginalName());
      $request->file('upload_utama')->move('assets/logo/', $request->file('upload_utama')->getClientOriginalName());
      $settinglogo->logo = $request->file('upload_utama')->getClientOriginalName();
      $settinglogo->save();
    }

    if($request->hasFile('upload_icon')){
      $request->file('upload_icon')->move('public/assets/favicon/', $request->file('upload_icon')->getClientOriginalName());
      $settinglogo->favicon = $request->file('upload_icon')->getClientOriginalName();
      $settinglogo->save();
    }

    return redirect('/logo')->with('sukses', 'Data berhasil diupdate');
  }

  function hapuslogo()
	{
    DB::table('logo')->where('id_logo', 1)->update([
      'logo' => ''
    ]);
    return redirect('/logo')->with('sukses', 'Logo berhasil dihapus');
	}

  function hapusfavicon()
	{
    DB::table('logo')->where('id_logo', 1)->update([
      'favicon' => ''
    ]);
    return redirect('/logo')->with('sukses', 'Favicon berhasil dihapus');
	}
}
