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

  @include('web.components.header')

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
		<section class="page-content">
			<!-- PAGE-BANNER START -->
			<div class="page-banner-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-banner-menu">
								<h2 class="page-banner-title">{{ $namaKategori }}</h2>
								<ul>
									<li><a href="/home">home</a></li>
									<li>{{ $namaKategori }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PAGE-BANNER END -->
			<!-- SHOP-AREA START -->
			<div class="shop-area margin-bottom-80">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<span class="shop-border"></span>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
							<!-- widget-categories start -->
							<aside class="widget widget-categories">
								<h5>categories</h5>
								<ul>
                  <?php $datakategori = DB::table('kategoriproduk')->get(); ?>
                  @foreach ($datakategori as $result)
                  <li><a href="/kategori/{{ $result->slug }}">{{ $result->nama }}</a></li>
                  @endforeach
								</ul>
							</aside>
							<!-- widget-categories end -->
						</div>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
							<!-- Shop-Content start -->
							<div class="shop-content">
                <!-- product-toolbar start -->
								<div class="product-toolbar">
									<!-- pagination -->
									{{-- <div>
										<div class="holder" style="text-align: center;"></div>
									</div> --}}
								</div>
								<!-- product-toolbar end -->

								<!-- Shop-product start -->
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="grid-view">
										<div class="row shop-grid" id="itemContainer">
											<!-- Single-product start -->
                      <?php if($ceksearch){ ?>
                        @foreach ($search as $result)
                        <?php
                        $kategori = $result->kategoriproduk_id;
                        $product = DB::table('kategoriproduk')->where('id', $kategori)->first();
                        $namaKategori = $product->nama;
                        $slug = $product->slug;
                      ?>
											<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
												<div class="single-product">
													<div class="product-photo">
														<a href="{{ URL::to($result->slug) }}">
															<img class="primary-photo" src="{{asset('assets/product/'.$result->gambar1)}}" alt="" />
															<img class="secondary-photo" src="{{asset('assets/product/'.$result->gambar1)}}" alt="" />
														</a>
														{{-- <div class="pro-action">
															<a href="#" class="action-btn"><i class="sp-heart"></i><span>Wishlist</span></a>
															<a href="#" class="action-btn"><i class="sp-shopping-cart"></i><span>Add to cart</span></a>
															<a href="#" class="action-btn"><i class="sp-compare-alt"></i><span>Compare</span></a>
														</div> --}}
													</div>
													<div class="product-brief">
														<h2><a href="{{ URL::to($result->slug) }}">{{ $result->nama }}</a></h2>
														<h3>Rp {{ number_format($result->harga) }}</h3>
													</div>
												</div>
											</div>
                      @endforeach
                      <?php }else{ echo "Data tidak ditemukan";} ?>
                      <!-- Single-product end -->
										</div>
									</div>
								</div>
								<!-- Shop-product end -->
                <div class="product-toolbar">
									<!-- pagination -->
									<div>
										<div class="holder" style="text-align: center;"></div>
									</div>
								</div>

							</div>
							<!-- Shop-Content end -->
						</div>
					</div>
				</div>
			</div>
			<!-- SHOP-AREA END -->

		</section>
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer')

@endsection
