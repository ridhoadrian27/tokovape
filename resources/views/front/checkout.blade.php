@extends('layouts.front.checkout')
@section('header', 'Keranjang Belanja')

@section('checkoutcart')
  <div class="cart wow bounceInUp animated">
    <div class="page-title">
      <h2>Shopping Cart</h2>
    </div>

    <!-- tabel -->
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
              </tr>
            </thead>
            <tbody>
              <tr class="first odd">
                <td class="image">
                  <a class="product-image" title="Sample Product 4" href="javascript:;"><img width="75" alt="Sample Product 4" src="https://store1.johanwahyudi.com/store/uploads/product4.jpg" style="width: 100px;"></a>
                </td>
                <td>
                  <h2 class="product-name"> <a href="javascript:;">Sample Product 4</a> </h2>
                  <br>
                </td>
                <td class="a-right">
                  <span class="cart-price"> <span class="price">Rp10,000</span></span>
                </td>
                <td class="a-center movewishlist">
                  1                      </td>
                  <td class="a-right movewishlist">
                    <span class="cart-price"> <span class="price">Rp10,000</span></span>
                  </td>
                </tr>


              </tbody>
            </table>
          </fieldset>
        </form>
      </div>
      <!-- tabel -->
    </div>
  @endsection

  @section('checkoutpembeli')
    <?php
    $kode = 'M100012';
    $detail_member = DB::table('member')->where('kode_member', $kode)->first();
    $get_nama = $detail_member->nama;
    $get_email = $detail_member->email;
    $get_telepon = $detail_member->telepon;
    ?>
    <div class="col-sm-6">
      <div class="shipping">
        <h3>Detail Pembeli</h3>
        <div class="shipping-form">
          <form id="shipping-zip-form" method="post" action="#">
            <ul class="form-list">
              <li>
                <label for="postcode">Nama</label>
                <div class="input-box">
                  <input type="text" name="namapen1" id="namapen1" value="{{ $get_nama }}" class="input-text validate-postcode">
                </div>
              </li>
              <li>
                <label for="postcode">Email</label>
                <div class="input-box">
                  <input type="text" name="emailpen1" id="emailpen1" value="{{ $get_email }}" class="input-text validate-postcode">
                </div>
              </li>
              <li>
                <label for="postcode">Telepon</label>
                <div class="input-box">
                  <input type="text" name="teleponpen1" id="teleponpen1" value="{{ $get_telepon }}" class="input-text validate-postcode">
                </div>
              </li>
            </ul>
            <!-- <div class="buttons-set11">
            <button class="button get-quote" onclick="coShippingMethodForm.submit()" title="Get a Quote" type="button"><span>Get a Quote</span></button>
          </div> -->
          <!--buttons-set11-->
        </form>
      </div>
    </div>
  </div>
@endsection

@section('checkouttotal')
  <div class="col-sm-6">
    <div class="totals">
      <h3>Shopping Cart Total</h3>
      <?php
      $kode = 'M100012';
      $detail_member = DB::table('member')->where('kode_member', $kode)->first();
      $get_nama = $detail_member->nama;
      $get_email = $detail_member->email;
      $get_telepon = $detail_member->telepon;
      ?>
      <form role="form" method="post" id="paymentform">
      @csrf
      <input type="text" name="namapen" id="namapen" value="{{ $get_nama }}" class="input-text validate-postcode" hidden>
      <input type="text" name="emailpen" id="emailpen" value="{{ $get_email }}" class="input-text validate-postcode" hidden>
      <input type="text" name="teleponpen" id="teleponpen" value="{{ $get_telepon }}" class="input-text validate-postcode" hidden>
      <div class="inner">
        <table id="shopping-cart-totals-table" class="table shopping-cart-table-total">
          <colgroup>
            <col>
            <col width="1">
          </colgroup>
          <tfoot>
            <tr>
              <td class="a-left"><strong>Order Total</strong></td>
              <td class="a-right"><strong><span class="price">Rp10.000</span></strong></td>
            </tr>

            <tr>
              <td class="a-left"><strong>Alamat Pengiriman</strong></td>
              <td class="a-right">

                <?php
                $kode_member = 'M100005';
                $defalamat = DB::table('alamat')->where('kode_member', $kode_member)->orderBy('id_alamat', 'asc')->first();
                $id_alamat = $defalamat->id_alamat;
                ?>
                <select name="alamatalternatif" id="alamatalternatif" class="form-control">
                  <option value="0">Pilih Alamat Pengiriman</option>
                  <?php
                  $data_alamat = DB::table('alamat')->where('kode_member', $kode_member)->get();
                  ?>
                  @foreach ($data_alamat as $result)
                    <option value="{{ $result->id_alamat }}"
                      @if ($id_alamat == $result->id_alamat) selected @endif >{{ $result->nama_alamat }}</option>
                      @endforeach
                    </select>

                    <div id="row_alamat"></div>
                    <div>
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">Tambah Alamat</button>
                    </div>
                    <div class="loader" id="spinner">Loading...</div>

                    <!-- script -->
                    <script type="text/javascript">
                    $(document).ready(function() {

                      //$("#spinner").hide();
                      //$("#alamatalternatif").change(function(){
                      var alamatalternatif = $("#alamatalternatif").val();
                      //alert(propinsi);
                      if(alamatalternatif=='0'){ $("#row_alamat").hide(); }else{

                        $.ajax({
                          type: "GET",
                          url : "/alamat/"+alamatalternatif,
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

                        // $.ajax({
                        //   type: "POST",
                        //   url : "https://store1.johanwahyudi.com/member/alamat_alternatif",
                        //   data: "alamatalternatif="+alamatalternatif,
                        //   beforeSend: function() {
                        //     // setting a timeout
                        //     $("#row_alamat").hide();
                        //     $("#spinner").show();
                        //   },
                        //   success: function(msg){
                        //     $("#spinner").hide();
                        //     $("#row_alamat").show();
                        //     $('#row_alamat').html(msg);
                        //   }
                        // });

                      }

                      //});

                      $("#alamatalternatif").change(function(){
                        var alamatalternatif = $("#alamatalternatif").val();
                        //alert(propinsi);
                        if(alamatalternatif=='0'){ $("#row_alamat").hide(); }else{

                          $.ajax({
                            type: "GET",
                            url : "/alamat/"+alamatalternatif,
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

                          // $.ajax({
                          //   type: "POST",
                          //   url : "https://store1.johanwahyudi.com/member/alamat_alternatif",
                          //   data: "alamatalternatif="+alamatalternatif,
                          //   beforeSend: function() {
                          //     // setting a timeout
                          //     $("#row_alamat").hide();
                          //     $("#spinner").show();
                          //   },
                          //   success: function(msg){
                          //     $("#spinner").hide();
                          //     $("#row_alamat").show();
                          //     $('#row_alamat').html(msg);
                          //   }
                          // });

                        }

                      });

                    });
                    </script>
                    <!-- script -->
                  </td>
                </tr>
                <tr>
                  <td class="a-left"><strong>Shipping</strong></td>
                  <td class="a-right">
                    <select title="kota" class="form-control" name="jenis_kurir" id="jenis_kurir">
                      <option value='0'>-- Pilih Pengiriman --</option>
                    </select>
                    <div class="loader" id="spinner2">Loading...</div>
                    <!-- script -->
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

                      var origin = '151';
                      var idalamat = $("#alamatalternatif").val();
                      //var weight = '0';
                      var weight = '10000';
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
                          $("#jenis_kurir").show();
                          $('#jenis_kurir').html(data.html);
                        }
                      });

                      // $.ajax({
                      //   type: "POST",
                      //   url : "https://store1.johanwahyudi.com/member/kurir",
                      //   data: "origin="+origin+
                      //   "&idalamat="+idalamat+
                      //   "&weight="+weight+
                      //   "&jne="+jne+
                      //   "&tiki="+tiki+
                      //   "&pos="+pos+
                      //   "&jnt="+jnt,
                      //   beforeSend: function() {
                      //     // setting a timeout
                      //     $("#jenis_kurir").hide();
                      //     $("#spinner2").show();
                      //   },
                      //   success: function(msg){
                      //     $("#spinner2").hide();
                      //     $("#jenis_kurir").show();
                      //     $('#jenis_kurir').html(msg);
                      //   }
                      //
                      // });

                      $("#jenis_kurir").change(function(){

                        var nilai=$(this).find('option:selected').val();
                        //alert(nilai);

                        var promo = $("#pot_promo").val();
                        var propinsi = $("#data_propinsi").val();
                        var kota = $("#data_kota").val();
                        var kurir2 = $("#jenis_kurir").val();
                        var url = kurir2;
                        var explode = url.split('-');
                        var kurir = explode[0];
                        var paket = explode[1];
                        var biaya = explode[2];
                        //alert(biaya);
                        //var kurir_lain = $("#kurir_lain").val();
                        var total2 = '10000';
                        //alert(total2);

                        var jumlah2 = parseInt(biaya)+parseInt(total2);
                        //alert(jumlah2);

                        // if(nilai){

                        var jumlah_promo = jumlah2*promo/100;
                        //alert(jumlah_promo);
                        var total_semua = jumlah2;
                        //alert(total_semua);
                        $("#grand_total").val("Rp"+addCommas(total_semua));
                        $("#grand_total2").val(total_semua);

                        // }else{

                        //     $("#grand_total").val("Rp"+addCommas(total2));

                        // }

                      });

                    });
                    </script>
                    <!-- script -->
                  </td>
                </tr>
                <tr>
                  <td class="a-left" style="width: 50%;"><strong>Total</strong></td>
                  <td class="a-right">
                    <input type="text" class="form-control" name="grand_total" id="grand_total" value="Rp10.000" readonly="readonly"/>
                    <input type="text" name="grand_total2" id="grand_total2" hidden/>
                  </td>
                </tr>

              </tfoot>
        </table>
        <ul class="checkout">
          <li>
            <button title="Proceed to Checkout" class="button btn-proceed-checkout" type="button" id="modalpembayaran"><span>Lanjutkan Pembayaran</span></button>
          </li>
          <br>
        </ul>
      </div>
      </form>
      <!--inner-->
    </div>
    <!--totals-->
  </div>
@endsection

@section('paymentmanual')

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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pilih Pembayaran</h4>
        </div>
        <div class="modal-body">
          <!--<button class="btn" data-toggle="modal" data-target="#myModal3" id="modal3">Modal 3</button>-->
          <ul class="list-group">
            <li class="list-group-item" style="background-color:#eae8e8;">Transfer Bank</li>
            <?php
            $databank  = DB::table('rekening')
            ->join('bank', 'rekening.bank', '=', 'bank.id_bank')
            ->select('bank.id_bank', 'bank.gambar')
            ->get();
            ?>
            @foreach ($databank as $i)
              <li class="list-group-item">
                <a href="javascript:;" style="display:block;" id="manual{{ $i->id_bank }}"><img style="max-width:70px; display:inline;" class="img-responsive" src="{{asset('assets/bank/'.$i->gambar)}}"></a>
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
    ->select('bank.id_bank', 'bank.gambar')
    ->get();
    ?>
    @foreach ($databank as $i)
    $("#rekening{{ $i->id_bank }}").keypress(function(data){
      if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
      {
        return false;
      }
    });

    $("#manual{{ $i->id_bank }}").click(function(){
      // var bank = $("#namabank").val();
      // var rekening = $("#rekening").val();
      // var nama = $("#nama").val();
      var dataform = $("#paymentform").serialize();
      var token = $("input[name='_token']").val();
      var bank_tujuan = '{{ $i->id_bank }}';
      var namapen = $("#namapen").val();
      var emailpen = $("#emailpen").val();
      var teleponpen = $("#teleponpen").val();
      var alamatalternatif = $("#alamatalternatif").val();
      var detailkurir = $("#jenis_kurir").val();
      var url = detailkurir;
      var explode = url.split('-');
      var kurir = explode[0];
      var paket = explode[1];
      var biaya = explode[2];
      var promo = $("#promo").val();
      var total = $("#grand_total{{ $i->id_bank }}").val();
      // alert(kurir);
      // alert(paket);
      // alert(biaya);
      // alert(total);
      // alert(detailkurir);

      $.ajax({
        type: "POST",
        url : "/payment",
        data: dataform,
        beforeSend: function() {
          // setting a timeout
          //$.LoadingOverlay("show");
        },
        success: function(msg){

            document.location.href="/thankyou";

        }
      });

    });

    @endforeach

  });
  </script>

  <script>
  var widget1;
  var response;
  var onloadCallback = function() {
    widget1 = grecaptcha.render('my-recaptcha-placeholder', {
      'sitekey' : '6LdoSwsUAAAAALSrorV56kpampIDD73WQfw370vv'
    });
  };

  function setPaymentInfo(isChecked)
  {
    var namapem = $("#namapem").val();
    var emailpem = $("#emailpem").val();
    var alamatpem = $("#alamatpem").val();
    var telponpem = $("#telponpem").val();
    var propinsipem = $("#propinsipem").val();
    var kotapem = $("#kotapem").val();
    var kodepospem = $("#kodepospem").val();

    var namapen = $("#namapen").val();
    var emailpen = $("#emailpen").val();
    var alamatpen = $("#alamatpen").val();
    var telponpen = $("#telponpen").val();
    var propinsipen = $("#propinsipen").val();
    var kotapen = $("#kotapen").val();
    var kodepospen = $("#kodepospen").val();

    if (isChecked) {
      $("#namapen").val(namapem);
      $("#emailpen").val(emailpem);
      $("#alamatpen").val(alamatpem);
      $("#telponpen").val(telponpem);
      $("#propinsipen").val(propinsipem);
      $("#kotapen").val(kotapem);
      $("#kodepospen").val(kodepospem);

    } else {
      $("#namapen").val('');
      $("#emailpen").val('');
      $("#alamatpen").val('');
      $("#telponpen").val('');
      $("#propinsipen").val('');
      $("#kotapen").val('');
      $("#kodepospen").val('');
    }

  }

  function myFunction() {
    var namapen = $("#namapen").val();
    var emailpen = $("#emailpen").val();
    var alamatpen = $("#alamatpen").val();
    var telponpen = $("#telponpen").val();
    var propinsipen = $("#propinsipen").val();
    var kotapen = $("#kotapen").val();
    var kodepospen = $("#kodepospen").val();

    // if(namapen ==0){
    // alert('Maaf, Nama Penerima  tidak boleh kosong');
    // $("#namapen ").focus();
    // return false();
    // }

    // if(alamatpen==0){
    // alert('Maaf, Alamat Pengiriman tidak boleh kosong');
    // $("#alamatpen").focus();
    // return false();
    // }

    // if(telponpen==0){
    // alert('Maaf, Telepon Penerima tidak boleh kosong');
    // $("#telponpen").focus();
    // return false();
    // }

    //response = grecaptcha.getResponse(widget1);
    //if(response){
    //alert('Berhasil');
    // document.reload();
    $("#loading").attr('hidden',false);
    document.getElementById("mycheckout").submit();
    //}else {
    //alert('Captcha tidak boleh kosong!');
    // }


  }
  </script>
@endsection
