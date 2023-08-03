<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Featproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class FeatproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $featproduct = Featproduct::findorfail('1');

      return view('admin.featproduct.index', [
        'folder' => 'featproduct',
        'menu' => 'featproduct',
        'featproduct' => $featproduct
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'permalink' => 'required',
      ]);

      $id = '1';
      $featproduct = Featproduct::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('assets/featproduct/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $featproduct_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'gambar' => $new_gambar,
        'permalink' => $request->permalink
      ];

      $featproduct->update($featproduct_data);

      return redirect()->route('featproduct.index')->with('success', 'Data berhasil diupdate');
    }

}
