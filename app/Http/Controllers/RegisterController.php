<?php

namespace App\Http\Controllers;
error_reporting(0);
use App\Mail\mailregister;
use App\Mail\reset;
use App\Register;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
  public function index()
  {
    return view('web.pages.registrasi');
  }

  public function reset()
  {
    return view('web.pages.reset');
  }

  function cekemail(Request $request){
		//$this->load->model('My_model');
		//$get_result = $this->My_model->check_email_availablity();
		$email = trim($request->email);
		$email = strtolower($email);

    $query  = DB::table('member')->where('email', $email)->count();

		if($query > 0)
			echo '1';
		else
			echo '0';
	}

  public function insert(Request $request)
  {
      //dd($request->all());
      $random = mt_rand(10000000,99999999);
      $kode_member = 'M'.$random;
      $register = Register::create([
        'kode_member' => $kode_member,
        'name' => $request->name,
        'email' => $request->email,
        'telepon' => $request->telepon,
        'password' => bcrypt($request->password),
        'value' => $request->password,
        'remember_token' => Str::random(60)
      ]);

      $nama_depan = $request->name;
      $email = $request->email;

      //\Mail::to($email)->send(new mailregister($email));

      return redirect()->route('registersuccess');
  }

  public function resetpass(Request $request)
  {
      //dd($request->all());
      $random = mt_rand(1000,9999);
      $password = 'password'.$random;

      $email = $request->email;

      DB::table('member')->where('email', $email)->update([
        'password' => bcrypt($password),
        'value' => $password
      ]);

      //\Mail::to($email)->send(new reset($email));

      return redirect()->route('resetsuccess');
  }

  public function success()
  {
      return view('web.pages.success');
  }

  public function resetsuccess()
  {
      return view('web.pages.resetsuccess');
  }
}
