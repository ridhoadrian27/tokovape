<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PixelController extends Controller
{
  public function index()
{
  $id = 1;
  $settingpixel = \App\Pixel::find($id);

  return view('admin.pixel.index', [
    'folder' => 'pixel',
    'menu' => 'pixel',
    'settingpixel' => $settingpixel
  ]);
}

public function update(Request $request)
{
  //dd($request->all());
  // $this->validate($request,[
  //   'pixel' => 'required',
  // ]);

  DB::table('pixel')->where('id_pixel', '1')->update([
    'pixel' => $request->pixel
  ]);

  return redirect('/pixel')->with('sukses', 'Data berhasil diupdate');
}
}
