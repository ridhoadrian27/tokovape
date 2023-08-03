@extends('layouts.web')

<?php $seo = DB::table('seo')->where('id_seo', '1')->first(); ?>
@section('title')
  {{ $seo->title ? $seo->title : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('description')
  {{ $seo->deskripsi ? $seo->deskripsi : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('keyword')
  {{ $seo->keyword ? $seo->keyword : 'Jasa Pembuatan Website | websitetangguh.com' }}
@endsection

@section('content')

  @include('web.components.header2')

  <!-- PAGE-CONTENT START -->
  <!-- Breadcrumb Area Start Here -->
  <div class="breadcrumbs-area position-relative">
      <div class="container">
          <div class="row">
              <div class="col-12 text-center">
                  <div class="breadcrumb-content position-relative section-content">
                      <h3 class="title-3">Product Details</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Product Details</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- Single Product Main Area Start -->
  <div class="single-product-main-area">
      <div class="container container-default custom-area">
          <div class="row">
              <div class="col-lg-5 offset-lg-0 col-md-8 offset-md-2 col-custom">
                  <div class="product-details-img">
                      <div class="single-product-img swiper-container gallery-top popup-gallery">
                          <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                  <a class="w-100" href="{{asset('assets/product/'.$product->gambar1)}}">
                                      <img class="w-100" src="{{asset('assets/product/'.$product->gambar1)}}" alt="Product">
                                  </a>
                              </div>
                              <div class="swiper-slide">
                                  <a class="w-100" href="{{asset('assets/product/'.$product->gambar2)}}">
                                      <img class="w-100" src="{{asset('assets/product/'.$product->gambar2)}}" alt="Product">
                                  </a>
                              </div>
                              <div class="swiper-slide">
                                  <a class="w-100" href="{{asset('assets/product/'.$product->gambar3)}}">
                                      <img class="w-100" src="{{asset('assets/product/'.$product->gambar3)}}" alt="Product">
                                  </a>
                              </div>
                              <div class="swiper-slide">
                                  <a class="w-100" href="{{asset('assets/product/'.$product->gambar4)}}">
                                      <img class="w-100" src="{{asset('assets/product/'.$product->gambar4)}}" alt="Product">
                                  </a>
                              </div>
                          </div>
                      </div>
                      <div class="single-product-thumb swiper-container gallery-thumbs">
                          {{-- <div class="swiper-wrapper">
                              <div class="swiper-slide">
                                  <img src="{{asset('assets/product/'.$product->gambar1)}}" alt="Product">
                              </div>
                              <div class="swiper-slide">
                                  <img src="{{asset('assets/product/'.$product->gambar2)}}" alt="Product">
                              </div>
                              <div class="swiper-slide">
                                  <img src="{{asset('assets/product/'.$product->gambar3)}}" alt="Product">
                              </div>
                              <div class="swiper-slide">
                                  <img src="{{asset('assets/product/'.$product->gambar4)}}" alt="Product">
                              </div>
                          </div> --}}
                          <!-- Add Arrows -->
                          <div class="swiper-button-next swiper-button-white"><i class="lnr lnr-arrow-right"></i></div>
                          <div class="swiper-button-prev swiper-button-white"><i class="lnr lnr-arrow-left"></i></div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-7 col-custom">
                  <div class="product-summery position-relative">
                      <div class="product-head mb-3">
                          <h2 class="product-title">{{ $product->nama }}</h2>
                      </div>
                      <div class="price-box mb-2">
                          <span class="regular-price">Rp {{ number_format($product->harga) }}</span>
                          {{-- <span class="old-price"><del>$90.00</del></span> --}}
                      </div>
                      {{-- <div class="product-rating mb-3">
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star-o"></i>
                          <i class="fa fa-star-o"></i>
                      </div> --}}
                      <div class="sku mb-3">
                          <span>Kode Produk: {{ $product->kode_produk }}</span>
                      </div>
                      <p class="desc-content mb-5">{!! $product->deskripsi1 !!}</p><br>
                      <form method="post" id="updateform">
                      <div class="quantity-with_btn mb-5">

                        @csrf
                        <input type="hidden" name="idProduk" value="{{ $product->id }}">
                          <div class="quantity">
                              <div class="cart-plus-minus">
                                  <input class="cart-plus-minus-box" value="1" type="text" id="qty" name="qty">
                                  <div class="dec qtybutton">-</div>
                                  <div class="inc qtybutton">+</div>
                              </div>
                          </div>
                          <div class="add-to_cart">
                              {{-- <a class="btn product-cart button-icon flosun-button dark-btn" href="cart.html">Add to cart</a> --}}
                              <?php
                                $email = Session::get('email');
                                if($email){
                              ?>
          										<a class="btn product-cart button-icon flosun-button dark-btn" href="javascript:;" id="submit">Add to cart</a>
                              <?php
                                }else{
                                  $segmen = Request::segment(1);
                                  if($segmen){
                                  ?>
                                  <a class="btn product-cart button-icon flosun-button dark-btn" href="/loginsegmen/{{ Request::segment(1) }}">Add to cart</a>
                                  <?php }else{ ?>
                                    <a class="btn product-cart button-icon flosun-button dark-btn" href="/login">Add to cart</a>
                                  <?php } ?>
                              <?php } ?>
                              {{-- <a class="btn flosun-button secondary-btn secondary-border rounded-0" href="wishlist.html">Add to wishlist</a> --}}
                          </div>
                      </div>
                      </form>
                      <script type="text/javascript">
                        $(document).ready(function() {
                            //alert('test');
                            //$.LoadingOverlay("show");
                            $("#submit").click(function(){

                            var dataform = $("#updateform").serialize();
                            //tinymce.triggerSave();
                            var token = $("input[name='_token']").val();
                            var qty = $("#qty").val();

                            if(qty <= 0){
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
                      <div class="social-share mb-4">
                          <span>Share :</span>
                          <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                          <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                          <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                          <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                      </div>
                      {{-- <div class="payment">
                          <a href="#"><img class="border" src="assets/images/payment/payment-icon.png" alt="Payment"></a>
                      </div> --}}
                  </div>
              </div>
          </div>
          {{-- <div class="row mt-no-text">
              <div class="col-lg-12 col-custom">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active text-uppercase" id="home-tab" data-toggle="tab" href="#connect-1" role="tab" aria-selected="true">Description</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-uppercase" id="profile-tab" data-toggle="tab" href="#connect-2" role="tab" aria-selected="false">Reviews</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-uppercase" id="contact-tab" data-toggle="tab" href="#connect-3" role="tab" aria-selected="false">Shipping Policy</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-uppercase" id="review-tab" data-toggle="tab" href="#connect-4" role="tab" aria-selected="false">Size Chart</a>
                      </li>
                  </ul>
                  <div class="tab-content mb-text" id="myTabContent">
                      <div class="tab-pane fade show active" id="connect-1" role="tabpanel" aria-labelledby="home-tab">
                          <div class="desc-content">
                              <p class="mb-3">{!! $product->deskripsi2 !!}</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div> --}}
      </div>
  </div>
  <!-- Single Product Main Area End -->
  <!--Product Area Start-->
  <!-- <div class="product-area mt-text-3">
      <div class="container custom-area-2 overflow-hidden">
          <div class="row">
              <div class="col-12 col-custom">
                  <div class="section-title text-center mb-30">
                      {{-- <span class="section-title-1">The Most Trendy</span> --}}
                      <h3 class="section-title-3">Related Product</h3>
                  </div>
              </div>
=          </div>
          <div class="row product-row">
              <div class="col-12 col-custom">
                  <div class="product-slider swiper-container anime-element-multi">
                      <div class="swiper-wrapper">
                        <?php
                        $id = $product->id;
                        $data_produk = DB::table('produk')->whereNotIn('id', [$id])->limit(5)->get();
                        ?> 

                        @foreach ($data_produk as $result)
                          <div class="single-item swiper-slide">
                              <div class="single-product position-relative mb-30">
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
                                          {{-- <span class="old-price"><del>$90.00</del></span> --}}
                                      </div>
                                      <a href="{{ $result->slug }}" class="btn product-cart">Detail</a>
                                  </div>
                              </div>
                          </div>
                        @endforeach
                      </div>
                      <div class="swiper-pagination default-pagination"></div>
                  </div>
              </div>
          </div>
      </div>
  </div> -->
  <!--Product Area End-->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
