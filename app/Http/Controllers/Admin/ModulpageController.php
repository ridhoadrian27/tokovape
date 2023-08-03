<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulpageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $page = Page::all();

      return view('admin.page.index', [
        'folder' => 'modulpage',
        'menu' => 'modulpage',
        'page' => $page
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = Page::all();

        return view('admin.page.create', [
          'folder' => 'modulpage',
          'menu' => 'modulpage',
          'page' => $page
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
      //  $page = Page::all();
        $this->validate($request,[
          'nama' => 'required',
          'gambar' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
          'konten' => 'required',
          'meta_title' => 'required',
          'meta_deskripsi' => 'required',
          'meta_keyword' => 'required',
        ]);

        $gambar = $request->gambar;
        if($gambar){
          $new_gambar = time().$gambar->getClientOriginalName();
          // $gambar->move('public/assets/page/', $new_gambar);
          $gambar->move('assets/page/', $new_gambar);
        }else{
          $new_gambar = "";
        }

        $page = Page::create([
          'nama' => $request->nama,
          'gambar' => $new_gambar,
          'konten' => $request->konten,
          'meta_title' => $request->meta_title,
          'meta_deskripsi' => $request->meta_deskripsi,
          'meta_keyword' => $request->meta_keyword,
          'slug' => Str::slug($request->nama)
        ]);

        return redirect()->route('modulpage.index')->with('success','Page berhasil disimpan');
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
      $page = Page::findorfail($id);

      return view('admin.page.edit', [
        'folder' => 'modulpage',
        'menu' => 'modulpage',
        'page' => $page
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
        'konten' => 'required',
        'meta_title' => 'required',
        'meta_deskripsi' => 'required',
        'meta_keyword' => 'required'
      ]);

      $page = Page::findorfail($id);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('assets/page/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      $page_data = [
        'nama' => $request->nama,
        'gambar' => $new_gambar,
        'konten' => $request->konten,
        'meta_title' => $request->meta_title,
        'meta_deskripsi' => $request->meta_deskripsi,
        'meta_keyword' => $request->meta_keyword,
        'slug' => Str::slug($request->nama)
      ];

      $page->update($page_data);

      return redirect()->route('modulpage.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $page = Page::findorfail($id);
      $page->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
