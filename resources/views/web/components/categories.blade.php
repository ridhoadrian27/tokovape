<div class="banner-area mt-30">
        <div class="container-fluid">
          <div class="row">
              <!--Section Title Start-->
              <div class="col-12 col-custom">
                  <div class="section-title text-center mb-30">
                      {{-- <span class="section-title-1">Wonderful gift</span> --}}
                  </div>
              </div>
              <!--Section Title End-->
          </div>

            <div class="row">
              <?php $datapromo = DB::table('promo')->get(); ?>
              @foreach ($datapromo as $result)
                <div class="col-md-4 col-custom">
                    <!--Single Banner Area Start-->
                    <div class="single-banner hover-style mb-30">
                        <div class="banner-img">
                            <a href="#">
                                <img src="{{asset('assets/promo/'.$result->gambar)}}" alt="">
                                <div class="overlay-1"></div>
                            </a>
                        </div>
                    </div>
                    <!--Single Banner Area End-->
                </div>
              @endforeach
            </div>
        </div>
    </div>
