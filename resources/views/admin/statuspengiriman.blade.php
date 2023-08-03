@extends('layouts.admin.layout')
@section('header', 'Status Pengiriman')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            {{-- <h3 class="card-title">DataTable with default features</h3> --}}
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session('success') }}
              </div>
            @endif

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Invoice</th>
                  <th>Pelanggan</th>
                  <th>Produk</th>
                  <th>Total</th>
                  <th>No. Resi</th>
                  <th>Status Pengiriman</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $datapemesanan  = DB::table('pemesanan')
                ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                ->where('statuspembayaran.status_pembayaran', '=', '2')
                ->where('statustransaksi.respon_pesanan', '=', '1')
                ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
                ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal', 'statustransaksi.no_statustransaksi', 'statustransaksi.no_resi', 'statustransaksi.status_pengiriman')
                ->get();
                ?>
                <?php $no='1'; ?>
                @foreach($datapemesanan as $row)
                    <tr>
                      <td><?php echo $no;?></td>
                      <td><b><a href="{{ URL::to('/invoicepdf/'.$row->no_pemesanan.'/'.$row->no_invoice) }}" target="_blank">
                        <?php echo $row->no_invoice; ?></a></b></td>
                      <td>
                        <?php
                        $kode_member = $row->pelanggan;
                        $pelanggan = DB::table('member')->where('kode_member', $kode_member)->first();
                        $nama = $pelanggan->name;
                        echo $nama;
                        ?>
                      </td>
                      <td>
                        <?php
                        echo "Produk :<br>";
                        //$detil_pemesanan = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$row->no_pemesanan'");
                        $detil_pemesanan = DB::table('detailpemesanan')->where('no_pemesanan', $row->no_pemesanan)->get();
                        foreach($detil_pemesanan as $d)
                        {
                          //$detail_produk=$this->db->query("select * from tec_products where code='$d->kode_produk'");
                          $detail_produk = DB::table('produk')->where('kode_produk', $d->kode_produk)->first();
                          $nama_produk = $detail_produk->nama;
                          $kategori = $detail_produk->kategoriproduk_id;

                          //$detail_kategori=$this->db->query("select * from tec_categories where id='$kategori'");
                          $detail_kategori = DB::table('kategoriproduk')->where('id', $kategori)->first();
                          $kategoriproduk = $detail_kategori->nama;

                          $catatan = $d->catatan;
                          if($catatan){
                            ?>
                            <b><?php echo $nama_produk." (".$catatan.") ";?></b>
                            <?php }else{ ?>
                              <b><?php echo $nama_produk;?></b>
                              <?php } ?>
                              <br>
                              <?php } ?>
                            </td>
                            <td>Rp <?php echo number_format($row->grandtotal); ?></td>
                            <td>
                              <?php
                              $no_resi = $row->no_resi;
                              if($no_resi){
                                $deskripsi = "Lihat resi";
                              }else{
                                $deskripsi = "Belum ada";
                              }
                            ?>
                              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#updateresi<?php echo $row->no_invoice;?>"><?php echo $deskripsi;?></button>

                            <?php
                              if($no_resi){
                            ?>
                              <div style="margin-top: 10px;"></div>
                              <a href='/order/viewtrack/<?php echo $no_resi;?>' target="_blank" class="btn btn-sm btn-success">Lacak</a>
                            <?php }else{} ?>
                            </td>
                            <td>
                              <select name="status_info" id="status_info<?php echo $row->no_statustransaksi;?>" class="form-control">
                                <?php
                                $status_pengiriman = $row->status_pengiriman;
                                if($status_pengiriman=='3'){
                                ?>
                                  <option value="0">Belum ada status</option>
                                  <option value="3" selected>Proses packing</option>
                                  <option value="4">Sedang pengiriman</option>
                                <?php }else if($status_pengiriman=='4'){ ?>
                                  <option value="0">Belum ada status</option>
                                  <option value="3">Proses packing</option>
                                  <option value="4" selected>Sedang pengiriman</option>
                                <?php }else{ ?>
                                  <option value="0" selected>Belum ada status</option>
                                  <option value="3">Proses packing</option>
                                  <option value="4">Sedang pengiriman</option>
                                <?php } ?>
                              </select>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?php echo $row->no_invoice;?>">Lihat Detail</button>
                            </td>
                          </tr>
                          <?php $no++;?>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>

<!-- modal detail -->
<?php

// $invoice = $this->db->query("SELECT * FROM tb_pemesanan, tb_invoice, tb_statuspembayaran, tb_statustransaksi
// where tb_pemesanan.no_pemesanan=tb_invoice.no_pemesanan
// and tb_invoice.no_invoice=tb_statuspembayaran.no_invoice
// and tb_statuspembayaran.no_statuspembayaran=tb_statustransaksi.no_statuspembayaran
// and tb_statustransaksi.respon_pesanan='0' ");

$invoice = DB::table('pemesanan')
->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
->where('statuspembayaran.status_pembayaran', '=', '2')
->where('statustransaksi.respon_pesanan', '=', '1')
->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal', 'statustransaksi.no_statustransaksi', 'statustransaksi.no_resi', 'statustransaksi.status_pengiriman')
->get();
?>
@foreach($invoice as $i)
  <div class="modal fade" id="detail<?php echo $i->no_invoice;?>" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Invoice</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <!-- konten ============================================================================-->

          <?php
          // $invoice = $this->db->query("SELECT * FROM tb_pemesanan, tb_invoice, tb_statuspembayaran, tb_statustransaksi
          //   where tb_pemesanan.no_pemesanan=tb_invoice.no_pemesanan
          //   and tb_invoice.no_invoice=tb_statuspembayaran.no_invoice
          //   and tb_statuspembayaran.no_statuspembayaran=tb_statustransaksi.no_statuspembayaran
          //   and tb_statustransaksi.respon_pesanan='0'
          //   and tb_invoice.no_invoice='$i->no_invoice' order by tb_invoice.no_invoice desc");

          $psn = DB::table('pemesanan')
          ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
          ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
          ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
          ->where('statuspembayaran.status_pembayaran', '=', '2')
          ->where('statustransaksi.respon_pesanan', '=', '1')
          ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
          ->where('invoice.no_invoice', '=', $i->no_invoice)
          ->select('pemesanan.pelanggan', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'invoice.metode_pembayaran', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
          ->first();

          ?>
          <table class="table table-bordered">

            <tr>
                <?php
                  $pelanggan = DB::table('member')->where('kode_member', $psn->pelanggan)->first();
                  $nama=$pelanggan->nama;
                  $foto=$pelanggan->foto;
                ?>
                <td width="10%" rowspan="3">
                    <?php
                          if($foto){
                    ?>
                    <img class="img-responsive" alt="offer banner" src="{{asset('assets/member/'.$foto)}}" style="text-align: center; display: inline; max-height: 120px;">
                    <?php }else{ ?>
                      <img class="img-responsive" alt="offer banner" src="{{asset('assets/member/noimage.png')}}" style="text-align: center; display: inline; max-height: 120px;">
                    <?php } ?>
                </td>
                <td width="60%">
                    Pembelian oleh : <b><?php echo strtoupper($nama);?></b> <br> No. Invoice : <b><?php echo strtoupper($i->no_invoice);?></b>
                    <br>
                     <?php
                         //$detil_pemesanan = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$i->no_pemesanan'");
                         $detil_pemesanan = DB::table('detailpemesanan')->where('no_pemesanan', $i->no_pemesanan)->get();
                          foreach($detil_pemesanan as $d)
                          {
                            //$detail_produk=$this->db->query("select * from tec_products where code='$d->kode_produk'");
                            $detail_produk=DB::table('produk')->where('kode_produk', $d->kode_produk)->first();
                            $nama_produk=$detail_produk->nama;
                            $kategori=$detail_produk->kategoriproduk_id;

                            //$detail_kategori=$this->db->query("select * from tec_categories where id='$kategori'");
                            $detail_kategori=DB::table('kategoriproduk')->where('id', $kategori)->first();
                            $kategoriproduk=$detail_kategori->nama;
                     ?>
                     Produk : <b><?php echo $nama_produk." (".$kategoriproduk.") ";?></b>
                     <br>
                     <?php } ?>
                    <b>Total : Rp. <?php echo $i->grandtotal;?></b>
                </td>
                <td colspan="2">
                  Payment :<br>
                  <?php
                    $metode_pembayaran = $psn->metode_pembayaran;
                    if($metode_pembayaran=='1'){
                      echo "[ Manual Transfer ]";
                      echo "<br><br>";
                      echo "Bukti Pembayaran : <br>";
                      //$detail_statuspembayaran=$this->db->query("select * from tb_statuspembayaran where no_invoice='$i->no_invoice'");
                      $detail_statuspembayaran = DB::table('statuspembayaran')->where('no_invoice', $i->no_invoice)->first();
                      $bukti=$detail_statuspembayaran->bukti;

                      if($bukti){
                    ?>
                      <a href="{{asset('assets/bukti/'.$bukti)}}" target="_blank"><img style="width:100px;" src="{{asset('assets/bukti/'.$bukti)}}"></a>
                    <?php
                      }else{}

                    }else{
                      echo "[Payment Gateway] <br>";
                      $datainvoice = DB::table('invoice')->where('no_invoice', $i->no_invoice)->first();

                      if($datainvoice->channel=='VC'){
                        echo "Credit Card";
                      }else if($datainvoice->channel=='VA'){
                        echo "BII Maybank";
                      }else if($datainvoice->channel=='BT'){
                        echo "Permata Bank";
                      }else if($datainvoice->channel=='B1'){
                        echo "Cimb Niaga";
                      }else if($datainvoice->channel=='A1'){
                        echo "ATM Bersama";
                      }else if($datainvoice->channel=='I1'){
                        echo "BNI";
                      }else if($datainvoice->channel=='BK'){
                        echo "BCA KlikPay";
                      }else{
                        echo "Retail";
                      }

                      echo "<br>";

                      $dataduitku = DB::table('duitku')->where('no_invoice', $i->no_invoice)->first();
                      $cekstatus = $dataduitku->trxstatus;

                      if($cekstatus=='SUCCESS'){
                        echo "Success";
                      }else{
                        echo "Pending/Failed";
                      }

                    }
                  ?>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                   Tanggal Transaksi : &nbsp; <?php echo $i->tanggal;?> &nbsp; | &nbsp; Jatuh Tempo : <?php echo $i->jatuh_tempo;?>
                </td>
            </tr>
            <tr>
                <td width="10%" colspan="3">
                    Status :
                    <?php
                        $konfirmasi = $row->status_pembayaran;

                        if($konfirmasi==0){
                            echo "Menunggu Pembayaran";
                        }else if($konfirmasi==1){
                            echo "Proses";
                        }else if($konfirmasi==3){
                            echo "Dibatalkan Pembeli";
                        }else if($konfirmasi==4){
                            echo "Dibatalkan Penjual";
                        }else{
                            echo "Pembayaran Diterima";
                        }
                    ?>

                </td>
            </tr>
        </table>


                          <!-- konten ============================================================================-->

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        </div>
                      </div>

                    </div>
                  </div>

                @endforeach
                <!-- modal detail -->

                <!-- modal resi -->
                <?php
                    // $invoice = $this->db->query("SELECT * FROM tb_pemesanan, tb_invoice, tb_statuspembayaran, tb_statustransaksi, tb_member where tb_pemesanan.pelanggan=tb_member.kode_member and tb_pemesanan.no_pemesanan=tb_invoice.no_pemesanan and tb_invoice.no_invoice=tb_statuspembayaran.no_invoice and tb_statuspembayaran.no_statuspembayaran=tb_statustransaksi.no_statuspembayaran and tb_statuspembayaran.status_pembayaran='2' and tb_statustransaksi.respon_pesanan='1' and tb_statustransaksi.konfirmasi_penerimaan='0'");
                    $invoice = DB::table('pemesanan')
                    ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                    ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                    ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                    ->where('statuspembayaran.status_pembayaran', '=', '2')
                    ->where('statustransaksi.respon_pesanan', '=', '1')
                    ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
                    ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal', 'statustransaksi.no_statustransaksi', 'statustransaksi.no_resi', 'statustransaksi.status_pengiriman')
                    ->get();
                     foreach($invoice as $i)
                     {
                ?>
                <div class="modal fade" id="updatepengiriman<?php echo $i->no_invoice;?>" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Konfirmasi Pengiriman Invoice <?php echo $i->no_invoice;?></h4>
                        </div>
                        <div class="modal-body">
                          <p>Apakah Anda yakin mengirim nomor Resi ini?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <button type="button" class="btn btn-info" id="konfirmasipengiriman<?php echo $i->no_invoice;?>">Ya</button>
                        </div>
                      </div>

                    </div>
                  </div>

                  <div class="modal fade" id="updateresi<?php echo $i->no_invoice;?>" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Update Nomor Resi</h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <form name="form_upload<?php echo $i->no_invoice;?>" id="form_upload<?php echo $i->no_invoice;?>">
                          <div class="form-group">
                            <label class="control-label">Masukan Resi <span class="required">
                            * </span>
                            </label>
                            <textarea class="col-md-10 form-control" rows="5" id="resi<?php echo $i->no_invoice;?>" name="resi"><?php echo $i->no_resi;?></textarea>
                            <input type="text" name="no_statustransaksi" id="no_statustransaksi<?php echo $i->no_invoice;?>" value="<?php echo $i->no_statustransaksi;?>" hidden/>
                          </div>

                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          <button type="button" class="btn btn-info" id="konfirmasiresi<?php echo $i->no_invoice;?>">Submit</button>
                        </div>
                      </div>

                    </div>
                  </div>

                <script type="text/javascript">

                      $(document).ready(function() {

                        $("#konfirmasiresi<?php echo $i->no_invoice;?>").click(function(){

                        var no_statustransaksi = $("#no_statustransaksi<?php echo $i->no_invoice;?>").val();
                        var resi = $("#resi<?php echo $i->no_invoice;?>").val();

                        if(resi==0){
                        alert('Maaf, resi tidak boleh kosong');
                        $("#resi<?php echo $i->no_invoice;?>").focus();
                        return false();
                        }

                        $.ajax({
                                type: "GET",
                                url : "/order/updateresi/"+no_statustransaksi+"/"+resi,
                                beforeSend: function() {
                                    $.LoadingOverlay("show");
                                },
                                success: function(msg){
                                    location.reload();
                                }
                        });

                        //batas

                        });

                    });

                    </script>
                <?php } ?>
                <!-- modal resi -->

                <script type="text/javascript">

                   $(document).ready(function() {
                    //alert('test');
                    <?php

                    $invoice = DB::table('pemesanan')
                    ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                    ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                    ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                    ->where('statuspembayaran.status_pembayaran', '=', '2')
                    ->where('statustransaksi.respon_pesanan', '=', '1')
                    ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
                    ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal', 'statustransaksi.no_statustransaksi', 'statustransaksi.no_resi', 'statustransaksi.status_pengiriman')
                    ->get();

                         foreach($invoice as $i)
                         {

                    ?>

                    $("#konfirmasipengiriman<?php echo $i->no_invoice;?>").click(function(){
                          var invoice = '<?php echo $i->no_invoice;?>';
                          var resi = $("#resi<?php echo $i->no_invoice;?>").val();
                          if(resi==0){
                          alert('Maaf, Resi tidak boleh kosong');
                          $("#updatepengiriman<?php echo $i->no_invoice;?>").modal('hide');
                          return false();
                          }
                          //alert(invoice);
                          $.ajax({
                                  type: "GET",
                                  url : "/order/updateresi/"+invoice+"/"+resi,
                                  beforeSend: function() {
                                      $.LoadingOverlay("show");
                                  },
                                  success: function(msg){
                                      location.reload();
                                  }
                          });

                      });

                      $("#status_info<?php echo $i->no_statustransaksi;?>").change(function(){

                      var no_statustransaksi = '<?php echo $i->no_statustransaksi;?>';
                      var status = $("#status_info<?php echo $i->no_statustransaksi;?>").val();

                      var pilih = confirm('Update status pengiriman?');

                      if (pilih==true) {

                        $.ajax({
                          type: "GET",
                          url : "/order/updatepengiriman/"+no_statustransaksi+"/"+status,
                          beforeSend: function() {
                            // setting a timeout
                            $.LoadingOverlay("show");
                          },
                          success: function(msg){
                            location.reload();
                          }
                        });

                     }


                    });




                    <?php } ?>

                 });

                </script>


                <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
                <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
                <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
                <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
                <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
                <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
                <script>
                  $(function () {
                    $("#example1").DataTable({
                      "responsive": true,
                      "autoWidth": false,
                    });
                    $('#example2').DataTable({
                      "paging": true,
                      "lengthChange": false,
                      "searching": false,
                      "ordering": true,
                      "info": true,
                      "autoWidth": false,
                      "responsive": true,
                    });
                  });
                </script>

@endsection
