<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use App\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $productcat = ProductCat::all();

      return view('admin.productcat.index', [
        'folder' => 'pengaturanproduk',
        'menu' => 'productcat',
        'productcat' => $productcat
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.productcat.create', [
          'folder' => 'pengaturanproduk',
          'menu' => 'productcat'
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
          'nama' => 'required|min:3'
        ]);
        $productcat = ProductCat::create([
          'nama' => $request->nama,
          'slug' => Str::slug($request->nama)
        ]);
        //return redirect()->back()->with('success','Data berhasil disimpan');
        return redirect()->route('productcat.index')->with('success', 'Data berhasil disimpan');
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
      $productcat = ProductCat::findorfail($id);

      return view('admin.productcat.edit', [
        'folder' => 'pengaturanproduk',
        'menu' => 'productcat',
        'productcat' => $productcat
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
      'nama' => 'required|min:3'
      ]);

      $productcat_data = [
        'nama' => $request->nama,
        'slug' => Str::slug($request->nama)
      ];

      ProductCat::whereId($id)->update($productcat_data);
      return redirect()->route('productcat.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $productcat = ProductCat::findorfail($id);
      $productcat->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
