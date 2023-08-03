<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use App\Dbbank;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $bank = Dbbank::all();

      return view('admin.bank.index', [
        'folder' => 'pengaturanproduk',
        'menu' => 'bank',
        'bank' => $bank
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.bank.create', [
          'folder' => 'pengaturanproduk',
          'menu' => 'bank'
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
          'nama' => 'required',
          'gambar' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();

        $bank = Dbbank::create([
          'nama_bank' => $request->nama,
          'gambar' => $new_gambar
        ]);

        $gambar->move('assets/bank/', $new_gambar);
        //return redirect()->back()->with('success','Data berhasil disimpan');
        return redirect()->route('bank.index')->with('success', 'Data berhasil disimpan');
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
      $bank = Dbbank::findorfail($id);

      return view('admin.bank.edit', [
        'folder' => 'pengaturanproduk',
        'menu' => 'bank',
        'bank' => $bank
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
      ]);

      if($request->has('gambar')){
        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientOriginalName();
        $gambar->move('assets/bank/', $new_gambar);
      }else{
        $new_gambar = $request->gambar_lama;
      }

      DB::table('bank')->where('id_bank', $id)->update([
        'nama_bank' => $request->nama,
        'gambar' => $new_gambar
      ]);

      return redirect()->route('bank.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $bank = Dbbank::findorfail($id);
      $bank->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
