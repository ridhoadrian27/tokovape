<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeoController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingseo = \App\Seo::find($id);

    return view('admin.seo.index', [
      'folder' => 'pengaturanseo',
      'menu' => 'seo',
      'settingseo' => $settingseo
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $id = 1;
    $settingseo = \App\Seo::find($id);
    $settingseo->update($request->all());

    //return redirect('/settingseo')->with('sukses', 'Data berhasil diupdate');
  }
}
