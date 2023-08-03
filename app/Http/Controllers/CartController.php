<?php

namespace App\Http\Controllers;
error_reporting(0);
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProfileToko;
use App\Marketplace;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
      $no_pemesanan = Session::get('no_pemesanan');
      $marketplace = Marketplace::all();
      $profiletoko = ProfileToko::findorfail('1');
      $keranjang = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
      return view('web.pages.cart', compact('keranjang','no_pemesanan', 'marketplace',
      'profiletoko'));

    }

    public function add(Request $request)
    {
      //dd($request->all());
      //$random = mt_rand(10000000,99999999);
      //Session::put('no_pemesanan', $random);
      //Session::forget('no_pemesanan');
      //Session::flush();

      $no_pemesanan = Session::get('no_pemesanan');
      $id_produk = $request->idProduk;
      $qty = $request->qty;
      $catatan = "";
		  $size = "Size";

      $product = Product::findorfail($id_produk);
      $kode_produk = $product->kode_produk;
      $nama = $product->nama;
      $harga = $product->harga;
      $berat = $product->berat;

      //pemesanan
      $jumlahPemesanan  = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->count();
      $subtotal = $harga * $qty;

      if($jumlahPemesanan){
        $get_pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
				$get_subtotal = $get_pemesanan->subtotal;
				$get_grandtotal = $get_pemesanan->grandtotal;

				$val_subtotal = $get_subtotal + $subtotal;
				$val_grandtotal = $get_grandtotal;

        DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
          'subtotal' => $val_subtotal,
          'grandtotal' => $val_subtotal
        ]);

      }else{
          $random = mt_rand(10000000,99999999);
					$no_pemesanan = 'PYM'.$random;

          $email = Session::get('email');
          $detail_member = DB::table('member')->where('email', $email)->first();
          $kode_member = $detail_member->kode_member;

          DB::table('pemesanan')->insert([
            "no_pemesanan"=>$no_pemesanan,
            "pelanggan"=>$kode_member,
            "subtotal"=>$subtotal,
            "grandtotal"=>$subtotal,
            "status"=>0,
            "tanggal_pemesanan"=>date("Y-m-d H:i:s")
          ]);

          Session::put('no_pemesanan', $no_pemesanan);
      }
      //pemesanan

      //detail pemesanan
      $jumlahDetailPemesanan  = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->count();
				if ($jumlahDetailPemesanan) {

							$get_detailpemesanan = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->first();
							$get_qty = $get_detailpemesanan->jumlah;
							$get_total = $get_detailpemesanan->total;
							$get_berat = $get_detailpemesanan->berat;

							$berat = $get_berat + $berat;
							$jumlah = $get_qty + $qty;
							$total = $get_total + $harga;

              DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->update([
                'berat' => $berat,
								'jumlah' => $jumlah,
								'total' => $total
              ]);

              DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
								'grandtotal' => $total
              ]);

              //echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";

				}else{

					$total = $qty * $harga;

          DB::table('detailpemesanan')->insert([
            'kode_produk'  => $kode_produk,
						'berat'  => $berat,
						'catatan'      => $catatan,
						'jumlah'     	 => $qty,
						'total'   		 => $total,
						'no_pemesanan' => $no_pemesanan
          ]);

					//echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";
			}
      //detail pemesanan
    }

    public function addhome(Request $request)
    {
      //dd($request->all());

      $no_pemesanan = Session::get('no_pemesanan');
      $idproduk = $request->idproduk;
      $qty = '1';
      $catatan = "";
      $size = "Size";

      $product = Product::findorfail($idproduk);
      $kode_produk = $product->kode_produk;
      $nama = $product->nama;
      $harga = $product->harga;
      $berat = $product->berat;

      //pemesanan
      $jumlahPemesanan  = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->count();
      $subtotal = $harga * $qty;

      if($jumlahPemesanan){
        $get_pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
        $get_subtotal = $get_pemesanan->subtotal;
        $get_grandtotal = $get_pemesanan->grandtotal;

        $val_subtotal = $get_subtotal + $subtotal;
        $val_grandtotal = $get_grandtotal;

        DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
          'subtotal' => $val_subtotal,
          'grandtotal' => $val_subtotal
        ]);

      }else{
          $random = mt_rand(10000000,99999999);
          $no_pemesanan = 'PYM'.$random;

          $email = Session::get('email');
          $detail_member = DB::table('member')->where('email', $email)->first();
          $kode_member = $detail_member->kode_member;

          DB::table('pemesanan')->insert([
            "no_pemesanan"=>$no_pemesanan,
            "pelanggan"=>$kode_member,
            "subtotal"=>$subtotal,
            "grandtotal"=>$subtotal,
            "status"=>0,
            "tanggal_pemesanan"=>date("Y-m-d H:i:s")
          ]);

          Session::put('no_pemesanan', $no_pemesanan);
      }
      //pemesanan

      //detail pemesanan
      $jumlahDetailPemesanan  = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->count();
        if ($jumlahDetailPemesanan) {

              $get_detailpemesanan = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->first();
              $get_qty = $get_detailpemesanan->jumlah;
              $get_total = $get_detailpemesanan->total;
              $get_berat = $get_detailpemesanan->berat;

              $berat = $get_berat + $berat;
              $jumlah = $get_qty + $qty;
              $total = $get_total + $harga;

              DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->update([
                'berat' => $berat,
                'jumlah' => $jumlah,
                'total' => $total
              ]);

              DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
                'grandtotal' => $total
              ]);

              //echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";

        }else{

          $total = $qty * $harga;

          DB::table('detailpemesanan')->insert([
            'kode_produk'  => $kode_produk,
            'berat'  => $berat,
            'catatan'      => $catatan,
            'jumlah'     	 => $qty,
            'total'   		 => $total,
            'no_pemesanan' => $no_pemesanan
          ]);

          //echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";
      }
      //detail pemesanan
    }

  public function getcart()
	{
		//if(!$this->session->userdata('log_in')) redirect('member/login', 'refresh');
		$no_pemesanan = Session::get('no_pemesanan');
    $view = view("web.pages.cartupdate",compact('no_pemesanan'))->render();
    return response()->json(['html'=>$view]);
	}

  function update(Request $request)
	{
		// if(!$this->session->userdata('log_in')) redirect('member/login', 'refresh');
		//$kode_user=$this->session->userdata('kode_user');
		//$no_pemesanan=$this->session->userdata('no_pemesanan');

		// $kode_produk = $this->input->post('kode_produk');
		// $qty = $this->input->post('qty');

    $no_pemesanan = Session::get('no_pemesanan');
    $kode_produk = $request->kode_produk;
    $qty = $request->qty;

    $product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
    $kode_produk = $product->kode_produk;
    $nama = $product->nama;
    $harga = $product->harga;
    $berat = $product->berat;

		//$cek_detailpemesanan = $this->db->query("select * from tb_detailpemesanan where kode_produk='$kode_produk' and no_pemesanan='$no_pemesanan'")->num_rows();
    $cek_detailpemesanan  = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->count();
		if ($cek_detailpemesanan) {

			//$get_detailpemesanan = $this->db->query("select * from tb_detailpemesanan where kode_produk='$kode_produk' and no_pemesanan='$no_pemesanan'");
      $get_detailpemesanan = DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->first();
			$get_qty = $get_detailpemesanan->jumlah;
			$get_total = $get_detailpemesanan->total;
			$get_berat = $get_detailpemesanan->berat;

			$jumlah = $qty;
			$jumlah_total = $harga * $qty;
			$total = $jumlah_total;

			// $data = array(
			// 	'berat' => $get_berat+$berat,
			// 	'jumlah' => $jumlah,
			// 	'total' => $total
			// );
			// $this->db->update("tb_detailpemesanan", $data, array("kode_produk"=>$kode_produk,"no_pemesanan"=>$no_pemesanan));

      DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->update([
        'berat' => $get_berat+$berat,
				'jumlah' => $jumlah,
				'total' => $total
      ]);

				// $get_pemesanan = $this->db->query("select sum(total) as total from tb_detailpemesanan where no_pemesanan='$no_pemesanan'");
				// $get_subtotal = $get_pemesanan->row()->total;

        $get_subtotal = DB::table("detailpemesanan")->where('no_pemesanan', $no_pemesanan)->get()->sum('total');

				// $data_pemesanan = array(
				// 	'subtotal' => $get_subtotal,
				// 	'grandtotal' => $get_subtotal
				// );
				// $this->db->update("tb_pemesanan", $data_pemesanan, array("no_pemesanan"=>$no_pemesanan));

        DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
          'subtotal' => $get_subtotal,
    			'grandtotal' => $get_subtotal
        ]);

				//echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";
		}else{
			//echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";
		}

	}

  function delete(Request $request)
	{
		// if(!$this->session->userdata('log_in')) redirect('member/login', 'refresh');
		$no_pemesanan = Session::get('no_pemesanan');
		//$kode_produk = $this->uri->segment(3);
		$kode_produk = $request->kode_produk;

		//$this->db->query("delete from tb_detailpemesanan where kode_produk='$kode_produk' and no_pemesanan='$no_pemesanan'");
    DB::table('detailpemesanan')->where('kode_produk', $kode_produk)->where('no_pemesanan', $no_pemesanan)->delete();

		// $get_pemesanan = $this->db->query("select sum(total) as total from tb_detailpemesanan where no_pemesanan='$no_pemesanan'");
		// $get_subtotal = $get_pemesanan->row()->total;

    $get_subtotal = DB::table("detailpemesanan")->where('no_pemesanan', $no_pemesanan)->get()->sum('total');

		// $data_pemesanan = array(
		// 	'subtotal' => $get_subtotal,
		// 	'grandtotal' => $get_subtotal
		// );
		// $this->db->update("tb_pemesanan", $data_pemesanan, array("no_pemesanan"=>$no_pemesanan));

    DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->update([
      'subtotal' => $get_subtotal,
			'grandtotal' => $get_subtotal
    ]);

		//$jumlah_cart = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$no_pemesanan'")->num_rows();
    $jumlah_cart  = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->count();
    if($jumlah_cart){ }else{

			//$this->db->query("delete from tb_pemesanan where no_pemesanan='$no_pemesanan'");
      DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->delete();
			//$this->session->unset_userdata('no_pemesanan');
      //Session::forget('email');
      Session::forget('no_pemesanan');
		}

		//echo "<meta http-equiv='refresh' content='0; url=".base_url()."cart/'>";
	}

}
