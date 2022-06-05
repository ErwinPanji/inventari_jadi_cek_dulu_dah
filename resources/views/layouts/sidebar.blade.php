 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('dashboard')}}" class="brand-link">
      <img src="{{asset('img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('AdminLTE/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Master Input
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('jenisbarang.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Master Jenis Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('barang.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('penyedia.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Penyedia</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('sumberdana.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Sumber Dana</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('pemohon.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Master Pemohon</p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('satuan.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Satuan</p>
                  </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-header">FORM</li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Penerimaan Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                SPPB
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                BAST - DIST
              </p>
            </a>
          </li>
          <li class="nav-header">REPORT</li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Stok Opname
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Kartu Persediaan
              </p>
            </a>
          </li>
          <li class="nav-header">SETTING</li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Profil SKPD - UKPD
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../widgets.html" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Management User
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>