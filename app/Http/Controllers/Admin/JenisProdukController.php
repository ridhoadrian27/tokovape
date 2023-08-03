<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use App\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $jenisproduk = JenisProduk::all();

      return view('admin.jenisproduk.index', [
        'folder' => 'pengaturanproduk',
        'menu' => 'jenisproduk',
        'jenisproduk' => $jenisproduk
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.jenisproduk.create', [
          'folder' => 'pengaturanproduk',
          'menu' => 'jenisproduk'
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
        $jenisproduk = JenisProduk::create([
          'nama' => $request->nama,
          'slug' => Str::slug($request->nama)
        ]);
        //return redirect()->back()->with('success','Data berhasil disimpan');
        return redirect()->route('jenisproduk.index')->with('success', 'Data berhasil disimpan');
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
      $jenisproduk = JenisProduk::findorfail($id);

      return view('admin.jenisproduk.edit', [
        'folder' => 'pengaturanproduk',
        'menu' => 'jenisproduk',
        'jenisproduk' => $jenisproduk
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

      $jenisproduk_data = [
        'nama' => $request->nama,
        'slug' => Str::slug($request->nama)
      ];

      JenisProduk::whereId($id)->update($jenisproduk_data);
      return redirect()->route('jenisproduk.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $jenisproduk = JenisProduk::findorfail($id);
      $jenisproduk->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
