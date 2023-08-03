<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use App\Mail\notifikasi;
use App\Mail\register;
use App\Mail\reset;
use Illuminate\Http\Request;
use App\Mail\ParfumEmail;
use Illuminate\Support\Facades\Mail;

class ParfumController extends Controller
{
  public function index(){
    $nama_depan = "Johan Wahyudi";
    $email = "inovasiwebsite@gmail.com";

    // \Mail::raw('Selamat datang Johan Wahyudi', function($message) use($email){
    //   $message->to($email, 'Johan Wahyudi');
    //   $message->subject('Inovoice tester');
    // });

    \Mail::to($email)->send(new notifikasi);

  }

  public function register(){
    $nama_depan = "Johan Wahyudi";
    $email = "inovasiwebsite@gmail.com";

    // \Mail::raw('Selamat datang Johan Wahyudi', function($message) use($email){
    //   $message->to($email, 'Johan Wahyudi');
    //   $message->subject('Inovoice tester');
    // });

    \Mail::to($email)->send(new register);

  }

  public function reset(){
    $nama_depan = "Johan Wahyudi";
    $email = "inovasiwebsite@gmail.com";

    // \Mail::raw('Selamat datang Johan Wahyudi', function($message) use($email){
    //   $message->to($email, 'Johan Wahyudi');
    //   $message->subject('Inovoice tester');
    // });

    \Mail::to($email)->send(new reset);

  }

  public function buatkolom(){

    Schema::table('jenis', function($table)
    {
        $table->string('baru');
        return "berhasil";
    });

  }
}
