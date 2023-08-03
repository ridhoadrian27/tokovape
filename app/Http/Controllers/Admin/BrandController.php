<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use App\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $brand = Brand::all();

      return view('admin.brand.index', [
        'folder' => 'pengaturanproduk',
        'menu' => 'brand',
        'brand' => $brand
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.brand.create', [
          'folder' => 'pengaturanproduk',
          'menu' => 'brand'
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
        $this->validate($request,[
          'nama' => 'required|min:3',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $brand = Brand::create([
          'nama' => $request->nama,
          'gambar' => $new_gambar,
          'slug' => Str::slug($request->nama)
        ]);

        $gambar->move('public/assets/brand/', $new_gambar);
        //return redirect()->back()->with('success','Data berhasil disimpan');
        return redirect()->route('brand.index')->with('success', 'Data berhasil disimpan');
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
      $brand = Brand::findorfail($id);

      return view('admin.brand.edit', [
        'folder' => 'pengaturanproduk',
        'menu' => 'brand',
        'brand' => $brand
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
      'nama' => 'required|min:3',
      'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
      ]);

      $brand = Brand::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('public/assets/brand/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $brand_data = [
        'nama' => $request->nama,
        'gambar' => $new_gambar,
        'slug' => Str::slug($request->nama)
      ];

      Brand::whereId($id)->update($brand_data);
      return redirect()->route('brand.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $brand = Brand::findorfail($id);
      $brand->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
