<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
  public function index()
  {
    $id = 1;
    $settingyoutube = \App\Youtube::find($id);

    return view('admin.youtube.index', [
      'folder' => 'pengaturansosmed',
      'menu' => 'youtube',
      'settingyoutube' => $settingyoutube
    ]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'youtube' => 'required',
    ]);

    $id = 1;
    $settingyoutube = \App\Youtube::find($id);
    $settingyoutube->update($request->all());

    return redirect('/youtube')->with('sukses', 'Data berhasil diupdate');
  }
}
