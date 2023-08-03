<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Headerproduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class HeaderproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $headerproduct = Headerproduct::findorfail('1');

      return view('admin.headerproduct.index', [
        'folder' => 'headerproduct',
        'menu' => 'headerproduct',
        'headerproduct' => $headerproduct
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required'
      ]);

      $id = '1';
      $headerproduct = Headerproduct::findorfail($id);

      $headerproduct_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle
      ];

      $headerproduct->update($headerproduct_data);
      return redirect()->route('headerproduct.index')->with('success', 'Data berhasil diupdate');
    }

}
