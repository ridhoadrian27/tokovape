<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Why;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulwhyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $why = Why::all();

      return view('admin.why.index', [
        'folder' => 'modulwhy',
        'menu' => 'modulwhy',
        'why' => $why
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $why = Why::all();

        return view('admin.why.create', [
          'folder' => 'modulwhy',
          'menu' => 'modulwhy',
          'why' => $why
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
      //  $why = Why::all();
        $this->validate($request,[
          'title' => 'required',
          'detail' => 'required'
        ]);

        $why = Why::create([
          'title' => $request->title,
          'detail' => $request->detail
        ]);

        return redirect()->route('modulwhy.index')->with('success','Why berhasil disimpan');
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
      $why = Why::findorfail($id);

      return view('admin.why.edit', [
        'folder' => 'modulwhy',
        'menu' => 'modulwhy',
        'why' => $why
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

      $why = Why::findorfail($id);

      $why_data = [
        'title' => $request->title,
        'detail' => $request->detail
      ];

      $why->update($why_data);

      return redirect()->route('modulwhy.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $why = Why::findorfail($id);
      $why->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
