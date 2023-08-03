<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
error_reporting(0);
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
  public function pesananbaru()
  {
    $data = "Halaman Pesanan Baru";

    return view('admin.pesananbaru', [
      'folder' => 'pesananbaru',
      'menu' => 'pesananbaru',
      'data' => $data
    ]);
  }

  public function responpesanan($invoice, $nostatuspembayaran)
  {
    //code
    $no_statuspembayaran = $nostatuspembayaran;

    DB::table('statuspembayaran')->where('no_invoice', $invoice)->update([
        "status_pembayaran"=>2
    ]);

    DB::table('invoice')->where('no_invoice', $invoice)->update([
        "status"=>1
    ]);

    //$detail_pemesanan=$this->db->query("select * from tb_invoice where no_invoice='$invoice'");
    $detail_pemesanan = DB::table('invoice')->where('no_invoice', $invoice)->first();
    $no_pemesanan=$detail_pemesanan->no_pemesanan;

    DB::table('statustransaksi')->where('no_statuspembayaran', $no_statuspembayaran)->update([
      "respon_pesanan"=>1,
      "status_pengiriman"=>1,
      "status_ekspedisi"=>'DELIVERED'
    ]);

    //update stok
    //$q = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$no_pemesanan'");
    // $q = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->get();
    //
    // foreach($q as $a){
    //
    //   $kode_produk = $a->kode_produk;
    //   $jumlah = $a->jumlah;
    //
    //   //$detail_product=$this->db->query("select * from tec_products where code='$kode_produk'");
    //   $detail_product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
    //   $stok=$detail_product->stok;
    //   $id=$detail_product->id;
    //
    //   $val_stok = $stok - $jumlah;
    //
    //   DB::table('produk')->where('kode_produk', $kode_produk)->update([
    //     "stok"=>$val_stok
    //   ]);
    //
    // }
    //update stok

    //pdf lunas
    // $statpembayaran=$this->db->query("select * from tb_statuspembayaran where no_invoice='$invoice'");
    // $no_statuspembayaran = $statpembayaran->row()->no_statuspembayaran;
    // $bank_tujuan = $statpembayaran->row()->bank_tujuan;
    //
    // $stattransaksi=$this->db->query("select * from tb_statustransaksi where no_statuspembayaran='$no_statuspembayaran'");
    // $no_statustransaksi = $stattransaksi->row()->no_statustransaksi;
    //
    // $pembayaran = 'Manual';
    // $id_virtual = $bank_tujuan;
    //   $query_virtual=$this->db->query("select * from tb_virtual where id_virtual='$id_virtual'");
    //   $bank=$query_virtual->row()->bank;
    //   $data['rekening_va']=$query_virtual->row()->rekening;

    //   $query_bank=$this->db->query("select * from tb_bank where id_bank='$bank'");
    //   $data['nama_bank']=$query_bank->row()->nama_bank;

    // $data['no_invoice'] = $invoice;
    // $data['tanggal'] = date("Y-m-d");
    // $data['pembayaran'] = $pembayaran;
    // $data['status'] = "Sudah Lunas";
    // $data['listorder'] = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$no_pemesanan'");
    //
    // $detpemesanan=$this->db->query("select * from tb_pemesanan where no_pemesanan='$no_pemesanan'");
    // $data['subtotal']=$detpemesanan->row()->subtotal;
    // $data['diskon']=$detpemesanan->row()->diskon;
    // $data['grandtotal']=$detpemesanan->row()->grandtotal;
    //
    // $detpengiriman=$this->db->query("select * from tb_pengiriman where no_statustransaksi='$no_statustransaksi'");
    // $data['nama_penerima'] = $detpengiriman->row()->nama;
    // $data['email_penerima'] = $detpengiriman->row()->email;
    // $data['telepon_penerima'] = $detpengiriman->row()->telepon;
    // $data['alamat_penerima'] = $detpengiriman->row()->alamat;
    // $data['alamat_alternatif'] = $detpengiriman->row()->alamat_alternatif;
    //
    // $file_invoice = "invoice_".$invoice;
    // $this->load->library('pdfgenerator');
    // $html = $this->load->view('web/pdflunas', $data, true);
    //
    // $this->pdfgenerator->printpdf($html, $file_invoice);
    //pdf lunas
    //code
  }

  public function viewtrack($resi)
  {
    $noresi = $resi;
    return view('admin.viewtrack', compact('noresi'));
  }

  public function responbatal($invoice)
  {
    // code
    DB::table('statuspembayaran')->where('no_invoice', $invoice)->update([
      "status_pembayaran"=>4
    ]);
    //code
  }

  public function statuspengiriman()
  {
    $data = "Halaman Status Pengiriman";

    return view('admin.statuspengiriman', [
      'folder' => 'statuspengiriman',
      'menu' => 'statuspengiriman',
      'data' => $data
    ]);
  }

  public function updateresi($nostatustransaksi, $noresi)
  {
    //code
    date_default_timezone_set ( 'Asia/Jakarta' );

			$no_statustransaksi = $nostatustransaksi;
			$resi = $noresi;

      DB::table('statustransaksi')->where('no_statustransaksi', $no_statustransaksi)->update([
        "no_resi"=>$resi
      ]);
    //code
  }

  public function updatepengiriman($nostatustransaksi, $status)
  {
    //code
			$no_statustransaksi = $nostatustransaksi;

      DB::table('statustransaksi')->where('no_statustransaksi', $no_statustransaksi)->update([
        "status_pengiriman"=>$status
      ]);
    //code
  }

  public function daftartransaksi()
  {
    $data = "Halaman Daftar Transaksi";

    return view('admin.daftartransaksi', [
      'folder' => 'daftartransaksi',
      'menu' => 'daftartransaksi',
      'data' => $data
    ]);
  }

}
