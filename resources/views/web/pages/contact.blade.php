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
                      <h3 class="title-3">Contact Us</h3>
                      <ul>
                          <li><a href="/home">Home</a></li>
                          <li>Contact Us</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Breadcrumb Area End Here -->
  <!-- Contact Us Area Start Here -->
  <div class="contact-us-area mt-no-text">
      <div class="container custom-area">
          <div class="row">
              <div class="col-lg-4 col-md-6 col-custom">
                  <div class="contact-info-item">
                      <div class="con-info-icon">
                          <i class="lnr lnr-map-marker"></i>
                      </div>
                      <div class="con-info-txt">
                          <h4>Alamat</h4>
                          <p>{{ $profiletoko->alamat }}</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-custom">
                  <div class="contact-info-item">
                      <div class="con-info-icon">
                          <i class="lnr lnr-smartphone"></i>
                      </div>
                      <div class="con-info-txt">
                          <h4>Telepon</h4>
                          <p>Mobile: {{ $profiletoko->telepon }}</p>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-12 col-custom text-align-center">
                  <div class="contact-info-item">
                      <div class="con-info-icon">
                          <i class="lnr lnr-envelope"></i>
                      </div>
                      <div class="con-info-txt">
                          <h4>Email</h4>
                          <p>{{ $profiletoko->email }}</p>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 col-custom">
                  <form method="post" action="/contactadd" id="updateform" accept-charset="UTF-8" class="contact-form">
                    @csrf
                      <div class="comment-box mt-5">
                          <h5 class="text-uppercase">Get in Touch</h5>
                          <div class="row mt-3">
                              <div class="col-md-6 col-custom">
                                  <div class="input-item mb-4">
                                      <input class="border-0 rounded-0 w-100 input-area name gray-bg" type="text" name="nama" id="nama" placeholder="Name">
                                  </div>
                              </div>
                              <div class="col-md-6 col-custom">
                                  <div class="input-item mb-4">
                                      <input class="border-0 rounded-0 w-100 input-area email gray-bg" type="email" id="email" type="email" placeholder="Email">
                                  </div>
                              </div>
                              <div class="col-12 col-custom">
                                  <div class="input-item mb-4">
                                      <textarea cols="30" rows="5" class="border-0 rounded-0 w-100 custom-textarea input-area gray-bg" name="message" id="message" placeholder="Message"></textarea>
                                  </div>
                              </div>
                              <div class="col-12 col-custom mt-40">
                                  <button type="button" id="submit" name="submit" class="btn flosun-button secondary-btn theme-color rounded-0">Send A Message</button>
                              </div>
                              <p class="col-8 col-custom form-message mb-0"></p>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <script type="text/javascript">
      $(document).ready(function() {

        $("#submit").click(function(){

          var dataform = $("#updateform").serialize();

          var token = $("input[name='_token']").val();
          var nama = $("#nama").val();
          var email = $("#email").val();
          var message = $("#message").val();

          if(nama.length == 0){
            alert("Maaf, Nama tidak boleh kosong");
            $("#nama").focus();
            return (false);
          }

          if(email.length == 0){
            alert("Maaf, Email tidak boleh kosong");
            $("#email").focus();
            return (false);
          }

          if(message.length == 0){
            alert("Maaf, Pesan tidak boleh kosong");
            $("#message").focus();
            return (false);
          }

          $.ajax({
            type: "POST",
            url : "/contactadd",
            data: dataform,
            beforeSend: function() {
              $.LoadingOverlay("show");
            },
            success: function(msg){
              document.location.href="/contactsuccess";
            }
          });

        });

      });
  </script>
  <!-- Contact Us Area End Here -->
	<!-- PAGE-CONTENT END -->

  @include('web.components.footer2')

@endsection
