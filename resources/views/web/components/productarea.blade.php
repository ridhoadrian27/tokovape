<!--Product Area Start-->
<div class="product-area mt-text-2">
    <div class="container custom-area-2 overflow-hidden">
        <div class="row">
            <!--Section Title Start-->
            <div class="col-12 col-custom">
                <div class="section-title text-center">
                    {{-- <span class="section-title-1">Wonderful gift</span> --}}
                    <h3 class="section-title-3">Our Products</h3>
                </div>
            </div>
            <!--Section Title End-->
        </div>
        <div class="shop-main-area">
            <div class="container container-default custom-area">
                <div class="row flex-row-reverse">
                    <div class="col-12 col-custom" style="margin-top: 50px;">
                        <!-- Shop Wrapper Start -->
                        <div class="row shop_wrapper grid_4">
                          <?php $dataproduct = DB::table('produk')->limit(8)->get(); ?>
                          @foreach ($dataproduct as $result)
                          <?php
                            $kategori = $result->kategoriproduk_id;
                            $product = DB::table('kategoriproduk')->where('id', $kategori)->first();
                            $namaKategori = $product->nama;
                            $slug = $product->slug;
                          ?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6  col-custom product-area">
                                <div class="product-item">
                                    <div class="single-product position-relative mr-0 ml-0">
                                        <div class="product-image">
                                            <a class="d-block" href="{{ $result->slug }}">
                                                <img src="{{asset('assets/product/'.$result->gambar1)}}" alt="" class="product-image-1 w-100">
                                                <img src="{{asset('assets/product/'.$result->gambar2)}}" alt="" class="product-image-2 position-absolute w-100">
                                            </a>
                                            {{-- <span class="onsale">Sale!</span>
                                            <div class="add-action d-flex flex-column position-absolute">
                                                <a href="compare.html" title="Compare">
                                                    <i class="lnr lnr-sync" data-toggle="tooltip" data-placement="left" title="Compare"></i>
                                                </a>
                                                <a href="wishlist.html" title="Add To Wishlist">
                                                    <i class="lnr lnr-heart" data-toggle="tooltip" data-placement="left" title="Wishlist"></i>
                                                </a>
                                                <a href="#exampleModalCenter" title="Quick View" data-toggle="modal" data-target="#exampleModalCenter">
                                                    <i class="lnr lnr-eye" data-toggle="tooltip" data-placement="left" title="Quick View"></i>
                                                </a>
                                            </div> --}}
                                        </div>
                                        <div class="product-content">
                                            <div class="product-title">
                                                <h4 class="title-2"> <a href="{{ $result->slug }}">{{ $result->nama }}</a></h4>
                                            </div>
                                            {{-- <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div> --}}
                                            <div class="price-box">
                                                <span class="regular-price ">Rp {{ number_format($result->harga) }}</span>
                                                {{-- <span class="old-price"><del>$70.00</del></span> --}}
                                            </div>
                                            <a href="{{ $result->slug }}" class="btn product-cart">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                        </div>
                        <!-- Shop Wrapper End -->
                        <!-- Bottom Toolbar Start -->
                        <div class="row">
                            <div class="col-sm-12 col-custom" style="text-align: center; margin-bottom: 50px;">
                                <a href="/products" class="btn flosun-button  secondary-btn theme-color rounded-0">All Products</a>
                            </div>
                        </div>
                        <!-- Bottom Toolbar End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Product Area End-->
