<?php

namespace App\Http\Controllers\Admin;
error_reporting(0);
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
  public function index()
  {
      $id = 1;
      $settingwebsite = \App\ProfileToko::find($id);

      //Propinsi
          $curl = curl_init();

          curl_setopt_array($curl, array(
              // CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=",
              CURLOPT_URL => "https://rajaongkir.com/api/province?id=",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
              CURLOPT_HTTPHEADER => array(
                  // "key: e5822eb434b35b2cad87953978dd713c"
                  "key: fa96acfb9e2d219f5f3af16ccbd87454"
              ),
          ));

          $response = curl_exec($curl);
          $err = curl_error($curl);

          curl_close($curl);

          if ($err) {
              $datapropinsi = $err;
          } else {
              $datapropinsi = $response;
          }
          //$datapropinsi = json_decode($datapropinsi);
      //Propinsi

      return view('admin.profile.index', [
        'folder' => 'pengaturanwebsite',
        'menu' => 'profile',
        'settingwebsite' => $settingwebsite,
        'datapropinsi' => $datapropinsi
      ]);
  }

  public function kota($id)
  {
    $propinsi = $id;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      // CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=&province=$propinsi",
      CURLOPT_URL => "https://rajaongkir.com/api/city?id=&province=$propinsi",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        // "key: e5822eb434b35b2cad87953978dd713c"
        "key: fa96acfb9e2d219f5f3af16ccbd87454"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $datakota = $err;
    } else {
      $datakota = $response;
    }

    $view = view("admin.profile.kota",compact('datakota'))->render();

    return response()->json(['html'=>$view]);
  }

  public function kotabaru($id)
  {
    $propinsi = $id;

    $curl = curl_init();

    curl_setopt_array($curl, array(
      // CURLOPT_URL => "https://pro.rajaongkir.com/api/city?id=&province=$propinsi",
      CURLOPT_URL => "https://rajaongkir.com/api/city?id=&province=$propinsi",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        // "key: e5822eb434b35b2cad87953978dd713c"
        "key: fa96acfb9e2d219f5f3af16ccbd87454"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
      $datakota = $err;
    } else {
      $datakota = $response;
    }

    $view = view("admin.profile.kotabaru",compact('datakota'))->render();

    return response()->json(['html'=>$view]);
  }

  public function update(Request $request)
  {
    //dd($request->all());
    $this->validate($request,[
      'nama' => 'required',
      'profile' => 'required',
      'email' => 'required|email',
      'alamat' => 'required',
      'propinsi' => 'required',
      'kota' => 'required',
      'telepon' => 'required',
      'handphone' => 'required',
      'whatsapp' => 'required',
      'maps' => 'required',
      //'foto' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
    ]);

    $id = '1';
    $settingwebsite = \App\ProfileToko::find($id);
    $settingwebsite->update($request->all());

    return redirect('/profile')->with('sukses', 'Data berhasil diupdate');
  }
}
