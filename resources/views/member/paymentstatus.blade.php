@extends('layouts.member.layout')
@section('header', 'Status Pemesanan')

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
            <?php
              $email = Session::get('email');
              $get_member = DB::table('member')->where('email', $email)->first();
      				$kode_member = $get_member->kode_member;
            ?>
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
                  <th>Tanggal</th>
                  <th>Detail Invoice</th>
                  <th>Sumber Pembayaran</th>
                  <th>Tujuan Pembayaran</th>
                  <th>Bukti Bayar</th>
                  <th>Respon Penjual</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $datapemesanan  = DB::table('pemesanan')
                ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                ->where('statustransaksi.respon_pesanan', '=', '0')
                ->where('pemesanan.pelanggan', '=', $kode_member)
                ->select('statuspembayaran.bank_tujuan','invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.tanggal_pemesanan', 'pemesanan.grandtotal', 'pemesanan.provider_ongkir', 'pemesanan.service_ongkir', 'pemesanan.cost_ongkir', 'statuspembayaran.bukti')
                ->orderby('pemesanan.id','desc')
                ->get();
                ?>
                <?php $no='1'; ?>
                @foreach ($datapemesanan as $i)
                <tr>
                  <td><?php echo $no;?></td>
                  <td>{{ $i->tanggal }}</td>
                  <td><a href="{{ URL::to('/invoicepdf/'.$i->no_pemesanan.'/'.$i->no_invoice) }}" target="_blank">{{ $i->no_invoice }}</a></td>
                  <td>
                    <?php
                      $getbayar = DB::table('statuspembayaran')->where('no_invoice', $i->no_invoice)->first();
                      $bank = $getbayar->bank;
                      $rekening = $getbayar->rekening;
                      $nama = $getbayar->nama;
                      //
                      if($rekening){
                    ?>
                    {{ $bank }}<br>
                    {{ $rekening }}<br>
                    {{ $nama }}
                    <?php }else{ ?>
                    Tidak ada data
                    <?php } ?>
                  </td>
                  <td>
                    <?php

                      $getrekening = DB::table('rekening')->where('id_rekening', $i->bank_tujuan)->first();
                      $bank = $getrekening->bank;
                      $rekening = $getrekening->rekening;
                      $atasnama = $getrekening->atasnama;
                      //
                      $get_rekening = DB::table('bank')->where('id_bank', $bank)->first();
                      $nama_bank = $get_rekening->nama_bank;
                    ?>
                    {{ $nama_bank }}<br>
                    {{ $rekening }}<br>
                    {{ $atasnama }}
                  </td>
                  <td>
                    <?php if($i->bukti){ ?>
                         <img style="width:100px;" src="{{asset('assets/bukti/'.$i->bukti)}}">
                     <?php } else{ echo "Tidak ada"; } ?>
                  </td>
                  <td>
                    <?php
                    $no_invoice = $i->no_invoice;
                    $get_status = DB::table('statuspembayaran')->where('no_invoice', $no_invoice)->first();
                    $status_pembayaran = $get_status->status_pembayaran;

                    if($status_pembayaran=='0'){
                        echo "Menunggu Pembayaran";
                    }else if($status_pembayaran=='1'){
                        echo "Proses";
                    }else if($status_pembayaran=='3'){
                        echo "Dibatalkan Pembeli";
                    }else if($status_pembayaran=='4'){
                        echo "Dibatalkan Penjual";
                    }else{
                        echo "Pembayaran Diterima";
                    }
                    ?>

                  </td>
                  <td>
                    <!-- Ubah<br> -->
                    <a href="javascript:;" data-toggle="modal" data-target="#myModal{{ $i->no_invoice }}" type="button" class="btn btn-sm btn-success" style="width: 100%; margin-bottom:5px;">Unggah Bukti</a>
                    <a href="{{ URL::to('/invoicepdf/'.$i->no_pemesanan.'/'.$i->no_invoice) }}" target="_blank" type="button" class="btn btn-sm btn-warning" style="width: 100%; margin-bottom:5px;">Lihat Invoice</a>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detail{{ $i->no_invoice }}" style="width:100%;">Detail Transaksi</button>
                  </td>
                </tr>
                <?php $no++; ?>
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

  <?php
    $datapemesanan  = DB::table('pemesanan')
    ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
    ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
    ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
    ->where('statustransaksi.respon_pesanan', '=', '0')
    ->where('pemesanan.pelanggan', '=', $kode_member)
    ->select('invoice.tanggal', 'invoice.jatuh_tempo', 'invoice.no_invoice', 'pemesanan.no_pemesanan', 'pemesanan.tanggal_pemesanan', 'pemesanan.grandtotal', 'pemesanan.provider_ongkir', 'pemesanan.service_ongkir', 'pemesanan.cost_ongkir')
    ->orderby('pemesanan.id','desc')
    ->get();
  ?>
  @foreach ($datapemesanan as $i)
  <div class="modal fade" id="myModal{{ $i->no_invoice }}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload Bukti Bayar</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <form name="form_upload{{ $i->no_invoice }}" id="form_upload{{ $i->no_invoice }}" method="post">
            @csrf
            <div class="form-group">
              <label for="usr">Bank :</label>
              <input type="text" name="bank" id="bank{{ $i->no_invoice }}" maxlength="90" class="form-control">
              <label for="usr">No. Rekening :</label>
              <input type="text" name="rekening" id="rekening{{ $i->no_invoice }}" maxlength="90" class="form-control">
              <label for="usr">Atas Nama :</label>
              <input type="text" name="atasnama" id="atasnama{{ $i->no_invoice }}" maxlength="90" class="form-control">
              <label for="usr">Upload Bukti Bayar :</label>
              <input type="file" name="uploadbukti" id="uploadbukti{{ $i->no_invoice }}" class="form-control" accept="image/*" data-type='image' onchange="return validasiFile()">

              <input type="text" name="gambar" id="gambar{{ $i->no_invoice }}" hidden>
              <input type="text" name="no_invoice" id="no_invoice{{ $i->no_invoice }}" value="{{ $i->no_invoice }}" hidden>

              <div class="form-group" style="margin-top: 10px;">
                <button class="btn btn-primary" type="button" id="upload_bukti{{ $i->no_invoice }}">Submit</button>
              </div>
            </div>

          </form>

          <script type="text/javascript">

          //validasi gambar
          function validasiFile(){
              var inputFile = document.getElementById('uploadbukti{{ $i->no_invoice }}');
              var pathFile = inputFile.value;
              var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
              if(!ekstensiOk.exec(pathFile)){
                  //alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png/.gif');
                  inputFile.value = '';
                  return false;
              }else{

              }
          }
          //validasi gambar

          $(document).ready(function() {
            var _URL = window.URL;
            var uploadField = document.getElementById("uploadbukti{{ $i->no_invoice }}");

            $("#rekening{{ $i->no_invoice }}").keypress(function(data){
          		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
          		{
          			return false;
          		}
          	});

            $("#uploadbukti{{ $i->no_invoice }}").change(function (e) {
              var uploadbukti = $("#uploadbukti{{ $i->no_invoice }}").val();
              var ambil_upload = uploadbukti.substring(12);
              $("#gambar{{ $i->no_invoice }}").val(ambil_upload);
            });

            $("#upload_bukti{{ $i->no_invoice }}").click(function(){

              var token = $("input[name='_token']").val();
              var uploadbukti = $("#uploadbukti{{ $i->no_invoice }}").val();
              var no_invoice = $("#no_invoice{{ $i->no_invoice }}").val();
              var bank = $("#bank{{ $i->no_invoice }}").val();
              var rekening = $("#rekening{{ $i->no_invoice }}").val();
              var atasnama = $("#atasnama{{ $i->no_invoice }}").val();
              var ambil_upload = uploadbukti.substring(12);

              if(uploadbukti==0){
                alert('Maaf, File gambar tidak boleh kosong');
                $("#uploadbukti{{ $i->no_invoice }}").focus();
                return false();
              }

              if(bank==0){
                alert('Maaf, Bank tidak boleh kosong');
                $("#bank{{ $i->no_invoice }}").focus();
                return false();
              }

              if(rekening==0){
                alert('Maaf, Rekening tidak boleh kosong');
                $("#rekening{{ $i->no_invoice }}").focus();
                return false();
              }

              if(atasnama==0){
                alert('Maaf, Atas nama tidak boleh kosong');
                $("#atasnama{{ $i->no_invoice }}").focus();
                return false();
              }

              var formData = new FormData($('#form_upload{{ $i->no_invoice }}').get(0));
              url = "/member/updatebukti";
              //alert(img_lama;
              $.ajax({
                url : url,
                type: "POST",
                data: formData,
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function() {
                  // setting a timeout
                  $.LoadingOverlay("show");
                },
                success: function(msg){
                  if(msg=='1'){
                    location.reload();
                  }else{
                    alert("Ada kesalahan, silakan coba kembali");
                    location.reload();
                  }
                }
              });

              //batas

            });

          });

          </script>

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="detail{{ $i->no_invoice }}" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Invoice</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <div class="modal-body">
          <!-- konten ============================================================================-->

          <table class="table table-bordered">
            <tbody><tr>
              <td colspan="3">
                <table class="table table-bordered">
                  <tbody>
                    <?php
                      $getdetail = DB::table('detailpemesanan')->where('no_pemesanan', $i->no_pemesanan)->get();
                    ?>
                    @foreach ($getdetail as $result)
                      <?php
                        $kode_produk = $result->kode_produk;
                        $product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
                        $kode_produk = $product->kode_produk;
                        $nama_produk = $product->nama;
                        $harga = $product->harga;
                        $berat = $product->berat;
                        $gambar1 = $product->gambar1;
                       ?>
                    <tr>
                      <td>
                        {{ $nama_produk }}<br>
                        {{ $result->jumlah }} Barang x Rp. {{ number_format($harga) }}<br>
                      </td>
                      <td>
                        Total Item : <br> Rp. {{ number_format($result->total) }}
                      </td>
                    </tr>
                    @endforeach
                  </tbody></table>
                </td>
              </tr>
              <tr>
                <?php
                  $datapemesanan = DB::table('pemesanan')->where('no_pemesanan', $i->no_pemesanan)->first();
                  $kode_member = $datapemesanan->pelanggan;
                  $kurir = $datapemesanan->provider_ongkir;
                  $paket = $datapemesanan->service_ongkir;
                  $biaya = $datapemesanan->cost_ongkir;
                  $total = $datapemesanan->grandtotal;

                  $datamember = DB::table('member')->where('kode_member', $kode_member)->first();
                  $namapen = $datamember->name;
                  $emailpen = $datamember->email;
                  $teleponpen = $datamember->telepon;
                ?>
                <td colspan="2">
                  Alamat Pengiriman :
                  <br>{{ $namapen }}<br>{{ $emailpen }}<br>            </td>
                  <td>
                    Detail Ongkir :
                    <br>Provider : {{ $kurir }}<br>Service : {{ $paket }}<br>Cost : Rp {{ number_format($biaya) }}           </td>
                  </tr>
                  <tr>
                    <td colspan="3">Total Penjualan + Ongkir : Rp. {{ number_format($total) }} </td>
                  </tr>
                </tbody></table>

                <!-- konten ============================================================================-->

        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  @endforeach

<!-- DataTables -->
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
