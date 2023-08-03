@extends('layouts.front.layout')

@section('best_seller')
  <section class="main-container col1-layout home-content-container">
    <div class="container">
      <div class="std">
        <div class="best-seller-pro wow bounceInUp animated">
          <div class="slider-items-products">
            <div class="new_title center">
              <h2>Rekomendasi Produk</h2>
            </div>
            <div id="best-seller-slider" class="product-flexslider hidden-buttons">
              <div class="slider-items slider-width-col4">
                @foreach ($product as $result)
                <!-- Item -->
                <div class="item">
                  <div class="col-item">
                    {{-- <div class="sale-label sale-top-right">Sale</div> --}}
                    <div class="product-image-area"> <a class="product-image" title="Sample Product" href="product_detail.html"> <img src="{{asset('assets/product/'.$result->gambar1)}}" class="img-responsive" alt="product-image" /> </a>
                      <div class="hover_fly"> <a class="exclusive ajax_add_to_cart_button" href="#" title="Add to cart">
                        <div><i class="icon-shopping-cart"></i><span>Add to cart</span></div>
                        </a> <a class="quick-view" href="quick_view.html">
                        <div><i class="icon-eye-open"></i><span>Quick view</span></div>
                        </a> <a class="add_to_compare" href="compare.html">
                        <div><i class="icon-random"></i><span>Add to compare</span></div>
                        </a> <a class="addToWishlist wishlistProd_5" href="wishlist.html" >
                        <div><i class="icon-heart"></i><span>Add to Wishlist</span></div>
                        </a> </div>
                    </div>
                    <div class="info">
                      <div class="info-inner">
                        <div class="item-title"> <a title=" Sample Product" href="{{ $result->slug }}"> {{ $result->nama }} </a> </div>
                        <!--item-title-->
                        <div class="item-content">
                          <div class="ratings">
                            <div class="rating-box">
                              <div class="rating"></div>
                            </div>
                          </div>
                          <div class="price-box">
                            <p class="special-price"> <span class="price"> $45.00 </span> </p>
                            <p class="old-price"> <span class="price-sep">-</span> <span class="price"> $50.00 </span> </p>
                          </div>
                        </div>
                        <!--item-content-->
                      </div>
                      <!--info-inner-->

                      <div class="clearfix"> </div>
                    </div>
                  </div>
                </div>
                <!-- End Item -->
                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
