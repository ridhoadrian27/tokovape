<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModultimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $time = Time::all();

      return view('admin.time.index', [
        'folder' => 'modultime',
        'menu' => 'modultime',
        'time' => $time
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $time = Time::all();

        return view('admin.time.create', [
          'folder' => 'modultime',
          'menu' => 'modultime',
          'time' => $time
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
      //  $time = Time::all();
        $this->validate($request,[
          'waktu' => 'required',
          'konten' => 'required'
        ]);

        $time = Time::create([
          'waktu' => $request->waktu,
          'konten' => $request->konten
        ]);

        return redirect()->route('modultime.index')->with('success','Time berhasil disimpan');
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
      $time = Time::findorfail($id);

      return view('admin.time.edit', [
        'folder' => 'modultime',
        'menu' => 'modultime',
        'time' => $time
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
        'waktu' => 'required',
        'konten' => 'required'
      ]);

      $time = Time::findorfail($id);

      $time_data = [
        'waktu' => $request->waktu,
        'konten' => $request->konten
      ];

      $time->update($time_data);

      return redirect()->route('modultime.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $time = Time::findorfail($id);
      $time->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
