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
                      <h3 class="title-3">Shopping Cart</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Shopping Cart</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- cart main wrapper start -->
  <div class="cart-main-wrapper mt-no-text">
      <div class="container custom-area">
        <?php
          $no_pemesanan = Session::get('no_pemesanan');
          if($no_pemesanan){
        ?>
          <div class="row">
              <div class="col-lg-12 col-custom">
                  <!-- Cart Table Area -->
                  <div class="cart-table table-responsive">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th class="pro-thumbnail">Image</th>
                                  <th class="pro-title">Product</th>
                                  <th class="pro-price">Price</th>
                                  <th class="pro-quantity">Quantity</th>
                                  <th class="pro-subtotal">Total</th>
                                  <th class="pro-remove">Remove</th>
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
                              <tr>
                                  <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{asset('assets/product/'.$product->gambar1)}}" alt="Product" /></a></td>
                                  <td class="pro-title"><a href="#">{{ $nama }}</a></td>
                                  <td class="pro-price"><span>Rp {{ number_format($harga) }}</span></td>
                                  <td class="pro-quantity">
                                      <input type="number" value="{{ $result->jumlah }}" class="form-control" name="qty" id="qty_<?php echo $kode_produk; ?>" min="0" max="<?php echo $stok;?>">
                                  </td>
                                  <td class="pro-subtotal"><span>Rp {{ number_format($result->total) }}</span></td>
                                  <td class="pro-remove"><a href="javascript:;" id="deletecart<?php echo $kode_produk;?>"><i class="lnr lnr-trash"></i></a></td>
                              </tr>
                             @endforeach
                             <!-- delete cart -->
                              <script type="text/javascript" charset="utf-8">
                              $(document).ready(function() {
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
                                $("#deletecart<?php echo $kode_produk; ?>").click(function(){

                                  var kode_produk = '<?php echo $kode_produk; ?>';
                                  var no_pemesanan = '<?php echo $no_pemesanan; ?>';
                                  var token = $("input[name='_token']").val();

                                  //alert(kode_produk+' '+no_pemesanan);
                                  $.ajax({
                                          type: "POST",
                                          url : "/deletecart",
                                          data: "_token="+token+
                                                "&kode_produk="+kode_produk+
                                                "&no_pemesanan="+no_pemesanan,
                                          beforeSend: function() {
                                              // setting a timeout
                                              //$.LoadingOverlay("show");
                                          },
                                          success: function(msg){
                                            location.reload();
                                          }
                                    });

                                });
                              @endforeach

                              $("#updatecart").click(function(){
                                @foreach ($keranjang as $result)
                                <?php
                                    $kode_produk = $result->kode_produk;
                                ?>
                                  var kode_produk = '<?php echo $kode_produk; ?>';
                                  var qty = $("#qty_<?php echo $kode_produk; ?>").val();
                                  var token = $("input[name='_token']").val();

                                  //alert(kode_produk+' '+qty);
                                  $.ajax({
                                          type: "POST",
                                          url : "/updatecart",
                                          data: "_token="+token+
                                                "&kode_produk="+kode_produk+
                                                "&qty="+qty,
                                          beforeSend: function() {
                                              // setting a timeout
                                              $.LoadingOverlay("show");
                                          },
                                          success: function(msg){
                                            location.reload();
                                          }
                                    });

                                  @endforeach
                              });

                              });
                              </script>
                              <!-- delete cart -->
                          </tbody>
                      </table>
                  </div>
                  <!-- Cart Update Option -->
                  <div class="cart-update-option d-block d-md-flex justify-content-between">
                      <div class="apply-coupon-wrapper">
                          {{-- <form action="#" method="post" class=" d-block d-md-flex">
                              <input type="text" placeholder="Enter Your Coupon Code" required />
                              <button class="btn flosun-button primary-btn rounded-0 black-btn">Apply Coupon</button>
                          </form> --}}
                      </div>
                      <div class="cart-update mt-sm-16">
                          <a href="javascript:;" id="updatecart" class="btn flosun-button primary-btn rounded-0 black-btn">Update Cart</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-lg-5 ml-auto col-custom">
                  <!-- Cart Calculation Area -->
                  <div class="cart-calculator-wrapper">
                      <div class="cart-calculate-items">
                          <h3>Cart Totals</h3>
                          <?php
                            $no_pemesanan = Session::get('no_pemesanan');
                            $get_pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
                            $get_subtotal = $get_pemesanan->subtotal;
                            $get_grandtotal = $get_pemesanan->grandtotal;
                          ?>
                          <div class="table-responsive">
                              <table class="table">
                                  <tr class="total">
                                      <td>Total</td>
                                      <td class="total-amount"><?php echo 'Rp'.number_format($get_subtotal,0,',','.'); ?></td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                      <form role="form" method="post" id="checkoutform">
                          @csrf
                          <input type="hidden" name="kurir" value="none">
                          <input type="hidden" name="paket" value="none">
                          <input type="hidden" name="biaya" value="0">
                          <input type="hidden" name="diskon" value="0">
                          <input type="hidden" name="subtotal" value="<?php echo $get_subtotal; ?>">
                          <input type="hidden" name="total" value="<?php echo $get_subtotal; ?>">
                          <a href="javascript:;" id="sendcheckout" class="btn flosun-button primary-btn rounded-0 black-btn w-100">
                              Proses Checkout
                          </a>
                      </form>
                      {{-- <a href="checkout.html" class="btn flosun-button primary-btn rounded-0 black-btn w-100">Proceed To Checkout</a> --}}
                  </div>
              </div>
          </div>
        <?php }else{ echo "Belum ada transaksi"; } ?>
      </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function() {

        $("#sendcheckout").click(function(){

        var dataform = $("#checkoutform").serialize();
        //tinymce.triggerSave();
        var token = $("input[name='_token']").val();
        var kurir = $("#kurir").val();
        var paket = $("#paket").val();
        var biaya = $("#biaya").val();
        var diskon = $("#diskon").val();
        var subtotal = $("#subtotal").val();
        var total = $("#total").val();

        $.ajax({
          type: "POST",
          url : "/checkoutstore",
          data: dataform,
          beforeSend: function() {
            $.LoadingOverlay("show");
          },
          success: function(msg){
            document.location.href="/checkout";
          }
        });

      });

    });
  </script>
  <!-- cart main wrapper end -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
