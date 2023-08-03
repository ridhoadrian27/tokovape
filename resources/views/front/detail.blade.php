@extends('layouts.front.detail')
@section('header', 'Judul')

@section('gambarUtama')
  <a href="{{asset('frontend/products-images/product4.jpg')}}" class="cloud-zoom" id="zoom1" rel="useWrapper: false, adjustY:0, adjustX:20">
    <img src="{{asset('frontend/products-images/product4.jpg')}}" alt="thumbnail">
  </a>
@endsection

@section('sliderGambar')
  <ul class="previews-list slides">
    <li><a href="{{asset('frontend/products-images/product6.jpg')}}" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '{{asset("frontend/products-images/product6.jpg")}}' "><img src="{{asset('frontend/products-images/product6.jpg')}}" alt = "Thumbnail 1"/></a></li>
    <li><a href="{{asset('frontend/products-images/product10.jpg')}}" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '{{asset("frontend/products-images/product10.jpg")}}' "><img src="{{asset('frontend/products-images/product10.jpg')}}" alt = "Thumbnail 2"/></a></li>
    <li><a href="{{asset('frontend/products-images/product3.jpg')}}" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '{{asset("frontend/products-images/product3.jpg")}}' "><img src="{{asset('frontend/products-images/product3.jpg')}}" alt = "Thumbnail 1"/></a></li>
    <li><a href="{{asset('frontend/products-images/product4.jpg')}}" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '{{asset("frontend/products-images/product4.jpg")}}' "><img src="{{asset('frontend/products-images/product4.jpg')}}" alt = "Thumbnail 2"/></a></li>
    <li><a href="{{asset('frontend/products-images/product5.jpg')}}" class='cloud-zoom-gallery' rel="useZoom: 'zoom1', smallImage: '{{asset("frontend/products-images/product5.jpg")}}' "><img src="{{asset('frontend/products-images/product5.jpg')}}" alt = "Thumbnail 2"/></a></li>
  </ul>
@endsection

@section('namaProduk')
  @foreach ($product as $result) {{ $result->nama }} @endforeach
@endsection

@section('addtocart')
<form role="form" method="post" id="updateform">
  @csrf
  @foreach ($product as $result)
  <div class="add-to-box">
    <div class="add-to-cart">
      <label for="qty">Quantity: {{ Session::get('no_pemesanan') }}</label>
      <div class="pull-left">
        <div class="custom pull-left">
          <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon-minus">&nbsp;</i></button>
          <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty">
          <input type="hidden" name="idProduk" value="{{ $result->id }}">
          <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="icon-plus">&nbsp;</i></button>
        </div>
      </div>
      <button id="submit" class="button btn-cart" title="Add to Cart" type="button"><span><i class="icon-basket"></i> Add to Cart</span></button>
      <div class="email-addto-box">
        <ul class="add-to-links">
          <li> <a class="link-wishlist" href="#"><span>Add to Wishlist</span></a></li>
          <li><span class="separator">|</span> <a class="link-compare" href="#"><span>Add to Compare</span></a></li>
        </ul>
        <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p>
      </div>
    </div>
  </div>
  @endforeach
</form>
@endsection

@section('scriptcart')
  <script type="text/javascript">
    $(document).ready(function() {

        $("#submit").click(function(){

        var dataform = $("#updateform").serialize();
        //tinymce.triggerSave();
        var token = $("input[name='_token']").val();
        var qty = $("#qty").val();

        if(qty.length == 0){
          alert("Maaf, Jumlah tidak boleh kosong");
          $("#qty").focus();
          return (false);
        }

        $.ajax({
          type: "POST",
          url : "/cartadd",
          data: dataform,
          beforeSend: function() {
            $.LoadingOverlay("show");
          },
          success: function(msg){
            document.location.href="/cart";
          }
        });

      });

    });
  </script>
@endsection
