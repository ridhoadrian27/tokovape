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
                      <h3 class="title-3">Reset Password</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Reset Password</li>
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
                          <h2 class="title-4 mb-2">Reset Password</h2>
                      </div>
                      <form method="post" action="/resetpass" id="updateform">
                      @csrf
                          <div class="single-input-item mb-3">
                              <input type="email" id="email" name="email" maxlength="90" placeholder="Email or Username">
                          </div>
                          <div class="single-input-item mb-3">
                              <button type="button" id="submit" class="btn flosun-button secondary-btn theme-color rounded-0">Login</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
        $(document).ready(function() {

          $("#submit").click(function(){

            var dataform = $("#updateform").serialize();

            var token = $("input[name='_token']").val();
            var email = $("#email").val();

            if(email.length == 0){
              alert("Maaf, Email tidak boleh kosong");
              $("#email").focus();
              return (false);
            }

            $.ajax({
        		    type: "POST",
        		    url : "/cekemail",
        		    data: "_token="+token+
                  "&email="+email,
        		    beforeSend: function() {
        		        $.LoadingOverlay("show");
        		    },
        		    success: function(msg){
                  //alert(msg);
                  if(msg=='1'){
                    //konten
                    $.ajax({
                      type: "POST",
                      url : "/resetpass",
                      data: dataform,
                      beforeSend: function() {
                        $.LoadingOverlay("show");
                      },
                      success: function(msg){
                        //location.reload();
                        document.location.href="/resetsuccess";
                      }
                    });
                    //konten
                  }else{
                    $.LoadingOverlay("hide");
                    alert('Email tidak ditemukan');
                  }
                }
            });

          });

        });
  </script>
  <!-- Login Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
