@extends('layouts.member.layout')
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
                  <th>No. Invoice</th>
                  <th>Detail Pemesanan</th>
                  <th>Status Pengiriman</th>
                  <th>Konfirmasi Penerimaan</th>
                  <th>Detail Transaksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $datakonfirmasi  = DB::table('pemesanan')
                ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
                ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
                ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
                ->where('statuspembayaran.status_pembayaran', '=', '2')
                ->where('statustransaksi.respon_pesanan', '=', '1')
                ->where('statustransaksi.status_ekspedisi', '=', 'DELIVERED')
                ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
                ->where('pemesanan.pelanggan', '=', $kode_member)
                ->select('pemesanan.diskon', 'pemesanan.no_pemesanan', 'pemesanan.subtotal', 'invoice.no_invoice', 'invoice.tanggal', 'statustransaksi.status_pengiriman', 'statustransaksi.no_resi')
                ->orderby('pemesanan.id','desc')
                ->get();
                ?>
                <?php $no='1'; ?>
                @foreach ($datakonfirmasi as $i)
                <?php
                  $diskon = $i->diskon;
                  $subtotal = $i->subtotal;
                  $val_diskon = $subtotal * $diskon / 100;
                ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><b>No. Invoice : </b><br>
                    <a href="{{ URL::to('/invoicepdf/'.$i->no_pemesanan.'/'.$i->no_invoice) }}" target="_blank"><?php echo $i->no_invoice;?></a>
                  </td>
                  <td>
                    <?php echo $i->tanggal;?><br>
                    <?php
                      $no_pemesanan = $i->no_pemesanan;
                      $datapemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                      $total = $datapemesanan->grandtotal;
                    ?>
                    Total : Rp <?php echo number_format($total);?>
                  </td>
                  <td>
                    <?php
                      $status_pengiriman = $i->status_pengiriman;
                      if($status_pengiriman=='3'){
                        echo "Proses packing";
                      }else if($status_pengiriman=='4'){
                          echo "Sedang pengiriman";
                          $no_resi = $i->no_resi;
                          if($no_resi){
                        ?>
                          <div style="margin-top: 10px;"></div>
                          <a href='/member/viewtrack/<?php echo $no_resi;?>' target="_blank" class="btn btn-sm btn-success">Lacak</a>
                        <?php
                        }else{}
                      }else{
                        echo "Belum ada status";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                    if($status_pengiriman=='4'){
                    ?>
                        <a type="button" href="javascript:;" class="btn btn-info" data-toggle="modal" data-target="#selesai<?php echo $i->no_invoice;?>">Sudah Terima</a>
                    <?php }else{ ?>
                      -
                    <?php } ?>
                  </td>
                  <td>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detail<?php echo $i->no_invoice;?>" style="width:100%;">Detail Transaksi</button>
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
    $datakonfirmasi  = DB::table('pemesanan')
    ->join('invoice', 'pemesanan.no_pemesanan', '=', 'invoice.no_pemesanan')
    ->join('statuspembayaran', 'invoice.no_invoice', '=', 'statuspembayaran.no_invoice')
    ->join('statustransaksi', 'statuspembayaran.no_statuspembayaran', '=', 'statustransaksi.no_statuspembayaran')
    ->where('statuspembayaran.status_pembayaran', '=', '2')
    ->where('statustransaksi.respon_pesanan', '=', '1')
    ->where('statustransaksi.status_ekspedisi', '=', 'DELIVERED')
    ->where('statustransaksi.konfirmasi_penerimaan', '=', '0')
    ->where('pemesanan.pelanggan', '=', $kode_member)
    ->select('pemesanan.diskon', 'pemesanan.no_pemesanan', 'pemesanan.subtotal', 'invoice.no_invoice', 'invoice.tanggal', 'statustransaksi.status_pengiriman', 'statustransaksi.no_resi')
    ->orderby('pemesanan.id','desc')
    ->get();
  ?>
  @foreach ($datakonfirmasi as $i)
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

  <div class="modal fade detail" id="selesai<?php echo $i->no_invoice;?>" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <form name="form_upload{{ $i->no_invoice }}" id="form_upload{{ $i->no_invoice }}" method="post">
        @csrf
        <div class="modal-content" style="padding:50px;">
          <div class="modal-header">
            <h4 class="modal-title">Selesaikan Pemesanan Invoice</h4>
          </div>
          <div class="modal-body">
            <p>1. Klik <b>Selesai</b> jika ingin menyelesaikan transaksi sekarang.</p>
            <p>2. Klik <b>Kembali</b> untuk membatalkan aksi ini.</p>
            <br>
            <input type="text" name="inv{{ $i->no_invoice }}" id="inv{{ $i->no_invoice }}" value="{{ $i->no_invoice }}" hidden>
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-info" id="konfirmasipenerimaan<?php echo $i->no_invoice;?>">Selesai</button>
          </div>
        </div>
      </form>

      </div>
  </div>
  <script type="text/javascript">

  function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
      x1 = x1.replace(rgx, '$1' + '.' + '$2');
    }
    return x1 + x2;
  }

  $(document).ready(function() {

      $("#konfirmasipenerimaan<?php echo $i->no_invoice;?>").click(function(){
        var token = $("input[name='_token']").val();
        var invoice = $("#inv{{ $i->no_invoice }}").val();
        //alert(invoice);
        $.ajax({
          type: "POST",
          url : "/member/updatepenerimaan",
          data: "_token="+token+
                "&invoice="+invoice,
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

      });

    });

</script>
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
