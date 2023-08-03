<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class ModulvideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $video = Video::all();

      return view('admin.video.index', [
        'folder' => 'modulvideo',
        'menu' => 'modulvideo',
        'video' => $video
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $video = Video::all();

        return view('admin.video.create', [
          'folder' => 'modulvideo',
          'menu' => 'modulvideo',
          'video' => $video
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
      //  $video = Video::all();
        $this->validate($request,[
          'nama' => 'required',
          'embed' => 'required'
        ]);

        $video = Video::create([
          'nama' => $request->nama,
          'embed' => $request->embed
        ]);

        return redirect()->route('modulvideo.index')->with('success','Video berhasil disimpan');
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
      $video = Video::findorfail($id);

      return view('admin.video.edit', [
        'folder' => 'modulvideo',
        'menu' => 'modulvideo',
        'video' => $video
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
        'embed' => 'required'
      ]);

      $video = Video::findorfail($id);

      $video_data = [
        'nama' => $request->nama,
        'embed' => $request->embed
      ];

      $video->update($video_data);

      return redirect()->route('modulvideo.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $video = Video::findorfail($id);
      $video->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
