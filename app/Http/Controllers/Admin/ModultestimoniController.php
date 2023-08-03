<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModultestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $testimoni = Testimoni::all();

      return view('admin.testimoni.index', [
        'folder' => 'modultestimoni',
        'menu' => 'modultestimoni',
        'testimoni' => $testimoni
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $testimoni = Testimoni::all();

        return view('admin.testimoni.create', [
          'folder' => 'modultestimoni',
          'menu' => 'modultestimoni',
          'testimoni' => $testimoni
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
      //  $testimoni = Testimoni::all();
        $this->validate($request,[
          'nama' => 'required',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
          'testimoni' => 'required',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $testimoni = Testimoni::create([
          'nama' => $request->nama,
          'gambar' => $new_gambar,
          'testimoni' => $request->testimoni
        ]);

        $gambar->move('assets/testimoni/', $new_gambar);

        return redirect()->route('modultestimoni.index')->with('success','Testimoni berhasil disimpan');
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
      $testimoni = Testimoni::findorfail($id);

      return view('admin.testimoni.edit', [
        'folder' => 'modultestimoni',
        'menu' => 'modultestimoni',
        'testimoni' => $testimoni
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
        'nama' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'testimoni' => 'required',
      ]);

      $testimoni = Testimoni::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('assets/testimoni/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $testimoni_data = [
        'nama' => $request->nama,
        'gambar' => $new_gambar,
        'testimoni' => $request->testimoni
      ];

      $testimoni->update($testimoni_data);

      return redirect()->route('modultestimoni.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $testimoni = Testimoni::findorfail($id);
      $testimoni->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
