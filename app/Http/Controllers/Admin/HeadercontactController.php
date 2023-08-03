<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Headercontact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class HeadercontactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $headercontact = Headercontact::findorfail('1');

      return view('admin.headercontact.index', [
        'folder' => 'headercontact',
        'menu' => 'headercontact',
        'headercontact' => $headercontact
      ]);
    }

    public function update(Request $request)
    {
      $this->validate($request,[
        'title' => 'required',
        'subtitle' => 'required'
      ]);

      $id = '1';
      $headercontact = Headercontact::findorfail($id);

      $headercontact_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle
      ];

      $headercontact->update($headercontact_data);
      return redirect()->route('headercontact.index')->with('success', 'Data berhasil diupdate');
    }

}
