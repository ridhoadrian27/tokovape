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
  <!-- Blog Area Wrapper Start Here -->
  <div class="blog-area-wrapper">
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
                          <h3 class="title-3">{{ $page->nama }}</h3>
                          <ul>
                              <li><a href="/home">Home</a></li>
                              <li>{{ $page->nama }}</li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- Breadcrumb Area End Here -->
      <!-- Blog Main Area Start Here -->
      <div class="blog-main-area">
          <div class="container container-default custom-area">
              <div class="row">
                  <div class="col-12 col-custom widget-mt">
                      <!-- Blog Details wrapper Area Start -->
                      <div class="blog-post-details">
                        @if($page->gambar)
                          <figure class="blog-post-thumb mb-5">
                              <img src="{{asset('assets/page/'.$page->gambar)}}" alt="Blog Image">
                          </figure>
                        @endif
                          <section class="blog-post-wrapper product-summery">
                              <div class="section-content section-title">
                                  <h2 class="section-title-2 mb-3">{{ $page->nama }}</h2>
                                  <p class="mb-4">{!! $page->konten !!}</p>
                              </div>

                              {{-- <div class="social-share">
                                  <a href="#"><i class="fa fa-facebook-square facebook-color"></i></a>
                                  <a href="#"><i class="fa fa-twitter-square twitter-color"></i></a>
                                  <a href="#"><i class="fa fa-linkedin-square linkedin-color"></i></a>
                                  <a href="#"><i class="fa fa-pinterest-square pinterest-color"></i></a>
                              </div> --}}

                          </section>
                      </div>
                      <!-- Blog Details Wrapper Area End -->                      
                  </div>
              </div>
          </div>
      </div>
      <!-- Blog Main Area End Here -->
  </div>
  <!-- Blog Area Wrapper End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
