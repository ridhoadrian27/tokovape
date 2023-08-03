<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulmarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $marketplace = Marketplace::all();

      return view('admin.marketplace.index', [
        'folder' => 'customlink',
        'menu' => 'customlink',
        'marketplace' => $marketplace
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marketplace = Marketplace::all();

        return view('admin.marketplace.create', [
          'folder' => 'customlink',
          'menu' => 'customlink',
          'marketplace' => $marketplace
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
      //  $marketplace = Marketplace::all();
        $this->validate($request,[
          'nama' => 'required',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
          'permalink' => 'required',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $marketplace = Marketplace::create([
          'nama' => $request->nama,
          'gambar' => $new_gambar,
          'permalink' => $request->permalink
        ]);

        $gambar->move('assets/marketplace/', $new_gambar);

        return redirect()->route('modulmarketplace.index')->with('success','Marketplace berhasil disimpan');
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
      $marketplace = Marketplace::findorfail($id);

      return view('admin.marketplace.edit', [
        'folder' => 'customlink',
        'menu' => 'customlink',
        'marketplace' => $marketplace
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

      $marketplace = Marketplace::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('assets/marketplace/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $marketplace_data = [
        'nama' => $request->nama,
        'gambar' => $new_gambar,
        'permalink' => $request->permalink
      ];

      $marketplace->update($marketplace_data);

      return redirect()->route('modulmarketplace.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $marketplace = Marketplace::findorfail($id);
      $marketplace->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
