@extends('layouts.web')

<?php $seo = DB::table('seo')->where('id_seo', '1')->first(); ?>
@section('title')
  {{ $seo->title ? $seo->title : 'Qnanz Official' }}
@endsection

@section('description')
  {{ $seo->deskripsi ? $seo->deskripsi : 'Qnanz Official' }}
@endsection

@section('keyword')
  {{ $seo->keyword ? $seo->keyword : 'Qnanz Official' }}
@endsection

@section('content')

  @include('web.components.header2')

  <!-- PAGE-CONTENT START -->
  <!-- Breadcrumb Area Start Here -->
  <?php
    $getbannerimage = DB::table('bannerimage')->where('id_bannerimage', '1')->first();
    $gambarbanner  = $getbannerimage ->gambar;
  ?>
  <div class="breadcrumbs-area position-relative" style="background: #f6f6f6 url({{asset('assets/bannerimage/'.$gambarbanner)}}) no-repeat scroll center center/cover;">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                  <div class="breadcrumb-content position-relative section-content">
                      <h3 class="title-3">Checkout</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Checkout</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- Checkout Area Start Here -->
  <div class="checkout-area mt-no-text">
      <div class="container custom-container">
          <div class="row">
              <div class="col-lg-6 col-12 col-custom">
                  <form action="#">
                      <div class="checkbox-form">
                          <h3>Billing Details</h3>
                          <div class="row">
                            <?php
                              $email = Session::get('email');
                              $detail_member = DB::table('member')->where('email', $email)->first();
                              $get_nama = $detail_member->name;
                              $get_email = $detail_member->email;
                              $get_telepon = $detail_member->telepon;
                            ?>
                              <div class="col-md-12 col-custom">
                                  <div class="checkout-form-list">
                                      <label>Nama <span class="required">*</span></label>
                                      <input type="text" name="getnama" id="getnama"  value="{{ $get_nama }}" disabled />
                                  </div>
                              </div>
                              <div class="col-md-12 col-custom">
                                  <div class="checkout-form-list">
                                      <label>Email <span class="required">*</span></label>
                                      <input type="text" name="getemail" id="getemail"  value="{{ $get_email }}" disabled />
                                  </div>
                              </div>
                              <div class="col-md-12 col-custom">
                                  <div class="checkout-form-list">
                                      <label>Telepon <span class="required">*</span></label>
                                      <input type="text" name="gettelepon" id="gettelepon" value="{{ $get_telepon }}" disabled />
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <div class="col-lg-6 col-12 col-custom">
                  <div class="your-order">
                      <h3>Your order</h3>
                      <div class="your-order-table table-responsive">
                          <table class="table">
                              <thead>
                                  <tr>
                                      <th class="cart-product-name">Product</th>
                                      <th class="cart-product-total">Total</th>
                                  </tr>
                              </thead>
                              <tbody>
                                @foreach ($keranjang as $result)
                                <?php
                                  $kode_produk = $result->kode_produk;
                                  $product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
                                  $kode_produk = $product->kode_produk;
                                  $nama = $product->nama;
                                  $harga = $product->harga;
                                  $berat = $product->berat;
                                  $stok = $product->stok;
                                  $gambar1 = $product->gambar1;
                                 ?>
                                  <tr class="cart_item">
                                      <td class="cart-product-name">{{ $nama }}<strong class="product-quantity">
                          × {{ $result->jumlah }}</strong></td>
                                      <td class="cart-product-total text-center"><span class="amount">Rp {{ number_format($result->total) }}</span></td>
                                  </tr>
                                 @endforeach
                              </tbody>
                              <tfoot>
                                <?php
                                  $no_pemesanan = Session::get('no_pemesanan');
                                  $get_pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                                  $get_subtotal = $get_pemesanan->subtotal;
                                  $get_grandtotal = $get_pemesanan->grandtotal;
                                ?>
                                  <tr class="cart-subtotal">
                                      <th>Cart Subtotal</th>
                                      <td class="text-center"><span class="amount">Rp {{ number_format($get_subtotal) }}</span></td>
                                  </tr>
                                  <?php
                            $email = Session::get('email');
                            $detail_member = DB::table('member')->where('email', $email)->first();
                            $kode_member = $detail_member->kode_member;
                            $defalamat = DB::table('alamat')->where('kode_member', $kode_member)->orderBy('id_alamat', 'asc')->first();
                            $id_alamat = $defalamat->id_alamat;
                          ?>
                          <tr>
														<td class="product-name">Alamat Utama</td>
														<td class="product-total">
                              <select name="alamatalternatif" id="alamatalternatif" class="form-control" style="font-size:15px; height:100%;">
                                <option value="0">Pilih Alamat Pengiriman</option>
                                <?php
                                $data_alamat = DB::table('alamat')->where('kode_member', $kode_member)->get();
                                ?>
                                @foreach ($data_alamat as $result)
                                  <option value="{{ $result->id_alamat }}"
                                @if ($id_alamat == $result->id_alamat) selected @endif >{{ $result->nama_alamat }}</option>
                                @endforeach
                              </select>
                              <br>
                              <div id="row_alamat"></div>


                              <small># Alamat ini yang akan dipakai untuk pengiriman, jika akan menggunakan alamat lain silahkan ganti alamat</small>

                              <br>
                              <a href="/alamat" target="_blank" class="btn btn-primary">Ganti Alamat</a>
                              <br>
                              <!-- script -->
                              <script type="text/javascript">
                              $(document).ready(function() {

                                //$("#spinner").hide();
                                //$("#alamatalternatif").change(function(){
                                var alamatalternatif = $("#alamatalternatif").val();
                                //alert(alamatalternatif);
                                if(alamatalternatif=='0'){ $("#row_alamat").hide(); }else{

                                  $.ajax({
                                    type: "GET",
                                    url : "/getalamat/"+alamatalternatif,
                                    beforeSend: function() {
                                      $("#row_alamat").hide();
                                      $("#spinner").show();
                                    },
                                    success: function(data){
                                      $("#spinner").hide();
                                      $("#row_alamat").show();
                                      $('#row_alamat').html(data.html);
                                    }
                                  });

                                }

                                //});

                                $("#alamatalternatif").change(function(){
                                  var alamatalternatif = $("#alamatalternatif").val();
                                  //alert('blog');
                                  if(alamatalternatif=='0'){ $("#row_alamat").hide(); }else{

                                    $.ajax({
                                      type: "GET",
                                      url : "/getalamat/"+alamatalternatif,
                                      beforeSend: function() {
                                        $("#row_alamat").hide();
                                        $("#spinner").show();
                                      },
                                      success: function(data){
                                        $("#spinner").hide();
                                        $("#row_alamat").show();
                                        $('#row_alamat').html(data.html);
                                      }
                                    });

                                  }

                                  getShipping();

                                });

                              });
                              </script>
                            </td>
													</tr>

                          <tr>
														<td>Pilih Pengiriman</td>
														<td>
                              <div id="jenis_kurir2">
                                  <select name="jenis_kurir" id="jenis_kurir" class="form-control" style="font-size:15px; height:100%;">
                                  <option value='0'>-- Pilih Pengiriman --</option>
                                </select>
                              </div>
                              <div class="loader" id="spinner2">Loading..</div>
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

                                function getShipping() {
                                  $(document).ready(function() {
                                    <?php
                                    $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
                                    $origin = $profiltoko->kota;

                                    $no_pemesanan = Session::get('no_pemesanan');
                                    $sumberat = DB::table("detailpemesanan")->where('no_pemesanan', $no_pemesanan)->get()->sum('berat');

                                    ?>

                                    var origin = '<?php echo $origin;?>';
                                    var idalamat = $("#alamatalternatif").val();
                                    //var weight = '0';
                                    var weight = '<?php echo $sumberat;?>';
                                    //alert(destination);
                                    var jne = "jne";
                                    var tiki = "tiki";
                                    var pos = "pos";
                                    var jnt = "jnt";

                                    $.ajax({
                                      type: "GET",
                                      url : "/shipping/"+origin+"/"+idalamat,
                                      beforeSend: function() {
                                        $("#jenis_kurir").hide();
                                        $("#spinner2").show();
                                      },
                                      success: function(data){
                                        $("#spinner2").hide();
                                        //$(".nice-select").hide();
                                        $("#jenis_kurir").show();
                                        $('#jenis_kurir').html(data.html);
                                      }
                                    });
                                  });

                                  var biaya = 0;
                                  //alert(url);
                                  //var kurir_lain = $("#kurir_lain").val();
                                  <?php
                                  $no_pemesanan = Session::get('no_pemesanan');
                                  $pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                                  $subtotal = $pemesanan->subtotal;
                                  ?>
                                  var total2 = '{{ $subtotal }}';
                                  var jumlah2 = parseInt(biaya)+parseInt(total2);
                                  var total_semua = jumlah2;

                                  $("#biayacost").html("Rp "+addCommas(biaya));
                                  $("#grand_total").html("Rp "+addCommas(total_semua));
                                  $("#grand_total2").val(total_semua);

                                }
                                $(document).ready(function() {

                                  getShipping();

                                  $("#jenis_kurir").change(function(){
                                    //alert('test');
                                    var nilai=$(this).find('option:selected').val();
                                    //alert(nilai);

                                    var promo = $("#pot_promo").val();
                                    var propinsi = $("#data_propinsi").val();
                                    var kota = $("#data_kota").val();
                                    var kurir2 = $("#jenis_kurir").val();
                                    var url = nilai;
                                    var explode = url.split('-');
                                    var kurir = explode[0];
                                    var paket = explode[1];
                                    var biaya = explode[2];
                                    //alert(url);
                                    //var kurir_lain = $("#kurir_lain").val();
                                    <?php
                                    $no_pemesanan = Session::get('no_pemesanan');
                                    $pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                                    $subtotal = $pemesanan->subtotal;
                                    ?>
                                    var total2 = '{{ $subtotal }}';
                                    var jumlah2 = parseInt(biaya)+parseInt(total2);
                                    var total_semua = jumlah2;

                                    $("#biayacost").html("Rp "+addCommas(biaya));
                                    $("#grand_total").html("Rp "+addCommas(total_semua));
                                    $("#grand_total2").val(total_semua);

                                    // }else{

                                    //     $("#grand_total").val("Rp"+addCommas(total2));

                                    // }

                                  });

                                });
                                </script>
                            </td>
													</tr>
                          <?php
                          $no_pemesanan = Session::get('no_pemesanan');
                          $pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                          ?>
													<tr>
														<td>Sub Total</td>
														<td>Rp {{ number_format($pemesanan->subtotal) }}</td>
													</tr>
                          <tr>
														<td>Pengiriman</td>
														<td id="biayacost">Rp {{ number_format($pemesanan->cost_ongkir) }}</td>
													</tr>
                          <tr>
														<td>Grand Total</td>
														<td id="grand_total">Rp {{ number_format($pemesanan->subtotal) }}</td>
													</tr>
                              </tfoot>
                          </table>
                      </div>
                      <div class="payment-method">
                          <div class="payment-accordion">
                              <div class="order-button-payment">
                                 <form role="form" method="post" id="paymentform">
                                    @csrf
                                    <input type="text" name="namapen" id="namapen" value="{{ $get_nama }}" class="input-text validate-postcode" style="display:none;" hidden>
                                    <input type="text" name="emailpen" id="emailpen" value="{{ $get_email }}" class="input-text validate-postcode" style="display:none;" hidden>
                                    <input type="text" name="teleponpen" id="teleponpen" value="{{ $get_telepon }}" class="input-text validate-postcode" style="display:none;" hidden>
                                    <input type="text" name="banktujuan" id="banktujuan" class="input-text validate-postcode" style="display:none;" hidden>
                                    <input type="text" name="grand_total2" id="grand_total2" style="display:none;" hidden/>
            												{{-- <input type="button" id="modalpembayaran" value="Lanjutkan Pembayaran" /> --}}
                                    <button type="button" class="btn flosun-button secondary-btn black-color rounded-0 w-100" id="modalpembayaran">Lanjutkan Pembayaran</button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
        $(document).ready(function() {

          $("#modalpembayaran").click(function(){

            var alamatalternatif = $("#alamatalternatif").val();
            var jenis_kurir = $("#jenis_kurir").val();

            if(alamatalternatif==0){
              alert('Maaf, Alamat pengiriman tidak boleh kosong');
              $("#alamatalternatif").focus();
              return false();
            }

            if(jenis_kurir==0){
              alert('Maaf, Pengiriman tidak boleh kosong');
              $("#jenis_kurir").focus();
              return false();
            }

            $('#pilihpembayaran').modal('show');

          });
        });
        </script>
        <!-- modal payment 2 -->

        <div class="modal fade" id="pilihpembayaran" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Pilih Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <!--<button class="btn" data-toggle="modal" data-target="#myModal3" id="modal3">Modal 3</button>-->
                <ul class="list-group">
                  <li class="list-group-item" style="background-color:#eae8e8;">Transfer Bank</li>
                  <?php
                  $databank  = DB::table('rekening')
                  ->join('bank', 'rekening.bank', '=', 'bank.id_bank')
                  ->select('rekening.id_rekening','bank.id_bank', 'bank.gambar')
                  ->get();
                  ?>
                  @foreach ($databank as $i)
                    <li class="list-group-item">
                      <a href="javascript:;" style="display:block;" id="manual{{ $i->id_rekening }}"><img style="max-width:70px; display:inline;" class="img-responsive" src="{{asset('assets/bank/'.$i->gambar)}}"></a>
                    </li>
                  @endforeach
                </ul>
              </div>

              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function() {

          <?php
          $databank  = DB::table('rekening')
          ->join('bank', 'rekening.bank', '=', 'bank.id_bank')
          ->select('rekening.id_rekening','bank.id_bank', 'bank.gambar')
          ->get();
          ?>
          @foreach ($databank as $i)
          $("#rekening{{ $i->id_bank }}").keypress(function(data){
            if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
              return false;
            }
          });

          $("#manual{{ $i->id_rekening }}").click(function(){
            // var bank = $("#namabank").val();
            // var rekening = $("#rekening").val();
            // var nama = $("#nama").val();
            var dataform = $("#paymentform").serialize();
            var token = $("input[name='_token']").val();
            var banktujuan = '{{ $i->id_rekening }}';
            var namapen = $("#namapen").val();
            var emailpen = $("#emailpen").val();
            var teleponpen = $("#teleponpen").val();
            var alamatalternatif = $("#alamatalternatif").val();
            var data_propinsi = $("#data_propinsi").val();
            var data_kota = $("#data_kota").val();
            var jenis_kurir = $("#jenis_kurir").val();
            var url = jenis_kurir;
            var explode = url.split('-');
            var kurir = explode[0];
            var paket = explode[1];
            var biaya = explode[2];
            var promo = $("#promo").val();
            var total = $("#grand_total{{ $i->id_bank }}").val();
            var grandtotal = $("#grand_total").val();
            var grandtotal2 = $("#grand_total2").val();
            // alert(kurir);
            // alert(paket);
            // alert(biaya);
            // alert(total);
            // alert(detailkurir);

            $.ajax({
              type: "POST",
              url : "/payment",
              data: "_token="+token+
              "&namapen="+namapen+
              "&emailpen="+emailpen+
              "&teleponpen="+teleponpen+
              "&banktujuan="+banktujuan+
              "&alamatalternatif="+alamatalternatif+
              "&data_propinsi="+data_propinsi+
              "&data_kota="+data_kota+
              "&jenis_kurir="+jenis_kurir+
              "&grand_total2="+grandtotal2,

              beforeSend: function() {
                // setting a timeout
                $.LoadingOverlay("show");
              },
              success: function(msg){
                //alert(msg);
                document.location.href="/thankyou/"+msg;
              }
            });

          });

          @endforeach

        });
  </script>
  <!-- Checkout Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
