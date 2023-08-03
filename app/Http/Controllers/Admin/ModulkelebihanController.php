<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Kelebihan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulkelebihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $kelebihan = Kelebihan::all();

      return view('admin.kelebihan.index', [
        'folder' => 'pengaturanwhy',
        'menu' => 'modulkelebihan',
        'kelebihan' => $kelebihan
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelebihan = Kelebihan::all();

        return view('admin.kelebihan.create', [
          'folder' => 'pengaturanwhy',
          'menu' => 'modulkelebihan',
          'kelebihan' => $kelebihan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //$post = Post::create($request->all());
      //  $kelebihan = Kelebihan::all();
        $this->validate($request,[
          'title' => 'required',
          'detail' => 'required'
        ]);

        $kelebihan = Kelebihan::create([
          'title' => $request->title,
          'detail' => $request->detail
        ]);

        return redirect()->route('modulkelebihan.index')->with('success','Kelebihan berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $kelebihan = Kelebihan::findorfail($id);

      return view('admin.kelebihan.edit', [
        'folder' => 'pengaturanwhy',
        'menu' => 'modulkelebihan',
        'kelebihan' => $kelebihan
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $this->validate($request,[
        'title' => 'required',
        'detail' => 'required'
      ]);

      $kelebihan = Kelebihan::findorfail($id);

      $kelebihan_data = [
        'title' => $request->title,
        'detail' => $request->detail
      ];

      $kelebihan->update($kelebihan_data);

      return redirect()->route('modulkelebihan.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $kelebihan = Kelebihan::findorfail($id);
      $kelebihan->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
