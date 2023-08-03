<?php

namespace App\Http\Controllers\Admin;

use App\Modtestimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModtestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $modtestimoni = Modtestimoni::findorfail('1');
      return view('admin.modtestimoni.index', compact('modtestimoni'));
    }

    public function update(Request $request)
    {
      // $this->validate($request,[
      //   'judul' => 'required',
      //   'category_id' => 'required',
      //   'content' => 'required'
      // ]);
      $id = '1';
      $modtestimoni = Modtestimoni::findorfail($id);

      $modtestimoni_data = [
        'title' => $request->title,
        'subtitle' => $request->subtitle
      ];

      $modtestimoni->update($modtestimoni_data);
      return redirect()->route('modtestimoni.index')->with('success', 'Data berhasil diupdate');
    }

}
