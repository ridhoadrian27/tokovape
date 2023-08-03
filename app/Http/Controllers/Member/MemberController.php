<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
error_reporting(0);
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
      $data = "Halaman Dashboard";
      return view('member.dashboard', compact('data'));
    }

    public function paymentstatus()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.paymentstatus', compact('data'));
    }

    public function updatebukti(Request $request)
    {
      //dd($request->all());
      // $this->validate($request,[
      //   'bank' => 'required',
      //   'rekening' => 'required',
      //   'atasnama' => 'required',
      // ]);

      $bank = $request->bank;
      $rekening = $request->rekening;
      $atasnama = $request->atasnama;
      $uploadbukti = $request->uploadbukti;
      $gambar = $request->gambar;
      $ambil_upload = str_replace(' ','_',$gambar);
      $new_gambar = time().$ambil_upload;
      $no_invoice = $request->no_invoice;

      DB::table('statuspembayaran')->where('no_invoice', $no_invoice)->update([
        "bukti"=>$new_gambar,
        "bank"=>$bank,
        "rekening"=>$rekening,
        "nama"=>$atasnama,
        "status_pembayaran"=>1
      ]);

      $uploadbukti->move('assets/bukti/', $new_gambar);
      echo "1";

      //return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function confirmation()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.confirmation', compact('data'));
    }

    public function viewtrack($resi)
    {
      $noresi = $resi;
      return view('member.viewtrack', compact('noresi'));
    }

    public function updatepenerimaan(Request $request)
    {
      //dd($request->all());
      $invoice = $request->invoice;
      $get_status = DB::table('statuspembayaran')->where('no_invoice', $invoice)->first();
      $no_statuspembayaran = $get_status->no_statuspembayaran;
			// $detail_statuspembayaran=$this->db->query("select * from tb_statuspembayaran where no_invoice='$invoice'");
			// $no_statuspembayaran=$detail_statuspembayaran->row()->no_statuspembayaran;

      DB::table('statustransaksi')->where('no_statuspembayaran', $no_statuspembayaran)->update([
        "konfirmasi_penerimaan"=>1
      ]);

      DB::table('invoice')->where('no_invoice', $invoice)->update([
        "status"=>1
      ]);

      $getpemesanan = DB::table('invoice')->where('no_invoice', $invoice)->first();
      $no_pemesanan = $getpemesanan->no_pemesanan;

      //$q = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$no_pemesanan'");
      $q = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
			foreach($q as $a)
			{
				$kode_produk = $a->kode_produk;
				$jumlah = $a->jumlah;

				//$detail_product=$this->db->query("select * from tec_products where code='$kode_produk'");
        $detail_product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
				$stok=$detail_product->stok;
				$id=$detail_product->id;

				$val_stok = $stok - $jumlah;
        DB::table('produk')->where('kode_produk', $kode_produk)->update([
          'stok' => $val_stok
        ]);
			}

      echo "1";

    }

    public function transactionlist()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.transactionlist', compact('data'));
    }

    public function alamat()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.alamat', compact('data'));
    }

    public function profile()
    {
      $email = Session::get('email');
      $get_member = DB::table('member')->where('email', $email)->first();
			$kode_member = $get_member->kode_member;
      $member = DB::table('member')->where('kode_member', $kode_member)->first();

      return view('member.profile', compact('member'));
    }

    // function cekpassword(Request $request){
  	// 	//$this->load->model('My_model');
  	// 	//$get_result = $this->My_model->check_email_availablity();
  	// 	$passwordlama = trim($request->passwordlama);
  	// 	$passwordlama = strtolower($passwordlama);
    //
    //   $query  = DB::table('member')->where('password', $passwordlama)->count();
    //
  	// 	if($query > 0)
  	// 		echo '1';
  	// 	else
  	// 		echo '0';
  	// }

    public function updateprofile(Request $request)
    {
      $this->validate($request,[
        'name' => 'required',
        'email' => 'required',
        'telepon' => 'required'
      ]);

      $email = Session::get('email');
      $get_member = DB::table('member')->where('email', $email)->first();
			$kode_member = $get_member->kode_member;

      DB::table('member')->where('kode_member', $kode_member)->update([
        'name' => $request->name,
        'email' => $request->email,
        'telepon' => $request->telepon
        ]);

      return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function changepass()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.changepass', compact('data'));
    }

    public function updatepass(Request $request)
    {
      // $this->validate($request,[
      //   'name' => 'required'
      // ]);

      $email = Session::get('email');
      $get_member = DB::table('member')->where('email', $email)->first();
			$kode_member = $get_member->kode_member;

      DB::table('member')->where('kode_member', $kode_member)->update([
        'password' => bcrypt($request->passwordbaru)
        ]);

      return redirect()->back()->with('success', 'Data berhasil diupdate');
    }

    public function addalamat(Request $request)
    {
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
    }

    public function logout()
    {
      $data = "Halaman Status Pemesanan";
      return view('member.logout', compact('data'));
    }
}
