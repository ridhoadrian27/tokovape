<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulfaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $faq = Faq::all();

      return view('admin.faq.index', [
        'folder' => 'modulfaq',
        'menu' => 'modulfaq',
        'faq' => $faq
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faq = Faq::all();

        return view('admin.faq.create', [
          'folder' => 'modulfaq',
          'menu' => 'modulfaq',
          'faq' => $faq
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
      //  $faq = Faq::all();
        $this->validate($request,[
          'tanya' => 'required',
          'jawab' => 'required'
        ]);

        $faq = Faq::create([
          'tanya' => $request->tanya,
          'jawab' => $request->jawab
        ]);

        return redirect()->route('modulfaq.index')->with('success','Faq berhasil disimpan');
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
      $faq = Faq::findorfail($id);

      return view('admin.faq.edit', [
        'folder' => 'modulfaq',
        'menu' => 'modulfaq',
        'faq' => $faq
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
        'tanya' => 'required',
        'jawab' => 'required'
      ]);

      $faq = Faq::findorfail($id);

      $faq_data = [
        'tanya' => $request->tanya,
        'jawab' => $request->jawab
      ];

      $faq->update($faq_data);

      return redirect()->route('modulfaq.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $faq = Faq::findorfail($id);
      $faq->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
