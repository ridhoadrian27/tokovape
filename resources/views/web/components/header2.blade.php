<!-- Header Area Start Here -->
    <header class="main-header-area">
        <!-- Main Header Area Start -->
        <div class="main-header header-sticky">
            <div class="container custom-area">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-xl-2 col-md-6 col-6 col-custom">
                        <div class="header-logo d-flex align-items-center">
                          <?php
                            $getlogo = DB::table('logo')->where('id_logo', '1')->first();
                            $logo = $getlogo->logo;
                          ?>
                            <a href="/home">
                                <img class="img-full" src="{{asset('assets/logo/'.$logo)}}" alt="Header Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 d-none d-lg-flex justify-content-center col-custom">
                        <nav class="main-nav d-none d-lg-flex">
                          <ul class="nav">
                              <li><a class="{{$menuhome}}" href="{{route('home')}}">Home</a></li>
                              <li><a class="{{$menuabout}}" href="{{route('about')}}">About Us</a></li>
                              <li><a class="{{$menuproduct}}" href="{{route('products')}}">Products</a></li>
                              <li><a class="{{$menucontact}}" href="{{route('contact')}}">Contact Us</a></li>
                              <li>
                                  <a href="javascript:;">
                                      <span class="menu-text"> Support</span>
                                      <i class="fa fa-angle-down"></i>
                                  </a>
                                  <ul class="dropdown-submenu dropdown-hover">
                                      <li><a href="/page/cara-belanja">Cara Belanja</a></li>
                                      <li><a href="/page/terms-condition">Term & Condition</a></li>
                                  </ul>
                              </li>
                              <li>
                                  <a href="javascript:;">
                                      <span class="menu-text"> Account</span>
                                      <i class="fa fa-angle-down"></i>
                                  </a>
                                  <ul class="dropdown-submenu dropdown-hover">
                                    <?php $email = Session::get('email'); ?>
                                    <?php if($email){ ?>
                                      <li><a href="/member/dashboard">Dashboard</a></li>
                                      <li><a href="/memberlogout">Logout</a></li>
                                    <?php }else{ ?>
                                      <li><a href="/login">Login</a></li>
                                      <li><a href="/register">Register</a></li>
                                    <?php } ?>
                                  </ul>
                              </li>
                          </ul>
                        </nav>
                    </div>
                    <div class="col-lg-2 col-md-6 col-6 col-custom">
                        <div class="header-right-area main-nav">
                            <ul class="nav">
                              <?php
                                $no_pemesanan = Session::get('no_pemesanan');
                                $jumlahPemesanan  = DB::table('detailpemesanan')->where('no_pemesanan', $no_pemesanan)->count();
                                if($jumlahPemesanan){
                                  $val_jumlah = $jumlahPemesanan;
                                }else{
                                  $val_jumlah = '0';
                                }
                              ?>
                                <li class="minicart-wrap">
                                    <a href="#" class="minicart-btn toolbar-btn">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="cart-item_count">{{ $val_jumlah }}</span>
                                    </a>
                                </li>
                                <li class="sidemenu-wrap">
                                    <a href="#"><i class="fa fa-search"></i> </a>
                                    <ul class="dropdown-sidemenu dropdown-hover-2 dropdown-search">
                                        <li>
                                          <form action="/search" method="post">
                                              @csrf
                                                <input name="search" id="search" placeholder="Search" type="text">
                                                <button type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="account-menu-wrap d-none d-lg-flex">
                                    <a href="#" class="off-canvas-menu-btn">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li> --}}
                                <li class="mobile-menu-btn d-lg-none">
                                    <a class="off-canvas-btn" href="#">
                                        <i class="fa fa-bars"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Header Area End -->
        <!-- off-canvas menu start -->
        <aside class="off-canvas-wrapper" id="mobileMenu">
            <div class="off-canvas-overlay"></div>
            <div class="off-canvas-inner-content">
                <div class="btn-close-off-canvas">
                    <i class="fa fa-times"></i>
                </div>
                <div class="off-canvas-inner">
                    <div class="search-box-offcanvas">
                      <form action="/search" method="post">
                          @csrf
                          <input type="text" name="search" id="search" placeholder="Search product...">
                          <button class="search-btn"><i class="fa fa-search"></i></button>
                      </form>
                    </div>
                    <!-- mobile menu start -->
                    <div class="mobile-navigation">
                        <!-- mobile menu navigation start -->
                        <nav>
                          <ul class="mobile-menu">
                            <li><a class="active" href="{{route('home')}}">Home</a></li>
                            <li><a href="{{route('about')}}">About Us</a></li>
                            <li><a href="{{route('products')}}">Products</a></li>
                            <li><a href="{{route('contact')}}">Contact Us</a></li>
                            <li class="menu-item-has-children"><a href="#">Support</a>
                                <ul class="dropdown">
                                  <li><a href="/page/cara-belanja">Cara Belanja</a></li>
                                  <li><a href="/page/terms-condition">Term & Condition</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children"><a href="#">Account</a>
                                <ul class="dropdown">
                                  <?php $email = Session::get('email'); ?>
                                  <?php if($email){ ?>
                                    <li><a href="/member/dashboard">Dashboard</a></li>
                                    <li><a href="/memberlogout">Logout</a></li>
                                  <?php }else{ ?>
                                    <li><a href="/login">Login</a></li>
                                    <li><a href="/register">Register</a></li>
                                  <?php } ?>
                                </ul>
                            </li>
                          </ul>
                        </nav>
                        <!-- mobile menu navigation end -->
                    </div>
                    <!-- mobile menu end -->
                    <?php
                      $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
                      $telepon  = $profiltoko->telepon;
                      $email  = $profiltoko->email;
                    ?>
                    <div class="offcanvas-widget-area">
                        <div class="top-info-wrap text-left text-black">
                            <ul class="address-info">
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a href="javascript:;">{{ $telepon }}</a>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="javascript:;">{{ $email }}</a>
                                </li>
                            </ul>
                            <?php
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
                            <div class="widget-social">
                                <a class="facebook-color-bg" title="Facebook-f" href="{{$facebook}}"><i class="fa fa-facebook-f"></i></a>
                                <a class="twitter-color-bg" title="Twitter" href="{{$twitter}}"><i class="fa fa-twitter"></i></a>
                                <a class="linkedin-color-bg" title="Instagram" href="{{$instagram}}"><i class="fa fa-instagram"></i></a>
                                <a class="youtube-color-bg" title="Youtube" href="{{$youtube}}"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- off-canvas menu end -->
        <!-- off-canvas menu start -->

        <!-- off-canvas menu end -->
    </header>
    <!-- Header Area End Here -->
