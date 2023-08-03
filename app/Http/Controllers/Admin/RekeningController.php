<?php

namespace App\Http\Controllers\Admin;

error_reporting(0);
use Illuminate\Support\Facades\DB;
use App\Dbbank;
use App\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $rekening = Rekening::all();

      return view('admin.rekening.index', [
        'folder' => 'pengaturanwebsite',
        'menu' => 'rekening',
        'rekening' => $rekening
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dbbank = Dbbank::all();

        return view('admin.rekening.create', [
          'folder' => 'pengaturanwebsite',
          'menu' => 'rekening',
          'dbbank' => $dbbank
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
      //  $rekening = Rekening::all();
        $this->validate($request,[
          'bank' => 'required',
          'rekening' => 'required',
          'atasnama' => 'required',
        ]);

        $rekening = Rekening::create([
          'bank' => $request->bank,
          'rekening' => $request->rekening,
          'atasnama' => $request->atasnama
        ]);

        return redirect()->route('rekening.index')->with('success','Rekening berhasil disimpan');
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
      $dbbank = Dbbank::all();
      $rekening = Rekening::findorfail($id);

      return view('admin.rekening.edit', [
        'folder' => 'pengaturanwebsite',
        'menu' => 'rekening',
        'rekening' => $rekening,
        'dbbank' => $dbbank
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
        'bank' => 'required',
        'rekening' => 'required',
        'atasnama' => 'required',
      ]);

      DB::table('rekening')->where('id_rekening', $id)->update([
        'bank' => $request->bank,
        'rekening' => $request->rekening,
        'atasnama' => $request->atasnama
      ]);

      return redirect()->route('rekening.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $rekening = Rekening::findorfail($id);
      $rekening->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
