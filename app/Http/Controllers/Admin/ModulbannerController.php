<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulbannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $banner = Banner::all();

      return view('admin.banner.index', [
        'folder' => 'banner',
        'menu' => 'banner',
        'banner' => $banner
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banner = Banner::all();

        return view('admin.banner.create', [
          'folder' => 'banner',
          'menu' => 'banner',
          'banner' => $banner
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
      //  $banner = Banner::all();
        $this->validate($request,[
          //'nama' => 'required',
          'text1' => 'required',
          'text2' => 'required',
          // 'text3' => 'required',
          'button_text' => 'required',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
          //'foto' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        // $last = Banner::orderBy('id','desc')->first();
        // if($last){
        //   $lastdigit = '2';
        // }else{
        //   $lastdigit = '1';
        // }

        //$kode_produk = "SKU".$lastdigit;

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        // $foto = $request->foto;
        // $new_foto = time().$foto->getClientOriginalName();

        $banner = Banner::create([
          //'nama' => $request->nama,
          'text1' => $request->text1,
          'text2' => $request->text2,
          // 'text3' => $request->text3,
          'button_text' => $request->button_text,
          'customlink' => $request->customlink,
          'gambar' => $new_gambar,
          //'foto' => $new_foto
        ]);

        $gambar->move('assets/banner/', $new_gambar);
        //$foto->move('public/assets/banner/', $new_foto);

        return redirect()->route('modulbanner.index')->with('success','Banner berhasil disimpan');
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
      $banner = Banner::findorfail($id);

      return view('admin.banner.edit', [
        'folder' => 'banner',
        'menu' => 'banner',
        'banner' => $banner
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
        //'nama' => 'required',
        'text1' => 'required',
        'text2' => 'required',
        // 'text3' => 'required',
        'button_text' => 'required',
        'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        // 'foto' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
      ]);

      $banner = Banner::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('public/assets/banner/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      // if($request->has('foto')){
      //   $foto = $request->foto;
      //   $new_foto = time().$foto->getClientOriginalName();
      //   $foto->move('public/assets/banner/', $new_foto);
      // }else{
      //   $new_foto = $request->foto_lama;
      // }

      $banner_data = [
        //'nama' => $request->nama,
        'text1' => $request->text1,
        'text2' => $request->text2,
        // 'text3' => $request->text3,
        'button_text' => $request->button_text,
        'customlink' => $request->customlink,
        'gambar' => $new_gambar,
        //'foto' => $new_foto
      ];

      $banner->update($banner_data);

      return redirect()->route('modulbanner.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $banner = Banner::findorfail($id);
      $banner->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
