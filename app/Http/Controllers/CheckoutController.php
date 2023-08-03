<?php

namespace App\Http\Controllers;

use App\Mail\notifikasi;
use Session;
Use PDF;
use App\ProfileToko;
use App\Marketplace;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
error_reporting(0);

class CheckoutController extends Controller
{
    public function index()
    {
      $no_pemesanan = Session::get('no_pemesanan');
      $marketplace = Marketplace::all();
      $profiletoko = ProfileToko::findorfail('1');
      $keranjang = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
      return view('web.pages.checkout', compact('keranjang','no_pemesanan', 'marketplace',
      'profiletoko'));
    }

    public function alamat($id)
    {
      $id_alamat = $id;
      $view = view("web.pages.alamat",compact('id_alamat'))->render();
      return response()->json(['html'=>$view]);
    }

    public function thankyou($invoice)
    {
      $marketplace = Marketplace::all();
      $profiletoko = ProfileToko::findorfail('1');

      $datastatus = DB::table('statuspembayaran')->where('no_invoice', $invoice)->first();
      $bank_tujuan = $datastatus->bank_tujuan;

      $datarekening = DB::table('rekening')->where('id_rekening', $bank_tujuan)->first();
      $bank = $datarekening->bank;

      $databank = DB::table('bank')->where('id_bank', $bank)->first();

      $datainvoice = DB::table('invoice')->where('no_invoice', $invoice)->first();
      $no_pemesanan = $datainvoice->no_pemesanan;

      $datapemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();

      $keranjang = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
      return view('web.pages.thankyou', compact('keranjang', 'datainvoice', 'datapemesanan', 'marketplace',
      'profiletoko', 'datarekening', 'databank'));
    }

    public function shipping($origin, $idalamat)
    {
      // $id_alamat = $id;
      // $view = view("front.shipping",compact('id_alamat'))->render();
      // return response()->json(['html'=>$view]);
      //$origin = '3';

  		//$defalamat = $this->db->query("select * from tb_alamat where id_alamat='$idalamat'");
      $defalamat = DB::table('alamat')->where('id_alamat', $idalamat)->first();
  		$destination = $defalamat->kota;

      $no_pemesanan = Session::get('no_pemesanan');
      $sumberat = DB::table("detailpemesanan")->where('no_pemesanan', $no_pemesanan)->get()->sum('berat');

  		$weight = $sumberat;

  		$curl = curl_init();

  		curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
  			// CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
  			CURLOPT_URL => "https://rajaongkir.com/api/cost",
  			CURLOPT_RETURNTRANSFER => true,
  			CURLOPT_ENCODING => "",
  			CURLOPT_MAXREDIRS => 10,
  			CURLOPT_TIMEOUT => 30,
  			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  			CURLOPT_CUSTOMREQUEST => "POST",
  			CURLOPT_POSTFIELDS => "origin=$origin&originType=city&destination=$destination&destinationType=city&weight=1000&courier=pos&courier=tiki&courier=jne",
  			CURLOPT_HTTPHEADER => array(
  				"content-type: application/x-www-form-urlencoded",
  				// "key: e5822eb434b35b2cad87953978dd713c"
  				"key: fa96acfb9e2d219f5f3af16ccbd87454"
  			),
  		));

  		$response = curl_exec($curl);
  		$err = curl_error($curl);

  		curl_close($curl);

  		if ($err) {
  			$datacost = $err;
  		} else {
  			$datacost = $response;
  		}
  		//Cost
  		//echo $response;

  		//$this->load->view("web/cost", $data);
      //dd($datacost);
      $view = view("front.shipping",compact('datacost'))->render();

      return response()->json(['html'=>$view]);
    }

    public function store(Request $request)
    {
      //dd($request->all());
      $kurir = $request->kurir;
      $paket = $request->paket;
      $biaya = $request->biaya;
      $diskon = $request->diskon;
      $subtotal = $request->subtotal;
      $total = $request->total;

      //Propinsi
  		// $curl = curl_init();
      //
  		// curl_setopt_array($curl, array(
  		// 	CURLOPT_URL => "https://pro.rajaongkir.com/api/province?id=",
  		// 	CURLOPT_RETURNTRANSFER => true,
  		// 	CURLOPT_ENCODING => "",
  		// 	CURLOPT_MAXREDIRS => 10,
  		// 	CURLOPT_TIMEOUT => 30,
  		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  		// 	CURLOPT_CUSTOMREQUEST => "GET",
  		// 	CURLOPT_HTTPHEADER => array(
  		// 		"key: e5822eb434b35b2cad87953978dd713c"
  		// 	),
  		// ));
      //
  		// $response = curl_exec($curl);
  		// $err = curl_error($curl);
      //
  		// curl_close($curl);
      //
  		// if ($err) {
  		// 	$data['datapropinsi'] = $err;
  		// } else {
  		// 	$data['datapropinsi'] = $response;
  		// }
  		//Propinsi
    }

    public function payment(Request $request)
    {
      //dd($request->all());
      date_default_timezone_set ( 'Asia/Jakarta' );

      $no_pemesanan = Session::get('no_pemesanan');
      $namapen = $request->namapen;
      $emailpen = $request->emailpen;
      $teleponpen = $request->teleponpen;
      $alamatalternatif = $request->alamatalternatif;
      $data_propinsi = $request->data_propinsi;
      $data_kota = $request->data_kota;
      $jenis_kurir = $request->jenis_kurir;
      $grand_total = $request->grand_total;
      $grand_total2 = $request->grand_total2;
      $total = $request->grand_total2;
      $banktujuan = $request->banktujuan;

      $pisahkurir = explode("-" , $jenis_kurir);
      $kurir = $pisahkurir[0];
      $paket = $pisahkurir[1];
      $biaya = $pisahkurir[2];
      //pemesanan

        DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
          'provider_ongkir' => $kurir,
          'service_ongkir' => $paket,
          'cost_ongkir' => $biaya,
          'grandtotal' => $total,
          'notifikasi' => 1
        ]);

    //pemesanan

    //invoice
        $random = mt_rand(10000000,99999999);
				$no_invoice = 'INV'.$random;

        $tanggal_sekarang = date("Y-m-d");
        $lama_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
        $jatuh_tempo      = date("Y-m-d", $lama_hari);

        DB::table('invoice')->insert([
            "no_invoice"=>$no_invoice,
            "tanggal"=>date("Y-m-d H:i:s"),
            "jatuh_tempo"=>$jatuh_tempo,
            "metode_pembayaran"=>1,
            "transidmerchant"=>"",
            "channel"=>0,
            "biaya_tambahan"=>0,
            "status"=>0,
            "no_pemesanan"=>$no_pemesanan
        ]);

    //invoice

    //$no_statuspembayaran = 'SPB'.$digit_akhir;
    $random = mt_rand(10000000,99999999);
		$no_statuspembayaran = 'SPB'.$random;

    DB::table('statuspembayaran')->insert([
        "no_statuspembayaran"=>$no_statuspembayaran,
        // "bank"=>$bank,
        // "rekening"=>$rekening,
        // "nama"=>$nama,
        "bank_tujuan"=>$banktujuan,
        "status_pembayaran"=>0,
        "no_invoice"=>$no_invoice
    ]);
    //status pembayaran

    // $no_statustransaksi = 'STR'.$digit_akhir;

    $random = mt_rand(10000000,99999999);
    $no_statustransaksi = 'STR'.$random;

    DB::table('statustransaksi')->insert([
      "no_statustransaksi"=>$no_statustransaksi,
      "respon_pesanan"=>0,
      "status_pengiriman"=>0,
      "no_resi"=>"",
      "status_ekspedisi"=>0,
      "konfirmasi_penerimaan"=>0,
      "no_statuspembayaran"=>$no_statuspembayaran
    ]);
    //status transaksi

    if($alamatalternatif){
      $alamat_alternatif = $alamat_alternatif;
    }else{
      $alamat_alternatif = '';
    }

    //pengiriman
    DB::table('pengiriman')->insert([
      "nama"=>$namapen,
      "email"=>$emailpen,
      "propinsi"=>$data_propinsi,
      "kota"=>$data_kota,
      "telepon"=>$teleponpen,
      "alamat"=>'',
      "alamat_alternatif"=>$alamat_alternatif,
      "no_statustransaksi"=>$no_statustransaksi
    ]);
    //pengiriman

    //PDF

    //data tb_profiltoko
    $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
    //data tb_profiltoko

    //alamat
    $alamatmember = DB::table('alamat')->where('id_alamat', $alamatalternatif)->first();
    //alamat

    //logo
    $logo = DB::table('logo')->where('id_logo', '1')->first();
    //logo

    // $pdf = PDF::loadView('export.userpdf', [
    //   'profiltoko' => $profiltoko,
    //   'alamatmember' => $alamatmember,
    //   'logo' => $logo,
    //   'no_invoice' => $no_invoice,
    //   'pembayaran' => 'Manual',
    //   'status' => 'Belum dibayar',
    //   'namapen' => $namapen,
    //   'emailpen' => $emailpen,
    //   'teleponpen' => $teleponpen,
    //   'jatuh_tempo' => $jatuh_tempo,
    //   'no_pemesanan' => $no_pemesanan,
    //   'kurir' => $kurir,
    //   'paket' => $paket,
    //   'biaya' => $biaya,
    //   'total' => $total,
    // ]);
    //return $pdf->download('marketplace.pdf');
    // Storage::put('invoice.pdf', $pdf->output());
    // return $pdf->download('invoice.pdf');
    // $path = public_path('invoice/');
    // $pdf->save($path.'/'.$no_invoice.'.pdf');
    //pdf

    //\Mail::to($emailpen)->send(new notifikasi($no_invoice));

    Session::forget('no_pemesanan');

    echo $no_invoice;

    }
}
