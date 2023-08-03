<div class="product-area">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="section-title text-center">
          <h2 class="border-left-right-btm">New Product</h2>
        </div>
      </div>
    </div>
  </div>
  <div id="active-product" class="product-slider">
    <?php $dataproduct = DB::table('produk')->where('jenisproduk', '1')->limit(10)->get(); ?>
    @foreach ($dataproduct as $result)
    <?php
      $kategori = $result->kategoriproduk_id;
      $product = DB::table('kategoriproduk')->where('id', $kategori)->first();
      $namaKategori = $product->nama;
      $slug = $product->slug;
    ?>
    <!-- Single-product start -->
    <div class="single-product">
      <div class="product-photo">
        <a href="{{ $result->slug }}">
          <img class="primary-photo" src="{{asset('assets/product/'.$result->gambar1)}}" alt="" />
          <img class="secondary-photo" src="{{asset('assets/product/'.$result->gambar2)}}" alt="" />
        </a>
        {{-- <div class="pro-action">
          <a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
          <a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
          <a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
        </div> --}}
      </div>
      <div class="product-brief">
        {{-- <div class="pro-rating">
          <a href="#"><i class="sp-star rating-1"></i></a>
          <a href="#"><i class="sp-star rating-1"></i></a>
          <a href="#"><i class="sp-star rating-1"></i></a>
          <a href="#"><i class="sp-star rating-1"></i></a>
          <a href="#"><i class="sp-star rating-2"></i></a>
        </div> --}}
        <h2><a href="{{ $result->slug }}">{{ $result->nama }}</a></h2>
        <h3>Rp {{ number_format($result->harga) }}</h3>
      </div>
    </div>
    <!-- Single-product end -->
    @endforeach
  </div>
</div>
