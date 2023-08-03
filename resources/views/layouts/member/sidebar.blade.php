<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#f6f6f6;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    {{-- <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8"> --}}
     <?php
       $profiltoko = DB::table('profiltoko')->where('id_profiltoko', '1')->first();
       $namatoko  = $profiltoko ->nama;
     ?>
    <span class="brand-text font-weight-light" style="color:#404040;">{{ $namatoko }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
         {{-- <li class="nav-item">
           <a href="/member/paymentstatus" class="nav-link" style="color:#404040;">
             <i class="nav-icon fas fa-th"></i>
             <p>
               Dashboard
             </p>
           </a>
         </li> --}}

        <li class="nav-header" style="color:#404040;">Pemesanan</li>
        <li class="nav-item">
          <a href="/member/paymentstatus" class="nav-link" style="color:#404040;">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Status Pemesanan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/member/confirmation" class="nav-link" style="color:#404040;">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Konfirmasi Penerimaan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/member/transactionlist" class="nav-link" style="color:#404040;">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Daftar Transaksi
            </p>
          </a>
        </li>

        <li class="nav-header" style="color:#404040;">Modul</li>
        <li class="nav-item">
          <a href="/alamat" class="nav-link" style="color:#404040;">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Data Alamat
            </p>
          </a>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link" style="color:#404040;">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Pengaturan User
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/member/profile" class="nav-link" style="color:#404040;">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/member/changepass" class="nav-link" style="color:#404040;">
                <i class="far fa-circle nav-icon"></i>
                <p>Ganti Password</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/memberlogout" class="nav-link" style="color:#404040;">
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
