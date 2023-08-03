<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Aboutus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulaboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $aboutus = Aboutus::findorfail('1');

      return view('admin.aboutus.index', [
        'folder' => 'aboutus',
        'menu' => 'aboutus',
        'aboutus' => $aboutus
      ]);
    }

    public function update(Request $request)
    {

      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required',
        'deskripsi' => 'required',
        'konten' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
      ]);

      $id = '1';
      $aboutus = Aboutus::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        // $gambar->move('public/assets/aboutus/', $new_gambar);
        $gambar->move('assets/aboutus/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $aboutus_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'deskripsi' => $request->deskripsi,
        'konten' => $request->konten,
        'gambar' => $new_gambar
      ];

      $aboutus->update($aboutus_data);
      return redirect()->route('modulaboutus.index')->with('success', 'Data berhasil diupdate');
    }

}
