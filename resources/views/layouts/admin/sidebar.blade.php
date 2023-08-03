<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Administrator</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::guard('user')->user()->name }}</a>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
         <li class="nav-item">
           <a href="/dashboard" class="nav-link {{ $menu=='dashboard' ? 'active' : '' }}">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li>

         {{-- <li class="nav-item">
           <a href="pages/widgets.html" class="nav-link">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Lihat Website
             </p>
           </a>
         </li> --}}

        <li class="nav-header">PENGATURAN</li>
        <li class="nav-item has-treeview {{ $folder=='pengaturanwebsite' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $folder=='pengaturanwebsite' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Pengaturan Website
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/profile" class="nav-link {{ $menu=='profile' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile Website</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/rekening" class="nav-link {{ $menu=='rekening' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Rekening Bank</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="/bank" class="nav-link {{ $menu=='bank' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Bank</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href="/logo" class="nav-link {{ $menu=='logo' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Logo</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="./index3.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Setting Ongkir</p>
              </a>
            </li> --}}
          </ul>
        </li>
        <!-- <li class="nav-item has-treeview {{ $folder=='pengaturansosmed' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $folder=='pengaturansosmed' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Pengaturan Sosmed
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/twitter" class="nav-link {{ $menu=='twitter' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Twitter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/facebook" class="nav-link {{ $menu=='facebook' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Facebook</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/instagram" class="nav-link {{ $menu=='instagram' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Instagram</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/youtube" class="nav-link {{ $menu=='youtube' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Youtube</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/pixel" class="nav-link {{ $menu=='pixel' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Facebook Pixel
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview {{ $folder=='pengaturanseo' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $folder=='pengaturanseo' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Pengaturan SEO
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/webmaster" class="nav-link {{ $menu=='webmaster' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Webmaster</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/settingseo" class="nav-link {{ $menu=='seo' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>SEO Website</p>
              </a>
            </li>
          </ul>
        </li> -->
        <li class="nav-item">
          <a href="/settinguser" class="nav-link {{ $menu=='user' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Pengaturan User
            </p>
          </a>
        </li>

        <li class="nav-header">Modul</li>
        <li class="nav-item">
          <a href="/modulbanner" class="nav-link {{ $menu=='banner' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Banner Slide
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/bannertext" class="nav-link {{ $menu=='bannertext' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Banner text
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/headerproduct" class="nav-link {{ $menu=='headerproduct' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Header Product
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/headercontact" class="nav-link {{ $menu=='headercontact' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Header Contact
            </p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="/modulaboutus" class="nav-link {{ $menu=='aboutus' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              About Us
            </p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="/modulpromo" class="nav-link {{ $menu=='modulpromo' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Promo</p>
          </a>
        </li> -->
        {{-- <li class="nav-item">
          <a href="/modultime" class="nav-link {{ $menu=='modultime' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Waktu Opening
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item has-treeview {{ $folder=='pengaturanpromo' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $folder=='pengaturanpromo' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Feature Promo
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/featpromo" class="nav-link {{ $menu=='featpromo' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Header</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/modulpromo" class="nav-link {{ $menu=='modulpromo' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Promo</p>
              </a>
            </li>
          </ul>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/featproduct" class="nav-link {{ $menu=='featproduct' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Feature Product
            </p>
          </a>
        </li> --}}
        <li class="nav-item has-treeview {{ $folder=='pengaturanproduk' ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ $folder=='pengaturanproduk' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/product" class="nav-link {{ $menu=='product' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Semua Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/productcat" class="nav-link {{ $menu=='productcat' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Kategori Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/jenisproduk" class="nav-link {{ $menu=='jenisproduk' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Jenis Produk</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/brand" class="nav-link {{ $menu=='brand' ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Brand Produk</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/modulpage" class="nav-link {{ $menu=='modulpage' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Page
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/modultestimoni" class="nav-link {{ $menu=='modultestimoni' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Testimoni
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/modulskill" class="nav-link {{ $menu=='modulskill' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Skill
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/modulwhy" class="nav-link {{ $menu=='modulwhy' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Why Choose Us
            </p>
          </a>
        </li> --}}
        {{-- <li class="nav-item">
          <a href="/modulvideo" class="nav-link {{ $menu=='modulvideo' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Video
            </p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="/footerimage" class="nav-link {{ $menu=='footerimage' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Logo Footer</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/bannerimage" class="nav-link {{ $menu=='bannerimage' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>Image Banner</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/modulfaq" class="nav-link {{ $menu=='modulfaq' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              FAQ
            </p>
          </a>
        </li> --}}

        <li class="nav-header">Order</li>
        <li class="nav-item">
          <a href="/order/pesananbaru" class="nav-link {{ $menu=='pesananbaru' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Pesanan Baru
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/order/statuspengiriman" class="nav-link {{ $menu=='statuspengiriman' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Status Pengiriman
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/order/daftartransaksi" class="nav-link {{ $menu=='daftartransaksi' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Daftar Transaksi
            </p>
          </a>
        </li>

        <li class="nav-header">Data</li>
        <li class="nav-item">
          <a href="/modulkontak" class="nav-link {{ $menu=='modulkontak' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Data Kontak
            </p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="/modulsubscribe" class="nav-link {{ $menu=='modulsubscribe' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Data Subscriber
            </p>
          </a>
        </li> --}}
        <li class="nav-item">
          <a href="/modulmember" class="nav-link {{ $menu=='modulmember' ? 'active' : '' }}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Data Pelanggan
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Logout
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
