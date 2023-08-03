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

  <!-- Body main wrapper start -->
  <div class="wrapper">

      <!-- START HEADER AREA -->
      @include('web.components.header')
      <!-- END HEADER AREA -->

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

      <!-- BREADCRUMBS SETCTION START -->
        <div class="breadcrumbs-section plr-200 mb-80 section">
            <div class="breadcrumbs overlay-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumbs-inner">
                                <h1 class="breadcrumbs-title">Brand : {{ $brand }}</h1>
                                <ul class="breadcrumb-list">
                                    <li><a href="/home">Home</a></li>
                                    <li>Brand</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BREADCRUMBS SETCTION END -->

      <!-- Start page content -->
      <div id="page-content" class="page-wrapper section">

            <!-- SHOP SECTION START -->
            <div class="shop-section mb-80">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 order-lg-2 order-1">
                            <div class="shop-content">

                                <!-- Tab Content start -->
                                <div class="tab-content">
                                    <!-- grid-view -->
                                    <div id="grid-view" class="tab-pane active show" role="tabpanel">
                                        <div class="row" id="itemContainer">
                                            <!-- product-item start -->
                                            @csrf
                                            <?php if($ceksearch){ ?>
                                            @foreach ($search as $result)
                                            <?php
                                            $kategori = $result->kategoriproduk_id;
                                            $product = DB::table('kategoriproduk')->where('id', $kategori)->first();
                                            $namaKategori = $product->nama;
                                            $slug = $product->slug;
                                            ?>
                                            <div class="col-lg-4 col-md-6">
                                                <div class="product-item">
                                                    <div class="product-img">
                                                        <a href="{{ URL::to($result->slug) }}">
                                                            <img src="{{asset('assets/product/'.$result->gambar1)}}" alt=""/>
                                                        </a>
                                                    </div>
                                                    <div class="product-info">
                                                        <h6 class="product-title">
                                                            <a href="{{ URL::to($result->slug) }}">{{ $result->nama }}</a>
                                                        </h6>
                                                        {{-- <div class="pro-rating">
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star-half"></i></a>
                                                            <a href="#"><i class="zmdi zmdi-star-outline"></i></a>
                                                        </div> --}}
                                                        <h3 class="pro-price">Rp {{ number_format($result->harga) }}</h3>
                                                        <ul class="action-button">
                                                            {{-- <li>
                                                                <a href="#" title="Wishlist"><i class="zmdi zmdi-favorite"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#" data-toggle="modal"  data-target="#productModal" title="Quickview"><i class="zmdi zmdi-zoom-in"></i></a>
                                                            </li>
                                                            <li>
                                                                <a href="#" title="Compare"><i class="zmdi zmdi-refresh"></i></a>
                                                            </li> --}}
                                                            <li>
                                                                <a href="{{ URL::to($result->slug) }}" title="Detail"><i
                                                                        class="zmdi zmdi-zoom-in"></i></a>
                                                            </li>

                                                          <?php
                                                            $email = Session::get('email');
                                                            if($email){
                                                          ?>
                                                          <li><a href="javascript:;" id="keranjang1{{ $result->id }}" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></li>
                                                          <?php
                                                            }else{
                                                              $segmen = Request::segment(1);
                                                              if($segmen){
                                                              ?>
                                                              <li><a href="/loginsegmen/{{ Request::segment(1) }}" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></li>
                                                              <?php }else{ ?>
                                                                <li><a href="/login" title="Add to cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a></li>
                                                              <?php } ?>
                                                          <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <?php }else{ echo "Data tidak ditemukan";} ?>
                                            <!-- product-item end -->
                                        </div>
                                    </div>
                                    <!-- list-view -->
                                </div>
                                <!-- Tab Content end -->
                                <!-- shop-pagination start -->
                                <div class="shop-pagination box-shadow text-center ptblr-10-30">
                                    <div class="holder" style="text-align: center;"></div>
                                </div>
                                <!-- shop-pagination end -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- SHOP SECTION END -->

        </div>
      <!-- End page content -->

      <!-- START FOOTER AREA -->
      @include('web.components.footer')
      <!-- END FOOTER AREA -->

  </div>
  <!-- Body main wrapper end -->

@endsection
