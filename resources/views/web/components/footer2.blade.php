<!--Footer Area Start-->
<footer class="footer-area mt-no-text">
    <div class="footer-widget-area">
      <div class="container container-default custom-area">
          <div class="row">
            <?php
              $getlogo = DB::table('logo')->where('id_logo', '1')->first();
              $logo = $getlogo->logo;

              $carabelanja = DB::table('page')->where('id', '1')->first();
              $slugbelanja = $carabelanja->slug;

              $term = DB::table('page')->where('id', '2')->first();
              $slugterm  = $term ->slug;

              $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
              $namatoko  = $profiltoko ->nama;
              $profile  = $profiltoko ->profile;
              $alamat  = $profiltoko ->alamat;
              $telepon  = $profiltoko ->telepon;
              $email  = $profiltoko ->email;

              $gettwitter = DB::table('twitter')->where('id_twitter', '1')->first();
              $twitter  = $gettwitter ->twitter;
              $getinstagram = DB::table('instagram')->where('id_instagram', '1')->first();
              $instagram  = $getinstagram ->instagram;
              $getfacebook = DB::table('facebook')->where('id_facebook', '1')->first();
              $facebook  = $getfacebook ->facebook;
              $getyoutube = DB::table('youtube')->where('id_youtube', '1')->first();
              $youtube  = $getyoutube ->youtube;
              $getfooterimage = DB::table('footerimage')->where('id_footerimage', '1')->first();
              $gambar  = $getfooterimage ->gambar;
            ?>
              <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-custom">
                  <div class="single-footer-widget m-0" style="color: white;">
                      <div class="footer-logo">
                          <a href="/home">
                              <img src="{{asset('assets/footerimage/'.$gambar)}}" alt="Logo Image">
                          </a>
                      </div>
                      <p class="desc-content">{!! $profile !!}</p>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-custom">
                  <div class="single-footer-widget">
                      <h2 class="widget-title">Contact Us</h2>
                      <ul class="widget-list">
                          <li><span>{{$telepon}}</span></li>
                          <li><span>{{$email}}</span></li>
                          <li><span>{{$alamat}}</span></li>
                      </ul>
                  </div>
              </div>
              <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-custom">
                  <div class="single-footer-widget">
                      <h2 class="widget-title">Follow Us</h2>
                      <div class="social-links">
                          <ul class="d-flex">
                              <li>
                                  <a class="rounded-circle" href="{{$facebook}}" title="Facebook">
                                      <i class="fa fa-facebook-f"></i>
                                  </a>
                              </li>
                              <li>
                                  <a class="rounded-circle" href="{{$twitter}}" title="Twitter">
                                      <i class="fa fa-twitter"></i>
                                  </a>
                              </li>
                              <li>
                                  <a class="rounded-circle" href="{{$instagram}}" title="Instagram">
                                      <i class="fa fa-instagram"></i>
                                  </a>
                              </li>
                              <li>
                                  <a class="rounded-circle" href="{{$youtube}}" title="Youtube">
                                      <i class="fa fa-youtube"></i>
                                  </a>
                              </li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="footer-copyright-area">
        <div class="container custom-area">
            <div class="row">
                <div class="col-12 text-center col-custom">
                    <div class="copyright-content">
                        <p>Copyright © {{ date('Y') }} <a href="/home">{{ $namatoko }}</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Footer Area End-->
