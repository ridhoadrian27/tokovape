<?php
  $no_pemesanan = Session::get('no_pemesanan');
  $jumlahPemesanan  = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->count();
  if($jumlahPemesanan){
    $val_jumlah = $jumlahPemesanan;
  }else{
    $val_jumlah = '0';
  }
?>
<div class="total-cart-in">
  <div class="cart-toggler">
    <a href="{{route('cart')}}">
      <span class="cart-quantity">{{ $val_jumlah }}</span><br>
      <span class="cart-icon">
        <i class="zmdi zmdi-shopping-cart-plus"></i>
      </span>
    </a>
  </div>
</div>
