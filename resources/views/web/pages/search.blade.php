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

  <!-- pagination -->
    <style type="text/css">
    .holder {
      margin: 15px 0;
    }
    .holder a {
      font-size: 12px;
      cursor: pointer;
      margin: 0 5px;
      color: #0088cc;
      background-color: white;
      border:solid 1px #dddddd;
      padding: 10px;
    }
    .holder a:hover {
      background-color: #dddddd;
      color: black;
      text-decoration: none;
    }
    .holder a.jp-current, a.jp-current:hover {
      color: #0088cc;
      font-weight: bold;
      cursor: default;
      background: white;
    }
    .holder span { margin: 0 5px; }
    .customBtns { position: relative; }
    .arrowPrev, .arrowNext { width:29px; height:29px; position: absolute; top: 55px; cursor: pointer; }
    .arrowPrev { background-image: url('img/back.gif'); left: -45px; }
    .arrowNext { background-image: url('img/next.gif'); right: -40px; }
    .arrowPrev.jp-disabled, .arrowNext.jp-disabled { display: none; }
    </style>
    <!-- pagination -->

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
                      <h3 class="title-3">Our Products</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Our Products</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- Shop Main Area Start Here -->
  <div class="shop-main-area">
      <div class="container container-default custom-area">
          <div class="row flex-row-reverse">
              <div class="col-12 col-custom widget-mt" id="itemContainer">

                  <!-- Shop Wrapper Start -->
                  <div class="row shop_wrapper grid_4">
                    <?php if($ceksearch){ ?>
                        @foreach ($search as $result)
                        <?php
                        $kategori = $result->kategoriproduk_id;
                        $product = DB::table('kategoriproduk')->where('id', $kategori)->first();
                        $namaKategori = $product->nama;
                        $slug = $product->slug;
                      ?>
                      <div class="col-lg-3 col-md-6 col-sm-6  col-custom product-area">
                          <div class="product-item">
                              <div class="single-product position-relative mr-0 ml-0">
                                  <div class="product-image">
                                      <a class="d-block" href="{{ $result->slug }}">
                                          <img src="{{asset('assets/product/'.$result->gambar1)}}" alt="" class="product-image-1 w-100">
                                          <img src="{{asset('assets/product/'.$result->gambar2)}}" alt="" class="product-image-2 position-absolute w-100">
                                      </a>
                                      {{-- <span class="onsale">Sale!</span> --}}
                                      {{-- <div class="add-action d-flex flex-column position-absolute">
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
                                          {{-- <span class="old-price"><del>Rp {{ number_format($result->harga) }}</del></span> --}}
                                      </div>
                                      <a href="{{ $result->slug }}" class="btn product-cart">Detail</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                    @endforeach
                    <?php }else{ echo "Data tidak ditemukan";} ?>
                  </div>
                  <!-- Shop Wrapper End -->
                  <!-- Bottom Toolbar Start -->
                  <div class="row">
                      <div class="col-sm-12 col-custom">
                          <div class="toolbar-bottom" style="display: block;">
                              <div class="holder" style="text-align: center;"></div>
                          </div>
                      </div>
                  </div>
                  <!-- Bottom Toolbar End -->
              </div>
          </div>
      </div>
  </div>
  <!-- Shop Main Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
