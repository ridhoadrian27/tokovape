<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\resetadmin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
      return view('auth.login');
    }

    public function postlogin(Request $request)
    {
      //dd($request->all());
      if(Auth::guard('user')->attempt($request->only('email','password'))){
        return redirect('/dashboard');
      }
      return redirect('/administrator');
    }

    public function resetadmin()
    {
      return view('auth.reset');
    }

    function cekemailadmin(Request $request){
  		//$this->load->model('My_model');
  		//$get_result = $this->My_model->check_email_availablity();
  		$email = trim($request->email);
  		$email = strtolower($email);

      $query  = DB::table('users')->where('email', $email)->count();

  		if($query > 0)
  			echo '1';
  		else
  			echo '0';
  	}

    public function resetpassadmin(Request $request)
    {
        //dd($request->all());
        $random = mt_rand(1000,9999);
        $password = 'password'.$random;

        $email = $request->email;

        DB::table('users')->where('email', $email)->update([
          'password' => bcrypt($password),
          'value' => $password
        ]);

        \Mail::to($email)->send(new resetadmin($email));

        return redirect()->route('resetsuccessadmin');
    }

    public function resetsuccessadmin()
    {
        return view('auth.resetsuccess');
    }

    public function logout()
    {
      Auth::guard('user')->logout();
      return redirect('/administrator');
    }
}
