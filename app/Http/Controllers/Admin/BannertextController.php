<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Bannertext;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class BannertextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $bannertext = Bannertext::findorfail('1');

      return view('admin.bannertext.index', [
        'folder' => 'bannertext',
        'menu' => 'bannertext',
        'bannertext' => $bannertext
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required'
      ]);

      $id = '1';
      $bannertext = Bannertext::findorfail($id);

      $bannertext_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle
      ];

      $bannertext->update($bannertext_data);
      return redirect()->route('bannertext.index')->with('success', 'Data berhasil diupdate');
    }

}
