<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
error_reporting(0);
use Session;
use App\Alamat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $email = Session::get('email');
      $get_member = DB::table('member')->where('email', $email)->first();
			$kode_member = $get_member->kode_member;
      $alamat = DB::table('alamat')->where('kode_member', $kode_member)->get();
      return view('member.alamat.index', compact('alamat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
      //Propinsi

      return view('member.alamat.create', compact('datapropinsi'));
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

      $view = view("member.alamat.kota",compact('datakota'))->render();

      return response()->json(['html'=>$view]);
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
        $email = Session::get('email');
        $get_member = DB::table('member')->where('email', $email)->first();
  			$kode_member = $get_member->kode_member;

        $this->validate($request,[
          'data_propinsi' => 'required',
          'data_kota' => 'required',
          'nama_alamat' => 'required',
          'detail' => 'required',
        ]);

        $alamat = Alamat::create([
          'nama_alamat' => $request->nama_alamat,
          'detail' => $request->detail,
          'propinsi' => $request->data_propinsi,
          'kota' => $request->data_kota,
          'kode_member' => $kode_member,
        ]);
        //return redirect()->back()->with('success','Data berhasil disimpan');
        return redirect()->route('alamat.index')->with('success', 'Data berhasil disimpan');
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
      $alamat = Alamat::findorfail($id);

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

      return view('member.alamat.edit', compact('alamat', 'datapropinsi'));
    }

    public function getkota($propinsi, $idalamat)
    {
      $propinsi = $propinsi;
      $idalamat = $idalamat;

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

      $view = view("member.alamat.getkota",compact('datakota', 'idalamat'))->render();

      return response()->json(['html'=>$view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_alamat)
    {
      $this->validate($request,[
        'data_propinsi' => 'required',
        'data_kota' => 'required',
        'nama_alamat' => 'required',
        'detail' => 'required',
      ]);

      // $alamat = Alamat::create([
      //   'nama_alamat' => $request->nama_alamat,
      //   'detail' => $request->detail,
      //   'propinsi' => $request->data_propinsi,
      //   'kota' => $request->data_kota,
      //   'kode_member' => 'M100012',
      // ]);

      DB::table('alamat')->where('id_alamat', $id_alamat)->update([
        'nama_alamat' => $request->nama_alamat,
        'detail' => $request->detail,
        'propinsi' => $request->data_propinsi,
        'kota' => $request->data_kota
        ]);

      //Alamat::whereId($id_alamat)->update($alamat);
      return redirect()->route('alamat.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      // $alamat = Alamat::findorfail($id);
      // $alamat->delete();

      DB::table('alamat')->where('id_alamat', $id)->delete();

      return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
