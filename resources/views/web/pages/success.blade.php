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

  @include('web.components.header2')

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
                      <h3 class="title-3">Registrasi Berhasil</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Registrasi Berhasil</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- About Area Start Here -->
  <div class="about-area mt-no-text">
      <div class="container custom-area">
          <div class="row mb-30 align-items-center">
              <div class="col-md-12 col-custom">
                  <div class="collection-content">
                      <div class="desc-content" style="text-align: center;">
                        <h5>Silakan periksa email untuk detail registrasi</h5><br>
                        <a href="/login" class="btn flosun-button  secondary-btn theme-color rounded-0">Login disini</a>
                      </div>
                  </div>
              </div>

          </div>

      </div>
  </div>
  <!-- About Us Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
