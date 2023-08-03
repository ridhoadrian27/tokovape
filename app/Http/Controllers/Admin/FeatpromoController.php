<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Featpromo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class FeatpromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $featpromo = Featpromo::findorfail('1');

      return view('admin.featpromo.index', [
        'folder' => 'pengaturanpromo',
        'menu' => 'featpromo',
        'featpromo' => $featpromo
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required'
      ]);

      $id = '1';
      $featpromo = Featpromo::findorfail($id);

      $featpromo_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle
      ];

      $featpromo->update($featpromo_data);
      return redirect()->route('featpromo.index')->with('success', 'Data berhasil diupdate');
    }

}
