<!-- Brand Logo Area Start Here -->
<div class="brand-logo-area gray-bg pt-no-text pb-no-text mt-text-5">
    <div class="container custom-area">
        <div class="row">
            <div class="col-12 col-custom">
                <div class="brand-logo-carousel swiper-container intro11-carousel-wrap arrow-style-3">
                    <div class="swiper-wrapper">
                      <?php $databrand = DB::table('brand')->get(); ?>
                      @foreach ($databrand as $result)
                        <div class="single-brand swiper-slide">
                            <a href="#">
                                <img src="{{asset('assets/brand/'.$result->gambar)}}" alt="{{$result->nama}}">
                            </a>
                        </div>
                      @endforeach
                    </div>
                    <!-- Slider Navigation -->
                    <div class="home1-slider-prev swiper-button-prev main-slider-nav"><i class="lnr lnr-arrow-left"></i></div>
                    <div class="home1-slider-next swiper-button-next main-slider-nav"><i class="lnr lnr-arrow-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Logo Area End Here -->
