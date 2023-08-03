<?php

namespace App\Http\Controllers;
error_reporting(0);
use Session;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function login()
  {
    return view('web.pages.login');
  }

  public function segmen($segmen)
  {
    $link = $segmen;
    return view('web.pages.login', compact('link'));
  }

  public function home()
  {
    $link = "home";
    return view('web.pages.login', compact('link'));
  }

  public function postlogin(Request $request)
  {
    //dd($request->all());
    if(Auth::guard('member')->attempt($request->only('email','password'))){
      Session::put('email', $request->email);

      $link = $request->link;
      if($link == ''){
        return redirect('/member/paymentstatus');
      }else if($link == 'home'){
        return redirect('/');
      }else{
        return redirect('/'.$link);
      }

    }
    return redirect('/login');
  }

  public function logout()
  {
    Session::forget('email');
    Session::forget('no_pemesanan');
    return redirect('/login');
  }
}
