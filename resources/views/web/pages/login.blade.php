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
                      <h3 class="title-3">Login</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Login</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- Login Area Start Here -->
  <div class="login-register-area mt-no-text">
      <div class="container custom-area">
          <div class="row">
              <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-custom">
                  <div class="login-register-wrapper">
                      <div class="section-content text-center mb-5">
                          <h2 class="title-4 mb-2">Login</h2>
                          <p class="desc-content">Please login using account detail bellow.</p>
                      </div>
                      <form action="/memberlogin" method="post">
                      @csrf
                      <input type="hidden" name="link" class="form_login" value="{{ $link }}">
                          <div class="single-input-item mb-3">
                              <input type="email" id="email" name="email" maxlength="90" placeholder="Email or Username">
                          </div>
                          <div class="single-input-item mb-3">
                              <input type="password" id="password" name="password" maxlength="90" placeholder="Enter your Password">
                          </div>
                          <div class="single-input-item mb-3">
                              <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                  <a href="{{route('reset')}}" class="forget-pwd mb-3">Forget Password?</a>
                              </div>
                          </div>
                          <div class="single-input-item mb-3">
                              <button type="submit" class="btn flosun-button secondary-btn theme-color rounded-0">Login</button>
                          </div>
                          <div class="single-input-item">
                              <a href="/register">Creat Account</a>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Login Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
