<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettinguserController extends Controller
{
  public function index()
  {
    $datauser = \App\user::all();

    return view('admin.user.index', [
      'folder' => 'user',
      'menu' => 'user',
      'datauser' => $datauser
    ]);
  }

  public function add()
  {
    $datauser = \App\user::all();

    return view('admin.user.add', [
      'folder' => 'user',
      'menu' => 'user',
      'datauser' => $datauser
    ]);
  }

  public function insert(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'foto' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    DB::table('users')->insert([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>bcrypt($request->password),
        "remember_token"=>bcrypt($request->email),
    ]);

    $datauser = DB::table('users')->where('email', $request->email)->first();
    if($request->hasFile('foto')){
        $request->file('foto')->move('public/assets/user', $request->file('foto')->getClientOriginalName());
        //$datauser->foto = $request->file('foto')->getClientOriginalName();
        DB::table('users')->where('email', $request->email)->update([
          'foto' => $request->file('foto')->getClientOriginalName()
        ]);
      }
    return redirect('/settinguser')->with('sukses', 'Data berhasil diinput');
  }

  public function edit($id)
    {
      $datauser = \App\user::find($id);
      //dd($datauser);

      return view('admin.user.edit', [
        'folder' => 'user',
        'menu' => 'user',
        'datauser' => $datauser
      ]);
    }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'name' => 'required',
      'email' => 'required|email',
      'foto' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    $id = $request->id;
    $datauser = \App\user::find($id);
    $datauser->update($request->all());
    if($request->hasFile('foto')){
        $request->file('foto')->move('public/assets/user', $request->file('foto')->getClientOriginalName());
        $datauser->foto = $request->file('foto')->getClientOriginalName();
        $datauser->save();
      }
    return redirect('/settinguser')->with('sukses', 'Data berhasil diupdate');

  }

  public function changepass($id)
    {
      $datauser = \App\user::find($id);
      //dd($datauser);

      return view('admin.user.changepass', [
        'folder' => 'user',
        'menu' => 'user',
        'datauser' => $datauser
      ]);
    }

    public function updatepass(Request $request)
    {
      //dd($request->all());
      $this->validate($request,[
        'password' => 'required'
      ]);

      $id = $request->id;
      $password = bcrypt($request->password);
      $datauser = \App\user::find($id);
      $datauser->password = $password;
      $datauser->save();
      return redirect('/settinguser')->with('sukses', 'Data berhasil diupdate');

    }

    public function delete($id)
      {
        $datauser = \App\user::find($id);
        $datauser->delete();
        return redirect('/settinguser')->with('sukses', 'Data berhasil dihapus');
      }
}
