@extends('layouts.admin.layout')
@section('header', 'Pesanan Baru')

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
                  <th>Payment</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $datapemesanan  = DB::table('pemesanan')
                ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                ->where('statustransaksi.respon_pesanan', '=', '0')
                ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
                ->orderby('pemesanan.id','desc')
                ->get();
                ?>
                <?php $no='1'; ?>
                @foreach($datapemesanan as $row)
                  <?php
                  $konfirmasi = $row->status_pembayaran;
                  $tanggal = strtotime($row->tanggal);
                  $tempo = strtotime($row->jatuh_tempo);
                  $sekarang = strtotime(date('Y-m-d'));
                  $beda = $tempo-$sekarang;
                  $bedahari = ($beda/24/60/60);

                  if($beda < 0){

                  }else{
                    ?>
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
                            <b><?php echo $nama_produk;?></b>
                            <?php }else{ ?>
                              <b><?php echo $nama_produk;?></b>
                              <?php } ?>
                              <br>
                              <?php } ?>
                            </td>
                            <td>Rp <?php echo number_format($row->grandtotal); ?></td>
                            <td>
                              <?php echo "[ Manual Transfer ]"; ?>
                            </td>
                            <td>
                              <?php
                              $konfirmasi2 = $row->status_pembayaran;
                              $tanggal2 = strtotime($row->tanggal);
                              $tempo2 = strtotime($row->jatuh_tempo);
                              $sekarang2 = strtotime(date('Y-m-d'));
                              $beda2 = $tempo-$sekarang;
                              $bedahari2 = ($beda/24/60/60);

                              if($beda2>0){
                                echo "<span style='padding:5px;color:green;'>Jatuh tempo ".$bedahari2." hari lagi</span>";
                              }else if($beda2==0){
                                echo "<span style='padding:5px;color:orange;'>Jatuh tempo hari ini</span>";
                              }else{
                                echo "<span style='padding:5px;color:red;'>Batal Otomatis</span>";
                              }

                              ?>
                            </td>
                            <td>
                              <?php

                              $konfirmasi = $row->status_pembayaran;

                              if($konfirmasi==0){
                                $status = "Menunggu Pembayaran";
                              }else if($konfirmasi==1){
                                $status = "Proses";
                              }else if($konfirmasi==3){
                                $status = "Dibatalkan Pembeli";
                              }else if($konfirmasi==4){
                                $status = "Dibatalkan Penjual";
                              }else{
                                $status = "Pembayaran Diterima";
                              }
                              ?>
                              <?php echo $status;?>
                            </td>
                            <td>
                              <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail<?php echo $row->no_invoice;?>">Lihat Detail</button>
                            </td>
                          </tr>
                          <?php $no++;?>
                          <?php } ?>
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
          ->where('statustransaksi.respon_pesanan', '=', '0')
          ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'invoice.metode_pembayaran', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
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
                    ->where('statustransaksi.respon_pesanan', '=', '0')
                    ->where('invoice.no_invoice', '=', $i->no_invoice)
                    ->select('pemesanan.pelanggan', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'invoice.metode_pembayaran', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
                    ->first();

                    ?>
                    <table class="table table-bordered">

                      <tr>
                        <?php
                        //$pelanggan=$this->db->query("select * from tb_member where kode_member='$i->pelanggan'");
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
                              Pembelian oleh : <b><?php echo strtoupper($nama);?></b> <br> No. Invoice : <b><?php echo strtoupper($psn->no_invoice);?></b>
                              <br>
                              <?php
                              //$detil_pemesanan = $this->db->query("select * from tb_detailpemesanan where no_pemesanan='$i->no_pemesanan'");
                              $detil_pemesanan = DB::table('detailpemesanan')->where('no_pemesanan', $psn->no_pemesanan)->get();
                              ?>
                              @foreach ($detil_pemesanan as $d)
                                <?php
                                //$detail_produk=$this->db->query("select * from tec_products where code='$d->kode_produk'");
                                $detail_produk = DB::table('produk')->where('kode_produk', $d->kode_produk)->first();
                                $nama_produk=$detail_produk->nama;
                                $kategori=$detail_produk->kategoriproduk_id;

                                //$detail_kategori=$this->db->query("select * from tec_categories where id='$kategori'");
                                $detail_kategori = DB::table('kategoriproduk')->where('id', $kategori)->first();
                                $kategoriproduk=$detail_kategori->nama;

                                //$detail_stok=$this->db->query("select * from tb_stok where id_stok='$d->id_stok'");
                                $detail_stok = DB::table('stok')->where('id_stok', $d->id_stok)->first();
                                $nama_stok=$detail_stok->nama;
                                ?>
                                Produk : <b><?php echo $nama_produk." (".$kategoriproduk.") ";?></b>
                                <br>
                                <b>Total : Rp. <?php echo $i->grandtotal;?></b>
                                <?php
                                if($nama_stok){
                                  ?>
                                  <br>
                                  <b>Kategori : <?php echo $nama_stok;?></b>
                                  <?php }else{ } ?>
                                @endforeach
                              </td>
                              <td colspan="2">
                                Payment :<br>
                                <?php
                                $metode_pembayaran = $i->metode_pembayaran;
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

                                  $no_invoice = $i->no_invoice;
                                  //$detail_statuspembayaran=$this->db->query("select * from tb_statuspembayaran where no_invoice='$no_invoice'");
                                  $detail_statuspembayaran = DB::table('statuspembayaran')->where('no_invoice', $no_invoice)->first();
                                  $konfirmasi=$detail_statuspembayaran->status_pembayaran;

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
                                  <?php
                                  if($metode_pembayaran=='1'){
                                    ?>
                                    &nbsp; | &nbsp;
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pesananbaru<?php echo $i->no_invoice;?>">Terima Pesanan</button>
                                    &nbsp;
                                    <?php }else{
                                      if($resultcode=='00'){ ?>
                                        &nbsp; | &nbsp;
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#pesananbaru<?php echo $i->no_invoice;?>">Terima Pesanan</button>
                                        &nbsp;
                                        <?php }else{ } } ?>

                                        <?php if($metode_pembayaran=='2'){ }else{ ?>
                                          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#batalkanpesanan<?php echo $i->no_invoice;?>">Batalkan Pesanan</button>
                                          <?php } ?>
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

                          <!-- modal pesanan -->
                          <?php

                          // $invoice = $this->db->query("SELECT * FROM tb_pemesanan, tb_invoice, tb_statuspembayaran, tb_statustransaksi
                          //   where tb_pemesanan.no_pemesanan=tb_invoice.no_pemesanan
                          //   and tb_invoice.no_invoice=tb_statuspembayaran.no_invoice
                          //   and tb_statuspembayaran.no_statuspembayaran=tb_statustransaksi.no_statuspembayaran
                          //   and tb_statustransaksi.respon_pesanan='0' ");

                          $invoice  = DB::table('pemesanan')
                          ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                          ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                          ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                          ->where('statustransaksi.respon_pesanan', '=', '0')
                          ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
                          ->get();

                          ?>
                          @foreach ($invoice as $i)
                            <div class="modal fade" id="pesananbaru<?php echo $i->no_invoice;?>" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Respon Penerimaan Invoice <?php echo $i->no_invoice;?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah Anda yakin menerima pesanan yang Anda pilih ?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-info" id="responpesanan<?php echo $i->no_invoice;?>">Ya</button>
                                  </div>
                                </div>

                              </div>
                            </div>

                            <div class="modal fade" id="batalkanpesanan<?php echo $i->no_invoice;?>" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Respon Pembatalan Invoice <?php echo $i->no_invoice;?></h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah Anda yakin membatalkan pesanan yang Anda pilih ?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-info" id="responbatal<?php echo $i->no_invoice;?>">Ya</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          @endforeach

                          <script type="text/javascript">

                          $(document).ready(function() {
                            //alert('test');
                            <?php

                            //$invoice = $this->db->query("SELECT * FROM tb_pemesanan, tb_invoice, tb_statuspembayaran, tb_statustransaksi where tb_pemesanan.no_pemesanan=tb_invoice.no_pemesanan and tb_invoice.no_invoice=tb_statuspembayaran.no_invoice and tb_statuspembayaran.no_statuspembayaran=tb_statustransaksi.no_statuspembayaran and tb_statustransaksi.respon_pesanan='0' ");
                            $invoice  = DB::table('pemesanan')
                            ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                            ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                            ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                            ->where('statustransaksi.respon_pesanan', '=', '0')
                            ->select('statuspembayaran.status_pembayaran', 'invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.pelanggan', 'pemesanan.grandtotal')
                            ->get();
                            ?>
                            @foreach ($invoice as $i)

                            $("#recek<?php echo $i->no_invoice;?>").click(function(){
                              var invoice = '<?php echo $i->no_invoice;?>';

                              <?php
                              //$detail_invoice=$this->db->query("select * from tb_invoice where no_invoice='$i->no_invoice'");
                              $detail_invoice = DB::table('invoice')->where('no_invoice', $i->no_invoice)->first();
                              $transidmerchant=$detail_invoice->transidmerchant;
                              ?>

                              var transidmerchant = '<?php echo $transidmerchant;?>';

                              $.ajax({
                                type: "POST",
                                url : "/order/recek",
                                data: "invoice="+invoice+
                                "&transidmerchant="+transidmerchant,
                                beforeSend: function() {
                                  // setting a timeout
                                  $.LoadingOverlay("show");

                                },
                                success: function(msg){
                                  location.reload();
                                }
                              });

                            });

                            $("#responpesanan<?php echo $i->no_invoice;?>").click(function(){
                              var invoice = '<?php echo $i->no_invoice;?>';

                              <?php
                              //$detail_statuspembayaran=$this->db->query("select * from tb_statuspembayaran where no_invoice='$i->no_invoice'");
                              $detail_statuspembayaran = DB::table('statuspembayaran')->where('no_invoice', $i->no_invoice)->first();
                              $no_statuspembayaran=$detail_statuspembayaran->no_statuspembayaran;
                              ?>

                              var nostatuspembayaran = '<?php echo $no_statuspembayaran;?>';
                              //alert(no_statuspembayaran);
                              $.ajax({
                                type: "GET",
                                url : "/order/responpesanan/"+invoice+"/"+nostatuspembayaran,
                                beforeSend: function() {
                                  // setting a timeout
                                  $.LoadingOverlay("show");

                                },
                                success: function(msg){
                                  location.reload();
                                }
                              });

                            });

                            $("#responbatal<?php echo $i->no_invoice;?>").click(function(){
                              var invoice = '<?php echo $i->no_invoice;?>';
                              //alert(invoice);
                              $.ajax({
                                type: "GET",
                                url : "/order/responbatal/"+invoice,
                                beforeSend: function() {
                                  // setting a timeout
                                  $.LoadingOverlay("show");

                                },
                                success: function(msg){
                                  location.reload();
                                }
                              });

                            });
                            @endforeach

                          });

                          </script>

                          <!-- modal pesanan -->

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
