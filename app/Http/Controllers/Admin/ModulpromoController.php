<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulpromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $promo = Promo::all();

      return view('admin.promo.index', [
        'folder' => 'pengaturanpromo',
        'menu' => 'modulpromo',
        'promo' => $promo
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promo = Promo::all();

        return view('admin.promo.create', [
          'folder' => 'modulpromo',
          'menu' => 'modulpromo',
          'promo' => $promo
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
      //  $promo = Promo::all();
        $this->validate($request,[
          'nama' => 'required',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
          'permalink' => 'required',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $promo = Promo::create([
          'nama' => $request->nama,
          'detail' => $request->detail,
          'gambar' => $new_gambar,
          'permalink' => $request->permalink
        ]);

        $gambar->move('public/assets/promo/', $new_gambar);

        return redirect()->route('modulpromo.index')->with('success','Promo berhasil disimpan');
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
      $promo = Promo::findorfail($id);

      return view('admin.promo.edit', [
        'folder' => 'pengaturanpromo',
        'menu' => 'modulpromo',
        'promo' => $promo
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
        'permalink' => 'required',
      ]);

      $promo = Promo::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('public/assets/promo/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $promo_data = [
        'nama' => $request->nama,
        'detail' => $request->detail,
        'gambar' => $new_gambar,
        'permalink' => $request->permalink
      ];

      $promo->update($promo_data);

      return redirect()->route('modulpromo.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $promo = Promo::findorfail($id);
      $promo->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
