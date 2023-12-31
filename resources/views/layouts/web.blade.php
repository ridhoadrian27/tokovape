<!doctype html>
<html class="no-js" lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>VapeTown | Pontianak </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <?php
    $getfavicon = DB::table('logo')->where('id_logo', '1')->first();
    $favicon = $getfavicon->favicon;
    ?>
    <link rel="shortcut icon" href="{{asset('assets/favicon/'.$favicon)}}" type="image/x-icon">

    <!-- jQuery JS -->
    <script src="{{asset('web/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>

    <!-- CSS
	============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/vendor/bootstrap.min.css') }}">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/vendor/font.awesome.min.css') }}">
    <!-- Linear Icons CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/vendor/linearicons.min.css') }}">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/plugins/swiper-bundle.min.css') }}">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/plugins/animate.min.css') }}">
    <!-- Jquery ui CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/plugins/jquery-ui.min.css') }}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/plugins/nice-select.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('web/assets/css/plugins/magnific-popup.css') }}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('web/assets/css/style.css') }}">

    <?php
    $get_webmaster = DB::table('webmaster')->where('id_webmaster', '1')->first();
    $webmaster = $get_webmaster->webmaster;
    if($webmaster){ echo $webmaster; }else{}
    ?>

    <?php
    $get_pixel = DB::table('pixel')->where('id_pixel', '1')->first();
    $pixel = $get_pixel->pixel;
    $segmen = Request::segment(1);
    if($segmen=='thankyou'){ }else{
      if($pixel){ echo $pixel; }else{}
      }
      ?>

    <!-- loading -->
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/src/loadingoverlay.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@1.5.4/extras/loadingoverlay_progress/loadingoverlay_progress.min.js"></script>
    <!-- loading -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5facd522133c4c93"></script>

</head>

<body>

    <!--===== Pre-Loading area Start =====-->
    <div id="preloader">
        <div class="preloader">
            <div class="spinner-block">
                <h1 class="spinner spinner-3 mb-0">.</h1>
            </div>
        </div>
    </div>
    <!--==== Pre-Loading Area End ====-->

    @yield('content')

    <!-- Modal -->
    <div class="modal flosun-modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="close close-button" data-dismiss="modal" aria-label="Close">
                    <span class="close-icon" aria-hidden="true">x</span>
                </button>
                <div class="modal-body">
                    <div class="container-fluid custom-area">
                        <div class="row">
                            <div class="col-md-6 col-custom">
                                <div class="modal-product-img">
                                    <a class="w-100" href="#">
                                        <img class="w-100" src="{{asset('web/assets/images/product/large-size/1.jpg') }}" alt="Product">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-custom">
                                <div class="modal-product">
                                    <div class="product-content">
                                        <div class="product-title">
                                            <h4 class="title">Product dummy name</h4>
                                        </div>
                                        <div class="price-box">
                                            <span class="regular-price ">$80.00</span>
                                            <span class="old-price"><del>$90.00</del></span>
                                        </div>
                                        <div class="product-rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <span>1 Review</span>
                                        </div>
                                        <p class="desc-content">we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame bel...</p>
                                        <form class="d-flex flex-column w-100" action="#">
                                            <div class="form-group">
                                                <select class="form-control nice-select w-100">
                                                    <option>S</option>
                                                    <option>M</option>
                                                    <option>L</option>
                                                    <option>XL</option>
                                                    <option>XXL</option>
                                                </select>
                                            </div>
                                        </form>
                                        <div class="quantity-with-btn">
                                            <div class="quantity">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="0" type="text">
                                                    <div class="dec qtybutton">-</div>
                                                    <div class="inc qtybutton">+</div>
                                                    <div class="dec qtybutton"><i class="fa fa-minus"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-plus"></i></div>
                                                </div>
                                            </div>
                                            <div class="add-to_btn">
                                                <a class="btn product-cart button-icon flosun-button dark-btn" href="cart.html">Add to cart</a>
                                                <a class="btn flosun-button secondary-btn rounded-0" href="wishlist.html">Add to wishlist</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Start -->
    <a class="scroll-to-top" href="#">
        <i class="lnr lnr-arrow-up"></i>
    </a>
    <!-- Scroll to Top End -->

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="{{asset('web/assets/js/vendor/modernizr-3.7.1.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('web/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>

    <!-- Swiper Slider JS -->
    <script src="{{asset('web/assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <!-- nice select JS -->
    <script src="{{asset('web/assets/js/plugins/nice-select.min.js') }}"></script>
    <!-- Ajaxchimpt js -->
    <script src="{{asset('web/assets/js/plugins/jquery.ajaxchimp.min.js') }}"></script>
    <!-- Jquery Ui js -->
    <script src="{{asset('web/assets/js/plugins/jquery-ui.min.js') }}"></script>
    <!-- Jquery Countdown js -->
    <script src="{{asset('web/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <!-- jquery magnific popup js -->
    <script src="{{asset('web/assets/js/plugins/jquery.magnific-popup.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{asset('web/assets/js/main.js') }}"></script>

    <script type="text/javascript" src="{{asset('assets/js/highlight.pack.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/tabifier.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/jPages.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/js.js')}}"></script>

    <script>
    /* when document is ready */
    $(function() {
      /* initiate plugin */
      $("div.holder").jPages({
        containerID: "itemContainer"
      });
    });

    </script>


</body>


</html>
