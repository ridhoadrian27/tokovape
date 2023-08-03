@extends('layouts.front.cart')
@section('header', 'Keranjang Belanja')

@section('keranjang')
  <div class="table-responsive">
    <form method="post" action="#updatePost/">
      <input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
      <fieldset>
        <table class="data-table cart-table" id="shopping-cart-table">
          <thead>
            <tr class="first last">
              <th rowspan="1">&nbsp;</th>
              <th rowspan="1"><span class="nobr">Product Name</span></th>
              <th colspan="1" class="a-center"><span class="nobr">Unit Price</span></th>
              <th class="a-center" rowspan="1">Qty</th>
              <th colspan="1" class="a-center">Subtotal</th>
              <th class="a-center" rowspan="1">&nbsp;</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="first last">
              <td class="a-right last" colspan="7"><button onclick="location.href='https://store1.johanwahyudi.com/products'" class="button btn-continue" title="Continue Shopping" type="button"><span><span>Continue Shopping</span></span></button>
                <button class="button btn-update" title="Update Cart" name="update_cart_action" type="button" id="updatecart"><span><span>Update Cart</span></span></button>
                </td>
            </tr>
          </tfoot>
          <tbody>
            @foreach ($keranjang as $result)
              <?php
                $kode_produk = $result->kode_produk;
                $product = DB::table('produk')->where('kode_produk', $kode_produk)->first();
                $kode_produk = $product->kode_produk;
                $nama = $product->nama;
                $harga = $product->harga;
                $berat = $product->berat;
                $gambar1 = $product->gambar1;
               ?>
              <tr class="first odd">
                <td class="image">
                  <a class="product-image" title="Sample Product 5" href="javascript:;"><img width="75" alt="Sample Product 5" src="{{asset('assets/product/'.$gambar1)}}" style="width: 100px;"></a>
                </td>
                <td>
                  <h2 class="product-name"> <a href="javascript:;">{{ $nama }}</a> </h2>
                  <br>
                                        </td>
                <td class="a-right">
                  <span class="cart-price"> <span class="price">Rp10,000</span></span>
                </td>
                <td class="a-center movewishlist">
                  <input type="number" value="1" class="form-control" name="qty" id="qty_PRO100006" min="0" max="" style="width:20%;">
                </td>
                <td class="a-right movewishlist">
                  <span class="cart-price"> <span class="price">Rp10,000</span></span>
                </td>
                <td class="a-center last">
                  <a class="button remove-item" title="Remove item" href="javascript:;" id="deletecartPRO100006"><span><span>Remove item</span></span></a>
                </td>
              </tr>

            <!-- qty -->
            <script type="text/javascript" charset="utf-8">

            function createValidator(element) {
              return function() {
                var min = parseInt(element.getAttribute("min")) || 0;
                var max = parseInt(element.getAttribute("max")) || 0;

                var value = parseInt(element.value) || min;
                element.value = value; // make sure we got an int

                if (value < min) element.value = min;
                if (value > max) element.value = max;
              }
            }

            var elm = document.body.querySelector("#qty_PRO100006");
            elm.onkeyup = createValidator(elm);

            </script>
            <!-- qty -->
          @endforeach

          <!-- delete cart -->
          <script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
                                $("#deletecartPRO100006").click(function(){

              var kode_produk = 'PRO100006';
              var no_pemesanan = 'PYM52369';

              //alert(kode_produk+' '+no_pemesanan);
              $.ajax({
                      type: "POST",
                      url : "https://store1.johanwahyudi.com/cart/delete_cart",
                      data: "kode_produk="+kode_produk+
                            "&no_pemesanan="+no_pemesanan,
                      beforeSend: function() {
                          // setting a timeout
                          $.LoadingOverlay("show");
                      },
                      success: function(msg){
                        location.reload();
                      }
                });

            });
                            });
          </script>
          <!-- delete cart -->

          </tbody>
        </table>
      </fieldset>
    </form>
  </div>
@endsection

@section('shopcart')
  <div class="cart-collaterals row  wow bounceInUp animated">
    <div class="col-sm-4"></div>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <div class="totals">
        <h3>Shopping Cart Total</h3>
        <?php
          $no_pemesanan = Session::get('no_pemesanan');
          $get_pemesanan = DB::table('pemesanan')->where('no_pemesanan', $no_pemesanan)->first();
          $get_subtotal = $get_pemesanan->subtotal;
          $get_grandtotal = $get_pemesanan->grandtotal;

        ?>
        <div class="inner">
          <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
            <colgroup>
            <col>
            <col width="1">
            </colgroup>
            <tfoot>
              <tr>
                <td class="a-left" colspan="1"><strong>Order Total</strong></td>
                <td class="a-right"><strong><span class="price"><?php echo 'Rp'.number_format($get_subtotal,0,',','.'); ?></span></strong></td>
              </tr>
            </tfoot>
          </table>
          <form role="form" method="post" id="checkoutform">
          @csrf
          <input type="hidden" name="kurir" value="none">
          <input type="hidden" name="paket" value="none">
          <input type="hidden" name="biaya" value="0">
          <input type="hidden" name="diskon" value="0">
          <input type="hidden" name="subtotal" value="<?php echo $get_subtotal; ?>">
          <input type="hidden" name="total" value="<?php echo $get_subtotal; ?>">
          <ul class="checkout">
            <li>
              <button type="button" id="sendcheckout" title="Proceed to Checkout" class="button btn-proceed-checkout"><span>Lanjutkan Checkout</span></button>
            </li>
            <br>
          </ul>
          </form>
        </div>
        <!--inner-->
      </div>
      <!--totals-->
    </div>
    <!--cart-collaterals-->
  </div>
@endsection

@section('scriptcheckout')
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
@endsection
