<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin-home') }}" class="brand-link">
      <img src="/Lte/dist/img/Logo.png" alt="E-Tiket Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">E-Tiket Speedboat</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('Lte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Super Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('adminSpeedboatHome') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard </p>
            </a>
          
          <li class="nav-header">Page</li>
          <li class="nav-item has-treeview">
           <li class="nav-item">
            <a href="{{ route('speedboatProfile') }}" class="nav-link">
              <i class="nav-icon fas fa-ship"></i>
              <p class="text">Speedboat</p>
            </a>
          </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p class="text">Transaksi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('jadwalSpeedboat') }}" class="nav-link">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p class="text">Jadwal</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('beritaPelabuhan') }}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p class="text">Berita Pelabuhan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('beritaSpeedboat') }}" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p class="text">Berita Speedboat</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-gift"></i>
              <p class="text">Reward</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-star"></i>
              <p class="text">Review</p>
            </a>
          </li>
          </li>

          <li class="nav-header">About Us</li>
          <li class="nav-item">
            <a href="{{ route('admin-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-id-card-alt text-danger"></i>
              <p class="text">Contact Us</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('speedboat-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-ship text-warning"></i>
              <p>Speedboat Conntact</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('pelabuhan-contact') }}" class="nav-link">
              <i class="nav-icon fas fa-monument text-info"></i>
              <p>Harbour Contact</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>