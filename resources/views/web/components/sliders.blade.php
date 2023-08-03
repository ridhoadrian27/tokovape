<!-- Slider/Intro Section Start -->
<div class="intro11-slider-wrap section">
    <div class="intro11-slider swiper-container">
        <div class="swiper-wrapper">
          @foreach ($banner as $result)
            <div class="intro11-section swiper-slide slide-bg-1 bg-position" style="background-image: url({{asset('assets/banner/'.$result->gambar)}}); background-color: rgba(215, 177, 190, 0.9);">
                <!-- Intro Content Start -->
                <div class="intro11-content text-left">
                    <h3 class="title-slider text-uppercase" style="background: none;">&nbsp;</h3>
                    <h2 class="title">{{ $result->text1 }}</h2>
                    <p class="desc-content">{{ $result->text2 }}</p>
                    <a href="{{ $result->customlink }}" class="btn flosun-button secondary-btn theme-color  rounded-0">{{ $result->button_text }}</a>
                </div>
                <!-- Intro Content End -->
            </div>
          @endforeach
        </div>
        <!-- Slider Navigation -->
        <div class="home1-slider-prev swiper-button-prev main-slider-nav"><i class="lnr lnr-arrow-left"></i></div>
        <div class="home1-slider-next swiper-button-next main-slider-nav"><i class="lnr lnr-arrow-right"></i></div>
        <!-- Slider pagination -->
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Slider/Intro Section End -->
